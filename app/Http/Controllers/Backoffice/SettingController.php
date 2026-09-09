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
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        AuditLog::log('UPDATE', 'SiteSetting', null, ['keys' => array_keys($request->except('_token'))]);

        return back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
