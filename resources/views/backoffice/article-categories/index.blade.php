@extends('backoffice.layouts.app')

@section('title', 'Kategori Artikel')
@section('breadcrumb', 'Kategori Artikel')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Daftar Kategori Artikel</h1>
    <p class="page-subtitle">Kelompokkan artikel blog, berita industri, dan edukasi teknik.</p>
  </div>

  <a href="{{ route('backoffice.article-categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 130px;">Kode</th>
          <th>Nama Kategori</th>
          <th>Slug URL</th>
          <th style="width: 140px;">Jumlah Artikel</th>
          <th style="width: 80px;">Urutan</th>
          <th style="width: 100px;">Status</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $cat)
          <tr>
            <td>
              <span style="font-family: monospace; font-weight: 700; color: #0F172A; background: #F1F5F9; padding: 3px 8px; border-radius: 4px;">{{ $cat->code }}</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A;">
                <a href="{{ route('backoffice.article-categories.edit', $cat->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $cat->name }}
                </a>
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 12px; color: #64748B;">/articles/kategori/{{ $cat->slug }}</span>
            </td>
            <td>
              <span class="badge badge-info">{{ $cat->articles_count }} Artikel</span>
            </td>
            <td>
              <span style="font-weight: 600; color: #475569;">{{ $cat->sort_order }}</span>
            </td>
            <td>
              <span class="badge {{ $cat->is_active ? 'badge-success' : 'badge-neutral' }}">
                {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('backoffice.article-categories.edit', $cat->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                @if(auth()->user()->isAdmin())
                  <form action="{{ route('backoffice.article-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $cat->name }}?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 36px; color: #94A3B8;">Belum ada kategori artikel. Silakan tambah kategori baru.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
