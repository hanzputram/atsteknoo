@extends('backoffice.layouts.app')

@section('title', 'Edit Brand: ' . $brand->name)
@section('breadcrumb')
<a href="{{ route('backoffice.brands.index') }}">Brand Resmi</a> / <span>Edit Brand</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Brand: {{ $brand->name }}</h1>
    <p class="page-subtitle">Perbarui profil dan logo mitra.</p>
  </div>

  <a href="{{ route('backoffice.brands.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<div class="panel-card" style="max-width: 650px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="code">Kode Brand *</label>
          <input type="text" name="code" id="code" class="form-control" required value="{{ old('code', $brand->code) }}">
        </div>

        <div class="form-group">
          <label class="form-label" for="name">Nama Brand *</label>
          <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $brand->name) }}">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Logo Saat Ini</label>
        <div style="width: 100px; height: 50px; border-radius: 8px; border: 1px solid var(--color-border); background: #FFFFFF; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 4px; margin-bottom: 6px;">
          @if($brand->logo)
            <img src="{{ route('media.view', $brand->logo->id) }}" alt="{{ $brand->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
          @else
            <span style="font-size: 11px; color: #94A3B8;">Belum ada logo</span>
          @endif
        </div>
        <label class="form-label" for="logo" style="font-size: 12px;">Ganti Logo Brand</label>
        <input type="file" name="logo" id="logo" class="form-control" accept="image/jpeg,image/png,image/webp">
      </div>

      <div class="form-group">
        <label class="form-label" for="website_url">Website Resmi</label>
        <input type="url" name="website_url" id="website_url" class="form-control" value="{{ old('website_url', $brand->website_url) }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="description_html">Profil Singkat Brand</label>
        <textarea name="description_html" id="description_html" rows="3" class="form-control wysiwyg-editor">{{ old('description_html', $brand->description_html) }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="sort_order">Urutan Tampil</label>
          <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $brand->sort_order) }}" min="0">
        </div>

        <div class="form-group" style="justify-content: center;">
          <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; cursor: pointer; margin-top: 20px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }}>
            <span>Status Brand Aktif</span>
          </label>
        </div>
      </div>

      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="submit" class="btn btn-primary">Perbarui Brand</button>
        <a href="{{ route('backoffice.brands.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
