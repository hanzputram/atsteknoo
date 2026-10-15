<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\ListrikonlineClickLog;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListrikonlineTrackingController extends Controller
{
    /**
     * Display the ListrikOnline outbound click tracking dashboard and leaderboard.
     */
    public function index(Request $request)
    {
        // 1. Core KPIs (Cached for 30 seconds to guarantee zero lag on page load)
        $kpis = Cache::remember('listrikonline_kpis', 30, function () {
            return [
                'totalAllClicks' => (int) Product::sum('listrikonline_clicks'),
                'todayClicks' => ListrikonlineClickLog::today()->count(),
                'last7DaysClicks' => ListrikonlineClickLog::last7Days()->count(),
                'thisMonthClicks' => ListrikonlineClickLog::thisMonth()->count(),
                'totalProductsCount' => Product::count(),
                'clickedProductsCount' => Product::where('listrikonline_clicks', '>', 0)->count(),
            ];
        });

        $totalAllClicks = $kpis['totalAllClicks'];
        $todayClicks = $kpis['todayClicks'];
        $last7DaysClicks = $kpis['last7DaysClicks'];
        $thisMonthClicks = $kpis['thisMonthClicks'];
        $totalProductsCount = $kpis['totalProductsCount'];
        $clickedProductsCount = $kpis['clickedProductsCount'];

        // Top 1 Star Performer
        $topStarProduct = Product::with(['brand', 'primaryCategory'])
            ->where('listrikonline_clicks', '>', 0)
            ->orderByDesc('listrikonline_clicks')
            ->first();

        // 2. Query for Ranked Products Table
        $query = Product::with(['brand', 'primaryCategory', 'mainImage']);

        // Filter: Search
        if ($search = trim($request->input('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter: Brand
        if ($brandId = $request->input('brand_id')) {
            $query->where('brand_id', $brandId);
        }

        // Filter: Category
        if ($categoryId = $request->input('category_id')) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('product_categories.id', $categoryId);
            });
        }

        // Filter: Clicks Status
        $clicksFilter = $request->input('clicks_filter', 'with_clicks');
        if ($clicksFilter === 'with_clicks') {
            $query->where('listrikonline_clicks', '>', 0);
        } elseif ($clicksFilter === 'zero_clicks') {
            $query->where('listrikonline_clicks', 0);
        }

        // Sorting
        $sort = $request->input('sort', 'clicks_desc');
        switch ($sort) {
            case 'clicks_asc':
                $query->orderBy('listrikonline_clicks', 'asc')->orderBy('id', 'asc');
                break;
            case 'last_clicked_desc':
                $query->orderByRaw('last_clicked_at IS NULL, last_clicked_at DESC');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'sku_asc':
                $query->orderBy('sku', 'asc');
                break;
            case 'clicks_desc':
            default:
                $query->orderBy('listrikonline_clicks', 'desc')->orderByRaw('last_clicked_at IS NULL, last_clicked_at DESC');
                break;
        }

        $perPage = (int) $request->input('per_page', 25);
        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 25;
        }

        $products = $query->paginate($perPage)->withQueryString();

        // 3. Recent Real-Time Click Logs Feed
        $recentLogs = ListrikonlineClickLog::with('product')
            ->latest('created_at')
            ->take(30)
            ->get();

        // 4. Dropdown options
        $brands = Brand::orderBy('name')->get();
        $categories = ProductCategory::orderBy('name')->get();

        return view('backoffice.tracking.listrikonline', compact(
            'totalAllClicks',
            'todayClicks',
            'last7DaysClicks',
            'thisMonthClicks',
            'totalProductsCount',
            'clickedProductsCount',
            'topStarProduct',
            'products',
            'recentLogs',
            'brands',
            'categories'
        ));
    }

    /**
     * Export products click tracking report to CSV.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $fileName = 'ATS_ListrikOnline_Clicks_Report_' . date('Ymd_His') . '.csv';

        $query = Product::with(['brand', 'primaryCategory'])
            ->orderBy('listrikonline_clicks', 'desc')
            ->orderByRaw('last_clicked_at IS NULL, last_clicked_at DESC');

        if ($request->input('clicks_only', '1') === '1') {
            $query->where('listrikonline_clicks', '>', 0);
        }

        AuditLog::log('EXPORT_LISTRIKONLINE_CLICKS', 'Product', null, ['filename' => $fileName]);

        return new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');
            
            // UTF-8 BOM for Microsoft Excel compatibility
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header
            fputcsv($handle, [
                'Rank',
                'SKU',
                'Nama Produk',
                'Brand',
                'Kategori Utama',
                'Total Klik ListrikOnline',
                'Terakhir Diklik (WIB)',
                'Status Produk',
                'URL ListrikOnline',
            ]);

            $rank = 1;
            $query->chunk(200, function ($products) use ($handle, &$rank) {
                foreach ($products as $p) {
                    fputcsv($handle, [
                        $rank++,
                        $p->sku,
                        $p->name,
                        $p->brand ? $p->brand->name : '-',
                        $p->primaryCategory ? $p->primaryCategory->name : '-',
                        $p->listrikonline_clicks,
                        $p->last_clicked_at ? $p->last_clicked_at->format('Y-m-d H:i:s') : 'Belum pernah',
                        $p->status,
                        $p->listrikonline_url,
                    ]);
                }
            });

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Reset click count for a specific product (Admin only).
     */
    public function resetProductClicks(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $oldCount = $product->listrikonline_clicks;
        $product->update([
            'listrikonline_clicks' => 0,
            'last_clicked_at' => null,
        ]);

        ListrikonlineClickLog::where('product_id', $product->id)->delete();

        AuditLog::log('RESET_CLICKS', 'Product', $product->id, [
            'sku' => $product->sku,
            'old_clicks' => $oldCount,
        ]);

        Cache::forget('listrikonline_kpis');
        Cache::forget('backoffice_sidebar_today_clicks');
        Cache::forget('listrikonline_dashboard_stats');

        return back()->with('success', "Counter klik untuk produk {$product->sku} ({$product->name}) berhasil direset.");
    }
}
