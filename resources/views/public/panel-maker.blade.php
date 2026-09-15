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
                    <span>Switchboard Panel Builder Surabaya</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-white">
                    Jasa Pembuatan Panel Listrik di Surabaya
                </h1>

                <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl font-normal">
                    PT. Anugerah Tama Sejati melayani rancang bangun, perakitan, dan pengujian panel listrik tegangan rendah bersertifikat di Surabaya dan Jawa Timur. Kami mengintegrasikan komponen original dari Schneider Electric, Legrand, GAE, dan Socomec untuk kebutuhan pabrik, gedung bertingkat, infrastruktur, dan kontraktor.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="https://wa.me/6282223332830?text={{ urlencode($waMessage) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-rose-900/30 transition transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Konsultasi BoQ &amp; Spesifikasi via WhatsApp</span>
                    </a>

                    <a href="#jenis-panel" class="inline-flex items-center gap-2 px-5 py-3.5 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-bold text-sm rounded-xl transition">
                        <span>Lihat Jenis Panel</span>
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
                    <h3 class="font-bold text-white text-base">100% Komponen Asli</h3>
                    <p class="text-xs text-slate-400 mt-1">Schneider Electric, Legrand, GAE, Socomec bergaransi resmi.</p>
                </div>

                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">Factory Testing (FAT)</h3>
                    <p class="text-xs text-slate-400 mt-1">Uji insulasi, kontinuitas, dan simulasi trip sebelum serah terima.</p>
                </div>

                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">Custom Enclosure</h3>
                    <p class="text-xs text-slate-400 mt-1">Plate tebal 1.5 - 2.0 mm powder coating indoor / outdoor IP31 - IP65.</p>
                </div>

                <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-xs">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-white text-base">Workshop Surabaya</h3>
                    <p class="text-xs text-slate-400 mt-1">Siap kirim ke Surabaya, Gresik, Sidoarjo, dan seluruh Indonesia.</p>
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
                Portofolio Perakitan
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Jenis Panel Listrik yang Kami Kerjakan
            </h2>
            <p class="text-slate-600 mt-3 text-base">
                Kami merakit panel listrik tegangan rendah (LV Switchboard) sesuai Single Line Diagram (SLD) dan kapasitas beban yang Anda butuhkan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- 1. Panel ATS / AMF -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-black text-lg mb-5">
                    01
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Panel ATS / AMF (Genset - PLN)</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Automatic Transfer Switch &amp; Automatic Main Failure untuk mengalihkan sumber listrik secara otomatis saat PLN padam ke genset, menjaga kontinuitas operasional fasilitas Anda.
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong>Aplikasi:</strong> Rumah sakit, data center, pabrik, hotel, gedung perkantoran.</div>
                    <div><strong>Komponen Utama:</strong> Motorized MCCB/ACB, ATS Controller, Interlock mekanik/elektrik.</div>
                </div>
            </div>

            <!-- 2. Panel LVMDP -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-black text-lg mb-5">
                    02
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Panel LVMDP (Main Distribution)</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Low Voltage Main Distribution Panel sebagai induk penerima daya dari trafo/genset dan mendistribusikannya ke seluruh sub-panel dengan proteksi selektif tingkat tinggi.
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong>Aplikasi:</strong> Induk distribusi daya pabrik manufaktur dan kawasan industri.</div>
                    <div><strong>Komponen Utama:</strong> Air Circuit Breaker (ACB MasterPact), Digital Power Meter, Busbar tembaga murni.</div>
                </div>
            </div>

            <!-- 3. Panel Kapasitor Bank (APFC) -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-lg mb-5">
                    03
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Panel Kapasitor Bank (APFC)</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Automatic Power Factor Correction untuk memperbaiki faktor daya (Cos Phi &ge; 0.85), menghilangkan denda kVARh PLN, dan mengurangi rugi daya pada trafo serta kabel.
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong>Aplikasi:</strong> Fasilitas dengan beban induktif tinggi (motor, chiller, kompresor).</div>
                    <div><strong>Komponen Utama:</strong> Power Factor Regulator, Heavy Duty Capacitor, Kontaktor kapasitor khusus detuned reactor.</div>
                </div>
            </div>

            <!-- 4. Panel Inverter / VFD -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-lg mb-5">
                    04
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Panel Inverter / VFD Motor Drive</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Panel pengendali kecepatan motor listrik presisi tinggi berbasis inverter Schneider Altivar untuk optimalisasi proses produksi dan penghematan konsumsi listrik pompa/fan.
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong>Aplikasi:</strong> Pompa booster, water treatment, AHU HVAC, conveyor line, blower.</div>
                    <div><strong>Komponen Utama:</strong> Inverter Altivar ATV630/320, Line Reactor, Ventilasi exhaust berfilter.</div>
                </div>
            </div>

            <!-- 5. Panel SDP & Penerangan -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center font-black text-lg mb-5">
                    05
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Panel SDP (Sub Distribution)</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Panel pembagi daya tingkat kedua yang menyalurkan listrik dari LVMDP ke mesin-mesin produksi, penerangan, atau lantai gedung dengan pembagian fasa R-S-T yang seimbang.
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong>Aplikasi:</strong> Lantai gedung, lini produksi mesin, area gudang logistik.</div>
                    <div><strong>Komponen Utama:</strong> Molded Case Circuit Breakers (MCCB ComPact NSX/CVS), MCB Domae/Acti9.</div>
                </div>
            </div>

            <!-- 6. Panel Motor Control Center (MCC) -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-black text-lg mb-5">
                    06
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Panel MCC &amp; Star Delta Starter</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Pusat kendali dan proteksi motor listrik industri dengan metode starting Direct On Line (DOL), Star-Delta, atau Soft Starter lengkap dengan proteksi overcurrent dan phase failure.
                </p>
                <div class="border-t border-slate-100 pt-4 text-xs text-slate-500 space-y-1.5">
                    <div><strong>Aplikasi:</strong> Motor pompa air, agitator, crusher, fan industri skala besar.</div>
                    <div><strong>Komponen Utama:</strong> Kontaktor TeSys D/Deca, Thermal Overload Relay, Phase Failure Relay.</div>
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
                    Standar Kualitas &amp; Keamanan
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Scope Layanan Perakitan Panel ATS Tekno
                </h2>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    Kami memisahkan setiap tahapan proses perakitan, pengujian, pengiriman, dan instalasi secara transparan agar pelanggan menerima panel siap pakai dengan standar keselamatan tinggi.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Fabrikasi &amp; Perakitan Workshop</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Perakitan busbar tembaga murni, routing kabel rapi bertanda ferrule numerik, dan isolasi penutup pengaman.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Factory Acceptance Test (FAT)</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Uji ketahanan isolasi (Megger test), pengujian interlock mekanik, dan simulasi fungsi kendali sebelum dikirim.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Pengiriman &amp; Komisioning Lapangan</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Pengiriman dengan armada aman berpalet kayu, disertai opsi supervisi komisioning langsung di lokasi proyek.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alur 5 Langkah Konsultasi -->
            <div class="lg:col-span-7 bg-slate-900 rounded-3xl p-7 sm:p-10 text-white shadow-xl">
                <h3 class="text-2xl font-black mb-6 text-white">Alur Pengerjaan Panel Listrik</h3>

                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            1
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">Konsultasi Kebutuhan &amp; Kirim SLD / BoQ</h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                Diskusikan spesifikasi daya, Single Line Diagram (SLD), daftar motor/beban, atau gambar teknik yang Anda miliki bersama tim engineer kami.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            2
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">Perhitungan Teknis &amp; Proposal Penawaran</h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                Tim teknis menyusun rincian komponen resmi, dimensi box, kalkulasi busbar, serta penawaran harga resmi yang transparan dan kompetitif.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            3
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">Persetujuan Drawing &amp; Proses Fabrikasi</h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                Setelah approval shop drawing, perakitan kabel kontrol dan pemasangan busbar dilakukan di workshop dengan pengawasan standar PUIL/IEC.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            4
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">Pengujian Kualitas (FAT)</h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                Panel melalui uji isolasi kelistrikan, fungsi interlock mekanis, dan simulasi trip. Pelanggan dipersilakan menyaksikan langsung sesi FAT.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold text-sm shrink-0">
                            5
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-base">Pengiriman &amp; Serah Terima Proyek</h4>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                Panel dikemas rapi dengan pallet kayu dan pelindung cuaca, dikirim ke lokasi proyek lengkap dengan manual book serta wiring diagram as-built.
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
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
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
                Checklist Data untuk Permintaan Penawaran Panel
            </h3>
            <p class="text-rose-900/80 text-sm leading-relaxed mb-6">
                Agar tim engineer kami dapat memberikan estimasi harga dan waktu pengerjaan yang akurat, mohon siapkan informasi berikut saat menghubungi kami:
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm text-rose-950 font-medium">
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>Jenis panel yang dibutuhkan (ATS, LVMDP, SDP, Inverter, Kapasitor Bank).</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>Single Line Diagram (SLD) atau sketsa diagram satu garis jika ada.</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>Total kapasitas daya (Ampere / kW / kVA) dan tegangan kerja.</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>Preferensi merek komponen utama (Schneider Electric, Legrand, dll.).</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>Kebutuhan enclosure (Indoor IP31/IP41 atau Outdoor IP54/IP65).</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="text-rose-600 font-bold">&#10003;</span>
                    <span>Lokasi pengiriman proyek dan estimasi batas waktu pemasangan.</span>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-rose-200 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="text-xs text-rose-800 block font-semibold">Sudah memiliki dokumen BoQ / SLD?</span>
                    <span class="text-sm font-bold text-rose-950">Kirimkan langsung via WhatsApp Sales Engineer</span>
                </div>
                <a href="https://wa.me/6282223332830?text={{ urlencode($waMessage) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-xs transition">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Kirim Dokumen via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Section: FAQ Pembuatan Panel Listrik -->
