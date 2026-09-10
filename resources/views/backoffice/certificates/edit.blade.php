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
                        <div style="width: 80px; height: 110px; border-radius: 8px; background: #FFFFFF; border: 1px solid #CBD5E1; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <img src="{{ $certificate->image_url }}" alt="{{ $certificate->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </div>
                        <div class="flex-1">
                            <label class="text-xs font-bold text-slate-700 block mb-1">Ganti File Gambar (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="form-control text-xs">
                            <span class="form-hint">Biarkan kosong jika tidak ingin mengubah gambar sertifikat.</span>
                        </div>
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
