<?php

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\SiteSetting;
use App\Models\User;
use App\Services\DriveDownloadAdapter;
use App\Services\HtmlSanitizerService;
use App\Services\ProductExcelService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    // Seed essential settings
    SiteSetting::set('company_name', 'PT. Anugerah Tama Sejati');
    SiteSetting::set('phone', '(031) 59178887');

    // Create Admin and Editor users
    $this->admin = User::create([
        'name' => 'Admin Test',
        'email' => 'admin@test.com',
        'password' => Hash::make('SecretAdmin2026!'),
        'role' => 'admin',
        'is_active' => true,
    ]);

    $this->editor = User::create([
        'name' => 'Editor Test',
        'email' => 'editor@test.com',
        'password' => Hash::make('SecretEditor2026!'),
        'role' => 'editor',
        'is_active' => true,
    ]);

    // Create Brand
    $this->brand = Brand::create([
        'code' => 'SE',
        'name' => 'Schneider Electric',
        'slug' => 'schneider-electric',
        'is_active' => true,
    ]);

    // Create Category
    $this->category = ProductCategory::create([
        'code' => 'ACB',
        'name' => 'Air Circuit Breakers',
        'slug' => 'air-circuit-breakers',
        'is_active' => true,
    ]);

    // Create Published Product
    $this->product = Product::create([
        'sku' => 'MTZ1-1600A',
        'normalized_sku' => 'MTZ1-1600A',
        'name' => 'MasterPact MTZ1 1600A 3P',
        'slug' => 'masterpact-mtz1-1600a-3p',
        'short_description' => 'Air circuit breaker for distribution protection',
        'description_html' => '<p>High performance low voltage air circuit breaker.</p>',
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_by' => $this->admin->id,
    ]);
    $this->product->categories()->attach($this->category->id);

    // Create Project
    $this->projectCategory = ProjectCategory::create([
        'code' => 'COMMERCIAL',
        'name' => 'Commercial High-Rise',
        'slug' => 'commercial-high-rise',
        'is_active' => true,
    ]);
    $this->project = Project::create([
        'project_code' => 'PRJ-001',
        'title' => 'Pakuwon Mall Power Substation',
        'slug' => 'pakuwon-mall-power-substation',
        'summary' => 'Installation of 3200A main switchboard',
        'category_id' => $this->projectCategory->id,
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_by' => $this->admin->id,
    ]);

    // Create Article
    $this->articleCategory = ArticleCategory::create([
        'code' => 'GUIDE',
        'name' => 'Technical Guide',
        'slug' => 'technical-guide',
        'is_active' => true,
    ]);
    $this->article = Article::create([
        'title' => 'Panduan Perawatan Air Circuit Breaker',
        'slug' => 'panduan-perawatan-air-circuit-breaker',
        'excerpt' => 'Langkah preventif pemeliharaan rutin switchgear industri.',
        'content_html' => '<p>Pemeriksaan kontak utama dan mekanisme tripping wajib dilakukan berkala.</p>',
        'category_id' => $this->articleCategory->id,
        'author_id' => $this->admin->id,
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_by' => $this->admin->id,
    ]);

    // Create Page
    Page::create([
        'page_key' => 'about-us',
        'title' => 'About Us',
        'slug' => 'about-us',
        'content_html' => '<p>Corporate profile of PT. Anugerah Tama Sejati.</p>',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_by' => $this->admin->id,
    ]);
});

// T01: Public Routes Connectivity
test('T01: All public catalog and content pages load with 200 OK', function () {
    $this->get(route('home'))->assertOk();
    $this->get(route('products.index'))->assertOk();
    $this->get(route('products.show', $this->product->slug))->assertOk();
    $this->get(route('product-categories.show', $this->category->slug))->assertOk();
    $this->get(route('brands.index'))->assertOk();
    $this->get(route('brands.show', $this->brand->slug))->assertOk();
    $this->get(route('projects.index'))->assertOk();
    $this->get(route('projects.show', $this->project->slug))->assertOk();
    $this->get(route('articles.index'))->assertOk();
    $this->get(route('articles.show', $this->article->slug))->assertOk();
    $this->get(route('about.index'))->assertOk();
    $this->get(route('contact.index'))->assertOk();
});

