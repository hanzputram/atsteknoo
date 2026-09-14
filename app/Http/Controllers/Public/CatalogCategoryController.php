<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CatalogCategoryController extends Controller
{
    /**
     * Display category page with subcategories and published products.
     */
    public function show(Request $request, string $slug)
    {
        $category = ProductCategory::active()
            ->with(['children' => fn ($q) => $q->active()])
            ->where('slug', $slug)
            ->firstOrFail();

        $perPage = (int) $request->input('per_page', 25);
        if ($perPage < 1 || $perPage > 100) {
            $perPage = 25;
        }

        $products = $category->products()
            ->published()
            ->with(['brand', 'mainImage'])
            ->paginate($perPage)
            ->withQueryString();

        return view('public.product-categories.show', compact('category', 'products'));
    }
}
