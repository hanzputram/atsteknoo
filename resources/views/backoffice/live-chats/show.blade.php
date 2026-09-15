@extends('backoffice.layouts.app')

@section('title', 'Ruang Chat — ' . $session->visitor_name)
@section('breadcrumb')
  <a href="{{ route('backoffice.live-chats.index') }}">Live Chat</a>
  <span>/</span>
  <span>{{ $session->visitor_name }}</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Percakapan: {{ $session->visitor_name }}</h1>
    <p class="page-subtitle">Balasan Anda akan langsung muncul di widget pengunjung secara real-time.</p>
  </div>

  <a href="{{ route('backoffice.live-chats.index') }}" class="btn btn-secondary">&larr; Kembali ke Daftar</a>
</div>

<div style="display: grid; grid-template-columns: 320px 1fr; gap: 20px; align-items: start;">
  <!-- Visitor Profile Panel -->
  <div class="panel-card">
    <div class="panel-body" style="display: flex; flex-direction: column; gap: 18px;">
      <div style="display: flex; align-items: center; gap: 14px;">
        <div style="width: 52px; height: 52px; border-radius: 14px; background: #F1F5F9; color: #0F172A; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; border: 2px solid #CBD5E1; flex-shrink: 0;">
          {{ strtoupper(substr($session->visitor_name, 0, 2)) }}
        </div>
        <div>
          <h3 style="font-size: 16px; font-weight: 700; color: #0F172A; margin: 0; line-height: 1.2;">{{ $session->visitor_name }}</h3>
          <span class="badge {{ $session->status === 'unread' ? 'badge-danger' : ($session->status === 'active' ? 'badge-success' : 'badge-neutral') }}" style="margin-top: 6px;">
            Status: {{ ucfirst($session->status) }}
          </span>
        </div>
      </div>

      <div style="border-top: 1px solid var(--color-border); padding-top: 14px; display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
        <div>
          <span style="color: #64748B; font-size: 11px; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 2px;">Kontak Pengunjung:</span>
          <span style="font-family: monospace; font-weight: 700; color: #0F172A; font-size: 13.5px;">{{ $session->visitor_contact ?: 'Tidak dicantumkan' }}</span>
          @if($session->visitor_contact && preg_match('/^[0-9+]+$/', str_replace([' ', '-'], '', $session->visitor_contact)))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $session->visitor_contact) }}" target="_blank" style="color: #059669; font-weight: 700; font-size: 11.5px; text-decoration: underline; display: block; margin-top: 4px;">
              Buka di WhatsApp Web &rarr;
            </a>
          @endif
        </div>

        <div>
          <span style="color: #64748B; font-size: 11px; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 2px;">Sesi Dimulai:</span>
          <span style="color: #334155;">{{ $session->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</span>
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
          <span style="font-family: monospace; font-size: 10.5px; color: #94A3B8; word-break: break-all;">{{ $session->session_token }}</span>
        </div>
      </div>

      <div style="border-top: 1px solid var(--color-border); padding-top: 14px; display: flex; flex-direction: column; gap: 8px;">
        @if($session->status !== 'closed')
          <form action="{{ route('backoffice.live-chats.close', $session->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center; font-size: 13px;">
              Tandai Selesai / Arsipkan
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
  </div>

  <!-- Live Chat Room Container -->
  <div class="panel-card" style="display: flex; flex-direction: column; height: 640px;">
    <!-- Room Bar (Clean White with ATS Red Border) -->
    <div style="padding: 14px 20px; background: #FFFFFF; color: #0F172A; display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #FC0001; flex-shrink: 0;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 10px; height: 10px; border-radius: 50%; background: #22C55E; display: inline-block;"></span>
        <span style="font-weight: 700; font-size: 14.5px; color: #0F172A;">Live Room: {{ $session->visitor_name }}</span>
      </div>
      <span style="font-size: 12px; color: #059669; font-weight: 700;">● Terhubung (Live Sync)</span>
    </div>

    <!-- Chat Messages Stream -->
    <div id="adminChatStream" style="flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 14px; background: #F8FAFC;">
      <div id="adminMessagesList" style="display: flex; flex-direction: column; gap: 14px;">
        @forelse($session->messages as $msg)
          @if($msg->sender === 'admin')
            <!-- Admin Bubble (Right side) -->
            <div style="display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px;">
              <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-end;">
                <span style="font-size: 10.5px; color: #94A3B8; margin-bottom: 3px; font-weight: 600;">
                  {{ $msg->admin ? $msg->admin->name : 'Engineer ATS' }} • {{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                </span>
                <div style="background-color: #FC0001; color: #FFFFFF; padding: 10px 14px; border-radius: 14px 14px 2px 14px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 2px 6px rgba(252, 0, 1, 0.25);">{{ trim($msg->message) }}</div>
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
                <div style="background-color: #FFFFFF; color: #0F172A; border: 1px solid var(--color-border); padding: 10px 14px; border-radius: 14px 14px 14px 2px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">{{ trim($msg->message) }}</div>
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
        <div style="background-color: #FFFFFF; color: #64748B; border: 1px solid var(--color-border); padding: 9px 14px; border-radius: 14px 14px 14px 2px; font-size: 12px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
          <div class="typing-dots-admin">
            <span class="typing-dot-admin"></span>
            <span class="typing-dot-admin"></span>
            <span class="typing-dot-admin"></span>
          </div>
          <span style="font-weight: 600; font-style: italic;" id="adminTypingLabel">{{ $session->visitor_name }} sedang mengetik...</span>
        </div>
      </div>
    </div>

    <!-- Reply Form -->
    <div style="padding: 14px 20px; background: #FFFFFF; border-top: 1px solid var(--color-border); flex-shrink: 0;">
      <form id="adminReplyForm" onsubmit="submitAdminReply(event)" style="display: flex; gap: 10px;">
        @csrf
        <textarea id="replyMessageInput" rows="2" placeholder="Tuliskan balasan konsultasi untuk pengunjung..." required class="form-control" style="resize: none; font-size: 13.5px;"></textarea>
        <button type="submit" id="adminSendBtn" class="btn btn-primary" style="flex-shrink: 0; padding: 0 20px;">
          <span>Kirim Balasan</span>
        </button>
      </form>
    </div>
  </div>
</div>

<style>
.typing-dots-admin {
  display: inline-flex;
  align-items: center;
  gap: 3.5px;
}

.typing-dot-admin {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background-color: #FC0001;
  display: inline-block;
  animation: adminTypingBounce 1.4s infinite ease-in-out both;
}

.typing-dot-admin:nth-child(1) { animation-delay: -0.32s; }
.typing-dot-admin:nth-child(2) { animation-delay: -0.16s; }
.typing-dot-admin:nth-child(3) { animation-delay: 0s; }

@keyframes adminTypingBounce {
  0%, 80%, 100% {
    transform: scale(0.6);
    opacity: 0.35;
  }
  40% {
    transform: scale(1);
    opacity: 1;
  }
}
</style>
@endsection

@push('scripts')
<script>
(function() {
  const stream = document.getElementById('adminChatStream');
  const messagesList = document.getElementById('adminMessagesList');
  const input = document.getElementById('replyMessageInput');
  const sendBtn = document.getElementById('adminSendBtn');
  const adminTypingIndicator = document.getElementById('adminTypingIndicator');
  const adminTypingLabel = document.getElementById('adminTypingLabel');

  const pollUrl = "{{ route('backoffice.live-chats.poll', $session->id) }}";
  const replyUrl = "{{ route('backoffice.live-chats.reply', $session->id) }}";
  const typingUrl = "{{ route('backoffice.live-chats.typing', $session->id) }}";

  function scrollToBottom() {
    setTimeout(() => {
      stream.scrollTop = stream.scrollHeight;
    }, 40);
  }
  scrollToBottom();

  // Admin typing state tracking
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

  if (input) {
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

  window.submitAdminReply = async function(e) {
    e.preventDefault();
    const text = input.value.trim();
    if (!text) return;

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
        await pollNewMessages();
      } else {
        alert('Gagal mengirim balasan. Silakan coba lagi.');
      }
    } catch(err) {
      alert('Terjadi kendala jaringan.');
    } finally {
      sendBtn.disabled = false;
      sendBtn.innerHTML = '<span>Kirim Balasan</span>';
      input.focus();
    }
  };

  let lastKnownCount = {{ $session->messages->count() }};

  async function pollNewMessages() {
    try {
      const res = await fetch(pollUrl);
      if (!res.ok) return;
      const data = await res.json();

      // Update visitor typing indicator
      updateVisitorTypingUI(!!data.is_typing, data.visitor_name);

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
      if (msg.sender === 'admin') {
        return `
          <div style="display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px;">
            <div style="max-width: 80%; display: flex; flex-direction: column; align-items: flex-end;">
              <span style="font-size: 10.5px; color: #94A3B8; margin-bottom: 3px; font-weight: 600;">
                ${escapeHtml(msg.admin_name || 'Engineer ATS')} • ${msg.time}
              </span>
              <div style="background-color: #FC0001; color: #FFFFFF; padding: 10px 14px; border-radius: 14px 14px 2px 14px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 2px 6px rgba(252, 0, 1, 0.25);">${escapeHtml(msg.message.trim())}</div>
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
              <div style="background-color: #FFFFFF; color: #0F172A; border: 1px solid var(--color-border); padding: 10px 14px; border-radius: 14px 14px 14px 2px; font-size: 13.5px; line-height: 1.5; white-space: pre-line; word-break: break-word; text-align: left; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">${escapeHtml(msg.message.trim())}</div>
            </div>
          </div>
        `;
      }
    }).join('');
  }

  function escapeHtml(text) {
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
  }

  // Polling every 2 seconds for real-time messaging & typing sync
  setInterval(pollNewMessages, 2000);
})();
</script>
@endpush