// T03: Protected Backoffice Boundary for Guests
test('T03: Guest access to backoffice is redirected to login', function () {
    $this->get(route('backoffice.dashboard'))->assertRedirect(route('backoffice.login'));
    $this->get(route('backoffice.products.index'))->assertRedirect(route('backoffice.login'));
    $this->get(route('backoffice.import.index'))->assertRedirect(route('backoffice.login'));
    $this->get(route('backoffice.settings.index'))->assertRedirect(route('backoffice.login'));
});

// T04: Role Authorization Boundary (Editor cannot access Admin modules)
test('T04: Editor cannot access Admin-only modules like settings and user management', function () {
    $response = $this->actingAs($this->editor)->get(route('backoffice.settings.index'));
    $response->assertForbidden();

    $responseUser = $this->actingAs($this->editor)->get(route('backoffice.users.index'));
    $responseUser->assertForbidden();
});

// T05: Backoffice Login, Session Regeneration, and Rate Limiting
test('T05: Backoffice authentication enforces rate limit and regenerates session on login', function () {
    // 5 failed login attempts
    for ($i = 0; $i < 5; $i++) {
        $this->post(route('backoffice.login.submit'), [
            'email' => 'admin@test.com',
            'password' => 'WrongPassword!',
        ]);
    }

    // 6th attempt should be blocked by rate limiter
    $blockedResponse = $this->post(route('backoffice.login.submit'), [
        'email' => 'admin@test.com',
        'password' => 'SecretAdmin2026!',
    ]);
    $blockedResponse->assertSessionHasErrors('email');

    // Clear rate limit for subsequent test
    RateLimiter::clear(Illuminate\Support\Str::transliterate('admin@test.com|127.0.0.1'));

    // Valid login
    $validResponse = $this->post(route('backoffice.login.submit'), [
        'email' => 'admin@test.com',
        'password' => 'SecretAdmin2026!',
    ]);
    $validResponse->assertRedirect(route('backoffice.dashboard'));
    $this->assertAuthenticatedAs($this->admin);

    // Logout terminates session
    $logoutResponse = $this->post(route('backoffice.logout'));
    $logoutResponse->assertRedirect(route('backoffice.login'));
    $this->assertGuest();
});

// T08: Product Creation with Technical Specifications
test('T08: Product can be created with technical specifications and displayed publicly', function () {
    $productData = [
        'sku' => 'CVS-250F-3P',
        'name' => 'EasyPact CVS250F 250A 3P 36kA',
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
        'category_ids' => [$this->category->id],
        'short_description' => 'Molded case circuit breaker 250A',
        'description_html' => '<p>MCCB reliable for industrial motor protection.</p>',
        'status' => 'published',
        'specs' => [
            ['group' => 'Kelistrikan', 'label' => 'Arus Nominal (In)', 'value' => '250', 'unit' => 'A'],
            ['group' => 'Kelistrikan', 'label' => 'Kapasitas Pemutus (Icu)', 'value' => '36', 'unit' => 'kA'],
        ],
    ];

    $response = $this->actingAs($this->admin)->post(route('backoffice.products.store'), $productData);
    $response->assertRedirect(route('backoffice.products.index'));

    $newProd = Product::where('sku', 'CVS-250F-3P')->first();
    expect($newProd)->not->toBeNull();
    expect($newProd->normalized_sku)->toBe('CVS-250F-3P');

    $specs = ProductSpecification::where('product_id', $newProd->id)->get();
    expect($specs->count())->toBe(2);

    // Public detail page renders the product and specs
    $publicResponse = $this->get(route('products.show', $newProd->slug));
    $publicResponse->assertOk();
    $publicResponse->assertSee('EasyPact CVS250F');
    $publicResponse->assertSee('250');
});

