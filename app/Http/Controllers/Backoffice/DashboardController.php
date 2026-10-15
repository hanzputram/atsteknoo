<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\ContactInquiry;
use App\Models\ImportJob;
use App\Models\ListrikonlineClickLog;
use App\Models\Product;
use App\Models\Project;

class DashboardController extends Controller
{
    /**
     * Display backoffice overview dashboard.
     */
    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->isAdmin()) {
                // Admin and Superadmin see full Overview Dashboard
            } elseif (auth()->user()->isCustomerSupport()) {
                return redirect()->route('backoffice.live-chats.index');
            } elseif (auth()->user()->role === 'editor') {
                return redirect()->route('backoffice.products.index');
            }
        }

        $clickStats = \Illuminate\Support\Facades\Cache::remember('listrikonline_dashboard_stats', 30, function () {
            return [
                'total' => (int) Product::sum('listrikonline_clicks'),
                'today' => ListrikonlineClickLog::today()->count(),
            ];
        });

        $stats = [
            'total_products' => Product::count(),
            'published_products' => Product::published()->count(),
            'draft_products' => Product::where('status', 'draft')->count(),
            'total_projects' => Project::count(),
            'total_articles' => Article::count(),
            'total_brands' => Brand::count(),
            'unread_inquiries' => ContactInquiry::where('status', 'unread')->count(),
            'total_listrikonline_clicks' => $clickStats['total'],
            'today_listrikonline_clicks' => $clickStats['today'],
        ];

        $latestImport = ImportJob::with('user')->latest()->first();
        $recentProducts = Product::with(['brand', 'primaryCategory'])->latest('updated_at')->take(5)->get();
        $topClickedProducts = Product::with(['brand', 'primaryCategory'])
            ->where('listrikonline_clicks', '>', 0)
            ->orderByDesc('listrikonline_clicks')
            ->take(5)
            ->get();
        $recentLogs = AuditLog::with('user')->latest()->take(8)->get();

        return view('backoffice.dashboard', compact('stats', 'latestImport', 'recentProducts', 'topClickedProducts', 'recentLogs'));
    }
}
