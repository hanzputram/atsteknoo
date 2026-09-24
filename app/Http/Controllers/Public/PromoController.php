<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ContactInquiry;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class PromoController extends Controller
{
    /**
     * Display the dedicated high-converting Google Ads promotional landing page.
     */
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');

        // Formatted WhatsApp number for api.whatsapp.com (e.g. 6282223332830)
        $rawWa = $settings['whatsapp'] ?? '082223332830';
        if (in_array(trim((string)$rawWa), ['081234567890', '6281234567890', '+6281234567890', ''])) {
            $rawWa = '082223332830';
        }
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }

        // Featured products for promo & components
        $featuredProducts = Product::published()
            ->with(['brand', 'primaryCategory', 'mainImage'])
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->take(16)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::published()
                ->with(['brand', 'primaryCategory', 'mainImage'])
                ->orderBy('sort_order')
                ->orderBy('id', 'desc')
                ->take(8)
                ->get();
        }

        $bestSellerProducts = $featuredProducts;
        $promoProducts = $featuredProducts->take(8);

        $projects = \App\Models\Project::published()
            ->with(['category', 'coverImage'])
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();

        if ($projects->isEmpty()) {
            $projects = \App\Models\Project::published()
                ->with(['category', 'coverImage'])
                ->orderBy('sort_order')
                ->orderBy('id', 'desc')
                ->take(12)
                ->get();
        }

        $articles = \App\Models\Article::published()
            ->with(['category', 'thumbnail', 'author'])
            ->latest('published_at')
            ->take(6)
            ->get();

        // Top brands
        $brands = Brand::active()
            ->with('logo')
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        // Customer references (Indofood, Pakuwon, Dua Kelinci, BMI, Pokphand)
        $customers = [
            [
                'name'     => 'Indofood Sukses Makmur',
                'sector'   => 'FMCG & Industrial Processing',
                'logo'     => asset('images/customers/indofood.webp'),
                'supplied' => 'Schneider Altivar Inverters & TeSys Motor Controls',
            ],
            [
                'name'     => 'Pakuwon Group',
                'sector'   => 'Superblock & High-Rise Building',
                'logo'     => asset('images/customers/pakuwon.webp'),
                'supplied' => 'MasterPact MTZ/NW ACB & LVMDP Switchboards',
            ],
            [
                'name'     => 'Dua Kelinci',
                'sector'   => 'Food Manufacturing Industry',
                'logo'     => asset('images/customers/dua-kelinci.webp'),
                'supplied' => 'TeSys Magnetic Contactors & MCCB Protection',
            ],
            [
                'name'     => 'Bumi Menara Internusa',
                'sector'   => 'Cold Storage & Seafood Export',
                'logo'     => asset('images/customers/bmi.webp'),
                'supplied' => 'Heavy-Duty Industrial Switchgear & Enclosures',
            ],
            [
                'name'     => 'Charoen Pokphand',
                'sector'   => 'Agro-Industry & Feedmill Plant',
                'logo'     => asset('images/customers/pokphand.webp'),
                'supplied' => 'Integrated Motor Control Centers (MCC) & Breakers',
            ],
        ];

        // Curated promotional packages & categories for procurement & contractors
        $promoCategories = [
            [
                'id'          => 'mcb-tesys',
                'title'       => 'MCB & Kontaktor TeSys',
                'badge'       => 'Best Seller Proyek',
                'discount'    => 'Diskon s/d 45%*',
                'description' => 'MCB Acti9, Domae, & Magnetic Contactor TeSys Deca/TeSys D. Proteksi sirkuit andal untuk gedung komersial dan pabrik.',
                'highlights'  => ['Ready Stock Ribuan Unit di Surabaya', 'Garansi Resmi 100% Original', 'Tersedia 1P, 2P, 3P, 4P Lengkap'],
                'target_slug' => 'power-distribution-circuit-breakers',
            ],
            [
                'id'          => 'mccb',
                'title'       => 'MCCB Compact NSX & EasyPact',
                'badge'       => 'Spesial Panel Maker',
                'discount'    => 'Harga Grosir Distributor',
                'description' => 'Molded Case Circuit Breakers kapasitas 16A hingga 1600A. Pilihan utama perakitan panel distribusi utama dan sub-panel.',
                'highlights'  => ['Kapasitas Pemutus 18kA s/d 150kA', 'Tersedia Seri TMD & Micrologic', 'Sertifikasi Uji Internasional IEC'],
                'target_slug' => 'power-distribution-circuit-breakers',
            ],
            [
                'id'          => 'inverter',
                'title'       => 'Inverter Altivar (VFD)',
                'badge'       => 'Hemat Energi Industri',
                'discount'    => 'Diskon Khusus Q3/Q4',
                'description' => 'Variable Speed Drives Altivar ATV310, ATV630, ATV930. Solusi efisiensi daya motor pompa, fan, konveyor, dan mesin manufaktur.',
                'highlights'  => ['Efisiensi Listrik hingga 30%', 'Dukungan Setting Teknis & Manual', 'Ready Kapasitas 0.75kW - 315kW'],
                'target_slug' => 'industrial-drives-inverters',
            ],
            [
                'id'          => 'acb-masterpact',
                'title'       => 'ACB MasterPact MTZ & NW',
                'badge'       => 'Kebutuhan Gardu & LVMDP',
                'discount'    => 'Spesial Pengadaan BoQ',
                'description' => 'Air Circuit Breakers kapasitas 800A hingga 6300A dengan trip unit Micrologic canggih dan kemampuan power monitoring digital.',
                'highlights'  => ['Sertifikat Keaslian Pabrikan (COO)', 'Opsi Fixed / Drawout Tipe', 'Bisa Dukung Surat Dukungan Proyek'],
                'target_slug' => 'power-distribution-circuit-breakers',
            ],
            [
                'id'          => 'panel-maker',
                'title'       => 'Fabrikasi Panel Listrik Custom',
                'badge'       => 'Workshop Panel Surabaya',
                'discount'    => 'Free Desain & Test Report',
                'description' => 'Perakitan profesional panel LVMDP, Sub-Distribution, Capacitor Bank, Motor Control Center (MCC), dan Automatic Transfer Switch (ATS).',
                'highlights'  => ['Workshop Fabrikasi Sendiri di Surabaya', 'Busbar Tembaga Murni Standar PLN', 'Uji Kelayakan & Sertifikat Garansi'],
                'target_slug' => 'industrial-enclosures-wiring',
            ],
            [
                'id'          => 'brand-partner',
                'title'       => 'Partner Resmi Global Lainnya',
                'badge'       => 'Multi-Brand One Stop',
                'discount'    => 'Best B2B Price',
                'description' => 'Pengadaan terpadu komponen Legrand, Socomec (Changeover Switch & Metering), Autonics (Sensor & Timer), Himel, dan GAE.',
                'highlights'  => ['Satu Faktur Pajak untuk Semua Brand', 'Hemat Biaya Logistik Pengadaan', 'Stok Gudang Bersama di Surabaya'],
                'target_slug' => 'power-distribution-circuit-breakers',
            ],
        ];

        return view('public.promo', compact(
            'settings',
            'cleanWa',
            'promoProducts',
            'featuredProducts',
            'bestSellerProducts',
            'brands',
            'projects',
            'articles',
            'customers',
            'promoCategories'
        ));
    }

    /**
     * Handle quick RFQ submission from the Google Ads promotional page.
     */
    public function submitInquiry(Request $request)
    {
        // Honeypot spam check
        if ($request->filled('website_hp')) {
            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Permintaan Anda telah terkirim.']);
            }
            return back()->with('success', 'Permintaan Anda telah berhasil terkirim.');
        }

        // Rate limit: 3 inquiries per minute per IP
        $throttleKey = 'promo-inquiry|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $msg = "Terlalu banyak permintaan penawaran. Silakan tunggu {$seconds} detik atau langsung hubungi kami via WhatsApp.";
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 429);
            }
            return back()->withInput()->withErrors(['rate_limit' => $msg]);
        }

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'phone'        => ['required', 'string', 'max:64'],
            'company'      => ['nullable', 'string', 'max:255'],
            'email'        => ['nullable', 'email', 'max:255'],
            'category'     => ['nullable', 'string', 'max:255'],
            'notes'        => ['nullable', 'string', 'max:5000'],
            'utm_source'   => ['nullable', 'string', 'max:128'],
            'utm_medium'   => ['nullable', 'string', 'max:128'],
            'utm_campaign' => ['nullable', 'string', 'max:128'],
            'utm_term'     => ['nullable', 'string', 'max:128'],
            'gclid'        => ['nullable', 'string', 'max:255'],
        ]);

        $company = !empty($validated['company']) ? trim($validated['company']) : '-';
        $category = !empty($validated['category']) ? trim($validated['category']) : 'Umum / Beragam Komponen';
        $notes = !empty($validated['notes']) ? trim($validated['notes']) : 'Minta penawaran harga dan diskon promo proyek.';
        $email = !empty($validated['email']) ? strtolower(trim($validated['email'])) : 'sales@atstekno.com';

        // Format detailed inquiry message
        $messageBody = "=== PERMINTAAN DISKON PROMO GOOGLE ADS ===\n\n"
            . "Nama Pemohon: " . trim($validated['name']) . "\n"
            . "Nomor WhatsApp / HP: " . trim($validated['phone']) . "\n"
            . "Perusahaan / Proyek: " . $company . "\n"
            . "Email: " . ($validated['email'] ?? 'Tidak dicantumkan') . "\n"
            . "Kategori Produk / Minat: " . $category . "\n"
            . "Catatan Kebutuhan / BoQ: " . $notes . "\n\n"
            . "--- Metadata Iklan Google Ads ---\n"
            . "Source: " . ($validated['utm_source'] ?? 'Google Ads') . "\n"
            . "Campaign: " . ($validated['utm_campaign'] ?? 'Promo Surabaya') . "\n"
            . "Keyword / Term: " . ($validated['utm_term'] ?? '-') . "\n"
            . "GCLID: " . ($validated['gclid'] ?? '-') . "\n"
            . "IP Pengirim: " . $request->ip();

        ContactInquiry::create([
            'name'       => trim($validated['name']),
            'email'      => $email,
            'phone'      => trim($validated['phone']),
            'subject'    => '[PROMO GOOGLE ADS] ' . ($company !== '-' ? $company . ' - ' : '') . trim($validated['name']) . ' (' . $category . ')',
            'message'    => $messageBody,
            'status'     => 'unread',
            'ip_address' => $request->ip(),
        ]);

        RateLimiter::hit($throttleKey, 60);

        // Pre-build WhatsApp URL for optional instant transition
        $rawWa = SiteSetting::where('key', 'whatsapp')->value('value') ?? '082223332830';
        if (in_array(trim((string)$rawWa), ['081234567890', '6281234567890', '+6281234567890', ''])) {
            $rawWa = '082223332830';
        }
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }

        $waText = "Halo Sales Engineer ATS Tekno, saya *{$validated['name']}*" . ($company !== '-' ? " dari *{$company}*" : "") . " baru saja mengirim formulir Promo Google Ads.\n\n"
            . "📋 *Kategori Kebutuhan:* {$category}\n"
            . "📝 *Catatan:* {$notes}\n\n"
            . "Mohon respon penawaran harga dan diskon proyek resminya. Terima kasih!";

        $whatsappRedirectUrl = "https://api.whatsapp.com/send?phone={$cleanWa}&text=" . rawurlencode($waText);

        if ($request->wantsJson()) {
            return response()->json([
                'success'      => true,
                'message'      => 'Terima kasih! Permintaan penawaran harga Anda telah diterima tim Sales Engineer PT. Anugerah Tama Sejati. Kami akan segera menghubungi Anda dalam waktu maksimal 15-30 menit.',
                'whatsapp_url' => $whatsappRedirectUrl,
            ]);
        }

        return back()
            ->with('success', 'Terima kasih! Permintaan penawaran promo Anda telah berhasil diterima. Tim Sales Engineer PT. Anugerah Tama Sejati akan segera menghubungi Anda.')
            ->with('whatsapp_redirect_url', $whatsappRedirectUrl);
    }
}
