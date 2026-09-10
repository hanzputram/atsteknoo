@extends('backoffice.layouts.app')

@section('title', 'Master Sertifikat & Akreditasi')
@section('header', 'Master Sertifikat & Akreditasi')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Master Sertifikat Mitra Resmi</h1>
        <p class="page-subtitle">Kelola sertifikat keagenan dan lisensi resmi prinsipal global yang tampil di halaman About Us.</p>
    </div>
    <a href="{{ route('backoffice.certificates.create') }}" class="btn btn-primary">+ Tambah Sertifikat Baru</a>
</div>

<div class="panel-card">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Preview</th>
                    <th>Judul Sertifikat</th>
                    <th>Prinsipal / Penerbit</th>
                    <th>Badge Status</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $cert)
                <tr>
                    <td>
                        <div style="width: 48px; height: 64px; border-radius: 6px; border: 1px solid #E2E8F0; background: #F8FAFC; overflow: hidden; display: flex; align-items: center; justify-content: center; cursor: pointer;" onclick="window.open('{{ $cert->image_url }}', '_blank')" title="Klik untuk lihat gambar penuh">
                            <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: #0F172A;">{{ $cert->title }}</div>
                        @if($cert->description)
                            <div style="font-size: 12px; color: #64748B; margin-top: 3px; max-width: 450px;">{{ Str::limit($cert->description, 90) }}</div>
                        @endif
                    </td>
                    <td>
                        <span style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; background: #F1F5F9; color: #1E293B;">
                            {{ $cert->partner_name }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-success">{{ $cert->badge_text }}</span>
                    </td>
                    <td>
                        <span style="font-family: monospace; font-size: 12px; font-weight: 700; color: #475569;">{{ $cert->sort_order }}</span>
                    </td>
                    <td>
                        @if($cert->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-neutral">Non-Aktif</span>
                        @endif
                    </td>
                    <td style="text-align: right; white-space: nowrap;">
                        <a href="{{ route('backoffice.certificates.edit', $cert->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('backoffice.certificates.destroy', $cert->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-slate-400">
                            Belum ada sertifikat yang terdaftar. Silakan tambahkan sertifikat baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
