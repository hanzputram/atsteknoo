<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->orderBy('sort_order')->orderBy('name')->get();

        return view('backoffice.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('backoffice.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:64', 'unique:brands,code'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:brands,slug'],
            'logo' => ['nullable', 'image', 'max:5120'],
            'website_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $logoId = null;
        if ($request->hasFile('logo')) {
            $media = MediaService::storeUpload($request->file('logo'), 'image');
            $logoId = $media->id;
        }

        $brand = Brand::create([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'logo_id' => $logoId,
            'logo_alt' => $request->name . ' Logo',
            'description_html' => $request->description_html,
            'website_url' => $request->website_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('CREATE', 'Brand', $brand->id, ['code' => $brand->code, 'name' => $brand->name]);

        return redirect()->route('backoffice.brands.index')->with('success', "Brand '{$brand->name}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $brand = Brand::with('logo')->findOrFail($id);

        return view('backoffice.brands.edit', compact('brand'));
    }

    public function update(Request $request, int $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'code' => ['required', 'string', 'max:64', Rule::unique('brands', 'code')->ignore($brand->id)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('brands', 'slug')->ignore($brand->id)],
            'website_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $logoId = $brand->logo_id;
        if ($request->hasFile('logo')) {
            $media = MediaService::storeUpload($request->file('logo'), 'image');
            $logoId = $media->id;
        }

        $brand->update([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : $brand->slug,
            'logo_id' => $logoId,
            'logo_alt' => $request->name . ' Logo',
            'description_html' => $request->description_html,
            'website_url' => $request->website_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('UPDATE', 'Brand', $brand->id, ['code' => $brand->code, 'name' => $brand->name]);

        return redirect()->route('backoffice.brands.index')->with('success', "Brand '{$brand->name}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $brand = Brand::withCount('products')->findOrFail($id);

        if ($brand->products_count > 0) {
            return back()->withErrors(['brand' => "Brand '{$brand->name}' masih direferensikan oleh {$brand->products_count} produk dan tidak dapat dihapus."]);
        }

        $name = $brand->name;
        $brand->delete();

        AuditLog::log('DELETE', 'Brand', $brand->id, ['name' => $name]);

        return redirect()->route('backoffice.brands.index')->with('success', "Brand '{$name}' berhasil dihapus.");
    }
}
