<!-- Floating Live Chat & Windows Notification Widget (PT Anugerah Tama Sejati) -->
<div id="ats-livechat-container" class="ats-chat-scope">
  <!-- Windows 11 Authentic Acrylic Toast Notification (Bottom Right) -->
  <div id="win-toast-notification" class="win-toast" role="alert" aria-live="polite">
    <div class="win-toast-header">
      <div class="win-toast-brand">
        <img src="/images/ats-logo.webp" alt="ATS" onerror="this.src='/favicon.ico'" class="win-toast-app-icon">
        <span class="win-toast-app-name" data-i18n="chat.toast_app">ATS Support</span>
        <span class="win-toast-dot">•</span>
        <span class="win-toast-time" data-i18n="chat.toast_time">Just now</span>
      </div>
      <button type="button" class="win-toast-close" id="winToastClose" aria-label="Close notification">&times;</button>
    </div>
    <div class="win-toast-body" id="winToastAction">
      <div class="win-toast-thumb">
        <div class="win-toast-avatar-ring">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        </div>
      </div>
      <div class="win-toast-text">
        <div class="win-toast-title" data-i18n="chat.toast_title">ATS Support Online</div>
        <div class="win-toast-desc" data-i18n="chat.toast_desc">Need BoQ quotation, Schneider/Siemens switchboards, or component pricing? Chat with ATS Support now.</div>
      </div>
    </div>
    <div class="win-toast-actions">
      <button type="button" class="win-toast-btn win-toast-btn-primary" id="winToastOpenChat">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        <span data-i18n="chat.btn_chat">Chat with ATS Support</span>
      </button>
      <button type="button" class="win-toast-btn win-toast-btn-ghost" id="winToastDismiss" data-i18n="chat.btn_later">Later</button>
    </div>
  </div>

  <!-- Live Chat Drawer Modal -->
  <div id="ats-chat-drawer" class="ats-chat-drawer" aria-hidden="true">
    <!-- Header -->
    <div class="chat-drawer-header">
      <div class="chat-drawer-user">
        <div class="chat-avatar-wrap">
          <div class="chat-avatar-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </div>
          <span class="chat-online-indicator"></span>
        </div>
        <div>
          <h4 class="chat-drawer-title" data-i18n="chat.drawer_title">ATS Support</h4>
          <p class="chat-drawer-subtitle" data-i18n="chat.drawer_sub">PT Anugerah Tama Sejati • Live Online</p>
        </div>
      </div>
      <div class="chat-header-actions">
        <button type="button" id="chatHistoryToggleBtn" class="chat-history-toggle-btn" title="Lihat Riwayat Chat">
          <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span><span class="ats-lang-en">History</span><span class="ats-lang-id">Riwayat</span></span>
          <span id="historyBadgeCount" class="history-badge-pill" style="display: none;">0</span>
        </button>
        <button type="button" class="chat-drawer-close" id="chatDrawerClose" aria-label="Close Chat">&times;</button>
      </div>
    </div>

    <!-- Quick Channels Bar (WhatsApp, Telp, Email) -->
    <div class="chat-quick-channels-bar">
      <a href="https://wa.me/6282223332830?text=Halo%20PT%20Anugerah%20Tama%20Sejati,%20saya%20ingin%20konsultasi%20mengenai%20panel%20listrik%20dan%20komponen%20industri." target="_blank" rel="noopener noreferrer" class="channel-chip channel-chip-wa">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        <span>WhatsApp</span>
      </a>
      <a href="tel:03159178887" class="channel-chip channel-chip-phone">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        <span>(031) 59178887</span>
      </a>
      <a href="mailto:sales@atstekno.com" class="channel-chip channel-chip-email">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        <span>Email</span>
      </a>
    </div>

    <!-- Live Conversation Stream -->
    <div id="chatMessagesStream" class="chat-drawer-body">
      <!-- Bot Welcome Bubble -->
      <div class="chat-msg chat-msg-bot">
        <div class="chat-msg-bubble">
          <div class="ats-lang-block-en">
            <p>Hello! 👋 Welcome to <strong>PT Anugerah Tama Sejati</strong>.</p>
            <p style="margin-top:6px;">How can we assist you with electrical switchboard specifications, Motor Control Centers (MCC), SCADA, or BoQ component quotations for Schneider, Siemens, and Mitsubishi?</p>
          </div>
          <div class="ats-lang-block-id">
            <p>Halo! 👋 Selamat datang di <strong>PT Anugerah Tama Sejati</strong>.</p>
            <p style="margin-top:6px;">Ada yang bisa kami bantu seputar spesifikasi panel listrik, motor control center (MCC), SCADA, atau penawaran BoQ komponen Schneider, Siemens, dan Mitsubishi?</p>
          </div>
          <span class="chat-msg-timestamp">ATS Support</span>
        </div>
      </div>

      <!-- Session Inactivity / Reset Banner -->
      <div id="sessionResetBanner" class="session-reset-banner" style="display: none;">
        <div class="reset-icon-wrap">
          <svg width="15" height="15" fill="none" stroke="#D97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="reset-desc">
          <p class="reset-text-main">
            <span class="ats-lang-en">Previous session completed (45 min timeout). New session started.</span>
            <span class="ats-lang-id">Sesi sebelumnya selesai (inaktif 45 menit). Sesi baru dimulai.</span>
          </p>
          <button type="button" id="btnNoticeOpenHistory" class="btn-notice-history">
            <span class="ats-lang-en">View Past Transcript &rarr;</span>
            <span class="ats-lang-id">Lihat Riwayat Chat Lalu &rarr;</span>
          </button>
        </div>
      </div>

      <!-- Real-time Dynamic Messages Container -->
      <div id="dynamicMessagesContainer" class="dynamic-stream"></div>

      <!-- Typing Indicator (Visible when ATS Engineer is typing) -->
      <div id="visitorTypingIndicator" class="chat-typing-row" style="display: none;">
        <div class="chat-typing-bubble">
          <div class="typing-dots">
            <span class="typing-dot"></span>
            <span class="typing-dot"></span>
            <span class="typing-dot"></span>
          </div>
          <span class="typing-label" id="visitorTypingLabel" data-i18n="chat.typing_indicator">ATS Support sedang mengetik...</span>
        </div>
      </div>
    </div>

    <!-- Bottom Interactive Chat Input Area -->
    <div class="chat-drawer-input-area">
      <!-- Mandatory Identity Form -->
      <div id="visitorIdentityDrawer" class="visitor-identity-drawer">
        <div class="identity-header">
          <span style="font-weight: 700; color: #0F172A; font-size: 11.5px; display: inline-flex; align-items: center; gap: 4px;">
            <svg width="13" height="13" fill="none" stroke="#FC0001" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="ats-lang-en">Consultation Identity</span><span class="ats-lang-id">Identitas Konsultasi</span> <span style="color: #FC0001;">*</span>
          </span>
          <span style="font-size: 10.5px; color: #64748B;"><span class="ats-lang-en">(Required)</span><span class="ats-lang-id">(Wajib diisi)</span></span>
        </div>
        <div class="identity-grid">
          <input type="text" id="visitorNameInput" placeholder="Your Name / Company Name *" data-i18n-placeholder-en="Your Name / Company Name *" data-i18n-placeholder-id="Nama Anda / Nama PT *" required class="identity-input">
          <input type="text" id="visitorContactInput" placeholder="WhatsApp Number / Email *" data-i18n-placeholder-en="WhatsApp Number / Email *" data-i18n-placeholder-id="No. WhatsApp / Email *" required class="identity-input">
        </div>
        <div id="identityErrorMsg" style="display: none; color: #DC2626; font-size: 11px; font-weight: 600; margin-top: 4px;"></div>
      </div>

      <!-- Identity Saved Bar (Compact) -->
      <div id="identitySavedBar" class="identity-saved-bar" style="display: none;">
        <div class="identity-saved-text">
          <svg width="13" height="13" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
          <span id="savedNameDisplay" style="font-weight: 700; color: #0F172A;"></span>
          <span style="color: #94A3B8;">•</span>
          <span id="savedContactDisplay" style="color: #475569; font-family: monospace;"></span>
        </div>
        <button type="button" id="editIdentityBtn" class="edit-identity-btn" title="Edit Name or Contact">
          <span class="ats-lang-en">Edit</span><span class="ats-lang-id">Ubah</span>
        </button>
      </div>

      <!-- Main Input Form -->
      <form id="visitorLiveChatForm" onsubmit="handleVisitorSubmit(event)" class="chat-form-row">
        <input type="text" id="visitorLiveMessageInput" placeholder="Type your technical inquiry here..." data-i18n-placeholder-en="Type your technical inquiry here..." data-i18n-placeholder-id="Ketik pesan konsultasi ke ATS Support..." required autocomplete="off" class="chat-message-field">
        <button type="submit" id="visitorLiveSendBtn" class="chat-send-btn" aria-label="Send Message" title="Send Message" data-i18n-title-en="Send Message" data-i18n-title-id="Kirim Pesan">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        </button>
      </form>
      <div class="chat-footer-secure-badge">
        <span>🔒 <span class="ats-lang-en">Direct connection to ATS Backoffice Engineer</span><span class="ats-lang-id">Langsung tersambung ke Backoffice Engineer ATS</span></span>
      </div>
    </div>

    <!-- History Modal / Drawer Overlay -->
    <div id="chatHistoryOverlay" class="chat-history-overlay" style="display: none;">
      <div class="history-overlay-header">
        <button type="button" id="btnHistoryBack" class="btn-history-back" title="Kembali ke Chat">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
          <span class="ats-lang-en">Back to Chat</span>
          <span class="ats-lang-id">Kembali</span>
        </button>
        <div class="history-overlay-title">
          <span class="ats-lang-en">Past Consultations</span>
          <span class="ats-lang-id">Riwayat Percakapan</span>
        </div>
      </div>

      <!-- History Sessions List -->
      <div id="historySessionsList" class="history-sessions-container">
        <div class="history-loading-spinner" id="historyLoadingSpinner" style="display: none;">
          <span class="ats-lang-en">Loading history...</span>
          <span class="ats-lang-id">Memuat riwayat chat...</span>
        </div>
        <div class="history-empty-state" id="historyEmptyState" style="display: none;">
          <svg width="36" height="36" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <p class="ats-lang-en">No previous chat sessions found.</p>
          <p class="ats-lang-id">Belum ada riwayat percakapan sebelumnya.</p>
        </div>
        <div id="historySessionsCards" class="history-cards-wrap"></div>
      </div>

      <!-- Single Session Transcript Viewer -->
      <div id="historyTranscriptViewer" class="history-transcript-container" style="display: none;">
        <div class="transcript-sub-header">
          <button type="button" id="btnTranscriptBackToList" class="btn-transcript-back">
            &larr; <span class="ats-lang-en">All Sessions</span><span class="ats-lang-id">Daftar Sesi</span>
          </button>
          <span id="transcriptSessionDate" class="transcript-date-badge"></span>
        </div>
        <div id="historyTranscriptStream" class="history-transcript-stream"></div>
      </div>
    </div>
  </div>

  <!-- Bottom-Right Floating Circle Button (FAB) -->
  <button type="button" id="ats-fab-btn" class="ats-floating-circle" aria-label="Open Live Chat Consultation" title="Chat dengan Tim ATS Tekno">
    <!-- Pulse Effect Rings -->
    <span class="fab-pulse-ring"></span>
    <span class="fab-pulse-ring-2"></span>

    <!-- Unread Badge -->
    <span class="fab-badge" id="fabUnreadBadge">1</span>

    <!-- Icons: Chat Icon & Close Icon -->
    <div class="fab-icon-wrap">
      <svg class="fab-icon-chat" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
      </svg>
      <svg class="fab-icon-close" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </div>

    <!-- Hover tooltip label -->
    <span class="fab-tooltip">Live Chat • Hubungi Engineer</span>
  </button>
