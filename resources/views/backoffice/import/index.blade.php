@extends('backoffice.layouts.app')

@section('title', 'Import Center Produk')
@section('breadcrumb', 'Import Center')

@section('content')
<!-- Page Header with Actions -->
<div class="page-header">
  <div>
    <h1 class="page-title">Import & Export Massal Produk</h1>
    <p class="page-subtitle">Kelola dan perbarui ratusan spesifikasi produk sekaligus menggunakan berkas spreadsheet Excel (.xlsx).</p>
  </div>

  <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
    <a href="{{ route('backoffice.import.template') }}" class="btn btn-secondary" style="gap: 8px;">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
      <span>Unduh Template (.xlsx)</span>
    </a>
    <a href="{{ route('backoffice.import.export') }}" class="btn btn-secondary" style="gap: 8px; color: #059669; border-color: #A7F3D0; background: #ECFDF5;">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      <span>Export Katalog Lengkap (.xlsx)</span>
    </a>
  </div>
</div>

<!-- Main Grid: Upload Form & Rule Guide -->
<div style="display: grid; grid-template-columns: 1fr; gap: 24px;" class="import-grid">
  <!-- Upload Box Panel -->
  <div class="panel-card">
    <div class="panel-body" style="padding: 24px;">
      <div style="margin-bottom: 20px;">
        <h3 style="font-size: 16px; font-weight: 700; color: var(--color-dark); margin-bottom: 4px;">Unggah Berkas Impor</h3>
        <p style="font-size: 12.5px; color: var(--color-text-muted);">Pilih strategi pencocokan SKU dan unggah file spreadsheet .xlsx</p>
      </div>

      <form action="{{ route('backoffice.import.upload') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 18px;">
        @csrf

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Mode Pencocokan SKU <span style="color: var(--color-primary); font-weight: bold;">*</span></label>
          <select name="mode" required class="form-control" style="cursor: pointer;">
            <option value="upsert" selected>Upsert (Rekomendasi - Buat Baru & Perbarui Existing)</option>
            <option value="create_only">Create Only (Hanya Tambah Produk Baru)</option>
            <option value="update_only">Update Only (Hanya Perbarui Produk Existing)</option>
          </select>
          <span class="form-hint" style="margin-top: 4px;">Mode Upsert otomatis mendeteksi apakah SKU sudah terdaftar di sistem.</span>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Pilih Berkas Spreadsheet (.xlsx) <span style="color: var(--color-primary); font-weight: bold;">*</span></label>
          <div style="position: relative; border: 2px dashed var(--color-border); border-radius: 12px; padding: 24px 16px; text-align: center; background: #FAFBFD; transition: all 0.2s ease;" class="upload-dropzone">
            <input type="file" name="file" id="importFileInput" accept=".xlsx" required style="position: absolute; inset: 0; opacity: 0; width: 100%; height: 100%; cursor: pointer; z-index: 5;" onchange="updateFileNameDisplay(this)">
            <div style="pointer-events: none;">
              <div style="width: 44px; height: 44px; margin: 0 auto 10px; border-radius: 10px; background: #EEF2F6; display: flex; align-items: center; justify-content: center; color: var(--color-primary);">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
              </div>
              <p style="font-size: 13.5px; font-weight: 600; color: var(--color-dark);" id="fileUploadPrompt">Klik untuk memilih atau seret file .xlsx ke sini</p>
              <p style="font-size: 11.5px; color: var(--color-text-muted); margin-top: 4px;" id="fileUploadSubtext">Format .xlsx standar (Maks. 20 MiB)</p>
            </div>
          </div>
        </div>

        <div style="padding-top: 6px;">
          <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 14px; gap: 8px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Validasi & Buka Preview Rencana</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Instruction & Data Contracts Panel -->
  <div class="panel-card" style="background: #FAFBFD;">
    <div class="panel-body" style="padding: 24px;">
      <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
        <div style="width: 32px; height: 32px; border-radius: 8px; background: #E0E7FF; color: #3730A3; display: flex; align-items: center; justify-content: center;">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
          <h3 style="font-size: 15px; font-weight: 700; color: var(--color-dark);">Aturan & Kontrak Pengisian Data</h3>
          <p style="font-size: 12px; color: var(--color-text-muted);">Panduan penting agar proses validasi dan impor berjalan lancar</p>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px; margin-bottom: 18px;">
        <div style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px; padding: 16px;">
          <div style="font-size: 13px; font-weight: 700; color: var(--color-dark); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
            <span style="display: inline-flex; width: 20px; height: 20px; border-radius: 50%; background: #EFF6FF; color: #2563EB; font-size: 11px; align-items: center; justify-content: center; font-weight: 800;">1</span>
            Format SKU Teks
          </div>
          <p style="font-size: 12px; color: var(--color-text-muted); line-height: 1.5;">
            Kolom <code style="background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-weight: 600; color: #0F172A;">sku</code> wajib berupa teks. Prefix angka nol depan (contoh: <code style="background: #F1F5F9; padding: 2px 5px; border-radius: 4px;">00123</code>) dan kode unik dipertahankan secara utuh.
          </p>
        </div>

        <div style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px; padding: 16px;">
          <div style="font-size: 13px; font-weight: 700; color: var(--color-dark); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
            <span style="display: inline-flex; width: 20px; height: 20px; border-radius: 50%; background: #EFF6FF; color: #2563EB; font-size: 11px; align-items: center; justify-content: center; font-weight: 800;">2</span>
            Foto via Link Web / Google Drive
          </div>
          <p style="font-size: 12px; color: var(--color-text-muted); line-height: 1.5;">
            Mendukung URL gambar langsung (contoh: <code style="background: #F1F5F9; padding: 2px 5px; border-radius: 4px; font-size: 11px;">https://listrikonline.com/.../foto.jpg</code>) maupun link share Google Drive pada kolom <code style="background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-weight: 600; color: #0F172A;">link_gdrive</code> (alias: <code style="background: #F1F5F9; padding: 2px 4px; border-radius: 4px; font-size: 11px;">image_url</code>, <code style="background: #F1F5F9; padding: 2px 4px; border-radius: 4px; font-size: 11px;">link_foto</code>) &amp; <code style="background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-weight: 600; color: #0F172A;">gallery_links</code>.
          </p>
        </div>

        <div style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px; padding: 16px;">
          <div style="font-size: 13px; font-weight: 700; color: var(--color-dark); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
            <span style="display: inline-flex; width: 20px; height: 20px; border-radius: 50%; background: #EFF6FF; color: #2563EB; font-size: 11px; align-items: center; justify-content: center; font-weight: 800;">3</span>
            Sel Kosong vs __CLEAR__
          </div>
          <p style="font-size: 12px; color: var(--color-text-muted); line-height: 1.5;">
            Sel kosong pada saat update berarti <strong>mempertahankan</strong> nilai lama di database. Untuk mengosongkan nilai opsional secara sengaja, isi sel dengan token <code style="background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-weight: 700; color: #DC2626;">__CLEAR__</code>.
          </p>
        </div>

        <div style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px; padding: 16px;">
          <div style="font-size: 13px; font-weight: 700; color: var(--color-dark); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
            <span style="display: inline-flex; width: 20px; height: 20px; border-radius: 50%; background: #EFF6FF; color: #2563EB; font-size: 11px; align-items: center; justify-content: center; font-weight: 800;">4</span>
            Sheet Spesifikasi Teknis
          </div>
          <p style="font-size: 12px; color: var(--color-text-muted); line-height: 1.5;">
            Spesifikasi diisi di sheet <code style="background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-weight: 600; color: #0F172A;">product_specifications</code> dengan SKU + attribute_code. Mendukung operasi <code style="background: #F1F5F9; padding: 2px 5px; border-radius: 4px;">upsert</code> dan <code style="background: #F1F5F9; padding: 2px 5px; border-radius: 4px;">remove</code>.
          </p>
        </div>
      </div>

      <div style="padding: 12px 16px; background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 10px; display: flex; align-items: center; gap: 10px; font-size: 12px; color: #92400E;">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink: 0; color: #D97706;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <span><strong>Kebijakan Non-Transaksional:</strong> Kolom harga dan stok transaksi diabaikan karena katalog ini ditujukan untuk portofolio dan spesifikasi teknis engineering ATS.</span>
      </div>
    </div>
  </div>
</div>

<!-- Import Job History Panel -->
<div class="panel-card" style="margin-top: 24px;">
  <div class="panel-body" style="padding: 20px 24px; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: var(--color-dark); margin-bottom: 2px;">Riwayat Pekerjaan Impor</h3>
      <p style="font-size: 12.5px; color: var(--color-text-muted);">Daftar berkas spreadsheet impor yang pernah diproses oleh tim backoffice</p>
    </div>
  </div>

  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 80px;">ID Job</th>
          <th>Nama File</th>
          <th style="width: 110px;">Mode</th>
          <th style="width: 180px;">Hasil Validasi</th>
          <th style="width: 140px;">Status</th>
          <th style="width: 150px;">Pengunggah</th>
          <th style="width: 150px;">Waktu</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($history as $job)
        <tr>
          <td style="font-family: ui-monospace, monospace; font-weight: 700; color: var(--color-dark); font-size: 12.5px;">#{{ $job->id }}</td>
          <td>
            <div style="font-weight: 600; color: var(--color-dark); max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $job->file_name }}">
              {{ $job->file_name }}
            </div>
            <div style="font-size: 11px; color: var(--color-text-muted); margin-top: 2px;">
              {{ number_format($job->file_size / 1024, 1) }} KB
            </div>
          </td>
          <td>
            <span style="font-family: ui-monospace, monospace; font-size: 11px; font-weight: 600; text-transform: uppercase; background: #F1F5F9; color: #475569; padding: 3px 8px; border-radius: 6px; border: 1px solid #CBD5E1;">
              {{ $job->mode }}
            </span>
          </td>
          <td>
            <div style="font-size: 12.5px; display: flex; align-items: center; gap: 6px;">
              <span style="font-weight: 700; color: #059669;">{{ $job->valid_rows }} valid</span>
              @if($job->error_rows > 0)
                <span style="font-weight: 700; color: #DC2626;">&bull; {{ $job->error_rows }} error</span>
              @endif
              <span style="color: var(--color-text-muted);">/ {{ $job->total_rows }} total</span>
            </div>
          </td>
          <td>
            @if($job->status === 'completed')
              <span class="badge badge-success">Selesai</span>
            @elseif($job->status === 'ready')
              <span class="badge badge-info">Siap Eksekusi</span>
            @elseif($job->status === 'processing')
              <span class="badge badge-warning">Memproses...</span>
            @else
              <span class="badge badge-danger">Gagal</span>
            @endif
          </td>
          <td style="font-size: 13px; color: var(--color-dark);">{{ $job->user->name ?? 'Sistem' }}</td>
          <td style="font-size: 12px; color: var(--color-text-muted);">{{ $job->created_at->format('d M Y, H:i') }}</td>
          <td style="text-align: right;">
            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
              <a href="{{ route('backoffice.import.preview', $job->id) }}" class="btn btn-secondary btn-sm" style="font-size: 11.5px; padding: 5px 10px;">
                Detail
              </a>
              @if($job->error_report_path)
              <a href="{{ route('backoffice.import.error-report', $job->id) }}" class="btn btn-sm" style="font-size: 11.5px; padding: 5px 10px; background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA;" title="Unduh Laporan Kesalahan">
                Report
              </a>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="padding: 48px 16px; text-align: center; color: var(--color-text-muted); font-size: 13.5px;">
            <div style="margin-bottom: 8px; font-size: 28px;">📂</div>
            Belum ada riwayat berkas impor. Silakan unggah file template Excel di atas untuk memulai.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($history->hasPages())
  <div style="padding: 16px 24px; border-top: 1px solid var(--color-border);">
    {{ $history->links() }}
  </div>
  @endif
</div>

<style>
  @media (min-width: 1024px) {
    .import-grid {
      grid-template-columns: 380px 1fr !important;
    }
  }

  .upload-dropzone:hover {
    border-color: var(--color-primary) !important;
    background: #FFF5F7 !important;
  }
</style>

<script>
  function updateFileNameDisplay(input) {
    if (input.files && input.files[0]) {
      const fileName = input.files[0].name;
      const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
      document.getElementById('fileUploadPrompt').innerText = fileName;
      document.getElementById('fileUploadSubtext').innerText = `Ukuran: ${fileSize} MB — Siap divalidasi`;
      document.getElementById('fileUploadPrompt').style.color = '#E11D48';
      document.getElementById('fileUploadPrompt').style.fontWeight = '700';
    }
  }
</script>
@endsection
