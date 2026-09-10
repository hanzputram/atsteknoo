@extends('backoffice.layouts.app')

@section('title', 'Halaman Perusahaan')
@section('breadcrumb', 'Halaman Perusahaan')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Halaman Profil Perusahaan</h1>
    <p class="page-subtitle">Kelola konten profil, visi-misi, dan halaman statis resmi PT Anugerah Tama Sejati.</p>
  </div>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 140px;">Kunci Halaman</th>
          <th>Judul Halaman</th>
          <th>Slug URL</th>
          <th style="width: 120px;">Status</th>
          <th style="width: 180px;">Terakhir Diperbarui</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pages as $p)
          <tr>
            <td>
              <span style="font-family: monospace; font-weight: 700; color: #0F172A; background: #F1F5F9; padding: 3px 8px; border-radius: 4px;">{{ $p->page_key }}</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A;">
                <a href="{{ route('backoffice.pages.edit', $p->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $p->title }}
                </a>
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 12px; color: #64748B;">/{{ $p->slug }}</span>
            </td>
            <td>
              <span class="badge {{ $p->status === 'published' ? 'badge-success' : 'badge-warning' }}">
                {{ ucfirst($p->status) }}
              </span>
            </td>
            <td>
              <span style="color: #64748B; font-size: 13px;">{{ $p->updated_at->format('d M Y, H:i') }}</span>
            </td>
            <td style="text-align: right;">
              <a href="{{ route('backoffice.pages.edit', $p->id) }}" class="btn btn-secondary btn-sm">
                Edit Konten
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 36px; color: #94A3B8;">Belum ada data halaman.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