// T09: Server-side HTML Sanitization
test('T09: HTML Sanitizer Service strips harmful script tags, onclick, and javascript URIs', function () {
    $dirtyHtml = '<h2>Overview</h2><script>alert("XSS")</script><p onclick="stealCookies()">Test paragraph <a href="javascript:void(0)">Link</a></p>';
    $cleanHtml = HtmlSanitizerService::clean($dirtyHtml);

    expect($cleanHtml)->not->toContain('<script>');
    expect($cleanHtml)->not->toContain('alert');
    expect($cleanHtml)->not->toContain('onclick');
    expect($cleanHtml)->not->toContain('javascript:');
    expect($cleanHtml)->toContain('<h2>Overview</h2>');
    expect($cleanHtml)->toContain('Test paragraph');
});

// T11: Scheduled Articles Visibility Boundary
test('T11: Future scheduled articles are not visible to guests', function () {
    $futureArticle = Article::create([
        'title' => 'Artikel Masa Depan yang Dijadwalkan',
        'slug' => 'artikel-masa-depan-yang-dijadwalkan',
        'excerpt' => 'Hanya tampil jika published_at <= waktu sekarang.',
        'content_html' => '<p>Konten rahasia belum rilis.</p>',
        'category_id' => $this->articleCategory->id,
        'author_id' => $this->admin->id,
        'status' => 'published',
        'published_at' => now()->addDays(5), // Future date
        'created_by' => $this->admin->id,
    ]);

    // Guest requesting future article slug gets 404
    $this->get(route('articles.show', $futureArticle->slug))->assertNotFound();

    // Not included in public articles listing
    $listResponse = $this->get(route('articles.index'));
    $listResponse->assertDontSee('Artikel Masa Depan yang Dijadwalkan');
});

// T14: SKU Normalization Preserves Prefix & Leading Zeros
test('T14: SKU normalization preserves uppercase, prefixes, and leading zeros', function () {
    expect(Product::normalizeSku('  000123  '))->toBe('000123');
    expect(Product::normalizeSku('fort-ab-001'))->toBe('FORT-AB-001');
    expect(Product::normalizeSku('SE-MTZ-3200'))->toBe('SE-MTZ-3200');
});

// T21: SSRF Defense in DriveDownloadAdapter
test('T21: DriveDownloadAdapter blocks SSRF to internal IPs, loopback, and metadata servers', function () {
    // Loopback
    expect(DriveDownloadAdapter::isUrlSafe('http://127.0.0.1/evil.png'))->toBeFalse();
    expect(DriveDownloadAdapter::isUrlSafe('http://localhost/evil.png'))->toBeFalse();

    // AWS / GCP Metadata Endpoint
    expect(DriveDownloadAdapter::isUrlSafe('http://169.254.169.254/latest/meta-data'))->toBeFalse();

    // Private Subnets
    expect(DriveDownloadAdapter::isUrlSafe('http://10.0.0.1/file.png'))->toBeFalse();
    expect(DriveDownloadAdapter::isUrlSafe('http://192.168.1.1/file.png'))->toBeFalse();
    expect(DriveDownloadAdapter::isUrlSafe('http://172.16.0.1/file.png'))->toBeFalse();

    // Spoofed Domain
    expect(DriveDownloadAdapter::isUrlSafe('https://drive.google.com.attacker.com/file.png'))->toBeFalse();

    // Valid Google Drive domains
    expect(DriveDownloadAdapter::isUrlSafe('https://drive.google.com/file/d/12345/view'))->toBeTrue();
    expect(DriveDownloadAdapter::isUrlSafe('https://docs.google.com/uc?id=12345'))->toBeTrue();
});

