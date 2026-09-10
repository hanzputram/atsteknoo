<?php

namespace Database\Seeders;

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
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InitialCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (! $admin) {
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@atstekno.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]);
        }
        $adminId = $admin->id;

        // 1. Site Settings
        $settings = [
            'company_name' => 'PT. ANUGERAH TAMA SEJATI',
            'company_tagline' => 'Best Electrical Supplier',
            'phone' => '(031) 59178887',
            'whatsapp' => '081234567890',
            'email' => 'sales@anugerahtamasejati.com',
            'address' => 'Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya, East Java, Indonesia',
            'city' => 'Surabaya',
            'postal_code' => '60134',
            'default_meta_title' => 'PT. Anugerah Tama Sejati - Best Electrical Supplier',
            'default_meta_description' => 'PT. Anugerah Tama Sejati - Your trusted one-stop supplier for all electrical and wiring components. Authorized Schneider Electric Distributor Surabaya.',
        ];
        foreach ($settings as $k => $v) {
            SiteSetting::set($k, $v);
        }

        // 2. About Us Page
        Page::updateOrCreate(
            ['page_key' => 'about-us'],
            [
                'title' => 'About PT. Anugerah Tama Sejati',
                'slug' => 'about-us',
                'content_html' => '<h2>Your Trusted Electrical Engineering Partner</h2><p>PT. Anugerah Tama Sejati (ATS) is an established premier electrical component distributor headquartered in Surabaya, East Java. Serving industrial EPCs, panel builders, contractors, and original equipment manufacturers across Indonesia, we provide genuine, certified electrical distribution and industrial automation components.</p><h3>Authorized Official Distributor</h3><p>As an authorized partner for global leaders including Schneider Electric, GAE, Legrand, and Socomec, we guarantee 100% genuine products with manufacturer warranties, origin documentation, and expert engineering consultation.</p>',
                'sections_data' => [
                    'vision' => 'To become Indonesia\'s most dependable, technologically advanced, and customer-centric electrical engineering supplier.',
                    'mission' => 'Delivering authentic electrical components promptly, offering certified engineering sizing guidance, and fostering long-term industrial partnerships with integrity.',
                    'established_year' => '2010',
                ],
                'meta_title' => 'About Us - PT. Anugerah Tama Sejati',
                'meta_description' => 'Learn about PT. Anugerah Tama Sejati, premier authorized electrical and automation distributor in Surabaya, Indonesia.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]
        );

        // 3. Brands
        $brandsData = [
            ['code' => 'SE', 'name' => 'Schneider Electric', 'slug' => 'schneider-electric', 'website_url' => 'https://www.se.com/id'],
            ['code' => 'GAE', 'name' => 'GAE Group', 'slug' => 'gae-group', 'website_url' => 'https://gae.co.id'],
            ['code' => 'LEGRAND', 'name' => 'Legrand Indonesia', 'slug' => 'legrand-indonesia', 'website_url' => 'https://www.legrand.co.id'],
            ['code' => 'SOCOMEC', 'name' => 'Socomec', 'slug' => 'socomec', 'website_url' => 'https://www.socomec.com'],
            ['code' => 'AUTONICS', 'name' => 'Autonics', 'slug' => 'autonics', 'website_url' => 'https://www.autonics.com'],
            ['code' => 'HIMEL', 'name' => 'Himel', 'slug' => 'himel', 'website_url' => 'https://www.himel.com'],
            ['code' => 'PANASONIC', 'name' => 'Panasonic', 'slug' => 'panasonic', 'website_url' => 'https://www.panasonic.com/id'],
            ['code' => 'PHILIPS', 'name' => 'Philips Lighting', 'slug' => 'philips-lighting', 'website_url' => 'https://www.lighting.philips.co.id'],
            ['code' => 'FLUKE', 'name' => 'Fluke Corporation', 'slug' => 'fluke-corporation', 'website_url' => 'https://www.fluke.com'],
            ['code' => 'BOSS', 'name' => 'Boss Electrical', 'slug' => 'boss-electrical', 'website_url' => 'https://bosselectrical.com'],
            ['code' => 'JEMBO', 'name' => 'Jembo Cable', 'slug' => 'jembo-cable', 'website_url' => 'https://www.jembo.com'],
            ['code' => 'SUPREME', 'name' => 'Supreme Cable (SUCACO)', 'slug' => 'supreme-cable', 'website_url' => 'https://www.sucaco.com'],
        ];

        $brandModels = [];
        $order = 1;
        foreach ($brandsData as $b) {
            $brandModels[$b['code']] = Brand::updateOrCreate(
                ['code' => $b['code']],
                [
                    'name' => $b['name'],
                    'slug' => $b['slug'],
                    'description_html' => "<p>Authorized partner and official dealer of {$b['name']} products in Indonesia.</p>",
                    'website_url' => $b['website_url'],
                    'sort_order' => $order++,
                    'is_active' => true,
                ]
            );
        }

        // 4. Product Categories
        $categoriesData = [
            ['code' => 'DISTRIBUTION', 'name' => 'Power Distribution & Circuit Breakers', 'slug' => 'power-distribution-circuit-breakers'],
            ['code' => 'MOTOR-CTRL', 'name' => 'Motor Starting & Control', 'slug' => 'motor-starting-control'],
            ['code' => 'AUTOMATION', 'name' => 'Industrial Drives & Inverters', 'slug' => 'industrial-drives-inverters'],
            ['code' => 'CABLE-MGMT', 'name' => 'Industrial Enclosures & Wiring', 'slug' => 'industrial-enclosures-wiring'],
            ['code' => 'MONITORING', 'name' => 'Metering & Power Quality', 'slug' => 'metering-power-quality'],
        ];

        $catModels = [];
        $order = 1;
        foreach ($categoriesData as $c) {
            $catModels[$c['code']] = ProductCategory::updateOrCreate(
                ['code' => $c['code']],
                [
                    'name' => $c['name'],
                    'slug' => $c['slug'],
                    'description' => "High-quality {$c['name']} components for industrial and commercial switchboards.",
                    'sort_order' => $order++,
                    'is_active' => true,
                ]
            );
        }

        // 5. Products (Sample genuine electrical catalog without sales/price fields)
        $productsData = [
            [
                'sku' => 'SE-MTZ1-08H1',
                'name' => 'Schneider MasterPact MTZ1 08 H1 Air Circuit Breaker (ACB)',
                'slug' => 'schneider-masterpact-mtz1-08h1-acb',
                'short_description' => 'Air Circuit Breaker (ACB) 800A 3-Pole 42kA with Micrologic 2.0X trip unit.',
                'description_html' => '<p>MasterPact MTZ1 embeds advanced class 1 metering and digital connectivity into standard low-voltage main switchboard applications. Designed to optimize uptime and electrical safety.</p>',
                'brand_code' => 'SE',
                'category_code' => 'DISTRIBUTION',
                'specs' => [
                    ['attribute_code' => 'rated_current', 'label' => 'Rated Current (In)', 'value' => '800', 'unit' => 'A', 'group' => 'Electrical'],
                    ['attribute_code' => 'number_of_poles', 'label' => 'Number of Poles', 'value' => '3P', 'unit' => null, 'group' => 'Mechanical'],
                    ['attribute_code' => 'breaking_capacity', 'label' => 'Breaking Capacity (Icu)', 'value' => '42', 'unit' => 'kA at 415V', 'group' => 'Electrical'],
                    ['attribute_code' => 'trip_unit', 'label' => 'Trip Unit Model', 'value' => 'Micrologic 2.0X', 'unit' => null, 'group' => 'Protection'],
                    ['attribute_code' => 'standard', 'label' => 'Standard Certification', 'value' => 'IEC 60947-2', 'unit' => null, 'group' => 'Compliance'],
                ],
            ],
            [
                'sku' => 'SE-NSX100F-TM80D',
                'name' => 'Schneider ComPact NSX100F 80A 3P 36kA MCCB',
                'slug' => 'schneider-compact-nsx100f-80a-3p-36ka-mccb',
                'short_description' => 'Molded Case Circuit Breaker (MCCB) 80A 3-Pole 36kA with TM-D thermal-magnetic trip unit.',
                'description_html' => '<p>ComPact NSX100F is a complete circuit breaker optimized for industrial feeder protection, switchboard sub-distribution, and motor feeders.</p>',
                'brand_code' => 'SE',
                'category_code' => 'DISTRIBUTION',
                'specs' => [
                    ['attribute_code' => 'rated_current', 'label' => 'Rated Current (In)', 'value' => '80', 'unit' => 'A', 'group' => 'Electrical'],
                    ['attribute_code' => 'number_of_poles', 'label' => 'Number of Poles', 'value' => '3P 3D', 'unit' => null, 'group' => 'Mechanical'],
                    ['attribute_code' => 'breaking_capacity', 'label' => 'Breaking Capacity (Icu)', 'value' => '36', 'unit' => 'kA at 415V', 'group' => 'Electrical'],
                    ['attribute_code' => 'trip_unit', 'label' => 'Trip Unit', 'value' => 'TM-D Thermal Magnetic', 'unit' => null, 'group' => 'Protection'],
                ],
            ],
            [
                'sku' => 'SE-ATV630U55N4',
                'name' => 'Schneider Altivar Process ATV630 5.5kW Variable Speed Drive',
                'slug' => 'schneider-altivar-process-atv630-5kw-vfd',
                'short_description' => 'Variable Speed Drive (VFD/Inverter) 5.5kW / 7.5HP 380-480V 3-Phase for pumps and fans.',
                'description_html' => '<p>Altivar Process ATV630 variable speed drive focuses on fluid management processing and energy efficiency. Built-in Ethernet dual port and embedded web server.</p>',
                'brand_code' => 'SE',
                'category_code' => 'AUTOMATION',
                'specs' => [
                    ['attribute_code' => 'motor_power', 'label' => 'Motor Power', 'value' => '5.5', 'unit' => 'kW', 'group' => 'Rating'],
                    ['attribute_code' => 'supply_voltage', 'label' => 'Supply Voltage', 'value' => '380 - 480', 'unit' => 'V AC', 'group' => 'Electrical'],
                    ['attribute_code' => 'nominal_output_current', 'label' => 'Nominal Output Current', 'value' => '12.7', 'unit' => 'A', 'group' => 'Electrical'],
                    ['attribute_code' => 'ip_degree', 'label' => 'IP Degree of Protection', 'value' => 'IP21', 'unit' => null, 'group' => 'Physical'],
                ],
            ],
            [
                'sku' => 'SE-LC1D25M7',
                'name' => 'Schneider TeSys D Contactor LC1D25 25A 220V AC',
                'slug' => 'schneider-tesys-d-contactor-lc1d25m7',
                'short_description' => '3-Pole Magnetic Contactor 25A AC-3 11kW with 220V AC 50/60Hz control coil.',
                'description_html' => '<p>TeSys D contactor combines high reliability with mechanical robustness, offering 1 NO + 1 NC auxiliary contacts built-in.</p>',
                'brand_code' => 'SE',
                'category_code' => 'MOTOR-CTRL',
                'specs' => [
                    ['attribute_code' => 'rated_current_ac3', 'label' => 'Rated Current (AC-3)', 'value' => '25', 'unit' => 'A', 'group' => 'Electrical'],
                    ['attribute_code' => 'coil_voltage', 'label' => 'Control Coil Voltage', 'value' => '220', 'unit' => 'V AC 50/60Hz', 'group' => 'Control'],
                    ['attribute_code' => 'motor_power_kw', 'label' => 'Motor Power at 400V', 'value' => '11', 'unit' => 'kW', 'group' => 'Rating'],
                    ['attribute_code' => 'aux_contacts', 'label' => 'Auxiliary Contacts', 'value' => '1 NO + 1 NC', 'unit' => null, 'group' => 'Mechanical'],
                ],
            ],
            [
                'sku' => 'LEG-001924',
                'name' => 'Legrand Plexo™ Weatherproof Enclosure IP66 12 Modules',
                'slug' => 'legrand-plexo-weatherproof-enclosure-ip66-12-modules',
                'short_description' => 'Surface mounting industrial IP66 weatherproof enclosure box for 12 DIN rail modules.',
                'description_html' => '<p>Plexo modular industrial enclosure boxes withstand tough weather, dust, and humid atmospheres with self-extinguishing polystyrene construction.</p>',
                'brand_code' => 'LEGRAND',
                'category_code' => 'CABLE-MGMT',
                'specs' => [
                    ['attribute_code' => 'ip_rating', 'label' => 'Ingress Protection', 'value' => 'IP66', 'unit' => null, 'group' => 'Enclosure'],
                    ['attribute_code' => 'ik_rating', 'label' => 'Impact Resistance', 'value' => 'IK09', 'unit' => null, 'group' => 'Enclosure'],
                    ['attribute_code' => 'capacity', 'label' => 'Module Capacity', 'value' => '12', 'unit' => 'Modules (1 Row)', 'group' => 'Dimensions'],
                    ['attribute_code' => 'material', 'label' => 'Body Material', 'value' => 'Self-extinguishing Polystyrene', 'unit' => null, 'group' => 'Material'],
                ],
            ],
            [
                'sku' => 'GAE-EM-3000',
                'name' => 'GAE Digital Power Meter EM-3000 Multifunction Analyzer',
                'slug' => 'gae-digital-power-meter-em3000',
                'short_description' => 'Class 0.5S digital 3-phase multifunction energy meter with RS485 Modbus RTU.',
                'description_html' => '<p>GAE EM-3000 delivers true RMS measurement of voltage, current, active power, reactive power, power factor, frequency, and total harmonic distortion (THD).</p>',
                'brand_code' => 'GAE',
                'category_code' => 'MONITORING',
                'specs' => [
                    ['attribute_code' => 'accuracy_class', 'label' => 'Active Energy Accuracy', 'value' => 'Class 0.5S', 'unit' => null, 'group' => 'Metering'],
                    ['attribute_code' => 'communication', 'label' => 'Communication Interface', 'value' => 'RS-485 Modbus RTU', 'unit' => null, 'group' => 'Connectivity'],
                    ['attribute_code' => 'measurement_range', 'label' => 'Input Voltage Range', 'value' => '50 - 480', 'unit' => 'V AC (L-L)', 'group' => 'Electrical'],
                ],
            ],
        ];

        foreach ($productsData as $pData) {
            $brand = $brandModels[$pData['brand_code']] ?? null;
            $cat = $catModels[$pData['category_code']] ?? null;

            $product = Product::updateOrCreate(
                ['normalized_sku' => Product::normalizeSku($pData['sku'])],
                [
                    'sku' => $pData['sku'],
                    'name' => $pData['name'],
                    'slug' => $pData['slug'],
                    'short_description' => $pData['short_description'],
                    'description_html' => $pData['description_html'],
                    'brand_id' => $brand ? $brand->id : null,
                    'primary_category_id' => $cat ? $cat->id : null,
                    'status' => 'published',
                    'published_at' => now(),
                    'is_featured' => true,
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                ]
            );

            if ($cat) {
                $product->categories()->sync([$cat->id]);
            }

            foreach ($pData['specs'] as $s) {
                ProductSpecification::updateOrCreate(
                    ['product_id' => $product->id, 'attribute_code' => $s['attribute_code']],
                    [
                        'label' => $s['label'],
                        'value' => $s['value'],
                        'unit' => $s['unit'],
                        'group' => $s['group'],
                    ]
                );
            }
        }

        // 6. Project Categories & Projects
        $projCat1 = ProjectCategory::updateOrCreate(['code' => 'SUBSTATION'], ['name' => 'Substation & Main Switchboard', 'slug' => 'substation-main-switchboard']);
        $projCat2 = ProjectCategory::updateOrCreate(['code' => 'COLDSTORAGE'], ['name' => 'Cold Storage & HVAC Automation', 'slug' => 'cold-storage-hvac-automation']);
        $projCat3 = ProjectCategory::updateOrCreate(['code' => 'FACTORY'], ['name' => 'Industrial Manufacturing Plant', 'slug' => 'industrial-manufacturing-plant']);

        Project::updateOrCreate(
            ['project_code' => 'PRJ-SUB-2500A'],
            [
                'title' => '2500A Low Voltage Main Distribution Panel (LVMDP) Substation',
                'slug' => '2500a-low-voltage-main-distribution-panel-substation',
                'summary' => 'Engineering assembly and component supply of dual-incomer 2500A Schneider MasterPact MTZ Air Circuit Breakers.',
                'content_html' => '<p>Supply and integration of primary distribution switchboard for a heavy industrial plant in East Java. Fitted with Schneider MasterPact MTZ ACB, busbar sizing, and GAE power quality analyzer metering.</p>',
                'category_id' => $projCat1->id,
                'location' => 'Gresik, East Java',
                'completion_year' => '2024',
                'scope_of_work' => 'Component Supply, Technical BoQ Consultation, Busbar Coordination',
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]
        );

        Project::updateOrCreate(
            ['project_code' => 'PRJ-COLD-01'],
            [
                'title' => 'Cold Storage Precision Temperature & Motor Control Center (MCC)',
                'slug' => 'cold-storage-precision-temperature-motor-control-center',
                'summary' => 'Multi-compressor motor control center utilizing Schneider Altivar ATV630 VFDs and TeSys D contactors.',
                'content_html' => '<p>Turnkey motor management system for seafood cold storage facility in Surabaya. Ensured seamless inverter speed modulation, energy conservation, and automated backup switching.</p>',
                'category_id' => $projCat2->id,
                'location' => 'Surabaya, East Java',
                'completion_year' => '2025',
                'scope_of_work' => 'MCC Panel Supply, VFD Inverter Tuning, Harmonics Filtration',
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]
        );

        // 7. Article Categories & Articles
        $artCat = ArticleCategory::updateOrCreate(['code' => 'TECH-GUIDE'], ['name' => 'Technical Engineering Guides', 'slug' => 'technical-engineering-guides']);
        $tag1 = Tag::updateOrCreate(['slug' => 'circuit-breaker'], ['name' => 'Circuit Breaker']);
        $tag2 = Tag::updateOrCreate(['slug' => 'schneider'], ['name' => 'Schneider Electric']);
        $tag3 = Tag::updateOrCreate(['slug' => 'maintenance'], ['name' => 'Maintenance']);

        $art1 = Article::updateOrCreate(
            ['slug' => 'how-to-select-mccb-vs-acb-for-industrial-panels'],
            [
                'title' => 'How to Select Between MCCB and ACB for Industrial Main Switchboards',
                'excerpt' => 'A comprehensive technical comparison between Molded Case Circuit Breakers (MCCB) and Air Circuit Breakers (ACB) in industrial low-voltage distribution.',
                'content_html' => '<p>Selecting between Molded Case Circuit Breakers (MCCB) and Air Circuit Breakers (ACB) is a pivotal engineering decision during low-voltage switchboard design. ACBs excel in primary incoming mains requiring high breaking capacities (630A to 6300A) and drawout maintenance flexibility. Conversely, MCCBs offer compact footprints and cost-efficient feeder protection up to 1600A.</p><h2>Key Sizing Parameters</h2><ul><li><strong>Nominal Current (In):</strong> Total connected load ampacity with safety margin.</li><li><strong>Breaking Capacity (Icu/Ics):</strong> Prospective fault current at the point of installation.</li><li><strong>Coordination & Selectivity:</strong> Upstream and downstream trip curve discrimination.</li></ul>',
                'category_id' => $artCat->id,
                'author_id' => $adminId,
                'author_display_name' => 'ATS Engineering Technical Desk',
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]
        );
        $art1->tags()->sync([$tag1->id, $tag2->id, $tag3->id]);
    }
}
