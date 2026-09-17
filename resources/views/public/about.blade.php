@extends('layouts.app')

@section('title', 'About Us - PT. Anugerah Tama Sejati | Best Electrical Supplier')
@section('meta_description', 'Official profile of PT. Anugerah Tama Sejati (PT ATS), established 1st August 2019 in Surabaya. Authorized distributor for Schneider Electric, Legrand, GAE, and Socomec.')

@section('content')
<div class="bg-white text-slate-800">

    <!-- ========================================================
         HERO SECTION: 2-COLUMN LAYOUT MATCHING USER'S SPECIFICATIONS
         ======================================================== -->
    <section class="relative bg-gradient-to-b from-slate-50 via-white to-slate-50 py-16 lg:py-24 border-b border-slate-200/80 overflow-hidden">
        <!-- Subtle Ambient Background Accents -->
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 bg-rose-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 bg-slate-900/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-rose-600 transition flex items-center gap-1 font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
                </a>
                <span class="text-slate-400">&rsaquo;</span>
                <span class="text-slate-900 font-bold"><span class="ats-lang-en">About Us</span><span class="ats-lang-id">Tentang Kami</span></span>
            </nav>

            <!-- Main 2-Column Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">

                <!-- LEFT COLUMN: Eyebrow + Headline + Exact Story Text + 3 Stats -->
                <div class="lg:col-span-6 space-y-6">

                    <!-- Eyebrow Tag with Leading Dash -->
                    <div class="inline-flex items-center gap-3">
                        <span class="w-10 h-0.5 bg-rose-600 rounded-full"></span>
                        <span class="text-xs sm:text-sm font-black tracking-widest text-slate-900 uppercase">
                            <span class="ats-lang-en">ESTABLISHED 2019 • INDUSTRIAL EXCELLENCE</span>
                            <span class="ats-lang-id">DIDIRIKAN 2019 • KEUNGGULAN INDUSTRI</span>
                        </span>
                    </div>

                    <!-- Big Impact Headline -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-[1.15]">
                        <span class="ats-lang-en">Building <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-red-600 to-rose-700">Industrial Reliability</span> Through Electrical Expertise</span>
                        <span class="ats-lang-id">Membangun <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-red-600 to-rose-700">Keandalan Industri</span> Melalui Keahlian Elektrikal</span>
                    </h1>

                    <!-- Paragraph 1: User's Founding Statement -->
                    <div class="ats-lang-block-en text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
                        {{ $settings['company_story_p1'] ?? 'PT. Anugerah Tama Sejati or shortened as PT ATS was formed in 1st august 2019, located in Surabaya, East Java, Indonesia. Our Company engaged in electrical equipment for industries.' }}
                    </div>
                    <div class="ats-lang-block-id text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
                        {{ $settings['company_story_p1_id'] ?? 'PT. Anugerah Tama Sejati atau disingkat PT ATS didirikan pada 1 Agustus 2019, berlokasi di Surabaya, Jawa Timur, Indonesia. Perusahaan kami bergerak di bidang pengadaan peralatan listrik khususnya untuk industri.' }}
                    </div>

                    <!-- Paragraph 2: User's Service Commitment -->
                    <div class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        {{ $settings['company_story_p2'] ?? 'Besides selling electrical equipment for industry, PT Anugerah Tama Sejati provide solutions and give the best service for all of our customers.' }}
                    </div>
                    <div class="ats-lang-block-id text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        {{ $settings['company_story_p2_id'] ?? 'Selain menyediakan peralatan listrik industri terlengkap, PT Anugerah Tama Sejati memberikan solusi rekayasa terpadu dan pelayanan prima bagi seluruh pelanggan kami.' }}
                    </div>

                    <!-- Paragraph 3: Comprehensive Industrial Scope & Principal Authorization -->
                    <div class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        {{ $settings['company_story_p3'] ?? 'Over the years, we have established ourselves as a vital supply chain partner for prominent manufacturing plants, EPC contractors, certified panel builders, and infrastructure developers across Indonesia. As an authorized distributor for leading global brands—including Schneider Electric, Legrand, GAE Group, and Socomec—we deliver genuine low-voltage power distribution switchgear, motor controls, VFD inverters, and digital metering systems backed by full manufacturer warranties and verified Certificates of Origin (COO).' }}
                    </div>
                    <div class="ats-lang-block-id text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        {{ $settings['company_story_p3_id'] ?? 'Selama bertahun-tahun, kami telah menjadi mitra rantai pasok terpercaya bagi berbagai pabrik manufaktur terkemuka, kontraktor EPC, perakit panel bersertifikat, dan pengembang infrastruktur di seluruh Indonesia. Sebagai distributor resmi untuk merek global terkemuka—termasuk Schneider Electric, Legrand, GAE Group, dan Socomec—kami menghadirkan komponen distribusi listrik tegangan rendah, kontrol motor, inverter VFD, dan sistem meteran digital original yang didukung garansi resmi pabrikan serta Sertifikat Keaslian (COO).' }}
                    </div>

                    <!-- Paragraph 4: Engineering Consultation & Warehouse Readiness -->
                    <div class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        {{ $settings['company_story_p4'] ?? 'We understand that operational uptime and personnel safety require absolute precision. Beyond component distribution, our certified sales engineers provide dedicated technical consultation, Bill of Quantities (BoQ) optimization, and protection coordination support. Supported by extensive ready-stock warehousing in Surabaya and reliable nationwide freight logistics, PT ATS is committed to preventing project downtime, safeguarding critical assets, and driving sustainable industrial growth for all stakeholders.' }}
                    </div>
                    <div class="ats-lang-block-id text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        {{ $settings['company_story_p4_id'] ?? 'Kami memahami bahwa kelancaran operasional dan keselamatan personel memerlukan presisi mutlak. Lebih dari sekadar distribusi komponen, tim sales engineer kami yang berpengalaman memberikan konsultasi teknis khusus, optimasi Bill of Quantities (BoQ), serta penentuan kapasitas proteksi. Didukung persediaan gudang ready-stock yang melimpah di Surabaya dan ekspedisi kargo nasional yang handal, PT ATS berkomitmen mencegah downtime proyek, melindungi aset penting, dan mendorong pertumbuhan industri berkelanjutan.' }}
                    </div>

                    <!-- 3 Horizontal Metrics/Stats -->
                    <div class="pt-6 border-t border-slate-200/80 grid grid-cols-3 gap-4 sm:gap-6">
                        <div class="space-y-1">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                                {{ $settings['stat_experience_years'] ?? '7+' }}
                            </div>
                            <div class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                <span class="ats-lang-en">YEARS OF EXPERIENCE</span>
                                <span class="ats-lang-id">TAHUN PENGALAMAN</span>
                            </div>
                        </div>

                        <div class="space-y-1 border-l border-slate-200/80 pl-4 sm:pl-6">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                                {{ $settings['stat_clients_count'] ?? '1,000+' }}
                            </div>
                            <div class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                <span class="ats-lang-en">CLIENTS &amp; PROJECTS</span>
                                <span class="ats-lang-id">KLIEN &amp; PROYEK</span>
                            </div>
                        </div>

                        <div class="space-y-1 border-l border-slate-200/80 pl-4 sm:pl-6">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-rose-600 tracking-tight">
                                {{ $settings['stat_guarantee_percent'] ?? '100%' }}
                            </div>
                            <div class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                <span class="ats-lang-en">GENUINE GUARANTEE</span>
                                <span class="ats-lang-id">JAMINAN 100% ASLI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Action Links -->
                    <div class="pt-2 flex flex-wrap items-center gap-2.5">
                        <a href="#company-profile" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition shadow-sm">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span class="ats-lang-en">Company Profile (PDF)</span>
                            <span class="ats-lang-id">Profil Perusahaan (PDF)</span>
                        </a>
                        <a href="#panel-project-doc" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition shadow-sm">
                            <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span class="ats-lang-en">ATS Panel Project (PDF)</span>
                            <span class="ats-lang-id">Portofolio Panel ATS (PDF)</span>
                        </a>
                        <a href="#certificates" class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                            <span class="ats-lang-en">Certificates &darr;</span>
                            <span class="ats-lang-id">Sertifikat Resmi &darr;</span>
                        </a>
                    </div>

                </div>

                <!-- RIGHT COLUMN: 2x2 Rounded Cards Grid -->
                <div class="lg:col-span-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">

                        <!-- Card 1 (Top Left): Deep Navy Accent Card -->
                        <div class="group relative bg-[#001D34] rounded-[2rem] p-7 sm:p-8 text-white shadow-xl shadow-slate-900/10 border border-slate-800 flex flex-col justify-between min-h-[220px] sm:min-h-[250px] transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:border-slate-700 overflow-hidden">
                            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-rose-600/20 rounded-full blur-2xl group-hover:scale-125 transition duration-500"></div>

                            <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/15 flex items-center justify-center text-emerald-400 group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                            </div>

                            <div class="relative z-10 mt-6">
                                <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-600/90 text-white mb-2">
                                    <span class="ats-lang-en">OFFICIAL &amp; CERTIFIED</span>
                                    <span class="ats-lang-id">RESMI &amp; BERSERTIFIKAT</span>
                                </span>
                                <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight leading-snug">
                                    <span class="ats-lang-en">Authorized Distributor</span>
                                    <span class="ats-lang-id">Distributor Resmi</span>
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                    <span class="ats-lang-en">Direct certified partnership for Schneider Electric, Legrand, GAE, &amp; Socomec.</span>
                                    <span class="ats-lang-id">Kemitraan distributor resmi langsung untuk Schneider Electric, Legrand, GAE, &amp; Socomec.</span>
                                </p>
                            </div>
                        </div>

                        <!-- Card 2 (Top Right): Intelligent Card -->
                        <div class="group bg-white rounded-[2rem] p-7 sm:p-8 shadow-sm border border-slate-200/90 flex flex-col justify-between min-h-[220px] sm:min-h-[250px] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-rose-300">
                            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                    <span class="ats-lang-en">Intelligent</span>
                                    <span class="ats-lang-id">Teknologi Pintar</span>
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                                    <span class="ats-lang-en">Integrated smart tech, digital power metering, and modern automation controls for optimal energy efficiency.</span>
                                    <span class="ats-lang-id">Integrasi teknologi cerdas, power meter digital, dan sistem kontrol otomasi modern untuk efisiensi energi maksimal.</span>
                                </p>
                            </div>
                        </div>

                        <!-- Card 3 (Bottom Left): Safety Card -->
                        <div class="group bg-white rounded-[2rem] p-7 sm:p-8 shadow-sm border border-slate-200/90 flex flex-col justify-between min-h-[220px] sm:min-h-[250px] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-rose-300">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                    <span class="ats-lang-en">Safety</span>
                                    <span class="ats-lang-id">Standar Keselamatan</span>
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                                    <span class="ats-lang-en">Zero-compromise adherence to IEC and SNI electrical safety standards to protect mission-critical operations.</span>
                                    <span class="ats-lang-id">Kepatuhan tanpa kompromi terhadap standar keselamatan listrik IEC dan SNI untuk melindungi operasi kritikal.</span>
                                </p>
                            </div>
                        </div>

                        <!-- Card 4 (Bottom Right): 24/7 Professional Support Card -->
                        <div class="group bg-white rounded-[2rem] p-7 sm:p-8 shadow-sm border border-slate-200/90 flex flex-col justify-between min-h-[220px] sm:min-h-[250px] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-rose-300">
                            <div>
                                <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight group-hover:text-rose-600 transition">
                                    24/7
                                </div>
                                <div class="text-[11px] sm:text-xs font-black text-slate-400 tracking-wider uppercase mt-1">
                                    <span class="ats-lang-en">PROFESSIONAL SUPPORT</span>
                                    <span class="ats-lang-id">DUKUNGAN PROFESIONAL</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    <span class="ats-lang-en">Rapid quotation turnaround, experienced engineering consultations, and strategic Surabaya warehouse readiness.</span>
                                    <span class="ats-lang-id">Respon penawaran cepat, konsultasi teknik berpengalaman, serta kesiapan stok gudang strategis di Surabaya.</span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================
         OFFICIAL CERTIFICATES & ACCREDITATIONS SECTION (NEW)
         "tambahkan sertifikat sertifikat di page about us"
         ======================================================== -->
    <section class="py-16 sm:py-24 bg-slate-50 border-b border-slate-200/80" id="certificates">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-black tracking-widest uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                    OFFICIAL ACCREDITATIONS & LICENSES
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Official Manufacturer Certificates & Authorizations
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                    PT. Anugerah Tama Sejati holds certified distributor appointments directly from global principals, guaranteeing 100% genuine origin, valid warranties, and full compliance with international electrical standards.
                </p>
            </div>

            <!-- Certificates Dynamic Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                @forelse($certificates as $cert)
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group h-full">
                    <div>
                        <!-- Certificate Image Preview Box (Adaptive Aspect Ratio: Landscape vs Portrait) -->
                        <div class="relative bg-slate-100/90 rounded-2xl overflow-hidden mb-6 {{ $cert->is_landscape ? 'aspect-[4/3] sm:aspect-[1.42/1]' : 'aspect-[3/4]' }} border border-slate-200/80 cursor-pointer group-hover:border-emerald-400 transition flex items-center justify-center"
                             onclick="openCertModal('{{ $cert->image_url }}', '{{ addslashes($cert->title) }}', '{{ addslashes($cert->description ?? $cert->partner_name) }}')">
                            <img src="{{ $cert->image_url }}"
                                 alt="{{ $cert->title }}"
                                 class="w-full h-full object-contain p-2 transition duration-500 group-hover:scale-105 drop-shadow-xs">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <span class="px-4 py-2 rounded-xl bg-white text-slate-900 font-bold text-xs shadow-lg flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                    <span class="ats-lang-en">Click to View Full</span>
                                    <span class="ats-lang-id">Klik untuk Perbesar</span>
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 bg-emerald-600 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow">
                                {{ $cert->badge_text ?? 'VERIFIED PARTNER' }}
                            </div>
                        </div>

                        <!-- Certificate Info -->
                        <span class="inline-block text-[11px] font-black uppercase tracking-wider text-emerald-600 mb-1">
                            {{ $cert->partner_name }}
                        </span>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight leading-snug">
                            {{ $cert->title }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                            {{ $cert->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Direct Manufacturer License
                        </span>
                        <button type="button"
                                onclick="openCertModal('{{ $cert->image_url }}', '{{ addslashes($cert->title) }}', '{{ addslashes($cert->description ?? $cert->partner_name) }}')"
                                class="text-xs font-bold text-rose-600 hover:text-rose-700 transition">
                            View Full &rarr;
                        </button>
                    </div>
                </div>
                @empty
                <!-- Fallback Certificate 1: Schneider Electric -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group h-full">
                    <div>
                        <div class="relative bg-slate-100/90 rounded-2xl overflow-hidden mb-6 aspect-[4/3] sm:aspect-[1.42/1] border border-slate-200/80 cursor-pointer group-hover:border-emerald-400 transition flex items-center justify-center"
                             onclick="openCertModal('{{ asset('certificates/cert-schneider.webp') }}', 'Schneider Electric Authorized Partner Certificate', 'Official Distributor License for Low Voltage Electrical Components & Industrial Systems.')">
                            <img src="{{ asset('certificates/cert-schneider.webp') }}" alt="Schneider Electric Certificate" class="w-full h-full object-contain p-2 transition duration-500 group-hover:scale-105 drop-shadow-xs">
                            <div class="absolute top-3 right-3 bg-emerald-600 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow">
                                VERIFIED PARTNER
                            </div>
                        </div>
                        <span class="inline-block text-[11px] font-black uppercase tracking-wider text-emerald-600 mb-1">SCHNEIDER ELECTRIC</span>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight leading-snug">Authorized Distributor Certificate</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">Official certification authorizing PT. Anugerah Tama Sejati as an official distributor for Schneider Electric low-voltage distribution, automation, and industrial control components.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Trust Badges Bar -->
            <div class="mt-12 bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/90 shadow-xs grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                <div class="flex items-center justify-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="text-left">
                        <h4 class="text-sm font-bold text-slate-900">IEC 61439 Standard</h4>
                        <p class="text-xs text-slate-500">
                            <span class="ats-lang-en">Low-voltage switchgear safety compliance</span>
                            <span class="ats-lang-id">Standar keselamatan panel listrik tegangan rendah</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 border-t sm:border-t-0 sm:border-l border-slate-100 pt-4 sm:pt-0 sm:pl-6">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="text-left">
                        <h4 class="text-sm font-bold text-slate-900">SNI &amp; SPLN Certified</h4>
                        <p class="text-xs text-slate-500">
                            <span class="ats-lang-en">Indonesian National Standard compliance</span>
                            <span class="ats-lang-id">Kepatuhan Standar Nasional Indonesia</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 border-t sm:border-t-0 sm:border-l border-slate-100 pt-4 sm:pt-0 sm:pl-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div class="text-left">
                        <h4 class="text-sm font-bold text-slate-900">
                            <span class="ats-lang-en">Direct Principal Warranty</span>
                            <span class="ats-lang-id">Garansi Resmi Prinsipal</span>
                        </h4>
                        <p class="text-xs text-slate-500">
                            <span class="ats-lang-en">100% genuine guaranteed with COO &amp; COC</span>
                            <span class="ats-lang-id">Jaminan 100% original dengan COO &amp; COC</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================
         OFFICIAL CORPORATE & ENGINEERING PUBLICATIONS (CLEAN & MINIMALIST LIKE PHOTO 4)
         Simple, white background, no excessive colors or heavy decorations
         ======================================================== -->
    <section class="py-16 sm:py-20 bg-white border-b border-slate-200/80" id="company-profile">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ================= DOCUMENT 1: OUR COMPANY PROFILE ================= -->
            @php
                $comproThumb = !empty($settings['company_profile_thumbnail']) ? $settings['company_profile_thumbnail'] : asset('images/documents/compro-cover.webp');
                $comproPdf   = !empty($settings['company_profile_pdf']) ? $settings['company_profile_pdf'] : asset('documents/ATS_Company_Profile.pdf');
                $comproDrive = $settings['company_profile_drive_url'] ?? null;
                $comproTitle = $settings['company_profile_title'] ?? 'Official Corporate Profile PT. Anugerah Tama Sejati';
                $comproDesc  = $settings['company_profile_description'] ?? 'PT. Anugerah Tama Sejati berpusat di Surabaya, Jawa Timur, Indonesia. Perusahaan kami bergerak di bidang pengadaan peralatan listrik khususnya untuk industri. Kami juga memberikan solusi dan pelayanan yang terbaik bagi semua pelanggan kami dalam bidang Industri, Building, OEM, Kontraktor ME, dan Panel Maker. Perusahaan kami didirikan sejak 1 Agustus 2019 dengan satu konsep yaitu memenuhi semua kebutuhan listrik bagi masyarakat Indonesia.';
            @endphp

            <div class="mb-14">
                <div class="text-center sm:text-left mb-6">
                    <div class="text-xs sm:text-sm font-medium tracking-wide text-slate-500 mb-1">
                        <span class="ats-lang-en">Indonesia</span>
                        <span class="ats-lang-id">Indonesia</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        <span class="ats-lang-en">OUR COMPANY PROFILE</span>
                        <span class="ats-lang-id">OUR COMPANY PROFILE</span>
                    </h2>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 lg:gap-12">
                    <!-- Left: Clean Cover Image Mockup -->
                    <div class="w-48 sm:w-56 md:w-60 shrink-0">
                        <div class="rounded-lg overflow-hidden border border-slate-200 shadow-md bg-white hover:shadow-lg transition cursor-pointer"
                             onclick="openCertModal('{{ $comproThumb }}', '{{ addslashes($comproTitle) }}', 'Official Company Profile Cover')">
                            <img src="{{ $comproThumb }}"
                                 alt="{{ $comproTitle }}"
                                 class="w-full h-auto object-contain">
                        </div>
                    </div>

                    <!-- Right: Content & Download Button -->
                    <div class="flex-1 space-y-5 text-center sm:text-left">
                        <p class="ats-lang-block-id text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                            {{ $settings['company_profile_description_id'] ?? 'PT. Anugerah Tama Sejati berpusat di Surabaya, Jawa Timur, Indonesia. Perusahaan kami bergerak di bidang pengadaan peralatan listrik khususnya untuk industri. Kami juga memberikan solusi dan pelayanan yang terbaik bagi semua pelanggan kami dalam bidang Industri, Building, OEM, Kontraktor ME, dan Panel Maker. Perusahaan kami didirikan sejak 1 Agustus 2019 dengan satu konsep yaitu memenuhi semua kebutuhan listrik bagi masyarakat Indonesia.' }}
                        </p>
                        <p class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                            {{ $settings['company_profile_description_en'] ?? 'PT. Anugerah Tama Sejati is headquartered in Surabaya, East Java, Indonesia. Our company specializes in the procurement of electrical equipment specifically for industrial applications. We also provide the best solutions and services for all our clients across Industry, Building, OEM, ME Contractors, and Panel Makers. Established on August 1, 2019, our core concept is fulfilling all electrical needs across Indonesia.' }}
                        </p>

                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                            <a href="{{ $comproPdf }}"
                               target="_blank"
                               download
                               class="inline-flex items-center gap-2 px-6 py-2.5 rounded bg-[#E11D48] hover:bg-[#BE123C] text-white font-medium text-sm shadow-xs transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span class="ats-lang-en">Download</span>
                                <span class="ats-lang-id">Download</span>
                            </a>

                            @if(!empty($comproDrive))
                            <a href="{{ $comproDrive }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium text-sm transition">
                                <svg class="w-4 h-4 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
                                <span>Google Drive</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subtle Horizontal Divider -->
            <div class="border-t border-slate-200/80 my-12 sm:my-16"></div>

            <!-- ================= DOCUMENT 2: ATS PANEL MAKER & PROJECT REFERENCE ================= -->
            @php
                $panelThumb = !empty($settings['panel_project_doc_thumbnail']) ? $settings['panel_project_doc_thumbnail'] : asset('images/documents/panel-project-cover.webp');
                $panelPdf   = !empty($settings['panel_project_doc_pdf']) ? $settings['panel_project_doc_pdf'] : asset('documents/ATS_Panel_Project_Reference.pdf');
                $panelDrive = $settings['panel_project_doc_drive_url'] ?? null;
                $panelTitle = $settings['panel_project_doc_title'] ?? 'ATS Panel Maker & Engineering Project Reference';
            @endphp

            <div id="panel-project-doc">
                <div class="text-center sm:text-left mb-6">
                    <div class="text-xs sm:text-sm font-medium tracking-wide text-slate-500 mb-1">
                        <span class="ats-lang-en">Engineering</span>
                        <span class="ats-lang-id">Engineering</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        <span class="ats-lang-en">ATS PANEL MAKER &amp; PROJECT REFERENCE</span>
                        <span class="ats-lang-id">ATS PANEL MAKER &amp; PROJECT REFERENCE</span>
                    </h2>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 lg:gap-12">
                    <!-- Left: Clean Cover Image Mockup -->
                    <div class="w-48 sm:w-56 md:w-60 shrink-0">
                        <div class="rounded-lg overflow-hidden border border-slate-200 shadow-md bg-white hover:shadow-lg transition cursor-pointer"
                             onclick="openCertModal('{{ $panelThumb }}', '{{ addslashes($panelTitle) }}', 'ATS Panel Project Reference Booklet')">
                            <img src="{{ $panelThumb }}"
                                 alt="{{ $panelTitle }}"
                                 class="w-full h-auto object-contain">
                        </div>
                    </div>

                    <!-- Right: Content & Download Button -->
                    <div class="flex-1 space-y-5 text-center sm:text-left">
                        <p class="ats-lang-block-id text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                            {{ $settings['panel_project_doc_description_id'] ?? 'Divisi ATS Panel Maker memproduksi dan merakit panel listrik tegangan rendah berkualitas tinggi (LVMDP, MCC, Capacitor Bank, Synchronizing Panel, dan ATS-AMF) dengan standar IEC 61439 dan SNI. Kami menyediakan dokumentasi lengkap, diagram pengkabelan terperinci, dan laporan uji FAT untuk memastikan keandalan, keamanan, dan efisiensi operasional sistem kelistrikan fasilitas industri Anda.' }}
                        </p>
                        <p class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                            {{ $settings['panel_project_doc_description_en'] ?? 'The ATS Panel Maker division manufactures and custom-assembles high-quality low-voltage switchboards (LVMDP, MCC, Capacitor Banks, Synchronizing Panels, and ATS-AMF) compliant with IEC 61439 and SNI standards. We provide comprehensive engineering documentation, detailed wiring schematics, and factory acceptance test (FAT) reports to guarantee operational reliability, safety, and energy efficiency for your facility.' }}
                        </p>

                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                            <a href="{{ $panelPdf }}"
                               target="_blank"
                               download
                               class="inline-flex items-center gap-2 px-6 py-2.5 rounded bg-[#E11D48] hover:bg-[#BE123C] text-white font-medium text-sm shadow-xs transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span class="ats-lang-en">Download</span>
                                <span class="ats-lang-id">Download</span>
                            </a>

                            @if(!empty($panelDrive))
                            <a href="{{ $panelDrive }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium text-sm transition">
                                <svg class="w-4 h-4 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
                                <span>Google Drive</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================
         CLIENT CONFIDENCE & REASONS TO CHOOSE ATS
         ======================================================== -->
    <section class="py-16 sm:py-24 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-widest uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                    <span class="ats-lang-en">INDUSTRIAL INTEGRITY STANDARD</span>
                    <span class="ats-lang-id">STANDAR INTEGRITAS INDUSTRI</span>
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    <span class="ats-lang-en">Why Industry Leaders Entrust Their Projects to PT. Anugerah Tama Sejati</span>
                    <span class="ats-lang-id">Mengapa Pemimpin Industri Mempercayakan Proyeknya Kepada PT. ATS</span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                    <span class="ats-lang-en">We support prominent EPC contractors, certified panel builders, and large-scale manufacturing facilities with supply certainty, verified authenticity, and engineering precision.</span>
                    <span class="ats-lang-id">Kami mendukung kontraktor EPC terkemuka, perakit panel bersertifikat, dan fasilitas manufaktur skala besar dengan kepastian pasokan, keaslian terverifikasi, dan presisi teknis.</span>
                </p>
            </div>

            <!-- 4 Core Pillars Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Pillar 1 -->
                <div class="bg-slate-50/80 rounded-3xl p-7 border border-slate-200/80 hover:bg-white hover:border-rose-300 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100/70 text-rose-600 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">
                        <span class="ats-lang-en">100% Genuine Guaranteed</span>
                        <span class="ats-lang-id">Jaminan 100% Original</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                        <span class="ats-lang-en">All electrical components are supplied directly from official principals, complete with Certificate of Origin (COO), Certificate of Conformity (COC), and factory warranty.</span>
                        <span class="ats-lang-id">Semua komponen elektrikal disuplai langsung dari prinsipal resmi, lengkap dengan Certificate of Origin (COO), Certificate of Conformity (COC), dan garansi pabrikan.</span>
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="bg-slate-50/80 rounded-3xl p-7 border border-slate-200/80 hover:bg-white hover:border-rose-300 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100/70 text-rose-600 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">
                        <span class="ats-lang-en">Industrial Ready Stock Hub</span>
                        <span class="ats-lang-id">Pusat Ready Stock Komponen</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                        <span class="ats-lang-en">Extensive inventory of circuit breakers (ACB, MCCB, MCB), Altivar VFD inverters, TeSys contactors, and IP66 enclosures to keep your project downtime at zero.</span>
                        <span class="ats-lang-id">Persediaan lengkap pemutus sirkuit (ACB, MCCB, MCB), inverter Altivar VFD, kontaktor TeSys, dan box enclosure IP66 untuk meminimalkan downtime proyek Anda.</span>
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="bg-slate-50/80 rounded-3xl p-7 border border-slate-200/80 hover:bg-white hover:border-rose-300 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100/70 text-rose-600 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">
                        <span class="ats-lang-en">Experienced Engineering Support</span>
                        <span class="ats-lang-id">Dukungan Teknisi Berpengalaman</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                        <span class="ats-lang-en">Dedicated engineering consultation for power sizing, protection selectivity calculation, and technically compliant product substitutions.</span>
                        <span class="ats-lang-id">Konsultasi rekayasa teknis khusus untuk perhitungan kapasitas daya, selektivitas proteksi, dan rekomendasi substitusi produk yang sesuai standar.</span>
                    </p>
                </div>

                <!-- Pillar 4 -->
                <div class="bg-slate-50/80 rounded-3xl p-7 border border-slate-200/80 hover:bg-white hover:border-rose-300 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100/70 text-rose-600 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">
                        <span class="ats-lang-en">Support Letters &amp; Official Tax Invoices</span>
                        <span class="ats-lang-id">Surat Dukungan &amp; Faktur Pajak Resmi</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                        <span class="ats-lang-en">Issuance of official Project Support Letters for industrial procurement tenders, verified VAT administration (Faktur Pajak PPN), and transparent legal transactions.</span>
                        <span class="ats-lang-id">Penerbitan Surat Dukungan Proyek resmi untuk tender pengadaan industri, administrasi Faktur Pajak PPN yang valid, dan transaksi legal yang transparan.</span>
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================
         VISION & MISSION (CORPORATE VALUES)
         EXACT CONTENT SPECIFIED BY USER
         ======================================================== -->
    <section class="py-16 sm:py-20 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">

                <!-- Vision Card -->
                <div class="bg-gradient-to-br from-slate-900 to-[#001D34] text-white p-8 sm:p-10 rounded-[2rem] shadow-xl relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute -top-12 -right-12 w-48 h-48 bg-rose-600/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 flex items-center justify-center text-white mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest text-rose-400">
                            <span class="ats-lang-en">STRATEGIC VISION</span>
                            <span class="ats-lang-id">VISI STRATEGIS</span>
                        </span>
                        <h3 class="text-2xl font-black tracking-tight mt-1 text-white">VISI</h3>
                        <!-- DYNAMIC OR FALLBACK TO EXACT TEXT REQUESTED BY USER -->
                        <div class="ats-lang-block-en text-base sm:text-lg text-slate-200 mt-5 leading-relaxed font-normal">
                            {{ $settings['company_vision'] ?? $page->sections_data['vision'] ?? 'PT. Anugerah Tama Sejati is a creative, innovative, trusted and to be a mainstay for our customer. And to become a healthy and growing company for our employees.' }}
                        </div>
                        <div class="ats-lang-block-id text-base sm:text-lg text-slate-200 mt-5 leading-relaxed font-normal">
                            {{ $settings['company_vision_id'] ?? 'PT. Anugerah Tama Sejati menjadi perusahaan yang kreatif, inovatif, terpercaya dan menjadi andalan bagi pelanggan kami. Serta menjadi perusahaan yang sehat dan berkembang bagi karyawan kami.' }}
                        </div>
                    </div>

                    <div class="relative z-10 mt-8 pt-6 border-t border-white/10 flex items-center gap-3 text-xs text-slate-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="ats-lang-en">Sustainable Commitment &amp; Trust Standard</span>
                        <span class="ats-lang-id">Komitmen Berkelanjutan &amp; Standar Kepercayaan</span>
                    </div>
                </div>

                <!-- Mission Card -->
                <div class="bg-slate-50 border border-slate-200/90 p-8 sm:p-10 rounded-[2rem] shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest text-rose-600">
                            <span class="ats-lang-en">OPERATIONAL MISSION</span>
                            <span class="ats-lang-id">MISI OPERASIONAL</span>
                        </span>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight mt-1">MISI</h3>
                        <!-- DYNAMIC OR FALLBACK TO EXACT TEXT REQUESTED BY USER -->
                        <div class="ats-lang-block-en text-base sm:text-lg text-slate-700 mt-5 leading-relaxed font-normal">
                            {{ $settings['company_mission'] ?? $page->sections_data['mission'] ?? 'PT Anugerah Tama Sejati is committed in providing the best service with professionalism in giving solutions to fulfill our customer’s needs.' }}
                        </div>
                        <div class="ats-lang-block-id text-base sm:text-lg text-slate-700 mt-5 leading-relaxed font-normal">
                            {{ $settings['company_mission_id'] ?? 'PT Anugerah Tama Sejati berkomitmen dalam memberikan pelayanan terbaik secara profesional dalam memberikan solusi untuk memenuhi kebutuhan pelanggan kami.' }}
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-200 flex items-center gap-3 text-xs text-slate-500 font-semibold">
                        <svg class="w-4 h-4 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="ats-lang-en">Professionalism, Customer Solutions, &amp; Engineering Service</span>
                        <span class="ats-lang-id">Profesionalisme, Solusi Pelanggan, &amp; Layanan Rekayasa</span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================
         AUTHORITY BRAND PRINCIPALS SHOWCASE
         Using logos from C:\Users\itpta\atstekno\public\logos
         Exact 2-row layout matching user Photo 1
         ======================================================== -->
    @if(isset($brands) && $brands->isNotEmpty())
    <section class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-black uppercase tracking-widest text-rose-600">
                    <span class="ats-lang-en">GLOBAL PRINCIPAL NETWORK</span>
                    <span class="ats-lang-id">JARINGAN PRINSIPAL GLOBAL</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">
                    <span class="ats-lang-en">Authorized Electrical Brand Partners</span>
                    <span class="ats-lang-id">Mitra Brand Elektrikal Resmi</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-2">
                    <span class="ats-lang-en">We distribute genuine parts backed by direct factory warranties from the world’s leading manufacturers.</span>
                    <span class="ats-lang-id">Kami mendistribusikan komponen original yang didukung garansi resmi pabrikan dari produsen terkemuka dunia.</span>
                </p>
            </div>

            <!-- Brands Grid: 6 columns across large screens matching Photo 1 -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($brands as $b)
                <a href="{{ route('price-list.show', $b->slug) }}" class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 shadow-xs hover:shadow-md transition flex items-center justify-center h-24 group">
                    @if($b->logo_url)
                        <img src="{{ $b->logo_url }}" alt="{{ $b->name }}" class="max-h-12 max-w-[85%] object-contain group-hover:scale-105 transition duration-300">
                    @else
                        <span class="text-xs font-black text-slate-700 tracking-tight group-hover:text-rose-600 transition">{{ $b->name }}</span>
                    @endif
                </a>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    <!-- ========================================================
         CALL TO ACTION: ENGAGE WITH TECHNICAL SALES TEAM
         ======================================================== -->
    <section class="pt-16 pb-6 sm:pt-20 sm:pb-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-slate-900 via-[#001D34] to-slate-900 rounded-[2.5rem] p-8 sm:p-12 lg:p-16 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-rose-600/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-3xl">
                    <span class="inline-block px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-rose-600 text-white mb-4">
                        <span class="ats-lang-en">FREE PROJECT CONSULTATION</span>
                        <span class="ats-lang-id">KONSULTASI PROYEK GRATIS</span>
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight leading-tight">
                        <span class="ats-lang-en">Ready to Optimize Your Facility’s Electrical Reliability?</span>
                        <span class="ats-lang-id">Siap Mengoptimalkan Keandalan Elektrikal Fasilitas Anda?</span>
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-4 leading-relaxed max-w-2xl">
                        <span class="ats-lang-en">Connect directly with our Sales Engineering specialists for Bill of Quantities (BoQ) reviews, breaker sizing assistance, warehouse stock verification, and prompt official quotations.</span>
                        <span class="ats-lang-id">Hubungi langsung spesialis Sales Engineering kami untuk peninjauan Bill of Quantities (BoQ), pemilihan kapasitas breaker, verifikasi ketersediaan stok gudang, dan penawaran resmi yang cepat.</span>
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="https://wa.me/6282223332830?text=Hello%20PT%20Anugerah%20Tama%20Sejati,%20I%20would%20like%20to%20inquire%20about%20electrical%20components%20for%20our%20industrial%20project"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm tracking-wide shadow-lg shadow-emerald-900/30 transition-all hover:scale-105">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span class="ats-lang-en">Contact Sales Engineer (WhatsApp)</span>
                            <span class="ats-lang-id">Hubungi Sales Engineer (WhatsApp)</span>
                        </a>

                        <a href="{{ route('price-list.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-sm tracking-wide border border-white/20 transition-all">
                            <span class="ats-lang-en">Browse Price List &amp; Catalogs &rarr;</span>
                            <span class="ats-lang-id">Lihat Daftar Harga &amp; Katalog &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $aboutFaqs = [
            [
                'q_id' => 'Apakah PT. Anugerah Tama Sejati (ATS Tekno) distributor resmi Schneider Electric?',
                'q_en' => 'Is PT. Anugerah Tama Sejati (ATS Tekno) an official Schneider Electric distributor?',
                'a_id' => 'Ya, PT. Anugerah Tama Sejati adalah Authorized Dealer resmi Schneider Electric di Surabaya, Jawa Timur, beroperasi sejak 2019 dengan sertifikasi resmi, menyediakan garansi 100% original serta fabrikasi panel listrik standar industri.',
                'a_en' => 'Yes, PT. Anugerah Tama Sejati is an official Authorized Dealer for Schneider Electric, headquartered in Surabaya, East Java, operating since 2019 with verified certification, supplying 100% genuine components and certified switchboard panels.'
            ],
            [
                'q_id' => 'Brand apa saja yang didistribusikan resmi oleh PT. Anugerah Tama Sejati?',
                'q_en' => 'Which official brands does PT. Anugerah Tama Sejati distribute?',
                'a_id' => 'PT. ATS adalah distributor resmi untuk Schneider Electric, GAE Group, Legrand Indonesia, Socomec, Autonics, dan Himel, serta mendistribusikan kabel berkualitas seperti Jembo Cable dan Supreme Cable (SUCACO).',
                'a_en' => 'PT. ATS officially distributes Schneider Electric, GAE Group, Legrand, Socomec, Autonics, and Himel, alongside leading cable brands such as Jembo Cable and Supreme Cable.'
            ],
            [
                'q_id' => 'Di mana lokasi showroom dan kantor PT. Anugerah Tama Sejati?',
                'q_en' => 'Where are ATS Tekno headquarters and showrooms located?',
                'a_id' => 'Kantor pusat berlokasi di Ruko Galaxi Bumi Permai J-1 No. 23 Surabaya, didukung Showroom Jagalan di Jl. Jagalan No. 38 Surabaya dan Showroom Pandaan di The Taman Dayu, Pasuruan.',
                'a_en' => 'Our headquarters is located at Ruko Galaxi Bumi Permai J-1 No. 23 Surabaya, complemented by our Jagalan Showroom at Jl. Jagalan No. 38 Surabaya and Pandaan Showroom at The Taman Dayu, Pasuruan.'
            ],
            [
                'q_id' => 'Apakah PT. ATS melayani pengadaan proyek dengan faktur pajak PPN 11%?',
                'q_en' => 'Does PT. ATS provide official tax invoices (Faktur Pajak PPN 11%) for corporate procurement?',
                'a_id' => 'Ya, seluruh transaksi pengadaan B2B dan proyek industri diterbitkan faktur pajak PPN resmi 11% serta sertifikat keaslian produk (Certificate of Origin / Warranty).',
                'a_en' => 'Yes, all B2B transactions and corporate procurement include official 11% VAT tax invoices (Faktur Pajak) and manufacturer warranty certificates.'
            ]
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <x-faq-accordion :faqs="$aboutFaqs" />
    </div>

</div>

<!-- ========================================================
     CERTIFICATE ZOOM LIGHTBOX MODAL
     ======================================================== -->
<div id="certModal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm hidden items-center justify-center p-4 sm:p-6">
    <div class="relative bg-white rounded-3xl max-w-5xl w-full max-h-[94vh] overflow-hidden shadow-2xl flex flex-col animate-in fade-in zoom-in-95 duration-200">
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div>
                <h3 id="certModalTitle" class="text-base sm:text-lg font-black text-slate-900 leading-tight">
                    <span class="ats-lang-en">Certificate Details</span>
                    <span class="ats-lang-id">Detail Sertifikat</span>
                </h3>
                <p id="certModalDesc" class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    <span class="ats-lang-en">Official Accreditation License</span>
                    <span class="ats-lang-id">Lisensi Akreditasi Resmi</span>
                </p>
            </div>
            <button type="button" onclick="closeCertModal()" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-700 flex items-center justify-center transition" aria-label="Close">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <!-- Modal Body (Certificate Image) -->
        <div class="p-4 sm:p-8 overflow-y-auto flex items-center justify-center bg-slate-900/5 min-h-[50vh]">
            <img id="certModalImg" src="" alt="Certificate" class="max-h-[72vh] w-auto max-w-full object-contain rounded-xl shadow-lg border border-slate-200/80 bg-white">
        </div>
        <!-- Modal Footer -->
        <div class="px-6 py-3.5 border-t border-slate-200 bg-white flex items-center justify-between">
            <span class="text-xs font-bold text-emerald-600 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span class="ats-lang-en">Authenticity Verified</span>
                <span class="ats-lang-id">Keaslian Terverifikasi</span>
            </span>
            <button type="button" onclick="closeCertModal()" class="px-5 py-2 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition">
                <span class="ats-lang-en">Close Preview</span>
                <span class="ats-lang-id">Tutup Pratinjau</span>
            </button>
        </div>
    </div>
</div>

<script>
function openCertModal(imageSrc, title, desc) {
    const modal = document.getElementById('certModal');
    const modalImg = document.getElementById('certModalImg');
    const modalTitle = document.getElementById('certModalTitle');
    const modalDesc = document.getElementById('certModalDesc');

    modalImg.src = imageSrc;
    modalTitle.textContent = title;
    modalDesc.textContent = desc;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeCertModal() {
    const modal = document.getElementById('certModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

// Close on backdrop click or ESC key
document.getElementById('certModal').addEventListener('click', function(e) {
    if (e.target === this) closeCertModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeCertModal();
});
</script>
@endsection
