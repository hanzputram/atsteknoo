@extends('layouts.app')

@php
    $pageTitle = 'Distributor Alat Listrik Surabaya Terlengkap & Resmi No. 1 | ATS Tekno';
    $metaDesc = 'Pusat distributor alat listrik Surabaya terlengkap & resmi PT. Anugerah Tama Sejati. Ready stock 5.000+ item MCB, MCCB, ACB, Inverter, Kontaktor, Kabel industri, Box Panel & Panel Maker di Surabaya (MERR & Jagalan). Harga grosir B2B & pengiriman kilat.';
    $canonicalUrl = route('distributor-alat-listrik-surabaya');

    $schemaData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => route('home'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => 'Distributor Alat Listrik Surabaya',
                        'item' => $canonicalUrl,
                    ],
                ],
            ],
            [
                '@type' => ['WholesaleStore', 'ElectricalSupplyStore', 'Electrician'],
                '@id' => $canonicalUrl . '#store',
                'name' => 'ATS Tekno — Distributor Alat Listrik Surabaya Terlengkap & Resmi',
                'alternateName' => [
                    'Distributor Alat Listrik Surabaya',
                    'Supplier Alat Listrik Surabaya',
                    'Toko Alat Listrik Surabaya Terlengkap',
                    'Pusat Grosir Alat Listrik Surabaya',
                    'Distributor Schneider Electric Surabaya Resmi',
                    'PT Anugerah Tama Sejati Surabaya'
                ],
                'description' => $metaDesc,
                'url' => $canonicalUrl,
                'telephone' => '+62-31-59178887',
                'email' => 'sales@atstekno.com',
                'priceRange' => '$$',
                'logo' => asset('images/ats-logo.png'),
                'image' => asset('images/ats-logo.png'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Ruko Galaxi Bumi Permai J-1 No. 23',
                    'addressLocality' => 'Surabaya',
                    'addressRegion' => 'Jawa Timur',
                    'postalCode' => '60134',
                    'addressCountry' => 'ID'
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => -7.301972,
                    'longitude' => 112.784336
                ],
                'hasMap' => 'https://maps.google.com/?cid=13502184121040894586',
                'openingHoursSpecification' => [
                    [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                        'opens' => '08:00',
                        'closes' => '17:00'
                    ],
                    [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Saturday'],
                        'opens' => '08:00',
                        'closes' => '14:00'
                    ]
                ],
                'areaServed' => [
                    ['@type' => 'City', 'name' => 'Surabaya'],
                    ['@type' => 'City', 'name' => 'Gresik'],
                    ['@type' => 'City', 'name' => 'Sidoarjo'],
                    ['@type' => 'City', 'name' => 'Mojokerto'],
                    ['@type' => 'City', 'name' => 'Pasuruan'],
                    ['@type' => 'City', 'name' => 'Malang'],
                    ['@type' => 'State', 'name' => 'Jawa Timur'],
                    ['@type' => 'Country', 'name' => 'Indonesia']
                ],
                'department' => [
                    [
                        '@type' => 'ElectricalSupplyStore',
                        'name' => 'ATS Tekno — Surabaya Jagalan Commercial Hub',
                        'address' => [
                            '@type' => 'PostalAddress',
                            'streetAddress' => 'Jl. Jagalan No. 38, Bongkaran, Pabean Cantian',
                            'addressLocality' => 'Surabaya',
                            'addressRegion' => 'Jawa Timur',
                            'postalCode' => '60161',
                            'addressCountry' => 'ID'
                        ],
                        'telephone' => '+62-31-99909120'
                    ],
                    [
                        '@type' => 'LocalBusiness',
                        'name' => 'ATS Tekno — Pandaan Workshop & Showroom',
                        'address' => [
                            '@type' => 'PostalAddress',
                            'streetAddress' => 'The Taman Dayu, Cluster Palazio Boulevard J-1 No. 06',
                            'addressLocality' => 'Pandaan',
                            'addressRegion' => 'Pasuruan, Jawa Timur',
                            'postalCode' => '67156',
                            'addressCountry' => 'ID'
                        ],
                        'telephone' => '+62-343-4857758'
                    ]
                ],
                'brand' => [
                    ['@type' => 'Brand', 'name' => 'Schneider Electric'],
                    ['@type' => 'Brand', 'name' => 'Legrand'],
                    ['@type' => 'Brand', 'name' => 'GAE Group'],
                    ['@type' => 'Brand', 'name' => 'Vinsa'],
                    ['@type' => 'Brand', 'name' => 'Omron'],
                    ['@type' => 'Brand', 'name' => 'ABB'],
                    ['@type' => 'Brand', 'name' => '3M'],
                    ['@type' => 'Brand', 'name' => 'Belden'],
                    ['@type' => 'Brand', 'name' => 'Supreme Cable'],
                    ['@type' => 'Brand', 'name' => 'Socomec'],
                    ['@type' => 'Brand', 'name' => 'Autonics'],
                    ['@type' => 'Brand', 'name' => 'Himel'],
                    ['@type' => 'Brand', 'name' => 'Theben'],
                    ['@type' => 'Brand', 'name' => 'Uticon']
                ]
            ]
        ]
    ];

    $schemaJson = json_encode(
        $schemaData,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
    );

    $faqs = [
        [
            'q_id' => 'Siapa distributor alat listrik terlengkap dan resmi di Surabaya?',
            'q_en' => 'Who is the most complete and official electrical equipment distributor in Surabaya?',
            'a_id' => 'PT. Anugerah Tama Sejati (ATS Tekno) adalah pusat distributor alat listrik terlengkap dan resmi di Surabaya. Kami menyediakan lebih dari 5.000 SKU komponen listrik original dari brand global terkemuka seperti Schneider Electric, Legrand, GAE, Vinsa, Omron, ABB, 3M, dan Belden, didukung oleh gudang ready stock di Surabaya (MERR & Jagalan) serta workshop fabrikasi panel listrik bersertifikat.',
            'a_en' => 'PT. Anugerah Tama Sejati (ATS Tekno) is the leading and official electrical distributor in Surabaya, stocking over 5,000 genuine SKUs from world-class brands including Schneider Electric, Legrand, GAE, Vinsa, Omron, ABB, 3M, and Belden, backed by Surabaya warehouses and certified panel manufacturing facilities.'
        ],
        [
            'q_id' => 'Komponen alat listrik apa saja yang ready stock di Surabaya?',
            'q_en' => 'What electrical components are ready stock in Surabaya?',
            'a_id' => 'Kami menyediakan Circuit Breaker (MCB, MCCB, ACB, ELCB, RCBO), Kontrol Motor & Otomasi (Inverter/VFD Altivar, Kontaktor TeSys, Thermal Overload, Soft Starter), Komponen Panel (Capacitor Bank, Busbar, ATS/AMF, Digital Metering), Kabel Industri & Kontrol (Supreme, Belden 9544), Box Panel Enclosure (IP55/IP66), serta aksesoris instalasi (Terminal Block GAE, Push Button, Pilot Lamp, Isolasi 3M).',
            'a_en' => 'We stock Circuit Breakers (MCB, MCCB, ACB, RCBO), Motor Control & Automation (VFD Inverters, TeSys Contactors, Overloads), Panel Accessories (Capacitor Banks, Busbars, ATS/AMF, Digital Power Meters), Industrial Cables (Supreme, Belden 9544), Panel Enclosures (IP55/IP66), and wiring accessories.'
        ],
        [
            'q_id' => 'Apakah ATS Tekno melayani pembelian grosir B2B untuk kontraktor dan industri dengan Faktur Pajak?',
            'q_en' => 'Does ATS Tekno serve B2B wholesale purchases for contractors and factories with official tax invoices?',
            'a_id' => 'Ya, kami melayani kontraktor MEP, konsultan kelistrikan, panel builder, serta industri manufaktur di Surabaya, Gresik, Sidoarjo, dan seluruh Indonesia dengan skema harga distributor/grosir, penawaran harga resmi (BoQ) dalam 1x24 jam, dan Faktur Pajak PPN 11% sah.',
            'a_en' => 'Yes, we provide specialized wholesale pricing, fast 24h formal quotation turnaround, and 11% official VAT tax invoices for MEP contractors, electrical consultants, panel builders, and manufacturing plants across Indonesia.'
        ],
        [
            'q_id' => 'Di mana alamat toko dan gudang ATS Tekno di Surabaya?',
            'q_en' => 'Where are ATS Tekno offices and showrooms located in Surabaya?',
            'a_id' => 'ATS Tekno memiliki dua lokasi utama di Surabaya: (1) Headquarter & Engineering Office di Ruko Galaxi Bumi Permai J-1 No. 23 (kawasan MERR Surabaya Timur), dan (2) Sentra Showroom Komersial di Jl. Jagalan No. 38, Bongkaran, Pabean Cantian (kawasan pusat perdagangan alat listrik Surabaya). Kami juga memiliki workshop di The Taman Dayu Pandaan.',
            'a_en' => 'ATS Tekno has two prime hubs in Surabaya: (1) Headquarter & Engineering Office at Ruko Galaxi Bumi Permai J-1 No. 23 (MERR East Surabaya), and (2) Commercial Showroom at Jl. Jagalan No. 38 (Surabaya central electrical trading hub), plus our manufacturing hub at The Taman Dayu Pandaan.'
        ],
        [
            'q_id' => 'Apakah produk alat listrik yang dijual dijamin 100% original bergaransi resmi?',
            'q_en' => 'Are all electrical products 100% authentic with manufacturer warranty?',
            'a_id' => 'Semua produk yang kami distribusikan dijamin 100% baru dan original, bersumber langsung dari prinsipal resmi dilengkapi dengan Certificate of Origin (COO), garansi resmi pabrikan, dan nomor seri yang dapat diverifikasi keasliannya.',
            'a_en' => 'Every single product is guaranteed 100% brand new, genuine, and sourced directly from official principals, accompanied by Certificates of Origin (COO), official manufacturer warranties, and verifiable serial numbers.'
        ],
        [
            'q_id' => 'Bagaimana cara meminta penawaran harga (BoQ) atau memesan barang?',
            'q_en' => 'How can I request a quotation (BoQ) or place an order?',
            'a_id' => 'Anda dapat langsung mengirimkan daftar kebutuhan atau file BoQ proyek Anda melalui WhatsApp resmi kami di +62 812-3456-7890 atau email sales@atstekno.com. Tim sales engineering kami akan memberikan respon cepat dan surat penawaran harga resmi dalam 1x24 jam.',
            'a_en' => 'You can send your bill of quantities (BoQ) or equipment requirements directly via WhatsApp at +62 812-3456-7890 or email sales@atstekno.com. Our sales engineering team provides fast quotation within 24 hours.'
        ]
    ];

    $whatsappMessage = "Halo Sales Distributor Alat Listrik Surabaya ATS Tekno,\nSaya ingin meminta penawaran harga resmi (BoQ) untuk kebutuhan alat listrik proyek kami di Surabaya/Jawa Timur:\n\n- Nama Perusahaan/Proyek:\n- Daftar Kebutuhan (MCB/MCCB/Kabel/Inverter/dll):\n- Estimasi Kebutuhan / Deadline:\n\nMohon dibantu surat penawaran resmi. Terima kasih.";
    $whatsappUrl = "https://wa.me/6281234567890?text=" . urlencode($whatsappMessage);

    $electricalCategories = [
        [
            'title' => 'Circuit Breaker & Proteksi Daya',
            'desc' => 'MCB, MCCB, ACB, ELCB, RCBO, dan Surge Arrester tegangan rendah & menengah standar SNI & IEC.',
            'brands' => 'Schneider Electric, Legrand, ABB, Himel',
            'badge' => '5.000+ SKU Ready',
            'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
            'link' => route('products.index', ['search' => 'breaker'])
        ],
        [
            'title' => 'Kontrol Motor & Otomasi Industri',
            'desc' => 'Inverter / VFD, Kontaktor TeSys, Thermal Overload Relay, Soft Starter, PLC, Sensor & Timer Industri.',
            'brands' => 'Schneider Electric, Omron, Autonics',
            'badge' => 'Garansi Resmi',
            'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
            'link' => route('products.index', ['search' => 'kontaktor'])
        ],
        [
            'title' => 'Komponen Panel & Distribusi',
            'desc' => 'Capacitor Bank (APFC), Busbar Tembaga, ATS/AMF Motorized Changeover, Digital Power Meter & CT.',
            'brands' => 'GAE Group, Vinsa, Socomec, Schneider',
            'badge' => 'Tembaga Murni 99.9%',
            'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
            'link' => route('services.panel')
        ],
        [
            'title' => 'Kabel Industri, Kontrol & Data',
            'desc' => 'Kabel Power NYY, NYFGBY, NYM, Kabel Instrumentasi Belden 9544 / RS485, Kabel Tahan Api & Tray.',
            'brands' => 'Supreme Cable, Belden, Jembo',
            'badge' => 'Potong Sesuai Kebutuhan',
            'icon' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
            'link' => route('products.index', ['search' => 'kabel'])
        ],
        [
            'title' => 'Box Panel Listrik & Enclosure',
            'desc' => 'Box panel wall-mount, free standing, modular panel IP55/IP66 dengan powder coating anti karat tahan lama.',
            'brands' => 'ATS Panel Enclosure, Vinsa Box',
            'badge' => 'Fabrikasi Presisi',
            'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
            'link' => route('services.panel')
        ],
        [
            'title' => 'Wiring Accessories & Pilot Devices',
            'desc' => 'Terminal block rel, Push button switch, Pilot lamp LED, Skun kabel tembaga, Isolasi 3M & Spiral wrap.',
            'brands' => 'GAE, 3M, Uticon, Broco, Theben',
            'badge' => 'Lengkap 100%',
            'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
            'link' => route('products.index')
        ],
    ];

    $brandShowcase = [
        ['name' => 'Schneider Electric', 'logo' => 'logos/schneider-electric.webp', 'desc' => 'Authorized Distributor & Panel Builder'],
        ['name' => 'Legrand', 'logo' => 'logos/Legrand.webp', 'desc' => 'Official Partner Switchgear & Wiring'],
        ['name' => 'GAE Group', 'logo' => 'logos/gae-group.webp', 'desc' => 'Authorized Electrical Components'],
        ['name' => 'Vinsa', 'logo' => 'logos/vinsa.webp', 'desc' => 'Industrial Panel Hardware & Box'],
        ['name' => 'Omron', 'logo' => 'logos/omron.svg', 'desc' => 'Automation & Sensing Industrial'],
        ['name' => 'ABB', 'logo' => 'logos/abb.webp', 'desc' => 'Electrification & Breaker Technology'],
        ['name' => '3M', 'logo' => 'logos/3m.svg', 'desc' => 'Electrical Tapes & Termination'],
        ['name' => 'Belden', 'logo' => 'logos/belden.webp', 'desc' => 'Control & Industrial Data Cables'],
        ['name' => 'Supreme Cable', 'logo' => 'logos/supremexxx.webp', 'desc' => 'High Quality Power Cables'],
        ['name' => 'Socomec', 'logo' => 'logos/Socomec.webp', 'desc' => 'Power Switching & Changeover ATS'],
        ['name' => 'Autonics', 'logo' => 'logos/Autonics.webp', 'desc' => 'Industrial Sensors & Controllers'],
        ['name' => 'Theben', 'logo' => 'logos/theben.webp', 'desc' => 'Precision Time Switches & Relays'],
        ['name' => 'Uticon', 'logo' => 'logos/uticon.webp', 'desc' => 'Electrical Extension & Plugs'],
        ['name' => 'Matsuyama', 'logo' => 'logos/matsuyama.webp', 'desc' => 'Automatic Voltage Stabilizer'],
        ['name' => 'Puma', 'logo' => 'logos/puma.webp', 'desc' => 'Industrial Pneumatic & Motors'],
        ['name' => 'Broco', 'logo' => 'logos/broco.webp', 'desc' => 'Residential & Commercial Wiring']
    ];
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDesc)
@section('canonical', $canonicalUrl)

