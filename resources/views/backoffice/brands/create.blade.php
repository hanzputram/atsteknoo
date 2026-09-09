@extends('backoffice.layouts.app')

@section('title', 'Tambah Brand')
@section('breadcrumb')
<a href="{{ route('backoffice.brands.index') }}">Brand Resmi</a> / <span>Tambah Brand</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tambah Brand Resmi</h1>
    <p class="page-subtitle">Daftarkan prinsipal atau authorized brand baru.</p>
  </div>

  <a href="{{ route('backoffice.brands.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<div class="panel-card" style="max-width: 650px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.brands.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="code">Kode Brand *</label>
          <input type="text" name="code" id="code" class="form-control" required value="{{ old('code') }}" placeholder="Contoh: SE">
          <span class="form-hint">Kode acuan stabil untuk Excel.</span>
        </div>

        <div class="form-group">
          <label class="form-label" for="name">Nama Brand *</label>
          <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" placeholder="Contoh: Schneider Electric">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="logo">Logo Brand (File Gambar)</label>
        <input type="file" name="logo" id="logo" class="form-control" accept="image/jpeg,image/png,image/webp">
        <span class="form-hint">Format PNG/JPEG/WEBP latar transparan disarankan.</span>
      </div>

      <div class="form-group">
        <label class="form-label" for="website_url">Website Resmi</label>
        <input type="url" name="website_url" id="website_url" class="form-control" value="{{ old('website_url') }}" placeholder="https://www.se.com/id">
      </div>

      <div class="form-group">
        <label class="form-label" for="description_html">Profil Singkat Brand</label>
        <textarea name="description_html" id="description_html" rows="3" class="form-control">{{ old('description_html') }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="sort_order">Urutan Tampil</label>
          <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
        </div>

        <div class="form-group" style="justify-content: center;">
          <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; cursor: pointer; margin-top: 20px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            <span>Status Brand Aktif</span>
          </label>
        </div>
      </div>

      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="submit" class="btn btn-primary">Simpan Brand</button>
        <a href="{{ route('backoffice.brands.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
