@extends('backoffice.layouts.app')

@section('title', 'Preview Rencana Impor #' . $job->id)
@section('breadcrumb', 'Preview Impor #' . $job->id)

@section('content')
<!-- Page Header -->
<div class="page-header">
  <div>
    <div style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--color-text-muted); margin-bottom: 6px;">
      <a href="{{ route('backoffice.import.index') }}" style="color: inherit; text-decoration: none;">Import Center</a>
      <span>&rsaquo;</span>
      <span style="font-weight: 600; color: var(--color-dark);">Job #{{ $job->id }}</span>
    </div>
    <h1 class="page-title">Validasi Rencana: {{ $job->file_name }}</h1>
    <p class="page-subtitle">Mode: <strong style="font-family: ui-monospace, monospace; text-transform: uppercase;">{{ $job->mode }}</strong> &bull; Diunggah oleh: {{ $job->user->name ?? 'Staf' }} &bull; {{ $job->created_at->format('d M Y, H:i') }}</p>
  </div>

  <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
    @if($job->error_report_path)
    <a href="{{ route('backoffice.import.error-report', $job->id) }}" class="btn btn-secondary" style="color: #DC2626; border-color: #FECACA; background: #FEF2F2;">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      <span>Unduh Laporan Error (.xlsx)</span>
    </a>
    @endif
    <a href="{{ route('backoffice.import.index') }}" class="btn btn-secondary">
      Kembali ke List
    </a>
  </div>
</div>

@php
    $createCount = 0;
    $updateCount = 0;
    $unchangedCount = 0;
    $errorCount = $job->error_rows;
    foreach($units as $u) {
        if (!empty($u['errors'])) {
            // count if per-unit errors
        } elseif (($u['action'] ?? '') === 'create') {
            $createCount++;
        } elseif (($u['action'] ?? '') === 'update') {
            $updateCount++;
        } else {
            $unchangedCount++;
        }
    }
@endphp

<!-- KPI Summary Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 14px;">
  <div class="panel-card" style="padding: 18px 20px;">
    <span style="font-size: 11.5px; font-weight: 600; color: var(--color-text-muted); text-transform: uppercase;">Total Unit Baris</span>
    <span style="display: block; font-size: 26px; font-weight: 800; color: var(--color-dark); margin-top: 4px;">{{ count($units) }}</span>
  </div>
  <div class="panel-card" style="padding: 18px 20px; border-left: 4px solid #059669;">
    <span style="font-size: 11.5px; font-weight: 600; color: #059669; text-transform: uppercase;">Akan Dibuat (New)</span>
    <span style="display: block; font-size: 26px; font-weight: 800; color: #059669; margin-top: 4px;">{{ $createCount }}</span>
  </div>
  <div class="panel-card" style="padding: 18px 20px; border-left: 4px solid #2563EB;">
    <span style="font-size: 11.5px; font-weight: 600; color: #2563EB; text-transform: uppercase;">Akan Diperbarui</span>
    <span style="display: block; font-size: 26px; font-weight: 800; color: #2563EB; margin-top: 4px;">{{ $updateCount }}</span>
  </div>
  <div class="panel-card" style="padding: 18px 20px;">
    <span style="font-size: 11.5px; font-weight: 600; color: var(--color-text-muted); text-transform: uppercase;">Tidak Berubah</span>
    <span style="display: block; font-size: 26px; font-weight: 800; color: var(--color-text-muted); margin-top: 4px;">{{ $unchangedCount }}</span>
  </div>
  <div class="panel-card" style="padding: 18px 20px; border-left: 4px solid #DC2626;">
    <span style="font-size: 11.5px; font-weight: 600; color: #DC2626; text-transform: uppercase;">Unit Bermasalah</span>
    <span style="display: block; font-size: 26px; font-weight: 800; color: #DC2626; margin-top: 4px;">{{ $errorCount }}</span>
  </div>
</div>

<!-- Alert Box if Errors Found -->
@if($errorCount > 0)
<div class="alert alert-danger" style="display: flex; align-items: flex-start; gap: 12px; border-radius: 12px;">
  <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink: 0; margin-top: 2px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
  <div style="font-size: 13px; line-height: 1.5;">
    <strong style="display: block; margin-bottom: 2px;">Ditemukan {{ $errorCount }} unit SKU dengan kesalahan validasi atau data konflik.</strong>
    Anda dapat mengunduh laporan error Excel untuk memperbaiki berkas, atau centang persetujuan di bawah untuk mengeksekusi hanya {{ count($units) - $errorCount }} baris yang sudah valid.
  </div>
</div>
@endif

