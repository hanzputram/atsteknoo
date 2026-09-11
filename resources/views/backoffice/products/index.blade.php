@extends('backoffice.layouts.app')

@section('title', 'Master Produk')
@section('breadcrumb', 'Master Produk')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Master Produk Katalog</h1>
    <p class="page-subtitle">Kelola spesifikasi teknis, media foto, dan publikasi komponen elektrikal.</p>
  </div>

  <div style="display: flex; gap: 10px;">
    <a href="{{ route('backoffice.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    <a href="{{ route('backoffice.import.index') }}" class="btn btn-secondary">📥 Import Excel</a>
    <a href="{{ route('backoffice.import.export') }}" class="btn btn-secondary">📤 Export XLSX</a>
  </div>
</div>

<!-- Search & Filters Panel -->
<div class="panel-card">
  <div class="panel-body" style="padding: 16px 20px;">
    <form method="GET" action="{{ route('backoffice.products.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
      <div style="flex: 1; min-width: 220px;">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau SKU produk..." value="{{ request('search') }}">
      </div>

      <div style="width: 180px;">
        <select name="brand_id" class="form-control">
          <option value="">Semua Brand</option>
          @foreach($brands as $b)
            <option value="{{ $b->id }}" {{ request('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
          @endforeach
        </select>
      </div>

      <div style="width: 200px;">
        <select name="category_id" class="form-control">
          <option value="">Semua Kategori</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div style="width: 140px;">
        <select name="status" class="form-control">
          <option value="">Semua Status</option>
          <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
          <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
          <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
      </div>

      <div style="width: 150px;">
        <select name="is_featured" class="form-control">
          <option value="">Semua Unggulan</option>
          <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>★ Best Seller Saja</option>
          <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>Bukan Best Seller</option>
        </select>
      </div>

      <button type="submit" class="btn btn-secondary">Filter</button>
      @if(request()->anyFilled(['search', 'brand_id', 'category_id', 'status', 'is_featured']))
        <a href="{{ route('backoffice.products.index') }}" class="btn btn-secondary" style="color: #DC2626;">Reset</a>
      @endif
    </form>
  </div>
</div>

<!-- Products Table -->
<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 70px;">Foto</th>
          <th>SKU</th>
          <th>Nama Produk</th>
          <th>Brand</th>
          <th>Kategori Utama</th>
          <th>Status</th>
          <th>Terakhir Diperbarui</th>
          <th style="text-align: right;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
          <tr>
            <td>
              <div style="width: 48px; height: 48px; border-radius: 8px; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; background: #F8FAFC; overflow: hidden;">
                @if($p->mainImage)
                  <img src="{{ route('media.view', $p->mainImage->id) }}" alt="{{ $p->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                @else
                  <span style="font-size: 18px; color: #CBD5E1;">⚡</span>
                @endif
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-weight: 700; color: #0F172A; background: #F1F5F9; padding: 4px 8px; border-radius: 4px; white-space: nowrap; font-size: 12px; display: inline-block;">{{ $p->sku }}</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A; line-height: 1.35; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                <a href="{{ route('backoffice.products.edit', $p->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $p->name }}
                </a>
                @if($p->is_featured)
                  <span style="display: inline-flex; align-items: center; gap: 3px; padding: 2px 7px; background: #FFE4E6; color: #E11D48; font-size: 10.5px; font-weight: 700; border-radius: 999px; border: 1px solid #FECDD3;" title="Tampil di Home Best Seller">
                    ★ Best Seller
                  </span>
                @endif
              </div>
              @if($p->short_description)
                <div style="font-size: 12px; color: #64748B; margin-top: 4px; line-height: 1.4;">{{ Str::limit($p->short_description, 70) }}</div>
              @endif
            </td>
            <td>
              @if($p->brand)
                <span class="badge badge-neutral">{{ $p->brand->name }}</span>
              @else
                <span style="color: #94A3B8;">-</span>
              @endif
            </td>
            <td>
              @if($p->primaryCategory)
                <span style="font-size: 12px; font-weight: 600; color: #334155;">{{ $p->primaryCategory->name }}</span>
              @else
                <span style="color: #94A3B8;">-</span>
              @endif
            </td>
            <td>
              <span class="badge {{ $p->status === 'published' ? 'badge-success' : ($p->status === 'draft' ? 'badge-warning' : 'badge-neutral') }}">
                {{ $p->status }}
              </span>
            </td>
            <td style="font-size: 12px; color: #64748B;">
              {{ $p->updated_at->format('d M Y H:i') }}
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                @if($p->isPublished())
                  <a href="{{ route('products.show', $p->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat Halaman Publik">&nearr;</a>
                @endif
                <a href="{{ route('backoffice.products.edit', $p->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('backoffice.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $p->name }}?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" style="text-align: center; padding: 36px; color: #94A3B8;">
              Tidak ada produk yang cocok dengan pencarian / filter.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($products->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
      {{ $products->links() }}
    </div>
  @endif
</div>
@endsection
