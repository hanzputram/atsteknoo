<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSpecification;
use Illuminate\Database\Seeder;

class FixDomf01106Seeder extends Seeder
{
    /**
     * Correct technical data for DOMF01106 and all Schneider Electric Domae products
     * according to verified official Schneider Electric datasheets:
     * - Domae Miniature Circuit Breaker (MCB)
     * - Breaking capacity: Icn = 6000 A (6 kA) at 230V / 400V AC conforming to IEC 60898-1
     * - Dimensions: Height 81 mm, Width 18 mm per pole (1 module = 18 mm), Depth 71.5 mm
     * - Weight: 1P = 0.095 kg (95 g), 2P = 0.190 kg (190 g), 3P = 0.285 kg (285 g)
     * - Replaces legacy typos where '<6KA' or '<6 kA' was mistakenly used.
     */
    public function run(): void
    {
        // =========================================================================
        // 1. SPECIFIC RIGOROUS CALIBRATION FOR DOMF01106
        // =========================================================================
        $domf01106 = Product::where('sku', 'DOMF01106')->first();
        if ($domf01106) {
            $descHtml01106 = $domf01106->description_html;
            if ($descHtml01106) {
                $descHtml01106 = str_replace('&lt;6KA', '6kA', $descHtml01106);
                $descHtml01106 = str_replace('&lt;6 kA', '6 kA (6000 A)', $descHtml01106);
                $descHtml01106 = str_replace('<td>Breaking capacity</td><td>&lt;6 kA</td>', '<td>Breaking capacity (Icn)</td><td>6 kA (6000 A)</td>', $descHtml01106);
                $descHtml01106 = str_replace('<strong>Kapasitas Pemutusan:</strong> &lt;6 kA', '<strong>Kapasitas Pemutusan (Icn):</strong> 6 kA (6000 A)', $descHtml01106);
                $descHtml01106 = str_replace('<li><strong>Panjang:</strong> 18.0 mm</li>', '<li><strong>Lebar (Width):</strong> 18.0 mm (1 Modul DIN)</li>', $descHtml01106);
                $descHtml01106 = str_replace('<li><strong>Lebar:</strong> 71.5 mm</li>', '<li><strong>Kedalaman (Depth):</strong> 71.5 mm</li>', $descHtml01106);
                $descHtml01106 = str_replace('<li><strong>Tinggi:</strong> 81.0 mm</li>', '<li><strong>Tinggi (Height):</strong> 81.0 mm</li>', $descHtml01106);
                $descHtml01106 = str_replace('<li><strong>Berat:</strong> 0.1 kg</li>', '<li><strong>Berat Bersih (Net Weight):</strong> 0.095 kg (95 g)</li>', $descHtml01106);
            }

            $domf01106->update([
                'name' => 'Schneider Electric MCB Domae 1P 6A 6kA DOMF01106',
                'short_description' => 'Schneider Electric MCB Domae 1P 6A 6kA — reference code DOMF01106. Spesifikasi utama: 1 Kutub (1P), Arus Pengenal 6 A, Kapasitas Pemutusan 6 kA (Icn 6000 A pada 230 V AC sesuai standar IEC 60898-1). Dimensi: Tinggi 81 mm, Lebar 18 mm (1 modul DIN), Kedalaman 71.5 mm. Berat bersih: 0.095 kg (95 g). Perlindungan proteksi hubung singkat dan beban lebih untuk sirkuit distribusi listrik.',
                'meta_title' => 'Schneider DOMF01106 MCB Domae 1P 6A 6kA | ATS Tekno',
                'meta_description' => 'Schneider Electric MCB Domae 1P 6A 6kA DOMF01106. Spesifikasi teknis: 1P, 6A, Kapasitas Pemutusan 6 kA (6000 A), 230V AC. Dimensi: 81x18x71.5 mm. Distributor resmi ATS Tekno Surabaya.',
                'description_html' => $descHtml01106,
            ]);

            $specs01106 = [
                ['attribute_code' => 'series', 'label' => 'Seri / Model', 'value' => 'Domae (DOMF)', 'unit' => '', 'sort_order' => 10],
                ['attribute_code' => 'poles_number', 'label' => 'Jumlah Kutub', 'value' => '1P (1 Kutub)', 'unit' => '', 'sort_order' => 20],
                ['attribute_code' => 'rated_current', 'label' => 'Arus Pengenal (In)', 'value' => '6', 'unit' => 'A', 'sort_order' => 30],
                ['attribute_code' => 'breaking_capacity', 'label' => 'Kapasitas Pemutusan (Icn)', 'value' => '6 kA (6000 A)', 'unit' => 'IEC 60898-1', 'sort_order' => 40],
                ['attribute_code' => 'current_type', 'label' => 'Jenis Arus', 'value' => 'AC', 'unit' => '', 'sort_order' => 50],
                ['attribute_code' => 'voltage', 'label' => 'Tegangan Operasional (Ue)', 'value' => '230', 'unit' => 'V', 'sort_order' => 60],
                ['attribute_code' => 'height', 'label' => 'Tinggi (Height)', 'value' => '81.0', 'unit' => 'mm', 'sort_order' => 70],
                ['attribute_code' => 'length', 'label' => 'Lebar (Width)', 'value' => '18.0', 'unit' => 'mm (1 Modul DIN)', 'sort_order' => 80],
                ['attribute_code' => 'width', 'label' => 'Kedalaman (Depth)', 'value' => '71.5', 'unit' => 'mm', 'sort_order' => 90],
                ['attribute_code' => 'weight', 'label' => 'Berat Bersih (Net Weight)', 'value' => '0.095', 'unit' => 'kg (95 g)', 'sort_order' => 100],
            ];

            foreach ($specs01106 as $s) {
                ProductSpecification::updateOrCreate(
                    ['product_id' => $domf01106->id, 'attribute_code' => $s['attribute_code']],
                    $s
                );
            }
            $this->command->info("DOMF01106 calibrated successfully.");
        }

        // =========================================================================
        // 2. CLEAN UP ALL REMAINING DOMF PRODUCTS (DOMF01102 to DOMF01363)
        // =========================================================================
        $allDomfs = Product::where('sku', 'like', 'DOMF%')->where('sku', '!=', 'DOMF01106')->get();
        foreach ($allDomfs as $p) {
            $poles = 1;
            $widthMm = '18.0';
            $widthUnit = 'mm (1 Modul DIN)';
            $weightVal = '0.095';
            $weightUnit = 'kg (95 g)';
            $polesLabel = '1P (1 Kutub)';
            $voltageVal = '230';

            if (str_starts_with($p->sku, 'DOMF012')) {
                $poles = 2;
                $widthMm = '36.0';
                $widthUnit = 'mm (2 Modul DIN)';
                $weightVal = '0.190';
                $weightUnit = 'kg (190 g)';
                $polesLabel = '2P (2 Kutub)';
                $voltageVal = '230/400';
            } elseif (str_starts_with($p->sku, 'DOMF013')) {
                $poles = 3;
                $widthMm = '54.0';
                $widthUnit = 'mm (3 Modul DIN)';
                $weightVal = '0.285';
                $weightUnit = 'kg (285 g)';
                $polesLabel = '3P (3 Kutub)';
                $voltageVal = '400';
            }

            $currentVal = preg_match('/(\d+)\s*A/i', $p->name, $am) ? $am[1] : substr($p->sku, -2);
            $currentVal = ltrim($currentVal, '0') ?: $currentVal;

            $cleanName = preg_replace('/\s*<\s*6\s*k\s*a\b/i', ' 6kA', $p->name);
            $cleanName = trim(preg_replace('/\s+/', ' ', $cleanName));

            $cleanMetaTitle = preg_replace('/\s*<\s*6\s*k\s*a\b/i', ' 6kA', (string)$p->meta_title);

            $cleanMetaDesc = preg_replace('/\s*<\s*6\s*k\s*a\b/i', ' 6kA', (string)$p->meta_description);
            if (empty($cleanMetaDesc) || str_contains($cleanMetaDesc, 'Ref ' . $p->sku)) {
                $cleanMetaDesc = "Schneider Electric {$cleanName}. Ref {$p->sku}. Spesifikasi teknis: {$polesLabel}, {$currentVal}A, Kapasitas Pemutusan 6 kA (6000 A), {$voltageVal}V AC. Lihat spesifikasi lengkap di ATS Tekno.";
            }

            $cleanShortDesc = "Schneider Electric {$cleanName} — reference code {$p->sku}. Spesifikasi utama: {$polesLabel}, Arus Pengenal {$currentVal} A, Kapasitas Pemutusan 6 kA (Icn 6000 A pada {$voltageVal} V AC sesuai standar IEC 60898-1). Dimensi: Tinggi 81 mm, Lebar {$widthMm} mm, Kedalaman 71.5 mm. Berat bersih: {$weightVal} kg. Perlindungan proteksi hubung singkat dan beban lebih untuk sirkuit listrik.";

            // Clean description_html
            $descHtml = $p->description_html;
            if ($descHtml) {
                $descHtml = str_replace('&lt;6KA', '6kA', $descHtml);
                $descHtml = str_replace('&lt;6 kA', '6 kA (6000 A)', $descHtml);
                $descHtml = str_replace('<td>Breaking capacity</td><td>&lt;6 kA</td>', '<td>Breaking capacity (Icn)</td><td>6 kA (6000 A)</td>', $descHtml);
                $descHtml = str_replace('<strong>Kapasitas Pemutusan:</strong> &lt;6 kA', '<strong>Kapasitas Pemutusan (Icn):</strong> 6 kA (6000 A)', $descHtml);
                $descHtml = str_replace("<li><strong>Panjang:</strong> {$widthMm} mm</li>", "<li><strong>Lebar (Width):</strong> {$widthMm} {$widthUnit}</li>", $descHtml);
                $descHtml = str_replace('<li><strong>Lebar:</strong> 71.5 mm</li>', '<li><strong>Kedalaman (Depth):</strong> 71.5 mm</li>', $descHtml);
                $descHtml = str_replace('<li><strong>Tinggi:</strong> 81.0 mm</li>', '<li><strong>Tinggi (Height):</strong> 81.0 mm</li>', $descHtml);
                $descHtml = str_replace("<li><strong>Berat:</strong> 0.1 kg</li>", "<li><strong>Berat Bersih (Net Weight):</strong> {$weightVal} {$weightUnit}</li>", $descHtml);
            }

            $p->update([
                'name' => $cleanName,
                'meta_title' => $cleanMetaTitle,
                'meta_description' => $cleanMetaDesc,
                'short_description' => $cleanShortDesc,
                'description_html' => $descHtml,
            ]);

            ProductSpecification::updateOrCreate(
                ['product_id' => $p->id, 'attribute_code' => 'breaking_capacity'],
                [
                    'label' => 'Kapasitas Pemutusan (Icn)',
                    'value' => '6 kA (6000 A)',
                    'unit' => 'IEC 60898-1',
                    'sort_order' => 40,
                ]
            );

            ProductSpecification::updateOrCreate(
                ['product_id' => $p->id, 'attribute_code' => 'height'],
                [
                    'label' => 'Tinggi (Height)',
                    'value' => '81.0',
                    'unit' => 'mm',
                    'sort_order' => 70,
                ]
            );

            ProductSpecification::updateOrCreate(
                ['product_id' => $p->id, 'attribute_code' => 'length'],
                [
                    'label' => 'Lebar (Width)',
                    'value' => $widthMm,
                    'unit' => $widthUnit,
                    'sort_order' => 80,
                ]
            );

            ProductSpecification::updateOrCreate(
                ['product_id' => $p->id, 'attribute_code' => 'width'],
                [
                    'label' => 'Kedalaman (Depth)',
                    'value' => '71.5',
                    'unit' => 'mm',
                    'sort_order' => 90,
                ]
            );

            ProductSpecification::updateOrCreate(
                ['product_id' => $p->id, 'attribute_code' => 'weight'],
                [
                    'label' => 'Berat Bersih (Net Weight)',
                    'value' => $weightVal,
                    'unit' => $weightUnit,
                    'sort_order' => 100,
                ]
            );
        }
        $this->command->info("All " . $allDomfs->count() . " DOMF products updated.");

        // =========================================================================
        // 3. CLEAN UP REMAINING PRODUCTS WITH '<6' OR '<4.5' IN DB
        // =========================================================================
        $otherBroken = Product::where(function($q) {
            $q->where('name', 'like', '%<6%')
              ->orWhere('name', 'like', '%<4%')
              ->orWhere('short_description', 'like', '%<6%')
              ->orWhere('short_description', 'like', '%<4%')
              ->orWhere('meta_description', 'like', '%<6%')
              ->orWhere('meta_description', 'like', '%<4%')
              ->orWhere('description_html', 'like', '%&lt;6%')
              ->orWhere('description_html', 'like', '%&lt;4%')
              ->orWhere('description_html', 'like', '%<6%')
              ->orWhere('description_html', 'like', '%<4%');
        })->get();

        foreach ($otherBroken as $p) {
            $name = preg_replace('/\s*<\s*6\s*k\s*a\b/i', ' 6kA', $p->name);
            $name = preg_replace('/\s*<\s*4[.,]5\s*k\s*a\b/i', ' 4.5kA', $name);

            $metaDesc = preg_replace('/\s*<\s*6\s*k\s*a\b/i', ' 6kA', (string)$p->meta_description);
            $metaDesc = preg_replace('/\s*<\s*4[.,]5\s*k\s*a\b/i', ' 4.5kA', $metaDesc);

            $shortDesc = preg_replace('/\s*<\s*6\s*k\s*a\b/i', ' 6 kA', (string)$p->short_description);
            $shortDesc = preg_replace('/\s*<\s*4[.,]5\s*k\s*a\b/i', ' 4.5 kA', $shortDesc);

            $descHtml = $p->description_html;
            if ($descHtml) {
                $descHtml = preg_replace('/&lt;\s*6\s*k\s*a\b/i', '6 kA (6000 A)', $descHtml);
                $descHtml = preg_replace('/&lt;\s*4[.,]5\s*k\s*a\b/i', '4.5 kA (4500 A)', $descHtml);
                $descHtml = preg_replace('/&lt;\s*6\s*K\s*A\b/i', '6kA', $descHtml);
                $descHtml = preg_replace('/&lt;\s*4[.,]5\s*K\s*A\b/i', '4.5kA', $descHtml);
            }

            $p->update([
                'name' => trim(preg_replace('/\s+/', ' ', $name)),
                'meta_description' => trim(preg_replace('/\s+/', ' ', $metaDesc)),
                'short_description' => trim(preg_replace('/\s+/', ' ', $shortDesc)),
                'description_html' => $descHtml,
            ]);
        }

        ProductSpecification::where('value', 'like', '%<6%')->update(['value' => '6 kA (6000 A)']);
        ProductSpecification::where('value', 'like', '%<4%')->update(['value' => '4.5 kA (4500 A)']);

        $this->command->info("All '<6' and '<4.5' legacy strings in products, HTML descriptions, and specs cleaned.");
    }
}
