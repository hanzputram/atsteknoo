<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSpecification;
use Illuminate\Database\Seeder;

class FixDomf01106Seeder extends Seeder
{
    /**
     * Correct technical data for DOMF01106 according to verified Schneider Electric Domae datasheet.
     * Verified against official Schneider Electric datasheet:
     * - Domae Miniature Circuit Breaker (MCB)
     * - Reference: DOMF01106
     * - Icn = 6000 A (6 kA) at 230 V AC 50 Hz conforming to IEC 60898-1
     * - Dimensions: Height 81 mm, Width 18 mm (1 module), Depth 71.5 mm
     * - Net weight: 0.095 kg (95 g) / Gross package weight: 0.10 kg
     */
    public function run(): void
    {
        $product = Product::where('sku', 'DOMF01106')->first();

        if (!$product) {
            $this->command->warn("DOMF01106 product not found.");
            return;
        }

        // 1. Update Product attributes
        $product->update([
            'name' => 'MCB Domae 1P 6A 6kA DOMF01106',
            'short_description' => 'Schneider Electric MCB Domae 1P 6A 6kA — reference code DOMF01106. Spesifikasi utama: 1 Kutub, Arus Pengenal 6 A, Kapasitas Pemutusan 6 kA (Icn 6000 A pada 230 V AC sesuai standar IEC 60898-1). Dimensi fisik: Tinggi 81 mm, Lebar 18 mm (1 modul), Kedalaman 71.5 mm. Berat bersih: 0.095 kg (95 g). Perlindungan proteksi hubung singkat dan beban lebih untuk sirkuit listrik.',
            'meta_title' => 'Schneider DOMF01106 MCB Domae 1P 6A | ATS Tekno',
            'meta_description' => 'Schneider DOMF01106 MCB Domae 1P 6A. Spesifikasi teknis: 1P, 6A, Kapasitas Pemutusan 6 kA (6000 A), 230V AC. Lihat datasheet dan konsultasikan kebutuhan pengadaan di distributor resmi ATS Tekno Surabaya.',
        ]);

        // 2. Correct Technical Specifications
        // Breaking Capacity
        ProductSpecification::updateOrCreate(
            ['product_id' => $product->id, 'attribute_code' => 'breaking_capacity'],
            [
                'label' => 'Kapasitas Pemutusan',
                'value' => '6 kA (Icn 6000 A)',
                'unit' => 'IEC 60898-1',
                'sort_order' => 40,
            ]
        );

        // Height (Tinggi)
        ProductSpecification::updateOrCreate(
            ['product_id' => $product->id, 'attribute_code' => 'height'],
            [
                'label' => 'Tinggi',
                'value' => '81.0',
                'unit' => 'mm',
                'sort_order' => 70,
            ]
        );

        // Width (Lebar: 18mm = 1 modul)
        ProductSpecification::updateOrCreate(
            ['product_id' => $product->id, 'attribute_code' => 'length'],
            [
                'label' => 'Lebar (Width)',
                'value' => '18.0',
                'unit' => 'mm (1 Modul)',
                'sort_order' => 80,
            ]
        );

        // Depth (Kedalaman: 71.5mm)
        ProductSpecification::updateOrCreate(
            ['product_id' => $product->id, 'attribute_code' => 'width'],
            [
                'label' => 'Kedalaman (Depth)',
                'value' => '71.5',
                'unit' => 'mm',
                'sort_order' => 90,
            ]
        );

        // Weight (Berat)
        ProductSpecification::updateOrCreate(
            ['product_id' => $product->id, 'attribute_code' => 'weight'],
            [
                'label' => 'Berat Bersih (Net)',
                'value' => '0.095',
                'unit' => 'kg (95 g)',
                'sort_order' => 100,
            ]
        );
    }
}
