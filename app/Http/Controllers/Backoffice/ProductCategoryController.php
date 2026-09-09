<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ProductCategory;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with('parent')->withCount('products')->orderBy('sort_order')->orderBy('name')->get();

        return view('backoffice.product-categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = ProductCategory::whereNull('parent_id')->orderBy('name')->get();

        return view('backoffice.product-categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:64', 'unique:product_categories,code'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:product_categories,slug'],
            'parent_id' => ['nullable', 'exists:product_categories,id'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imageId = null;
        if ($request->hasFile('image')) {
            $media = MediaService::storeUpload($request->file('image'), 'image');
            $imageId = $media->id;
        }

        $cat = ProductCategory::create([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'image_id' => $imageId,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('CREATE', 'ProductCategory', $cat->id, ['code' => $cat->code, 'name' => $cat->name]);

        return redirect()->route('backoffice.product-categories.index')->with('success', "Kategori '{$cat->name}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $category = ProductCategory::findOrFail($id);
        $parents = ProductCategory::where('id', '!=', $category->id)->whereNull('parent_id')->orderBy('name')->get();

        return view('backoffice.product-categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, int $id)
    {
        $category = ProductCategory::findOrFail($id);

        $request->validate([
            'code' => ['required', 'string', 'max:64', Rule::unique('product_categories', 'code')->ignore($category->id)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('product_categories', 'slug')->ignore($category->id)],
            'parent_id' => ['nullable', 'exists:product_categories,id', Rule::notIn([$category->id])],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $imageId = $category->image_id;
        if ($request->hasFile('image')) {
            $media = MediaService::storeUpload($request->file('image'), 'image');
            $imageId = $media->id;
        }

        $category->update([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : $category->slug,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'image_id' => $imageId,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('UPDATE', 'ProductCategory', $category->id, ['code' => $category->code, 'name' => $category->name]);

        return redirect()->route('backoffice.product-categories.index')->with('success', "Kategori '{$category->name}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $category = ProductCategory::withCount('products')->findOrFail($id);

        if ($category->products_count > 0) {
            return back()->withErrors(['category' => "Kategori '{$category->name}' masih memiliki {$category->products_count} produk dan tidak dapat dihapus."]);
        }

        $name = $category->name;
        $category->delete();

        AuditLog::log('DELETE', 'ProductCategory', $category->id, ['name' => $name]);

        return redirect()->route('backoffice.product-categories.index')->with('success', "Kategori '{$name}' berhasil dihapus.");
    }
}
