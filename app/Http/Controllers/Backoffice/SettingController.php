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
                'master_price_list_file' => 'mimes:pdf|max:51200', // up to 50MB
            ]);

            $file = $request->file('master_price_list_file');
            $filename = 'master-price-list-' . time() . '.pdf';
            $destinationPath = public_path('uploads/price-lists');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            SiteSetting::set('master_price_list_pdf', asset('uploads/price-lists/' . $filename));
            SiteSetting::set('master_price_list_size', round($file->getSize() / (1024 * 1024), 2) . ' MB');
        }

        // Handle Manual Upload of Company Profile (Compro) PDF
        if ($request->hasFile('company_profile_file')) {
            $request->validate([
                'company_profile_file' => 'mimes:pdf|max:51200', // up to 50MB
            ]);

            $file = $request->file('company_profile_file');
            $filename = 'company-profile-ats-' . time() . '.pdf';
            $destinationPath = public_path('uploads/compro');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            SiteSetting::set('company_profile_pdf', asset('uploads/compro/' . $filename));
            SiteSetting::set('company_profile_size', round($file->getSize() / (1024 * 1024), 2) . ' MB');
        }

        // Handle Thumbnail Upload of Company Profile (Compro)
        if ($request->hasFile('company_profile_thumb_file')) {
            $request->validate([
                'company_profile_thumb_file' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            $file = $request->file('company_profile_thumb_file');
            $filename = 'compro-thumb-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/compro');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            SiteSetting::set('company_profile_thumbnail', asset('uploads/compro/' . $filename));
        }

        // Handle Manual Upload of ATS Panel Project PDF
        if ($request->hasFile('panel_project_doc_file')) {
            $request->validate([
                'panel_project_doc_file' => 'mimes:pdf|max:51200', // up to 50MB
            ]);

            $file = $request->file('panel_project_doc_file');
            $filename = 'panel-project-ats-' . time() . '.pdf';
            $destinationPath = public_path('uploads/panel-projects');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            SiteSetting::set('panel_project_doc_pdf', asset('uploads/panel-projects/' . $filename));
            SiteSetting::set('panel_project_doc_size', round($file->getSize() / (1024 * 1024), 2) . ' MB');
        }

        // Handle Thumbnail Upload of ATS Panel Project
        if ($request->hasFile('panel_project_doc_thumb_file')) {
            $request->validate([
                'panel_project_doc_thumb_file' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            $file = $request->file('panel_project_doc_thumb_file');
            $filename = 'panel-project-thumb-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/panel-projects');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            SiteSetting::set('panel_project_doc_thumbnail', asset('uploads/panel-projects/' . $filename));
        }

        AuditLog::log('UPDATE', 'SiteSetting', null, ['keys' => array_keys($request->except('_token'))]);

        return back()->with('success', 'Pengaturan website, Company Profile, dan Dokumen Proyek Panel berhasil diperbarui.');
    }
}