@push('schema')
<script type="application/ld+json">
{!! $schemaJson !!}
</script>
@endpush

@section('content')
<!-- Hero Section with Industrial Dark Slate & Red Accent -->
<div class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-24 border-b border-slate-800">
    <!-- Grid & Ambient Glow Background -->
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 1px 1px, #E11D48 1.2px, transparent 0); background-size: 32px 32px;"></div>
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-rose-600/25 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 -left-24 w-80 h-80 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-400 transition">
                <span>Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-rose-400 font-semibold">Distributor Alat Listrik Surabaya</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <!-- Left Hero Content -->
            <div class="lg:col-span-8">
                <!-- Eyebrow Tag -->
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-500/15 text-rose-400 border border-rose-500/30 mb-5 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>DISTRIBUTOR RESMI ALAT LISTRIK SURABAYA & JAWA TIMUR</span>
                </div>

                <!-- Main Heading H1 -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight sm:leading-none">
                    Distributor Alat Listrik Surabaya <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-amber-400">Terlengkap & Resmi</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-slate-300 mt-5 max-w-3xl leading-relaxed">
                    Pusat supplier dan distributor alat listrik Surabaya terlengkap dari <strong class="text-white">PT. Anugerah Tama Sejati</strong>. Menyediakan <strong>5.000+ item komponen listrik original</strong> ready stock gudang Surabaya: Circuit Breaker (MCB, MCCB, ACB), Kontaktor, Inverter, Kabel Industri, Box Panel, hingga Fabrikasi Panel Maker bergaransi resmi.
                </p>

                <!-- Key Authority Features Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-slate-800 text-xs">
                    <div class="flex items-center gap-2 text-slate-300">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>100% COO Original</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Ready Stock Surabaya</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Faktur Pajak PPN 11%</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Kirim Cepat Jawa Timur</span>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-wrap items-center gap-4 mt-8">
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-500 hover:to-rose-600 text-white font-bold text-sm shadow-lg shadow-rose-900/40 hover:shadow-rose-900/60 transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>Minta Penawaran BoQ (WhatsApp)</span>
                    </a>
                    <a href="#katalog-alat-listrik"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-200 hover:text-white font-semibold text-sm border border-slate-700 transition">
                        <span>Lihat 6 Kategori Utama</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-transparent hover:bg-white/5 text-slate-300 hover:text-white font-medium text-sm border border-slate-700/60 transition">
                        <span>Buka Katalog Lengkap</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right Hero Card: Surabaya Fast Contact & Verification -->
            <div class="lg:col-span-4">
                <div class="bg-gradient-to-b from-slate-800/90 to-slate-900/90 rounded-2xl p-6 border border-slate-700/80 shadow-2xl backdrop-blur-md">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-700/70">
                        <div>
                            <span class="text-xs font-bold text-rose-400 uppercase tracking-wider block">Gudang & Hub Surabaya</span>
                            <h3 class="text-lg font-bold text-white mt-0.5">Surabaya Fast Dispatch</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                            Buka Hari Ini
                        </span>
                    </div>

                    <div class="space-y-4 my-5 text-xs text-slate-300">
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <strong class="text-white block font-semibold">Surabaya Headquarter (MERR)</strong>
                                <span>Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya Timur</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <strong class="text-white block font-semibold">Surabaya Jagalan Hub</strong>
                                <span>Jl. Jagalan No. 38 (Pusat Toko Alat Listrik Surabaya)</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <strong class="text-white block font-semibold">Direct Hotline Surabaya</strong>
                                <span class="text-rose-300 font-mono text-sm block font-bold">+62-31-59178887</span>
                                <span>sales@atstekno.com</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                       class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-md">
                        <span>Cek Ketersediaan Stok Hari Ini</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Statistics Counter Strip -->
