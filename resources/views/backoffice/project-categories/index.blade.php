@extends('backoffice.layouts.app')

@section('title', 'Kategori Project')
@section('breadcrumb', 'Kategori Project')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Kategori Project Portofolio</h1>
    <p class="page-subtitle">Kelola pengelompokan portofolio pekerjaan engineering.</p>
  </div>

  <a href="{{ route('backoffice.project-categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Kategori</th>
          <th>Jumlah Project</th>
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
                <a href="{{ route('backoffice.project-categories.edit', $cat->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $cat->name }}
                </a>
              </div>
            </td>
            <td>
              <span class="badge badge-info">{{ $cat->projects_count }} Project</span>
            </td>
            <td>
              <span class="badge {{ $cat->is_active ? 'badge-success' : 'badge-neutral' }}">
                {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('backoffice.project-categories.edit', $cat->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('backoffice.project-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $cat->name }}?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="text-align: center; padding: 32px; color: #94A3B8;">Belum ada kategori project.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
