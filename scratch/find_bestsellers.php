<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$codes = [
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

echo "Total target products: " . count($codes) . "\n\n";

$matchedIds = [];
foreach ($codes as $idx => $code) {
    // try exact or like match on name or sku
    $cleanCode = trim($code);
    $products = Product::where('name', 'LIKE', "%{$cleanCode}%")
        ->orWhere('sku', 'LIKE', "%{$cleanCode}%")
        ->orWhere('slug', 'LIKE', '%' . strtolower($cleanCode) . '%')
        ->get(['id', 'name', 'slug', 'sku', 'brand_id', 'is_featured', 'status']);

    echo ($idx + 1) . ". Target: {$cleanCode}\n";
    if ($products->isEmpty()) {
        // try partial match e.g. stripping -DECA
        $baseCode = str_replace('-DECA', '', $cleanCode);
        $fallback = Product::where('name', 'LIKE', "%{$baseCode}%")
            ->orWhere('sku', 'LIKE', "%{$baseCode}%")
            ->orWhere('slug', 'LIKE', '%' . strtolower($baseCode) . '%')
            ->get(['id', 'name', 'slug', 'sku', 'brand_id', 'is_featured', 'status']);
        
        if ($fallback->isNotEmpty()) {
            echo "   [Found with fallback {$baseCode}]:\n";
            foreach ($fallback as $p) {
                echo "   -> ID: {$p->id} | Name: {$p->name} | SKU: {$p->sku} | Featured: {$p->is_featured}\n";
                $matchedIds[] = $p->id;
            }
        } else {
            echo "   [NOT FOUND]\n";
        }
    } else {
        foreach ($products as $p) {
            echo "   -> ID: {$p->id} | Name: {$p->name} | SKU: {$p->sku} | Featured: {$p->is_featured}\n";
            $matchedIds[] = $p->id;
        }
    }
}

echo "\n--- Current Featured Products ---\n";
$currentFeatured = Product::where('is_featured', true)->get(['id', 'name', 'sku', 'is_featured']);
foreach ($currentFeatured as $cf) {
    echo "ID: {$cf->id} | Name: {$cf->name} | SKU: {$cf->sku}\n";
}