<div class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-3">
                <span class="block text-3xl sm:text-4xl font-black text-rose-600 font-outfit">5.000+</span>
                <span class="text-xs sm:text-sm font-semibold text-slate-600 uppercase tracking-wider mt-1 block">SKU Ready Stock</span>
                <p class="text-xs text-slate-400 mt-0.5">MCB, MCCB, Inverter, Kabel</p>
            </div>
            <div class="p-3 border-l border-slate-200">
                <span class="block text-3xl sm:text-4xl font-black text-slate-900 font-outfit">10+</span>
                <span class="text-xs sm:text-sm font-semibold text-slate-600 uppercase tracking-wider mt-1 block">Brand Resmi Global</span>
                <p class="text-xs text-slate-400 mt-0.5">Schneider, Legrand, GAE, Vinsa</p>
            </div>
            <div class="p-3 border-l-0 md:border-l border-slate-200">
                <span class="block text-3xl sm:text-4xl font-black text-rose-600 font-outfit">2 Lokasi</span>
                <span class="text-xs sm:text-sm font-semibold text-slate-600 uppercase tracking-wider mt-1 block">Hub Surabaya</span>
                <p class="text-xs text-slate-400 mt-0.5">MERR & Sentra Jagalan</p>
            </div>
            <div class="p-3 border-l border-slate-200">
                <span class="block text-3xl sm:text-4xl font-black text-slate-900 font-outfit">100%</span>
                <span class="text-xs sm:text-sm font-semibold text-slate-600 uppercase tracking-wider mt-1 block">Original & Bergaransi</span>
                <p class="text-xs text-slate-400 mt-0.5">COO & Sertifikat Prinsipal</p>
            </div>
        </div>
    </div>
