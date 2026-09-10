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
                    <span class="form-hint">Maksimal 10MB. Format rasio potret (portrait 3:4) sangat disarankan.</span>
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
