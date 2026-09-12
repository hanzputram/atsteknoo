@extends('backoffice.layouts.app')

@section('title', 'Tambah Project Baru')
@section('breadcrumb')
<a href="{{ route('backoffice.projects.index') }}">Project Portofolio</a> / <span>Tambah Project</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tambah Project Portofolio</h1>
    <p class="page-subtitle">Daftarkan dokumentasi pekerjaan rekayasa atau instalasi baru.</p>
  </div>

  <a href="{{ route('backoffice.projects.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<form action="{{ route('backoffice.projects.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">Informasi Project</h2>
        </div>
        <div class="panel-body">
          <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="project_code">Kode Project</label>
              <input type="text" name="project_code" id="project_code" class="form-control" value="{{ old('project_code') }}" placeholder="Otomatis jika kosong">
            </div>

            <div class="form-group">
              <label class="form-label" for="title">Judul Pekerjaan / Project *</label>
              <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}" placeholder="Contoh: 2500A Main Switchboard LVMDP Substation">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="category_id">Kategori Project *</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $c)
                  <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="client_name">Nama Klien / Perusahaan</label>
              <input type="text" name="client_name" id="client_name" class="form-control" value="{{ old('client_name') }}" placeholder="Opsional (Hanya bila publik)">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="location">Lokasi Pekerjaan</label>
              <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" placeholder="Contoh: Gresik, Jawa Timur">
            </div>

            <div class="form-group">
              <label class="form-label" for="completion_year">Tahun Penyelesaian</label>
              <input type="text" name="completion_year" id="completion_year" class="form-control" value="{{ old('completion_year') }}" placeholder="Contoh: 2024">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="scope_of_work">Lingkup Pekerjaan (Scope of Work)</label>
            <textarea name="scope_of_work" id="scope_of_work" rows="2" class="form-control" placeholder="Contoh: Pengadaan Breaker, Perakitan Busbar, Pengujian Relay Proteksi">{{ old('scope_of_work') }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="summary">Ringkasan Singkat (Summary)</label>
            <textarea name="summary" id="summary" rows="2" class="form-control" placeholder="Ringkasan 1-2 kalimat untuk kartu portofolio...">{{ old('summary') }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="content_html">Uraian &amp; Narasi Teknis Project</label>
            <textarea name="content_html" id="content_html" rows="8" class="form-control wysiwyg-editor" placeholder="Detail teknis lingkup instalasi, komponen yang disuplai, tantangan engineering...">{{ old('content_html') }}</textarea>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Column: Media & Publication -->
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Publikasi Portofolio</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="status">Status Konten *</label>
            <select name="status" id="status" class="form-control">
              <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published (Langsung Publikasikan)</option>
              <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Simpan sebagai Konsep)</option>
              <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
            </select>
            <span class="form-hint" style="color: #059669; font-weight: 500; margin-top: 4px; display: block;">
              &bull; Default &ldquo;Published&rdquo; agar proyek langsung tampil di web &amp; beranda.
            </span>
          </div>

          <div class="form-group" style="margin-bottom: 16px;">
            <label style="display: flex; align-items: flex-start; gap: 10px; font-size: 13px; font-weight: 600; cursor: pointer; padding: 12px 14px; background: #FFF1F2; border: 1px solid #FECDD3; border-radius: 10px; transition: background-color 0.2s;">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', true) ? 'checked' : '' }} style="margin-top: 2px; accent-color: #E11D48; width: 18px; height: 18px; cursor: pointer;">
              <div>
                <div style="color: #9F1239; font-weight: 700; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                  <span>★</span> Tampilkan di Carousel Beranda (Home)
                </div>
                <div style="font-size: 11.5px; color: #475569; font-weight: 400; margin-top: 3px; line-height: 1.4;">
                  Centang opsi ini agar proyek ini tampil pada carousel 3D <strong>&ldquo;Portofolio Proyek Unggulan&rdquo;</strong> di halaman depan website.
                </div>
              </div>
            </label>
          </div>

          <div class="form-group">
            <label class="form-label" for="sort_order">Urutan Tampil</label>
            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
          </div>

          <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan Project</button>
            <a href="{{ route('backoffice.projects.index') }}" class="btn btn-secondary" style="width: 100%;">Batal</a>
          </div>
        </div>
      </div>

      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Foto Cover &amp; Dokumentasi</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="cover_image">Cover Utama Project *</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/jpeg,image/png,image/webp">
            <span class="form-hint">Format JPG/PNG/WEBP (Maksimal 10 MiB).</span>
          </div>

          <div class="form-group">
            <label class="form-label" for="gallery_images">Dokumentasi Instalasi Tambahan</label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple accept="image/jpeg,image/png,image/webp">
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
@endsection
