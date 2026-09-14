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

        abort(404);
    }
}
