<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\MediaAsset;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Services\HtmlSanitizerService;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'primaryCategory', 'mainImage']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($brandId = $request->input('brand_id')) {
            $query->where('brand_id', $brandId);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('product_categories.id', $categoryId);
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $sortField = in_array($request->input('sort'), ['name', 'sku', 'updated_at'], true) ? $request->input('sort') : 'updated_at';
        $sortOrder = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $products = $query->orderBy($sortField, $sortOrder)->paginate(20)->withQueryString();

        $brands = Brand::orderBy('name')->get();
        $categories = ProductCategory::orderBy('name')->get();

        return view('backoffice.products.index', compact('products', 'brands', 'categories'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $categories = ProductCategory::orderBy('name')->get();

        return view('backoffice.products.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $normalizedSku = Product::normalizeSku($request->input('sku', ''));

        $request->validate([
            'sku' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:products,slug'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description_html' => ['nullable', 'string'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['exists:product_categories,id'],
            'primary_category_id' => ['nullable', 'exists:product_categories,id'],
            'main_image' => ['nullable', 'image', 'max:10240'],
            'datasheet' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        // Check normalized SKU uniqueness
        if (Product::where('normalized_sku', $normalizedSku)->exists()) {
            return back()->withInput()->withErrors(['sku' => "SKU '{$request->sku}' sudah digunakan oleh produk lain."]);
        }

        // Handle Image Uploads
        $mainImageId = null;
        if ($request->hasFile('main_image')) {
            $media = MediaService::storeUpload($request->file('main_image'), 'image');
            $mainImageId = $media->id;
        }

        $datasheetId = null;
        if ($request->hasFile('datasheet')) {
            $mediaDoc = MediaService::storeUpload($request->file('datasheet'), 'document');
            $datasheetId = $mediaDoc->id;
        }

        // Sanitize WYSIWYG
        $cleanDescription = HtmlSanitizerService::clean($request->input('description_html'));

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name') . '-' . $request->input('sku'));

        // Publish validation checks
        if ($request->status === 'published') {
            if (empty($cleanDescription)) {
                return back()->withInput()->withErrors(['description_html' => 'Deskripsi substantif wajib diisi sebelum produk dipublikasikan.']);
            }
            if (!$request->brand_id) {
                return back()->withInput()->withErrors(['brand_id' => 'Brand wajib dipilih sebelum produk dipublikasikan.']);
            }
            if (empty($request->category_ids)) {
                return back()->withInput()->withErrors(['category_ids' => 'Minimal satu kategori wajib dipilih sebelum produk dipublikasikan.']);
            }
        }

        $product = Product::create([
            'sku' => trim($request->sku),
            'normalized_sku' => $normalizedSku,
            'name' => trim($request->name),
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description_html' => $cleanDescription,
            'brand_id' => $request->brand_id,
            'primary_category_id' => $request->primary_category_id ?: ($request->category_ids[0] ?? null),
            'main_image_id' => $mainImageId,
            'datasheet_id' => $datasheetId,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => (int) $request->input('sort_order', 0),
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        // Sync categories
        if ($request->filled('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $idx = 0;
            foreach ($request->file('gallery_images') as $gFile) {
                $gMedia = MediaService::storeUpload($gFile, 'image');
                MediaService::attach($gMedia->id, Product::class, $product->id, 'gallery', $idx, $product->name . ' - ' . ($idx + 1));
                $idx++;
            }
        }

        // Save technical specifications
        if ($request->filled('specs')) {
            foreach ($request->input('specs') as $spec) {
                $label = trim($spec['label'] ?? '');
                $code = !empty($spec['attribute_code']) ? trim($spec['attribute_code']) : Str::slug($label, '_');
                if (!empty($code) && !empty($label)) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'attribute_code' => $code,
                        'label' => $label,
                        'value' => trim($spec['value'] ?? ''),
                        'unit' => trim($spec['unit'] ?? '') ?: null,
                        'group' => trim($spec['group'] ?? '') ?: null,
                        'sort_order' => (int) ($spec['sort_order'] ?? 0),
                    ]);
                }
            }
        }

        AuditLog::log('CREATE', 'Product', $product->id, ['sku' => $product->sku, 'name' => $product->name]);

        return redirect()->route('backoffice.products.index')->with('success', "Produk '{$product->name}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $product = Product::with(['brand', 'categories', 'primaryCategory', 'specifications', 'galleryUsages.media', 'mainImage', 'datasheet'])->findOrFail($id);
        $brands = Brand::orderBy('name')->get();
        $categories = ProductCategory::orderBy('name')->get();

        return view('backoffice.products.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $normalizedSku = Product::normalizeSku($request->input('sku', ''));

        // Concurrency check
        if ($request->filled('lock_version') && (int) $request->lock_version !== $product->lock_version) {
            return back()->withInput()->withErrors([
                'concurrency' => 'Record ini telah diperbarui oleh pengguna lain sejak Anda membukanya. Silakan muat ulang halaman.',
            ]);
        }

        $request->validate([
            'sku' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('products', 'slug')->ignore($product->id)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description_html' => ['nullable', 'string'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_ids' => ['nullable', 'array'],
            'primary_category_id' => ['nullable', 'exists:product_categories,id'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        // SKU Uniqueness check
        $existing = Product::where('normalized_sku', $normalizedSku)->where('id', '!=', $product->id)->first();
        if ($existing) {
            return back()->withInput()->withErrors(['sku' => "SKU '{$request->sku}' sudah digunakan oleh produk lain."]);
        }

        // Upload replacements
        $mainImageId = $product->main_image_id;
        if ($request->hasFile('main_image')) {
            $media = MediaService::storeUpload($request->file('main_image'), 'image');
            $mainImageId = $media->id;
        }

        $datasheetId = $product->datasheet_id;
        if ($request->hasFile('datasheet')) {
            $mediaDoc = MediaService::storeUpload($request->file('datasheet'), 'document');
            $datasheetId = $mediaDoc->id;
        }

        $cleanDescription = HtmlSanitizerService::clean($request->input('description_html'));

        // Publish condition check
        if ($request->status === 'published') {
            if (empty($cleanDescription)) {
                return back()->withInput()->withErrors(['description_html' => 'Deskripsi substantif wajib diisi sebelum produk dipublikasikan.']);
            }
            if (!$request->brand_id) {
                return back()->withInput()->withErrors(['brand_id' => 'Brand wajib dipilih sebelum produk dipublikasikan.']);
            }
            if (empty($request->category_ids)) {
                return back()->withInput()->withErrors(['category_ids' => 'Minimal satu kategori wajib dipilih sebelum produk dipublikasikan.']);
            }
        }

        $publishedAt = $product->published_at;
        if ($request->status === 'published' && !$publishedAt) {
            $publishedAt = now();
        }

        $product->update([
            'sku' => trim($request->sku),
            'normalized_sku' => $normalizedSku,
            'name' => trim($request->name),
            'slug' => $request->input('slug') ? Str::slug($request->input('slug')) : $product->slug,
            'short_description' => $request->short_description,
            'description_html' => $cleanDescription,
            'brand_id' => $request->brand_id,
            'primary_category_id' => $request->primary_category_id ?: ($request->category_ids[0] ?? null),
            'main_image_id' => $mainImageId,
            'datasheet_id' => $datasheetId,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => (int) $request->input('sort_order', 0),
            'status' => $request->status,
            'published_at' => $publishedAt,
            'lock_version' => $product->lock_version + 1,
            'updated_by' => auth()->id(),
        ]);

        // Sync categories
        $product->categories()->sync($request->category_ids ?? []);

        // Add additional gallery images if uploaded
        if ($request->hasFile('gallery_images')) {
            $currentMax = $product->galleryUsages()->max('sort_order') ?? -1;
            foreach ($request->file('gallery_images') as $gFile) {
                $currentMax++;
                $gMedia = MediaService::storeUpload($gFile, 'image');
                MediaService::attach($gMedia->id, Product::class, $product->id, 'gallery', $currentMax, $product->name);
            }
        }

        // Sync specifications
        $product->specifications()->delete();
        if ($request->filled('specs')) {
            foreach ($request->input('specs') as $spec) {
                if (!empty($spec['attribute_code']) && !empty($spec['label'])) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'attribute_code' => trim($spec['attribute_code']),
                        'label' => trim($spec['label']),
                        'value' => trim($spec['value'] ?? ''),
                        'unit' => trim($spec['unit'] ?? '') ?: null,
                        'group' => trim($spec['group'] ?? '') ?: null,
                        'sort_order' => (int) ($spec['sort_order'] ?? 0),
                    ]);
                }
            }
        }

        AuditLog::log('UPDATE', 'Product', $product->id, ['sku' => $product->sku, 'name' => $product->name]);

        return redirect()->route('backoffice.products.index')->with('success', "Produk '{$product->name}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        $product->delete();

        AuditLog::log('DELETE', 'Product', $product->id, ['sku' => $product->sku, 'name' => $name]);

        return redirect()->route('backoffice.products.index')->with('success', "Produk '{$name}' berhasil dihapus.");
    }
}
