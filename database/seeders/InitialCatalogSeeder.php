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
        $admin = User::where('role', 'admin')->first();
        if (! $admin) {
            $admin = User::create([
                'name' => 'Super Administrator ATS',
                'username' => 'superats888',
                'email' => 'superats888@atstekno.com',
                'password' => bcrypt('ATSSBY001!araya'),
                'role' => 'admin',
                'is_active' => true,
            ]);
        } else {
            $admin->update([
                'username' => 'superats888',
                'password' => bcrypt('ATSSBY001!araya'),
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
            'whatsapp' => '082223332830',
            'email' => 'sales@atstekno.com',
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

        // 5. Products (Managed via Backoffice / Importer)
        $productsData = [];

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

        // 6. Project Categories
        ProjectCategory::updateOrCreate(['code' => 'SUBSTATION'], ['name' => 'Substation & Main Switchboard', 'slug' => 'substation-main-switchboard']);
        ProjectCategory::updateOrCreate(['code' => 'COLDSTORAGE'], ['name' => 'Cold Storage & HVAC Automation', 'slug' => 'cold-storage-hvac-automation']);
        ProjectCategory::updateOrCreate(['code' => 'FACTORY'], ['name' => 'Industrial Manufacturing Plant', 'slug' => 'industrial-manufacturing-plant']);

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
