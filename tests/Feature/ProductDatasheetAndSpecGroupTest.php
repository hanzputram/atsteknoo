<?php

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\User;
use App\Services\ProductExcelService;

beforeEach(function () {
    $this->admin = User::create([
        'name' => 'Admin Test',
        'email' => 'admin@atstekno.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'is_active' => true,
    ]);

    $this->brand = Brand::create([
        'code' => 'SCHNEIDER',
        'name' => 'Schneider Electric',
        'slug' => 'schneider-electric',
        'is_active' => true,
    ]);

    $this->category = ProductCategory::create([
        'code' => 'MCCB',
        'name' => 'Molded Case Circuit Breakers',
        'slug' => 'molded-case-circuit-breakers',
        'is_active' => true,
    ]);
});

test('Product specifications table on public detail page does not display parameter group', function () {
    $product = Product::create([
        'sku' => 'TEST-SKU-001',
        'normalized_sku' => 'TEST-SKU-001',
        'name' => 'Test Circuit Breaker',
        'slug' => 'test-circuit-breaker',
        'short_description' => 'Test breaker',
        'description_html' => '<p>Test description</p>',
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);

    ProductSpecification::create([
        'product_id' => $product->id,
        'attribute_code' => 'rated_current',
        'label' => 'Arus Nominal',
        'value' => '100',
        'unit' => 'A',
    ]);

    $response = $this->get(route('products.show', $product->slug));
    $response->assertOk();
    $response->assertSee('Arus Nominal');
    $response->assertSee('100');
    $response->assertSee('A');
    $response->assertDontSee('Parameter Group');
    $response->assertDontSee('Kelompok Parameter');
});

test('Product detail page displays Download Datasheet button when datasheet_url is set', function () {
    $product = Product::create([
        'sku' => 'TEST-SKU-DS',
        'normalized_sku' => 'TEST-SKU-DS',
        'name' => 'Breaker with Datasheet URL',
        'slug' => 'breaker-with-datasheet-url',
        'short_description' => 'With datasheet link',
        'description_html' => '<p>Test description with datasheet</p>',
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
        'datasheet_url' => 'https://example.com/datasheets/breaker-spec.pdf',
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);

    $response = $this->get(route('products.show', $product->slug));
    $response->assertOk();
    $response->assertSee('https://example.com/datasheets/breaker-spec.pdf');
    $response->assertSee('Download Datasheet (PDF)');
    $response->assertSee('Unduh Datasheet (PDF)');
});

test('Backoffice product create accepts datasheet_url and specs without group', function () {
    $response = $this->actingAs($this->admin)->post(route('backoffice.products.store'), [
        'sku' => 'BO-PROD-01',
        'name' => 'Backoffice Created Product',
        'status' => 'published',
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
        'category_ids' => [$this->category->id],
        'description_html' => '<p>Valid substantive description</p>',
        'datasheet_url' => 'https://example.com/specs.pdf',
        'specs' => [
            ['attribute_code' => 'poles', 'label' => 'Jumlah Kutub', 'value' => '3P', 'unit' => ''],
        ],
    ]);

    $response->assertRedirect(route('backoffice.products.index'));

    $product = Product::where('sku', 'BO-PROD-01')->first();
    expect($product)->not->toBeNull();
    expect($product->datasheet_url)->toBe('https://example.com/specs.pdf');

    $spec = ProductSpecification::where('product_id', $product->id)->first();
    expect($spec)->not->toBeNull();
    expect($spec->group)->toBeNull();
    expect($spec->label)->toBe('Jumlah Kutub');
});

test('Excel template includes link_datasheet in products and excludes group in specifications', function () {
    expect(ProductExcelService::PRODUCT_HEADERS)->toContain('link_datasheet');
    expect(ProductExcelService::SPEC_HEADERS)->not->toContain('group');

    $spreadsheet = ProductExcelService::generateTemplate();
    $prodSheet = $spreadsheet->getSheetByName('products');
    $specSheet = $spreadsheet->getSheetByName('product_specifications');

    expect($prodSheet)->not->toBeNull();
    expect($specSheet)->not->toBeNull();

    // Check products sheet has link_datasheet
    $prodHeaders = [];
    for ($col = 1; $col <= count(ProductExcelService::PRODUCT_HEADERS); $col++) {
        $prodHeaders[] = $prodSheet->getCell([$col, 1])->getValue();
    }
    expect($prodHeaders)->toContain('link_datasheet');

    // Check spec sheet headers do not contain group
    $specHeaders = [];
    for ($col = 1; $col <= count(ProductExcelService::SPEC_HEADERS); $col++) {
        $specHeaders[] = $specSheet->getCell([$col, 1])->getValue();
    }
    expect($specHeaders)->not->toContain('group');
    expect($specHeaders)->toContain('attribute_code');
    expect($specHeaders)->toContain('label');
    expect($specHeaders)->toContain('value');
    expect($specHeaders)->toContain('unit');
    expect($specHeaders)->toContain('sort_order');
    expect($specHeaders)->toContain('operation');
});

test('ProductExcelService executeUnit creates product with datasheet_url and specs without group', function () {
    $unit = [
        'action' => 'create',
        'sku' => 'EXCEL-001',
        'normalized_sku' => 'EXCEL-001',
        'valid' => true,
        'data' => [
            'name' => 'Excel Imported Breaker',
            'datasheet_url' => 'https://example.com/datasheets/excel-imported.pdf',
            'status' => 'published',
            'brand_id' => $this->brand->id,
            'primary_category_id' => $this->category->id,
            'category_ids' => [$this->category->id],
        ],
        'specifications' => [
            [
                'attribute_code' => 'current_rating',
                'label' => 'Arus Nominal',
                'value' => '630',
                'unit' => 'A',
                'sort_order' => 1,
            ],
        ],
    ];

    $result = ProductExcelService::executeUnit($unit, $this->admin->id);
    expect($result['success'])->toBeTrue();

    $product = Product::where('sku', 'EXCEL-001')->first();
    expect($product)->not->toBeNull();
    expect($product->datasheet_url)->toBe('https://example.com/datasheets/excel-imported.pdf');

    $spec = ProductSpecification::where('product_id', $product->id)->first();
    expect($spec)->not->toBeNull();
    expect($spec->group)->toBeNull();
    expect($spec->value)->toBe('630');
});

test('ProductExcelService generateExport includes datasheet_url in link_datasheet column and exports specs without group', function () {
    $product = Product::create([
        'sku' => 'EXPORT-001',
        'normalized_sku' => 'EXPORT-001',
        'name' => 'Exportable Product',
        'slug' => 'exportable-product',
        'datasheet_url' => 'https://drive.google.com/file/d/test1234/view',
        'status' => 'published',
        'published_at' => now(),
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
    ]);

    ProductSpecification::create([
        'product_id' => $product->id,
        'attribute_code' => 'voltage',
        'label' => 'Tegangan',
        'value' => '400',
        'unit' => 'V',
        'sort_order' => 0,
    ]);

    $spreadsheet = ProductExcelService::exportProducts();
    $prodSheet = $spreadsheet->getSheetByName('products');
    $specSheet = $spreadsheet->getSheetByName('product_specifications');

    // Column O is link_datasheet (15th column)
    $datasheetVal = $prodSheet->getCell('O2')->getValue();
    expect($datasheetVal)->toBe('https://drive.google.com/file/d/test1234/view');

    // In spec sheet: Col A: sku, B: attribute_code, C: label, D: value, E: unit, F: sort_order, G: operation
    expect($specSheet->getCell('A2')->getValue())->toBe('EXPORT-001');
    expect($specSheet->getCell('B2')->getValue())->toBe('voltage');
    expect($specSheet->getCell('C2')->getValue())->toBe('Tegangan');
    expect($specSheet->getCell('D2')->getValue())->toBe('400');
    expect($specSheet->getCell('E2')->getValue())->toBe('V');
    expect($specSheet->getCell('F2')->getValue())->toBe('0');
    expect($specSheet->getCell('G2')->getValue())->toBe('upsert');
});

test('Catalog product pagination supports per_page dropdown options (10, 25, 50, 100) and preserves query strings', function () {
    Product::create([
        'sku' => 'TEST-PAGINATE-001',
        'normalized_sku' => 'TEST-PAGINATE-001',
        'name' => 'Paginate Test Product',
        'slug' => 'paginate-test-product',
        'status' => 'published',
        'published_at' => now(),
        'brand_id' => $this->brand->id,
        'primary_category_id' => $this->category->id,
    ]);

    // Default per_page is 25
    $resDefault = $this->get(route('products.index'));
    $resDefault->assertOk();
    $resDefault->assertSee('id="atsPerPageSelect"', false);
    $resDefault->assertSee('value="10"', false);
    $resDefault->assertSee('value="25"', false);
    $resDefault->assertSee('value="50"', false);
    $resDefault->assertSee('value="100"', false);

    // Custom per_page = 10
    $res10 = $this->get(route('products.index', ['per_page' => 10]));
    $res10->assertOk();
    $paginator10 = $res10->viewData('products');
    expect($paginator10->perPage())->toBe(10);

    // Custom per_page = 50
    $res50 = $this->get(route('products.index', ['per_page' => 50]));
    $res50->assertOk();
    $paginator50 = $res50->viewData('products');
    expect($paginator50->perPage())->toBe(50);

    // Invalid per_page falls back to 25
    $resInvalid = $this->get(route('products.index', ['per_page' => 999]));
    $resInvalid->assertOk();
    $paginatorInvalid = $resInvalid->viewData('products');
    expect($paginatorInvalid->perPage())->toBe(25);
});
