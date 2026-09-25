@extends('backoffice.layouts.app')

@section('title', 'Detail Pesan Masuk')
@section('breadcrumb', 'Detail Pesan Masuk')

@section('content')
<div class="page-header">
  <div style="display: flex; align-items: center; gap: 14px;">
    <a href="{{ route('backoffice.inquiries.index') }}" class="btn btn-secondary btn-sm">
      &larr; Kembali
    </a>
    <div>
      <h1 class="page-title">{{ $inquiry->subject ?: '(Tanpa Subjek)' }}</h1>
      <p class="page-subtitle">Diterima pada {{ $inquiry->created_at->format('d F Y, H:i:s') }} ({{ $inquiry->created_at->diffForHumans() }})</p>
    </div>
  </div>

  <!-- Form Ubah Status -->
  <form action="{{ route('backoffice.inquiries.status', $inquiry->id) }}" method="POST" style="display: flex; align-items: center; gap: 8px;">
    @csrf
    <label style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Status:</label>
    <select name="status" onchange="this.form.submit()" style="padding: 6px 12px; font-size: 13px; border-radius: 8px; border: 1px solid var(--color-border); font-weight: 600; background: #FFF;">
      <option value="unread" {{ $inquiry->status === 'unread' ? 'selected' : '' }}>Baru / Belum Dibaca</option>
      <option value="read" {{ $inquiry->status === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
      <option value="handled" {{ $inquiry->status === 'handled' ? 'selected' : '' }}>Selesai Ditangani</option>
      <option value="spam" {{ $inquiry->status === 'spam' ? 'selected' : '' }}>Tandai Spam</option>
    </select>
  </form>
</div>

<div class="panel-card" style="max-width: 900px;">
  <div class="panel-body" style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Info Status & Pengirim -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 18px; border-bottom: 1px solid var(--color-border);">
      <div>
        <span style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748B; font-weight: 700;">Status Pesan</span>
        <div style="margin-top: 4px;">
          @if($inquiry->status === 'unread')
            <span class="badge badge-danger" style="font-size: 12px; padding: 4px 10px;">Baru / Belum Ditangani</span>
          @elseif($inquiry->status === 'read')
            <span class="badge badge-info" style="font-size: 12px; padding: 4px 10px;">Sudah Dibaca</span>
          @elseif($inquiry->status === 'handled')
            <span class="badge badge-success" style="font-size: 12px; padding: 4px 10px;">Selesai Ditangani</span>
          @else
            <span class="badge badge-neutral" style="font-size: 12px; padding: 4px 10px;">Spam</span>
          @endif
        </div>
      </div>
      <div>
        <span style="font-size: 12px; color: #64748B;">ID Pesan: #INQ-{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }}</span>
      </div>
    </div>

    <!-- Sender Details Box -->
    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
      <div>
        <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748B; margin-bottom: 4px;">Identitas Pengirim</div>
        <div style="font-size: 15px; font-weight: 700; color: #0F172A;">{{ $inquiry->name }}</div>
        @if($inquiry->company)
          <div style="font-size: 13px; color: #475569; margin-top: 2px;">{{ $inquiry->company }}</div>
        @endif
      </div>

      <div>
        <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748B; margin-bottom: 4px;">Kontak Email</div>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($inquiry->email) }}" target="_blank" rel="noopener noreferrer" title="Buka di Gmail" style="font-size: 13.5px; color: #E11D48; font-weight: 600; text-decoration: none;">
          {{ $inquiry->email }}
        </a>
      </div>

      <div>
        <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748B; margin-bottom: 4px;">Nomor Telepon / WA</div>
        @if($inquiry->phone)
          <div style="font-size: 13.5px; font-weight: 600; font-family: monospace; color: #0F172A;">
            {{ $inquiry->phone }}
          </div>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" style="display: inline-block; font-size: 12px; font-weight: 700; color: #059669; text-decoration: underline; margin-top: 2px;">
            Hubungi via WhatsApp &rarr;
          </a>
        @else
          <span style="font-size: 13px; color: #94A3B8; font-style: italic;">Tidak dicantumkan</span>
        @endif
      </div>
    </div>

    <!-- Message Content -->
    <div>
      <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: #475569; margin-bottom: 8px;">
        Isi Pesan / Kebutuhan Proyek
      </div>
      <div style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px; padding: 20px; font-size: 14px; line-height: 1.7; color: #1E293B; white-space: pre-wrap;">{{ $inquiry->message }}</div>
    </div>

    <!-- Actions -->
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; padding-top: 18px; border-top: 1px solid var(--color-border);">
      <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($inquiry->email) }}&su={{ urlencode('Re: ' . $inquiry->subject) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm" title="Balas via Gmail">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          Balas via Email (Gmail)
        </a>
        @if($inquiry->phone)
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}?text={{ urlencode('Halo Bapak/Ibu ' . $inquiry->name . ', terima kasih telah menghubungi PT. Anugerah Tama Sejati.') }}" target="_blank" class="btn btn-secondary btn-sm" style="color: #059669; font-weight: 700;">
            Kirim WhatsApp
          </a>
        @endif
      </div>

      @if(auth()->user()->isAdmin())
        <form action="{{ route('backoffice.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">
            Hapus Pesan
          </button>
        </form>
      @endif
    </div>
  </div>
</div>
@endsection