<!-- Confirmation Form -->
@if($job->status !== 'completed')
<div class="panel-card">
  <div class="panel-body" style="padding: 20px 24px;">
    <form action="{{ route('backoffice.import.execute', $job->id) }}" method="POST" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;">
      @csrf

      <div>
        @if($errorCount > 0)
        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; font-weight: 600; color: var(--color-dark);">
          <input type="checkbox" name="skip_errors" value="1" required style="width: 16px; height: 16px; cursor: pointer;">
          <span>Saya memahami dan menyetujui untuk mengimpor hanya {{ count($units) - $errorCount }} baris yang valid</span>
        </label>
        @else
        <div style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; font-weight: 600; color: #059669;">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          <span>Seluruh data tervalidasi dengan aman dan siap diterapkan ke katalog produk.</span>
        </div>
        @endif
      </div>

      <div>
        <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-size: 14px;">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          <span>Konfirmasi & Terapkan Perubahan</span>
        </button>
      </div>
    </form>
  </div>
</div>
@else
<div class="alert alert-success" style="border-radius: 12px;">
  <div style="display: flex; align-items: center; gap: 10px;">
    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span style="font-weight: 600;">Pekerjaan impor ini telah berhasil dieksekusi dan disimpan ke basis data portofolio produk.</span>
  </div>
</div>
@endif

<!-- Preview Data Table -->
<div class="panel-card">
  <div class="panel-body" style="padding: 20px 24px; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: var(--color-dark); margin-bottom: 2px;">Rincian Staging Per Unit SKU</h3>
      <p style="font-size: 12.5px; color: var(--color-text-muted);">Pratinjau detail atribut, brand, media foto, dan status validasi setiap baris</p>
    </div>
  </div>

  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 140px;">SKU</th>
          <th style="width: 130px;">Aksi</th>
          <th>Nama Produk</th>
          <th style="width: 160px;">Brand & Kategori</th>
          <th style="width: 160px;">Media Foto</th>
          <th style="width: 120px;">Spesifikasi</th>
          <th style="width: 140px;">Validasi</th>
        </tr>
      </thead>
      <tbody>
        @php
          $allUnits = is_array($units) ? $units : [];
          $totalCount = count($allUnits);
          $displayUnits = array_slice($allUnits, 0, 100);
          $hasMore = $totalCount > 100;
        @endphp
        @forelse($displayUnits as $u)
        @php
          $data = $u['data'] ?? $u['payload'] ?? [];
          $specs = $u['specifications'] ?? ($data['specifications'] ?? []);
          $isValid = empty($u['errors']);
        @endphp
        <tr style="{{ !$isValid ? 'background: #FEF2F2;' : '' }}">
          <td style="font-family: ui-monospace, monospace; font-weight: 700; color: var(--color-dark); font-size: 12.5px;">
            {{ $u['sku'] }}
          </td>
          <td>
            @if(($u['action'] ?? '') === 'create')
              <span class="badge badge-success">+ Baru</span>
            @elseif(($u['action'] ?? '') === 'update')
              <span class="badge badge-info">&bull; Update</span>
            @elseif(($u['action'] ?? '') === 'unchanged')
              <span class="badge badge-neutral">Sama</span>
            @else
              <span class="badge badge-danger">Error</span>
            @endif
          </td>
          <td>
            <div style="font-weight: 600; color: var(--color-dark);">
              {{ $data['name'] ?? '(Nama Kosong / Belum Ada)' }}
            </div>
          </td>
          <td style="font-size: 12.5px;">
            <div>Brand: {{ $data['brand_id'] ? '#' . $data['brand_id'] : '-' }}</div>
            <div style="font-size: 11px; color: var(--color-text-muted);">Kategori: {{ count($data['category_ids'] ?? []) }} terpilih</div>
          </td>
          <td style="font-size: 12px;">
            <div style="display: flex; align-items: center; gap: 8px;">
              @if(!empty($data['staged_main_image_path']) || !empty($data['main_image_media_id']))
                <span style="color: #059669; font-weight: 600; font-size: 11px;">✓ Ada Gambar</span>
              @else
                <span style="color: var(--color-text-muted); font-size: 11px;">(Tanpa Foto Baru)</span>
              @endif
            </div>
          </td>
          <td style="font-size: 12.5px; color: var(--color-text-muted);">
            {{ count($specs) }} atribut
          </td>
          <td>
            @if($isValid)
              <span class="badge badge-success">Lolos</span>
            @else
              <div>
                <span class="badge badge-danger">Gagal</span>
                @foreach($u['errors'] ?? [] as $err)
                  <div style="font-size: 11px; color: #DC2626; margin-top: 3px; line-height: 1.3;">{{ $err }}</div>
                @endforeach
              </div>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align: center; padding: 32px; color: var(--color-text-muted);">Tidak ada baris unit yang ditemukan pada file ini.</td>
        </tr>
        @endforelse

        @if($hasMore)
        <tr>
          <td colspan="7" style="text-align: center; padding: 18px; color: #334155; background: #F8FAFC; font-weight: 600; font-size: 13px; border-top: 2px dashed #CBD5E1;">
            ⚡ Menampilkan 100 baris pertama dari total {{ number_format($totalCount) }} unit. Seluruh {{ number_format($totalCount) }} unit akan diproses saat Anda menekan tombol &ldquo;Konfirmasi &amp; Terapkan Perubahan&rdquo; di atas.
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
