@extends('layouts.app')

@section('title', 'Hubungi Kami & Kantor Resmi - PT. Anugerah Tama Sejati')
@section('meta_description', 'Hubungi tim sales engineer PT. Anugerah Tama Sejati di Surabaya untuk konsultasi komponen elektrikal industri, panel listrik, dan permintaan penawaran harga (BoQ).')

@section('content')
<!-- ================= PAGE HERO HEADER ================= -->
<div class="relative bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-14 sm:py-20 overflow-hidden">
    <!-- Subtle Ambient Glow -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-600/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span class="text-slate-600">&rsaquo;</span>
            <span class="text-rose-400 font-semibold">
                <span class="ats-lang-en">Contact &amp; Locations</span><span class="ats-lang-id">Kontak &amp; Lokasi</span>
            </span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-500/15 text-rose-300 border border-rose-500/30 backdrop-blur-xs mb-4">
                    <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                    <span class="ats-lang-en">Official Engineering &amp; Sales Support</span>
                    <span class="ats-lang-id">Layanan Resmi Engineering &amp; Penjualan</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    <span class="ats-lang-en">Get in Touch with Us</span>
                    <span class="ats-lang-id">Hubungi Tim Kami</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-300 mt-3 max-w-2xl leading-relaxed">
                    <span class="ats-lang-en">Consult your industrial electrical requirements, request official Bill of Quantities (BoQ) estimates, or verify stock availability with our technical sales engineers in Surabaya.</span>
                    <span class="ats-lang-id">Konsultasikan kebutuhan elektrikal industri Anda, minta estimasi penawaran resmi Bill of Quantities (BoQ), atau verifikasi ketersediaan stok bersama sales engineer kami di Surabaya.</span>
                </p>
            </div>

            <!-- Fast Response Badge -->
            <div class="shrink-0 flex items-center gap-3.5 bg-white/10 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/15">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-slate-300 font-medium">
                        <span class="ats-lang-en">Average Response Time</span>
                        <span class="ats-lang-id">Kecepatan Respon</span>
                    </div>
                    <div class="text-sm font-bold text-white flex items-center gap-1.5">
                        <span class="ats-lang-en">&lt; 2 Business Hours</span>
                        <span class="ats-lang-id">&lt; 2 Jam Kerja</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-500/30 text-emerald-300 font-semibold">Fast</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MAIN CONTENT SECTION ================= -->
