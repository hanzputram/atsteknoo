@extends('backoffice.layouts.app')

@section('title', 'Tracking Klik ListrikOnline')
@section('breadcrumb', 'Tracking ListrikOnline')

@push('styles')
<style>
  .btn-table-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 32px;
    padding: 0 11px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.15s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease, box-shadow 0.15s ease;
    will-change: transform;
    box-sizing: border-box;
    cursor: pointer;
    line-height: 1;
    white-space: nowrap;
  }
  .btn-table-action-square {
    width: 32px;
    height: 32px;
    padding: 0;
    flex-shrink: 0;
  }
  .btn-table-action-store {
    background: #FFF1F2;
    color: #E11D48;
    border: 1px solid #FECDD3;
    font-weight: 700;
  }
  .btn-table-action-store:hover {
    background: #FFE4E6;
    border-color: #FDA4AF;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(225, 29, 72, 0.15);
  }
  .btn-table-action-default {
    background: #FFFFFF;
    color: #334155;
    border: 1px solid #CBD5E1;
  }
  .btn-table-action-default:hover {
    background: #F8FAFC;
    color: #0F172A;
    border-color: #94A3B8;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.06);
  }
  .btn-table-action-reset {
    background: #FFFFFF;
    color: #64748B;
    border: 1px solid #CBD5E1;
  }
  .btn-table-action-reset:hover {
    background: #FEF2F2;
    color: #DC2626;
    border-color: #FCA5A5;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(220, 38, 38, 0.12);
  }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
  <div>
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
      <span style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 10px; background: #FFF1F2; border: 1px solid #FECDD3; color: #E11D48;">
        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
      </span>
      <h1 class="page-title" style="margin-bottom: 0;">Tracking Klik &ldquo;Buy at ListrikOnline&rdquo;</h1>
    </div>
    <p class="page-subtitle">Pantau intensitas pengunjung yang mengklik tombol pembelian <strong>Buy at ListrikOnline</strong> per produk secara akurat dan real-time.</p>
  </div>

  <div style="display: flex; gap: 10px; flex-wrap: wrap;">
    <a href="{{ route('backoffice.tracking.listrikonline.export') }}" class="btn btn-secondary" style="border-color: #CBD5E1; display: inline-flex; align-items: center; gap: 6px;">
      <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
      Export Laporan CSV
    </a>
    <a href="https://listrikonline.com" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="color: #E11D48; border-color: #FECDD3; background: #FFF1F2; display: inline-flex; align-items: center; gap: 6px;">
      <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
      <span>Kunjungi ListrikOnline.com</span>
      <svg style="width: 13px; height: 13px; opacity: 0.8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
    </a>
  </div>
</div>

@if(session('success'))
<div style="padding: 14px 18px; background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46; border-radius: 12px; margin-bottom: 20px; font-size: 13.5px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
  <svg style="width: 18px; height: 18px; color: #059669; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
  {{ session('success') }}
</div>
@endif

<!-- Key Stat Cards Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 16px; margin-bottom: 24px;">
  <!-- Total All-Time Clicks -->
  <div class="panel-card" style="padding: 20px; position: relative; overflow: hidden; border-left: 4px solid #E11D48;">
    <div style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Total Klik Sepanjang Waktu</div>
    <div style="font-size: 30px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">
      {{ number_format($totalAllClicks) }}
    </div>
    <div style="font-size: 12px; color: #64748B; display: flex; align-items: center; gap: 6px;">
      <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #E11D48;"></span>
      Seluruh akumulasi outbound clicks
    </div>
  </div>

  <!-- Today Clicks -->
  <div class="panel-card" style="padding: 20px; border-left: 4px solid #059669; background: #F0FDF4;">
    <div style="font-size: 11.5px; font-weight: 700; color: #047857; text-transform: uppercase; letter-spacing: 0.05em;">Klik Hari Ini</div>
    <div style="font-size: 30px; font-weight: 800; font-family: var(--font-heading); color: #065F46; margin: 6px 0;">
      +{{ number_format($todayClicks) }}
    </div>
    <div style="font-size: 12px; color: #047857; font-weight: 600;">
      Aktivitas pengunjung hari ini
    </div>
  </div>

  <!-- Last 7 Days Clicks -->
  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">7 Hari Terakhir</div>
    <div style="font-size: 30px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">
      {{ number_format($last7DaysClicks) }}
    </div>
    <div style="font-size: 12px; color: #64748B;">
      Tren klik 1 minggu ke belakang
    </div>
  </div>

  <!-- This Month Clicks -->
  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Bulan Ini</div>
    <div style="font-size: 30px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">
      {{ number_format($thisMonthClicks) }}
    </div>
    <div style="font-size: 12px; color: #64748B;">
      Periode {{ now()->translatedFormat('F Y') }}
    </div>
  </div>

  <!-- Product Conversion Coverage -->
  <div class="panel-card" style="padding: 20px;">
    <div style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Produk Pernah Diklik</div>
    <div style="font-size: 30px; font-weight: 800; font-family: var(--font-heading); color: #0F172A; margin: 6px 0;">
      {{ number_format($clickedProductsCount) }} <span style="font-size: 14px; font-weight: 600; color: #94A3B8;">/ {{ number_format($totalProductsCount) }}</span>
    </div>
    <div style="font-size: 12px; color: #64748B;">
      @php
        $clickRate = $totalProductsCount > 0 ? round(($clickedProductsCount / $totalProductsCount) * 100, 1) : 0;
      @endphp
      <strong>{{ $clickRate }}%</strong> varian katalog diminati
    </div>
  </div>
