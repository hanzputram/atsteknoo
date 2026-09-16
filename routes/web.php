<?php

use App\Http\Controllers\Backoffice\AiKnowledgeController;
use App\Http\Controllers\Backoffice\ArticleCategoryController;
use App\Http\Controllers\Backoffice\ArticleController;
use App\Http\Controllers\Backoffice\BackofficeAuthController;
use App\Http\Controllers\Backoffice\BrandController;
use App\Http\Controllers\Backoffice\CertificateController;
use App\Http\Controllers\Backoffice\ContactInquiryController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\ImportCenterController;
use App\Http\Controllers\Backoffice\LiveChatController;
use App\Http\Controllers\Backoffice\MediaLibraryController;
use App\Http\Controllers\Backoffice\PageController;
use App\Http\Controllers\Backoffice\ProductCategoryController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Backoffice\ProjectCategoryController;
use App\Http\Controllers\Backoffice\ProjectController;
use App\Http\Controllers\Backoffice\SettingController;
use App\Http\Controllers\Backoffice\TagController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\MediaDeliveryController;
use App\Http\Controllers\Public\BlogArticleController;
use App\Http\Controllers\Public\CatalogBrandController;
use App\Http\Controllers\Public\CatalogCategoryController;
use App\Http\Controllers\Public\CatalogProductController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LiveChatApiController;
use App\Http\Controllers\Public\PortfolioProjectController;
use App\Http\Controllers\Public\PublicContactController;
use App\Http\Controllers\Public\PromoController;
use App\Http\Controllers\Public\SitemapController;
use App\Http\Controllers\Public\StaticPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// High-Converting Google Ads Promotional Landing Page
Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
Route::post('/promo/inquiry', [PromoController::class, 'submitInquiry'])->name('promo.inquiry');

// Dynamic Sitemap & Robots for Google Search Console & AI Crawlers
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots.txt');
Route::get('/google9133ec987e4d89f7.html', function () {
    return response("google-site-verification: google9133ec987e4d89f7.html", 200)
        ->header('Content-Type', 'text/html; charset=UTF-8');
});

// Static Asset Delivery Fallback (guarantees assets load on shared hosting / cPanel)
Route::get('/css/{file}', function ($file) {
    $path = public_path('css/' . $file);
    if (!file_exists($path) && file_exists(base_path('css/' . $file))) {
        $path = base_path('css/' . $file);
    }
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'text/css; charset=utf-8',
            'Cache-Control' => 'public, max-age=31536000'
        ]);
    }
    abort(404);
})->where('file', '.*');

Route::get('/public/css/{file}', function ($file) {
    $path = public_path('css/' . $file);
    if (!file_exists($path) && file_exists(base_path('css/' . $file))) {
        $path = base_path('css/' . $file);
    }
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'text/css; charset=utf-8',
            'Cache-Control' => 'public, max-age=31536000'
        ]);
    }
    abort(404);
})->where('file', '.*');

Route::get('/js/{file}', function ($file) {
    $path = public_path('js/' . $file);
    if (!file_exists($path) && file_exists(base_path('js/' . $file))) {
        $path = base_path('js/' . $file);
    }
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Cache-Control' => 'public, max-age=31536000'
        ]);
    }
    abort(404);
})->where('file', '.*');

Route::get('/public/js/{file}', function ($file) {
    $path = public_path('js/' . $file);
    if (!file_exists($path) && file_exists(base_path('js/' . $file))) {
        $path = base_path('js/' . $file);
    }
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Cache-Control' => 'public, max-age=31536000'
        ]);
    }
    abort(404);
})->where('file', '.*');

