<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{
    /**
     * Display the public product catalog with search, filters, and pagination.
     */
    public function index(Request $request)
    {
        $query = Product::published()->with(['brand', 'primaryCategory', 'mainImage']);

        // Search by name or SKU
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Filter by Brand
        if ($brandSlug = $request->input('brand')) {
            $query->whereHas('brand', function ($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            });
        }

        // Filter by Category
        if ($catSlug = $request->input('category')) {
            $query->whereHas('categories', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        // Allowed sorting columns
        $sortOption = $request->input('sort', 'newest');
        switch ($sortOption) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'sku_asc':
                $query->orderBy('sku', 'asc');
                break;
            default:
                $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
                break;
        }

        // 24 items per page (strictly without unbounded 'all')
        $products = $query->paginate(24)->withQueryString();

        $brands = Brand::active()->orderBy('name')->get();
        $categories = ProductCategory::active()->whereNull('parent_id')->with('children')->orderBy('sort_order')->get();

        return view('public.products.index', compact('products', 'brands', 'categories'));
    }

    /**
     * Display individual product detail with gallery, specs, and related items.
     */
    public function show(string $slug)
    {
        $product = Product::published()
            ->with([
                'brand',
                'categories',
                'primaryCategory',
                'mainImage',
                'datasheet',
                'specifications',
                'galleryUsages.media',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        // Related products from same category or brand
        $relatedProducts = Product::published()
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                if ($product->primary_category_id) {
                    $q->where('primary_category_id', $product->primary_category_id);
                }
                if ($product->brand_id) {
                    $q->orWhere('brand_id', $product->brand_id);
                }
            })
            ->take(4)
            ->get();

        return view('public.products.show', compact('product', 'relatedProducts'));
    }
}
