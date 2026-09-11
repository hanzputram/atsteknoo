<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Project;

class HomeController extends Controller
{
    /**
     * Display the main landing page with dynamic published content.
     */
    public function index()
    {
        $featuredProducts = Product::published()
            ->with(['brand', 'primaryCategory', 'mainImage'])
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->take(16)
            ->get();

        // Fallback: If no products are specifically marked as featured, show latest published products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::published()
                ->with(['brand', 'primaryCategory', 'mainImage'])
                ->orderBy('sort_order')
                ->orderBy('id', 'desc')
                ->take(8)
                ->get();
        }

        $bestSellerProducts = $featuredProducts;

        $brands = Brand::active()
            ->with('logo')
            ->orderBy('sort_order')
            ->take(14)
            ->get();

        $projects = Project::published()
            ->with(['category', 'coverImage'])
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->take(16)
            ->get();

        if ($projects->isEmpty()) {
            $projects = Project::published()
                ->with(['category', 'coverImage'])
                ->orderBy('sort_order')
                ->orderBy('id', 'desc')
                ->take(16)
                ->get();
        }

        $articles = Article::published()
            ->with(['category', 'thumbnail', 'author'])
            ->latest('published_at')
            ->take(7)
            ->get();

        return view('app', compact('featuredProducts', 'bestSellerProducts', 'brands', 'projects', 'articles'));
    }
}
