@extends('layouts.app')

@php
    $pageTitle = 'Jasa Pembuatan Panel Listrik Surabaya | ATS Tekno';
    $metaDesc = 'Jasa pembuatan dan perakitan panel listrik industri bersertifikat di Surabaya: ATS/AMF, LVMDP, SDP, Inverter/VFD, Kapasitor Bank, Control Panel. Konsultasi BoQ & penawaran resmi.';

    $serviceSchema = [
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
                        'name' => 'Jasa Pembuatan Panel Listrik',
                        'item' => route('services.panel'),
                    ]
                ]
            ],
            [
                '@type' => 'Service',
                '@id' => route('services.panel') . '#service',
                'name' => 'Jasa Pembuatan Panel Listrik di Surabaya',
                'serviceType' => 'Jasa Perakitan dan Fabrikasi Panel Listrik Tegangan Rendah (Switchboard Panel Builder)',
                'description' => $metaDesc,
                'url' => route('services.panel'),
                'provider' => [
                    '@type' => 'LocalBusiness',
                    '@id' => url('/#organization'),
                    'name' => 'PT. Anugerah Tama Sejati',
                    'url' => url('/'),
                    'telephone' => '+62-31-59178887',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Ruko Galaxi Bumi Permai J-1 No. 23',
                        'addressLocality' => 'Surabaya',
                        'addressRegion' => 'Jawa Timur',
                        'postalCode' => '60134',
                        'addressCountry' => 'ID'
                    ]
                ],
                'areaServed' => [
                    ['@type' => 'City', 'name' => 'Surabaya'],
                    ['@type' => 'City', 'name' => 'Gresik'],
                    ['@type' => 'City', 'name' => 'Sidoarjo'],
                    ['@type' => 'State', 'name' => 'Jawa Timur'],
                    ['@type' => 'Country', 'name' => 'Indonesia']
                ],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name' => 'Jenis Layanan Perakitan Panel Listrik',
                    'itemListElement' => [
                        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Panel ATS / AMF (Genset - PLN Switch)'] ],
                        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Panel LVMDP (Low Voltage Main Distribution Panel)'] ],
                        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Panel SDP (Sub Distribution Panel)'] ],
                        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Panel Inverter / VFD Motor Speed Control'] ],
                        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Panel Kapasitor Bank (APFC Power Factor Correction)'] ],
                        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Panel MCC (Motor Control Center)'] ],
                    ]
                ]
            ]
        ]
    ];

    $serviceSchemaJson = json_encode(
        $serviceSchema,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
    );

    $waMessage = "Halo Tim Engineering PT. Anugerah Tama Sejati,\nSaya ingin konsultasi mengenai Jasa Pembuatan Panel Listrik untuk kebutuhan proyek kami.\n\n- Jenis Panel:\n- Lokasi Proyek:\n- Estimasi Kapasitas:\n\nMohon info mengenai proses konsultasi dan penawaran BoQ.";
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDesc)
@section('canonical', route('services.panel'))

