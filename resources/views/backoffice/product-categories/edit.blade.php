@extends('backoffice.layouts.app')

@section('title', 'Edit Kategori: ' . $category->name)
@section('breadcrumb')
<a href="{{ route('backoffice.product-categories.index') }}">Kategori Produk</a> / <span>Edit Kategori</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Kategori: {{ $category->name }}</h1>
    <p class="page-subtitle">Perbarui data dan hierarki kategori.</p>
  </div>

  <a href="{{ route('backoffice.product-categories.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<div class="panel-card" style="max-width: 700px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.product-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="code">Kode Kategori *</label>
          <input type="text" name="code" id="code" class="form-control" required value="{{ old('code', $category->code) }}">
        </div>

        <div class="form-group">
          <label class="form-label" for="name">Nama Kategori *</label>
          <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $category->name) }}">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="slug">URL Slug</label>
          <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
        </div>

        <div class="form-group">
          <label class="form-label" for="parent_id">Parent Kategori</label>
          <select name="parent_id" id="parent_id" class="form-control">
            <option value="">(Tidak Ada / Kategori Utama)</option>
            @foreach($parents as $p)
              <option value="{{ $p->id }}" {{ old('parent_id', $category->parent_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Deskripsi Singkat</label>
        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
      </div>

      <div class="form-group">
        <label class="form-label" for="image">Ganti Gambar / Ikon</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/jpeg,image/png,image/webp">
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label" for="sort_order">Urutan Tampil</label>
          <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order) }}" min="0">
        </div>

        <div class="form-group" style="justify-content: center;">
          <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; cursor: pointer; margin-top: 20px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
            <span>Status Kategori Aktif</span>
          </label>
        </div>
      </div>

      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
        <a href="{{ route('backoffice.product-categories.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
