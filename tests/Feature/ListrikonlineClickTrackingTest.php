<?php

use App\Models\Brand;
use App\Models\ListrikonlineClickLog;
use App\Models\Product;
use App\Models\User;

test('clicking buy at listrikonline redirects to external store and increments click counter', function () {
    $brand = Brand::first() ?? Brand::create([
        'code' => 'TEST-BRAND',
        'name' => 'Test Brand',
        'slug' => 'test-brand',
    ]);

    $product = Product::create([
        'sku' => 'TEST-SKU-999',
        'normalized_sku' => 'TEST-SKU-999',
        'name' => 'Test Circuit Breaker 100A',
        'slug' => 'test-circuit-breaker-100a',
        'brand_id' => $brand->id,
        'status' => 'published',
        'published_at' => now(),
        'listrikonline_clicks' => 0,
    ]);

    expect($product->listrikonline_clicks)->toBe(0);
    expect(ListrikonlineClickLog::where('product_id', $product->id)->count())->toBe(0);

    // Hit the redirect tracking route
    $response = $this->get(route('products.buy-listrikonline', $product->slug));

    // Must redirect (302) to listrikonline product URL
    $response->assertStatus(302);
    $response->assertRedirect('https://listrikonline.com/products/TEST-SKU-999');

    // Fresh model should have 1 click
    $product->refresh();
    expect($product->listrikonline_clicks)->toBe(1);
    expect($product->last_clicked_at)->not->toBeNull();

    // Log should be stored
    $log = ListrikonlineClickLog::where('product_id', $product->id)->first();
    expect($log)->not->toBeNull();
    expect($log->sku)->toBe('TEST-SKU-999');
    expect($log->device_type)->toBeIn(['Desktop', 'Mobile', 'Tablet']);

    // Hit it a second time
    $this->get(route('products.buy-listrikonline', $product->slug));
    $product->refresh();
    expect($product->listrikonline_clicks)->toBe(2);
    expect(ListrikonlineClickLog::where('product_id', $product->id)->count())->toBe(2);

    // Clean up test product
    ListrikonlineClickLog::where('product_id', $product->id)->delete();
    $product->forceDelete();
});

test('backoffice user can access listrikonline tracking page and export csv', function () {
    $admin = User::first() ?? User::factory()->create([
        'role' => 'admin',
        'is_active' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('backoffice.tracking.listrikonline'));
    $response->assertStatus(200);
    $response->assertSee('Tracking Klik');
    $response->assertSee('Total Klik Sepanjang Waktu');

    $exportResponse = $this->actingAs($admin)->get(route('backoffice.tracking.listrikonline.export'));
    $exportResponse->assertStatus(200);
    $exportResponse->assertHeader('content-type', 'text/csv; charset=UTF-8');
});