</div>

<style>
/* ================= ATS SOLID COLOR LIVE CHAT (NO GRADIENTS) ================= */
:root {
  --ats-solid-red: #FC0001;
  --ats-solid-red-hover: #D90000;
  --ats-bg-white: #FFFFFF;
  --ats-bg-light: #F8FAFC;
  --ats-bg-muted: #F1F5F9;
  --ats-border-light: #E2E8F0;
  --ats-border-medium: #CBD5E1;
  --ats-text-main: #0F172A;
  --ats-text-body: #334155;
  --ats-text-muted: #64748B;
}

.ats-chat-scope {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

/* FAB Floating Circle (Solid Red #FC0001 with White Ring & Deep Shadow) */
.ats-floating-circle {
  position: fixed;
  bottom: 28px;
  right: 28px;
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background-color: #FC0001;
  color: #ffffff;
  border: 2.5px solid #FFFFFF;
  box-shadow: 0 10px 28px rgba(252, 0, 1, 0.42), 0 4px 12px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.2s ease, box-shadow 0.3s ease;
  outline: none;
  padding: 0;
}

.ats-floating-circle:hover {
  transform: scale(1.08);
  background-color: #D90000;
  box-shadow: 0 14px 34px rgba(252, 0, 1, 0.55), 0 6px 16px rgba(0, 0, 0, 0.16);
}

.ats-floating-circle:active {
  transform: scale(0.95);
  background-color: #B80000;
}

/* Pulse Rings */
.fab-pulse-ring, .fab-pulse-ring-2 {
  position: absolute;
  top: -6px;
  left: -6px;
  right: -6px;
  bottom: -6px;
  border-radius: 50%;
  border: 2px solid #FC0001;
  opacity: 0.75;
  animation: fabPulse 2.4s infinite cubic-bezier(0.25, 1, 0.5, 1);
  pointer-events: none;
}

.fab-pulse-ring-2 {
  animation-delay: 1.2s;
}

@keyframes fabPulse {
  0% { transform: scale(0.95); opacity: 0.75; }
  70% { transform: scale(1.35); opacity: 0; }
  100% { transform: scale(1.4); opacity: 0; }
}

/* Unread Badge */
.fab-badge {
  position: absolute;
  top: 0px;
  right: 0px;
  width: 22px;
  height: 22px;
  background-color: #FFFFFF;
  color: #FC0001;
  font-size: 11px;
  font-weight: 800;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #FC0001;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  z-index: 2;
  animation: badgeBounce 2s infinite ease-in-out;
}

@keyframes badgeBounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-3px); }
}