<div class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                Pertanyaan yang Sering Diajukan (FAQ)
            </h2>
            <p class="text-slate-600 mt-2 text-sm">
                Informasi penting seputar proses perakitan, komponen, garansi, dan pengiriman panel listrik.
            </p>
        </div>

        <div class="space-y-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">Apakah seluruh komponen yang digunakan bergaransi resmi?</h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Ya. Sebagai distributor resmi Schneider Electric, Legrand, GAE, dan Socomec di Surabaya, kami hanya menggunakan komponen 100% original dengan sertifikat garansi resmi pabrikan.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">Apakah bisa membuat panel dengan ukuran box khusus (custom)?</h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Bisa. Kami memfabrikasi box panel custom (wall-mounting atau free-standing) berbahan plat SPHC 1.5 mm hingga 2.0 mm dengan finishing powder coating industrial, disesuaikan dengan ketersediaan ruang instalasi Anda.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">Apakah pelanggan diperbolehkan melakukan pengetesan (FAT) sebelum panel dikirim?</h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Tentu saja. Kami mengundang tim teknis atau konsultan proyek pelanggan untuk menyaksikan Factory Acceptance Test (FAT) di workshop kami sebelum panel dipacking dan diberangkatkan ke lokasi proyek.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
                <h4 class="font-bold text-slate-900 text-base mb-2">Apakah melayani pengiriman panel ke luar Surabaya / luar pulau?</h4>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Ya. Kami melayani pengiriman panel listrik ke seluruh kawasan industri Jawa Timur (Gresik, Sidoarjo, Mojokerto, Pasuruan) serta pengiriman ekspedisi terasuransi ke seluruh wilayah Indonesia (Kalimantan, Sulawesi, Sumatra, Papua).
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Section: Final CTA -->
<div class="py-16 sm:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
            Konsultasikan Kebutuhan Panel Listrik Proyek Anda
        </h2>
        <p class="text-slate-600 max-w-2xl mx-auto text-base">
            Dapatkan rekomendasi teknis, pemilihan komponen terbaik, dan penawaran harga resmi dari tim engineer PT. Anugerah Tama Sejati di Surabaya.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="https://wa.me/6282223332830?text={{ urlencode($waMessage) }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 px-8 py-4 bg-rose-600 hover:bg-rose-700 text-white font-bold text-base rounded-2xl shadow-lg shadow-rose-900/20 transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span>Hubungi Sales Engineering via WhatsApp</span>
            </a>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold text-base rounded-2xl shadow-xs transition">
                <span>Alamat Kantor &amp; Workshop</span>
            </a>
        </div>
    </div>
</div>
@endsection