</div>

<!-- 6 Core Electrical Product Categories -->
<section id="katalog-alat-listrik" class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-700 mb-3">
                Katalog Lengkap
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight font-outfit">
                Kategori Alat Listrik Surabaya Terlengkap
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3">
                Pasokan lengkap perlengkapan kelistrikan industri, gedung bertingkat, pabrik, dan perumahan langsung dari distributor resmi.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($electricalCategories as $cat)
                <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-rose-300 transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"/></svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $cat['badge'] }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-rose-600 transition-colors font-outfit">
                            {{ $cat['title'] }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                            {{ $cat['desc'] }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-medium text-slate-500">
                            Brand: <strong class="text-slate-800">{{ $cat['brands'] }}</strong>
                        </span>
                        <a href="{{ $cat['link'] }}" class="text-xs font-bold text-rose-600 hover:text-rose-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                            <span>Lihat Produk</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Banner Search Product Box -->
        <div class="mt-12 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-6 sm:p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
            <div class="max-w-xl">
                <span class="text-xs font-bold text-rose-400 uppercase tracking-wider block mb-1">Cari Part Number Spesifik?</span>
                <h3 class="text-xl sm:text-2xl font-bold text-white font-outfit">Punya Daftar BoQ atau Spesifikasi Teknis Khusus?</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-2">
                    Kirimkan dokumen Bill of Quantities (Excel/PDF) Anda, sales engineer kami di Surabaya siap membantu cross-reference dan memberikan harga penawaran resmi termurah.
                </p>
            </div>
            <div class="shrink-0 flex flex-wrap gap-3">
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                   class="px-5 py-3 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs sm:text-sm shadow-md transition flex items-center gap-2">
                    <span>Upload BoQ via WhatsApp</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Official Brand Portfolio Grid -->
<section class="py-16 sm:py-20 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-700 mb-3">
                Keaslian Terjamin 100%
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight font-outfit">
                Distributor Resmi Brand Alat Listrik Dunia di Surabaya
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3">
                Seluruh produk berasal langsung dari prinsipal resmi terverifikasi, lengkap dengan COO (Certificate of Origin) dan garansi pabrikan.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($brandShowcase as $b)
                <div class="bg-slate-50 hover:bg-white rounded-2xl p-5 border border-slate-200/90 hover:border-rose-400 hover:shadow-md transition-all flex flex-col items-center text-center group">
                    <div class="h-14 sm:h-16 w-full flex items-center justify-center p-2 mb-3">
                        <img src="{{ asset($b['logo']) }}" alt="{{ $b['name'] }} Surabaya" class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-200" loading="lazy">
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-rose-600 transition-colors">
                        {{ $b['name'] }}
                    </h3>
                    <span class="text-[11px] text-slate-500 mt-1 line-clamp-1">
                        {{ $b['desc'] }}
                    </span>
                </div>
            @endforeach
        </div>

        <!-- Official Certificates Showcase -->
        <div class="mt-14 p-6 sm:p-8 rounded-2xl bg-slate-50 border border-slate-200">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                    <span class="text-xs font-bold text-rose-600 uppercase tracking-wider block">Legalitas & Sertifikasi Resmi</span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 font-outfit mt-0.5">Sertifikat Distributor Resmi & Panel Builder Partner</h3>
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-600">
                    <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Terverifikasi Prinsipal Internasional</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-6">
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-xs flex flex-col items-center text-center">
                    <img src="{{ asset('certificates/cert-schneider.webp') }}" alt="Sertifikat Resmi Schneider Electric Surabaya" class="h-32 object-contain rounded mb-3" loading="lazy">
                    <strong class="text-xs font-bold text-slate-800">Schneider Electric</strong>
                    <span class="text-[11px] text-slate-500">Authorized Panel Builder & Partner</span>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-xs flex flex-col items-center text-center">
                    <img src="{{ asset('certificates/cert-gae.webp') }}" alt="Sertifikat Resmi GAE Group Surabaya" class="h-32 object-contain rounded mb-3" loading="lazy">
                    <strong class="text-xs font-bold text-slate-800">GAE Group</strong>
                    <span class="text-[11px] text-slate-500">Authorized Distributor Jatim</span>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-xs flex flex-col items-center text-center">
                    <img src="{{ asset('certificates/cert-legrand.webp') }}" alt="Sertifikat Resmi Legrand Surabaya" class="h-32 object-contain rounded mb-3" loading="lazy">
                    <strong class="text-xs font-bold text-slate-800">Legrand</strong>
                    <span class="text-[11px] text-slate-500">Certified Electrical Partner</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Competitive Advantage Matrix: Mengapa Memilih ATS Tekno Dibanding Toko Biasa -->
<section class="py-16 sm:py-20 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-500/20 text-rose-400 border border-rose-500/30 mb-3">
                Keunggulan Spesifik
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight font-outfit">
                Mengapa Kontraktor & Pabrik di Surabaya Memilih ATS Tekno?
            </h2>
            <p class="text-sm sm:text-base text-slate-300 mt-3">
                Kami bukan sekadar toko retail biasa. ATS Tekno adalah mitra distribusi teknik dengan solusi menyeluruh dari pengadaan komponen hingga perakitan panel.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700/80 hover:border-rose-500/50 transition">
                <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white font-outfit">100% Produk Baru, Asli & COO</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                    Bebas dari resiko barang rekondisi atau imitasi. Setiap unit MCB, MCCB, ACB dan Inverter memiliki nomor seri resmi yang dapat dicek langsung ke sistem prinsipal.
                </p>
                <div class="mt-4 pt-3 border-t border-slate-700 text-xs text-rose-300 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    <span>Garansi uang kembali jika tidak original</span>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700/80 hover:border-rose-500/50 transition">
                <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white font-outfit">Harga Distributor Grosir & B2B</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                    Mendapatkan harga tangan pertama dari distributor resmi dengan diskon proyek berjenjang untuk kontraktor MEP, panel maker rekanan, dan pabrik kawasan industri Jawa Timur.
                </p>
                <div class="mt-4 pt-3 border-t border-slate-700 text-xs text-rose-300 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    <span>Faktur Pajak PPN 11% Resmi</span>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700/80 hover:border-rose-500/50 transition">
                <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white font-outfit">Didukung In-House Panel Maker</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                    Tidak hanya menjual komponen mentah, kami memiliki workshop perakitan panel listrik berstandar IEC: Panel ATS/AMF, LVMDP, SDP, Kapasitor Bank, dan Inverter motor control.
                </p>
                <div class="mt-4 pt-3 border-t border-slate-700 text-xs text-rose-300 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    <span>Lengkap uji beban FAT & garansi panel</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Physical Presence & Showrooms in Surabaya (Local Pack Signals) -->
<section class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-700 mb-3">
                Lokasi Fisik & Gudang
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight font-outfit">
                Kunjungi Toko & Kantor Kami di Surabaya
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3">
                Kunjungi showroom resmi kami di Surabaya untuk konsultasi langsung dengan engineer atau pengambilan barang cepat ready stock.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Surabaya MERR -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold bg-rose-50 text-rose-700 mb-4">
                        Headquarter & Engineering
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-outfit">Surabaya - MERR</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        Ruko Galaxi Bumi Permai J-1 No. 23, Semolowaru, Sukolilo, Surabaya Timur, Jawa Timur 60134.
                    </p>
                    <div class="mt-4 space-y-1.5 text-xs text-slate-500">
                        <p><strong>Telp:</strong> (031) 59178887</p>
                        <p><strong>Fokus:</strong> Konsultasi BoQ, Kontrak Proyek, Engineering Support</p>
                        <p><strong>Jam Operasional:</strong> Senin - Jumat 08.00 - 17.00</p>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="https://maps.google.com/?cid=13502184121040894586" target="_blank" rel="noopener noreferrer"
                       class="w-full py-2 px-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs flex items-center justify-center gap-1.5 transition">
                        <span>Petunjuk Arah Google Maps</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <!-- Surabaya Jagalan -->
            <div class="bg-white rounded-2xl p-6 border-2 border-rose-500/40 shadow-sm flex flex-col justify-between relative">
                <span class="absolute -top-3 right-5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-600 text-white uppercase tracking-wider shadow">
                    Sentra Toko Alat Listrik
                </span>
                <div>
                    <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold bg-rose-50 text-rose-700 mb-4">
                        Commercial Hub & Showroom
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-outfit">Surabaya - Jagalan</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        Jl. Jagalan No. 38, Bongkaran, Kec. Pabean Cantian, Surabaya Pusat, Jawa Timur 60161.
                    </p>
                    <div class="mt-4 space-y-1.5 text-xs text-slate-500">
                        <p><strong>Telp:</strong> (031) 99909120</p>
                        <p><strong>Fokus:</strong> Showroom Komponen, Retail & Grosir Cepat, Pengambilan Barang</p>
                        <p><strong>Jam Operasional:</strong> Senin - Sabtu 08.00 - 17.00</p>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="https://maps.google.com/?q=Jl.+Jagalan+No.+38+Surabaya" target="_blank" rel="noopener noreferrer"
                       class="w-full py-2 px-3 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-semibold text-xs flex items-center justify-center gap-1.5 transition">
                        <span>Kunjungi Showroom Jagalan</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <!-- Pandaan / Taman Dayu -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold bg-slate-100 text-slate-700 mb-4">
                        Workshop Fabrikasi Panel
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-outfit">Pandaan - Taman Dayu</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        The Taman Dayu, Cluster Palazio Boulevard J-1 No. 06, Pandaan, Pasuruan, Jawa Timur 67156.
                    </p>
                    <div class="mt-4 space-y-1.5 text-xs text-slate-500">
                        <p><strong>Telp:</strong> (0343) 4857758</p>
                        <p><strong>Fokus:</strong> Workshop Perakitan Panel, Wiring, Uji FAT, QC Beban</p>
                        <p><strong>Area Layanan:</strong> Pasuruan, Malang, Probolinggo & Sekitarnya</p>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="https://maps.google.com/?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan" target="_blank" rel="noopener noreferrer"
                       class="w-full py-2 px-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs flex items-center justify-center gap-1.5 transition">
                        <span>Petunjuk Arah Pandaan</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Proyek Kelistrikan & Panel Maker di Jawa Timur -->
<section class="py-16 sm:py-20 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-700 mb-3">
                Portofolio Proyek
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight font-outfit">
                Penyedia Komponen & Fabrikasi Panel Proyek Terkemuka
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3">
                Kepercayaan lebih dari 500+ pabrik industri, gedung komersial, rumah sakit, dan infrastruktur di Surabaya & seluruh Indonesia.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-white group">
                <div class="h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/projects/project-1-substation.webp') }}" alt="Penyedia Alat Listrik Gardu Induk Surabaya" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                </div>
                <div class="p-4">
                    <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider block">Industri Manufaktur</span>
                    <h3 class="text-sm font-bold text-slate-900 mt-1 line-clamp-1">Substation & LVMDP Distribusi</h3>
                    <p class="text-xs text-slate-500 mt-1">Suplai Air Circuit Breaker (ACB) Schneider MasterPact & Busbar tembaga.</p>
                </div>
            </div>

            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-white group">
                <div class="h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/projects/project-2-indofood-mcc.webp') }}" alt="Panel MCC Pabrik Makanan Surabaya" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                </div>
                <div class="p-4">
                    <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider block">Food & Beverage</span>
                    <h3 class="text-sm font-bold text-slate-900 mt-1 line-clamp-1">Motor Control Center (MCC)</h3>
                    <p class="text-xs text-slate-500 mt-1">Komponen Kontaktor TeSys, Thermal Overload & Inverter VFD.</p>
                </div>
            </div>

            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-white group">
                <div class="h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/projects/project-3-coldstorage.webp') }}" alt="Panel Cold Storage Jawa Timur" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                </div>
                <div class="p-4">
                    <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider block">Logistik & Cold Storage</span>
                    <h3 class="text-sm font-bold text-slate-900 mt-1 line-clamp-1">Panel ATS / AMF Otomatis</h3>
                    <p class="text-xs text-slate-500 mt-1">Motorized Changeover Switch Socomec & Deep Sea Controller.</p>
                </div>
            </div>

            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-white group">
                <div class="h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/projects/project-7-datacenter-busway.webp') }}" alt="Distribusi Daya Data Center Surabaya" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                </div>
                <div class="p-4">
                    <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider block">Data Center</span>
                    <h3 class="text-sm font-bold text-slate-900 mt-1 line-clamp-1">Kapasitor Bank & Power Quality</h3>
                    <p class="text-xs text-slate-500 mt-1">Automatic Power Factor Correction (APFC) & Surge Arrester.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('services.panel') }}" class="inline-flex items-center gap-2 text-sm font-bold text-rose-600 hover:text-rose-700 transition">
                <span>Lihat Layanan Jasa Pembuatan Panel Listrik Surabaya</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>