@push('schema')
<script type="application/ld+json">
{!! $serviceSchemaJson !!}
</script>
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-24 border-b border-slate-800">
    <!-- Subtle Background Grid & Glow -->
    <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: radial-gradient(circle at 1px 1px, #E11D48 1px, transparent 0); background-size: 32px 32px;"></div>
    <div class="absolute -top-24 right-0 w-96 h-96 bg-rose-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-400 transition">
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-slate-200 font-semibold">
                <span class="ats-lang-en">Panel Builder Services</span><span class="ats-lang-id">Jasa Pembuatan Panel Listrik</span>
            </span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-500/10 text-rose-400 border border-rose-500/20">
                    <svg class="w-3.5 h-3.5 text-rose-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    <span>
                        <span class="ats-lang-en">Certified Switchboard Panel Builder Surabaya</span>
                        <span class="ats-lang-id">Jasa Panel Listrik Surabaya</span>
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-white" data-reveal-text>
                    <span class="ats-lang-en">Certified Switchboard Panel Maker in Surabaya</span>
                    <span class="ats-lang-id">Jasa Pembuatan Panel Listrik di Surabaya</span>
                </h1>

                <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl font-normal">
                    <span class="ats-lang-en">PT. Anugerah Tama Sejati delivers design, custom fabrication, wiring, and certified testing for low-voltage switchboards in Surabaya and East Java. We integrate authentic components from Schneider Electric, Legrand, GAE, and Socomec for manufacturing plants, commercial buildings, infrastructure, and contractors.</span>
                    <span class="ats-lang-id">PT. Anugerah Tama Sejati melayani rancang bangun, perakitan, dan pengujian panel listrik tegangan rendah bersertifikat di Surabaya dan Jawa Timur. Kami mengintegrasikan komponen original dari Schneider Electric, Legrand, GAE, dan Socomec untuk kebutuhan pabrik, gedung bertingkat, infrastruktur, dan kontraktor.</span>
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="https://wa.me/6282223332830?text={{ urlencode($waMessage) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-rose-900/30 transition transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>
                            <span class="ats-lang-en">Consult BoQ &amp; Specs via WhatsApp</span>
                            <span class="ats-lang-id">Konsultasi BoQ &amp; Spesifikasi via WhatsApp</span>
                        </span>
                    </a>

                    <a href="#jenis-panel" class="inline-flex items-center gap-2 px-5 py-3.5 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-bold text-sm rounded-xl transition">
                        <span>
                            <span class="ats-lang-en">Explore Panel Types</span>
                            <span class="ats-lang-id">Lihat Jenis Panel</span>
                        </span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Key Feature Badges -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">
                        <span class="ats-lang-en">100% Genuine Components</span>
                        <span class="ats-lang-id">100% Komponen Asli</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        <span class="ats-lang-en">Schneider Electric, Legrand, GAE, Socomec with official warranty.</span>
                        <span class="ats-lang-id">Schneider Electric, Legrand, GAE, Socomec bergaransi resmi.</span>
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">
                        <span class="ats-lang-en">Factory Testing (FAT)</span>
                        <span class="ats-lang-id">Factory Testing (FAT)</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        <span class="ats-lang-en">Insulation test, continuity, and trip simulation prior to delivery.</span>
                        <span class="ats-lang-id">Uji insulasi, kontinuitas, dan simulasi trip sebelum serah terima.</span>
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">
                        <span class="ats-lang-en">Custom Enclosure</span>
                        <span class="ats-lang-id">Custom Enclosure</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        <span class="ats-lang-en">1.5 - 2.0 mm steel plate, industrial powder coating IP31 - IP65.</span>
                        <span class="ats-lang-id">Plate tebal 1.5 - 2.0 mm powder coating indoor / outdoor IP31 - IP65.</span>
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">
                        <span class="ats-lang-en">Surabaya Workshop</span>
                        <span class="ats-lang-id">Workshop Surabaya</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        <span class="ats-lang-en">Fast dispatch to Surabaya, Gresik, Sidoarjo, and nationwide.</span>
                        <span class="ats-lang-id">Siap kirim ke Surabaya, Gresik, Sidoarjo, dan seluruh Indonesia.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section: Jenis Panel yang Dilayani -->
<div id="jenis-panel" class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                <span class="ats-lang-en">Manufacturing Portfolio</span>
                <span class="ats-lang-id">Portofolio Perakitan</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight" data-reveal-text>
                <span class="ats-lang-en">Types of Switchboard Panels We Build</span>
                <span class="ats-lang-id">Jenis Panel Listrik yang Kami Kerjakan</span>
            </h2>
            <p class="text-slate-600 mt-3 text-base">
                <span class="ats-lang-en">We build certified low-voltage switchboards (LV Switchboards) according to your Single Line Diagram (SLD) and required load specifications.</span>
                <span class="ats-lang-id">Kami merakit panel listrik tegangan rendah (LV Switchboard) sesuai Single Line Diagram (SLD) dan kapasitas beban yang Anda butuhkan.</span>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- 1. Panel ATS / AMF -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-black text-lg mb-5">
                    01
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">
                    <span class="ats-lang-en">ATS / AMF Panel (Generator - Grid)</span>
                    <span class="ats-lang-id">Panel ATS / AMF (Genset - PLN)</span>
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <span class="ats-lang-en">Automatic Transfer Switch &amp; Automatic Main Failure to seamlessly transfer electrical power from utility grid to backup generator during outages, ensuring continuous facility operation.</span>
                    <span class="ats-lang-id">Automatic Transfer Switch &amp; Automatic Main Failure untuk mengalihkan sumber listrik secara otomatis saat PLN padam ke genset, menjaga kontinuitas operasional fasilitas Anda.</span>
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong><span class="ats-lang-en">Application:</span><span class="ats-lang-id">Aplikasi:</span></strong> <span class="ats-lang-en">Hospitals, data centers, manufacturing plants, hotels, commercial office towers.</span><span class="ats-lang-id">Rumah sakit, data center, pabrik, hotel, gedung perkantoran.</span></div>
                    <div><strong><span class="ats-lang-en">Key Components:</span><span class="ats-lang-id">Komponen Utama:</span></strong> Motorized MCCB/ACB, ATS Controller, Mechanical &amp; Electrical Interlocks.</div>
                </div>
            </div>

            <!-- 2. Panel LVMDP -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-black text-lg mb-5">
                    02
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">
                    <span class="ats-lang-en">LVMDP (Main Distribution Switchboard)</span>
                    <span class="ats-lang-id">Panel LVMDP (Main Distribution)</span>
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <span class="ats-lang-en">Low Voltage Main Distribution Panel serving as the primary power intake from transformers or generators, distributing power downstream with high-level selective protection.</span>
                    <span class="ats-lang-id">Low Voltage Main Distribution Panel sebagai induk penerima daya dari trafo/genset dan mendistribusikannya ke seluruh sub-panel dengan proteksi selektif tingkat tinggi.</span>
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong><span class="ats-lang-en">Application:</span><span class="ats-lang-id">Aplikasi:</span></strong> <span class="ats-lang-en">Main power distribution for industrial plants, factories, and commercial complexes.</span><span class="ats-lang-id">Induk distribusi daya pabrik manufaktur dan kawasan industri.</span></div>
                    <div><strong><span class="ats-lang-en">Key Components:</span><span class="ats-lang-id">Komponen Utama:</span></strong> Air Circuit Breaker (MasterPact MTZ/NT/NW), Digital Power Meter, High-Grade Copper Busbar.</div>
                </div>
            </div>

            <!-- 3. Panel Kapasitor Bank (APFC) -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-lg mb-5">
                    03
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">
                    <span class="ats-lang-en">Capacitor Bank Panel (APFC)</span>
                    <span class="ats-lang-id">Panel Kapasitor Bank (APFC)</span>
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <span class="ats-lang-en">Automatic Power Factor Correction to optimize power factor (Cos Phi &ge; 0.85), eliminate utility kVARh penalty fees, and reduce transformer and cabling losses.</span>
                    <span class="ats-lang-id">Automatic Power Factor Correction untuk memperbaiki faktor daya (Cos Phi &ge; 0.85), menghilangkan denda kVARh PLN, dan mengurangi rugi daya pada trafo serta kabel.</span>
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong><span class="ats-lang-en">Application:</span><span class="ats-lang-id">Aplikasi:</span></strong> <span class="ats-lang-en">Facilities with heavy inductive loads (industrial motors, chillers, heavy compressors).</span><span class="ats-lang-id">Fasilitas dengan beban induktif tinggi (motor, chiller, kompresor).</span></div>
                    <div><strong><span class="ats-lang-en">Key Components:</span><span class="ats-lang-id">Komponen Utama:</span></strong> Power Factor Regulator, Heavy Duty Capacitors, Detuned Harmonic Reactors.</div>
                </div>
            </div>

            <!-- 4. Panel Inverter / VFD -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-lg mb-5">
                    04
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">
                    <span class="ats-lang-en">Inverter / VFD Motor Drive Panel</span>
                    <span class="ats-lang-id">Panel Inverter / VFD Motor Drive</span>
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <span class="ats-lang-en">Precision variable speed control panels using Schneider Altivar VFDs for process optimization, soft starting, and energy efficiency on pump and blower systems.</span>
                    <span class="ats-lang-id">Panel pengendali kecepatan motor listrik presisi tinggi berbasis inverter Schneider Altivar untuk optimalisasi proses produksi dan penghematan konsumsi listrik pompa/fan.</span>
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong><span class="ats-lang-en">Application:</span><span class="ats-lang-id">Aplikasi:</span></strong> <span class="ats-lang-en">Booster pumps, water treatment plants, HVAC AHUs, conveyor lines, heavy blowers.</span><span class="ats-lang-id">Pompa booster, water treatment, AHU HVAC, conveyor line, blower.</span></div>
                    <div><strong><span class="ats-lang-en">Key Components:</span><span class="ats-lang-id">Komponen Utama:</span></strong> Inverter Altivar ATV630/320, Line Reactors, Filtered Exhaust Ventilation.</div>
                </div>
            </div>

            <!-- 5. Panel SDP & Penerangan -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center font-black text-lg mb-5">
                    05
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">
                    <span class="ats-lang-en">Sub Distribution Panel (SDP)</span>
                    <span class="ats-lang-id">Panel SDP (Sub Distribution)</span>
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <span class="ats-lang-en">Secondary power distribution boards feeding machinery, lighting, and floor areas from the LVMDP with balanced R-S-T phase loading and selective branch protection.</span>
                    <span class="ats-lang-id">Panel pembagi daya tingkat kedua yang menyalurkan listrik dari LVMDP ke mesin-mesin produksi, penerangan, atau lantai gedung dengan pembagian fasa R-S-T yang seimbang.</span>
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong><span class="ats-lang-en">Application:</span><span class="ats-lang-id">Aplikasi:</span></strong> <span class="ats-lang-en">Building floors, production machinery lines, warehouse logistics bays.</span><span class="ats-lang-id">Lantai gedung, lini produksi mesin, area gudang logistik.</span></div>
                    <div><strong><span class="ats-lang-en">Key Components:</span><span class="ats-lang-id">Komponen Utama:</span></strong> ComPact NSX/CVS MCCBs, Acti9 / Domae MCBs, Surge Arresters.</div>
                </div>
            </div>

            <!-- 6. Panel Motor Control Center (MCC) -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-black text-lg mb-5">
                    06
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">
                    <span class="ats-lang-en">Motor Control Center (MCC)</span>
                    <span class="ats-lang-id">Panel MCC &amp; Star Delta Starter</span>
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <span class="ats-lang-en">Centralized industrial motor starter switchboards configured for Direct-On-Line (DOL), Star-Delta, or Soft Starter operation with comprehensive thermal overload and phase failure protection.</span>
                    <span class="ats-lang-id">Pusat kendali dan proteksi motor listrik industri dengan metode starting Direct On Line (DOL), Star-Delta, atau Soft Starter lengkap dengan proteksi overcurrent dan phase failure.</span>
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong><span class="ats-lang-en">Application:</span><span class="ats-lang-id">Aplikasi:</span></strong> <span class="ats-lang-en">Water pump stations, industrial agitators, crushers, large ventilation fans.</span><span class="ats-lang-id">Motor pompa air, agitator, crusher, fan industri skala besar.</span></div>
                    <div><strong><span class="ats-lang-en">Key Components:</span><span class="ats-lang-id">Komponen Utama:</span></strong> TeSys D/Deca Contactors, Thermal Overload Relays, Phase Failure Relays.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section: Scope Layanan & Alur Kerja -->
<div class="py-16 sm:py-24 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 space-y-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-blue-50 text-blue-600 border border-blue-200">
                    <span class="ats-lang-en">Quality &amp; Safety Standards</span>
                    <span class="ats-lang-id">Standar Kualitas &amp; Keamanan</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight" data-reveal-text>
                    <span class="ats-lang-en">ATS Tekno Panel Fabrication Scope</span>
                    <span class="ats-lang-id">Scope Layanan Perakitan Panel ATS Tekno</span>
                </h2>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    <span class="ats-lang-en">Every switchboard assembled by PT. Anugerah Tama Sejati undergoes strict engineering oversight, standard-compliant busbar calculations, and rigorous testing before site commissioning.</span>
                    <span class="ats-lang-id">Kami memisahkan setiap tahapan proses perakitan, pengujian, pengiriman, dan instalasi secara transparan agar pelanggan menerima panel siap pakai dengan standar keselamatan tinggi.</span>
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">
                                <span class="ats-lang-en">Workshop Fabrication &amp; Wiring</span>
                                <span class="ats-lang-id">Fabrikasi &amp; Perakitan Workshop</span>
                            </h4>
                            <p class="text-xs text-slate-500 mt-0.5">
                                <span class="ats-lang-en">Pure electrolytic copper busbar bending, heat-shrink color coding, and ferrule-labeled control wiring.</span>
                                <span class="ats-lang-id">Perakitan busbar tembaga murni, routing kabel rapi bertanda ferrule numerik, dan isolasi penutup pengaman.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">
                                <span class="ats-lang-en">Factory Acceptance Test (FAT)</span>
                                <span class="ats-lang-id">Factory Acceptance Test (FAT)</span>
                            </h4>
                            <p class="text-xs text-slate-500 mt-0.5">
                                <span class="ats-lang-en">High-voltage Megger insulation test, mechanical interlock check, and live control logic simulation.</span>
                                <span class="ats-lang-id">Uji ketahanan isolasi (Megger test), pengujian interlock mekanik, dan simulasi fungsi kendali sebelum dikirim.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">
                                <span class="ats-lang-en">Nationwide Delivery &amp; Site Commissioning</span>
                                <span class="ats-lang-id">Pengiriman &amp; Komisioning Lapangan</span>
                            </h4>
                            <p class="text-xs text-slate-500 mt-0.5">
                                <span class="ats-lang-en">Weather-wrapped wooden crating with freight insurance, plus optional on-site commissioning supervision.</span>
                                <span class="ats-lang-id">Pengiriman dengan armada aman berpalet kayu, disertai opsi supervisi komisioning langsung di lokasi proyek.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alur 5 Langkah Konsultasi -->
            <div class="lg:col-span-7 bg-slate-900 rounded-3xl p-7 sm:p-10 text-white shadow-xl">
                <h3 class="text-2xl font-black mb-6 text-white">
                    <span class="ats-lang-en">5-Step Panel Fabrication Workflow</span>
                    <span class="ats-lang-id">Alur Pengerjaan Panel Listrik</span>
                </h3>

                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            1
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">
                                <span class="ats-lang-en">1. Consultation &amp; SLD / BoQ Review</span>
                                <span class="ats-lang-id">1. Konsultasi Kebutuhan &amp; Kirim SLD / BoQ</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                <span class="ats-lang-en">Discuss electrical capacity, Single Line Diagram (SLD), motor schedules, and mechanical specs with our engineering team.</span>
                                <span class="ats-lang-id">Diskusikan spesifikasi daya, Single Line Diagram (SLD), daftar motor/beban, atau gambar teknik yang Anda miliki bersama tim engineer kami.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            2
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">
                                <span class="ats-lang-en">2. Technical Sizing &amp; Official Proposal</span>
                                <span class="ats-lang-id">2. Perhitungan Teknis &amp; Proposal Penawaran</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                <span class="ats-lang-en">Our technical specialists calculate busbar dimensions, select components, and deliver a competitive transparent commercial proposal.</span>
                                <span class="ats-lang-id">Tim teknis menyusun rincian komponen resmi, dimensi box, kalkulasi busbar, serta penawaran harga resmi yang transparan dan kompetitif.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            3
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">
                                <span class="ats-lang-en">3. Drawing Approval &amp; Assembly</span>
                                <span class="ats-lang-id">3. Persetujuan Drawing &amp; Proses Fabrikasi</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                <span class="ats-lang-en">Upon shop drawing sign-off, enclosure cutting, copper busbar bending, and neat wiring proceed under strict IEC/SNI supervision.</span>
                                <span class="ats-lang-id">Setelah approval shop drawing, perakitan kabel kontrol dan pemasangan busbar dilakukan di workshop dengan pengawasan standar PUIL/IEC.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            4
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">
                                <span class="ats-lang-en">4. Factory Acceptance Testing (FAT)</span>
                                <span class="ats-lang-id">4. Pengujian Kualitas (FAT)</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                <span class="ats-lang-en">Comprehensive insulation resistance tests, mechanical interlock trials, and live control logic checks. Clients are welcome to attend FAT.</span>
                                <span class="ats-lang-id">Panel melalui uji isolasi kelistrikan, fungsi interlock mekanis, dan simulasi trip. Pelanggan dipersilakan menyaksikan langsung sesi FAT.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            5
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">
                                <span class="ats-lang-en">5. Crated Delivery &amp; Project Handover</span>
                                <span class="ats-lang-id">5. Pengiriman &amp; Serah Terima Proyek</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                <span class="ats-lang-en">Panels are securely wrapped on wooden pallets, dispatched to job sites with operation manuals, test certificates, and as-built schematics.</span>
                                <span class="ats-lang-id">Panel dikemas rapi dengan pallet kayu dan pelindung cuaca, dikirim ke lokasi proyek lengkap dengan manual book serta wiring diagram as-built.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section: Dokumentasi Proyek Nyata -->
@if(isset($projects) && $projects->isNotEmpty())
<div class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-emerald-50 text-emerald-700 border border-emerald-200 mb-3">
                    Bukti Pengerjaan
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight" data-reveal-text>
                    Proyek Perakitan Panel yang Telah Diselesaikan
                </h2>
                <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl">
                    Beberapa contoh switchboard panel yang dirakit oleh tim PT. Anugerah Tama Sejati untuk fasilitas industri dan gedung komersial.
                </p>
            </div>
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-rose-600 hover:text-rose-700 transition">
                <span>Lihat Seluruh Portofolio</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $p)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col">
                <div class="h-48 bg-slate-100 relative overflow-hidden flex items-center justify-center">
                    @if($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-slate-400 flex flex-col items-center gap-2">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span class="text-xs font-semibold uppercase tracking-wider">ATS Switchboard Panel</span>
                        </div>
                    @endif
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-lg mb-2">
                            <a href="{{ route('projects.show', $p->slug) }}" class="hover:text-rose-600 transition">
                                {{ $p->title }}
                            </a>
                        </h3>
                        <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                            {{ $p->meta_description ?: $p->client_name ?: 'Proyek panel maker industri oleh PT. Anugerah Tama Sejati.' }}
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span>Surabaya &amp; Jawa Timur</span>
                        <a href="{{ route('projects.show', $p->slug) }}" class="font-bold text-rose-600 hover:text-rose-700 transition">
                            Detail Proyek &rarr;
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Section: Checklist Data untuk Permintaan Penawaran -->
<div class="py-16 sm:py-20 bg-white border-b border-slate-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-rose-50 border border-rose-200 rounded-3xl p-8 sm:p-10">
            <h3 class="text-2xl font-black text-rose-950 mb-3">
                <span class="ats-lang-en">Data Checklist for Panel Quotations</span>
                <span class="ats-lang-id">Checklist Data untuk Permintaan Penawaran Panel</span>
            </h3>
            <p class="text-rose-900/80 text-sm leading-relaxed mb-6">
                <span class="ats-lang-en">To ensure an accurate quotation and lead time, please have the following information ready when reaching out:</span>
                <span class="ats-lang-id">Agar tim engineer kami dapat memberikan estimasi harga dan waktu pengerjaan yang akurat, mohon siapkan informasi berikut saat menghubungi kami:</span>
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm text-rose-950 font-medium">
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>
                        <span class="ats-lang-en">Required panel type (ATS, LVMDP, SDP, Inverter VFD, Capacitor Bank).</span>
                        <span class="ats-lang-id">Jenis panel yang dibutuhkan (ATS, LVMDP, SDP, Inverter, Kapasitor Bank).</span>
                    </span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>
                        <span class="ats-lang-en">Single Line Diagram (SLD) or one-line schematic if available.</span>
                        <span class="ats-lang-id">Single Line Diagram (SLD) atau sketsa diagram satu garis jika ada.</span>
                    </span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>
                        <span class="ats-lang-en">Total load capacity (Amps / kW / kVA) and operational voltage.</span>
                        <span class="ats-lang-id">Total kapasitas daya (Ampere / kW / kVA) dan tegangan kerja.</span>
                    </span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>
                        <span class="ats-lang-en">Preferred component brands (Schneider Electric, Legrand, GAE, etc.).</span>
                        <span class="ats-lang-id">Preferensi merek komponen utama (Schneider Electric, Legrand, dll.).</span>
                    </span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>
                        <span class="ats-lang-en">Enclosure requirements (Indoor IP31/IP41 or Outdoor IP54/IP65).</span>
                        <span class="ats-lang-id">Kebutuhan enclosure (Indoor IP31/IP41 atau Outdoor IP54/IP65).</span>
                    </span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>
                        <span class="ats-lang-en">Project job site location and expected delivery deadline.</span>
                        <span class="ats-lang-id">Lokasi pengiriman proyek dan estimasi batas waktu pemasangan.</span>
                    </span>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-rose-200 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="text-xs text-rose-800 block font-semibold">
                        <span class="ats-lang-en">Already have a BoQ or SLD drawing?</span>
                        <span class="ats-lang-id">Sudah memiliki dokumen BoQ / SLD?</span>
                    </span>
                    <span class="text-sm font-bold text-rose-950">
                        <span class="ats-lang-en">Send files directly to our Sales Engineering team</span>
                        <span class="ats-lang-id">Kirimkan langsung via WhatsApp Sales Engineer</span>
                    </span>
                </div>
                <a href="https://wa.me/6282223332830?text={{ urlencode($waMessage) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-xs transition">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>
                        <span class="ats-lang-en">Send Specs on WhatsApp</span>
                        <span class="ats-lang-id">Kirim Dokumen via WhatsApp</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Section: FAQ Pembuatan Panel Listrik -->
<div class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight" data-reveal-text>
                <span class="ats-lang-en">Frequently Asked Questions (FAQ)</span>
                <span class="ats-lang-id">Pertanyaan yang Sering Diajukan (FAQ)</span>
            </h2>
            <p class="text-slate-600 mt-2 text-sm">
                Informasi penting seputar proses perakitan, komponen, garansi, dan pengiriman panel listrik.
            </p>
        </div>

        <div class="space-y-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">
                    <span class="ats-lang-en">Are all components backed by official manufacturer warranties?</span>
                    <span class="ats-lang-id">Apakah seluruh komponen yang digunakan bergaransi resmi?</span>
                </h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    <span class="ats-lang-en">Yes. As an authorized distributor for Schneider Electric, Legrand, GAE, and Socomec in Surabaya, we only use 100% genuine components with official factory warranty certificates and Certificates of Origin (CoO).</span>
                    <span class="ats-lang-id">Ya. Sebagai distributor resmi Schneider Electric, Legrand, GAE, dan Socomec di Surabaya, kami hanya menggunakan komponen 100% original dengan sertifikat garansi resmi pabrikan.</span>
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">
                    <span class="ats-lang-en">Can you fabricate custom-dimension enclosure boxes?</span>
                    <span class="ats-lang-id">Apakah bisa membuat panel dengan ukuran box khusus (custom)?</span>
                </h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    <span class="ats-lang-en">Yes. We fabricate custom wall-mounting or free-standing enclosures using 1.5 mm to 2.0 mm SPHC steel plates with industrial powder coating, tailored precisely to your installation space.</span>
                    <span class="ats-lang-id">Bisa. Kami memfabrikasi box panel custom (wall-mounting atau free-standing) berbahan plat SPHC 1.5 mm hingga 2.0 mm dengan finishing powder coating industrial, disesuaikan dengan ketersediaan ruang instalasi Anda.</span>
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">
                    <span class="ats-lang-en">Can clients witness Factory Acceptance Testing (FAT) before delivery?</span>
                    <span class="ats-lang-id">Apakah pelanggan diperbolehkan melakukan pengetesan (FAT) sebelum panel dikirim?</span>
                </h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    <span class="ats-lang-en">Certainly. We invite your project technical team or engineering consultants to attend the Factory Acceptance Test (FAT) at our Surabaya workshop prior to crating and dispatch.</span>
                    <span class="ats-lang-id">Tentu saja. Kami mengundang tim teknis atau konsultan proyek pelanggan untuk menyaksikan Factory Acceptance Test (FAT) di workshop kami sebelum panel dipacking dan diberangkatkan ke lokasi proyek.</span>
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">
                    <span class="ats-lang-en">Do you deliver panels outside Surabaya / across Indonesia?</span>
                    <span class="ats-lang-id">Apakah melayani pengiriman panel ke luar Surabaya / luar pulau?</span>
                </h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    <span class="ats-lang-en">Yes. We regularly deliver to East Java industrial estates (Gresik, Sidoarjo, Mojokerto, Pasuruan) and provide insured heavy-freight shipping to all islands across Indonesia.</span>
                    <span class="ats-lang-id">Ya. Kami melayani pengiriman panel listrik ke seluruh kawasan industri Jawa Timur (Gresik, Sidoarjo, Mojokerto, Pasuruan) serta pengiriman ekspedisi terasuransi ke seluruh wilayah Indonesia (Kalimantan, Sulawesi, Sumatra, Papua).</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Section: Final CTA -->
<div class="py-16 sm:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight" data-reveal-text>
            <span class="ats-lang-en">Consult Your Switchboard Project Today</span>
            <span class="ats-lang-id">Konsultasikan Kebutuhan Panel Listrik Proyek Anda</span>
        </h2>
        <p class="text-slate-600 max-w-2xl mx-auto text-base">
            <span class="ats-lang-en">Receive expert technical sizing, component selection, and official distributor proposals from PT. Anugerah Tama Sejati engineers in Surabaya.</span>
            <span class="ats-lang-id">Dapatkan rekomendasi teknis, pemilihan komponen terbaik, dan penawaran harga resmi dari tim engineer PT. Anugerah Tama Sejati di Surabaya.</span>
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="https://wa.me/6282223332830?text={{ urlencode($waMessage) }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 px-8 py-4 bg-rose-600 hover:bg-rose-700 text-white font-bold text-base rounded-2xl shadow-lg shadow-rose-900/20 transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span>
                    <span class="ats-lang-en">WhatsApp Sales Engineering</span>
                    <span class="ats-lang-id">Hubungi Sales Engineering via WhatsApp</span>
                </span>
            </a>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold text-base rounded-2xl shadow-xs transition">
                <span>
                    <span class="ats-lang-en">Office &amp; Workshop Address</span>
                    <span class="ats-lang-id">Alamat Kantor &amp; Workshop</span>
                </span>
            </a>
        </div>
    </div>
</div>
@endsection
