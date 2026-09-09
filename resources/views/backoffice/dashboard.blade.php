@extends('backoffice.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Selamat Datang, {{ auth()->user()->name }}</h1>
    <p class="page-subtitle">Ringkasan status katalog produk, portofolio proyek, dan editorial konten PT. Anugerah Tama Sejati.</p>
  </div>

  <div style="display: flex; gap: 10px;">
    <a href="{{ route('backoffice.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    <a href="{{ route('backoffice.import.index') }}" class="btn btn-secondary">📥 Import Excel</a>
  </div>
</div>

<!-- Key Stat Cards (Pure Catalog, Zero Sales Metrics) -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Total Produk</div>
    <div style="font-size: 28px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">{{ $stats['total_products'] }}</div>
    <div style="font-size: 12px; color: #059669; font-weight: 600;">{{ $stats['published_products'] }} Publik &bull; {{ $stats['draft_products'] }} Draft</div>
  </div>

  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Portofolio Project</div>
    <div style="font-size: 28px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">{{ $stats['total_projects'] }}</div>
    <div style="font-size: 12px; color: #64748B;">Instalasi &amp; engineering</div>
  </div>

  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Artikel &amp; Panduan</div>
    <div style="font-size: 28px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">{{ $stats['total_articles'] }}</div>
    <div style="font-size: 12px; color: #64748B;">Publikasi teknis</div>
  </div>

  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Brand Resmi</div>
    <div style="font-size: 28px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">{{ $stats['total_brands'] }}</div>
    <div style="font-size: 12px; color: #64748B;">Mitra authorized dealer</div>
  </div>

  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Pesan Masuk</div>
    <div style="font-size: 28px; font-weight: 800; font-family: var(--font-heading); color: {{ $stats['unread_inquiries'] > 0 ? '#E11D48' : '#0F172A' }}; margin: 6px 0;">
      {{ $stats['unread_inquiries'] }}
    </div>
    <div style="font-size: 12px; color: #64748B;">Belum dibaca</div>
  </div>
</div>

<!-- Two-Column Grid: Recent Products & Recent Activity -->
<div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 24px; align-items: start;">

  <!-- Left: Recent Products -->
  <div class="panel-card">
    <div style="padding: 18px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between;">
      <h2 style="font-size: 16px; font-weight: 700;">Produk Baru / Terakhir Diperbarui</h2>
      <a href="{{ route('backoffice.products.index') }}" style="font-size: 12.5px; font-weight: 600; color: var(--color-primary); text-decoration: none;">Lihat Semua &rarr;</a>
    </div>

    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Nama Produk</th>
            <th>Brand</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentProducts as $p)
            <tr>
              <td><span style="font-family: monospace; font-weight: 700; color: #0F172A;">{{ $p->sku }}</span></td>
              <td><a href="{{ route('backoffice.products.edit', $p->id) }}" style="color: inherit; font-weight: 600; text-decoration: none;">{{ $p->name }}</a></td>
              <td><span class="badge badge-neutral">{{ $p->brand ? $p->brand->name : '-' }}</span></td>
              <td>
                <span class="badge {{ $p->status === 'published' ? 'badge-success' : 'badge-warning' }}">
                  {{ $p->status }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" style="text-align: center; color: #94A3B8; padding: 24px;">Belum ada produk terdaftar.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Right: Recent Activity Logs -->
  <div class="panel-card">
    <div style="padding: 18px 24px; border-bottom: 1px solid var(--color-border);">
      <h2 style="font-size: 16px; font-weight: 700;">Aktivitas Perubahan Terbaru</h2>
    </div>

    <div style="padding: 16px 24px; display: flex; flex-direction: column; gap: 14px;">
      @forelse($recentLogs as $log)
        <div style="display: flex; align-items: flex-start; gap: 12px; font-size: 13px;">
          <span style="background: #F1F5F9; border-radius: 6px; padding: 3px 6px; font-size: 11px; font-weight: 700;">{{ $log->action }}</span>
          <div style="flex: 1;">
            <span style="font-weight: 600; color: #0F172A;">{{ $log->entity_type }} #{{ $log->entity_id }}</span>
            <div style="font-size: 11.5px; color: #64748B;">
              oleh {{ $log->user ? $log->user->name : 'Sistem' }} &bull; {{ $log->created_at->diffForHumans() }}
            </div>
          </div>
        </div>
      @empty
        <div style="color: #94A3B8; font-size: 13px; text-align: center; padding: 12px;">Belum ada log aktivitas.</div>
      @endforelse
    </div>
  </div>

</div>
@endsection
