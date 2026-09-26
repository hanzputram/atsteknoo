@extends('backoffice.layouts.app')

@section('title', 'Manajemen Pengguna & Role')
@section('breadcrumb', 'Pengguna Backoffice')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Manajemen Pengguna & Hak Akses</h1>
    <p class="page-subtitle">Kelola akun staf, tetapkan peran (role), dan konfigurasi izin akses permission per modul.</p>
  </div>

  <a href="{{ route('backoffice.users.create') }}" class="btn btn-primary">
    + Tambah Pengguna Baru
  </a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Nama Staf</th>
          <th>Username</th>
          <th>Email</th>
          <th style="width: 140px;">Peran (Role)</th>
          <th>Hak Akses Modul</th>
          <th style="width: 100px;">Status</th>
          <th style="width: 130px;">Dibuat</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr>
            <td>
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $u->isSuperAdmin() ? '#4C1D95' : '#0F172A' }}; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; flex-shrink: 0; border: 2px solid {{ $u->isSuperAdmin() ? '#8B5CF6' : '#E11D48' }};">
                  {{ strtoupper(substr($u->name, 0, 1)) }}
                </div>
                <div>
                  <div style="font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 6px;">
                    <span>{{ $u->name }}</span>
                    @if($u->isSuperAdmin())
                      <span title="Super Administrator" style="color: #8B5CF6;">⭐</span>
                    @endif
                  </div>
                  @if(auth()->id() === $u->id)
                    <span style="font-size: 11px; color: #E11D48; font-weight: 700;">(Akun Anda Saat Ini)</span>
                  @endif
                </div>
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; font-weight: 600; color: #0F172A;">{{ $u->username ?? '-' }}</span>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; color: #334155;">{{ $u->email }}</span>
            </td>
            <td>
              @if($u->role === 'superadmin')
                <span class="badge" style="background-color: #4C1D95; color: #FFFFFF; font-weight: 800; border: 1px solid #6D28D9; box-shadow: 0 2px 6px rgba(76, 29, 149, 0.25);">Super Admin</span>
              @elseif($u->role === 'admin')
                <span class="badge badge-danger">Admin</span>
              @elseif($u->role === 'editor')
                <span class="badge badge-info">Editor</span>
              @elseif(in_array($u->role, ['cs', 'support']))
                <span class="badge" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D;">Customer Support</span>
              @else
                <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1;">Staf Kustom</span>
              @endif
            </td>
            <td>
              @if($u->isSuperAdmin())
                <span style="display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 700; color: #6D28D9; background: #EDE9FE; padding: 3px 8px; border-radius: 6px; border: 1px solid #DDD6FE;">
                  <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                  Semua Modul (Full Access)
                </span>
              @elseif($u->role === 'admin' && empty($u->permissions))
                <span style="display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; color: #1E293B; background: #F1F5F9; padding: 3px 8px; border-radius: 6px;">
                  Semua Modul Admin
                </span>
              @else
                @php
                  $perms = $u->permissions ?? \App\Models\User::getDefaultPermissionsForRole($u->role);
                  $count = is_array($perms) ? count($perms) : 0;
                @endphp
                <div style="display: flex; flex-direction: column; gap: 4px;">
                  <span style="font-size: 12px; font-weight: 700; color: #0F172A;">
                    {{ $count }} Modul Diizinkan
                  </span>
                  <span style="font-size: 11px; color: #64748B; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ implode(', ', $perms) }}">
                    {{ implode(', ', array_slice($perms, 0, 3)) }}{{ $count > 3 ? '...' : '' }}
                  </span>
                </div>
              @endif
            </td>
            <td>
              @if($u->is_active)
                <span class="badge badge-success">Aktif</span>
              @else
                <span class="badge badge-neutral">Nonaktif</span>
              @endif
            </td>
            <td>
              <span style="font-size: 12px; color: #64748B;">{{ $u->created_at->format('d M Y') }}</span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                @if(auth()->user()->isSuperAdmin() || !$u->isSuperAdmin())
                  <a href="{{ route('backoffice.users.edit', $u->id) }}" class="btn btn-secondary btn-sm">
                    Edit
                  </a>
                @endif
                
                @if(auth()->id() !== $u->id && (auth()->user()->isSuperAdmin() || !$u->isSuperAdmin()))
                  <form action="{{ route('backoffice.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $u->name }}?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      Hapus
                    </button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @if($users->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
      {{ $users->links() }}
    </div>
  @endif
</div>
@endsection
