<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('backoffice.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        @set_time_limit(300);
        @ini_set('memory_limit', '512M');

        $keys = [
            'company_name',
            'company_tagline',
            'phone',
            'whatsapp',
            'email',
            'address',
            'city',
            'postal_code',
            'google_maps_embed',
            'social_linkedin',
            'social_instagram',
            'default_meta_title',
            'default_meta_description',
            // Master Price List Fields
            'master_price_list_title',
            'master_price_list_description',
            'master_price_list_drive_url',
            'master_price_list_version',
            // Company Profile (Compro) Fields
            'company_profile_title',
            'company_profile_description',
            'company_profile_drive_url',
            'company_profile_version',
            // ATS Panel Project Document Fields
            'panel_project_doc_title',
            'panel_project_doc_description',
            'panel_project_doc_drive_url',
            'panel_project_doc_version',
            // Visi & Misi & Story Fields
            'company_vision',
            'company_mission',
            'company_story_p1',
            'company_story_p2',
            'company_story_p3',
            'company_story_p4',
            'stat_experience_years',
            'stat_clients_count',
            'stat_guarantee_percent',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        // Handle Manual Upload of Master Price List PDF
        if ($request->hasFile('master_price_list_file')) {
            $request->validate([
                'master_price_list_file' => 'mimes:pdf|max:102400', // up to 100MB
            ]);

            $file = $request->file('master_price_list_file');
            $fileSize = round($file->getSize() / (1024 * 1024), 2) . ' MB';
            $filename = 'master-price-list-' . time() . '.pdf';
            $destinationPath = public_path('uploads/price-lists');
            $rootDestination = base_path('uploads/price-lists');

            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
            }
            if (!file_exists($rootDestination)) {
                @mkdir($rootDestination, 0777, true);
            }

            $file->move($destinationPath, $filename);
            if ($rootDestination !== $destinationPath && file_exists($destinationPath . '/' . $filename)) {
                @copy($destinationPath . '/' . $filename, $rootDestination . '/' . $filename);
            }

            SiteSetting::set('master_price_list_pdf', '/uploads/price-lists/' . $filename);
            SiteSetting::set('master_price_list_size', $fileSize);
        }

        // Handle Manual Upload of Company Profile (Compro) PDF
        if ($request->hasFile('company_profile_file')) {
            $request->validate([
                'company_profile_file' => 'mimes:pdf|max:102400', // up to 100MB
            ]);

            $file = $request->file('company_profile_file');
            $fileSize = round($file->getSize() / (1024 * 1024), 2) . ' MB';
            $filename = 'company-profile-ats-' . time() . '.pdf';
            $destinationPath = public_path('uploads/compro');
            $rootDestination = base_path('uploads/compro');

            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
            }
            if (!file_exists($rootDestination)) {
                @mkdir($rootDestination, 0777, true);
            }

            $file->move($destinationPath, $filename);
            if ($rootDestination !== $destinationPath && file_exists($destinationPath . '/' . $filename)) {
                @copy($destinationPath . '/' . $filename, $rootDestination . '/' . $filename);
            }

            SiteSetting::set('company_profile_pdf', '/uploads/compro/' . $filename);
            SiteSetting::set('company_profile_size', $fileSize);

            // Auto-generate thumbnail from PDF Page 1 if no manual thumbnail uploaded
            if (!$request->hasFile('company_profile_thumb_file')) {
                if ($request->filled('company_profile_auto_thumb')) {
                    $thumbName = $this->saveBase64Image($request->input('company_profile_auto_thumb'), public_path('uploads/compro'), 'compro-thumb');
                    if ($thumbName) {
                        SiteSetting::set('company_profile_thumbnail', '/uploads/compro/' . $thumbName);
                    }
                } else {
                    $serverThumb = $this->generateThumbnailFromPdfServer($destinationPath . '/' . $filename, public_path('uploads/compro'), 'compro-thumb');
                    if ($serverThumb) {
                        SiteSetting::set('company_profile_thumbnail', '/uploads/compro/' . $serverThumb);
                    }
                }
            }
        } elseif (!$request->hasFile('company_profile_thumb_file') && $request->filled('company_profile_auto_thumb')) {
            $thumbName = $this->saveBase64Image($request->input('company_profile_auto_thumb'), public_path('uploads/compro'), 'compro-thumb');
            if ($thumbName) {
                SiteSetting::set('company_profile_thumbnail', '/uploads/compro/' . $thumbName);
            }
        }

        // Handle Thumbnail Upload of Company Profile (Compro) - Manual upload takes precedence
        if ($request->hasFile('company_profile_thumb_file')) {
            $request->validate([
                'company_profile_thumb_file' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            ]);

            $file = $request->file('company_profile_thumb_file');
            $filename = 'compro-thumb-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/compro');
            $rootDestination = base_path('uploads/compro');

            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
            }
            if (!file_exists($rootDestination)) {
                @mkdir($rootDestination, 0777, true);
            }

            $file->move($destinationPath, $filename);
            if ($rootDestination !== $destinationPath && file_exists($destinationPath . '/' . $filename)) {
                @copy($destinationPath . '/' . $filename, $rootDestination . '/' . $filename);
            }

            SiteSetting::set('company_profile_thumbnail', '/uploads/compro/' . $filename);
        }

        // Handle Manual Upload of ATS Panel Project PDF
        if ($request->hasFile('panel_project_doc_file')) {
            $request->validate([
                'panel_project_doc_file' => 'mimes:pdf|max:102400', // up to 100MB
            ]);

            $file = $request->file('panel_project_doc_file');
            $fileSize = round($file->getSize() / (1024 * 1024), 2) . ' MB';
            $filename = 'panel-project-ats-' . time() . '.pdf';
            $destinationPath = public_path('uploads/panel-projects');
            $rootDestination = base_path('uploads/panel-projects');

            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
            }
            if (!file_exists($rootDestination)) {
                @mkdir($rootDestination, 0777, true);
            }

            $file->move($destinationPath, $filename);
            if ($rootDestination !== $destinationPath && file_exists($destinationPath . '/' . $filename)) {
                @copy($destinationPath . '/' . $filename, $rootDestination . '/' . $filename);
            }

            SiteSetting::set('panel_project_doc_pdf', '/uploads/panel-projects/' . $filename);
            SiteSetting::set('panel_project_doc_size', $fileSize);

            // Auto-generate thumbnail from PDF Page 1 if no manual thumbnail uploaded
            if (!$request->hasFile('panel_project_doc_thumb_file')) {
                if ($request->filled('panel_project_doc_auto_thumb')) {
                    $thumbName = $this->saveBase64Image($request->input('panel_project_doc_auto_thumb'), public_path('uploads/panel-projects'), 'panel-project-thumb');
                    if ($thumbName) {
                        SiteSetting::set('panel_project_doc_thumbnail', '/uploads/panel-projects/' . $thumbName);
                    }
                } else {
                    $serverThumb = $this->generateThumbnailFromPdfServer($destinationPath . '/' . $filename, public_path('uploads/panel-projects'), 'panel-project-thumb');
                    if ($serverThumb) {
                        SiteSetting::set('panel_project_doc_thumbnail', '/uploads/panel-projects/' . $serverThumb);
                    }
                }
            }
        } elseif (!$request->hasFile('panel_project_doc_thumb_file') && $request->filled('panel_project_doc_auto_thumb')) {
            $thumbName = $this->saveBase64Image($request->input('panel_project_doc_auto_thumb'), public_path('uploads/panel-projects'), 'panel-project-thumb');
            if ($thumbName) {
                SiteSetting::set('panel_project_doc_thumbnail', '/uploads/panel-projects/' . $thumbName);
            }
        }

        // Handle Thumbnail Upload of ATS Panel Project - Manual upload takes precedence
        if ($request->hasFile('panel_project_doc_thumb_file')) {
            $request->validate([
                'panel_project_doc_thumb_file' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            ]);

            $file = $request->file('panel_project_doc_thumb_file');
            $filename = 'panel-project-thumb-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/panel-projects');
            $rootDestination = base_path('uploads/panel-projects');

            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
            }
            if (!file_exists($rootDestination)) {
                @mkdir($rootDestination, 0777, true);
            }

            $file->move($destinationPath, $filename);
            if ($rootDestination !== $destinationPath && file_exists($destinationPath . '/' . $filename)) {
                @copy($destinationPath . '/' . $filename, $rootDestination . '/' . $filename);
            }

            SiteSetting::set('panel_project_doc_thumbnail', '/uploads/panel-projects/' . $filename);
        }

        AuditLog::log('UPDATE', 'SiteSetting', null, ['keys' => array_keys($request->except('_token'))]);

        return back()->with('success', 'Pengaturan website, Company Profile, dan Dokumen Proyek Panel berhasil diperbarui.');
    }

    /**
     * Helper to decode and save a base64 image (from client-side PDF.js Page 1 extraction).
     */
    private function saveBase64Image(string $base64Data, string $destinationDir, string $prefix): ?string
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
            $data = substr($base64Data, strpos($base64Data, ',') + 1);
            $data = base64_decode($data);
            if ($data !== false && strlen($data) > 100) {
                if (!file_exists($destinationDir)) {
                    @mkdir($destinationDir, 0777, true);
                }
                $ext = strtolower($type[1]) === 'png' ? 'png' : 'jpg';
                $filename = $prefix . '-' . time() . '.' . $ext;
                @file_put_contents($destinationDir . '/' . $filename, $data);

                $rootDestination = str_replace(public_path('uploads'), base_path('uploads'), $destinationDir);
                if ($rootDestination !== $destinationDir) {
                    if (!file_exists($rootDestination)) {
                        @mkdir($rootDestination, 0777, true);
                    }
                    @file_put_contents($rootDestination . '/' . $filename, $data);
                }

                return $filename;
            }
        }
        return null;
    }

    /**
     * Helper to extract thumbnail using Imagick if installed on the host.
     */
    private function generateThumbnailFromPdfServer(string $pdfPath, string $destinationDir, string $prefix): ?string
    {
        if (!class_exists('\Imagick')) {
            return null;
        }
        try {
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }
            $imagick = new \Imagick();
            $imagick->setResolution(150, 150);
            $imagick->readImage($pdfPath . '[0]');
            $imagick->setImageFormat('webp');
            $imagick->setImageCompressionQuality(85);
            $filename = $prefix . '-' . time() . '.webp';
            $imagick->writeImage($destinationDir . '/' . $filename);
            $imagick->clear();
            $imagick->destroy();
            return $filename;
        } catch (\Throwable $e) {
            \Log::warning('Imagick PDF thumbnail generation skipped: ' . $e->getMessage());
            return null;
        }
    }
}