<div class="bg-slate-50/70 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- 2-COLUMN GRID: FORM & CONTACT CHANNELS -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">

            <!-- ================= LEFT COLUMN: INQUIRY & BoQ FORM (7 cols) ================= -->
            <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/90 shadow-sm p-7 sm:p-10 relative overflow-hidden flex flex-col justify-between">
                <!-- Top Rose Accent Line -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-rose-500 via-rose-600 to-red-500"></div>

                <div>
                    <div class="flex items-start justify-between gap-4 mb-2">
                        <div>
                            <div class="inline-flex items-center gap-2 text-xs font-bold text-rose-600 uppercase tracking-wider mb-1">
                                <svg class="w-4 h-4 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10 9 9 9 8 9"/>
                                </svg>
                                <span class="ats-lang-en">Direct Procurement Inquiry</span>
                                <span class="ats-lang-id">Formulir Permintaan Penawaran</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                                <span class="ats-lang-en">Send a Message or BoQ Request</span>
                                <span class="ats-lang-id">Kirim Pesan atau Permintaan BoQ</span>
                            </h2>
                        </div>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-500 mb-6 leading-relaxed">
                        <span class="ats-lang-en">Fill in your specifications or paste your component requirements below. Our technical sales team will review and contact you with a formal quotation.</span>
                        <span class="ats-lang-id">Isi spesifikasi kebutuhan Anda di bawah ini. Tim sales engineer kami akan meninjau dan mengirimkan penawaran harga resmi (BoQ).</span>
                    </p>

                    <!-- Success Banner -->
                    @if(session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-emerald-800">
                                <span class="ats-lang-en">Sent Successfully!</span>
                                <span class="ats-lang-id">Berhasil Terkirim!</span>
                            </div>
                            <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Validation Errors Banner -->
                    @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <div class="font-bold text-rose-800">
                                <span class="ats-lang-en">Please check the form inputs:</span>
                                <span class="ats-lang-id">Mohon periksa kembali isian formulir:</span>
                            </div>
                            @foreach($errors->all() as $err)
                                <p>&bull; {{ $err }}</p>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Quick Requirement Preset Chips -->
                    <div class="mb-5">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">
                            <span class="ats-lang-en">Quick Select Requirement:</span>
                            <span class="ats-lang-id">Pilihan Cepat Kebutuhan:</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="setSubjectPreset('Permintaan Penawaran BoQ Breaker & Contactor Schneider')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-700 border border-slate-200 transition cursor-pointer">
                                <span class="ats-lang-en">Schneider Breaker / BoQ</span>
                                <span class="ats-lang-id">Schneider Breaker / BoQ</span>
                            </button>
                            <button type="button" onclick="setSubjectPreset('Konsultasi Komponen Panel Listrik & ATS')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-700 border border-slate-200 transition cursor-pointer">
                                <span class="ats-lang-en">Switchboard Components</span>
                                <span class="ats-lang-id">Komponen Panel Listrik</span>
                            </button>
                            <button type="button" onclick="setSubjectPreset('Cek Ketersediaan Stok & Harga Grosir')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-700 border border-slate-200 transition cursor-pointer">
                                <span class="ats-lang-en">Stock &amp; Wholesale Price</span>
                                <span class="ats-lang-id">Cek Stok &amp; Harga Grosir</span>
                            </button>
                            <button type="button" onclick="setSubjectPreset('Permintaan Katalog & Brosur Teknis Produk')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-700 border border-slate-200 transition cursor-pointer">
                                <span class="ats-lang-en">Catalogs &amp; Datasheets</span>
                                <span class="ats-lang-id">Katalog &amp; Spesifikasi</span>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Honeypot Field -->
                        <div class="hidden" aria-hidden="true">
                            <input type="text" name="website_hp" tabindex="-1" autocomplete="off">
                        </div>

                        <!-- Row 1: Full Name & Email Address -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    <span class="ats-lang-en">Full Name</span><span class="ats-lang-id">Nama Lengkap</span>
                                    <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                            <circle cx="12" cy="7" r="4"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           data-i18n-placeholder-en="e.g. Hendra Wijaya"
                                           data-i18n-placeholder-id="Contoh: Hendra Wijaya"
                                           placeholder="e.g. Hendra Wijaya"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200/90 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 text-sm text-slate-800 transition bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    <span class="ats-lang-en">Email Address</span><span class="ats-lang-id">Alamat Email</span>
                                    <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                        </svg>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           data-i18n-placeholder-en="email@company.com"
                                           data-i18n-placeholder-id="email@perusahaan.com"
                                           placeholder="email@company.com"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200/90 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 text-sm text-slate-800 transition bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Phone Number & Subject -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    <span class="ats-lang-en">Phone / WhatsApp</span><span class="ats-lang-id">Nomor WhatsApp / Telepon</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                           data-i18n-placeholder-en="+62 812 3456 7890"
                                           data-i18n-placeholder-id="Contoh: 0812 3456 7890"
                                           placeholder="+62 812 3456 7890"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200/90 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 text-sm font-mono text-slate-800 transition bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    <span class="ats-lang-en">Subject / Requirement</span><span class="ats-lang-id">Subjek / Kebutuhan</span>
                                    <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/>
                                            <path d="M7 7h.01"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="subject" id="inquirySubject" value="{{ old('subject') }}" required
                                           data-i18n-placeholder-en="BoQ Request for Schneider Breakers"
                                           data-i18n-placeholder-id="Contoh: Permintaan Penawaran Schneider MCB"
                                           placeholder="BoQ Request for Schneider Breakers"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200/90 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 text-sm text-slate-800 transition bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Message Details & Technical Specs -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                    <span class="ats-lang-en">Message Details &amp; Specifications</span>
                                    <span class="ats-lang-id">Detail Kebutuhan / Daftar Komponen</span>
                                    <span class="text-rose-500">*</span>
                                </label>
                                <span class="text-[11px] text-slate-400">
                                    <span class="ats-lang-en">Model, current rating (A), or quantity</span>
                                    <span class="ats-lang-id">Tipe, ampere, atau jumlah kuantitas</span>
                                </span>
                            </div>
                            <div class="relative">
                                <textarea name="message" rows="4" required
                                          data-i18n-placeholder-en="Specify component types, current rating (Ampere), quantities, or paste your estimation list..."
                                          data-i18n-placeholder-id="Tuliskan tipe komponen, rating arus (Ampere), jumlah unit, merk (Schneider, GAE, Legrand), atau tempelkan daftar estimasi BoQ Anda..."
                                          placeholder="Specify component types, current rating (Ampere), quantities, or paste your estimation list..."
                                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200/90 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 text-sm text-slate-800 leading-relaxed transition bg-slate-50/50 hover:bg-white focus:bg-white">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-rose-600 via-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white font-bold text-sm sm:text-base rounded-xl shadow-md shadow-rose-600/25 transition transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2.5 cursor-pointer">
                            <svg class="w-4 h-4 text-rose-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m22 2-7 20-4-9-9-4Z"/>
                                <path d="M22 2 11 13"/>
                            </svg>
                            <span class="ats-lang-en">Send Inquiry / BoQ Request Now</span>
                            <span class="ats-lang-id">Kirim Permintaan Penawaran Sekarang</span>
                        </button>
                    </form>
                </div>

                <!-- Trust Note -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-center gap-2 text-[11px] text-slate-400">
                    <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <span>
                        <span class="ats-lang-en">Your BoQ documents are strictly confidential &bull; PT. ATS team is ready to assist</span>
                        <span class="ats-lang-id">Data &amp; dokumen BoQ Anda terjamin kerahasiaannya &bull; Tim PT. ATS siap merespon</span>
                    </span>
                </div>
            </div>

            <!-- ================= RIGHT COLUMN: STRUCTURED CORPORATE DETAILS (5 cols) ================= -->
            <div class="lg:col-span-5 flex flex-col justify-between space-y-6">

                <!-- CARD 1: SURABAYA HEADQUARTERS & SHOWROOM -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-7 space-y-4 relative overflow-hidden">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            <!-- Custom SVG Location Badge -->
                            <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-slate-900 text-base sm:text-lg leading-snug">
                                    <span class="ats-lang-en">Head Office</span>
                                    <span class="ats-lang-id">Kantor Pusat</span>
                                </h3>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-semibold text-slate-500">Surabaya, Jawa Timur</span>
                                </div>
                            </div>
                        </div>

                        <!-- Open in Maps Button -->
                        <a href="https://maps.google.com/?cid=13502184121040894586" target="_blank" class="shrink-0 p-2 rounded-xl bg-slate-50 hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200/80 transition" title="Buka di Google Maps">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h6v6"/>
                                <path d="M10 14 21 3"/>
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Full Address -->
                    <div class="bg-slate-50/80 p-3 rounded-2xl border border-slate-100 text-xs text-slate-600 leading-relaxed">
                        {{ $settings['address'] ?? 'Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya, East Java, Indonesia' }}
                    </div>

                    <!-- Structured Contact Channels (Vertical Stack, No Cramped Rows!) -->
                    <div class="space-y-2.5 pt-1">
                        <!-- Phone Hunting -->
                        <a href="tel:03159178887" class="flex items-center justify-between p-3 rounded-2xl border border-slate-200/70 hover:border-rose-300 hover:bg-rose-50/30 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        <span class="ats-lang-en">Office Hunting Phone</span>
                                        <span class="ats-lang-id">Telepon Kantor (Hunting)</span>
                                    </div>
                                    <div class="text-sm font-extrabold text-slate-900 group-hover:text-rose-600 transition font-mono">
                                        (031) 59178887
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-rose-600 opacity-0 group-hover:opacity-100 transition flex items-center gap-1">
                                Call &rarr;
                            </span>
                        </a>

                        <!-- Email Address -->
                        <a href="mailto:{{ $settings['email'] ?? 'sales@atstekno.com' }}" class="flex items-center justify-between p-3 rounded-2xl border border-slate-200/70 hover:border-rose-300 hover:bg-rose-50/30 transition group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        <span class="ats-lang-en">Official Quotation Email</span>
                                        <span class="ats-lang-id">Email Penawaran Resmi</span>
                                    </div>
                                    <div class="text-xs font-extrabold text-slate-900 group-hover:text-rose-600 transition truncate font-mono">
                                        {{ $settings['email'] ?? 'sales@atstekno.com' }}
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-rose-600 opacity-0 group-hover:opacity-100 transition shrink-0">
                                Mail &rarr;
                            </span>
                        </a>

                        <!-- Office Working Hours -->
                        <div class="flex items-center gap-3 p-3 rounded-2xl border border-slate-200/70 bg-slate-50/50">
                            <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    <span class="ats-lang-en">Operating Hours</span>
                                    <span class="ats-lang-id">Jam Operasional Kantor</span>
                                </div>
                                <div class="text-xs font-bold text-slate-700">
                                    <span class="ats-lang-en">Mon – Fri: 08:00 – 17:00 WIB &bull; Sat: 08:00 – 16:00 WIB</span>
                                    <span class="ats-lang-id">Senin – Jumat: 08.00 – 17.00 WIB &bull; Sabtu: 08.00 – 16.00 WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: OFFICIAL WHATSAPP FAST-RESPONSE HOTLINE -->
                <div class="bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 text-white rounded-3xl p-6 sm:p-7 shadow-lg shadow-emerald-700/20 relative overflow-hidden space-y-3.5">
                    <!-- Subtle Background SVG Watermark -->
                    <div class="absolute -right-6 -bottom-6 text-white/10 pointer-events-none">
                        <svg class="w-36 h-36" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-2xl bg-white/15 backdrop-blur-xs flex items-center justify-center text-white border border-white/20">
                            <!-- Custom WhatsApp SVG -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-white/20 backdrop-blur-xs text-white border border-white/25">
                            <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            <span>
                                <span class="ats-lang-en">Online &amp; Ready to Assist</span>
                                <span class="ats-lang-id">Online &amp; Siap Melayani</span>
                            </span>
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg sm:text-xl font-black text-white tracking-tight">
                            <span class="ats-lang-en">Official WhatsApp Sales Hotline</span>
                            <span class="ats-lang-id">Hotline WhatsApp Penjualan Cepat</span>
                        </h3>
                        <p class="text-xs text-emerald-100 mt-1 leading-relaxed">
                            <span class="ats-lang-en">Direct access for instant warehouse stock checking, technical part numbers, and formal VAT tax invoices.</span>
                            <span class="ats-lang-id">Layanan langsung untuk verifikasi ketersediaan stok gudang, konfirmasi nomor part, dan faktur pajak PPN resmi.</span>
                        </p>
                    </div>

                    <a href="https://wa.me/6282223332830?text=Halo%20PT.%20Anugerah%20Tama%20Sejati,%20saya%20ingin%20konsultasi%20komponen%20listrik%20dan%20permintaan%20penawaran%20harga." target="_blank" class="w-full py-3 px-4 bg-white hover:bg-emerald-50 text-emerald-900 font-extrabold text-sm rounded-xl shadow-md transition flex items-center justify-center gap-2 group">
                        <svg class="w-4 h-4 text-emerald-600 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>
                            <span class="ats-lang-en">Chat WhatsApp:</span>
                            <span class="ats-lang-id">Chat WhatsApp:</span>
                            +62 822 2333 2830
                        </span>
                        <span class="group-hover:translate-x-1 transition">&rarr;</span>
                    </a>
                </div>

                <!-- CARD 3: ATS PROCUREMENT & QUALITY ASSURANCE BADGES -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-5 space-y-3">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        <span class="ats-lang-en">Procurement Guarantees:</span>
                        <span class="ats-lang-id">Jaminan Pengadaan Resmi ATS:</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2.5">
                        <div class="p-2.5 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                            <div class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 mx-auto flex items-center justify-center mb-1">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </div>
                            <div class="font-extrabold text-[11px] text-slate-800">
                                <span class="ats-lang-en">100% Genuine</span>
                                <span class="ats-lang-id">100% Asli</span>
                            </div>
                            <div class="text-[9.5px] text-slate-500">
                                <span class="ats-lang-en">Factory Warranty</span>
                                <span class="ats-lang-id">Garansi Pabrikan</span>
                            </div>
                        </div>

                        <div class="p-2.5 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                            <div class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 mx-auto flex items-center justify-center mb-1">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="16" height="20" x="4" y="2" rx="2"/>
                                    <line x1="8" x2="16" y1="6" y2="6"/>
                                    <line x1="8" x2="16" y1="10" y2="10"/>
                                    <line x1="8" x2="12" y1="14" y2="14"/>
                                </svg>
                            </div>
                            <div class="font-extrabold text-[11px] text-slate-800">
                                <span class="ats-lang-en">Tax Invoice</span>
                                <span class="ats-lang-id">Faktur Pajak</span>
                            </div>
                            <div class="text-[9.5px] text-slate-500">
                                <span class="ats-lang-en">Official 11% VAT</span>
                                <span class="ats-lang-id">PPN 11% Resmi</span>
                            </div>
                        </div>

                        <div class="p-2.5 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                            <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 mx-auto flex items-center justify-center mb-1">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="10" x="2" y="7" rx="2"/>
                                    <path d="M16 11h4l3 3v3h-7v-6z"/>
                                    <circle cx="6.5" cy="18.5" r="2.5"/>
                                    <circle cx="18.5" cy="18.5" r="2.5"/>
                                </svg>
                            </div>
                            <div class="font-extrabold text-[11px] text-slate-800">
                                <span class="ats-lang-en">Fast Delivery</span>
                                <span class="ats-lang-id">Kirim Cepat</span>
                            </div>
                            <div class="text-[9.5px] text-slate-500">
                                <span class="ats-lang-en">Nationwide</span>
                                <span class="ats-lang-id">Seluruh Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= FULL WIDTH SHOWROOM & GOOGLE MAPS SECTION ================= -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
            <!-- Header bar -->
            <div class="p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 via-white to-slate-50">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/>
                            <line x1="8" y1="2" x2="8" y2="18"/>
                            <line x1="16" y1="6" x2="16" y2="22"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-rose-600 uppercase tracking-wider">
                            <span class="ats-lang-en">Official Showroom &amp; Warehouse Location</span>
                            <span class="ats-lang-id">Lokasi Showroom &amp; Gudang Utama</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                            PT. Anugerah Tama Sejati — Surabaya Headquarters
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya &bull;
                            <span class="ats-lang-en">Easy Access &amp; Spacious Parking</span>
                            <span class="ats-lang-id">Akses Mudah &amp; Parkir Luas</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="https://maps.google.com/?cid=13502184121040894586" target="_blank" class="px-5 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs sm:text-sm shadow-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h6v6"/>
                            <path d="M10 14 21 3"/>
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                        </svg>
                        <span>
                            <span class="ats-lang-en">Google Maps Directions</span>
                            <span class="ats-lang-id">Petunjuk Arah Google Maps</span>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Full-width Google Maps Embed Iframe -->
            <div class="w-full h-80 sm:h-96 bg-slate-100 relative">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.4611678914266!2d112.78433609999999!3d-7.301971999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb1cc2393627%3A0xbb6164eba28ffa7a!2sPT.%20Anugerah%20Tama%20Sejati!5e0!3m2!1sid!2sid!4v1789524195132!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                    title="Peta Lokasi PT. Anugerah Tama Sejati Surabaya">
                </iframe>
            </div>

            <!-- Facility Highlights Footnote -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4 text-xs text-slate-500">
                <div class="flex items-center gap-2 font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>
                        <span class="ats-lang-en">Ready for direct warehouse self-pickup &amp; switchboard inspection</span>
                        <span class="ats-lang-id">Siap melayani pengambilan barang langsung (Self-Pickup) &amp; inspeksi panel listrik</span>
                    </span>
                </div>
                <div class="text-[11px] text-slate-400 font-mono">
                    <span class="ats-lang-en">GEO Coordinates:</span><span class="ats-lang-id">Koordinat GEO:</span> -7.301972, 112.784336
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function setSubjectPreset(text) {
    const input = document.getElementById('inquirySubject');
    if (input) {
        input.value = text;
        input.focus();
    }
}
</script>
@endsection
