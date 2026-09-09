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
            ->take(8)
            ->get();

        $brands = Brand::active()
            ->with('logo')
            ->orderBy('sort_order')
            ->take(14)
            ->get();

        $projects = Project::published()
            ->with(['category', 'coverImage'])
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $articles = Article::published()
            ->with(['category', 'thumbnail', 'author'])
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('app', compact('featuredProducts', 'brands', 'projects', 'articles'));
    }
}
