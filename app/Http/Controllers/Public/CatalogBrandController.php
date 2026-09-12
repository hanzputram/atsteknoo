<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\PriceList;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class CatalogBrandController extends Controller
{
    /**
     * Display directory of authorized brands and Master Price List.
     */
    public function index()
    {
        $brands = Brand::active()->with('logo')->withCount('products')->orderBy('sort_order')->orderBy('name')->get();
        $priceLists = PriceList::active()->orderBy('sort_order')->get();

        $masterPriceList = [
            'title' => SiteSetting::get('master_price_list_title', 'Master Price List Resmi PT. Anugerah Tama Sejati'),
            'description' => SiteSetting::get('master_price_list_description', 'Katalog dan daftar harga resmi lengkap untuk seluruh lini komponen distribusi daya, proteksi industri, dan instalasi kabel.'),
            'pdf_url' => SiteSetting::get('master_price_list_pdf'),
            'drive_url' => SiteSetting::get('master_price_list_drive_url'),
            'version' => SiteSetting::get('master_price_list_version', 'Edisi 2026 - Terkini'),
            'file_size' => SiteSetting::get('master_price_list_size', 'PDF Document'),
        ];

        return view('public.brands.index', compact('brands', 'masterPriceList', 'priceLists'));
    }

    /**
     * Display brand profile and its catalog of products.
     */
    public function show(Request $request, string $slug)
    {
        $brand = Brand::active()->with('logo')->where('slug', $slug)->firstOrFail();

        $perPage = (int) $request->input('per_page', 25);
        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 25;
        }

        $products = $brand->products()
            ->published()
            ->with(['primaryCategory', 'mainImage'])
            ->paginate($perPage)
            ->withQueryString();

        return view('public.brands.show', compact('brand', 'products'));
    }
}
