@extends('backoffice.layouts.app')

@section('title', 'Live Chat Support')
@section('breadcrumb', 'Live Chat Support')

@section('content')
<div class="page-header">
  <div>
    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
      <h1 class="page-title">Live Chat Konsultasi Pengunjung</h1>
      @if($unreadCount > 0)
        <span class="badge badge-danger" style="font-size: 11px; padding: 4px 10px;">
          {{ $unreadCount }} Pesan Baru
        </span>
      @endif
      @if($takeoverCount > 0)
        <span class="badge badge-danger" style="font-size: 11px; padding: 4px 10px; background: #991B1B; color: #FFFFFF; animation: pulse 2s infinite;">
          ⚠️ {{ $takeoverCount }} Butuh Bantuan Admin
        </span>
      @endif
    </div>
    <p class="page-subtitle">Tangani pertanyaan teknis panel, BoQ, dan konsultasi dari website secara real-time dengan bantuan ATS Support Auto-Reply.</p>
  </div>

  <div style="display: flex; gap: 8px; flex-wrap: wrap;">
    <a href="{{ route('backoffice.live-chats.index') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-secondary' }} btn-sm">
      Semua Sesi
    </a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'unread']) }}" class="btn {{ request('status') === 'unread' ? 'btn-primary' : 'btn-secondary' }} btn-sm">
      Belum Dibalas @if($unreadCount > 0)<span style="margin-left: 4px; padding: 1px 6px; border-radius: 999px; background: rgba(255,255,255,0.3); font-size: 10px;">{{ $unreadCount }}</span>@endif
    </a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'active']) }}" class="btn {{ request('status') === 'active' ? 'btn-primary' : 'btn-secondary' }} btn-sm">
      Aktif @if($activeCount > 0)<span style="margin-left: 4px; opacity: 0.8; font-size: 10px;">({{ $activeCount }})</span>@endif
    </a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'closed']) }}" class="btn {{ request('status') === 'closed' ? 'btn-primary' : 'btn-secondary' }} btn-sm">
      Selesai @if($closedCount > 0)<span style="margin-left: 4px; opacity: 0.8; font-size: 10px;">({{ $closedCount }})</span>@endif
    </a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'archived']) }}" class="btn {{ request('status') === 'archived' ? 'btn-primary' : 'btn-secondary' }} btn-sm" style="border-left: 2px solid #64748B;">
      📁 Arsip @if($archivedCount > 0)<span style="margin-left: 4px; padding: 1px 6px; border-radius: 999px; background: #64748B; color: #FFF; font-size: 10px;">{{ $archivedCount }}</span>@endif
    </a>
  </div>
</div>

@if($takeoverCount > 0 && request('status') !== 'archived')
  <div style="margin-bottom: 20px; padding: 14px 18px; border-radius: 12px; background: #FEF2F2; border: 1.5px solid #FCA5A5; display: flex; align-items: center; justify-content: space-between; gap: 14px;">
    <div style="display: flex; align-items: center; gap: 12px;">
      <span style="font-size: 24px;">🚨</span>
      <div>
        <div style="font-weight: 700; color: #991B1B; font-size: 14px;">Eskalasi AI: Pengunjung Memerlukan Balasan Langsung Admin!</div>
        <div style="color: #7F1D1D; font-size: 12px; margin-top: 2px;">
          Terdapat pertanyaan seputar penawaran harga khusus / diskon proyek / desain panel rumit yang memerlukan konfirmasi langsung oleh engineer ATS.
        </div>
      </div>
    </div>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'unread']) }}" class="btn btn-danger btn-sm" style="flex-shrink: 0;">
      Tinjau Pesan &rarr;
    </a>
  </div>
