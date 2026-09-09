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
    public function show(string $slug)
    {
        $category = ProductCategory::active()
            ->with(['children' => fn ($q) => $q->active()])
            ->where('slug', $slug)
            ->firstOrFail();

        $products = $category->products()
            ->published()
            ->with(['brand', 'mainImage'])
            ->paginate(24);

        return view('public.product-categories.show', compact('category', 'products'));
    }
}
