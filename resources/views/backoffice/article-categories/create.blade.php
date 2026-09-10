@extends('backoffice.layouts.app')

@section('title', 'Tambah Kategori Artikel')
@section('breadcrumb', 'Tambah Kategori Artikel')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tambah Kategori Artikel</h1>
    <p class="page-subtitle">Buat kelompok baru untuk artikel blog dan edukasi teknik.</p>
  </div>

  <a href="{{ route('backoffice.article-categories.index') }}" class="btn btn-secondary">&larr; Kembali ke Daftar</a>
</div>

<div class="panel-card" style="max-width: 720px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.article-categories.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label class="form-label">Kode Kategori <span style="color: #DC2626;">*</span></label>
        <input type="text" name="code" value="{{ old('code') }}" required placeholder="Contoh: TUTORIAL" style="text-transform: uppercase;">
        <span class="form-hint">Kode unik untuk referensi sistem</span>
      </div>

      <div class="form-group">
        <label class="form-label">Nama Kategori <span style="color: #DC2626;">*</span></label>
        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Tutorial & Edukasi Teknik">
      </div>

      <div class="form-group">
        <label class="form-label">Slug URL</label>
        <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Otomatis jika dikosongkan">
        <span class="form-hint">Kosongkan jika ingin dibuat otomatis dari nama kategori</span>
      </div>

      <div class="form-group">
        <label class="form-label">Deskripsi Ringkas</label>
        <textarea name="description" rows="3" placeholder="Uraian singkat isi kategori artikel ini...">{{ old('description') }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label">Urutan Tampil</label>
          <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
        </div>

        <div class="form-group" style="justify-content: flex-end; padding-bottom: 8px;">
          <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13.5px; font-weight: 600; color: #334155;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 18px; height: 18px;">
            <span>Status Kategori Aktif</span>
          </label>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--color-border);">
        <a href="{{ route('backoffice.article-categories.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
      </div>
    </form>
  </div>
</div>
@endsection