@endif

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Pengunjung</th>
          <th>Kontak / WhatsApp</th>
          <th>Pesan Terakhir</th>
          <th style="width: 150px;">Status &amp; AI</th>
          <th style="width: 150px;">Aktivitas Terakhir</th>
          <th style="text-align: right; width: 180px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sessions as $session)
          <tr style="{{ $session->needs_human_takeover ? 'background-color: #FFF1F2;' : ($session->status === 'unread' ? 'background-color: #FEF2F2;' : '') }}">
            <td>
              <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $session->needs_human_takeover ? '#FFE4E6' : '#F1F5F9' }}; color: {{ $session->needs_human_takeover ? '#E11D48' : '#0F172A' }}; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; flex-shrink: 0; border: 1.5px solid {{ $session->needs_human_takeover ? '#FDA4AF' : '#CBD5E1' }};">
                  {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
                </div>
                <div>
                  <div style="font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 6px;">
                    <span>{{ $session->visitor_name }}</span>
                    @if($session->needs_human_takeover)
                      <span title="AI menyarankan bantuan admin untuk sesi ini" style="font-size: 12px;">⚠️</span>
                    @endif
                  </div>
                  <div style="font-size: 11px; color: #94A3B8; font-family: monospace;">Token: {{ substr($session->session_token, 0, 10) }}...</div>
                </div>
              </div>
            </td>
            <td>
              @if($session->visitor_contact)
                <div style="font-weight: 600; color: #0F172A; font-family: monospace; font-size: 13px;">{{ $session->visitor_contact }}</div>
                @if(preg_match('/^[0-9+]+$/', str_replace([' ', '-'], '', $session->visitor_contact)))
                  <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $session->visitor_contact) }}" target="_blank" style="color: #059669; font-size: 11px; font-weight: 700; text-decoration: underline; display: block; margin-top: 2px;">
                    Buka WhatsApp &rarr;
                  </a>
                @endif
              @else
                <span style="color: #94A3B8; font-style: italic; font-size: 12px;">Tidak dicantumkan</span>
              @endif
            </td>
            <td style="max-width: 280px;">
              @if($session->latestMessage)
                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 13px;">
                  @if($session->latestMessage->is_ai)
                    <span style="color: #0284C7; font-weight: 700;">ATS Support:</span>
                  @elseif($session->latestMessage->sender === 'admin')
                    <span style="color: #FC0001; font-weight: 700;">Admin:</span>
                  @else
                    <span style="color: #64748B;">Tamu:</span>
                  @endif
                  <span style="color: #334155;">{{ $session->latestMessage->message }}</span>
                </div>
              @else
                <span style="color: #94A3B8; font-style: italic; font-size: 12px;">Belum ada pesan</span>
              @endif
            </td>
            <td>
              <div style="display: flex; flex-direction: column; gap: 4px; align-items: flex-start;">
                @if($session->is_archived)
                  <span class="badge badge-neutral" style="background: #64748B; color: #FFFFFF;">📁 Diarsipkan</span>
                @elseif($session->needs_human_takeover)
                  <span class="badge badge-danger" style="background: #E11D48; color: #FFF; font-weight: 700; animation: pulse 2s infinite;">⚠️ Butuh Bantuan Admin</span>
                @elseif($session->status === 'unread')
                  <span class="badge badge-danger">Perlu Balasan</span>
                @elseif($session->status === 'active')
                  <span class="badge badge-success">Aktif</span>
                @else
                  <span class="badge badge-neutral">Selesai</span>
                @endif

                @if(!$session->is_archived)
                  @if($session->ai_enabled)
                    <span style="font-size: 10px; color: #0284C7; font-weight: 600; display: inline-flex; align-items: center; gap: 3px;">
                      <span>⚡</span> Auto-Reply Aktif
                    </span>
                  @else
                    <span style="font-size: 10px; color: #94A3B8; font-weight: 600; display: inline-flex; align-items: center; gap: 3px;">
                      <span>⏸️</span> Auto-Reply Dijeda
                    </span>
                  @endif
                @endif
              </div>
            </td>
            <td>
              <span style="color: #64748B; font-size: 12.5px;">
                {{ $session->last_message_at ? $session->last_message_at->diffForHumans() : $session->created_at->diffForHumans() }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px; align-items: center;">
                <a href="{{ route('backoffice.live-chats.show', $session->id) }}" class="btn btn-primary btn-sm">
                  Balas
                </a>

                @if($session->is_archived)
                  <form action="{{ route('backoffice.live-chats.unarchive', $session->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm" title="Keluarkan dari arsip dan aktifkan kembali">
                      Batal Arsip
                    </button>
                  </form>
                @else
                  <form action="{{ route('backoffice.live-chats.archive', $session->id) }}" method="POST" onsubmit="return confirm('Pindahkan sesi chat ini ke Arsip?')" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm" title="Arsipkan sesi ini agar tidak memenuhi inbox">
                      Arsipkan
                    </button>
                  </form>
                @endif

                <form action="{{ route('backoffice.live-chats.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Hapus permanen riwayat sesi chat ini?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" title="Hapus permanen">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 48px 16px; color: #94A3B8;">
              <div style="font-size: 32px; margin-bottom: 8px;">{{ request('status') === 'archived' ? '📁' : '💬' }}</div>
              <div style="font-weight: 600; color: #475569; font-size: 15px;">
                {{ request('status') === 'archived' ? 'Belum ada sesi chat yang diarsipkan.' : 'Belum ada obrolan live chat masuk.' }}
              </div>
              <div style="font-size: 12.5px; color: #94A3B8; margin-top: 4px;">
                {{ request('status') === 'archived' ? 'Sesi yang diarsipkan akan tersimpan di sini dan dapat dipulihkan kapan saja.' : 'Pesan dari widget live chat website akan muncul di sini secara otomatis.' }}
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($sessions->hasPages())
    <div style="padding: 16px; border-top: 1px solid var(--color-border);">
      {{ $sessions->links() }}
    </div>
  @endif
</div>
@endsection

