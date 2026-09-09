@extends('backoffice.layouts.app')

@section('title', 'Project Portofolio')
@section('breadcrumb', 'Project Portofolio')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Project Portofolio</h1>
    <p class="page-subtitle">Kelola rekam jejak pekerjaan instalasi, perakitan panel, dan pengadaan industri.</p>
  </div>

  <a href="{{ route('backoffice.projects.create') }}" class="btn btn-primary">+ Tambah Project</a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 70px;">Cover</th>
          <th>Kode Project</th>
          <th>Judul Pekerjaan</th>
          <th>Kategori</th>
          <th>Lokasi / Tahun</th>
          <th>Status</th>
          <th style="text-align: right;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($projects as $proj)
          <tr>
            <td>
              <div style="width: 52px; height: 38px; border-radius: 6px; border: 1px solid #E2E8F0; background: #F8FAFC; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                @if($proj->coverImage)
                  <img src="{{ route('media.view', $proj->coverImage->id) }}" alt="{{ $proj->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                  <span style="font-size: 14px; color: #CBD5E1;">🏗️</span>
                @endif
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-weight: 700; color: #0F172A; background: #F1F5F9; padding: 3px 6px; border-radius: 4px;">{{ $proj->project_code }}</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A;">
                <a href="{{ route('backoffice.projects.edit', $proj->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $proj->title }}
                </a>
              </div>
              @if($proj->client_name)
                <div style="font-size: 12px; color: #64748B;">Klien: {{ $proj->client_name }}</div>
              @endif
            </td>
            <td>
              @if($proj->category)
                <span class="badge badge-neutral">{{ $proj->category->name }}</span>
              @else
                <span style="color: #94A3B8;">-</span>
              @endif
            </td>
            <td>
              <div style="font-size: 13px; color: #1E293B;">{{ $proj->location ?: '-' }}</div>
              <div style="font-size: 11.5px; color: #64748B;">{{ $proj->completion_year ?: '-' }}</div>
            </td>
            <td>
              <span class="badge {{ $proj->status === 'published' ? 'badge-success' : 'badge-warning' }}">
                {{ $proj->status }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                @if($proj->isPublished())
                  <a href="{{ route('projects.show', $proj->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat Halaman Publik">&nearr;</a>
                @endif
                <a href="{{ route('backoffice.projects.edit', $proj->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('backoffice.projects.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Hapus project {{ $proj->title }}?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 32px; color: #94A3B8;">Belum ada project terdaftar.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($projects->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
      {{ $projects->links() }}
    </div>
  @endif
</div>
@endsection
