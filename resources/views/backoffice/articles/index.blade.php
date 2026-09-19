@extends('backoffice.layouts.app')

@section('title', 'Artikel & Panduan')
@section('breadcrumb', 'Artikel & Panduan')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Artikel &amp; Panduan Teknis</h1>
    <p class="page-subtitle">Kelola artikel edukasi, berita produk, dan wawasan engineering.</p>
  </div>

  <a href="{{ route('backoffice.articles.create') }}" class="btn btn-primary">+ Tulis Artikel</a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 70px;">Thumbnail</th>
          <th>Judul Artikel</th>
          <th>Kategori</th>
          <th>Penulis</th>
          <th>Status Publikasi</th>
          <th>Tanggal Rilis</th>
          <th style="text-align: right;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($articles as $art)
          <tr>
            <td>
              <div style="width: 52px; height: 38px; border-radius: 6px; border: 1px solid #E2E8F0; background: #F8FAFC; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                @if($art->thumbnail)
                  <img src="{{ route('media.view', $art->thumbnail->id) }}" alt="{{ $art->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                @elseif(!empty($art->image_url))
                  <img src="{{ $art->image_url }}" alt="{{ $art->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size: 14px; color: #CBD5E1;\'>📰</span>';">
                @else
                  <span style="font-size: 14px; color: #CBD5E1;">📰</span>
                @endif
              </div>
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A;">
                <a href="{{ route('backoffice.articles.edit', $art->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $art->title }}
                </a>
              </div>
              <div style="font-size: 11.5px; color: #64748B;">/articles/{{ $art->slug }}</div>
            </td>
            <td>
              @if($art->category)
                <span class="badge badge-neutral">{{ $art->category->name }}</span>
              @else
                <span style="color: #94A3B8;">-</span>
              @endif
            </td>
            <td style="font-size: 13px; color: #334155;">
              {{ $art->effective_author_name }}
            </td>
            <td>
              @if($art->isScheduled())
                <span class="badge badge-info">Terjadwal</span>
              @elseif($art->isPublished())
                <span class="badge badge-success">Published</span>
              @else
                <span class="badge badge-warning">{{ $art->status }}</span>
              @endif
            </td>
            <td style="font-size: 12px; color: #64748B;">
              {{ $art->published_at ? $art->published_at->format('d M Y H:i') : '-' }}
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                @if($art->isPublished())
                  <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat Halaman Publik">&nearr;</a>
                @endif
                <a href="{{ route('backoffice.articles.edit', $art->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('backoffice.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Hapus artikel {{ $art->title }}?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 32px; color: #94A3B8;">Belum ada artikel.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($articles->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
      {{ $articles->links() }}
    </div>
  @endif
</div>
@endsection
