<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ImportJob;
use App\Models\Product;
use App\Services\ProductExcelService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportCenterController extends Controller
{
    public function index()
    {
        $history = ImportJob::with('user')->latest()->paginate(15);

        return view('backoffice.import.index', compact('history'));
    }

    public function downloadTemplate()
    {
        $spreadsheet = ProductExcelService::generateTemplate();
        $fileName = 'ATS_Product_Import_Template.xlsx';

        return new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function export(Request $request)
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $spreadsheet = ProductExcelService::exportProducts();
        $fileName = 'ATS_Product_Catalog_Export_' . date('Ymd_His') . '.xlsx';

        AuditLog::log('EXPORT', 'Product', null, ['filename' => $fileName]);

        return new StreamedResponse(function () use ($spreadsheet) {
            @ini_set('memory_limit', '1024M');
            @set_time_limit(300);
            $writer = new Xlsx($spreadsheet);
            $writer->setPreCalculateFormulas(false);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function upload(Request $request)
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(600);

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx', 'max:51200'], // max 50 MiB
            'mode' => ['required', 'in:upsert,create_only,update_only'],
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $checksum = hash_file('sha256', $file->getRealPath());
        $mode = $request->input('mode');

        // Store file in local disk
        $filename = 'import_' . time() . '_' . $checksum . '.xlsx';
        $storedPath = $file->storeAs('imports', $filename, 'local');
        $fullPath = static::resolveStoragePath($storedPath);

        // Parse and validate with staging
        $parseResult = ProductExcelService::parseAndValidate($fullPath, $mode, auth()->id());

        // Create import job record
        $job = ImportJob::create([
            'user_id' => auth()->id(),
            'file_path' => $storedPath,
            'file_name' => $originalName,
            'file_size' => $fileSize,
            'checksum' => $checksum,
            'mode' => $mode,
            'status' => $parseResult['success'] ? 'ready' : 'failed',
            'total_rows' => $parseResult['summary']['total_units'] ?? 0,
            'valid_rows' => ($parseResult['summary']['total_units'] ?? 0) - ($parseResult['summary']['error_count'] ?? 0),
            'error_rows' => $parseResult['summary']['error_count'] ?? 0,
            'plan_data' => json_encode(array_slice($parseResult['units'] ?? [], 0, 100)),
        ]);

        // If errors, save error report
        if (!empty($parseResult['errors'])) {
            $errorReport = ProductExcelService::generateErrorReport($parseResult['errors']);
            $errorReportRelPath = 'reports/error_report_' . $job->id . '.xlsx';
            $errorReportFullPath = Storage::disk('local')->path($errorReportRelPath);

            if (!is_dir(dirname($errorReportFullPath))) {
                mkdir(dirname($errorReportFullPath), 0755, true);
            }

            $writer = new Xlsx($errorReport);
            $writer->save($errorReportFullPath);

            $job->update(['error_report_path' => $errorReportRelPath]);
        }

        AuditLog::log('UPLOAD_IMPORT', 'ImportJob', $job->id, [
            'mode' => $mode,
            'total_units' => $job->total_rows,
            'error_count' => $job->error_rows,
        ]);

        return redirect()->route('backoffice.import.preview', ['id' => $job->id]);
    }

    public function preview(int $id)
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $job = ImportJob::with('user')->findOrFail($id);
        $units = json_decode($job->plan_data ?? '[]', true) ?: [];

        return view('backoffice.import.preview', compact('job', 'units'));
    }

    public function execute(Request $request, int $id)
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(900);

        $job = ImportJob::findOrFail($id);

        if ($job->status === 'completed') {
            return redirect()->route('backoffice.import.index')->with('info', 'Job impor ini telah selesai dieksekusi sebelumnya.');
        }

        $fullPath = static::resolveStoragePath($job->file_path);
        if ($fullPath && file_exists($fullPath)) {
            $parseResult = ProductExcelService::parseAndValidate($fullPath, $job->mode);
            $units = $parseResult['units'] ?? [];
        } else {
            $units = json_decode($job->plan_data ?? '[]', true);
        }

        $created = 0;
        $updated = 0;
        $unchanged = 0;
        $failed = 0;

        $job->update([
            'status' => 'processing',
            'started_at' => now(),
        ]);

        foreach ($units as $unit) {
            try {
                $res = ProductExcelService::executeUnit($unit, $job->user_id);
                if ($res['action'] === 'created') {
                    $created++;
                } elseif ($res['action'] === 'updated') {
                    $updated++;
                } else {
                    $unchanged++;
                }
            } catch (Exception $e) {
                $failed++;
            }
        }

        $finalStatus = $failed === 0 ? 'completed' : ($created + $updated > 0 ? 'partial' : 'failed');

        $job->update([
            'status' => $finalStatus,
            'created_count' => $created,
            'updated_count' => $updated,
            'unchanged_count' => $unchanged,
            'failed_count' => $failed,
            'completed_at' => now(),
        ]);

        AuditLog::log('EXECUTE_IMPORT', 'ImportJob', $job->id, [
            'created' => $created,
            'updated' => $updated,
            'failed' => $failed,
            'status' => $finalStatus,
        ]);

        return redirect()->route('backoffice.import.index')->with('success', "Impor berhasil diselesaikan: {$created} produk baru dibuat, {$updated} diperbarui, {$failed} gagal.");
    }

    public function downloadErrorReport(int $id)
    {
        $job = ImportJob::findOrFail($id);
        $fullPath = static::resolveStoragePath($job->error_report_path);

        if (!$job->error_report_path || !$fullPath || !file_exists($fullPath)) {
            abort(404, 'Laporan error tidak ditemukan.');
        }

        return response()->download($fullPath, "Laporan_Error_Impor_{$job->id}.xlsx");
    }

    /**
     * Resolve relative storage path across local disk and legacy private directories.
     */
    public static function resolveStoragePath(?string $relPath): ?string
    {
        if (!$relPath) {
            return null;
        }

        // 1. Storage disk 'local' direct path
        $p1 = Storage::disk('local')->path($relPath);
        if (file_exists($p1)) {
            return $p1;
        }

        // 2. storage_path('app/' . $relPath)
        $p2 = storage_path('app/' . ltrim($relPath, '/\\'));
        if (file_exists($p2)) {
            return $p2;
        }

        // 3. Strip redundant 'private/' prefix
        $clean = preg_replace('#^(private[/\\\\])+#', '', $relPath);
        $p3 = Storage::disk('local')->path($clean);
        if (file_exists($p3)) {
            return $p3;
        }

        // 4. Double private path
        $p4 = storage_path('app/private/private/' . $clean);
        if (file_exists($p4)) {
            return $p4;
        }

        return $p1;
    }
}
