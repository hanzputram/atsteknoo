@extends('backoffice.layouts.app')

@section('title', 'Live Chat Support')
@section('breadcrumb', 'Live Chat Support')

@section('content')
<div class="page-header">
  <div>
    <div style="display: flex; align-items: center; gap: 10px;">
      <h1 class="page-title">Live Chat Konsultasi Pengunjung</h1>
      @if($unreadCount > 0)
        <span class="badge badge-danger" style="font-size: 11px; padding: 4px 10px;">
          {{ $unreadCount }} Pesan Baru
        </span>
      @endif
    </div>
    <p class="page-subtitle">Tangani pertanyaan teknis panel, BoQ, dan konsultasi engineer dari website secara real-time.</p>
  </div>

  <div style="display: flex; gap: 8px; flex-wrap: wrap;">
    <a href="{{ route('backoffice.live-chats.index') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-secondary' }} btn-sm">Semua Sesi</a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'unread']) }}" class="btn {{ request('status') === 'unread' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Belum Dibalas</a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'active']) }}" class="btn {{ request('status') === 'active' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Aktif</a>
    <a href="{{ route('backoffice.live-chats.index', ['status' => 'closed']) }}" class="btn {{ request('status') === 'closed' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Selesai</a>
  </div>
</div>

<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th>Pengunjung</th>
          <th>Kontak / WhatsApp</th>
          <th>Pesan Terakhir</th>
          <th style="width: 130px;">Status</th>
          <th style="width: 160px;">Aktivitas Terakhir</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sessions as $session)
          <tr style="{{ $session->status === 'unread' ? 'background-color: #FEF2F2;' : '' }}">
            <td>
              <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: #F1F5F9; color: #0F172A; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; flex-shrink: 0; border: 1.5px solid #CBD5E1;">
                  {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
                </div>
                <div>
                  <div style="font-weight: 700; color: #0F172A;">{{ $session->visitor_name }}</div>
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
                  @if($session->latestMessage->sender === 'admin')
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
              @if($session->status === 'unread')
                <span class="badge badge-danger">Perlu Balasan</span>
              @elseif($session->status === 'active')
                <span class="badge badge-success">Aktif</span>
              @else
                <span class="badge badge-neutral">Selesai</span>
              @endif
            </td>
            <td>
              <span style="color: #64748B; font-size: 12.5px;">
                {{ $session->last_message_at ? $session->last_message_at->diffForHumans() : $session->created_at->diffForHumans() }}
              </span>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; gap: 6px;">
                <a href="{{ route('backoffice.live-chats.show', $session->id) }}" class="btn btn-primary btn-sm">
                  Balas Chat
                </a>
                <form action="{{ route('backoffice.live-chats.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat sesi chat ini?')" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 48px 16px; color: #94A3B8;">
              <div style="font-size: 32px; margin-bottom: 8px;">💬</div>
              <div style="font-weight: 600; color: #475569; font-size: 15px;">Belum ada obrolan live chat masuk.</div>
              <div style="font-size: 12.5px; color: #94A3B8; margin-top: 4px;">Pesan dari widget live chat website akan muncul di sini secara otomatis.</div>
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