</div>

<!-- Star Performer Highlight (If Any Product Has Clicks) -->
@if($topStarProduct && $topStarProduct->listrikonline_clicks > 0)
<div class="panel-card" style="padding: 20px 24px; margin-bottom: 24px; background: linear-gradient(135deg, #FFF1F2 0%, #FFFFFF 100%); border: 1px solid #FECDD3;">
  <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
    <div style="display: flex; align-items: center; gap: 18px;">
      <div style="width: 58px; height: 58px; border-radius: 12px; background: #FFFFFF; border: 1px solid #FECDD3; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 4px; flex-shrink: 0; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.08);">
        @if($topStarProduct->main_image_url)
          <img src="{{ $topStarProduct->main_image_url }}" alt="{{ $topStarProduct->name }}" style="width: 100%; height: 100%; object-fit: contain;">
        @else
          <svg style="width: 24px; height: 24px; color: #FDA4AF;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        @endif
      </div>
      <div>
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 3px;">
          <span style="background: #E11D48; color: #FFFFFF; font-size: 10.5px; font-weight: 800; padding: 2px 8px; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-flex; align-items: center; gap: 4px;">
            <svg style="width: 12px; height: 12px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            Top #1 Paling Diminati
          </span>
          <span style="font-family: monospace; font-size: 12px; font-weight: 700; color: #9F1239; background: #FFE4E6; padding: 2px 6px; border-radius: 4px;">{{ $topStarProduct->sku }}</span>
        </div>
        <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0 0 2px 0;">
          <a href="{{ route('backoffice.products.edit', $topStarProduct->id) }}" style="color: inherit; text-decoration: none;">{{ $topStarProduct->name }}</a>
        </h3>
        <div style="font-size: 12px; color: #64748B;">
          Brand: <strong>{{ $topStarProduct->brand ? $topStarProduct->brand->name : '-' }}</strong> &bull; Terakhir diklik: <strong>{{ $topStarProduct->last_clicked_at ? $topStarProduct->last_clicked_at->diffForHumans() : '-' }}</strong>
        </div>
      </div>
    </div>

    <div style="display: flex; align-items: center; gap: 16px;">
      <div style="text-align: right;">
        <div style="font-size: 11px; font-weight: 700; color: #9F1239; text-transform: uppercase;">Total Klik Terkumpul</div>
        <div style="font-size: 26px; font-weight: 800; font-family: var(--font-heading); color: #E11D48;">
          {{ number_format($topStarProduct->listrikonline_clicks) }} <span style="font-size: 13px; font-weight: 700;">KLIK</span>
        </div>
      </div>
      <a href="{{ $topStarProduct->listrikonline_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
        <span>Buka di ListrikOnline</span>
        <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      </a>
    </div>
  </div>
</div>
@endif

