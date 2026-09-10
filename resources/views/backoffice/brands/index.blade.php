@extends('backoffice.layouts.app')

@section('title', 'Brand Resmi')
@section('breadcrumb', 'Brand Resmi')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Brand Mitra Resmi</h1>
    <p class="page-subtitle">Kelola merek prinsipal dan authorized partner PT. Anugerah Tama Sejati.</p>
  </div>

  <a href="{{ route('backoffice.brands.create') }}" class="btn btn-primary">+ Tambah Brand</a>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 80px;">Logo</th>
          <th>Kode Brand</th>
          <th>Nama Brand</th>
          <th>Website Resmi</th>
          <th>Jumlah Produk</th>
          <th>Status</th>
          <th style="text-align: right;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($brands as $brand)
          <tr>
            <td>
              <div style="width: 64px; height: 42px; border-radius: 8px; border: 1px solid #E2E8F0; background: #FFFFFF; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 4px;">
                @if($brand->logo_url)
                  <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                @elseif($brand->logo)
                  <img src="{{ route('media.view', $brand->logo->id) }}" alt="{{ $brand->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                @else
                  <span style="font-size: 11px; font-weight: 700; color: #64748B;">{{ $brand->code }}</span>
                @endif
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-weight: 700; color: #0F172A; background: #F1F5F9; padding: 3px 8px; border-radius: 4px;">{{ $brand->code }}</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A;">
                <a href="{{ route('backoffice.brands.edit', $brand->id) }}" style="color: inherit; text-decoration: none;">
                  {{ $brand->name }}
                </a>
              </div>
            </td>
            <td>
              @if($brand->website_url)
                <a href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer" style="color: #2563EB; font-size: 12.5px; text-decoration: underline;">
                  {{ parse_url($brand->website_url, PHP_URL_HOST) }} &nearr;
                </a>
              @else
                <span style="color: #94A3B8;">-</span>
              @endif
            </td>
            <td>
              <span class="badge badge-info">{{ $brand->products_count }} Produk</span>
            </td>
            <td>
              <span class="badge {{ $brand->is_active ? 'badge-success' : 'badge-neutral' }}">
                {{ $brand->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('brands.show', $brand->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat Halaman Publik">&nearr;</a>
                <a href="{{ route('backoffice.brands.edit', $brand->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('backoffice.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Hapus brand {{ $brand->name }}?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 32px; color: #94A3B8;">Belum ada brand terdaftar.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
