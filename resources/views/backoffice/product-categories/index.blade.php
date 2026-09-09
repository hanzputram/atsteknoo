@extends('backoffice.layouts.app')

@section('title', 'Kategori Produk')
@section('breadcrumb', 'Kategori Produk')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Kategori Produk</h1>
    <p class="page-subtitle">Kelola klasifikasi dan hierarki kategori komponen.</p>
  </div>

  <a href="{{ route('backoffice.product-categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Kode Kategori</th>
          <th>Nama Kategori</th>
          <th>Parent Kategori</th>
          <th>Jumlah Produk</th>
          <th>Status</th>
          <th style="text-align: right;">Aksi</th>
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
                <a href="{{ route('backoffice.product-categories.edit', $cat->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $cat->name }}
                </a>
              </div>
              <div style="font-size: 11.5px; color: #64748B;">Slug: /product-categories/{{ $cat->slug }}</div>
            </td>
            <td>
              @if($cat->parent)
                <span class="badge badge-neutral">{{ $cat->parent->name }}</span>
              @else
                <span style="color: #94A3B8; font-size: 12px;">(Kategori Utama)</span>
              @endif
            </td>
            <td>
              <span class="badge badge-info">{{ $cat->products_count }} Produk</span>
            </td>
            <td>
              <span class="badge {{ $cat->is_active ? 'badge-success' : 'badge-neutral' }}">
                {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('product-categories.show', $cat->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat Halaman Publik">&nearr;</a>
                <a href="{{ route('backoffice.product-categories.edit', $cat->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('backoffice.product-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $cat->name }}?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 32px; color: #94A3B8;">Belum ada kategori produk terdaftar.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
