@extends('layouts.app')

@section('title', 'Hubungi Kami & Kantor Resmi - PT. Anugerah Tama Sejati')
@section('meta_description', 'Hubungi tim sales dan engineering PT. Anugerah Tama Sejati di Surabaya dan Jakarta untuk konsultasi komponen kelistrikan industri dan permintaan penawaran harga (BoQ).')

@section('content')
<div class="bg-slate-50 py-12 sm:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Beranda</a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">Kontak &amp; Lokasi</span>
        </nav>

        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                Official Inquiries &amp; Showrooms
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
                Hubungi Kami
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mt-3 max-w-2xl leading-relaxed">
                Tim sales dan rekayasa kelistrikan kami siap membantu estimasi Bill of Quantity (BoQ), pemilihan komponen, dan verifikasi spesifikasi.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Contact Form Column (7 cols) -->
        <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-xs">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Kirim Pesan atau Penawaran BoQ</h2>
            <p class="text-xs text-slate-500 mb-8">Isi formulir di bawah dan staf kami akan merespons dalam 1x24 jam kerja.</p>

            @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                @foreach($errors->all() as $err)
                    <p>&bull; {{ $err }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Honeypot Field (Hidden from humans) -->
                <div class="hidden" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Hendra Wijaya" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@perusahaan.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+62 812..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Subjek Kebutuhan <span class="text-rose-500">*</span></label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="Permintaan BoQ Breaker Schneider" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Rincian Pesan &amp; Spesifikasi <span class="text-rose-500">*</span></label>
                    <textarea name="message" rows="5" required placeholder="Tuliskan kebutuhan tipe komponen, rating ampere, atau lampirkan daftar estimasi Anda..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="w-full py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm rounded-xl shadow-sm transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

        <!-- Office Details Column (5 cols) -->
        <div class="lg:col-span-5 space-y-8">
            <!-- Surabaya HQ Card -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                        📍
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base">Head Office &amp; Main Warehouse</h3>
                        <span class="text-xs text-slate-400">Surabaya, Jawa Timur</span>
                    </div>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    {{ $settings['address'] ?? 'Jl. Kenjeran No. 485, Gading, Tambaksari, Surabaya, East Java 60134, Indonesia' }}
                </p>
                <div class="pt-2 border-t border-slate-100 flex flex-wrap gap-4 text-xs font-mono">
                    <a href="tel:03159178887" class="text-blue-600 hover:underline">📞 (031) 59178887</a>
                    <a href="mailto:{{ $settings['email'] ?? 'sales@anugerahtamasejati.com' }}" class="text-slate-600 hover:underline">✉️ {{ $settings['email'] ?? 'sales@anugerahtamasejati.com' }}</a>
                </div>
            </div>

            <!-- Direct WhatsApp Hotline -->
            <div class="bg-gradient-to-tr from-emerald-600 to-teal-600 text-white p-8 rounded-3xl shadow-sm space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-xs flex items-center justify-center text-2xl">
                    💬
                </div>
                <div>
                    <h3 class="text-xl font-bold">WhatsApp Resmi Penjualan</h3>
                    <p class="text-xs text-emerald-100 mt-1">Layanan cepat untuk verifikasi stok gudang, nomor seri part, dan faktur pajak resmi.</p>
                </div>
                <a href="https://wa.me/6281234567890?text=Halo%20PT%20Anugerah%20Tama%20Sejati,%20saya%20ingin%20konsultasi%20katalog%20produk" target="_blank" class="inline-block px-5 py-2.5 bg-white text-emerald-800 font-bold text-xs rounded-xl shadow-xs hover:bg-emerald-50 transition">
                    Chat WhatsApp: 0812-3456-7890 &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
