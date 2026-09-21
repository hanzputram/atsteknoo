@extends('backoffice.layouts.app')

@section('title', 'Edit Pengguna: ' . $user->name)
@section('breadcrumb', 'Edit Pengguna')

@section('content')
<div class="page-header">
  <div style="display: flex; align-items: center; gap: 14px;">
    <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary btn-sm">
      &larr; Kembali
    </a>
    <div>
      <h1 class="page-title">Perbarui Akun Pengguna</h1>
      <p class="page-subtitle">Edit data akun, peran akses, atau ganti password untuk {{ $user->name }}.</p>
    </div>
  </div>
</div>

<div class="panel-card" style="max-width: 700px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.users.update', $user->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label class="form-label">Nama Lengkap <span style="color: #DC2626;">*</span></label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-control">
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
        <div class="form-group">
          <label class="form-label">Username (Opsional)</label>
          <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Contoh: superats888" class="form-control">
          <span class="form-hint">Digunakan untuk login staf. Huruf, angka, dash, underscore.</span>
        </div>
        <div class="form-group">
          <label class="form-label">Alamat Email <span style="color: #DC2626;">*</span></label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control">
        </div>
      </div>

      <!-- Ubah Password Box -->
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px;">
        <div style="font-size: 13px; font-weight: 700; color: #0F172A; margin-bottom: 4px;">Ubah Password</div>
        <p style="font-size: 12px; color: #64748B; margin-bottom: 14px;">Kosongkan kedua kolom berikut jika Anda tidak ingin mengganti password akun.</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" style="font-size: 12px;">Password Baru</label>
            <input type="password" name="password" minlength="12" placeholder="Minimal 12 karakter" class="form-control" style="background: #FFF;">
          </div>
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" style="font-size: 12px;">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" minlength="12" placeholder="Ketik ulang password" class="form-control" style="background: #FFF;">
          </div>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; align-items: center;">
        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Peran Akses (Role) <span style="color: #DC2626;">*</span></label>
          <select name="role" required class="form-control">
            <option value="cs" {{ old('role', $user->role) === 'cs' ? 'selected' : '' }}>Customer Support (Live Chat & Pesan Masuk)</option>
            <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor (Kelola Katalog & Konten)</option>
            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin (Hak Penuh & Konfigurasi)</option>
          </select>
        </div>

        <div style="padding-top: 20px;">
          <label style="display: inline-flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; font-weight: 600; color: #334155;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #E11D48;">
            <span>Akun Aktif (Dapat Login)</span>
          </label>
        </div>
      </div>

      <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid var(--color-border); margin-top: 8px;">
        <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Perbarui Pengguna</button>
      </div>
    </form>
  </div>
</div>
@endsection
