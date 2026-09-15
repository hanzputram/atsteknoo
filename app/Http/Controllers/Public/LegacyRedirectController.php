<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LegacyRedirectController extends Controller
{
    /**
     * Map of known legacy WordPress paths to their new canonical routes.
     */
    protected array $legacyMap = [
        'distributor-schneider-electric-surabaya' => 'brands.schneider',
        'distributor-schneider-surabaya' => 'brands.schneider',
        'distributor-schneider' => 'brands.schneider',
        'schneider' => 'brands.schneider',
        'schneider-electric' => 'brands.schneider',
        'tentang-kami' => 'about.index',
        'about' => 'about.index',
        'profil-perusahaan' => 'about.index',
        'company-profile' => 'about.index',
        'kontak' => 'contact.index',
        'hubungi-kami' => 'contact.index',
        'hubungi' => 'contact.index',
        'produk' => 'products.index',
        'katalog' => 'products.index',
        'katalog-produk' => 'products.index',
        'shop' => 'products.index',
        'daftar-harga' => 'price-list.index',
        'pricelist' => 'price-list.index',
        'katalog-harga' => 'price-list.index',
        'proyek' => 'projects.index',
        'portofolio' => 'projects.index',
        'project' => 'projects.index',
        'blog' => 'articles.index',
        'berita' => 'articles.index',
        'artikel' => 'articles.index',
        'feed' => 'sitemap.xml',
        'rss' => 'sitemap.xml',
    ];

    /**
     * Handle legacy WordPress URLs with 301 Permanent Redirect to preserve SEO rank.
     */
    public function handle(Request $request, string $slug): RedirectResponse
    {
        $cleanSlug = strtolower(trim($slug, "/ \t\n\r\0\x0B"));

        // 1. Check known static legacy alias map
        if (isset($this->legacyMap[$cleanSlug])) {
            $target = $this->legacyMap[$cleanSlug];
            if ($target === 'brands.schneider') {
                return redirect()->route('brands.show', 'schneider-electric', 301);
            }
            return redirect()->route($target, [], 301);
        }

        // 2. Check Article by slug
        if (Article::where('slug', $cleanSlug)->exists()) {
            return redirect()->route('articles.show', $cleanSlug, 301);
        }

        // 3. Check Brand by slug
        if (Brand::where('slug', $cleanSlug)->exists()) {
            return redirect()->route('brands.show', $cleanSlug, 301);
        }

        // 4. Check ProductCategory by slug
        if (ProductCategory::where('slug', $cleanSlug)->exists()) {
            return redirect()->route('product-categories.show', $cleanSlug, 301);
        }

        // 5. Check Product by slug
        if (Product::where('slug', $cleanSlug)->exists()) {
            return redirect()->route('products.show', $cleanSlug, 301);
        }

        // 6. Check Product by SKU (case-insensitive for legacy WordPress URLs like /LC1K0910M7)
        $productBySku = Product::whereRaw('LOWER(sku) = ?', [strtolower($cleanSlug)])->first();
        if ($productBySku) {
            return redirect()->route('products.show', $productBySku->slug, 301);
        }

        abort(404);
    }

    /**
     * Handle legacy WordPress /product/{slug} URLs with strict 301 or 404.
     */
    public function handleProduct(Request $request, string $slug): RedirectResponse
    {
        $cleanSlug = strtolower(trim($slug, "/ \t\n\r\0\x0B"));

        // 1. Exact match by slug in modern products table
        $product = Product::where('slug', $cleanSlug)->first();
        if ($product) {
            return redirect()->route('products.show', $product->slug, 301);
        }

        // 2. Exact match by SKU (e.g. /product/DOMF01106 or /product/lc1d09bd)
        $productBySku = Product::whereRaw('LOWER(sku) = ?', [$cleanSlug])->first();
        if ($productBySku) {
            return redirect()->route('products.show', $productBySku->slug, 301);
        }

        // 3. Extract tokens from legacy slug (e.g. schneider-lc1k0910m7-kontrol-ac-9a-n-o-220-vac)
        // Check if any token matches an authoritative SKU in products
        $tokens = preg_split('/[^a-z0-9]+/i', $cleanSlug);
        foreach ($tokens as $token) {
            $token = trim($token);
            // SKUs in electrical catalog are alphanumeric and usually >= 5 chars
            if (strlen($token) >= 5) {
                $matched = Product::whereRaw('LOWER(sku) = ?', [strtolower($token)])->first();
                if ($matched) {
                    return redirect()->route('products.show', $matched->slug, 301);
                }
            }
        }

        // 4. Per SEO audit specifications: no generic guess or soft 404 to homepage.
        // Return real HTTP 404 for removed/missing products without valid replacement.
        abort(404);
    }

    /**
     * Handle legacy WordPress /product-category/{slug} URLs with 301 or 404.
     */
    public function handleCategory(Request $request, string $slug): RedirectResponse
    {
        $cleanSlug = strtolower(trim($slug, "/ \t\n\r\0\x0B"));

        $category = ProductCategory::where('slug', $cleanSlug)->first();
        if ($category) {
            return redirect()->route('product-categories.show', $category->slug, 301);
        }

        // Keyword mapping for common legacy WordPress category slugs
        if (str_contains($cleanSlug, 'mcb') || str_contains($cleanSlug, 'mccb') || str_contains($cleanSlug, 'breaker') || str_contains($cleanSlug, 'distribution')) {
            return redirect()->route('product-categories.show', 'power-distribution-circuit-breakers', 301);
        }
        if (str_contains($cleanSlug, 'motor') || str_contains($cleanSlug, 'starter') || str_contains($cleanSlug, 'contactor') || str_contains($cleanSlug, 'kontaktor')) {
            return redirect()->route('product-categories.show', 'motor-starting-control', 301);
        }
        if (str_contains($cleanSlug, 'inverter') || str_contains($cleanSlug, 'drive') || str_contains($cleanSlug, 'altivar')) {
            return redirect()->route('product-categories.show', 'industrial-drives-inverters', 301);
        }
        if (str_contains($cleanSlug, 'enclosure') || str_contains($cleanSlug, 'box') || str_contains($cleanSlug, 'panel') || str_contains($cleanSlug, 'wiring')) {
            return redirect()->route('product-categories.show', 'industrial-enclosures-wiring', 301);
        }
        if (str_contains($cleanSlug, 'meter') || str_contains($cleanSlug, 'power-quality') || str_contains($cleanSlug, 'pm')) {
            return redirect()->route('product-categories.show', 'metering-power-quality', 301);
        }

        abort(404);
    }
}
