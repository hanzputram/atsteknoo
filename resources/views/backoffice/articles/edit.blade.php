@extends('backoffice.layouts.app')

@section('title', 'Edit Artikel: ' . $article->title)
@section('breadcrumb')
<a href="{{ route('backoffice.articles.index') }}">Artikel & Panduan</a> / <span>Edit Artikel</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Artikel: {{ $article->title }}</h1>
    <p class="page-subtitle">Perbarui konten edukasi atau panduan teknis.</p>
  </div>

  <div style="display: flex; gap: 10px;">
    @if($article->isPublished())
      <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="btn btn-secondary">Lihat Halaman Publik &nearr;</a>
    @endif
    <a href="{{ route('backoffice.articles.index') }}" class="btn btn-secondary">&larr; Kembali</a>
  </div>
</div>

<form action="{{ route('backoffice.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">Konten Artikel</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="form-label" for="title">Judul Artikel *</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $article->title) }}">
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="category_id">Kategori Artikel *</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $c)
                  <option value="{{ $c->id }}" {{ old('category_id', $article->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="author_display_name">Nama Penulis Publik</label>
              <input type="text" name="author_display_name" id="author_display_name" class="form-control" value="{{ old('author_display_name', $article->author_display_name ?: 'ATS Engineering Team') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="excerpt">Ringkasan (Excerpt / Sinopsis)</label>
            <textarea name="excerpt" id="excerpt" rows="2" class="form-control">{{ old('excerpt', $article->excerpt) }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="content_html">Isi Lengkap Artikel (WYSIWYG) *</label>
            <textarea name="content_html" id="content_html" rows="14" class="form-control wysiwyg-editor">{{ old('content_html', $article->content_html) }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Tag Artikel</label>
            @php $selectedTags = old('tags', $article->tags->pluck('id')->toArray()); @endphp
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
              @foreach($tags as $t)
                <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; background: #F8FAFC; border: 1px solid var(--color-border); padding: 5px 10px; border-radius: 6px; cursor: pointer;">
                  <input type="checkbox" name="tags[]" value="{{ $t->id }}" {{ in_array($t->id, $selectedTags) ? 'checked' : '' }}>
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
            <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', $article->meta_title) }}">
          </div>
          <div class="form-group">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="2" class="form-control">{{ old('meta_description', $article->meta_description) }}</textarea>
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
              <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
              <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
              <option value="archived" {{ old('status', $article->status) === 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="scheduled_at">Jadwal Rilis</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" value="{{ old('scheduled_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
            @if($article->isScheduled())
              <span class="badge badge-info" style="margin-top: 6px;">Status: Terjadwal di masa depan</span>
            @endif
          </div>

          <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Perbarui Artikel</button>
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
            <label class="form-label">Thumbnail Saat Ini</label>
            <div style="width: 100%; height: 160px; border-radius: 10px; border: 1px solid var(--color-border); background: #F8FAFC; overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 8px;">
              @if($article->thumbnail)
                <img src="{{ route('media.view', $article->thumbnail->id) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
              @else
                <span style="color: #94A3B8; font-size: 13px;">Belum ada thumbnail</span>
              @endif
            </div>
            <label class="form-label" for="thumbnail" style="font-size: 12px;">Ganti Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/jpeg,image/png,image/webp">
          </div>

          <div class="form-group">
            <label class="form-label" for="thumbnail_alt">Alt Text Thumbnail</label>
            <input type="text" name="thumbnail_alt" id="thumbnail_alt" class="form-control" value="{{ old('thumbnail_alt', $article->thumbnail_alt) }}">
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
@endsection
