@extends('backoffice.layouts.app')

@section('title', 'Tambah Pengguna & Hak Akses')
@section('breadcrumb', 'Tambah Pengguna')

@section('content')
<div class="page-header">
  <div style="display: flex; align-items: center; gap: 14px;">
    <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary btn-sm">
      &larr; Kembali
    </a>
    <div>
      <h1 class="page-title">Tambah Pengguna & Tetapkan Role</h1>
      <p class="page-subtitle">Daftarkan akun staf baru dan atur izin permission untuk setiap modul backoffice.</p>
    </div>
  </div>
</div>

<form action="{{ route('backoffice.users.store') }}" method="POST" id="userForm">
  @csrf

  <div style="display: grid; grid-template-columns: 1fr; gap: 24px; max-width: 1100px;">
    
    <!-- 1. DATA PRIBADI & AKUN -->
    <div class="panel-card">
      <div class="panel-header" style="border-bottom: 1px solid var(--color-border); padding: 16px 20px;">
        <h3 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
          <svg style="width: 18px; height: 18px; color: #E11D48;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          Informasi Akun Staf
        </h3>
      </div>
      <div class="panel-body" style="display: flex; flex-direction: column; gap: 18px; padding: 20px;">
        <div class="form-group">
          <label class="form-label">Nama Lengkap <span style="color: #DC2626;">*</span></label>
          <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso" class="form-control">
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
          <div class="form-group">
            <label class="form-label">Username (Untuk Login)</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: budi_ats" class="form-control">
            <span class="form-hint">Dapat digunakan staf untuk masuk selain alamat email.</span>
          </div>
          <div class="form-group">
            <label class="form-label">Alamat Email <span style="color: #DC2626;">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="budi@anugerahtamasejati.com" class="form-control">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
          <div class="form-group">
            <label class="form-label">Password <span style="color: #DC2626;">*</span></label>
            <input type="password" name="password" required minlength="8" placeholder="Minimal 8 karakter" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Konfirmasi Password <span style="color: #DC2626;">*</span></label>
            <input type="password" name="password_confirmation" required minlength="8" placeholder="Ketik ulang password" class="form-control">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; align-items: center; padding-top: 8px;">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Peran Akses Utama (Role) <span style="color: #DC2626;">*</span></label>
            <select name="role" id="roleSelect" required class="form-control" onchange="handleRoleChange(this.value)">
              @if(auth()->user()->isSuperAdmin())
                <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Super Administrator (Akses Penuh Tanpa Batas)</option>
              @endif
              <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator (Kelola Sistem & Semua Modul)</option>
              <option value="editor" {{ old('role', 'editor') === 'editor' ? 'selected' : '' }}>Editor (Kelola Katalog Produk & Konten)</option>
              <option value="cs" {{ old('role') === 'cs' ? 'selected' : '' }}>Customer Support (Pesan Masuk, Live Chat & AI)</option>
              <option value="custom" {{ old('role') === 'custom' ? 'selected' : '' }}>Kustom (Tentukan Hak Akses Modul Secara Spesifik)</option>
            </select>
          </div>

          <div style="padding-top: 22px;">
            <label style="display: inline-flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13.5px; font-weight: 600; color: #334155;">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #E11D48;">
              <span>Akun Aktif (Dapat Login ke Backoffice)</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. GRANULAR MODULE PERMISSIONS MATRIX -->
    <div class="panel-card" id="permissionsPanel">
      <div class="panel-header" style="border-bottom: 1px solid var(--color-border); padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: gap; gap: 12px;">
        <div>
          <h3 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
            <svg style="width: 18px; height: 18px; color: #2563EB;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            Izin Hak Akses Per Modul (Permissions)
          </h3>
          <p style="font-size: 12.5px; color: #64748B; margin-top: 2px;">Centang modul yang diizinkan untuk dibuka dan dikelola oleh staf ini.</p>
        </div>
        
        <div style="display: flex; align-items: center; gap: 8px;">
          <button type="button" onclick="selectAllPermissions()" class="btn btn-secondary btn-sm" style="font-size: 12px; padding: 6px 12px;">
            Pilih Semua
          </button>
          <button type="button" onclick="clearAllPermissions()" class="btn btn-secondary btn-sm" style="font-size: 12px; padding: 6px 12px;">
            Kosongkan
          </button>
        </div>
      </div>

      <div class="panel-body" style="padding: 20px;">
        <div id="superadminNotice" style="display: none; padding: 14px 18px; border-radius: 12px; background: #EDE9FE; border: 1px solid #DDD6FE; color: #5B21B6; font-size: 13px; font-weight: 600; margin-bottom: 20px;">
          🌟 <strong>Super Administrator:</strong> Akun ini otomatis memiliki hak akses penuh ke seluruh modul sistem tanpa pembatasan.
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
          @foreach($availableModules as $groupKey => $group)
            <div style="border: 1px solid var(--color-border); border-radius: 14px; background: #F8FAFC; overflow: hidden;">
              <div style="padding: 12px 16px; background: #F1F5F9; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 13px; font-weight: 800; color: #1E293B; text-transform: uppercase; letter-spacing: 0.03em;">
                  {{ $group['label'] }}
                </span>
                <button type="button" onclick="toggleGroup('{{ $groupKey }}')" style="font-size: 11px; font-weight: 700; color: #2563EB; background: none; border: none; cursor: pointer;">
                  Toggle Grup
                </button>
              </div>

              <div style="padding: 14px 16px; display: flex; flex-direction: column; gap: 12px;">
                @foreach($group['modules'] as $moduleKey => $module)
                  <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; user-select: none;">
                    <input type="checkbox" 
                           name="permissions[]" 
                           value="{{ $moduleKey }}" 
                           class="perm-checkbox perm-group-{{ $groupKey }}"
                           data-module="{{ $moduleKey }}"
                           {{ in_array($moduleKey, old('permissions', [])) ? 'checked' : '' }}
                           style="width: 17px; height: 17px; margin-top: 2px; accent-color: #E11D48; cursor: pointer; flex-shrink: 0;">
                    <div>
                      <div style="font-size: 13.5px; font-weight: 700; color: #0F172A;">{{ $module['label'] }}</div>
                      <div style="font-size: 12px; color: #64748B; line-height: 1.4;">{{ $module['desc'] }}</div>
                    </div>
                  </label>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- SUBMIT ACTIONS -->
    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; padding: 16px 0;">
      <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary" style="padding: 12px 24px;">Batal</a>
      <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 14px; font-weight: 700;">
        Simpan & Daftarkan Pengguna
      </button>
    </div>
  </div>
