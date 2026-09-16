@extends('backoffice.layouts.app')

@section('title', 'Tambah Pengetahuan & Memori AI')
@section('breadcrumb', 'Tambah Pengetahuan AI')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tambah Pengetahuan &amp; Memori Baru</h1>
    <p class="page-subtitle">Ajari ATS Support informasi baru seputar produk, penawaran harga, atau cara menjawab pertanyaan tertentu.</p>
  </div>
  <div>
    <a href="{{ route('backoffice.ai-knowledge.index') }}" class="btn btn-secondary">
      &larr; Kembali ke Daftar
    </a>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Main Form -->
  <div class="md:grid-cols-2" style="grid-column: span 2;">
    <div class="panel-card" style="padding: 24px;">
      <form action="{{ route('backoffice.ai-knowledge.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label" for="title">Judul Topik Pengetahuan <span style="color:#EF4444;">*</span></label>
          <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title') }}"
            placeholder="Contoh: Pengadaan Inverter Altivar ATV310 Ready Stock"
            class="form-control @error('title') is-invalid @enderror"
            required
          >
          <span class="form-hint">Beri judul yang jelas agar mudah dicari dan diorganisasi oleh admin.</span>
          @error('title')
            <span class="form-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="form-group">
            <label class="form-label" for="category">Kategori Pengetahuan <span style="color:#EF4444;">*</span></label>
            <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" required>
              @foreach($categories as $catKey => $catLabel)
                <option value="{{ $catKey }}" {{ old('category') === $catKey ? 'selected' : '' }}>
                  {{ $catLabel }}
                </option>
              @endforeach
            </select>
            @error('category')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="priority">Urutan Prioritas</label>
            <input
              type="number"
              id="priority"
              name="priority"
              value="{{ old('priority', 10) }}"
              class="form-control"
              min="0"
              max="9999"
            >
            <span class="form-hint">Nilai lebih kecil dibaca lebih awal oleh AI (default: 10).</span>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="trigger_keywords">Kata Kunci Terkait (Trigger Keywords)</label>
          <input
            type="text"
            id="trigger_keywords"
            name="trigger_keywords"
            value="{{ old('trigger_keywords') }}"
            placeholder="Contoh: inverter, atv310, variable speed drive, motor ac, altivar"
            class="form-control"
          >
          <span class="form-hint">Pisahkan dengan tanda koma (,). Membantu AI mengenali konteks saat pengunjung menyebut kata-kata ini.</span>
        </div>

        <div class="form-group">
          <label class="form-label" for="content">Materi Pengetahuan / Instruksi AI <span style="color:#EF4444;">*</span></label>
          <textarea
            id="content"
            name="content"
            rows="8"
            class="form-control @error('content') is-invalid @enderror"
            placeholder="Tuliskan fakta, spesifikasi, atau instruksi cara menjawab. Anda bisa menuliskan dalam bentuk paragraf atau tanya jawab (FAQ)..."
            required
            style="font-family: inherit; font-size: 13.5px; line-height: 1.6;"
          >{{ old('content') }}</textarea>
          <span class="form-hint">Tuliskan informasi sejelas dan sepadat mungkin. AI akan mengintegrasikan teks ini ke dalam logikanya.</span>
          @error('content')
            <span class="form-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group" style="margin-bottom: 24px;">
          <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 18px; height: 18px;">
            <span style="font-weight: 600; font-size: 13.5px; color: #0F172A;">Aktifkan Pengetahuan Ini Sekarang</span>
          </label>
          <span class="form-hint" style="margin-left: 28px;">Jika dicentang, AI akan langsung mengingat dan menggunakan materi ini pada chat berikutnya.</span>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; border-top: 1px solid var(--color-border); padding-top: 20px;">
          <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700;">
            Simpan &amp; Ajarkan ke AI
          </button>
          <a href="{{ route('backoffice.ai-knowledge.index') }}" class="btn btn-secondary">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Tips & Guide Sidebar -->
  <div>
    <div class="panel-card" style="padding: 20px; background: #F8FAFC; border: 1px solid #E2E8F0;">
      <h3 style="font-size: 14px; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
        💡 Tips Mengajari AI
      </h3>

      <div style="font-size: 12.5px; color: #475569; line-height: 1.6; display: flex; flex-direction: column; gap: 12px;">
        <div>
          <strong style="color: #0F172A;">1. Format Tanya Jawab (FAQ)</strong>
          <p style="margin-top: 2px;">Jika ingin AI menjawab pertanyaan spesifik, tuliskan seperti:</p>
          <div style="background: #FFFFFF; border: 1px solid #CBD5E1; padding: 8px 10px; border-radius: 6px; font-family: monospace; font-size: 11px; margin-top: 4px;">
            Tanya: Apakah ada minimal order?<br>
            Jawab: Untuk komponen retail Schneider tidak ada minimum order. Untuk fabrikasi panel kustom, kami buatkan sesuai BoQ.
          </div>
        </div>

        <div>
          <strong style="color: #0F172A;">2. Informasi Promo / Diskon</strong>
          <p style="margin-top: 2px;">Jelaskan syarat dan diskon yang berlaku:</p>
          <div style="background: #FFFFFF; border: 1px solid #CBD5E1; padding: 8px 10px; border-radius: 6px; font-family: monospace; font-size: 11px; margin-top: 4px;">
            Diskon kontraktor panel: Untuk pembelian MCCB & Kontaktor di atas 20 unit ada diskon proyek khusus. Hubungi WhatsApp untuk penawaran resmi.
          </div>
        </div>

        <div>
          <strong style="color: #0F172A;">3. Batasan / Hal yang Dilarang</strong>
          <p style="margin-top: 2px;">Jika Anda ingin melarang AI menjanjikan sesuatu:</p>
          <div style="background: #FFFFFF; border: 1px solid #CBD5E1; padding: 8px 10px; border-radius: 6px; font-family: monospace; font-size: 11px; margin-top: 4px;">
            Jangan janjikan pengiriman di hari yang sama untuk panel kustom karena perakitan membutuhkan waktu QC & uji FAT 3-5 hari kerja.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
