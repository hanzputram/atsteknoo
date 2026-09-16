<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\ContactInquiry;
use App\Models\ImportJob;
use App\Models\Product;
use App\Models\Project;

class DashboardController extends Controller
{
    /**
     * Display backoffice overview dashboard without sales metrics.
     */
    public function index()
    {
        if (auth()->user() && auth()->user()->isCustomerSupport()) {
            return redirect()->route('backoffice.live-chats.index');
        }

        $stats = [
            'total_products' => Product::count(),
            'published_products' => Product::published()->count(),
            'draft_products' => Product::where('status', 'draft')->count(),
            'total_projects' => Project::count(),
            'total_articles' => Article::count(),
            'total_brands' => Brand::count(),
            'unread_inquiries' => ContactInquiry::where('status', 'unread')->count(),
        ];

        $latestImport = ImportJob::with('user')->latest()->first();
        $recentProducts = Product::with(['brand', 'primaryCategory'])->latest('updated_at')->take(5)->get();
        $recentLogs = AuditLog::with('user')->latest()->take(8)->get();

        return view('backoffice.dashboard', compact('stats', 'latestImport', 'recentProducts', 'recentLogs'));
    }
}
