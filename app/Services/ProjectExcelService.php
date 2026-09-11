<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProjectExcelService
{
    public const PROJECT_HEADERS = [
        'project_code',
        'title',
        'category_code',
        'client_name',
        'location',
        'completion_year',
        'scope_of_work',
        'summary',
        'content_html',
        'is_featured',
        'sort_order',
        'status',
    ];

    /**
     * Generate an Excel template for project import with references.
     */
    public function generateTemplate(): string
    {
        $spreadsheet = new Spreadsheet();

        // ----------------------------------------------------
        // Sheet 1: Projects Data
        // ----------------------------------------------------
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Projects');

        // Header Style
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0F172A']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CBD5E1']]],
        ];

        $col = 1;
        foreach (self::PROJECT_HEADERS as $header) {
            $sheet->getCell([$col, 1])->setValueExplicit($header, DataType::TYPE_STRING);
            $sheet->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col))->setAutoSize(true);
            $col++;
        }
        $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Sample Data Rows
        $sampleProjects = [
            [
                'PRJ-SUB-01',
                'Pakuwon Mall & Superblock Power Substation',
                'COMMERCIAL',
                'PT. Pakuwon Jati Tbk',
                'West Surabaya, Indonesia',
                '2024',
                'Schneider MasterPact MTZ 3200A • GAE Capacitor 600kVAR',
                'Complete engineering, fabrication, and supply of Low Voltage Main Distribution Panels (LVMDP) for Surabaya’s largest commercial superblock.',
                '<p>Full fabrication of Low Voltage Main Distribution Panel (LVMDP) 3200A with intelligent Schneider Micrologic protection and automated power factor correction capacitor bank.</p>',
                1,
                1,
                'published',
            ],
            [
                'PRJ-MCC-02',
                'Indofood CBP Motor Control Center (MCC)',
                'FOOD_BEV',
                'PT Indofood CBP Sukses Makmur',
                'Pasuruan, East Java',
                '2024',
                'Schneider Altivar ATV930 VFD • TeSys Deca Contactors',
                'Smart motor control center switchboards equipped with harmonic suppression inverters and thermal predictive monitoring for continuous food processing.',
                '<p>Motor Control Center (MCC) switchboards featuring harmonic suppression filters, dual redundant cooling systems, and integrated industrial IoT predictive thermal monitoring.</p>',
                1,
                2,
                'published',
            ],
            [
                'PRJ-COLD-03',
                'PT Bumi Menara Internusa Cold Chain & SCADA',
                'COLD_STORAGE',
                'PT Bumi Menara Internusa (BMI)',
                'Dampit & Surabaya',
                '2023 - 2024',
                'Socomec ATS 1600A • GAE Digital Power Metering',
                'Integrated industrial refrigeration power distribution panels with dual-redundant automatic transfer switching and IoT SCADA telemetries.',
                '<p>Engineering and supply of ATS/AMF 1600A automatic transfer switches and RS-485 Modbus power meters for industrial seafood cold storage processing facility.</p>',
                1,
                3,
                'published',
            ],
        ];

        $row = 2;
        foreach ($sampleProjects as $sample) {
            $col = 1;
            foreach ($sample as $val) {
                $sheet->getCell([$col, $row])->setValueExplicit($val, DataType::TYPE_STRING);
                $col++;
            }
            $sheet->getRowDimension($row)->setRowHeight(22);
            $row++;
        }

        // ----------------------------------------------------
        // Sheet 2: Category References
        // ----------------------------------------------------
        $catSheet = $spreadsheet->createSheet();
        $catSheet->setTitle('Categories Reference');

        $catHeaders = ['Category Code', 'Category Name', 'Description'];
        $catCol = 1;
        foreach ($catHeaders as $ch) {
            $catSheet->getCell([$catCol, 1])->setValueExplicit($ch, DataType::TYPE_STRING);
            $catSheet->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($catCol))->setAutoSize(true);
            $catCol++;
        }
        $catSheet->getStyle('A1:C1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E11D48']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $categories = ProjectCategory::orderBy('sort_order')->get();
        $catRow = 2;
        foreach ($categories as $cat) {
            $catSheet->getCell([1, $catRow])->setValueExplicit($cat->code, DataType::TYPE_STRING);
            $catSheet->getCell([2, $catRow])->setValueExplicit($cat->name, DataType::TYPE_STRING);
            $catSheet->getCell([3, $catRow])->setValueExplicit($cat->description ?? '-', DataType::TYPE_STRING);
            $catRow++;
        }

        $tempPath = storage_app_path('temp_project_template_' . time() . '.xlsx');
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        return $tempPath;
    }

    /**
     * Import projects from an uploaded Excel file.
     */
    public function import(UploadedFile $file): array
    {
        $reader = IOFactory::createReaderForFile($file->getRealPath());
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->getRealPath());

        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        if ($highestRow < 2) {
            throw new Exception('File Excel kosong atau tidak memiliki baris data proyek.');
        }

        // Read header row
        $headers = [];
        for ($col = 'A'; $col <= $highestColumn; $col++) {
            $val = strtolower(trim((string) $sheet->getCell($col . '1')->getValue()));
            if ($val !== '') {
                $headers[$col] = $val;
            }
        }

        // Validate mandatory columns
        $required = ['title'];
        foreach ($required as $req) {
            if (!in_array($req, $headers, true)) {
                throw new Exception("Kolom wajib '{$req}' tidak ditemukan pada baris pertama Excel.");
            }
        }

        $created = 0;
        $updated = 0;
        $errors = [];

        // Cache categories map
        $categoriesByCode = ProjectCategory::all()->keyBy(fn($c) => strtoupper(trim($c->code)));
        $categoriesByName = ProjectCategory::all()->keyBy(fn($c) => strtolower(trim($c->name)));

        DB::beginTransaction();
        try {
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = [];
                $hasData = false;

                foreach ($headers as $col => $key) {
                    $cellVal = $sheet->getCell($col . $row)->getValue();
                    $val = is_string($cellVal) ? trim($cellVal) : $cellVal;
                    if ($val !== null && $val !== '') {
                        $hasData = true;
                    }
                    $rowData[$key] = $val;
                }

                if (!$hasData || empty($rowData['title'])) {
                    continue; // skip empty rows
                }

                $title = trim($rowData['title']);
                $code = !empty($rowData['project_code']) ? trim($rowData['project_code']) : 'PRJ-' . strtoupper(Str::random(6));
                $slug = Str::slug($title);

                // Resolve category
                $categoryId = null;
                if (!empty($rowData['category_code'])) {
                    $catSearchCode = strtoupper(trim((string) $rowData['category_code']));
                    $catSearchName = strtolower(trim((string) $rowData['category_code']));

                    if (isset($categoriesByCode[$catSearchCode])) {
                        $categoryId = $categoriesByCode[$catSearchCode]->id;
                    } elseif (isset($categoriesByName[$catSearchName])) {
                        $categoryId = $categoriesByName[$catSearchName]->id;
                    }
                }

                if (!$categoryId) {
                    $categoryId = ProjectCategory::first()?->id;
                }

                $isFeatured = isset($rowData['is_featured']) && in_array(strtolower((string) $rowData['is_featured']), ['1', 'true', 'yes', 'ya'], true);
                $status = in_array(strtolower((string) ($rowData['status'] ?? '')), ['published', 'draft', 'archived'], true)
                    ? strtolower($rowData['status'])
                    : 'published';

                $publishedAt = $status === 'published' ? now() : null;

                // Check existing by project_code or slug
                $existing = Project::withTrashed()->where(function ($q) use ($code, $slug) {
                    $q->where('project_code', $code)->orWhere('slug', $slug);
                })->first();

                $projectPayload = [
                    'project_code' => $code,
                    'title' => $title,
                    'slug' => $slug,
                    'category_id' => $categoryId,
                    'client_name' => $rowData['client_name'] ?? null,
                    'location' => $rowData['location'] ?? null,
                    'completion_year' => $rowData['completion_year'] ?? date('Y'),
                    'scope_of_work' => $rowData['scope_of_work'] ?? null,
                    'summary' => $rowData['summary'] ?? null,
                    'content_html' => !empty($rowData['content_html']) ? HtmlSanitizerService::clean($rowData['content_html']) : null,
                    'is_featured' => $isFeatured,
                    'sort_order' => (int) ($rowData['sort_order'] ?? 0),
                    'status' => $status,
                    'published_at' => $publishedAt,
                    'created_by' => auth()->id() ?? 1,
                    'updated_by' => auth()->id() ?? 1,
                ];

                if ($existing) {
                    if ($existing->trashed()) {
                        $existing->restore();
                    }
                    $existing->update($projectPayload);
                    $updated++;
                } else {
                    Project::create($projectPayload);
                    $created++;
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return [
            'created' => $created,
            'updated' => $updated,
            'total' => $created + $updated,
        ];
    }
}

if (!function_exists('storage_app_path')) {
    function storage_app_path(string $path = ''): string
    {
        return storage_path('app/' . ltrim($path, '/'));
    }
}