</section>

<!-- Frequently Asked Questions (FAQ) Section -->
<div class="bg-slate-50 py-16 sm:py-20 border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-faq-accordion :faqs="$faqs" />
    </div>
</div>

<!-- High Conversion Final CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-br from-slate-900 via-slate-900 to-rose-950 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: radial-gradient(circle at 1px 1px, #E11D48 1.2px, transparent 0); background-size: 24px 24px;"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-500/20 text-rose-400 border border-rose-500/30 mb-5">
            Dapatkan Penawaran Harga Terbaik Hari Ini
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight font-outfit">
            Siap Memenuhi Kebutuhan Alat Listrik Proyek Anda di Surabaya?
        </h2>
        <p class="text-base sm:text-lg text-slate-300 mt-4 max-w-2xl mx-auto leading-relaxed">
            Hubungi tim sales engineer PT. Anugerah Tama Sejati untuk konsultasi ketersediaan stok, diskon proyek grosir B2B, atau kirimkan file BoQ Anda sekarang juga.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-sm sm:text-base shadow-xl transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span>Chat Sales via WhatsApp (+62 812-3456-7890)</span>
            </a>
            <a href="tel:+623159178887"
               class="inline-flex items-center gap-2 px-6 py-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm sm:text-base border border-slate-700 transition">
                <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>Telepon Kantor: (031) 59178887</span>
            </a>
        </div>

        <div class="mt-8 text-xs text-slate-400">
            <span>PT. Anugerah Tama Sejati &bull; Ruko Galaxi Bumi Permai J-1 No. 23 &bull; Jl. Jagalan No. 38, Surabaya</span>
        </div>
    </div>
</section>
@endsection
