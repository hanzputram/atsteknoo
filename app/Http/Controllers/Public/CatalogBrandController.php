<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class CatalogBrandController extends Controller
{
    /**
     * Display directory of authorized brands.
     */
    public function index()
    {
        $brands = Brand::active()->with('logo')->orderBy('sort_order')->orderBy('name')->get();

        return view('public.brands.index', compact('brands'));
    }

    /**
     * Display brand profile and its catalog of products.
     */
    public function show(string $slug)
    {
        $brand = Brand::active()->with('logo')->where('slug', $slug)->firstOrFail();

        $products = $brand->products()
            ->published()
            ->with(['primaryCategory', 'mainImage'])
            ->paginate(24);

        return view('public.brands.show', compact('brand', 'products'));
    }
}
