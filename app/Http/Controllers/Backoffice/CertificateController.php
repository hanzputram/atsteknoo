<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('sort_order')->orderBy('title')->get();

        return view('backoffice.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('backoffice.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'partner_name' => ['required', 'string', 'max:128'],
            'badge_text'   => ['nullable', 'string', 'max:64'],
            'description'  => ['nullable', 'string'],
            'image'        => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'], // up to 10MB
            'file_url'     => ['nullable', 'url', 'max:500'],
            'sort_order'   => ['nullable', 'integer'],
            'is_active'    => ['nullable', 'boolean'],
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'cert-' . Str::slug($request->partner_name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('uploads/certificates');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $imagePath = 'uploads/certificates/' . $filename;
        }

        $certificate = Certificate::create([
            'title'        => trim($request->title),
            'partner_name' => trim($request->partner_name),
            'badge_text'   => trim($request->badge_text ?: 'VERIFIED PARTNER'),
            'description'  => $request->description,
            'image_path'   => $imagePath,
            'file_url'     => $request->file_url,
            'sort_order'   => (int) $request->input('sort_order', 0),
            'is_active'    => $request->boolean('is_active', true),
            'created_by'   => auth()->id(),
        ]);

        AuditLog::log('CREATE', 'Certificate', $certificate->id, ['title' => $certificate->title]);

        return redirect()->route('backoffice.certificates.index')->with('success', "Sertifikat '{$certificate->title}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $certificate = Certificate::findOrFail($id);

        return view('backoffice.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, int $id)
    {
        $certificate = Certificate::findOrFail($id);

        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'partner_name' => ['required', 'string', 'max:128'],
            'badge_text'   => ['nullable', 'string', 'max:64'],
            'description'  => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
            'file_url'     => ['nullable', 'url', 'max:500'],
            'sort_order'   => ['nullable', 'integer'],
            'is_active'    => ['nullable', 'boolean'],
        ]);

        $imagePath = $certificate->image_path;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'cert-' . Str::slug($request->partner_name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('uploads/certificates');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $imagePath = 'uploads/certificates/' . $filename;
        }

        $certificate->update([
            'title'        => trim($request->title),
            'partner_name' => trim($request->partner_name),
            'badge_text'   => trim($request->badge_text ?: 'VERIFIED PARTNER'),
            'description'  => $request->description,
            'image_path'   => $imagePath,
            'file_url'     => $request->file_url,
            'sort_order'   => (int) $request->input('sort_order', 0),
            'is_active'    => $request->boolean('is_active', true),
            'updated_by'   => auth()->id(),
        ]);

        AuditLog::log('UPDATE', 'Certificate', $certificate->id, ['title' => $certificate->title]);

        return redirect()->route('backoffice.certificates.index')->with('success', "Sertifikat '{$certificate->title}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $certificate = Certificate::findOrFail($id);
        $title = $certificate->title;
        $certificate->delete();

        AuditLog::log('DELETE', 'Certificate', $id, ['title' => $title]);

        return redirect()->route('backoffice.certificates.index')->with('success', "Sertifikat '{$title}' berhasil dihapus.");
    }
}