/* Icons */
.fab-icon-wrap {
  position: relative;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.fab-icon-chat, .fab-icon-close {
  position: absolute;
  transition: opacity 0.25s ease, transform 0.25s ease;
}

.fab-icon-close {
  opacity: 0;
  transform: rotate(-90deg) scale(0.6);
}

.ats-chat-scope.is-open .fab-icon-chat {
  opacity: 0;
  transform: rotate(90deg) scale(0.6);
}

.ats-chat-scope.is-open .fab-icon-close {
  opacity: 1;
  transform: rotate(0deg) scale(1);
}

.ats-chat-scope.is-open .fab-pulse-ring,
.ats-chat-scope.is-open .fab-pulse-ring-2,
.ats-chat-scope.is-open .fab-badge {
  display: none;
}

/* Tooltip */
.fab-tooltip {
  position: absolute;
  right: 76px;
  top: 50%;
  transform: translateY(-50%);
  background-color: #FFFFFF;
  color: #0F172A;
  font-size: 13px;
  font-weight: 600;
  padding: 8px 14px;
  border-radius: 9999px;
  white-space: nowrap;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  border: 1px solid #E2E8F0;
  pointer-events: none;
  opacity: 0;
  transform: translate(-8px, -50%);
  transition: opacity 0.25s ease, transform 0.25s ease;
}

.ats-floating-circle:hover .fab-tooltip {
  opacity: 1;
  transform: translate(0, -50%);
}

/* ================= TOAST NOTIFICATION (CLEAN WHITE & GREY THEME) ================= */
.win-toast {
  position: fixed;
  bottom: 104px;
  right: 28px;
  width: 360px;
  max-width: calc(100vw - 40px);
  background-color: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-top: 3.5px solid #FC0001;
  border-radius: 16px;
  box-shadow: 0 20px 44px rgba(15, 23, 42, 0.12), 0 4px 14px rgba(0, 0, 0, 0.05);
  z-index: 99998;
  padding: 16px 18px;
  color: #0F172A;
  transform: translateY(120%) scale(0.92);
  opacity: 0;
  pointer-events: none;
  transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease;
}

.win-toast.show {
  transform: translateY(0) scale(1);
  opacity: 1;
  pointer-events: auto;
}

.win-toast-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}

.win-toast-brand {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 11.5px;
  color: #64748B;
  font-weight: 500;
}

.win-toast-app-icon {
  width: 16px;
  height: 16px;
  border-radius: 3px;
  object-fit: contain;
}

.win-toast-app-name {
  color: #0F172A;
  font-weight: 700;
}

.win-toast-dot {
  font-size: 10px;
  color: #94A3B8;
}

.win-toast-close {
  background: transparent;
  border: none;
  color: #94A3B8;
  font-size: 18px;
  line-height: 1;
  cursor: pointer;
  padding: 3px 6px;
  border-radius: 6px;
  transition: background 0.2s ease, color 0.2s ease;
}

.win-toast-close:hover {
  background: #F1F5F9;
  color: #0F172A;
}

.win-toast-body {
  display: flex;
  gap: 12px;
  cursor: pointer;
  align-items: flex-start;
}

.win-toast-avatar-ring {
  width: 42px;
  height: 42px;
  border-radius: 12px;
  background-color: #FC0001;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #FFFFFF;
  flex-shrink: 0;
  box-shadow: 0 4px 14px rgba(252, 0, 1, 0.3);
}

.win-toast-title {
  font-size: 14px;
  font-weight: 700;
  color: #0F172A;
  line-height: 1.35;
  margin-bottom: 4px;
}

.win-toast-desc {
  font-size: 12.5px;
  color: #475569;
  line-height: 1.45;
}

.win-toast-actions {
  display: flex;
  gap: 8px;
  margin-top: 14px;
  padding-top: 12px;
  border-top: 1px solid #F1F5F9;
}

.win-toast-btn {
  flex: 1;
  font-size: 12.5px;
  font-weight: 700;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

.win-toast-btn-primary {
  background-color: #FC0001;
  color: #FFFFFF;
  border: 1px solid #FC0001;
  box-shadow: 0 2px 8px rgba(252, 0, 1, 0.25);
}

.win-toast-btn-primary:hover {
  background-color: #D90000;
  transform: translateY(-1px);
}

.win-toast-btn-ghost {
  background: #F1F5F9;
  color: #475569;
  border: 1px solid #E2E8F0;
  flex: 0 0 64px;
}

.win-toast-btn-ghost:hover {
  background: #E2E8F0;
  color: #0F172A;
}

/* ================= LIVE CHAT DRAWER (CLEAN WHITE & GREY THEME) ================= */
.ats-chat-drawer {
  position: fixed;
  bottom: 102px;
  right: 28px;
  width: 380px;
  max-width: calc(100vw - 32px);
  height: 560px;
  max-height: calc(100vh - 130px);
  background-color: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 18px;
  box-shadow: 0 24px 60px rgba(15, 23, 42, 0.15), 0 4px 20px rgba(0, 0, 0, 0.06);
  z-index: 99998;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  transform: translateY(20px) scale(0.95);
  opacity: 0;
  pointer-events: none;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
}

.ats-chat-scope.is-open .ats-chat-drawer {
  transform: translateY(0) scale(1);
  opacity: 1;
  pointer-events: auto;
}

/* Header (Clean White with Solid ATS Red Line) */
.chat-drawer-header {
  padding: 14px 18px;
  background-color: #FFFFFF;
  border-bottom: 2px solid #FC0001;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
}

.chat-drawer-user {
  display: flex;
  align-items: center;
  gap: 10px;
  flex: 1;
  min-width: 0;
}

.chat-avatar-wrap {
  position: relative;
  width: 40px;
  height: 40px;
}

.chat-avatar-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #FC0001;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #FFFFFF;
  border: 2px solid #FFFFFF;
  box-shadow: 0 2px 6px rgba(252, 0, 1, 0.25);
}

.chat-online-indicator {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 11px;
  height: 11px;
  border-radius: 50%;
  background-color: #22C55E;
  border: 2px solid #FFFFFF;
}

