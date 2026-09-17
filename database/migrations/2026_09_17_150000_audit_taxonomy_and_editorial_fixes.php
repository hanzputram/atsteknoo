<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. T02: Taxonomy Re-mapping (Kontaktor -> Category 2, Kapasitor -> Category 5)
        $catBreakers = DB::table('product_categories')->where('slug', 'power-distribution-circuit-breakers')->first();
        $catMotors = DB::table('product_categories')->where('slug', 'motor-starting-control')->first();
        $catMetering = DB::table('product_categories')->where('slug', 'metering-power-quality')->first();

        if ($catBreakers && $catMotors) {
            // Find contactor products in category 1
            $contactorIds = DB::table('products')
                ->where(function ($q) {
                    $q->where('sku', 'like', 'LC1%')
                      ->orWhere('sku', 'like', 'LAD%')
                      ->orWhere('name', 'like', '%Kontaktor%')
                      ->orWhere('name', 'like', '%Contactor%');
                })
                ->pluck('id');

            foreach ($contactorIds as $pid) {
                // Remove from breakers
                DB::table('category_product')
                    ->where('product_id', $pid)
                    ->where('category_id', $catBreakers->id)
                    ->delete();

                // Attach to motor control if not already attached
                $exists = DB::table('category_product')
                    ->where('product_id', $pid)
                    ->where('category_id', $catMotors->id)
                    ->exists();

                if (!$exists) {
                    DB::table('category_product')->insert([
                        'product_id' => $pid,
                        'category_id' => $catMotors->id,
                    ]);
                }

                // Update primary category if it was breakers
                DB::table('products')
                    ->where('id', $pid)
                    ->where('primary_category_id', $catBreakers->id)
                    ->update(['primary_category_id' => $catMotors->id]);
            }
        }

        if ($catBreakers && $catMetering) {
            // Find capacitor products in category 1
            $capacitorIds = DB::table('products')
                ->where(function ($q) {
                    $q->where('name', 'like', '%Kapasitor%')
                      ->orWhere('name', 'like', '%Capacitor%')
                      ->orWhere('sku', 'like', '%MKP%')
                      ->orWhere('sku', 'like', '%TMPOSY%');
                })
                ->pluck('id');

            foreach ($capacitorIds as $pid) {
                // Remove from breakers
                DB::table('category_product')
                    ->where('product_id', $pid)
                    ->where('category_id', $catBreakers->id)
                    ->delete();

                // Attach to metering & power quality if not already attached
                $exists = DB::table('category_product')
                    ->where('product_id', $pid)
                    ->where('category_id', $catMetering->id)
                    ->exists();

                if (!$exists) {
                    DB::table('category_product')->insert([
                        'product_id' => $pid,
                        'category_id' => $catMetering->id,
                    ]);
                }

                // Update primary category if it was breakers
                DB::table('products')
                    ->where('id', $pid)
                    ->where('primary_category_id', $catBreakers->id)
                    ->update(['primary_category_id' => $catMetering->id]);
            }
        }

        // 2. T05: DOMF01106 Dimensions and Breaking Capacity Normalization
        $domf = DB::table('products')->where('sku', 'DOMF01106')->first();
        if ($domf) {
            // Clean description
            $shortDesc = "Schneider Electric MCB Domae 1P 6A 6kA — reference code DOMF01106. Spesifikasi utama: 1 Kutub (1P), Arus Pengenal 6 A, Kapasitas Pemutusan 6 kA (Icn 6000 A pada 230 V AC sesuai standar IEC 60898-1). Dimensi: Tinggi 81 mm, Lebar 18 mm (1 modul DIN), Kedalaman 71.5 mm. Berat bersih: 0.095 kg (95 g). Perlindungan proteksi hubung singkat dan beban lebih untuk sirkuit distribusi listrik.";
            DB::table('products')->where('id', $domf->id)->update([
                'short_description' => $shortDesc
            ]);

            // Remove conflicting old dimension / breaking capacity rows for DOMF01106
            DB::table('product_specifications')
                ->where('product_id', $domf->id)
                ->where(function ($q) {
                    $q->whereIn('attribute_code', ['width', 'depth', 'length', 'breaking_capacity'])
                      ->orWhere('label', 'like', '%Lebar%')
                      ->orWhere('label', 'like', '%Kedalaman%')
                      ->orWhere('label', 'like', '%Kapasitas Pemutusan%');
                })
                ->delete();

            // Insert accurate, verified specification rows
            DB::table('product_specifications')->insert([
                [
                    'product_id' => $domf->id,
                    'attribute_code' => 'width',
                    'label' => 'Lebar (Width)',
                    'value' => '18.0',
                    'unit' => 'mm (1 Modul DIN)',
                    'group' => 'dimensions',
                    'sort_order' => 8,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => $domf->id,
                    'attribute_code' => 'depth',
                    'label' => 'Kedalaman (Depth)',
                    'value' => '71.5',
                    'unit' => 'mm',
                    'group' => 'dimensions',
                    'sort_order' => 9,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => $domf->id,
                    'attribute_code' => 'breaking_capacity',
                    'label' => 'Kapasitas Pemutusan (Icn)',
                    'value' => '6 kA (6000 A)',
                    'unit' => 'IEC 60898-1',
                    'group' => 'technical',
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // 3. T03 & T04: Wall Charger Article Editorial Corrections
        $articles = DB::table('articles')
            ->where(function ($q) {
                $q->where('slug', 'like', '%wall-charger%')
                  ->orWhere('slug', 'like', '%mobil-listrik%')
                  ->orWhere('content_html', 'like', '%200 VA%');
            })
            ->get();

        foreach ($articles as $art) {
            $content = $art->content_html;
            if (!$content) continue;

            // Fix truncated digits 200 VA -> 2.200 VA, 500 VA -> 3.500 VA, 500 VA -> 5.500 VA, 700 VA -> 7.700 VA
            $pattern = '/<ul>\s*<li>200 VA<\/li>\s*<li>500 VA<\/li>\s*<li>500 VA<\/li>\s*<li>700 VA<\/li>/is';
            $replacement = "<ul>\n<li>2.200 VA</li>\n<li>3.500 VA</li>\n<li>5.500 VA</li>\n<li>7.700 VA</li>";
            $content = preg_replace($pattern, $replacement, $content);

            // Fallback individual replacements if list format differed
            $content = str_replace('<li>200 VA</li>', '<li>2.200 VA</li>', $content);
            $content = str_replace('<li>700 VA</li>', '<li>7.700 VA</li>', $content);

            // Fix RCBO anchor link to point to RCBO search instead of RCCB
            $content = str_replace('href="../products?search=RCCB">RCBO', 'href="/products?search=RCBO">RCBO', $content);
            $content = str_replace('href="/products?search=RCCB">RCBO', 'href="/products?search=RCBO">RCBO', $content);
            $content = str_replace('href="../products?search=RCCB">RCD', 'href="/products?search=RCCB">RCD', $content);

            DB::table('articles')->where('id', $art->id)->update([
                'content_html' => $content,
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Non-destructive migration rollback
    }
};
