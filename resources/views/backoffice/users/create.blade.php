@extends('backoffice.layouts.app')

@section('title', 'Tambah Pengguna')
@section('breadcrumb', 'Tambah Pengguna')

@section('content')
<div class="page-header">
  <div style="display: flex; align-items: center; gap: 14px;">
    <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary btn-sm">
      &larr; Kembali
    </a>
    <div>
      <h1 class="page-title">Tambah Pengguna Baru</h1>
      <p class="page-subtitle">Buat akun staf baru untuk mengakses backoffice.</p>
    </div>
  </div>
</div>

<div class="panel-card" style="max-width: 700px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.users.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
      @csrf

      <div class="form-group">
        <label class="form-label">Nama Lengkap <span style="color: #DC2626;">*</span></label>
        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso" class="form-control">
      </div>

      <div class="form-group">
        <label class="form-label">Alamat Email <span style="color: #DC2626;">*</span></label>
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="staf@anugerahtamasejati.com" class="form-control">
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
        <div class="form-group">
          <label class="form-label">Password <span style="color: #DC2626;">*</span></label>
          <input type="password" name="password" required minlength="12" placeholder="Minimal 12 karakter" class="form-control">
          <span class="form-hint">Gunakan kombinasi huruf, angka, dan simbol yang aman.</span>
        </div>
        <div class="form-group">
          <label class="form-label">Konfirmasi Password <span style="color: #DC2626;">*</span></label>
          <input type="password" name="password_confirmation" required minlength="12" placeholder="Ketik ulang password" class="form-control">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; align-items: center;">
        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Peran Akses (Role) <span style="color: #DC2626;">*</span></label>
          <select name="role" required class="form-control">
            <option value="cs" {{ old('role') === 'cs' ? 'selected' : '' }}>Customer Support (Live Chat & Pesan Masuk)</option>
            <option value="editor" {{ old('role', 'editor') === 'editor' ? 'selected' : '' }}>Editor (Kelola Katalog & Konten)</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Hak Penuh & Konfigurasi)</option>
          </select>
        </div>

        <div style="padding-top: 20px;">
          <label style="display: inline-flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; font-weight: 600; color: #334155;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #E11D48;">
            <span>Akun Aktif (Dapat Login)</span>
          </label>
        </div>
      </div>

      <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid var(--color-border); margin-top: 8px;">
        <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
      </div>
    </form>
  </div>
</div>
@endsection
