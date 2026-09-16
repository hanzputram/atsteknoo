@extends('backoffice.layouts.app')

@section('title', 'Manajemen Pengguna')
@section('breadcrumb', 'Pengguna Backoffice')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Akun Pengguna Backoffice</h1>
    <p class="page-subtitle">Kelola akses staf admin dan editor website katalog PT. Anugerah Tama Sejati.</p>
  </div>

  <a href="{{ route('backoffice.users.create') }}" class="btn btn-primary">
    + Tambah Pengguna
  </a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Nama Staf</th>
          <th>Email Login</th>
          <th style="width: 120px;">Peran (Role)</th>
          <th style="width: 120px;">Status</th>
          <th style="width: 150px;">Dibuat Pada</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr>
            <td>
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: #0F172A; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; flex-shrink: 0; border: 2px solid #FC0001;">
                  {{ strtoupper(substr($u->name, 0, 1)) }}
                </div>
                <div>
                  <div style="font-weight: 700; color: #0F172A;">{{ $u->name }}</div>
                  @if(auth()->id() === $u->id)
                    <span style="font-size: 11px; color: #E11D48; font-weight: 700;">(Akun Anda)</span>
                  @endif
                </div>
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; color: #334155;">{{ $u->email }}</span>
            </td>
            <td>
              @if($u->role === 'admin')
                <span class="badge badge-danger">Admin</span>
              @elseif($u->role === 'editor')
                <span class="badge badge-info">Editor</span>
              @elseif(in_array($u->role, ['cs', 'support']))
                <span class="badge" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D;">Customer Support</span>
              @else
                <span class="badge badge-secondary">{{ ucfirst($u->role) }}</span>
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
              <span style="font-size: 12.5px; color: #64748B;">{{ $u->created_at->format('d M Y') }}</span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('backoffice.users.edit', $u->id) }}" class="btn btn-secondary btn-sm">
                  Edit
                </a>
                @if(auth()->id() !== $u->id)
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
