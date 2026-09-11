@extends('backoffice.layouts.app')

@section('title', 'Project Portofolio')
@section('breadcrumb', 'Project Portofolio')

@section('content')
<div class="page-header" style="flex-wrap: wrap; gap: 14px;">
  <div>
    <h1 class="page-title">Project Portofolio</h1>
    <p class="page-subtitle">Kelola rekam jejak pekerjaan instalasi, perakitan panel, dan pengadaan industri.</p>
  </div>

  <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
    <a href="{{ route('backoffice.projects.download-template') }}" class="btn btn-secondary" title="Unduh template Excel untuk input banyak proyek">
      📥 Unduh Template Excel
    </a>
    <button type="button" class="btn btn-secondary" onclick="openProjectImportModal()" style="display: inline-flex; align-items: center; gap: 6px;">
      📁 Impor Excel
    </button>
    <a href="{{ route('backoffice.projects.create') }}" class="btn btn-primary">+ Tambah Project</a>
  </div>
</div>

<!-- Filter & Search Bar -->
<div class="panel-card" style="margin-bottom: 20px;">
  <div class="panel-body" style="padding: 16px 20px;">
    <form method="GET" action="{{ route('backoffice.projects.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
      <div style="flex: 1; min-width: 220px;">
        <input type="text" name="search" class="form-control" placeholder="Cari kode project, judul, atau klien..." value="{{ request('search') }}">
      </div>

      <div style="width: 200px;">
        <select name="category_id" class="form-control">
          <option value="">Semua Kategori</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div style="width: 170px;">
        <select name="is_featured" class="form-control">
          <option value="">Semua Carousel</option>
          <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>★ Tampil di Beranda</option>
          <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>Bukan Beranda</option>
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

      <button type="submit" class="btn btn-secondary">Filter</button>
      @if(request()->anyFilled(['search', 'category_id', 'is_featured', 'status']))
        <a href="{{ route('backoffice.projects.index') }}" class="btn btn-secondary" style="color: #DC2626;">Reset</a>
      @endif
    </form>
  </div>
</div>

<!-- Table Portofolio -->
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
              <div style="font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                <a href="{{ route('backoffice.projects.edit', $proj->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $proj->title }}
                </a>
                @if($proj->is_featured)
                  <span style="display: inline-flex; align-items: center; gap: 3px; padding: 2px 7px; background: #FFE4E6; color: #E11D48; font-size: 10.5px; font-weight: 700; border-radius: 999px; border: 1px solid #FECDD3;" title="Tampil di Carousel Beranda">
                    ★ Beranda
                  </span>
                @endif
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
              <form action="{{ route('backoffice.projects.toggle-status', $proj->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="badge {{ $proj->status === 'published' ? 'badge-success' : 'badge-warning' }}" 
                        style="cursor: pointer; border: none; font-family: inherit; font-size: 11.5px; padding: 4px 9px; display: inline-flex; align-items: center; gap: 4px;"
                        title="Klik untuk ubah status (Draft ⇄ Published)">
                  @if($proj->status === 'published')
                    <span>✓</span> Published
                  @else
                    <span>✎</span> Draft
                  @endif
                </button>
              </form>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px; align-items: center;">
                @if($proj->status === 'draft')
                  <form action="{{ route('backoffice.projects.toggle-status', $proj->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm" style="background: #10B981; color: #FFF; border: none; font-weight: 600; padding: 5px 10px;" title="Langsung publikasikan agar tampil di website">
                      🚀 Publikasikan
                    </button>
                  </form>
                @endif
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
            <td colspan="7" style="text-align: center; padding: 36px 20px; color: #94A3B8;">
              <div style="font-size: 32px; margin-bottom: 8px;">🏗️</div>
              <div style="font-weight: 600; color: #475569;">Belum ada project terdaftar.</div>
              <div style="font-size: 12.5px; margin-top: 4px;">Klik tombol <strong>+ Tambah Project</strong> atau <strong>📁 Impor Excel</strong> di atas untuk menambahkan data.</div>
            </td>
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

<!-- Modal Impor Excel Proyek -->
<div id="projectImportModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); align-items: center; justify-content: center;">
  <div style="background: #FFFFFF; border-radius: 16px; width: 100%; max-width: 520px; margin: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); overflow: hidden;">
    <div style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center;">
      <h3 style="font-size: 16px; font-weight: 700; margin: 0; color: #0F172A;">📁 Impor Data Project via Excel</h3>
      <button type="button" onclick="closeProjectImportModal()" style="background: none; border: none; font-size: 20px; color: #64748B; cursor: pointer;">&times;</button>
    </div>

    <form action="{{ route('backoffice.projects.import-excel') }}" method="POST" enctype="multipart/form-data" style="padding: 24px;">
      @csrf
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px; margin-bottom: 18px; font-size: 13px; color: #475569;">
        <div style="font-weight: 600; color: #0F172A; margin-bottom: 4px;">Petunjuk Impor:</div>
        <p style="margin: 0 0 10px 0; line-height: 1.4;">Gunakan template resmi agar format kolom (Kode, Judul, Kategori, Klien, Lokasi, dll.) sesuai.</p>
        <a href="{{ route('backoffice.projects.download-template') }}" class="btn btn-secondary btn-sm" style="background: #FFFFFF; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          📥 Download Template Excel (.xlsx)
        </a>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label class="form-label" for="excel_file">Pilih File Excel (.xlsx / .xls) *</label>
        <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls" required>
      </div>

      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" onclick="closeProjectImportModal()" class="btn btn-secondary">Batal</button>
        <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 6px;">
          🚀 Upload &amp; Proses Impor
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openProjectImportModal() {
    const modal = document.getElementById('projectImportModal');
    if (modal) modal.style.display = 'flex';
  }

  function closeProjectImportModal() {
    const modal = document.getElementById('projectImportModal');
    if (modal) modal.style.display = 'none';
  }
</script>
@endsection
