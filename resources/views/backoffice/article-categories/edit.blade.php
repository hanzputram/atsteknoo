@extends('backoffice.layouts.app')

@section('title', 'Edit Kategori: ' . $category->name)
@section('breadcrumb', 'Edit Kategori: ' . $category->name)

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Kategori Artikel</h1>
    <p class="page-subtitle">Perbarui informasi kelompok: <strong>{{ $category->name }}</strong></p>
  </div>

  <a href="{{ route('backoffice.article-categories.index') }}" class="btn btn-secondary">&larr; Kembali ke Daftar</a>
</div>

<div class="panel-card" style="max-width: 720px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.article-categories.update', $category->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label class="form-label">Kode Kategori <span style="color: #DC2626;">*</span></label>
        <input type="text" name="code" value="{{ old('code', $category->code) }}" required style="text-transform: uppercase;">
      </div>

      <div class="form-group">
        <label class="form-label">Nama Kategori <span style="color: #DC2626;">*</span></label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
      </div>

      <div class="form-group">
        <label class="form-label">Slug URL</label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}">
        <span class="form-hint">URL kategori: /articles/kategori/{{ $category->slug }}</span>
      </div>

      <div class="form-group">
        <label class="form-label">Deskripsi Ringkas</label>
        <textarea name="description" rows="3">{{ old('description', $category->description) }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label">Urutan Tampil</label>
          <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0">
        </div>

        <div class="form-group" style="justify-content: flex-end; padding-bottom: 8px;">
          <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13.5px; font-weight: 600; color: #334155;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px;">
            <span>Status Kategori Aktif</span>
          </label>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--color-border);">
        <a href="{{ route('backoffice.article-categories.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
      </div>
    </form>
  </div>
</div>
@endsection