<!-- Search & Filters Panel -->
<div class="panel-card" style="margin-bottom: 24px;">
  <div class="panel-body" style="padding: 16px 20px;">
    <form method="GET" action="{{ route('backoffice.tracking.listrikonline') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
      <!-- Search input -->
      <div style="flex: 1; min-width: 240px;">
        <input type="text" name="search" class="form-control" placeholder="Cari nama produk atau SKU..." value="{{ request('search') }}">
      </div>

      <!-- Brand filter -->
      <div style="width: 180px;">
        <select name="brand_id" class="form-control">
          <option value="">Semua Brand</option>
          @foreach($brands as $b)
            <option value="{{ $b->id }}" {{ request('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Category filter -->
      <div style="width: 200px;">
        <select name="category_id" class="form-control">
          <option value="">Semua Kategori</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Clicks Filter -->
      <div style="width: 170px;">
        <select name="clicks_filter" class="form-control">
          <option value="with_clicks" {{ request('clicks_filter', 'with_clicks') === 'with_clicks' ? 'selected' : '' }}>Pernah Diklik (> 0)</option>
          <option value="all" {{ request('clicks_filter') === 'all' ? 'selected' : '' }}>Semua Produk Katalog</option>
          <option value="zero_clicks" {{ request('clicks_filter') === 'zero_clicks' ? 'selected' : '' }}>Belum Pernah Diklik (0)</option>
        </select>
      </div>

      <!-- Sort Order -->
      <div style="width: 190px;">
        <select name="sort" class="form-control">
          <option value="clicks_desc" {{ request('sort', 'clicks_desc') === 'clicks_desc' ? 'selected' : '' }}>Urutan: Terbanyak Diklik</option>
          <option value="clicks_asc" {{ request('sort') === 'clicks_asc' ? 'selected' : '' }}>Urutan: Paling Sedikit Diklik</option>
          <option value="last_clicked_desc" {{ request('sort') === 'last_clicked_desc' ? 'selected' : '' }}>Urutan: Baru Saja Diklik</option>
          <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Nama Produk (A-Z)</option>
          <option value="sku_asc" {{ request('sort') === 'sku_asc' ? 'selected' : '' }}>SKU (A-Z)</option>
        </select>
      </div>

      <button type="submit" class="btn btn-secondary">Filter</button>
      @if(request()->anyFilled(['search', 'brand_id', 'category_id', 'clicks_filter', 'sort']))
        <a href="{{ route('backoffice.tracking.listrikonline') }}" class="btn btn-secondary" style="color: #DC2626;">Reset</a>
      @endif
    </form>
  </div>
</div>

<div style="display: grid; grid-template-columns: 1fr; gap: 24px;">

  <!-- Main Leaderboard Table Panel -->
  <div class="panel-card">
    <div style="padding: 18px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between;">
      <div>
        <h2 style="font-size: 16px; font-weight: 700; color: #0F172A;">Peringkat Produk Berdasarkan Klik ListrikOnline</h2>
        <p style="font-size: 12px; color: #64748B; margin-top: 2px;">Menampilkan urutan produk yang paling sering memicu konversi pembelian ke ListrikOnline.</p>
      </div>
      <span class="badge badge-neutral" style="font-size: 12px; font-weight: 700;">
        {{ number_format($products->total()) }} Produk Terdata
      </span>
    </div>

    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">Rank</th>
            <th style="width: 60px;">Foto</th>
            <th>SKU</th>
            <th>Nama Produk</th>
            <th>Brand</th>
            <th>Kategori Utama</th>
            <th style="text-align: center;">Total Klik</th>
            <th>Terakhir Diklik</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $currentRank = ($products->currentPage() - 1) * $products->perPage() + 1;
          @endphp
          @forelse($products as $p)
            <tr>
              <td style="text-align: center;">
                @if($currentRank === 1 && $p->listrikonline_clicks > 0)
                  <span style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; min-width: 44px; height: 26px; border-radius: 9999px; background: #FEF3C7; color: #B45309; font-weight: 800; font-size: 11.5px; border: 1px solid #FDE68A; padding: 0 8px;" title="Peringkat 1">
                    <svg style="width: 13px; height: 13px; color: #D97706; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9H3a2 2 0 01-2-2V5a2 2 0 012-2h3m12 6h3a2 2 0 002-2V5a2 2 0 00-2-2h-3M6 3h12v7a6 6 0 01-12 0V3zm3 15h6m-3-3v3m-4 3h8"/></svg>
                    <span>#1</span>
                  </span>
                @elseif($currentRank === 2 && $p->listrikonline_clicks > 0)
                  <span style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; min-width: 44px; height: 26px; border-radius: 9999px; background: #F1F5F9; color: #334155; font-weight: 800; font-size: 11.5px; border: 1px solid #CBD5E1; padding: 0 8px;" title="Peringkat 2">
                    <svg style="width: 13px; height: 13px; color: #64748B; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9H3a2 2 0 01-2-2V5a2 2 0 012-2h3m12 6h3a2 2 0 002-2V5a2 2 0 00-2-2h-3M6 3h12v7a6 6 0 01-12 0V3zm3 15h6m-3-3v3m-4 3h8"/></svg>
                    <span>#2</span>
                  </span>
                @elseif($currentRank === 3 && $p->listrikonline_clicks > 0)
                  <span style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; min-width: 44px; height: 26px; border-radius: 9999px; background: #FFEDD5; color: #C2410C; font-weight: 800; font-size: 11.5px; border: 1px solid #FDBA74; padding: 0 8px;" title="Peringkat 3">
                    <svg style="width: 13px; height: 13px; color: #EA580C; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9H3a2 2 0 01-2-2V5a2 2 0 012-2h3m12 6h3a2 2 0 002-2V5a2 2 0 00-2-2h-3M6 3h12v7a6 6 0 01-12 0V3zm3 15h6m-3-3v3m-4 3h8"/></svg>
                    <span>#3</span>
                  </span>
                @else
                  <span style="font-weight: 700; color: #64748B; font-size: 12.5px;">#{{ $currentRank }}</span>
                @endif
              </td>
              <td>
                <div style="width: 44px; height: 44px; border-radius: 8px; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; background: #F8FAFC; overflow: hidden;">
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
                <div style="font-weight: 700; color: #0F172A; line-height: 1.35;">
                  <a href="{{ route('backoffice.products.edit', $p->id) }}" style="color: inherit; text-decoration: none;">
                    {{ $p->name }}
                  </a>
                </div>
                @if($p->short_description)
                  <div style="font-size: 11.5px; color: #64748B; margin-top: 3px; line-height: 1.4;">{{ Str::limit($p->short_description, 60) }}</div>
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
              <td style="text-align: center;">
                @if($p->listrikonline_clicks > 0)
                  <span style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 999px; background: #FFF1F2; border: 1px solid #FECDD3; color: #E11D48; font-weight: 800; font-size: 13.5px; box-shadow: 0 1px 3px rgba(225, 29, 72, 0.08);">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    {{ number_format($p->listrikonline_clicks) }}
                  </span>
                @else
                  <span style="color: #CBD5E1; font-size: 12.5px; font-weight: 600;">0 klik</span>
                @endif
              </td>
              <td>
                @if($p->last_clicked_at)
                  <div style="font-size: 12px; font-weight: 600; color: #0F172A;">
                    {{ $p->last_clicked_at->diffForHumans() }}
                  </div>
                  <div style="font-size: 10.5px; color: #94A3B8;">
                    {{ $p->last_clicked_at->format('d M Y H:i') }}
                  </div>
                @else
                  <span style="color: #94A3B8; font-size: 12px;">Belum pernah</span>
                @endif
              </td>
              <td style="text-align: right; white-space: nowrap;">
                <div style="display: inline-flex; gap: 6px; align-items: center; justify-content: flex-end;">
                  <a href="{{ $p->listrikonline_url }}" target="_blank" rel="noopener noreferrer" class="btn-table-action btn-table-action-store" title="Buka produk langsung di ListrikOnline.com">
                    <svg style="width: 14px; height: 14px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <span>Beli</span>
                    <svg style="width: 12px; height: 12px; flex-shrink: 0; opacity: 0.8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                  </a>
                  @if($p->isPublished())
                    <a href="{{ route('products.show', $p->slug) }}" target="_blank" class="btn-table-action btn-table-action-square btn-table-action-default" title="Lihat di Web Publik ATS">
                      <svg style="width: 16px; height: 16px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                      </svg>
                    </a>
                  @endif
                  <a href="{{ route('backoffice.products.edit', $p->id) }}" class="btn-table-action btn-table-action-default" title="Edit Data Produk">
                    <svg style="width: 13px; height: 13px; flex-shrink: 0; color: #64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit</span>
                  </a>
                  @if(auth()->user()->isAdmin() && $p->listrikonline_clicks > 0)
                    <form action="{{ route('backoffice.tracking.listrikonline.reset', $p->id) }}" method="POST" onsubmit="return confirm('Reset counter klik untuk {{ $p->sku }} ke 0?')" style="display: inline; margin: 0;">
                      @csrf
                      <button type="submit" class="btn-table-action btn-table-action-square btn-table-action-reset" title="Reset Counter Klik ke 0">
                        <svg style="width: 15px; height: 15px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                      </button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
            @php $currentRank++; @endphp
          @empty
            <tr>
              <td colspan="9" style="text-align: center; padding: 48px; color: #94A3B8;">
                <svg style="width: 38px; height: 38px; color: #CBD5E1; margin: 0 auto 8px auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <div style="font-weight: 700; color: #334155; font-size: 14px;">Tidak ada data produk yang cocok.</div>
                <div style="font-size: 12px; margin-top: 4px;">Coba gunakan kata kunci pencarian lain atau ubah filter status klik di atas.</div>
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

  <!-- Live Recent Click Event Logs Feed -->
  <div class="panel-card">
    <div style="padding: 18px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between;">
      <div>
        <h2 style="font-size: 16px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
          <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #10B981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);"></span>
          Log Aktivitas Klik Terkini (Real-Time Feed)
        </h2>
        <p style="font-size: 12px; color: #64748B; margin-top: 2px;">Audit trail 30 aksi klik terakhir tombol &ldquo;Buy at ListrikOnline&rdquo; oleh pengunjung.</p>
      </div>
      <span style="font-size: 12px; color: #64748B;">
        Total Log Terakhir: <strong>{{ $recentLogs->count() }}</strong>
      </span>
    </div>

    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>Waktu Klik (WIB)</th>
            <th>Produk Terkait</th>
            <th>Brand</th>
            <th>Perangkat / Browser</th>
            <th>IP Address</th>
            <th>Halaman Asal (Referer)</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentLogs as $log)
            <tr>
              <td style="white-space: nowrap; font-size: 12px;">
                <div style="font-weight: 700; color: #0F172A;">{{ $log->created_at->format('d M Y H:i:s') }}</div>
                <div style="font-size: 11px; color: #059669; font-weight: 600;">{{ $log->created_at->diffForHumans() }}</div>
              </td>
              <td>
                @if($log->product)
                  <div style="font-weight: 700; color: #0F172A;">
                    <a href="{{ route('backoffice.products.edit', $log->product->id) }}" style="color: inherit; text-decoration: none;">
                      {{ $log->product->name }}
                    </a>
                  </div>
                  <span style="font-family: monospace; font-size: 11px; color: #64748B; background: #F1F5F9; padding: 2px 5px; border-radius: 4px;">{{ $log->sku ?: $log->product->sku }}</span>
                @else
                  <span style="font-family: monospace; font-size: 12px; color: #64748B;">{{ $log->sku }}</span>
                  <span style="color: #94A3B8; font-size: 11px;">(Produk telah dihapus)</span>
                @endif
              </td>
              <td>
                @if($log->product && $log->product->brand)
                  <span class="badge badge-neutral">{{ $log->product->brand->name }}</span>
                @else
                  <span style="color: #94A3B8;">-</span>
                @endif
              </td>
              <td style="font-size: 12px;">
                <span class="badge badge-neutral" style="font-size: 11px; font-weight: 600;">
                  {{ $log->device_type }} &bull; {{ $log->browser }}
                </span>
              </td>
              <td style="font-family: monospace; font-size: 11.5px; color: #64748B;">
                {{ $log->ip_address ?: 'Unknown IP' }}
              </td>
              <td style="font-size: 11.5px; color: #64748B; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                @if($log->referer)
                  <span title="{{ $log->referer }}">{{ parse_url($log->referer, PHP_URL_PATH) ?: $log->referer }}</span>
                @else
                  <span style="color: #CBD5E1;">Direct / Direct Click</span>
                @endif
              </td>
              <td style="text-align: right;">
                @if($log->product)
                  <a href="{{ $log->product->listrikonline_url }}" target="_blank" rel="noopener noreferrer" class="btn-table-action btn-table-action-square btn-table-action-store" title="Cek di ListrikOnline">
                    <svg style="width: 14px; height: 14px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                  </a>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 36px; color: #94A3B8;">
                Belum ada rekaman klik yang tercatat di log audit.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
