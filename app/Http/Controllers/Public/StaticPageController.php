<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Certificate;
use App\Models\Page;
use App\Models\Project;
use App\Models\SiteSetting;

class StaticPageController extends Controller
{
    /**
     * Display the About Us page with corporate profile, vision/mission, certificates, and partner brands.
     */
    public function about()
    {
        $page = Page::where('page_key', 'about-us')->first();
        $customers = [
            [
                'id'          => 1,
                'name'        => 'Indofood Sukses Makmur',
                'tag'         => 'FMCG & Industrial Processing',
                'logo'        => asset('images/customers/indofood.webp'),
                'subtitle'    => 'Schneider Automation & Inverter Line',
                'description' => 'Pasokan berkelanjutan inverter Schneider Altivar ATV630 dan sistem proteksi motor industri berat.',
            ],
            [
                'id'          => 2,
                'name'        => 'Pakuwon Group',
                'tag'         => 'Property Superblock & Commercial',
                'logo'        => asset('images/customers/pakuwon.webp'),
                'subtitle'    => 'Mega Superblock & Distribution Switchgear',
                'description' => 'Main distribution switchboard dan MasterPact MTZ/NW Air Circuit Breakers pada superblok komersial.',
            ],
            [
                'id'          => 3,
                'name'        => 'Dua Kelinci',
                'tag'         => 'Food Manufacturing',
                'logo'        => asset('images/customers/dua-kelinci.webp'),
                'subtitle'    => 'Motor Protection & TeSys Control',
                'description' => 'Komponen kendali otomasi lini produksi dan magnetic contactor TeSys performa tinggi.',
            ],
            [
                'id'          => 4,
                'name'        => 'Bumi Menara Internusa',
                'tag'         => 'Cold Storage & Export Processing',
                'logo'        => asset('images/customers/bmi.webp'),
                'subtitle'    => 'Power Quality & Weatherproof Panels',
                'description' => 'Komponen elektrikal industri heavy-duty dan enclosure tahan cuaca Legrand Plexo IP66.',
            ],
            [
                'id'          => 5,
                'name'        => 'Charoen Pokphand',
                'tag'         => 'Agro-Industry & Feedmill',
                'logo'        => asset('images/customers/pokphand.webp'),
                'subtitle'    => 'Feedmill Control & Distribution Panels',
                'description' => 'Kontaktor daya kapasitas tinggi dan panel distribusi daya terintegrasi pabrik modern.',
            ],
        ];

        $brands = Brand::active()
            ->whereNotIn('slug', ['fort'])
            ->where('name', 'not like', 'fort')
            ->with('logo')
            ->orderBy('sort_order')
            ->get();
        $certificates = Certificate::active()->orderBy('sort_order')->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('public.about', compact('page', 'brands', 'customers', 'certificates', 'settings'));
    }

    /**
     * Display the Jasa Pembuatan Panel Listrik (Switchboard Panel Builder) service landing page.
     */
    public function panelMaker()
    {
        $projects = Project::published()->with(['coverImage', 'category'])->latest()->take(6)->get();
        $certificates = Certificate::active()->orderBy('sort_order')->get();
        $brands = Brand::active()
            ->whereNotIn('slug', ['fort'])
            ->where('name', 'not like', 'fort')
            ->orderBy('sort_order')
            ->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('public.panel-maker', compact('projects', 'certificates', 'brands', 'settings'));
    }

    /**
     * Display the dedicated high-authority landing page for Distributor Alat Listrik Surabaya.
     */
    public function distributorAlatListrikSurabaya()
    {
        $brands = \App\Models\Brand::active()
            ->whereNotIn('slug', ['fort'])
            ->where('name', 'not like', 'fort')
            ->with('logo')
            ->orderBy('sort_order')
            ->get();

        $categories = \App\Models\ProductCategory::active()
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = \App\Models\Product::published()
            ->with(['brand', 'primaryCategory', 'mainImage'])
            ->where('is_featured', true)
            ->take(8)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = \App\Models\Product::published()
                ->with(['brand', 'primaryCategory', 'mainImage'])
                ->take(8)
                ->get();
        }

        $projects = Project::published()
            ->with(['category', 'coverImage'])
            ->latest()
            ->take(6)
            ->get();

        $certificates = Certificate::active()->orderBy('sort_order')->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('public.distributor-alat-listrik-surabaya', compact(
            'brands',
            'categories',
            'featuredProducts',
            'projects',
            'certificates',
            'settings'
        ));
    }
}

