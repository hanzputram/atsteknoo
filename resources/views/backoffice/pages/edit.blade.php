@extends('backoffice.layouts.app')

@section('title', 'Edit Halaman: ' . $page->title)
@section('breadcrumb', 'Edit Halaman: ' . $page->title)

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Konten: {{ $page->title }}</h1>
    <p class="page-subtitle">Kunci Sistem: <span style="font-family: monospace; font-weight: 700; color: #0F172A;">{{ $page->page_key }}</span> &bull; URL Publik: <span style="font-family: monospace; color: #64748B;">/{{ $page->slug }}</span></p>
  </div>

  <div style="display: flex; gap: 8px;">
    <a href="{{ route(in_array($page->page_key, ['about', 'about-us']) ? 'about.index' : 'contact.index') }}" target="_blank" class="btn btn-secondary btn-sm">
      <span>Lihat di Website Publik &nearr;</span>
    </a>
    <a href="{{ route('backoffice.pages.index') }}" class="btn btn-secondary btn-sm">&larr; Kembali</a>
  </div>
</div>

<div class="panel-card" style="max-width: 960px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.pages.update', $page->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label class="form-label">Judul Halaman <span style="color: #DC2626;">*</span></label>
        <input type="text" name="title" value="{{ old('title', $page->title) }}" required>
      </div>

      @if(in_array($page->page_key, ['about', 'about-us']))
        <div style="background: #F8FAFC; border: 1px solid var(--color-border); border-radius: 12px; padding: 18px; margin-bottom: 24px;">
          <h3 style="font-size: 13px; font-weight: 700; color: #0F172A; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 14px;">
            Bagian Terstruktur Profil Perusahaan
          </h3>

          <div class="form-group">
            <label class="form-label">Visi Perusahaan</label>
            <textarea name="sections[vision]" rows="2">{{ old('sections.vision', $page->sections_data['vision'] ?? '') }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Misi Perusahaan</label>
            <textarea name="sections[mission]" rows="3">{{ old('sections.mission', $page->sections_data['mission'] ?? '') }}</textarea>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Uraian Sejarah Singkat Perusahaan</label>
            <textarea name="sections[history]" rows="3">{{ old('sections.history', $page->sections_data['history'] ?? '') }}</textarea>
          </div>
        </div>
      @endif

      <div class="form-group">
        <label class="form-label">Konten Narasi Lengkap (HTML)</label>
        <textarea name="content_html" rows="10" class="wysiwyg-editor">{{ old('content_html', $page->content_html) }}</textarea>
        <span class="form-hint">Mendukung format HTML standar (p, h2, h3, ul, ol, strong, em).</span>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label class="form-label">Meta Title (SEO)</label>
          <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="Judul pada mesin pencari">
        </div>

        <div class="form-group">
          <label class="form-label">Status Publikasi</label>
          <select name="status">
            <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Published (Ditampilkan)</option>
            <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draft (Disimpan Sementara)</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Meta Description (SEO)</label>
        <textarea name="meta_description" rows="2" placeholder="Deskripsi ringkas untuk Google Search">{{ old('meta_description', $page->meta_description) }}</textarea>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--color-border);">
        <a href="{{ route('backoffice.pages.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
