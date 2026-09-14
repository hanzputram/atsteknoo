<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Facades\DB;

$targetSkus = [
    'ATV310HU15N4E',
    'LADN11-DECA',
    'DOMF01116',
    'EZC100F3100',
    'XA2EVM3LC',
    'XA2EVM4LC',
    'XA2EVM5LC',
    'LC1D32M7-DECA',
    'DOMF01106',
    'LC1D09M7-DECA'
];

DB::transaction(function () use ($targetSkus) {
    // 1. Reset all current featured products
    Product::where('is_featured', true)->update(['is_featured' => false]);

    // 2. Set new featured products with explicit sort order
    foreach ($targetSkus as $index => $sku) {
        $sortOrder = $index + 1;
        $product = Product::where('sku', $sku)->first();
        if ($product) {
            $product->update([
                'is_featured' => true,
                'sort_order' => $sortOrder,
                'status' => 'published',
            ]);
            echo "Updated [#{$sortOrder}] SKU: {$product->sku} | ID: {$product->id} | Name: {$product->name}\n";
        } else {
            echo "ERROR: SKU {$sku} not found!\n";
        }
    }
});

echo "\n--- Verification: Current Featured Products in DB ---\n";
$featured = Product::where('is_featured', true)
    ->orderBy('sort_order')
    ->get(['id', 'sku', 'name', 'sort_order', 'is_featured']);

foreach ($featured as $p) {
    echo "Sort: {$p->sort_order} | SKU: {$p->sku} | ID: {$p->id} | Name: {$p->name}\n";
}
