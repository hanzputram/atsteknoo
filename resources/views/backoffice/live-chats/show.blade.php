@extends('backoffice.layouts.app')

@section('title', 'Live Room: ' . $session->visitor_name)
@section('breadcrumb')
  <a href="{{ route('backoffice.live-chats.index') }}">Live Chat</a> / 
  <span>{{ $session->visitor_name }}</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title" style="display: flex; align-items: center; gap: 10px;">
      <span>Ruang Chat: {{ $session->visitor_name }}</span>
      @if($session->needs_human_takeover)
        <span class="badge badge-danger" style="font-size: 11px; padding: 4px 10px; animation: pulse 2s infinite;">
          ⚠️ Butuh Bantuan Admin
        </span>
      @endif
      @if($session->is_archived)
        <span class="badge badge-neutral" style="font-size: 11px; padding: 4px 10px; background: #64748B; color: #FFF;">
          📁 Diarsipkan
        </span>
      @endif
    </h1>
    <p class="page-subtitle">Percakapan langsung dengan pengunjung website secara real-time.</p>
  </div>
  <div>
    <a href="{{ route('backoffice.live-chats.index') }}" class="btn btn-secondary">&larr; Kembali ke Daftar</a>
  </div>
</div>

<div style="display: grid; grid-template-columns: 280px 1fr; gap: 20px; align-items: start;">
  <!-- Sidebar Visitor Detail Card -->
  <div class="panel-card" style="padding: 20px;">
    <div style="text-align: center; padding-bottom: 16px; border-bottom: 1px solid var(--color-border);">
      <div style="width: 56px; height: 56px; border-radius: 50%; background: {{ $session->needs_human_takeover ? '#FFE4E6' : '#F1F5F9' }}; color: {{ $session->needs_human_takeover ? '#E11D48' : '#0F172A' }}; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; margin-bottom: 10px; border: 2px solid {{ $session->needs_human_takeover ? '#FDA4AF' : '#CBD5E1' }};">
        {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
      </div>
      <h3 style="font-size: 15px; font-weight: 700; color: #0F172A; margin: 0 0 4px 0;">{{ $session->visitor_name }}</h3>
      @if($session->is_archived)
        <span class="badge badge-neutral" style="background: #64748B; color: #FFF;">📁 Diarsipkan</span>
      @elseif($session->status === 'unread')
        <span class="badge badge-danger">Perlu Balasan</span>
      @elseif($session->status === 'active')
        <span class="badge badge-success">Sesi Aktif</span>
      @else
        <span class="badge badge-neutral">Selesai</span>
      @endif
    </div>

    <!-- AI Control Card -->
    <div style="background: #FAF5FF; border: 1px solid #E9D5FF; border-radius: 12px; padding: 12px; margin-top: 14px;">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
        <span style="font-size: 12px; font-weight: 700; color: #581C87; display: flex; align-items: center; gap: 5px;">
          <span>🤖</span> AI Auto-Reply
        </span>
        <span class="badge {{ $session->ai_enabled ? 'badge-success' : 'badge-neutral' }}" id="aiStatusBadge">
          {{ $session->ai_enabled ? 'Aktif' : 'Dijeda' }}
        </span>
      </div>
      <p style="font-size: 11px; color: #6B21A8; margin-bottom: 8px; line-height: 1.4;">
        Sistem ATS Support otomatis menjawab pertanyaan seputar katalog &amp; produk resmi saat admin belum mengetik.
      </p>
      <button type="button" onclick="toggleSessionAi()" class="btn btn-secondary btn-sm" id="btnToggleAi" style="width: 100%; justify-content: center; font-size: 11.5px;">
        {{ $session->ai_enabled ? '⏸️ Jeda Auto-Reply (Admin Handle)' : '▶️ Aktifkan Auto-Reply' }}
      </button>
    </div>

    <div style="padding-top: 14px; display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
      <div>
        <span style="color: #64748B; font-size: 11px; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 2px;">Kontak WhatsApp / Email:</span>
        @if($session->visitor_contact)
          <span style="font-family: monospace; font-weight: 700; color: #0F172A; font-size: 13.5px;">{{ $session->visitor_contact }}</span>
          @if(preg_match('/^[0-9+]+$/', str_replace([' ', '-'], '', $session->visitor_contact)))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $session->visitor_contact) }}" target="_blank" class="btn btn-success btn-sm" style="margin-top: 6px; width: 100%; justify-content: center; font-size: 11px; padding: 4px 8px;">
              Buka di WhatsApp &rarr;
            </a>
          @endif
        @else
          <span style="color: #94A3B8; font-style: italic;">Tidak dicantumkan</span>
        @endif
      </div>

      <div>
        <span style="color: #64748B; font-size: 11px; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 2px;">Aktivitas Terakhir:</span>
        <span style="color: #334155;">{{ $session->last_message_at ? $session->last_message_at->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB' : '-' }}</span>
      </div>

      <div>
        <span style="color: #64748B; font-size: 11px; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 2px;">IP Address:</span>
        <span style="font-family: monospace; color: #334155;">{{ $session->ip_address ?: '-' }}</span>
      </div>

      <div>
        <span style="color: #64748B; font-size: 11px; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 2px;">Token Sesi:</span>
        <span style="font-family: monospace; font-size: 10px; color: #94A3B8; word-break: break-all;">{{ $session->session_token }}</span>
      </div>
    </div>

    <div style="border-top: 1px solid var(--color-border); padding-top: 14px; margin-top: 14px; display: flex; flex-direction: column; gap: 8px;">
      @if($session->is_archived)
        <form action="{{ route('backoffice.live-chats.unarchive', $session->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center; font-size: 13px;">
            📁 Pulihkan dari Arsip
          </button>
        </form>
      @else
        <form action="{{ route('backoffice.live-chats.archive', $session->id) }}" method="POST" onsubmit="return confirm('Pindahkan sesi chat ini ke Arsip?')">
          @csrf
          <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center; font-size: 13px;">
            📁 Arsipkan Sesi Ini
          </button>
        </form>
      @endif

      @if($session->status !== 'closed' && !$session->is_archived)
        <form action="{{ route('backoffice.live-chats.close', $session->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center; font-size: 13px;">
            Tandai Selesai
          </button>
        </form>
      @endif

      <form action="{{ route('backoffice.live-chats.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Hapus seluruh riwayat chat ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" style="width: 100%; justify-content: center; font-size: 13px;">
          Hapus Sesi Chat
        </button>
      </form>
    </div>
  </div>

  <!-- Live Chat Room Container -->
  <div class="panel-card" style="display: flex; flex-direction: column; height: 660px;">
    <!-- Room Bar (Clean White with ATS Red Border) -->
    <div style="padding: 14px 20px; background: #FFFFFF; color: #0F172A; display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #FC0001; flex-shrink: 0;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 10px; height: 10px; border-radius: 50%; background: #22C55E; display: inline-block;"></span>
        <span style="font-weight: 700; font-size: 14.5px; color: #0F172A;">Live Room: {{ $session->visitor_name }}</span>
      </div>
      <span style="font-size: 12px; color: #059669; font-weight: 700;">● Terhubung (Live Sync)</span>
    </div>

    <!-- Urgent Takeover Alert Banner -->
    <div id="adminTakeoverAlert" style="display: {{ $session->needs_human_takeover ? 'flex' : 'none' }}; padding: 10px 18px; background: #FFF1F2; border-bottom: 1.5px solid #FDA4AF; align-items: center; justify-content: space-between; gap: 12px;">
      <div style="display: flex; align-items: center; gap: 8px; color: #9F1239; font-size: 12.5px; font-weight: 700;">
        <span style="font-size: 16px;">⚠️</span>
        <span>Eskalasi AI: Pengunjung membutuhkan konfirmasi harga resmi atau konsultasi BoQ langsung dari Admin.</span>
      </div>
      <span style="font-size: 11px; background: #FFE4E6; color: #BE123C; padding: 2px 8px; border-radius: 999px; font-weight: 700;">Segera Balas</span>
    </div>

    <!-- Chat Messages Stream -->
    <div id="adminChatStream" style="flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 14px; background: #F8FAFC;">
      <div id="adminMessagesList" style="display: flex; flex-direction: column; gap: 14px;">
        @forelse($session->messages as $msg)
          @if($msg->is_ai)
            <!-- ATS Support Auto-Reply Bubble (Right side) -->
            <div style="display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px;">
              <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-end;">
                <span style="font-size: 10.5px; color: #0284C7; margin-bottom: 3px; font-weight: 700; display: flex; align-items: center; gap: 4px;">
                  ATS Support (Auto) • {{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                </span>
                <div style="background-color: #F0F9FF; color: #0369A1; border: 1px solid #BAE6FD; padding: 10px 14px; border-radius: 14px 14px 2px 14px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 1px 3px rgba(2, 132, 199, 0.08);">{!! \App\Services\ChatFormatter::format($msg->message) !!}</div>
              </div>
              <div style="width: 32px; height: 32px; border-radius: 50%; background: #0284C7; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 10px; flex-shrink: 0; box-shadow: 0 1px 4px rgba(2, 132, 199, 0.3);">
                ATS
              </div>
            </div>
          @elseif($msg->sender === 'admin')
            <!-- Admin Bubble (Right side, Official ATS Red) -->
            <div style="display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px;">
              <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-end;">
                <span style="font-size: 10.5px; color: #94A3B8; margin-bottom: 3px; font-weight: 600;">
                  {{ $msg->admin ? $msg->admin->name : 'ATS Support' }} • {{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                </span>
                <div style="background-color: #FC0001; color: #FFFFFF; padding: 10px 14px; border-radius: 14px 14px 2px 14px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 2px 6px rgba(252, 0, 1, 0.25);">{!! \App\Services\ChatFormatter::format($msg->message) !!}</div>
              </div>
              <div style="width: 32px; height: 32px; border-radius: 50%; background: #FFFFFF; color: #FC0001; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 10px; border: 1.5px solid #FC0001; box-shadow: 0 1px 4px rgba(252, 0, 1, 0.2); flex-shrink: 0;">
                ATS
              </div>
            </div>
          @else
            <!-- Visitor Bubble (Left side) -->
            <div style="display: flex; justify-content: flex-start; align-items: flex-end; gap: 10px;">
              <div style="width: 32px; height: 32px; border-radius: 50%; background: #F1F5F9; color: #0F172A; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 10px; border: 1px solid #CBD5E1; flex-shrink: 0;">
                {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
              </div>
              <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-start;">
                <span style="font-size: 10.5px; color: #94A3B8; margin-bottom: 3px; font-weight: 600;">
                  {{ $session->visitor_name }} • {{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                </span>
                <div style="background-color: #FFFFFF; color: #0F172A; border: 1px solid var(--color-border); padding: 10px 14px; border-radius: 14px 14px 14px 2px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">{!! \App\Services\ChatFormatter::format($msg->message) !!}</div>
              </div>
            </div>
          @endif
        @empty
          <div style="text-align: center; padding: 48px; color: #94A3B8;" id="adminChatEmptyPlaceholder">
            Belum ada pesan dalam sesi ini.
          </div>
        @endforelse
      </div>

      <!-- Visitor Typing Indicator in Backoffice Room -->
      <div id="adminTypingIndicator" style="display: none; align-items: flex-end; gap: 10px; margin-top: 4px;">
        <div style="width: 32px; height: 32px; border-radius: 50%; background: #F1F5F9; color: #0F172A; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 10px; border: 1px solid #CBD5E1; flex-shrink: 0;">
          {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
        </div>
        <div style="background: #E2E8F0; padding: 8px 14px; border-radius: 12px 12px 12px 2px; font-size: 12px; color: #475569; display: flex; align-items: center; gap: 6px;">
          <span class="typing-dot"></span>
          <span class="typing-dot"></span>
          <span class="typing-dot"></span>
          <span style="margin-left: 4px;" id="adminTypingLabel">{{ $session->visitor_name }} sedang mengetik...</span>
        </div>
      </div>
    </div>

    <!-- Quick BoQ & Reply Box -->
    <div style="padding: 16px 20px; background: #FFFFFF; border-top: 1px solid var(--color-border); flex-shrink: 0;">
      <!-- Quick Snippets -->
      <div style="display: flex; gap: 6px; margin-bottom: 10px; overflow-x: auto; padding-bottom: 4px;">
        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 11px; padding: 3px 8px; white-space: nowrap;" onclick="insertQuickSnippet('Halo Pak/Bu! Terima kasih telah menghubungi PT. Anugerah Tama Sejati. Ada spesifikasi komponen atau kebutuhan panel yang bisa kami bantu hitungkan?')">
          👋 Sapaan Awal
        </button>
        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 11px; padding: 3px 8px; white-space: nowrap;" onclick="insertQuickSnippet('Untuk penawaran harga resmi dan diskon proyek distributor, mohon lampirkan file BoQ (Bill of Quantity) atau diagram Single Line melalui email sales@atstekno.com atau WhatsApp kami di +62 822 2333 2830.')">
          📋 Minta BoQ / Single Line
        </button>
        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 11px; padding: 3px 8px; white-space: nowrap;" onclick="insertQuickSnippet('Semua produk Schneider, Vinsa, GAE, dan Legrand yang kami sediakan 100% original bergaransi resmi dengan sertifikat origin pabrik. Barang ready stock di gudang Surabaya.')">
          🛡️ Keaslian &amp; Garansi
        </button>
      </div>

      <form onsubmit="submitAdminReply(event)" style="display: flex; gap: 10px; align-items: flex-end;">
        <div style="flex: 1;">
          <textarea
            id="replyMessageInput"
            class="form-control"
            rows="2"
            placeholder="Ketik balasan Anda di sini... (Tekan Enter untuk kirim, Shift + Enter untuk baris baru)"
            style="resize: none; font-size: 13.5px; border-radius: 8px;"
            required
          ></textarea>
        </div>
        <button type="submit" class="btn btn-primary" id="adminSendBtn" style="height: 52px; padding: 0 20px; font-weight: 700;">
          <span>Kirim Balasan</span>
        </button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
.typing-dot {
  width: 5px;
  height: 5px;
  background-color: #64748B;
  border-radius: 50%;
  display: inline-block;
  animation: typingBounce 1.4s infinite ease-in-out both;
}
.typing-dot:nth-child(1) { animation-delay: -0.32s; }
.typing-dot:nth-child(2) { animation-delay: -0.16s; }
@keyframes typingBounce {
  0%, 80%, 100% { transform: scale(0); }
  40% { transform: scale(1); }
}
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.6; }
}
</style>
@endpush

@push('scripts')
<script>
(function() {
  const stream = document.getElementById('adminChatStream');
  const messagesList = document.getElementById('adminMessagesList');
  const input = document.getElementById('replyMessageInput');
  const sendBtn = document.getElementById('adminSendBtn');
  const adminTypingIndicator = document.getElementById('adminTypingIndicator');
  const adminTypingLabel = document.getElementById('adminTypingLabel');
  const takeoverAlert = document.getElementById('adminTakeoverAlert');

  const pollUrl = "{{ route('backoffice.live-chats.poll', $session->id) }}";
  const replyUrl = "{{ route('backoffice.live-chats.reply', $session->id) }}";
  const typingUrl = "{{ route('backoffice.live-chats.typing', $session->id) }}";
  const toggleAiUrl = "{{ route('backoffice.live-chats.toggle-ai', $session->id) }}";

  function scrollToBottom() {
    setTimeout(() => {
      stream.scrollTop = stream.scrollHeight;
    }, 40);
  }
  scrollToBottom();

  let adminTypingTimer = null;
  let lastAdminTypingSent = 0;

  function sendAdminTyping(isTyping) {
    fetch(typingUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ typing: isTyping })
    }).then(res => res.json()).then(data => {
      if (data && typeof data.is_typing === 'boolean') {
        updateVisitorTypingUI(data.is_typing, data.visitor_name);
      }
    }).catch(() => {});
  }

  let isAdminSubmitting = false;

  if (input) {
    // Enter sends reply, Shift + Enter creates a newline
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        if (e.shiftKey) {
          // Shift + Enter: Allow natural newline in textarea
          return;
        }
        // Enter without Shift: Send message immediately
        e.preventDefault();
        submitAdminReply(e);
      }
    });

    input.addEventListener('input', () => {
      const hasText = input.value.trim().length > 0;
      if (!hasText) {
        clearTimeout(adminTypingTimer);
        sendAdminTyping(false);
        return;
      }

      const now = Date.now();
      if (now - lastAdminTypingSent > 2000) {
        lastAdminTypingSent = now;
        sendAdminTyping(true);
      }

      clearTimeout(adminTypingTimer);
      adminTypingTimer = setTimeout(() => {
        sendAdminTyping(false);
      }, 4000);
    });

    input.addEventListener('blur', () => {
      clearTimeout(adminTypingTimer);
      sendAdminTyping(false);
    });
  }

  function updateVisitorTypingUI(isTyping, visitorName) {
    if (!adminTypingIndicator) return;
    if (isTyping) {
      if (visitorName && adminTypingLabel) {
        adminTypingLabel.textContent = `${visitorName} sedang mengetik...`;
      }
      if (adminTypingIndicator.style.display !== 'flex') {
        adminTypingIndicator.style.display = 'flex';
        scrollToBottom();
      }
    } else {
      adminTypingIndicator.style.display = 'none';
    }
  }

  window.toggleSessionAi = async function() {
    try {
      const res = await fetch(toggleAiUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      });
      const data = await res.json();
      if (data && data.success) {
        const badge = document.getElementById('aiStatusBadge');
        const btn = document.getElementById('btnToggleAi');
        if (data.ai_enabled) {
          if (badge) { badge.className = 'badge badge-success'; badge.textContent = 'Aktif'; }
          if (btn) { btn.innerHTML = '⏸️ Jeda AI (Admin Handle)'; }
        } else {
          if (badge) { badge.className = 'badge badge-neutral'; badge.textContent = 'Dijeda'; }
          if (btn) { btn.innerHTML = '▶️ Aktifkan AI'; }
        }
      }
    } catch(err) {
      alert('Gagal mengubah status AI.');
    }
  };

  window.submitAdminReply = async function(e) {
    if (e && e.preventDefault) e.preventDefault();
    if (isAdminSubmitting) return;

    const text = input.value.trim();
    if (!text) return;

    isAdminSubmitting = true;
    clearTimeout(adminTypingTimer);
    sendAdminTyping(false);

    sendBtn.disabled = true;
    sendBtn.innerHTML = '<span>Mengirim...</span>';

    try {
      const res = await fetch(replyUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: text })
      });

      if (res.ok) {
        input.value = '';
        if (takeoverAlert) takeoverAlert.style.display = 'none';
        await pollNewMessages();
      } else {
        alert('Gagal mengirim balasan. Silakan coba lagi.');
      }
    } catch(err) {
      alert('Terjadi kendala jaringan.');
    } finally {
      isAdminSubmitting = false;
      sendBtn.disabled = false;
      sendBtn.innerHTML = '<span>Kirim Balasan</span>';
      input.focus();
    }
  };

  window.insertQuickSnippet = function(text) {
    if (input) {
      input.value = text;
      input.focus();
      sendAdminTyping(true);
    }
  };

  let lastKnownCount = {{ $session->messages->count() }};

  async function pollNewMessages() {
    try {
      const res = await fetch(pollUrl);
      if (!res.ok) return;
      const data = await res.json();

      updateVisitorTypingUI(!!data.is_typing, data.visitor_name);

      if (takeoverAlert) {
        takeoverAlert.style.display = data.needs_human_takeover ? 'flex' : 'none';
      }

      if (data.messages && data.messages.length > lastKnownCount) {
        lastKnownCount = data.messages.length;
        renderMessages(data.messages);
        scrollToBottom();
      }
    } catch(e) {}
  }

  function renderMessages(messages) {
    if (!messagesList) return;
    messagesList.innerHTML = messages.map(msg => {
      if (msg.is_ai) {
        return `
          <div style="display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px;">
            <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-end;">
              <span style="font-size: 10.5px; color: #0284C7; margin-bottom: 3px; font-weight: 700; display: flex; align-items: center; gap: 4px;">
                ATS Support (Auto) • ${msg.time}
              </span>
              <div style="background-color: #F0F9FF; color: #0369A1; border: 1px solid #BAE6FD; padding: 10px 14px; border-radius: 14px 14px 2px 14px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 1px 3px rgba(2, 132, 199, 0.08);">${formatChatMessage(msg.message)}</div>
            </div>
            <div style="width: 32px; height: 32px; border-radius: 50%; background: #0284C7; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 10px; flex-shrink: 0; box-shadow: 0 1px 4px rgba(2, 132, 199, 0.3);">
              ATS
            </div>
          </div>
        `;
      } else if (msg.sender === 'admin') {
        return `
          <div style="display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px;">
            <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-end;">
              <span style="font-size: 10.5px; color: #94A3B8; margin-bottom: 3px; font-weight: 600;">
                ${escapeHtml(msg.admin_name || 'ATS Support')} • ${msg.time}
              </span>
              <div style="background-color: #FC0001; color: #FFFFFF; padding: 10px 14px; border-radius: 14px 14px 2px 14px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 2px 6px rgba(252, 0, 1, 0.25);">${formatChatMessage(msg.message)}</div>
            </div>
            <div style="width: 32px; height: 32px; border-radius: 50%; background: #FFFFFF; color: #FC0001; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 10px; border: 1.5px solid #FC0001; box-shadow: 0 1px 4px rgba(252, 0, 1, 0.2); flex-shrink: 0;">
              ATS
            </div>
          </div>
        `;
      } else {
        return `
          <div style="display: flex; justify-content: flex-start; align-items: flex-end; gap: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 50%; background: #F1F5F9; color: #0F172A; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 10px; border: 1px solid #CBD5E1; flex-shrink: 0;">
              {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
            </div>
            <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-start;">
              <span style="font-size: 10.5px; color: #94A3B8; margin-bottom: 3px; font-weight: 600;">
                {{ $session->visitor_name }} • ${msg.time}
              </span>
              <div style="background-color: #FFFFFF; color: #0F172A; border: 1px solid var(--color-border); padding: 10px 14px; border-radius: 14px 14px 14px 2px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">${formatChatMessage(msg.message)}</div>
            </div>
          </div>
        `;
      }
    }).join('');
  }

  function formatChatMessage(text) {
    if (!text) return '';
    let formatted = escapeHtml(text.trim());

    // 1. Convert bullet points: "* " or "- " at line start -> "• "
    formatted = formatted.replace(/(^|[\r\n]+|&lt;br\s*\/?&gt;|<br\s*\/?>)[ \t]*[\*\-][ \t]+/gi, '$1• ');

    // 2. Convert Triple asterisks: ***text*** -> <strong><em>text</em></strong>
    formatted = formatted.replace(/\*\*\*(.+?)\*\*\*/gs, '<strong><em>$1</em></strong>');

    // 3. Convert Double asterisks bold: **text** -> <strong>text</strong>
    formatted = formatted.replace(/\*\*\s*([^\*]+?)\s*\*\*/gs, '<strong>$1</strong>');

    // 4. Convert Single asterisk (WhatsApp-style bold): *text* -> <strong>text</strong>
    formatted = formatted.replace(/(^|[^\*])\*\s*([^\s\*](?:.*?[^\s\*])?)\s*\*(?!\*)/gs, '$1<strong>$2</strong>');

    // 5. Convert Markdown links: [label](url) -> <a href="cleanUrl">label</a>
    formatted = formatted.replace(/\[([^\]]+)\]\((https?:\/\/[^\s\)\<\>]+)\)/g, function(match, label, url) {
      let cleanUrl = url.trim();
      return `<a href="${cleanUrl}" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; font-weight: 700;">${label}</a>`;
    });

    // 6. Linkify remaining bare URLs (without swallowing trailing punctuation like . , ! ? ) ] )
    const bareUrlRegex = /(^|[^"'>])(https?:\/\/[^\s<"'>]+)/g;
    formatted = formatted.replace(bareUrlRegex, function(match, prefix, rawUrl) {
      let cleanUrl = rawUrl;
      let trailingPunct = '';
      const punctMatch = cleanUrl.match(/[.,;:!?\)\]]+$/);
      if (punctMatch) {
        trailingPunct = punctMatch[0];
        cleanUrl = cleanUrl.slice(0, -trailingPunct.length);
      }
      return `${prefix}<a href="${cleanUrl}" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; font-weight: 700;">${cleanUrl}</a>${trailingPunct}`;
    });

    return formatted;
  }

  function escapeHtml(text) {
    if (!text) return '';
    return text
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  setInterval(pollNewMessages, 2000);
})();
</script>
@endpush