// Products & Categories
Route::get('/products', [CatalogProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [CatalogProductController::class, 'show'])->name('products.show');
Route::get('/product-categories/{slug}', [CatalogCategoryController::class, 'show'])->name('product-categories.show');

// Price List & Brands
Route::get('/price-list', [CatalogBrandController::class, 'index'])->name('price-list.index');
Route::get('/pricelist', function () {
    return redirect()->route('price-list.index');
});
Route::get('/brands', function () {
    return redirect()->route('price-list.index');
})->name('brands.index');
Route::get('/brands/{slug}', [CatalogBrandController::class, 'show'])->name('brands.show');
Route::get('/price-list/{slug}', [CatalogBrandController::class, 'show'])->name('price-list.show');

// Projects (Portfolio)
Route::get('/projects', [PortfolioProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [PortfolioProjectController::class, 'show'])->name('projects.show');

// Articles (Blog / News)
Route::get('/articles', [BlogArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [BlogArticleController::class, 'show'])->name('articles.show');

// Static Pages & Contact
Route::get('/about-us', [StaticPageController::class, 'about'])->name('about.index');
Route::get('/jasa-pembuatan-panel-listrik', [StaticPageController::class, 'panelMaker'])->name('services.panel');
Route::get('/contact', [PublicContactController::class, 'index'])->name('contact.index');
Route::get('/contact-us', function () {
    return redirect()->route('contact.index', [], 301);
})->name('contact.us');
Route::post('/contact', [PublicContactController::class, 'submit'])->name('contact.submit');
Route::post('/contact-us', [PublicContactController::class, 'submit'])->name('contact.us.submit');

// Real-time Live Chat API (Visitor Widget)
Route::get('/live-chat/messages', [LiveChatApiController::class, 'getSessionMessages'])->name('live-chat.messages');
Route::post('/live-chat/send', [LiveChatApiController::class, 'sendMessage'])->name('live-chat.send');
Route::post('/live-chat/typing', [LiveChatApiController::class, 'updateTyping'])->name('live-chat.typing');
Route::post('/live-chat/history', [LiveChatApiController::class, 'getChatHistory'])->name('live-chat.history');

// Protected Media Delivery
Route::get('/media/{id}/view', [MediaDeliveryController::class, 'view'])->name('media.view');



/*
|--------------------------------------------------------------------------
| Backoffice Authentication
|--------------------------------------------------------------------------
*/
Route::prefix('backoffice')->name('backoffice.')->group(function () {
    Route::get('/login', [BackofficeAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [BackofficeAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [BackofficeAuthController::class, 'logout'])->name('logout');

    // Protected Backoffice Routes
    Route::middleware(['web', 'backoffice'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/password', [BackofficeAuthController::class, 'showPasswordForm'])->name('password');
        Route::post('/password', [BackofficeAuthController::class, 'updatePassword'])->name('password.update');

        // Catalog & Content Management (Admin & Editor Only)
        Route::middleware(['backoffice:admin,editor'])->group(function () {
            // Products
            Route::resource('products', ProductController::class);

            // Product Categories
            Route::resource('product-categories', ProductCategoryController::class);

            // Brands
            Route::resource('brands', BrandController::class);

            // Certificates & Accreditations
            Route::resource('certificates', CertificateController::class);

            // Projects
            Route::get('projects/download-template', [ProjectController::class, 'downloadTemplate'])->name('projects.download-template');
            Route::post('projects/import-excel', [ProjectController::class, 'importExcel'])->name('projects.import-excel');
            Route::post('projects/{id}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggle-status');
            Route::resource('projects', ProjectController::class);

            // Project Categories
            Route::resource('project-categories', ProjectCategoryController::class);

            // Articles
            Route::resource('articles', ArticleController::class);

            // Article Categories & Tags
            Route::resource('article-categories', ArticleCategoryController::class);
            Route::get('tags', [TagController::class, 'index'])->name('tags.index');
            Route::post('tags', [TagController::class, 'store'])->name('tags.store');
            Route::delete('tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');

            // Pages
            Route::resource('pages', PageController::class)->only(['index', 'edit', 'update']);

            // Media Library API for WYSIWYG
            Route::get('media-library', [MediaLibraryController::class, 'index'])->name('media-library.index');
            Route::post('media-library/upload', [MediaLibraryController::class, 'upload'])->name('media-library.upload');

            // Import Center
            Route::get('import-products', [ImportCenterController::class, 'index'])->name('import.index');
            Route::get('import-products/template', [ImportCenterController::class, 'downloadTemplate'])->name('import.template');
            Route::get('import-products/export', [ImportCenterController::class, 'export'])->name('import.export');
            Route::post('import-products/upload', [ImportCenterController::class, 'upload'])->name('import.upload');
            Route::get('import-products/{id}/preview', [ImportCenterController::class, 'preview'])->name('import.preview');
            Route::post('import-products/{id}/execute', [ImportCenterController::class, 'execute'])->name('import.execute');
            Route::get('import-products/{id}/errors', [ImportCenterController::class, 'downloadErrorReport'])->name('import.errors');
            Route::get('import-products/{id}/error-report', [ImportCenterController::class, 'downloadErrorReport'])->name('import.error-report');
        });

        // Inquiries, Live Chat, and AI Knowledge (Admin & Customer Support Only - Editor excluded)
        Route::middleware(['backoffice:admin,cs,support'])->group(function () {
            // Inquiries & Live Chat Operations
            Route::get('inquiries', [ContactInquiryController::class, 'index'])->name('inquiries.index');
            Route::get('inquiries/{id}', [ContactInquiryController::class, 'show'])->name('inquiries.show');
            Route::post('inquiries/{id}/status', [ContactInquiryController::class, 'updateStatus'])->name('inquiries.status');
            Route::delete('inquiries/{id}', [ContactInquiryController::class, 'destroy'])->name('inquiries.destroy');

            // Live Chat Center (Inbox & Real-time Replies)
            Route::get('live-chats', [LiveChatController::class, 'index'])->name('live-chats.index');
            Route::get('live-chats/notifications', [LiveChatController::class, 'checkNotifications'])->name('live-chats.notifications');
            Route::get('live-chats/{id}', [LiveChatController::class, 'show'])->name('live-chats.show');
            Route::post('live-chats/{id}/reply', [LiveChatController::class, 'reply'])->name('live-chats.reply');
            Route::post('live-chats/{id}/close', [LiveChatController::class, 'close'])->name('live-chats.close');
            Route::post('live-chats/{id}/archive', [LiveChatController::class, 'archive'])->name('live-chats.archive');
            Route::post('live-chats/{id}/unarchive', [LiveChatController::class, 'unarchive'])->name('live-chats.unarchive');
            Route::post('live-chats/{id}/toggle-ai', [LiveChatController::class, 'toggleAi'])->name('live-chats.toggle-ai');
            Route::delete('live-chats/{id}', [LiveChatController::class, 'destroy'])->name('live-chats.destroy');
            Route::get('live-chats/{id}/poll', [LiveChatController::class, 'poll'])->name('live-chats.poll');
            Route::post('live-chats/{id}/typing', [LiveChatController::class, 'updateTyping'])->name('live-chats.typing');

            // AI Knowledge Base & Memory Training
            Route::resource('ai-knowledge', AiKnowledgeController::class);
            Route::post('ai-knowledge/{aiKnowledge}/toggle-active', [AiKnowledgeController::class, 'toggleActive'])->name('ai-knowledge.toggle-active');
            Route::get('ai-knowledge-simulator/test', [AiKnowledgeController::class, 'testPrompt'])->name('ai-knowledge.test');
            Route::post('ai-knowledge-simulator/ask', [AiKnowledgeController::class, 'askTest'])->name('ai-knowledge.test-ask');
        });

        // Admin-Only Modules
        Route::middleware(['backoffice:admin'])->group(function () {
            Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
            Route::match(['post', 'put'], 'settings', [SettingController::class, 'update'])->name('settings.update');
            Route::resource('users', UserController::class);
        });
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// SEO Preservation: 301 Permanent Redirects for Legacy WordPress URLs (Never Lose Rank)
Route::get('/product/{slug}', [\App\Http\Controllers\Public\LegacyRedirectController::class, 'handleProduct'])
    ->where('slug', '.*')
    ->name('legacy.product');
Route::get('/product-category/{slug}', [\App\Http\Controllers\Public\LegacyRedirectController::class, 'handleCategory'])
    ->where('slug', '.*')
    ->name('legacy.category');

// Catch-all route placed at the end so it does not intercept defined routes (e.g. /backoffice)
Route::get('/{slug}', [\App\Http\Controllers\Public\LegacyRedirectController::class, 'handle'])
    ->where('slug', '[a-zA-Z0-9\-_]+')
    ->name('legacy.redirect');
