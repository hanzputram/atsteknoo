@extends('backoffice.layouts.app')

@section('title', 'Pengaturan Website')
@section('header', 'Pengaturan Website')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Konfigurasi Identitas & Kontak</h2>
            <p class="text-sm text-slate-500">Nilai di bawah otomatis digunakan pada header, footer, About Us, dan halaman kontak resmi</p>
        </div>

        <form action="{{ route('backoffice.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Bagian 1: Identitas Perusahaan -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Identitas Perusahaan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan / Website</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? 'PT. Anugerah Tama Sejati') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Slogan / Tagline</label>
                        <input type="text" name="company_tagline" value="{{ old('company_tagline', $settings['company_tagline'] ?? 'Best Electrical Supplier & Panel Maker') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Kontak & Kantor -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Informasi Kontak
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Telepon Kantor</label>
                        <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '+62 21 5431 8899') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">WhatsApp Konsultasi</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '+62 812 8899 7788') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Resmi</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'sales@anugerahtamasejati.com') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Kantor / Showroom</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">{{ old('address', $settings['address'] ?? 'Komp. Ruko Glodok Plaza Blok F No. 12, Jl. Pinangsia Raya No. 1') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kota & Provinsi</label>
                        <input type="text" name="city" value="{{ old('city', $settings['city'] ?? 'Jakarta Barat, DKI Jakarta') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kode Pos</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $settings['postal_code'] ?? '11180') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">URL / Link Google Maps</label>
                    <input type="text" name="google_maps_embed" value="{{ old('google_maps_embed', $settings['google_maps_embed'] ?? 'https://maps.google.com/?q=Jakarta') }}" placeholder="https://maps.google.com/..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">
                </div>
            </div>

            <!-- Bagian 3: Media Sosial & SEO Default -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    Media Sosial & SEO Standar
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">LinkedIn Profil / Halaman</label>
                        <input type="text" name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? 'https://linkedin.com/company/anugerah-tama-sejati') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Instagram Profil</label>
                        <input type="text" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? 'https://instagram.com/anugerahtamasejati') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Default Meta Title SEO</label>
                    <input type="text" name="default_meta_title" value="{{ old('default_meta_title', $settings['default_meta_title'] ?? 'PT. Anugerah Tama Sejati - Supplier Elektrikal & Panel Maker') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Default Meta Description SEO</label>
                    <textarea name="default_meta_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">{{ old('default_meta_description', $settings['default_meta_description'] ?? 'Distributor resmi komponen elektrikal terkemuka: Schneider Electric, ABB, Socomec, Chint, Fort, Uticell.') }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                    Simpan Perubahan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
