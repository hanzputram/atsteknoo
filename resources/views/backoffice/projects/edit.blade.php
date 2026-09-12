@extends('backoffice.layouts.app')

@section('title', 'Edit Project: ' . $project->title)
@section('breadcrumb')
<a href="{{ route('backoffice.projects.index') }}">Project Portofolio</a> / <span>Edit Project</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Project: {{ $project->title }}</h1>
    <p class="page-subtitle">Perbarui rincian portofolio pekerjaan engineering.</p>
  </div>

  <div style="display: flex; gap: 10px;">
    @if($project->isPublished())
      <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="btn btn-secondary">Lihat Halaman Publik &nearr;</a>
    @endif
    <a href="{{ route('backoffice.projects.index') }}" class="btn btn-secondary">&larr; Kembali</a>
  </div>
</div>

<form action="{{ route('backoffice.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">Informasi Project</h2>
        </div>
        <div class="panel-body">
          <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="project_code">Kode Project *</label>
              <input type="text" name="project_code" id="project_code" class="form-control" required value="{{ old('project_code', $project->project_code) }}">
            </div>

            <div class="form-group">
              <label class="form-label" for="title">Judul Pekerjaan / Project *</label>
              <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $project->title) }}">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="category_id">Kategori Project *</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $c)
                  <option value="{{ $c->id }}" {{ old('category_id', $project->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="client_name">Nama Klien / Perusahaan</label>
              <input type="text" name="client_name" id="client_name" class="form-control" value="{{ old('client_name', $project->client_name) }}">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="location">Lokasi Pekerjaan</label>
              <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $project->location) }}">
            </div>

            <div class="form-group">
              <label class="form-label" for="completion_year">Tahun Penyelesaian</label>
              <input type="text" name="completion_year" id="completion_year" class="form-control" value="{{ old('completion_year', $project->completion_year) }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="scope_of_work">Lingkup Pekerjaan</label>
            <textarea name="scope_of_work" id="scope_of_work" rows="2" class="form-control">{{ old('scope_of_work', $project->scope_of_work) }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="summary">Ringkasan Singkat</label>
            <textarea name="summary" id="summary" rows="2" class="form-control">{{ old('summary', $project->summary) }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="content_html">Uraian &amp; Narasi Teknis Project</label>
            <textarea name="content_html" id="content_html" rows="8" class="form-control wysiwyg-editor">{{ old('content_html', $project->content_html) }}</textarea>
          </div>
        </div>
      </div>

    </div>

    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Publikasi Portofolio</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="status">Status Konten *</label>
            <select name="status" id="status" class="form-control">
              <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
              <option value="published" {{ old('status', $project->status) === 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
              <option value="archived" {{ old('status', $project->status) === 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 16px;">
            <label style="display: flex; align-items: flex-start; gap: 10px; font-size: 13px; font-weight: 600; cursor: pointer; padding: 12px 14px; background: #FFF1F2; border: 1px solid #FECDD3; border-radius: 10px; transition: background-color 0.2s;">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} style="margin-top: 2px; accent-color: #E11D48; width: 18px; height: 18px; cursor: pointer;">
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
            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $project->sort_order) }}" min="0">
          </div>

          <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Perbarui Project</button>
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
            <label class="form-label">Foto Cover Saat Ini</label>
            <div style="width: 100%; height: 160px; border-radius: 10px; border: 1px solid var(--color-border); background: #F8FAFC; overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 8px;">
              @if($project->coverImage)
                <img src="{{ route('media.view', $project->coverImage->id) }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
              @else
                <span style="color: #94A3B8; font-size: 13px;">Belum ada cover</span>
              @endif
            </div>
            <label class="form-label" for="cover_image" style="font-size: 12px;">Ganti Foto Cover</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/jpeg,image/png,image/webp">
          </div>

          <div class="form-group">
            <label class="form-label">Galeri Dokumentasi ({{ $project->galleryUsages->count() }} foto)</label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple accept="image/jpeg,image/png,image/webp">
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
@endsection
