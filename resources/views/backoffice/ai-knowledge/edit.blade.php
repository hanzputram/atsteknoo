@extends('backoffice.layouts.app')

@section('title', 'Edit Pengetahuan & Memori AI')
@section('breadcrumb', 'Edit Pengetahuan AI')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Edit Pengetahuan &amp; Memori AI</h1>
    <p class="page-subtitle">Perbarui informasi topik: <strong>{{ $knowledge->title }}</strong></p>
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
      <form action="{{ route('backoffice.ai-knowledge.update', $knowledge->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label" for="title">Judul Topik Pengetahuan <span style="color:#EF4444;">*</span></label>
          <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $knowledge->title) }}"
            class="form-control @error('title') is-invalid @enderror"
            required
          >
          @error('title')
            <span class="form-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="form-group">
            <label class="form-label" for="category">Kategori Pengetahuan <span style="color:#EF4444;">*</span></label>
            <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" required>
              @foreach($categories as $catKey => $catLabel)
                <option value="{{ $catKey }}" {{ old('category', $knowledge->category) === $catKey ? 'selected' : '' }}>
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
              value="{{ old('priority', $knowledge->priority) }}"
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
            value="{{ old('trigger_keywords', $knowledge->trigger_keywords) }}"
            placeholder="Contoh: inverter, atv310, variable speed drive, motor ac, altivar"
            class="form-control"
          >
          <span class="form-hint">Pisahkan dengan tanda koma (,).</span>
        </div>

        <div class="form-group">
          <label class="form-label" for="content">Materi Pengetahuan / Instruksi AI <span style="color:#EF4444;">*</span></label>
          <textarea
            id="content"
            name="content"
            rows="8"
            class="form-control @error('content') is-invalid @enderror"
            required
            style="font-family: inherit; font-size: 13.5px; line-height: 1.6;"
          >{{ old('content', $knowledge->content) }}</textarea>
          @error('content')
            <span class="form-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group" style="margin-bottom: 24px;">
          <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $knowledge->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px;">
            <span style="font-weight: 600; font-size: 13.5px; color: #0F172A;">Aktifkan Pengetahuan Ini</span>
          </label>
          <span class="form-hint" style="margin-left: 28px;">Jika dimatikan, AI akan mengabaikan memori ini saat membalas pengunjung.</span>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; border-top: 1px solid var(--color-border); padding-top: 20px;">
          <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700;">
            Simpan Perubahan
          </button>
          <a href="{{ route('backoffice.ai-knowledge.index') }}" class="btn btn-secondary">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Info Sidebar -->
  <div>
    <div class="panel-card" style="padding: 20px; background: #F8FAFC; border: 1px solid #E2E8F0;">
      <h3 style="font-size: 14px; font-weight: 700; color: #0F172A; margin-bottom: 12px;">
        ℹ️ Informasi Memori
      </h3>

      <div style="font-size: 12px; color: #64748B; display: flex; flex-direction: column; gap: 8px;">
        <div>
          <span style="font-weight: 600; color: #334155;">ID Memori:</span> #{{ $knowledge->id }}
        </div>
        <div>
          <span style="font-weight: 600; color: #334155;">Dibuat Pada:</span> {{ $knowledge->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
        </div>
        <div>
          <span style="font-weight: 600; color: #334155;">Terakhir Diubah:</span> {{ $knowledge->updated_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
        </div>
        <div>
          <span style="font-weight: 600; color: #334155;">Status Sekarang:</span>
          @if($knowledge->is_active)
            <span style="color: #059669; font-weight: 700;">Aktif Digunakan AI</span>
          @else
            <span style="color: #94A3B8; font-weight: 700;">Nonaktif (Diabaikan)</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
