<?php

use App\Http\Controllers\Backoffice\ArticleCategoryController;
use App\Http\Controllers\Backoffice\ArticleController;
use App\Http\Controllers\Backoffice\BackofficeAuthController;
use App\Http\Controllers\Backoffice\BrandController;
use App\Http\Controllers\Backoffice\ContactInquiryController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\ImportCenterController;
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
use App\Http\Controllers\Public\PortfolioProjectController;
use App\Http\Controllers\Public\PublicContactController;
use App\Http\Controllers\Public\StaticPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products & Categories
Route::get('/products', [CatalogProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [CatalogProductController::class, 'show'])->name('products.show');
Route::get('/product-categories/{slug}', [CatalogCategoryController::class, 'show'])->name('product-categories.show');

// Brands
Route::get('/brands', [CatalogBrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{slug}', [CatalogBrandController::class, 'show'])->name('brands.show');

// Projects (Portfolio)
Route::get('/projects', [PortfolioProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [PortfolioProjectController::class, 'show'])->name('projects.show');

// Articles (Blog / News)
Route::get('/articles', [BlogArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [BlogArticleController::class, 'show'])->name('articles.show');

// Static Pages & Contact
Route::get('/about-us', [StaticPageController::class, 'about'])->name('about.index');
Route::get('/contact', [PublicContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [PublicContactController::class, 'submit'])->name('contact.submit');

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

        // Products
        Route::resource('products', ProductController::class);

        // Product Categories
        Route::resource('product-categories', ProductCategoryController::class);

        // Brands
        Route::resource('brands', BrandController::class);

        // Projects
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

        // Inquiries (Inbox)
        Route::get('inquiries', [ContactInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{id}', [ContactInquiryController::class, 'show'])->name('inquiries.show');
        Route::post('inquiries/{id}/status', [ContactInquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('inquiries/{id}', [ContactInquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Import Center
        Route::get('import-products', [ImportCenterController::class, 'index'])->name('import.index');
        Route::get('import-products/template', [ImportCenterController::class, 'downloadTemplate'])->name('import.template');
        Route::get('import-products/export', [ImportCenterController::class, 'export'])->name('import.export');
        Route::post('import-products/upload', [ImportCenterController::class, 'upload'])->name('import.upload');
        Route::get('import-products/{id}/preview', [ImportCenterController::class, 'preview'])->name('import.preview');
        Route::post('import-products/{id}/execute', [ImportCenterController::class, 'execute'])->name('import.execute');
        Route::get('import-products/{id}/errors', [ImportCenterController::class, 'downloadErrorReport'])->name('import.errors');
        Route::get('import-products/{id}/error-report', [ImportCenterController::class, 'downloadErrorReport'])->name('import.error-report');

        // Admin-Only Modules
        Route::middleware(['backoffice:admin'])->group(function () {
            Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
            Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
            Route::resource('users', UserController::class);
        });
    });
});
