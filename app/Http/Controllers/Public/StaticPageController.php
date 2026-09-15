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
                'logo'        => asset('images/customers/indofood.png'),
                'subtitle'    => 'Schneider Automation & Inverter Line',
                'description' => 'Pasokan berkelanjutan inverter Schneider Altivar ATV630 dan sistem proteksi motor industri berat.',
            ],
            [
                'id'          => 2,
                'name'        => 'Pakuwon Group',
                'tag'         => 'Property Superblock & Commercial',
                'logo'        => asset('images/customers/pakuwon.png'),
                'subtitle'    => 'Mega Superblock & Distribution Switchgear',
                'description' => 'Main distribution switchboard dan MasterPact MTZ/NW Air Circuit Breakers pada superblok komersial.',
            ],
            [
                'id'          => 3,
                'name'        => 'Dua Kelinci',
                'tag'         => 'Food Manufacturing',
                'logo'        => asset('images/customers/dua-kelinci.png'),
                'subtitle'    => 'Motor Protection & TeSys Control',
                'description' => 'Komponen kendali otomasi lini produksi dan magnetic contactor TeSys performa tinggi.',
            ],
            [
                'id'          => 4,
                'name'        => 'Bumi Menara Internusa',
                'tag'         => 'Cold Storage & Export Processing',
                'logo'        => asset('images/customers/bmi.png'),
                'subtitle'    => 'Power Quality & Weatherproof Panels',
                'description' => 'Komponen elektrikal industri heavy-duty dan enclosure tahan cuaca Legrand Plexo IP66.',
            ],
            [
                'id'          => 5,
                'name'        => 'Charoen Pokphand',
                'tag'         => 'Agro-Industry & Feedmill',
                'logo'        => asset('images/customers/pokphand.png'),
                'subtitle'    => 'Feedmill Control & Distribution Panels',
                'description' => 'Kontaktor daya kapasitas tinggi dan panel distribusi daya terintegrasi pabrik modern.',
            ],
        ];

        $brands = Brand::active()->with('logo')->orderBy('sort_order')->get();
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
        $brands = Brand::active()->orderBy('sort_order')->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('public.panel-maker', compact('projects', 'certificates', 'brands', 'settings'));
    }
}
