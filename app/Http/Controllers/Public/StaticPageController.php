<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Page;
use App\Models\SiteSetting;

class StaticPageController extends Controller
{
    /**
     * Display the About Us page with corporate profile, vision/mission, and partner brands.
     */
    public function about()
    {
        $page = Page::where('page_key', 'about-us')->first();
        $brands = Brand::active()->with('logo')->orderBy('sort_order')->get();

        return view('public.about', compact('page', 'brands'));
    }
}