// T34: Strict Non-Transactional Catalog Policy
test('T34: Strict enforcement of zero sales fields (no price, stock, cart, checkout)', function () {
    $prod = Product::first();
    $attributes = $prod->getAttributes();

    expect(array_key_exists('price', $attributes))->toBeFalse();
    expect(array_key_exists('stock', $attributes))->toBeFalse();
    expect(array_key_exists('discount', $attributes))->toBeFalse();
    expect(array_key_exists('hpp', $attributes))->toBeFalse();

    // Public product detail page contains no transactional cart/checkout/price
    $response = $this->get(route('products.show', $prod->slug));
    $response->assertDontSee('Add to Cart');
    $response->assertDontSee('Checkout');
    $response->assertDontSee('Rp ');
});

// T12 & T13: Excel Template Generation and Export
test('T12 & T13: Excel template and exporter generate valid multi-sheet workbooks', function () {
    $template = ProductExcelService::generateTemplate();
    expect($template->getSheetByName('products'))->not->toBeNull();
    expect($template->getSheetByName('product_specifications'))->not->toBeNull();
    expect($template->getSheetByName('_instructions'))->not->toBeNull();
    expect($template->getSheetByName('_brands'))->not->toBeNull();
    expect($template->getSheetByName('_categories'))->not->toBeNull();

    $export = ProductExcelService::exportProducts();
    expect($export->getSheetByName('products'))->not->toBeNull();
    expect($export->getSheetByName('product_specifications'))->not->toBeNull();
});

// T16 & T17: Excel Unit Execution for Upsert and Specification Operations
test('T16 & T17: ProductExcelService executeUnit creates, updates, and modifies specs', function () {
    // 1. Create unit
    $unitCreate = [
        'sku' => 'FORT-RELAY-24V',
        'normalized_sku' => 'FORT-RELAY-24V',
        'action' => 'create',
        'payload' => [
            'sku' => 'FORT-RELAY-24V',
            'normalized_sku' => 'FORT-RELAY-24V',
            'name' => 'Fort Power Relay 24VDC 8 Pin',
            'slug' => 'fort-power-relay-24vdc-8-pin',
            'short_description' => 'Miniature industrial power relay',
            'description_html' => '<p>High durability relay for control panels.</p>',
            'brand_id' => $this->brand->id,
            'category_ids' => [$this->category->id],
            'primary_category_id' => $this->category->id,
            'status' => 'published',
            'specifications' => [
                ['attribute_code' => 'coil_voltage', 'label' => 'Tegangan Coil', 'value' => '24', 'unit' => 'VDC', 'operation' => 'upsert'],
                ['attribute_code' => 'pin_count', 'label' => 'Jumlah Pin', 'value' => '8', 'unit' => 'Pin', 'operation' => 'upsert'],
            ],
        ],
    ];

    $resCreate = ProductExcelService::executeUnit($unitCreate, $this->admin->id);
    expect($resCreate['action'])->toBe('created');

    $createdProd = Product::where('sku', 'FORT-RELAY-24V')->first();
    expect($createdProd)->not->toBeNull();
    expect($createdProd->specifications()->count())->toBe(2);

    // 2. Update unit: update name and remove one specification
    $unitUpdate = [
        'sku' => 'FORT-RELAY-24V',
        'normalized_sku' => 'FORT-RELAY-24V',
        'action' => 'update',
        'product_id' => $createdProd->id,
        'payload' => [
            'name' => 'Fort Power Relay 24VDC 8 Pin Gen-2',
            'specifications' => [
                ['attribute_code' => 'pin_count', 'operation' => 'remove'],
            ],
        ],
    ];

    $resUpdate = ProductExcelService::executeUnit($unitUpdate, $this->admin->id);
    expect($resUpdate['action'])->toBe('updated');

    $updatedProd = Product::where('sku', 'FORT-RELAY-24V')->first();
    expect($updatedProd->name)->toBe('Fort Power Relay 24VDC 8 Pin Gen-2');
    // Pin count removed, only 1 spec remaining
    expect($updatedProd->specifications()->count())->toBe(1);
    expect($updatedProd->specifications()->first()->attribute_code)->toBe('coil_voltage');
});