</form>

<script>
  const rolePresets = {
    superadmin: ['*'],
    admin: [
      'products', 'product_categories', 'brands', 'import_products', 'certificates',
      'projects', 'articles', 'pages', 'media_library', 'live_chats', 'inquiries',
      'ai_knowledge', 'settings', 'users'
    ],
    editor: [
      'products', 'product_categories', 'brands', 'import_products', 'certificates',
      'projects', 'articles', 'pages', 'media_library'
    ],
    cs: [
      'live_chats', 'inquiries', 'ai_knowledge'
    ],
    custom: []
  };

  function handleRoleChange(role) {
    const notice = document.getElementById('superadminNotice');
    const checkboxes = document.querySelectorAll('.perm-checkbox');

    if (role === 'superadmin') {
      notice.style.display = 'block';
      checkboxes.forEach(cb => {
        cb.checked = true;
        cb.disabled = true;
      });
    } else {
      notice.style.display = 'none';
      checkboxes.forEach(cb => {
        cb.disabled = false;
      });

      if (rolePresets[role]) {
        const allowed = rolePresets[role];
        checkboxes.forEach(cb => {
          cb.checked = allowed.includes(cb.getAttribute('data-module'));
        });
      }
    }
  }

  function selectAllPermissions() {
    document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = true);
    document.getElementById('roleSelect').value = 'custom';
  }

  function clearAllPermissions() {
    document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('roleSelect').value = 'custom';
  }

  function toggleGroup(groupKey) {
    const groupCheckboxes = document.querySelectorAll('.perm-group-' + groupKey);
    const allChecked = Array.from(groupCheckboxes).every(cb => cb.checked);
    groupCheckboxes.forEach(cb => cb.checked = !allChecked);
    document.getElementById('roleSelect').value = 'custom';
  }

  // Initial trigger on load
  document.addEventListener('DOMContentLoaded', function () {
    const initialRole = document.getElementById('roleSelect').value;
    const oldPermissions = @json(old('permissions', []));
    if (oldPermissions.length === 0) {
      handleRoleChange(initialRole);
    }
  });
</script>
@endsection
