@extends('backoffice.layouts.app')

@section('title', 'Tambah Produk Baru')
@section('breadcrumb')
<a href="{{ route('backoffice.products.index') }}">Master Produk</a> / <span>Tambah Produk</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tambah Produk Baru</h1>
    <p class="page-subtitle">Daftarkan komponen baru ke katalog resmi PT. Anugerah Tama Sejati.</p>
  </div>

  <a href="{{ route('backoffice.products.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<form action="{{ route('backoffice.products.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <!-- Left Column: Main Information & Specs -->
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <!-- Section 1: Informasi Pokok -->
      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">1. Informasi Produk</h2>
        </div>
        <div class="panel-body">
          <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="sku">SKU / Kode Referensi *</label>
              <input type="text" name="sku" id="sku" class="form-control" required value="{{ old('sku') }}" placeholder="Contoh: SE-MTZ1-08H1">
              <span class="form-hint">Kunci unik produk (dipertahankan case &amp; tanda hubung).</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="name">Nama Produk *</label>
              <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" placeholder="Contoh: Schneider MasterPact MTZ1 08 H1 ACB">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="short_description">Ringkasan Produk (Plain Text)</label>
            <textarea name="short_description" id="short_description" rows="2" class="form-control" placeholder="Ringkasan 1-2 kalimat untuk kartu katalog...">{{ old('short_description') }}</textarea>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label class="form-label" for="brand_id">Brand Partner *</label>
              <select name="brand_id" id="brand_id" class="form-control">
                <option value="">Pilih Brand</option>
                @foreach($brands as $b)
                  <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="primary_category_id">Kategori Utama *</label>
              <select name="primary_category_id" id="primary_category_id" class="form-control">
                <option value="">Pilih Kategori Utama</option>
                @foreach($categories as $c)
                  <option value="{{ $c->id }}" {{ old('primary_category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Kategori Tambahan</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; max-height: 140px; overflow-y: auto; padding: 8px; border: 1px solid var(--color-border); border-radius: 8px;">
              @foreach($categories as $c)
                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; cursor: pointer;">
                  <input type="checkbox" name="category_ids[]" value="{{ $c->id }}" {{ in_array($c->id, old('category_ids', [])) ? 'checked' : '' }}>
                  <span>{{ $c->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- Section 2: Deskripsi Lengkap (WYSIWYG) -->
      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">2. Deskripsi &amp; Uraian Teknis</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <textarea name="description_html" id="description_html" rows="8" class="form-control" placeholder="Masukkan rincian teknis, aplikasi industri, fitur utama...">{{ old('description_html') }}</textarea>
            <span class="form-hint">HTML akan disanitasi otomatis di server untuk keamanan.</span>
          </div>
        </div>
      </div>

      <!-- Section 3: Spesifikasi Teknis Fleksibel (Repeater) -->
      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between;">
          <div>
            <h2 style="font-size: 16px; font-weight: 700;">3. Spesifikasi Teknis Produk</h2>
            <p style="font-size: 12px; color: #64748B;">Atribut spesifikasi fleksibel (Arus, Tegangan, Pole, Dimensi, Sertifikasi).</p>
          </div>
          <button type="button" class="btn btn-secondary btn-sm" onclick="addSpecRow()">+ Tambah Atribut</button>
        </div>
        <div class="panel-body" style="padding: 16px;">
          <div class="table-responsive">
            <table class="data-table" id="specsTable">
              <thead>
                <tr>
                  <th style="width: 22%;">Kode Atribut</th>
                  <th style="width: 26%;">Label</th>
                  <th style="width: 22%;">Nilai</th>
                  <th style="width: 14%;">Satuan</th>
                  <th style="width: 16%;">Grup</th>
                  <th style="width: 40px;"></th>
                </tr>
              </thead>
              <tbody id="specsContainer">
                <!-- Dynamic Rows added by JS -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Section 4: SEO Metadata -->
      <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 16px; font-weight: 700;">4. Pengaturan SEO (Search Engine Optimization)</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Judul pada Google Search...">
          </div>
          <div class="form-group">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="2" class="form-control" placeholder="Deskripsi ringkasan pada search engine...">{{ old('meta_description') }}</textarea>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Column: Media, Status & Publishing -->
    <div style="display: flex; flex-direction: column; gap: 24px;">

      <!-- Publikasi Card -->
      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Publikasi Produk</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="status">Status Konten *</label>
            <select name="status" id="status" class="form-control">
              <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
              <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
              <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 12px;">
            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
              <span>Tampilkan sebagai Produk Unggulan</span>
            </label>
          </div>

          <div class="form-group">
            <label class="form-label" for="sort_order">Urutan Tampil (Sort Order)</label>
            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
          </div>

          <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan Produk</button>
            <a href="{{ route('backoffice.products.index') }}" class="btn btn-secondary" style="width: 100%;">Batal</a>
          </div>
        </div>
      </div>

      <!-- Media Gambar & PDF Datasheet -->
      <div class="panel-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);">
          <h2 style="font-size: 15px; font-weight: 700;">Media &amp; Dokumen</h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
          <div class="form-group">
            <label class="form-label" for="main_image">Foto Utama Produk *</label>
            <input type="file" name="main_image" id="main_image" class="form-control" accept="image/jpeg,image/png,image/webp">
            <span class="form-hint">JPEG, PNG, atau WEBP (Maksimal 10 MiB).</span>
          </div>

          <div class="form-group">
            <label class="form-label" for="gallery_images">Galeri Foto Tambahan</label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple accept="image/jpeg,image/png,image/webp">
            <span class="form-hint">Dapat memilih beberapa foto sekaligus.</span>
          </div>

          <div class="form-group">
            <label class="form-label" for="datasheet">PDF Datasheet / Spesifikasi Teknis</label>
            <input type="file" name="datasheet" id="datasheet" class="form-control" accept="application/pdf">
            <span class="form-hint">Berkas PDF resmi pabrikan (Maksimal 20 MiB).</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>

@push('scripts')
<script>
let specIndex = 0;

function addSpecRow(code = '', label = '', val = '', unit = '', group = '') {
  const container = document.getElementById('specsContainer');
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td><input type="text" name="specs[${specIndex}][attribute_code]" class="form-control" style="padding: 6px 10px; font-size: 13px;" value="${code}" placeholder="misal: rated_current" required></td>
    <td><input type="text" name="specs[${specIndex}][label]" class="form-control" style="padding: 6px 10px; font-size: 13px;" value="${label}" placeholder="misal: Arus Nominal" required></td>
    <td><input type="text" name="specs[${specIndex}][value]" class="form-control" style="padding: 6px 10px; font-size: 13px;" value="${val}" placeholder="misal: 100"></td>
    <td><input type="text" name="specs[${specIndex}][unit]" class="form-control" style="padding: 6px 10px; font-size: 13px;" value="${unit}" placeholder="A"></td>
    <td><input type="text" name="specs[${specIndex}][group]" class="form-control" style="padding: 6px 10px; font-size: 13px;" value="${group}" placeholder="Elektrikal"></td>
    <td><button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#DC2626; font-size:18px; cursor:pointer;" title="Hapus baris">&times;</button></td>
  `;
  container.appendChild(tr);
  specIndex++;
}

document.addEventListener('DOMContentLoaded', () => {
  // Pre-seed common electrical spec rows if empty
  addSpecRow('rated_current', 'Arus Nominal (In)', '', 'A', 'Elektrikal');
  addSpecRow('voltage_rating', 'Tegangan Operasional (Ue)', '', 'V AC', 'Elektrikal');
  addSpecRow('number_of_poles', 'Jumlah Kutub (Poles)', '', '', 'Mekanikal');
});
</script>
@endpush
@endsection
