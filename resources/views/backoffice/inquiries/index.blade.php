@extends('backoffice.layouts.app')

@section('title', 'Pesan Masuk (Inquiries)')
@section('breadcrumb', 'Pesan Masuk')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Kotak Masuk Pesan Pelanggan</h1>
    <p class="page-subtitle">Pesan dan permintaan konsultasi teknis yang masuk via form kontak website.</p>
  </div>

  <div style="display: flex; gap: 8px; flex-wrap: wrap;">
    <a href="{{ route('backoffice.inquiries.index') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-secondary' }} btn-sm">Semua</a>
    <a href="{{ route('backoffice.inquiries.index', ['status' => 'unread']) }}" class="btn {{ request('status') === 'unread' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Belum Dibaca</a>
    <a href="{{ route('backoffice.inquiries.index', ['status' => 'handled']) }}" class="btn {{ request('status') === 'handled' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Ditangani</a>
  </div>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Pengirim</th>
          <th>Kontak</th>
          <th>Subjek</th>
          <th style="width: 120px;">Status</th>
          <th style="width: 160px;">Waktu Masuk</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($inquiries as $inq)
          <tr style="{{ $inq->status === 'unread' ? 'background-color: #FEF2F2; font-weight: 600;' : '' }}">
            <td>
              <div style="font-weight: 700; color: #0F172A;">{{ $inq->name }}</div>
              @if($inq->company)
                <div style="font-size: 11.5px; color: #64748B; font-weight: normal;">{{ $inq->company }}</div>
              @endif
            </td>
            <td>
              <div style="font-size: 12.5px; color: #334155;">{{ $inq->email }}</div>
              @if($inq->phone)
                <div style="font-size: 11.5px; color: #64748B; font-family: monospace;">{{ $inq->phone }}</div>
              @endif
            </td>
            <td>
              <div style="max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #0F172A;">
                {{ $inq->subject ?: '(Tanpa Subjek)' }}
              </div>
            </td>
            <td>
              @if($inq->status === 'unread')
                <span class="badge badge-danger">Baru</span>
              @elseif($inq->status === 'read')
                <span class="badge badge-info">Dibaca</span>
              @elseif($inq->status === 'handled')
                <span class="badge badge-success">Ditangani</span>
              @else
                <span class="badge badge-neutral">Spam</span>
              @endif
            </td>
            <td>
              <span style="font-size: 12px; color: #64748B; font-weight: normal;">
                {{ $inq->created_at->format('d M Y, H:i') }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('backoffice.inquiries.show', $inq->id) }}" class="btn {{ $inq->status === 'unread' ? 'btn-primary' : 'btn-secondary' }} btn-sm">
                  Detail Pesan
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 36px; color: #94A3B8;">Tidak ada pesan masuk.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($inquiries->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
      {{ $inquiries->links() }}
    </div>
  @endif
</div>
@endsection
