@extends('backoffice.layouts.app')

@section('title', 'Tulis Artikel Baru')
@section('breadcrumb')
<a href="{{ route('backoffice.articles.index') }}">Artikel & Panduan</a> / <span>Tulis Artikel</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tulis Artikel Baru</h1>
    <p class="page-subtitle">Publikasikan panduan teknis atau berita komponen elektrikal.</p>
  </div>

  <a href="{{ route('backoffice.articles.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<form action="{{ route('backoffice.articles.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">Konten Artikel</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="form-label" for="title">Judul Artikel *</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}" placeholder="Contoh: Cara Memilih ACB vs MCCB untuk Switchboard Industri">
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="category_id">Kategori Artikel *</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $c)
                  <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="author_display_name">Nama Penulis Publik</label>
              <input type="text" name="author_display_name" id="author_display_name" class="form-control" value="{{ old('author_display_name', 'ATS Engineering Team') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="excerpt">Ringkasan (Excerpt / Sinopsis)</label>
            <textarea name="excerpt" id="excerpt" rows="2" class="form-control" placeholder="Ringkasan 1-2 kalimat untuk preview card artikel...">{{ old('excerpt') }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="content_html">Isi Lengkap Artikel (WYSIWYG) *</label>
            <textarea name="content_html" id="content_html" rows="14" class="form-control" placeholder="Tulis artikel dengan heading H2-H4, paragraf, list, tabel teknis...">{{ old('content_html') }}</textarea>
            <span class="form-hint">HTML disanitasi otomatis di server. Tag script dan event handler akan dibuang.</span>
          </div>

          <div class="form-group">
            <label class="form-label">Tag Artikel</label>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
              @foreach($tags as $t)
                <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; background: #F8FAFC; border: 1px solid var(--color-border); padding: 5px 10px; border-radius: 6px; cursor: pointer;">
                  <input type="checkbox" name="tags[]" value="{{ $t->id }}" {{ in_array($t->id, old('tags', [])) ? 'checked' : '' }}>
                  <span>{{ $t->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">Pengaturan SEO</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title') }}">
          </div>
          <div class="form-group">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="2" class="form-control">{{ old('meta_description') }}</textarea>
          </div>
        </div>
      </div>

    </div>

    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Publikasi &amp; Jadwal</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="status">Status *</label>
            <select name="status" id="status" class="form-control">
              <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
              <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
              <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="scheduled_at">Jadwal Rilis (Opsional)</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}">
            <span class="form-hint">Kosongkan untuk publish langsung saat ini.</span>
          </div>

          <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan Artikel</button>
            <a href="{{ route('backoffice.articles.index') }}" class="btn btn-secondary" style="width: 100%;">Batal</a>
          </div>
        </div>
      </div>

      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Thumbnail Artikel</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="thumbnail">Unggah Gambar Thumbnail *</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/jpeg,image/png,image/webp">
            <span class="form-hint">Maksimal 10 MiB (JPG/PNG/WEBP).</span>
          </div>

          <div class="form-group">
            <label class="form-label" for="thumbnail_alt">Alt Text Thumbnail</label>
            <input type="text" name="thumbnail_alt" id="thumbnail_alt" class="form-control" value="{{ old('thumbnail_alt') }}">
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
@endsection
