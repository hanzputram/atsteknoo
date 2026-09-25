<?php

namespace Database\Seeders;

use App\Models\PriceList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Vinsa Pricelist - 2026',
                'slug' => 'vinsa-pricelist-2026',
                'brand_name' => 'Vinsa',
                'edition_year' => '2026',
                'category' => 'Box Panel & Enclosures',
                'tax_note' => 'Termasuk PPN 11%',
                'thumbnail_url' => 'images/pricelists/17.jpg',
                'view_url' => 'https://drive.google.com/file/d/1cR0FGRAqQXo8O2gOqGxHNkfLrWmgGkdU/view?usp=sharing',
                'download_url' => 'https://drive.google.com/uc?export=download&id=1cR0FGRAqQXo8O2gOqGxHNkfLrWmgGkdU',
                'file_size' => 'PDF Document • 2026 Edition',
                'description' => 'Daftar harga resmi produk Vinsa terbaru tahun 2026. Termasuk PPN 11%. Meliputi Box Panel Wall Mounting & Free Standing, Cable Lug, Contactor, dan Terminal Block.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Schneider Pricelist General - 2025',
                'slug' => 'schneider-pricelist-general-2025',
                'brand_name' => 'Schneider Electric',
                'edition_year' => '2025',
                'category' => 'Power Distribution & Industrial Automation',
                'tax_note' => 'Belum Termasuk PPN 11%',
                'thumbnail_url' => 'images/pricelists/16.jpg',
                'view_url' => 'https://drive.google.com/file/d/1BJLQbLzGy4Nr08vOcO5rjkqp9IRk_R9J/view?usp=drive_link',
                'download_url' => 'https://drive.google.com/uc?export=download&id=1BJLQbLzGy4Nr08vOcO5rjkqp9IRk_R9J',
                'file_size' => 'PDF Document • 2025 Edition',
                'description' => 'Schneider Price List General. Harga katalog resmi belum termasuk PPN 11% (Tanpa Pembulatan). Meliputi Air Circuit Breaker (ACB) MasterPact MTZ/NT/NW, MCCB Compact NSX, Inverter Altivar, dan TeSys Contactor.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Schneider Pricelist Retail - 2025',
                'slug' => 'schneider-pricelist-retail-2025',
                'brand_name' => 'Schneider Electric',
                'edition_year' => '2025',
                'category' => 'Residential & Commercial Wiring Devices',
                'tax_note' => 'Belum Termasuk PPN 11%',
                'thumbnail_url' => 'images/pricelists/15.jpg',
                'view_url' => 'https://drive.google.com/file/d/10L-6vKKbkE5JA0xW2rcGXztzMfkHMMGd/view?usp=drive_link',
                'download_url' => 'https://drive.google.com/uc?export=download&id=10L-6vKKbkE5JA0xW2rcGXztzMfkHMMGd',
                'file_size' => 'PDF Document • 2025 Edition',
                'description' => 'Schneider Price List Retail. Harga katalog resmi belum termasuk PPN 11% (Tanpa Pembulatan). Meliputi Mini Circuit Breaker (MCB) Domae, IK60N, RCBO Slim, Sakelar & Stop Kontak AvatarOn, S-Classic, dan Weatherproof Sockets.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'GAE Pricelist - 2023',
                'slug' => 'gae-pricelist-2023',
                'brand_name' => 'GAE',
                'edition_year' => '2023',
                'category' => 'Power Quality & Capacitor Bank',
                'tax_note' => 'Belum Termasuk PPN 11%',
                'thumbnail_url' => 'images/pricelists/14.jpg',
                'view_url' => 'https://drive.google.com/file/d/1K5HOpAQbzr98N20i024CxPu18TOO7gFM/view?usp=drive_link',
                'download_url' => 'https://drive.google.com/uc?export=download&id=1K5HOpAQbzr98N20i024CxPu18TOO7gFM',
                'file_size' => 'PDF Document • 2023 Edition',
                'description' => 'Price List GAE resmi. Harga yang tercantum pada katalog belum termasuk PPN 11% (tanpa pembulatan). Meliputi GAE Power Capacitor Bank, Power Factor Controller, Reaktor Detuned, dan Fuse Switch Disconnector.',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'GAE Price List Metering & Panel Accessories 2025',
                'slug' => 'gae-price-list-metering-panel-accessories-2025',
                'brand_name' => 'GAE',
                'edition_year' => '2025',
                'category' => 'Metering & Panel Accessories',
                'tax_note' => 'Belum Termasuk PPN 11%',
                'thumbnail_url' => 'images/pricelists/13.jpg',
                'view_url' => 'https://drive.google.com/file/d/1tWA-e6PMXZOKkYkJzhTLoijv6g78vAOK/view?usp=drive_link',
                'download_url' => 'https://drive.google.com/uc?export=download&id=1tWA-e6PMXZOKkYkJzhTLoijv6g78vAOK',
                'file_size' => 'PDF Document • 2025 Edition',
                'description' => 'Price List Metering & Panel Accessories GAE 2025. Harga belum termasuk PPN 11% (tanpa pembulatan). Meliputi Current Transformer (CT), Digital Multi-Function Power Meter, Busbar Support Insulator, dan Aksesoris Perakitan Panel.',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'DV Electric Pricelist - 2026',
                'slug' => 'dv-electric-pricelist-2026',
                'brand_name' => 'DV Electric',
                'edition_year' => '2026',
                'category' => 'Control Relays & Switchgear',
                'tax_note' => 'Termasuk PPN 11%',
                'thumbnail_url' => 'images/pricelists/11.jpg',
                'view_url' => 'https://drive.google.com/file/d/1uNe0ECIissoaHU7aE7rrnI9dKP35WzDq/view?usp=drive_link',
                'download_url' => 'https://drive.google.com/uc?export=download&id=1uNe0ECIissoaHU7aE7rrnI9dKP35WzDq',
                'file_size' => 'PDF Document • 2026 Edition',
                'description' => 'Price List DV Electric resmi tahun 2026. Harga tercantum pada katalog termasuk PPN 11%. Meliputi Digital Timer, Industrial Power Relay, Voltage Protection Relay, Magnetic Contactor, dan Thermal Overload Relay.',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            PriceList::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
