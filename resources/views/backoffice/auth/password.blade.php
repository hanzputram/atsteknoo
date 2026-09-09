@extends('backoffice.layouts.app')

@section('title', 'Ubah Password')
@section('breadcrumb', 'Ubah Password')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Ubah Password Akun</h1>
    <p class="page-subtitle">Perbarui kredensial keamanan akun Anda (minimal 12 karakter).</p>
  </div>
</div>

<div class="panel-card" style="max-width: 560px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.password.update') }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label" for="current_password">Password Saat Ini</label>
        <input type="password" name="current_password" id="current_password" class="form-control" required autocomplete="current-password">
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password Baru (minimal 12 karakter)</label>
        <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
        <span class="form-hint">Disarankan menggunakan kombinasi huruf besar, angka, dan simbol.</span>
      </div>

      <div class="form-group">
        <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
      </div>

      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
        <a href="{{ route('backoffice.dashboard') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
