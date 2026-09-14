@extends('backoffice.layouts.app')

@section('title', 'Edit Sertifikat: ' . $certificate->title)
@section('header', 'Edit Sertifikat: ' . $certificate->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="panel-card">
        <div class="panel-body">
            <div class="mb-6 flex justify-between items-center border-b border-slate-100 pb-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Edit Sertifikat</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Perbarui data akreditasi atau ganti gambar sertifikat.</p>
                </div>
                <a href="{{ route('backoffice.certificates.index') }}" class="btn btn-secondary btn-sm">&larr; Kembali</a>
            </div>

            <form action="{{ route('backoffice.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Nama Prinsipal / Penerbit <span class="text-red-500">*</span></label>
                        <input type="text" name="partner_name" value="{{ old('partner_name', $certificate->partner_name) }}" required class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Badge Status <span class="text-red-500">*</span></label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $certificate->badge_text) }}" required class="form-control">
                    </div>
                </div>

                <div>
                    <label class="form-label">Judul Sertifikat <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $certificate->title) }}" required class="form-control">
                </div>

                <div>
                    <label class="form-label">Deskripsi / Ruang Lingkup Lisensi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $certificate->description) }}</textarea>
                </div>

                <!-- Current Image Preview & Replacement -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <label class="form-label mb-2">Gambar Sertifikat Saat Ini</label>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 100px; height: 80px; border-radius: 8px; background: #FFFFFF; border: 1px solid #CBD5E1; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 4px;">
                            <img src="{{ $certificate->image_url }}" alt="{{ $certificate->title }}" style="max-width: 100%; max-height: 100%; object-fit: contain; display: block;">
                        </div>
                        <div class="flex-1">
                            <label class="text-xs font-bold text-slate-700 block mb-1">Ganti File Gambar (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="form-control text-xs">
                            <span class="form-hint">Biarkan kosong jika tidak ingin mengubah gambar sertifikat.</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <label class="form-label font-bold text-slate-800 text-sm mb-1 block">Orientasi Sertifikat <span class="text-red-500">*</span></label>
                    <p class="text-xs text-slate-500 mb-3">Tentukan orientasi sertifikat agar tampilan kartu di website publik otomatis menyesuaikan rasio dan tidak terpotong.</p>
                    
                    @php $isLandscapeVal = old('is_landscape', (string)(int)$certificate->is_landscape); @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="relative flex items-center gap-3 p-3.5 rounded-xl border bg-white cursor-pointer transition hover:border-slate-400 has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/40 has-[:checked]:ring-1 has-[:checked]:ring-rose-500">
                            <input type="radio" name="is_landscape" value="0" {{ $isLandscapeVal == '0' ? 'checked' : '' }} class="w-4 h-4 text-rose-600 focus:ring-rose-500">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-9 rounded border-2 border-dashed border-slate-400 flex items-center justify-center text-[10px] font-black text-slate-500 bg-slate-50">P</div>
                                <div>
                                    <div class="text-xs font-bold text-slate-900">Portrait (Tegak / Vertikal)</div>
                                    <div class="text-[11px] text-slate-500">Format A4 tegak (seperti surat resmi GAE)</div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="relative flex items-center gap-3 p-3.5 rounded-xl border bg-white cursor-pointer transition hover:border-slate-400 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/40 has-[:checked]:ring-1 has-[:checked]:ring-emerald-500">
                            <input type="radio" name="is_landscape" value="1" {{ $isLandscapeVal == '1' ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
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
                        <input type="number" name="sort_order" value="{{ old('sort_order', $certificate->sort_order) }}" class="form-control font-mono">
                    </div>
                    <div>
                        <label class="form-label">Status Tampil</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active', (string)$certificate->is_active) == '1' ? 'selected' : '' }}>Aktif (Tampilkan di Web)</option>
                            <option value="0" {{ old('is_active', (string)$certificate->is_active) == '0' ? 'selected' : '' }}>Non-Aktif (Sembunyikan)</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('backoffice.certificates.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
