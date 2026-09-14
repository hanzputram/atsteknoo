@extends('backoffice.layouts.app')

@section('title', 'Tambah Sertifikat Baru')
@section('header', 'Tambah Sertifikat Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="panel-card">
        <div class="panel-body">
            <div class="mb-6 flex justify-between items-center border-b border-slate-100 pb-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Form Sertifikat Baru</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Unggah gambar sertifikat resmi dan informasi akreditasi.</p>
                </div>
                <a href="{{ route('backoffice.certificates.index') }}" class="btn btn-secondary btn-sm">&larr; Kembali</a>
            </div>

            <form action="{{ route('backoffice.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Nama Prinsipal / Penerbit <span class="text-red-500">*</span></label>
                        <input type="text" name="partner_name" value="{{ old('partner_name') }}" required placeholder="Contoh: Schneider Electric" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Badge Status <span class="text-red-500">*</span></label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', 'VERIFIED PARTNER') }}" required placeholder="Contoh: VERIFIED PARTNER" class="form-control">
                    </div>
                </div>

                <div>
                    <label class="form-label">Judul Sertifikat <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Authorized Distributor Certificate" class="form-control">
                </div>

                <div>
                    <label class="form-label">Deskripsi / Ruang Lingkup Lisensi</label>
                    <textarea name="description" rows="3" placeholder="Uraian lisensi komponen, wilayah otorisasi, atau nomor registrasi sertifikat..." class="form-control">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="form-label">Unggah Foto / Scan Sertifikat (PNG, JPG, WEBP) <span class="text-red-500">*</span></label>
                    <input type="file" name="image" accept="image/*" required class="form-control">
                    <span class="form-hint">Maksimal 10MB. Format gambar sertifikat resmi dari prinsipal.</span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <label class="form-label font-bold text-slate-800 text-sm mb-1 block">Orientasi Sertifikat <span class="text-red-500">*</span></label>
                    <p class="text-xs text-slate-500 mb-3">Tentukan orientasi sertifikat agar tampilan kartu di website publik otomatis menyesuaikan rasio dan tidak terpotong.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="relative flex items-center gap-3 p-3.5 rounded-xl border bg-white cursor-pointer transition hover:border-slate-400 has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/40 has-[:checked]:ring-1 has-[:checked]:ring-rose-500">
                            <input type="radio" name="is_landscape" value="0" {{ old('is_landscape', '0') == '0' ? 'checked' : '' }} class="w-4 h-4 text-rose-600 focus:ring-rose-500">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-9 rounded border-2 border-dashed border-slate-400 flex items-center justify-center text-[10px] font-black text-slate-500 bg-slate-50">P</div>
                                <div>
                                    <div class="text-xs font-bold text-slate-900">Portrait (Tegak / Vertikal)</div>
                                    <div class="text-[11px] text-slate-500">Format A4 tegak (seperti surat resmi GAE)</div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="relative flex items-center gap-3 p-3.5 rounded-xl border bg-white cursor-pointer transition hover:border-slate-400 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/40 has-[:checked]:ring-1 has-[:checked]:ring-emerald-500">
                            <input type="radio" name="is_landscape" value="1" {{ old('is_landscape') == '1' ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-7 rounded border-2 border-dashed border-emerald-500 flex items-center justify-center text-[10px] font-black text-emerald-600 bg-emerald-50">L</div>
                                <div>
                                    <div class="text-xs font-bold text-slate-900">Landscape (Mendatar / Horizontal)</div>
                                    <div class="text-[11px] text-slate-500">Format melebar (seperti Schneider &amp; Legrand)</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Urutan Tampil (Sort Order)</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control font-mono">
                    </div>
                    <div>
                        <label class="form-label">Status Tampil</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif (Tampilkan di Web)</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Non-Aktif (Sembunyikan)</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('backoffice.certificates.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Sertifikat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