.chat-drawer-title {
  margin: 0;
  font-size: 14px;
  font-weight: 800;
  color: #0F172A;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.chat-drawer-subtitle {
  margin: 2px 0 0;
  font-size: 11px;
  color: #FC0001;
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.chat-drawer-close {
  background: #F1F5F9;
  border: 1px solid #E2E8F0;
  color: #64748B;
  font-size: 18px;
  line-height: 1;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

.chat-drawer-close:hover {
  background: #E2E8F0;
  color: #0F172A;
}

/* Quick Channels Bar (Soft Grey Background) */
.chat-quick-channels-bar {
  display: flex;
  gap: 6px;
  padding: 8px 14px;
  background-color: #F8FAFC;
  border-bottom: 1px solid #E2E8F0;
  flex-shrink: 0;
  overflow-x: auto;
}

.channel-chip {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 5px 10px;
  border-radius: 8px;
  font-size: 11px;
  font-weight: 600;
  text-decoration: none;
  white-space: nowrap;
  transition: all 0.2s ease;
}

.channel-chip-wa {
  background-color: #ECFDF5;
  color: #059669;
  border: 1px solid #A7F3D0;
}

.channel-chip-wa:hover {
  background-color: #059669;
  color: #FFFFFF;
}

.channel-chip-phone {
  background-color: #FEF2F2;
  color: #DC2626;
  border: 1px solid #FECACA;
}

.channel-chip-phone:hover {
  background-color: #DC2626;
  color: #FFFFFF;
}

.channel-chip-email {
  background-color: #F1F5F9;
  color: #334155;
  border: 1px solid #CBD5E1;
}

.channel-chip-email:hover {
  background-color: #334155;
  color: #FFFFFF;
}

/* Chat Body (Stream with Clean Off-White Background) */
.chat-drawer-body {
  padding: 14px;
  overflow-y: auto;
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 12px;
  background-color: #F8FAFC;
}

.dynamic-stream {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

/* Chat Message Bubbles */
.chat-msg {
  display: flex;
  flex-direction: column;
}

.chat-msg-bot {
  align-items: flex-start;
}

.chat-msg-visitor {
  align-items: flex-end;
}

.chat-msg-admin {
  align-items: flex-start;
}

.chat-msg-bubble {
  background-color: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px 14px 14px 2px;
  padding: 11px 13px;
  color: #1E293B;
  font-size: 12.5px;
  line-height: 1.45;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
  max-width: 85%;
}

.chat-msg-bubble strong {
  font-weight: 800;
}

.chat-msg-visitor .chat-msg-bubble strong {
  color: #0F172A !important;
}

.chat-msg-admin .chat-msg-bubble strong,
.chat-msg-ai .chat-msg-bubble strong {
  color: #FFFFFF !important;
  font-weight: 800;
}

.chat-msg-visitor .chat-msg-bubble {
  background-color: #FFFFFF;
  border: 1px solid #CBD5E1;
  border-radius: 14px 14px 2px 14px;
  color: #0F172A;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

/* Admin & Support Replies (Solid Red #FC0001) */
.chat-msg-admin .chat-msg-bubble,
.chat-msg-ai .chat-msg-bubble {
  background-color: #FC0001;
  border-radius: 14px 14px 14px 2px;
  color: #FFFFFF;
  border: 1px solid #FC0001;
  box-shadow: 0 3px 10px rgba(252, 0, 1, 0.25);
}

.chat-msg-admin .chat-msg-timestamp,
.chat-msg-ai .chat-msg-timestamp {
  color: #FEE2E2;
}

/* Typing Indicator Bubble */
.chat-typing-row {
  display: flex;
  align-items: flex-start;
  margin-top: 2px;
  animation: typingFadeIn 0.2s ease-out;
}

.chat-typing-bubble {
  background-color: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px 14px 14px 2px;
  padding: 8px 12px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
}

.typing-dots {
  display: inline-flex;
  align-items: center;
  gap: 3.5px;
}

.typing-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background-color: #FC0001;
  display: inline-block;
  animation: typingBounce 1.4s infinite ease-in-out both;
}

.typing-dot:nth-child(1) { animation-delay: -0.32s; }
.typing-dot:nth-child(2) { animation-delay: -0.16s; }
.typing-dot:nth-child(3) { animation-delay: 0s; }

@keyframes typingBounce {
  0%, 80%, 100% {
    transform: scale(0.6);
    opacity: 0.35;
  }
  40% {
    transform: scale(1);
    opacity: 1;
  }
}

.typing-label {
  font-size: 11px;
  font-weight: 600;
  color: #64748B;
  font-style: italic;
}

@keyframes typingFadeIn {
  from { opacity: 0; transform: translateY(4px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Input Area (Clean White & Grey) */
.chat-drawer-input-area {
  padding: 10px 14px 12px;
  background-color: #FFFFFF;
  border-top: 1px solid #E2E8F0;
  flex-shrink: 0;
}

/* Identity drawer */
.visitor-identity-drawer {
  background-color: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 8px 10px;
  margin-bottom: 8px;
}

.identity-header {
  font-size: 11px;
  color: #475569;
  font-weight: 600;
  margin-bottom: 6px;
}

.identity-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 6px;
}

.identity-input {
  width: 100%;
  background-color: #FFFFFF;
  border: 1px solid #CBD5E1;
  border-radius: 6px;
  padding: 6px 8px;
  color: #0F172A;
  font-size: 11.5px;
  box-sizing: border-box;
  outline: none;
}

.identity-input:focus {
  border-color: #FC0001;
}

.identity-input.input-error {
  border-color: #FC0001 !important;
  background-color: #FEF2F2 !important;
  box-shadow: 0 0 0 2px rgba(252, 0, 1, 0.15);
}

.identity-saved-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 6px 10px;
  margin-bottom: 8px;
  font-size: 11.5px;
}

.identity-saved-text {
  display: flex;
  align-items: center;
  gap: 6px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.edit-identity-btn {
  background: none;
  border: none;
  color: #FC0001;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
  padding: 2px 6px;
  border-radius: 4px;
  transition: background-color 0.15s ease;
}

.edit-identity-btn:hover {
  background-color: #FEE2E2;
}

/* Form Row */
.chat-form-row {
  display: flex;
  align-items: center;
  gap: 8px;
}

.identity-toggle-btn {
  background-color: #F1F5F9;
  border: 1px solid #CBD5E1;
  color: #64748B;
  width: 36px;
  height: 36px;
  border-radius: 10px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.identity-toggle-btn:hover {
  background-color: #E2E8F0;
  color: #FC0001;
}

.chat-message-field {
  flex: 1;
  background-color: #F8FAFC;
  border: 1px solid #CBD5E1;
  border-radius: 10px;
  padding: 9px 12px;
  color: #0F172A;
  font-size: 12.5px;
  outline: none;
  font-family: inherit;
  transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
}

.chat-message-field:focus {
  background-color: #FFFFFF;
  border-color: #FC0001;
  box-shadow: 0 0 0 2px rgba(252, 0, 1, 0.15);
}

.chat-send-btn {
  background-color: #FC0001;
  color: #FFFFFF;
  border: none;
  width: 38px;
  height: 38px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background-color 0.2s ease, transform 0.1s ease;
  flex-shrink: 0;
}

.chat-send-btn:hover {
  background-color: #D90000;
}

.chat-send-btn:active {
  transform: scale(0.95);
}

.chat-footer-secure-badge {
  text-align: center;
  margin-top: 6px;
  font-size: 10.5px;
  color: #94A3B8;
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .ats-floating-circle {
    bottom: 20px;
    right: 20px;
    width: 56px;
    height: 56px;
  }
  .win-toast {
    bottom: 86px;
    right: 16px;
    left: 16px;
    width: auto;
  }
  .ats-chat-drawer {
    bottom: 86px;
    right: 16px;
    left: 16px;
    width: auto;
    height: 500px;
  }
}

/* Live Chat Session Inactivity & History Styles */
.chat-header-actions {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-shrink: 0;
}
.chat-history-toggle-btn {
  background: #F1F5F9;
  border: 1px solid #CBD5E1;
  color: #1E293B;
  font-size: 11.5px;
  font-weight: 700;
  padding: 5px 11px;
  border-radius: 9999px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  cursor: pointer;
  transition: all 0.2s ease;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
}
.chat-history-toggle-btn:hover {
  background: #E2E8F0;
  border-color: #94A3B8;
  color: #FC0001;
}
.chat-history-toggle-btn svg {
  color: #475569;
  flex-shrink: 0;
}
.chat-history-toggle-btn:hover svg {
  color: #FC0001;
}
.history-badge-pill {
  background: #FC0001;
  color: #FFFFFF;
  font-size: 10px;
  font-weight: 800;
  padding: 1px 6px;
  border-radius: 9999px;
  line-height: 1.2;
}
.session-reset-banner {
  background: #FFFBEB;
  border: 1px solid #FDE68A;
  border-radius: 14px;
  padding: 10px 14px;
  margin: 10px 0;
  display: flex;
  align-items: flex-start;
  gap: 10px;
  animation: fadeInNotice 0.3s ease;
}
@keyframes fadeInNotice {
  from { opacity: 0; transform: translateY(-6px); }
  to { opacity: 1; transform: translateY(0); }
}
.reset-icon-wrap {
  background: #FEF3C7;
  width: 26px;
  height: 26px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.reset-desc {
  flex: 1;
}
.reset-text-main {
  font-size: 11.5px;
  font-weight: 600;
  color: #92400E;
  line-height: 1.4;
  margin: 0 0 4px 0;
}
.btn-notice-history {
  background: none;
  border: none;
  color: #B45309;
  font-size: 11px;
  font-weight: 700;
  text-decoration: underline;
  cursor: pointer;
  padding: 0;
}
.btn-notice-history:hover {
  color: #78350F;
}

/* Chat History Overlay */
.chat-history-overlay {
  position: absolute;
  inset: 0;
  background: #F8FAFC;
  z-index: 30;
  display: flex;
  flex-direction: column;
  border-radius: 24px;
  overflow: hidden;
  animation: slideInHistory 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes slideInHistory {
  from { opacity: 0; transform: translateX(30px); }
  to { opacity: 1; transform: translateX(0); }
}
.history-overlay-header {
  background: #0F172A;
  color: #FFFFFF;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.btn-history-back {
  background: rgba(255, 255, 255, 0.1);
  border: none;
  color: #FFFFFF;
  font-size: 12px;
  font-weight: 700;
  padding: 6px 12px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.btn-history-back:hover {
  background: rgba(255, 255, 255, 0.2);
}
.history-overlay-title {
  font-size: 13px;
  font-weight: 700;
  color: #F8FAFC;
}
.history-sessions-container {
  flex: 1;
  overflow-y: auto;
  padding: 16px;
}
.history-loading-spinner {
  text-align: center;
  padding: 30px;
  color: #64748B;
  font-size: 12.5px;
}
.history-empty-state {
  text-align: center;
  padding: 40px 20px;
  color: #64748B;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  font-size: 12.5px;
}
.history-cards-wrap {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.history-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 12px 14px;
  cursor: pointer;
  transition: all 0.2s;
  box-shadow: 0 1px 3px rgba(0,0,0,0.03);
}
.history-card:hover {
  border-color: #CBD5E1;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  transform: translateY(-1px);
}
.history-card-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 6px;
}
.history-card-date {
  font-size: 11.5px;
  font-weight: 700;
  color: #0F172A;
}
.history-card-badge {
  font-size: 10px;
  font-weight: 700;
  background: #F1F5F9;
  color: #475569;
  padding: 2px 7px;
  border-radius: 6px;
}
.history-card-preview {
  font-size: 12px;
  color: #64748B;
  line-height: 1.4;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.history-transcript-container {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  background: #F8FAFC;
}
.transcript-sub-header {
  padding: 10px 16px;
  background: #FFFFFF;
  border-bottom: 1px solid #E2E8F0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.btn-transcript-back {
  background: none;
  border: none;
  font-size: 12px;
  font-weight: 700;
  color: #0F172A;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 6px;
}
.btn-transcript-back:hover {
  background: #F1F5F9;
}
.transcript-date-badge {
  font-size: 11px;
  color: #64748B;
  font-weight: 600;
}
.history-transcript-stream {
  flex: 1;
  overflow-y: auto;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
</style>

<script>
(function() {
  const scope = document.getElementById('ats-livechat-container');
  const fabBtn = document.getElementById('ats-fab-btn');
  const drawerCloseBtn = document.getElementById('chatDrawerClose');
  const winToast = document.getElementById('win-toast-notification');
  const winToastClose = document.getElementById('winToastClose');
  const winToastDismiss = document.getElementById('winToastDismiss');
  const winToastOpenChat = document.getElementById('winToastOpenChat');
  const winToastAction = document.getElementById('winToastAction');

  const stream = document.getElementById('chatMessagesStream');
  const dynamicContainer = document.getElementById('dynamicMessagesContainer');
  const chatForm = document.getElementById('visitorLiveChatForm');
  const msgInput = document.getElementById('visitorLiveMessageInput');
  const sendBtn = document.getElementById('visitorLiveSendBtn');
  const identityDrawer = document.getElementById('visitorIdentityDrawer');
  const identitySavedBar = document.getElementById('identitySavedBar');
  const savedNameDisplay = document.getElementById('savedNameDisplay');
  const savedContactDisplay = document.getElementById('savedContactDisplay');
  const editIdentityBtn = document.getElementById('editIdentityBtn');
  const identityErrorMsg = document.getElementById('identityErrorMsg');
  const nameInput = document.getElementById('visitorNameInput');
  const contactInput = document.getElementById('visitorContactInput');
  const unreadBadge = document.getElementById('fabUnreadBadge');

  let isChatOpen = false;
  let sessionToken = localStorage.getItem('ats_livechat_token') || null;
  let storedName = localStorage.getItem('ats_visitor_name') || '';
  let storedContact = localStorage.getItem('ats_visitor_contact') || '';
  let knownMessageIds = new Set();

  function updateIdentityUI() {
    if (storedName && storedContact) {
      if (identityDrawer) identityDrawer.style.display = 'none';
      if (identitySavedBar) identitySavedBar.style.display = 'flex';
      if (savedNameDisplay) savedNameDisplay.textContent = storedName;
      if (savedContactDisplay) savedContactDisplay.textContent = storedContact;
      if (nameInput) nameInput.value = storedName;
      if (contactInput) contactInput.value = storedContact;
    } else {
      if (identityDrawer) identityDrawer.style.display = 'block';
      if (identitySavedBar) identitySavedBar.style.display = 'none';
      if (nameInput && storedName) nameInput.value = storedName;
      if (contactInput && storedContact) contactInput.value = storedContact;
    }
  }

  updateIdentityUI();

  const historyToggleBtn = document.getElementById('chatHistoryToggleBtn');
  const historyBadgeCount = document.getElementById('historyBadgeCount');
  const historyOverlay = document.getElementById('chatHistoryOverlay');
  const historyBackBtn = document.getElementById('btnHistoryBack');
  const historyLoading = document.getElementById('historyLoadingSpinner');
  const historyEmpty = document.getElementById('historyEmptyState');
  const historyCardsWrap = document.getElementById('historySessionsCards');
  const historyViewer = document.getElementById('historyTranscriptViewer');
  const historyListContainer = document.getElementById('historySessionsList');
  const transcriptBackToList = document.getElementById('btnTranscriptBackToList');
  const transcriptStream = document.getElementById('historyTranscriptStream');
  const transcriptDateBadge = document.getElementById('transcriptSessionDate');
  const sessionResetBanner = document.getElementById('sessionResetBanner');
  const btnNoticeOpenHistory = document.getElementById('btnNoticeOpenHistory');

  const INACTIVITY_TIMEOUT_MS = 45 * 60 * 1000; // 45 minutes
  let lastActiveTime = parseInt(localStorage.getItem('ats_livechat_last_active') || '0', 10);

  function getArchivedTokens() {
    try {
      return JSON.parse(localStorage.getItem('ats_chat_archived_tokens') || '[]');
    } catch(e) {
      return [];
    }
  }

  function saveArchivedTokens(tokens) {
    localStorage.setItem('ats_chat_archived_tokens', JSON.stringify(tokens));
    updateHistoryBadgeUI();
  }

  function updateHistoryBadgeUI() {
    const tokens = getArchivedTokens();
    if (historyBadgeCount) {
      if (tokens.length > 0) {
        historyBadgeCount.textContent = tokens.length;
        historyBadgeCount.style.display = 'inline-block';
      } else {
        historyBadgeCount.style.display = 'none';
      }
    }
  }

  function restartSessionDueToInactivity() {
    if (sessionToken) {
      const archived = getArchivedTokens();
      if (!archived.includes(sessionToken)) {
        archived.unshift(sessionToken);
        saveArchivedTokens(archived);
      }
    }

    sessionToken = null;
    lastActiveTime = 0;
    localStorage.removeItem('ats_livechat_token');
    localStorage.removeItem('ats_livechat_last_active');
    knownMessageIds.clear();

    if (dynamicContainer) dynamicContainer.innerHTML = '';
    if (sessionResetBanner) sessionResetBanner.style.display = 'flex';
    updateHistoryBadgeUI();
  }

  function checkSessionInactivity() {
    if (!sessionToken) return;
    const now = Date.now();
    if (lastActiveTime > 0 && (now - lastActiveTime >= INACTIVITY_TIMEOUT_MS)) {
      restartSessionDueToInactivity();
    }
  }

  updateHistoryBadgeUI();
  checkSessionInactivity();


  if (historyToggleBtn) {
    historyToggleBtn.addEventListener('click', () => {
      openHistoryOverlay();
    });
  }

  if (btnNoticeOpenHistory) {
    btnNoticeOpenHistory.addEventListener('click', () => {
      openHistoryOverlay();
    });
  }

  if (historyBackBtn) {
    historyBackBtn.addEventListener('click', () => {
      closeHistoryOverlay();
    });
  }

  if (transcriptBackToList) {
    transcriptBackToList.addEventListener('click', () => {
      if (historyViewer) historyViewer.style.display = 'none';
      if (historyListContainer) historyListContainer.style.display = 'block';
    });
  }

  async function openHistoryOverlay() {
    if (!historyOverlay) return;
    historyOverlay.style.display = 'flex';
    if (historyViewer) historyViewer.style.display = 'none';
    if (historyListContainer) historyListContainer.style.display = 'block';

    const tokens = getArchivedTokens();
    if (tokens.length === 0) {
      if (historyEmpty) historyEmpty.style.display = 'flex';
      if (historyCardsWrap) historyCardsWrap.innerHTML = '';
      if (historyLoading) historyLoading.style.display = 'none';
      return;
    }

    if (historyEmpty) historyEmpty.style.display = 'none';
    if (historyLoading) historyLoading.style.display = 'block';
    if (historyCardsWrap) historyCardsWrap.innerHTML = '';

    try {
      const res = await fetch('/live-chat/history', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ tokens: tokens })
      });
      const data = await res.json();
      if (historyLoading) historyLoading.style.display = 'none';

      if (data.sessions && data.sessions.length > 0) {
        renderHistorySessionsList(data.sessions);
      } else {
        if (historyEmpty) historyEmpty.style.display = 'flex';
      }
    } catch(e) {
      if (historyLoading) historyLoading.style.display = 'none';
      if (historyEmpty) historyEmpty.style.display = 'flex';
    }
  }

  function closeHistoryOverlay() {
    if (historyOverlay) historyOverlay.style.display = 'none';
  }

  function renderHistorySessionsList(sessions) {
    if (!historyCardsWrap) return;
    historyCardsWrap.innerHTML = sessions.map((sess, idx) => {
      const count = sess.messages ? sess.messages.length : 0;
      const lastMsg = count > 0 ? sess.messages[count - 1].message : 'Tidak ada pesan';
      return `
        <div class="history-card" onclick="viewHistoryTranscript(${idx})">
          <div class="history-card-top">
            <span class="history-card-date">🗓️ ${escapeHtml(sess.date)}</span>
            <span class="history-card-badge">${count} pesan</span>
          </div>
          <p class="history-card-preview">"${escapeHtml(lastMsg)}"</p>
          <div style="display: flex; justify-content: flex-end; margin-top: 6px;">
            <span style="font-size: 11px; font-weight: 700; color: #FC0001;">Lihat Percakapan &rarr;</span>
          </div>
        </div>
      `;
    }).join('');

    window.cachedHistorySessions = sessions;
  }

  window.viewHistoryTranscript = function(index) {
    const session = window.cachedHistorySessions ? window.cachedHistorySessions[index] : null;
    if (!session) return;

    if (historyListContainer) historyListContainer.style.display = 'none';
    if (historyViewer) historyViewer.style.display = 'flex';
    if (transcriptDateBadge) transcriptDateBadge.textContent = session.date;

    if (transcriptStream) {
      if (!session.messages || session.messages.length === 0) {
        transcriptStream.innerHTML = '<p style="text-align:center; color:#94A3B8; font-size:12px; padding:20px;">Tidak ada rekaman pesan pada sesi ini.</p>';
      } else {
        transcriptStream.innerHTML = session.messages.map(m => {
          const isVisitor = m.sender === 'visitor';
          const senderLabel = isVisitor ? 'Anda' : (m.admin_name || 'ATS Support');
          return `
            <div class="chat-msg ${isVisitor ? 'chat-msg-visitor' : 'chat-msg-admin'}">
              <div class="chat-msg-bubble">
                <p style="white-space:pre-line; word-break:break-word; text-align:left; margin:0;">${formatMessageText(m.message)}</p>
                <span class="chat-msg-timestamp">${senderLabel} • ${m.time}</span>
              </div>
            </div>
          `;
        }).join('');
      }
    }
  };

  if (editIdentityBtn) {
    editIdentityBtn.addEventListener('click', () => {
      if (identityDrawer) identityDrawer.style.display = 'block';
      if (identitySavedBar) identitySavedBar.style.display = 'none';
      if (nameInput) nameInput.focus();
    });
  }

  function showIdentityError(text) {
    if (identityErrorMsg) {
      identityErrorMsg.textContent = text;
      identityErrorMsg.style.display = 'block';
    }
  }

  function clearIdentityError() {
    if (identityErrorMsg) identityErrorMsg.style.display = 'none';
    if (nameInput) nameInput.classList.remove('input-error');
    if (contactInput) contactInput.classList.remove('input-error');
  }

  if (nameInput) nameInput.addEventListener('input', clearIdentityError);
  if (contactInput) contactInput.addEventListener('input', clearIdentityError);

  function toggleChat(forceOpen) {
    if (typeof forceOpen === 'boolean') {
      isChatOpen = forceOpen;
    } else {
      isChatOpen = !isChatOpen;
    }

    if (isChatOpen) {
      scope.classList.add('is-open');
      hideWinToast();
      scrollToBottom();
      if (unreadBadge) unreadBadge.style.display = 'none';
      
      // Auto-focus identity if not filled, else message field
      setTimeout(() => {
        if (!storedName || !storedContact) {
          if (identityDrawer) identityDrawer.style.display = 'block';
          if (nameInput && !nameInput.value.trim()) {
            nameInput.focus();
          } else if (contactInput && !contactInput.value.trim()) {
            contactInput.focus();
          }
        } else {
          if (msgInput) msgInput.focus();
        }
      }, 150);

      // Fetch fresh messages
      checkSessionInactivity();
      pollLiveMessages();
      if (typeof setAdaptivePolling === 'function') setAdaptivePolling();
    } else {
      scope.classList.remove('is-open');
      if (typeof setAdaptivePolling === 'function') setAdaptivePolling();
    }
  }

  fabBtn.addEventListener('click', () => toggleChat());
  drawerCloseBtn.addEventListener('click', () => toggleChat(false));

  function hideWinToast() {
    winToast.classList.remove('show');
    try { sessionStorage.setItem('ats_win_toast_shown', '1'); } catch(e) {}
  }

  function showWinToast() {
    try {
      if (sessionStorage.getItem('ats_win_toast_shown') === '1') return;
    } catch(e) {}
    if (!isChatOpen) {
      winToast.classList.add('show');
      playNotificationChime();
    }
  }

  if (winToastClose) winToastClose.addEventListener('click', hideWinToast);
  if (winToastDismiss) winToastDismiss.addEventListener('click', hideWinToast);
  if (winToastOpenChat) winToastOpenChat.addEventListener('click', () => { hideWinToast(); toggleChat(true); });
  if (winToastAction) winToastAction.addEventListener('click', () => { hideWinToast(); toggleChat(true); });

  function scrollToBottom() {
    setTimeout(() => {
      stream.scrollTop = stream.scrollHeight;
    }, 50);
  }

  // Synthesize soft pleasant Windows-like notification chime
  function playNotificationChime() {
    try {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      if (!AudioContext) return;
      const ctx = new AudioContext();
      
      const osc1 = ctx.createOscillator();
      const osc2 = ctx.createOscillator();
      const gainNode = ctx.createGain();

      osc1.type = 'sine';
      osc2.type = 'triangle';
      
      osc1.frequency.setValueAtTime(739.99, ctx.currentTime);
      osc1.frequency.exponentialRampToValueAtTime(1108.73, ctx.currentTime + 0.12);

      osc2.frequency.setValueAtTime(369.99, ctx.currentTime);
      osc2.frequency.exponentialRampToValueAtTime(554.37, ctx.currentTime + 0.12);

      gainNode.gain.setValueAtTime(0.001, ctx.currentTime);
      gainNode.gain.linearRampToValueAtTime(0.12, ctx.currentTime + 0.04);
      gainNode.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 0.65);

      osc1.connect(gainNode);
      osc2.connect(gainNode);
      gainNode.connect(ctx.destination);

      osc1.start(ctx.currentTime);
      osc2.start(ctx.currentTime);
      osc1.stop(ctx.currentTime + 0.65);
      osc2.stop(ctx.currentTime + 0.65);
    } catch(e) {}
  }

  // Handle Visitor Send Message
  let isVisitorSubmitting = false;

  window.handleVisitorSubmit = async function(e) {
    if (e) {
      e.preventDefault();
      if (e.stopPropagation) e.stopPropagation();
    }
    if (isVisitorSubmitting) return;

    const text = msgInput ? msgInput.value.trim() : '';
    if (!text) return;

    clearIdentityError();

    const name = (nameInput ? nameInput.value.trim() : '') || storedName;
    const contact = (contactInput ? contactInput.value.trim() : '') || storedContact;

    // Enforce mandatory Name / PT
    if (!name || name.length < 2) {
      if (identityDrawer) identityDrawer.style.display = 'block';
      if (identitySavedBar) identitySavedBar.style.display = 'none';
      if (nameInput) {
        nameInput.classList.add('input-error');
        nameInput.focus();
      }
      const lang = typeof atsGetLanguage === 'function' ? atsGetLanguage() : 'en';
      showIdentityError(lang === 'en' ? 'Name or Company Name is required before sending.' : 'Nama atau Nama PT wajib dicantumkan sebelum mengirim pesan.');
      return;
    }

    // Enforce mandatory Contact (WhatsApp / Email)
    if (!contact || contact.length < 4) {
      if (identityDrawer) identityDrawer.style.display = 'block';
      if (identitySavedBar) identitySavedBar.style.display = 'none';
      if (contactInput) {
        contactInput.classList.add('input-error');
        contactInput.focus();
      }
      const lang = typeof atsGetLanguage === 'function' ? atsGetLanguage() : 'en';
      showIdentityError(lang === 'en' ? 'WhatsApp number or Email address is required.' : 'Nomor WhatsApp atau Email wajib dicantumkan.');
      return;
    }

    // Lock submission immediately to prevent duplicate sends from Enter / clicks
    isVisitorSubmitting = true;

    // Save validated identity
    storedName = name;
    storedContact = contact;
    localStorage.setItem('ats_visitor_name', name);
    localStorage.setItem('ats_visitor_contact', contact);
    updateIdentityUI();

    // Stop typing state upon sending
    clearTimeout(visitorTypingTimer);
    sendVisitorTyping(false);

    // Optimistic UI: clear input immediately and show message in chat drawer
    const tempMsgId = 'opt_' + Date.now();
    const nowTime = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });

    msgInput.value = '';
    appendSingleMessage({
      id: tempMsgId,
      sender: 'visitor',
      sender_name: 'Anda',
      message: text,
      time: nowTime,
      is_optimistic: true
    });

    // Show ATS Support typing indicator while server/AI processes
    updateAdminTypingUI(true);
    scrollToBottom();

    sendBtn.disabled = true;
    msgInput.disabled = true;

    try {
      const res = await fetch('/live-chat/send', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          message: text,
          session_token: sessionToken,
          name: name,
          contact: contact
        })
      });

      const data = await res.json();

      if (res.ok) {
        if (data.session_token) {
          sessionToken = data.session_token;
          localStorage.setItem('ats_livechat_token', sessionToken);
          if (typeof setAdaptivePolling === 'function') setAdaptivePolling();
        }
        lastActiveTime = Date.now();
        localStorage.setItem('ats_livechat_last_active', lastActiveTime.toString());
        if (sessionResetBanner) sessionResetBanner.style.display = 'none';

        if (data.message && data.message.id) {
          knownMessageIds.add(data.message.id);
          // Reconcile optimistic element with real ID and server timestamp
          const optEl = document.getElementById(tempMsgId);
          if (optEl) {
            optEl.id = 'msg_' + data.message.id;
            optEl.removeAttribute('data-opt-pending');
            optEl.removeAttribute('data-opt-text');
            const timeSpan = optEl.querySelector('.chat-msg-timestamp');
            if (timeSpan && data.message.time) {
              timeSpan.textContent = `Anda • ${data.message.time}`;
            }
          }
        }

        if (data.ai_reply) {
          setTimeout(() => {
            updateAdminTypingUI(false);
            appendSingleMessage(data.ai_reply);
            playNotificationChime();
            scrollToBottom();
          }, 350);
        } else {
          updateAdminTypingUI(false);
        }
        scrollToBottom();
      } else {
        updateAdminTypingUI(false);
        const optEl = document.getElementById(tempMsgId);
        if (optEl) optEl.remove();
        const errorText = (data.errors && Object.values(data.errors).flat().join(' ')) || data.message || 'Gagal mengirim pesan.';
        showIdentityError(errorText);
      }
    } catch(err) {
      console.error(err);
      updateAdminTypingUI(false);
      showIdentityError('Terjadi kesalahan jaringan. Silakan coba lagi.');
    } finally {
      isVisitorSubmitting = false;
      sendBtn.disabled = false;
      msgInput.disabled = false;
      msgInput.focus();
    }
  };

  // Typing state tracking for visitor
  let visitorTypingTimer = null;
  let lastVisitorTypingSent = 0;

  function sendVisitorTyping(isTyping) {
    if (!sessionToken) return;
    fetch('/live-chat/typing', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        session_token: sessionToken,
        typing: isTyping
      })
    }).then(res => res.json()).then(data => {
      if (data && typeof data.is_typing === 'boolean') {
        updateAdminTypingUI(data.is_typing);
      }
    }).catch(() => {});
  }

  if (msgInput) {
    // Explicit Enter key handler with submission guard
    msgInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        e.stopPropagation();
        if (!isVisitorSubmitting && typeof window.handleVisitorSubmit === 'function') {
          window.handleVisitorSubmit(e);
        }
      }
    });

    msgInput.addEventListener('input', () => {
      const hasText = msgInput.value.trim().length > 0;
      if (!hasText) {
        clearTimeout(visitorTypingTimer);
        sendVisitorTyping(false);
        return;
      }

      const now = Date.now();
      if (now - lastVisitorTypingSent > 2000) {
        lastVisitorTypingSent = now;
        sendVisitorTyping(true);
      }

      clearTimeout(visitorTypingTimer);
      visitorTypingTimer = setTimeout(() => {
        sendVisitorTyping(false);
      }, 4000);
    });

    msgInput.addEventListener('blur', () => {
      clearTimeout(visitorTypingTimer);
      sendVisitorTyping(false);
    });
  }

  const visitorTypingIndicator = document.getElementById('visitorTypingIndicator');

  function updateAdminTypingUI(isAdminTyping) {
    if (!visitorTypingIndicator) return;
    if (isAdminTyping) {
      if (visitorTypingIndicator.style.display !== 'flex') {
        visitorTypingIndicator.style.display = 'flex';
        scrollToBottom();
      }
    } else {
      visitorTypingIndicator.style.display = 'none';
    }
  }

  function formatMessageText(text) {
    if (!text) return '';
    let formatted = escapeHtml(text.trim());

    // 1. Convert bullet points: lines starting with "* " or "- " -> "• "
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

  function appendSingleMessage(msg) {
    if (knownMessageIds.has(msg.id)) return;
    knownMessageIds.add(msg.id);

    const isVisitor = msg.sender === 'visitor';
    const msgEl = document.createElement('div');
    msgEl.id = msg.is_optimistic ? msg.id : ('msg_' + msg.id);
    if (msg.is_optimistic) {
      msgEl.setAttribute('data-opt-pending', 'true');
      msgEl.setAttribute('data-opt-text', msg.message);
    }
    msgEl.className = `chat-msg ${isVisitor ? 'chat-msg-visitor' : 'chat-msg-admin'}`;
    
    const senderName = isVisitor ? 'Anda' : (msg.sender_name || msg.admin_name || 'ATS Support');

    let waActionHtml = '';
    if (!isVisitor && (msg.message.includes('wa.me') || msg.message.includes('082223332830') || msg.message.toLowerCase().includes('whatsapp'))) {
      waActionHtml = `
        <div style="margin-top: 8px;">
          <a href="https://wa.me/6282223332830?text=Halo%20ATS%20Tekno,%20saya%20ingin%20konsultasi%20lanjutan" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background-color: #25D366; color: #FFFFFF; font-size: 11.5px; font-weight: 700; padding: 6px 12px; border-radius: 8px; text-decoration: none; box-shadow: 0 2px 6px rgba(37, 211, 102, 0.3);">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <span>Hubungi WhatsApp ATS</span>
          </a>
        </div>
      `;
    }

    msgEl.innerHTML = `
      <div class="chat-msg-bubble">
        <p style="white-space:pre-line; word-break:break-word; text-align:left; margin:0;">${formatMessageText(msg.message)}</p>
        ${waActionHtml}
        <span class="chat-msg-timestamp">${senderName} • ${msg.time}</span>
      </div>
    `;
    dynamicContainer.appendChild(msgEl);
    scrollToBottom();
  }

  // Poll for messages and typing state from Backoffice
  async function pollLiveMessages() {
    if (!sessionToken) return;

    try {
      const res = await fetch(`/live-chat/messages?session_token=${encodeURIComponent(sessionToken)}`);
      if (!res.ok) return;
      const data = await res.json();

      // Check if session has expired after 45 minutes of inactivity
      if (data.session && data.session.is_expired) {
        restartSessionDueToInactivity();
        return;
      }

      // Track last activity time from messages
      if (data.messages && data.messages.length > 0) {
        lastActiveTime = Date.now();
        localStorage.setItem('ats_livechat_last_active', lastActiveTime.toString());
      }

      // Update admin typing indicator
      updateAdminTypingUI(!!data.is_typing);

      if (data.messages && Array.isArray(data.messages)) {
        let hasNewAdminMessage = false;

        data.messages.forEach(msg => {
          // Reconcile optimistic visitor message if polling catches it first
          if (msg.sender === 'visitor') {
            const pendingEls = document.querySelectorAll('[data-opt-pending="true"]');
            for (let i = 0; i < pendingEls.length; i++) {
              const el = pendingEls[i];
              if (el.getAttribute('data-opt-text') === msg.message) {
                el.removeAttribute('data-opt-pending');
                el.removeAttribute('data-opt-text');
                el.id = 'msg_' + msg.id;
                knownMessageIds.add(msg.id);
                const timeSpan = el.querySelector('.chat-msg-timestamp');
                if (timeSpan && msg.time) {
                  timeSpan.textContent = `Anda • ${msg.time}`;
                }
                return;
              }
            }
          }

          if (!knownMessageIds.has(msg.id)) {
            if (msg.sender === 'admin' || msg.is_ai) {
              hasNewAdminMessage = true;
            }
            appendSingleMessage(msg);
          }
        });

        if (hasNewAdminMessage) {
          playNotificationChime();
          if (!isChatOpen) {
            if (unreadBadge) unreadBadge.style.display = 'flex';
          }
        }
      }
    } catch(e) {
      // silent retry
    }
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

  // Adaptive polling controller: only polls fast (3s) when chat is open;
  // polls lightly (35s) if user has an active session token; never polls when closed with no token.
  let livePollTimer = null;
  function setAdaptivePolling() {
    if (livePollTimer) {
      clearInterval(livePollTimer);
      livePollTimer = null;
    }
    if (document.visibilityState === 'hidden') {
      return; // pause polling when tab is inactive/background
    }
    if (isChatOpen) {
      livePollTimer = setInterval(pollLiveMessages, 3000);
    } else if (sessionToken) {
      livePollTimer = setInterval(pollLiveMessages, 35000);
    }
  }

  // Initial load only if active token exists
  if (sessionToken) {
    pollLiveMessages();
  }
  setAdaptivePolling();

  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') {
      checkSessionInactivity();
      if (isChatOpen || sessionToken) {
        pollLiveMessages();
      }
      setAdaptivePolling();
    } else {
      setAdaptivePolling();
    }
  });

  // Non-intrusive Toast: trigger on scroll or 12s idle (once per session)
  let winToastTriggered = false;
  function triggerWinToastOnce() {
    if (winToastTriggered) return;
    try {
      if (sessionStorage.getItem('ats_win_toast_shown') === '1') return;
    } catch(e) {}
    winToastTriggered = true;
    showWinToast();
  }

  window.addEventListener('scroll', () => {
    if (window.scrollY > 350) {
      triggerWinToastOnce();
    }
  }, { passive: true, once: true });

  setTimeout(triggerWinToastOnce, 12000);
})();
</script>
