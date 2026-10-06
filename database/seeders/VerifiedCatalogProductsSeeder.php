<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\User;
use Illuminate\Database\Seeder;

class VerifiedCatalogProductsSeeder extends Seeder
{
    /**
     * Seed verified catalog products with full technical specifications.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : 1;

        // Ensure Brands exist
        $schneider = Brand::firstOrCreate(
            ['slug' => 'schneider-electric'],
            ['name' => 'Schneider Electric', 'code' => 'SE', 'is_active' => true]
        );
        $vinsa = Brand::firstOrCreate(
            ['slug' => 'vinsa'],
            ['name' => 'Vinsa', 'code' => 'VINSA', 'is_active' => true]
        );
        $legrand = Brand::firstOrCreate(
            ['slug' => 'legrand-indonesia'],
            ['name' => 'Legrand Indonesia', 'code' => 'LEG', 'is_active' => true]
        );
        $gae = Brand::firstOrCreate(
            ['slug' => 'gae-group'],
            ['name' => 'GAE Group', 'code' => 'GAE', 'is_active' => true]
        );
        $supreme = Brand::firstOrCreate(
            ['slug' => 'supreme-cable'],
            ['name' => 'Supreme Cable (SUCACO)', 'code' => 'SUC', 'is_active' => true]
        );

        // Ensure Categories exist
        $catDist = ProductCategory::firstOrCreate(
            ['slug' => 'power-distribution-circuit-breakers'],
            ['code' => 'LV-DIST', 'name' => 'Power Distribution & Circuit Breakers', 'is_active' => true, 'sort_order' => 1]
        );
        $catMotor = ProductCategory::firstOrCreate(
            ['slug' => 'motor-starting-control'],
            ['code' => 'MOTOR-CTRL', 'name' => 'Motor Starting & Control', 'is_active' => true, 'sort_order' => 2]
        );
        $catDrive = ProductCategory::firstOrCreate(
            ['slug' => 'industrial-drives-inverters'],
            ['code' => 'DRIVES', 'name' => 'Industrial Drives & Inverters', 'is_active' => true, 'sort_order' => 3]
        );
        $catEnclosure = ProductCategory::firstOrCreate(
            ['slug' => 'industrial-enclosures-wiring'],
            ['code' => 'CABLE-MGMT', 'name' => 'Industrial Enclosures & Wiring', 'is_active' => true, 'sort_order' => 4]
        );
        $catMeter = ProductCategory::firstOrCreate(
            ['slug' => 'metering-power-quality'],
            ['code' => 'MONITORING', 'name' => 'Metering & Power Quality', 'is_active' => true, 'sort_order' => 5]
        );

        $products = [
            // 1. MCB Domae 6A
            [
                'sku' => 'DOMF01106',
                'name' => 'Schneider Electric MCB Domae 1P 6A 6kA DOMF01106',
                'slug' => 'schneider-electric-mcb-domae-1p-6a-6ka-domf01106',
                'brand_id' => $schneider->id,
                'category_id' => $catDist->id,
                'short_description' => 'Miniature Circuit Breaker (MCB) Domae 1P 6A dengan kapasitas pemutusan 6 kA (Icn 6000 A pada 230V AC) sesuai standar IEC 60898-1. Perlindungan beban lebih dan hubung singkat untuk instalasi residensial dan panel distribusi komersial.',
                'description_html' => '<p>Schneider Electric MCB Domae 1P 6A 6kA (DOMF01106) dirancang khusus untuk proteksi sirkuit penerangan dan stop kontak fase tunggal. Dilengkapi kurva C trip magnetis dengan kapasitas pemutusan hingga 6kA pada tegangan operasional 230V AC.</p><h3>Keunggulan Produk</h3><ul><li>Standar pengujian ketat sesuai standar IEC 60898-1.</li><li>Pemasangan cepat dan presisi pada DIN rail 35 mm modular (1 modul = 18 mm).</li><li>Ketahanan elektrikal dan mekanikal tinggi untuk panel sub-distribusi.</li></ul>',
                'meta_title' => 'Schneider DOMF01106 MCB Domae 1P 6A 6kA | ATS Tekno',
                'meta_description' => 'Schneider Electric MCB Domae 1P 6A 6kA DOMF01106. Spesifikasi teknis: 1P, 6A, Kapasitas Pemutusan 6 kA (6000 A), 230V AC. Dimensi: 81x18x71.5 mm. Distributor resmi ATS Tekno Surabaya.',
                'specs' => [
                    ['attribute_code' => 'series', 'label' => 'Seri / Model', 'value' => 'Domae (DOMF)', 'unit' => '', 'sort_order' => 10],
                    ['attribute_code' => 'poles_number', 'label' => 'Jumlah Kutub', 'value' => '1P (1 Kutub)', 'unit' => '', 'sort_order' => 20],
                    ['attribute_code' => 'rated_current', 'label' => 'Arus Pengenal (In)', 'value' => '6', 'unit' => 'A', 'sort_order' => 30],
                    ['attribute_code' => 'breaking_capacity', 'label' => 'Kapasitas Pemutusan (Icn)', 'value' => '6 kA (6000 A)', 'unit' => 'IEC 60898-1', 'sort_order' => 40],
                    ['attribute_code' => 'curve_code', 'label' => 'Kurva Karakteristik', 'value' => 'Kurva C', 'unit' => '', 'sort_order' => 45],
                    ['attribute_code' => 'voltage', 'label' => 'Tegangan Operasional (Ue)', 'value' => '230', 'unit' => 'V AC', 'sort_order' => 50],
                    ['attribute_code' => 'height', 'label' => 'Tinggi (Height)', 'value' => '81.0', 'unit' => 'mm', 'sort_order' => 60],
                    ['attribute_code' => 'length', 'label' => 'Lebar (Width)', 'value' => '18.0', 'unit' => 'mm (1 Modul DIN)', 'sort_order' => 70],
                    ['attribute_code' => 'width', 'label' => 'Kedalaman (Depth)', 'value' => '71.5', 'unit' => 'mm', 'sort_order' => 80],
                    ['attribute_code' => 'weight', 'label' => 'Berat Bersih (Net Weight)', 'value' => '0.095', 'unit' => 'kg (95 g)', 'sort_order' => 90],
                ],
            ],
            // 2. MCB Domae 16A
            [
                'sku' => 'DOMF01116',
                'name' => 'Schneider Electric MCB Domae 1P 16A 6kA DOMF01116',
                'slug' => 'schneider-electric-mcb-domae-1p-16a-6ka-domf01116',
                'brand_id' => $schneider->id,
                'category_id' => $catDist->id,
                'short_description' => 'Miniature Circuit Breaker (MCB) Domae 1P 16A dengan kapasitas pemutusan 6 kA (Icn 6000 A pada 230V AC). Cocok untuk sirkuit stop kontak daya, unit pendingin udara (AC), dan panel distribusi komersial.',
                'description_html' => '<p>Schneider Electric MCB Domae 1P 16A 6kA (DOMF01116) memberikan proteksi optimal terhadap sirkuit dengan beban menengah hingga sekitar 3.500VA pada tegangan 230V AC.</p>',
                'meta_title' => 'Schneider DOMF01116 MCB Domae 1P 16A 6kA | ATS Tekno',
                'meta_description' => 'Schneider Electric MCB Domae 1P 16A 6kA DOMF01116. Spesifikasi teknis: 1P, 16A, Kapasitas Pemutusan 6 kA (6000 A), 230V AC. Distributor resmi ATS Tekno Surabaya.',
                'specs' => [
                    ['attribute_code' => 'series', 'label' => 'Seri / Model', 'value' => 'Domae (DOMF)', 'unit' => '', 'sort_order' => 10],
                    ['attribute_code' => 'poles_number', 'label' => 'Jumlah Kutub', 'value' => '1P (1 Kutub)', 'unit' => '', 'sort_order' => 20],
                    ['attribute_code' => 'rated_current', 'label' => 'Arus Pengenal (In)', 'value' => '16', 'unit' => 'A', 'sort_order' => 30],
                    ['attribute_code' => 'breaking_capacity', 'label' => 'Kapasitas Pemutusan (Icn)', 'value' => '6 kA (6000 A)', 'unit' => 'IEC 60898-1', 'sort_order' => 40],
                    ['attribute_code' => 'voltage', 'label' => 'Tegangan Operasional (Ue)', 'value' => '230', 'unit' => 'V AC', 'sort_order' => 50],
                    ['attribute_code' => 'length', 'label' => 'Lebar (Width)', 'value' => '18.0', 'unit' => 'mm (1 Modul DIN)', 'sort_order' => 60],
                ],
            ],
            // 3. MCCB EZC100F 100A
            [
                'sku' => 'EZC100F3100',
                'name' => 'Schneider Electric MCCB EasyPact EZC100F 3P 100A 10kA EZC100F3100',
                'slug' => 'schneider-electric-mccb-ezc100f-3p-100a-10ka-ezc100f3100',
                'brand_id' => $schneider->id,
                'category_id' => $catDist->id,
                'short_description' => 'Molded Case Circuit Breaker (MCCB) EasyPact EZC100F 3 Kutub (3P) 100A dengan breaking capacity 10 kA pada 415V AC. Ideal sebagai main incomer dan proteksi feeder panel distribusi industri LVMDP/SDP.',
                'description_html' => '<p>Schneider Electric EasyPact EZC100F 3P 100A 10kA (EZC100F3100) adalah pemutus tenaga kompak berdaya tahan tinggi yang dirancang untuk instalasi kelistrikan tegangan rendah pada sektor manufaktur, perhotelan, dan infrastruktur komersial.</p>',
                'meta_title' => 'Schneider EZC100F3100 MCCB 3P 100A 10kA | ATS Tekno',
                'meta_description' => 'Schneider Electric MCCB EasyPact EZC100F 3P 100A 10kA EZC100F3100. Spesifikasi: 3 Kutub, 100A, 10kA 415V. Ready stock distributor resmi ATS Tekno Surabaya.',
                'specs' => [
                    ['attribute_code' => 'series', 'label' => 'Seri / Model', 'value' => 'EasyPact EZC100F', 'unit' => '', 'sort_order' => 10],
                    ['attribute_code' => 'poles_number', 'label' => 'Jumlah Kutub', 'value' => '3P (3 Kutub)', 'unit' => '', 'sort_order' => 20],
                    ['attribute_code' => 'rated_current', 'label' => 'Arus Pengenal (In)', 'value' => '100', 'unit' => 'A', 'sort_order' => 30],
                    ['attribute_code' => 'breaking_capacity', 'label' => 'Kapasitas Pemutusan (Icu)', 'value' => '10', 'unit' => 'kA pada 415V AC', 'sort_order' => 40],
                    ['attribute_code' => 'trip_unit', 'label' => 'Tipe Trip Unit', 'value' => 'Thermal-Magnetic Fixed (TMD)', 'unit' => '', 'sort_order' => 50],
                    ['attribute_code' => 'standard', 'label' => 'Standar Uji', 'value' => 'IEC 60947-2', 'unit' => '', 'sort_order' => 60],
                ],
            ],
            // 4. Contactor TeSys Deca LC1D09M7
            [
                'sku' => 'LC1D09M7-DECA',
                'name' => 'Schneider Electric Kontaktor TeSys Deca 3P 9A 4kW 220VAC LC1D09M7-DECA',
                'slug' => 'schneider-electric-kontaktor-tesys-deca-3p-9a-4kw-220vac-lc1d09m7-deca',
                'brand_id' => $schneider->id,
                'category_id' => $catMotor->id,
                'short_description' => 'Magnetic Contactor TeSys Deca 3-Pole 9A AC-3 untuk kontrol motor listrik 3 fasa hingga 4kW pada 220-240V AC. Dilengkapi 1 NO + 1 NC kontak bantu built-in dan koil kontrol 220V AC 50/60Hz.',
                'description_html' => '<p>Kontaktor TeSys Deca LC1D09M7 dari Schneider Electric menawarkan keandalan elektromekanis tertinggi untuk kontrol motor direct-on-line (DOL) dan reversing starter.</p>',
                'meta_title' => 'Schneider LC1D09M7 Kontaktor TeSys Deca 3P 9A 220V | ATS Tekno',
                'meta_description' => 'Kontaktor Schneider TeSys Deca 3P 9A 4kW 220VAC LC1D09M7. Dilengkapi 1NO+1NC kontak bantu. Distributor resmi ATS Tekno Surabaya.',
                'specs' => [
                    ['attribute_code' => 'series', 'label' => 'Seri / Model', 'value' => 'TeSys Deca', 'unit' => '', 'sort_order' => 10],
                    ['attribute_code' => 'poles_number', 'label' => 'Jumlah Kutub', 'value' => '3P (3 NO)', 'unit' => '', 'sort_order' => 20],
                    ['attribute_code' => 'rated_current', 'label' => 'Arus Pengenal (AC-3)', 'value' => '9', 'unit' => 'A', 'sort_order' => 30],
                    ['attribute_code' => 'motor_power', 'label' => 'Daya Motor Maksimal', 'value' => '4', 'unit' => 'kW (pada 220-240V AC)', 'sort_order' => 40],
                    ['attribute_code' => 'coil_voltage', 'label' => 'Tegangan Koil Kontrol', 'value' => '220', 'unit' => 'V AC 50/60Hz', 'sort_order' => 50],
                    ['attribute_code' => 'aux_contacts', 'label' => 'Kontak Bantu Bawaan', 'value' => '1 NO + 1 NC', 'unit' => '', 'sort_order' => 60],
                ],
            ],
            // 5. Inverter Altivar ATV310
            [
                'sku' => 'ATV310HU15N4E',
                'name' => 'Schneider Electric Inverter Altivar ATV310 3P 1.5kW 2HP 380-460VAC ATV310HU15N4E',
                'slug' => 'schneider-electric-inverter-atv310-3p-1-5kw-2hp-380-460-vac-atv310hu15n4e',
                'brand_id' => $schneider->id,
                'category_id' => $catDrive->id,
                'short_description' => 'Variable Speed Drive (VFD / Inverter) Altivar Easy ATV310 3-Fasa 1.5kW (2 HP) 380-460V AC. Solusi hemat energi dan pengaturan kecepatan presisi untuk motor pompa, blower, fan, dan konveyor industri.',
                'description_html' => '<p>Schneider Electric Altivar ATV310HU15N4E dirancang tangguh untuk lingkungan industri berat dengan lapisan PCB tahan korosi dan antarmuka pemrograman terintegrasi Modbus RTU.</p>',
                'meta_title' => 'Schneider ATV310HU15N4E Inverter 1.5kW 2HP 380V | ATS Tekno',
                'meta_description' => 'Inverter VFD Schneider Altivar ATV310 1.5kW 2HP 380-460V 3 Fasa ATV310HU15N4E. Distributor resmi ATS Tekno Surabaya ready stock.',
                'specs' => [
                    ['attribute_code' => 'series', 'label' => 'Seri / Model', 'value' => 'Altivar Easy 310 (ATV310)', 'unit' => '', 'sort_order' => 10],
                    ['attribute_code' => 'motor_power_kw', 'label' => 'Daya Motor (kW)', 'value' => '1.5', 'unit' => 'kW', 'sort_order' => 20],
                    ['attribute_code' => 'motor_power_hp', 'label' => 'Daya Motor (HP)', 'value' => '2.0', 'unit' => 'HP', 'sort_order' => 30],
                    ['attribute_code' => 'voltage', 'label' => 'Tegangan Suplai', 'value' => '380 - 460', 'unit' => 'V AC 3-Fasa', 'sort_order' => 40],
                    ['attribute_code' => 'communication', 'label' => 'Komunikasi', 'value' => 'RS485 Modbus RTU', 'unit' => '', 'sort_order' => 50],
                ],
            ],
            // 6. Vinsa Box Panel
            [
                'sku' => 'VINSA-WM-403020',
                'name' => 'Vinsa Box Panel Wall Mounting 40x30x20cm Powder Coating IP55',
                'slug' => 'vinsa-box-panel-wall-mounting-40x30x20cm-powder-coating',
                'brand_id' => $vinsa->id,
                'category_id' => $catEnclosure->id,
                'short_description' => 'Box panel listrik wall mounting plat besi tebal 1.5mm dengan finishing electrostatic powder coating RAL 7032/7035 dan proteksi IP55 tahan debu dan percikan air untuk sub-panel industri.',
                'description_html' => '<p>Vinsa Box Panel Wall Mounting 40x30x20cm memberikan perlindungan fisik maksimal untuk komponen kontrol dan distribusi. Dilengkapi kunci push lock, karet gasket kedap air, dan plat mounting dalam.</p>',
                'meta_title' => 'Vinsa Box Panel Wall Mounting 40x30x20cm IP55 | ATS Tekno',
                'meta_description' => 'Box Panel Vinsa Wall Mounting 40x30x20cm plat besi powder coating IP55. Supplier resmi ATS Tekno Surabaya ready stock.',
                'specs' => [
                    ['attribute_code' => 'material', 'label' => 'Material Plat', 'value' => 'Cold Rolled Steel Sheet', 'unit' => 'Tebal 1.5mm', 'sort_order' => 10],
                    ['attribute_code' => 'dimensions', 'label' => 'Dimensi (T x L x D)', 'value' => '400 x 300 x 200', 'unit' => 'mm', 'sort_order' => 20],
                    ['attribute_code' => 'protection', 'label' => 'Tingkat Proteksi (Ingress)', 'value' => 'IP55', 'unit' => '', 'sort_order' => 30],
                    ['attribute_code' => 'coating', 'label' => 'Pengecatan', 'value' => 'Electrostatic Powder Coating', 'unit' => 'RAL 7032', 'sort_order' => 40],
                ],
            ],
            // 7. GAE EM-3000
            [
                'sku' => 'GAE-EM-3000',
                'name' => 'GAE Digital Power Meter EM-3000 Multifunction Energy Analyzer',
                'slug' => 'gae-digital-power-meter-em-3000-multifunction-analyzer',
                'brand_id' => $gae->id,
                'category_id' => $catMeter->id,
                'short_description' => 'Digital Power Meter Multifungsi kelas akurasi 0.5S untuk pengukuran tegangan, arus, daya aktif (kW), daya reaktif (kVAR), cos phi (PF), frekuensi (Hz), dan THD dengan port komunikasi RS485 Modbus RTU.',
                'description_html' => '<p>GAE EM-3000 adalah analyzer daya digital presisi tinggi untuk pemantauan kualitas daya pada panel utama LVMDP dan sistem otomasi gedung industri.</p>',
                'meta_title' => 'GAE EM-3000 Digital Power Meter RS485 Modbus | ATS Tekno',
                'meta_description' => 'GAE Digital Power Meter EM-3000 Multifungsi akurasi 0.5S dengan RS485 Modbus RTU. Distributor resmi ATS Tekno Surabaya.',
                'specs' => [
                    ['attribute_code' => 'accuracy', 'label' => 'Kelas Akurasi', 'value' => 'Class 0.5S', 'unit' => 'IEC 62053-22', 'sort_order' => 10],
                    ['attribute_code' => 'measurement', 'label' => 'Parameter Ukur', 'value' => 'V, I, kW, kVAR, kVA, kWh, PF, Hz, THD', 'unit' => '', 'sort_order' => 20],
                    ['attribute_code' => 'communication', 'label' => 'Antarmuka Komunikasi', 'value' => 'RS-485 Modbus RTU', 'unit' => '', 'sort_order' => 30],
                    ['attribute_code' => 'display', 'label' => 'Layar Tampilan', 'value' => 'Backlit LCD High Contrast', 'unit' => '', 'sort_order' => 40],
                ],
            ],
            // 8. Legrand Plexo
            [
                'sku' => 'LEG-001924',
                'name' => 'Legrand Plexo Weatherproof Enclosure IP66 12 Modules',
                'slug' => 'legrand-plexo-weatherproof-enclosure-ip66-12-modules',
                'brand_id' => $legrand->id,
                'category_id' => $catEnclosure->id,
                'short_description' => 'Box panel modular surface mounting Legrand Plexo IP66 IK09 untuk 12 modul rel DIN. Tahan cuaca ekstrem, debu tebal, semprotan air kuat, dan benturan fisik berat.',
                'description_html' => '<p>Legrand Plexo 001924 dibuat dari bahan polistirena self-extinguishing tahan sinar UV untuk lokasi outdoor dan area pabrik dengan atmosfer korosif.</p>',
                'meta_title' => 'Legrand Plexo IP66 12 Modules 001924 | ATS Tekno',
                'meta_description' => 'Legrand Plexo Weatherproof Box IP66 12 Modul DIN Rail 001924. Distributor resmi Legrand ATS Tekno Surabaya.',
                'specs' => [
                    ['attribute_code' => 'capacity', 'label' => 'Kapasitas Modul', 'value' => '12', 'unit' => 'Modul DIN Rail (1 Baris)', 'sort_order' => 10],
                    ['attribute_code' => 'protection_ip', 'label' => 'Tingkat Ketahanan Air (IP)', 'value' => 'IP66', 'unit' => '', 'sort_order' => 20],
                    ['attribute_code' => 'protection_ik', 'label' => 'Ketahanan Benturan (IK)', 'value' => 'IK09', 'unit' => '', 'sort_order' => 30],
                ],
            ],
        ];

        foreach ($products as $pData) {
            $product = Product::updateOrCreate(
                ['sku' => $pData['sku']],
                [
                    'normalized_sku' => Product::normalizeSku($pData['sku']),
                    'name' => $pData['name'],
                    'slug' => $pData['slug'],
                    'short_description' => $pData['short_description'],
                    'description_html' => $pData['description_html'],
                    'brand_id' => $pData['brand_id'],
                    'primary_category_id' => $pData['category_id'],
                    'meta_title' => $pData['meta_title'],
                    'meta_description' => $pData['meta_description'],
                    'status' => 'published',
                    'published_at' => now(),
                    'is_featured' => true,
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                ]
            );

            $product->categories()->sync([$pData['category_id']]);

            foreach ($pData['specs'] as $s) {
                ProductSpecification::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'attribute_code' => $s['attribute_code'],
                    ],
                    [
                        'label' => $s['label'],
                        'value' => $s['value'],
                        'unit' => $s['unit'],
                        'sort_order' => $s['sort_order'],
                    ]
                );
            }
        }
    }
}
