<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for Google Search Console and web crawlers.
     */
    public function index(): Response
    {
        $baseUrl = url('/');

        $staticPages = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
            ['loc' => route('products.index'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
            ['loc' => route('price-list.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
            ['loc' => route('projects.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
            ['loc' => route('articles.index'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
            ['loc' => route('about.index'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
            ['loc' => route('contact.index'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
            ['loc' => route('promo.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
        ];

        $products = Product::published()
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($item) {
                return [
                    'loc' => route('products.show', $item->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : now()->toAtomString(),
                ];
            });

        $categories = ProductCategory::active()
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($item) {
                return [
                    'loc' => route('product-categories.show', $item->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : now()->toAtomString(),
                ];
            });

        $brands = Brand::active()
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($item) {
                $isSchneider = ($item->slug === 'schneider-electric');
                return [
                    'loc' => route('brands.show', $item->slug),
                    'priority' => $isSchneider ? '1.0' : '0.8',
                    'changefreq' => $isSchneider ? 'daily' : 'weekly',
                    'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : now()->toAtomString(),
                ];
            });

        $projects = Project::published()
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($item) {
                return [
                    'loc' => route('projects.show', $item->slug),
                    'priority' => '0.7',
                    'changefreq' => 'monthly',
                    'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : now()->toAtomString(),
                ];
            });

        $articles = Article::published()
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($item) {
                return [
                    'loc' => route('articles.show', $item->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : now()->toAtomString(),
                ];
            });

        $allUrls = collect($staticPages)
            ->concat($products)
            ->concat($categories)
            ->concat($brands)
            ->concat($projects)
            ->concat($articles);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        foreach ($allUrls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . $url['lastmod'] . "</lastmod>\n";
            $xml .= "    <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $url['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'X-Robots-Tag' => 'noindex',
        ]);
    }

    /**
     * Dynamic robots.txt with search and AI crawler directives.
     */
    public function robots(): Response
    {
        $sitemapUrl = url('/sitemap.xml');

        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /backoffice\n";
        $content .= "Disallow: /backoffice/*\n\n";

        $content .= "# Allow Search & Generative AI Web Crawlers\n";
        $content .= "User-agent: Googlebot\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: Google-Extended\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: GPTBot\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: ChatGPT-User\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: ClaudeBot\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: PerplexityBot\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: Applebot-Extended\n";
        $content .= "Allow: /\n\n";

        $content .= "User-agent: Bingbot\n";
        $content .= "Allow: /\n\n";

        $content .= "Sitemap: {$sitemapUrl}\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
        ]);
    }
}
