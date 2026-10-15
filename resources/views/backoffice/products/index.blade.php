@extends('backoffice.layouts.app')

@section('title', 'Master Produk')
@section('breadcrumb', 'Master Produk')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Master Produk Katalog</h1>
    <p class="page-subtitle">Kelola spesifikasi teknis, media foto, dan publikasi komponen elektrikal.</p>
  </div>

  <div style="display: flex; gap: 10px; flex-wrap: wrap;">
    <a href="{{ route('backoffice.tracking.listrikonline') }}" class="btn btn-secondary" style="border-color: #FECDD3; color: #E11D48; background: #FFF1F2; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
      <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
      <span>Tracking ListrikOnline</span>
    </a>
    <a href="{{ route('backoffice.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    <a href="{{ route('backoffice.import.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 6px;">
      <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
      <span>Import Excel</span>
    </a>
    <a href="{{ route('backoffice.import.export') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 6px;">
      <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
      <span>Export XLSX</span>
    </a>
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
          <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>Best Seller Saja</option>
          <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>Bukan Best Seller</option>
        </select>
      </div>

      <div style="width: 180px;">
        <select name="sort" class="form-control">
          <option value="updated_at" {{ request('sort') == 'updated_at' || !request('sort') ? 'selected' : '' }}>Urutan: Terakhir Diperbarui</option>
          <option value="listrikonline_clicks" {{ request('sort') == 'listrikonline_clicks' ? 'selected' : '' }}>Urutan: Terbanyak Diklik ListrikOnline</option>
          <option value="last_clicked_at" {{ request('sort') == 'last_clicked_at' ? 'selected' : '' }}>Urutan: Baru Diklik ListrikOnline</option>
          <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Urutan: Nama Produk (A-Z)</option>
          <option value="sku" {{ request('sort') == 'sku' ? 'selected' : '' }}>Urutan: SKU Produk (A-Z)</option>
        </select>
      </div>

      <div style="width: 150px;">
        <select name="clicks_only" class="form-control">
          <option value="">Semua Klik</option>
          <option value="1" {{ request('clicks_only') === '1' ? 'selected' : '' }}>Pernah Diklik (>0)</option>
        </select>
      </div>

      <button type="submit" class="btn btn-secondary">Filter</button>
      @if(request()->anyFilled(['search', 'brand_id', 'category_id', 'status', 'is_featured', 'sort', 'clicks_only']))
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
          <th style="text-align: center;">Klik ListrikOnline</th>
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
                @if($p->main_image_url)
                  <img src="{{ $p->main_image_url }}" alt="{{ $p->name }}" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.onerror=null; this.parentElement.innerHTML='<svg style=\'width: 20px; height: 20px; color: #94A3B8;\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.8\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'/></svg>'">
                @else
                  <svg style="width: 20px; height: 20px; color: #94A3B8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
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
                    <svg style="width: 10px; height: 10px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Best Seller
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
            <td style="text-align: center; white-space: nowrap;">
              @if($p->listrikonline_clicks > 0)
                <a href="{{ route('backoffice.tracking.listrikonline', ['search' => $p->sku]) }}" title="Lihat detail log klik produk {{ $p->sku }}" style="text-decoration: none;">
                  <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 999px; background: #FFF1F2; border: 1px solid #FECDD3; color: #E11D48; font-weight: 800; font-size: 12px;">
                    <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    {{ number_format($p->listrikonline_clicks) }}
                  </span>
                </a>
                @if($p->last_clicked_at)
                  <div style="font-size: 10px; color: #94A3B8; margin-top: 3px;" title="{{ $p->last_clicked_at->format('d M Y H:i') }}">
                    {{ $p->last_clicked_at->diffForHumans() }}
                  </div>
                @endif
              @else
                <span style="color: #CBD5E1; font-size: 12px; font-weight: 500;">0</span>
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
            <td style="text-align: right; white-space: nowrap;">
              <div style="display: inline-flex; gap: 6px; align-items: center; justify-content: flex-end;">
                @if($p->isPublished())
                  <a href="{{ route('products.show', $p->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat di Web Publik ATS" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; color: #475569;">
                    <svg style="width: 15px; height: 15px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                  </a>
                @endif
                <a href="{{ route('backoffice.products.edit', $p->id) }}" class="btn btn-secondary btn-sm" style="height: 32px; padding: 0 10px; display: inline-flex; align-items: center; gap: 5px; border-radius: 8px;">
                  <svg style="width: 13px; height: 13px; flex-shrink: 0; color: #64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  <span>Edit</span>
                </a>
                <form action="{{ route('backoffice.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $p->name }}?')" style="display: inline; margin: 0;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" style="height: 32px; padding: 0 10px; display: inline-flex; align-items: center; gap: 4px; border-radius: 8px;">
                    <svg style="width: 13px; height: 13px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>Hapus</span>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" style="text-align: center; padding: 36px; color: #94A3B8;">
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
