<!-- ========================================================
     ATS TEKNO - GLOBAL LANGUAGE SWITCHER COMPONENT
     Primary: English (EN) | Secondary: Indonesian (ID)
     Seamlessly integrated into Nav, Floating Pill & Modals
     ======================================================== -->

<!-- 1. Inline Navigation Switcher (Segmented Glass Pill) -->
<div class="ats-lang-switcher" role="group" aria-label="Language Selector">
  <button 
    type="button" 
    class="ats-lang-btn active" 
    data-lang="en" 
    onclick="atsSetLanguage('en')" 
    aria-label="Switch to English"
    title="English (Primary)"
  >
    <span class="ats-flag-icon">EN</span>
  </button>
  <span class="ats-lang-sep" aria-hidden="true">/</span>
  <button 
    type="button" 
    class="ats-lang-btn" 
    data-lang="id" 
    onclick="atsSetLanguage('id')" 
    aria-label="Ganti ke Bahasa Indonesia"
    title="Bahasa Indonesia"
  >
    <span class="ats-flag-icon">ID</span>
  </button>
</div>

<!-- 2. Floating Quick Switcher (Always accessible on scroll & mobile) -->
<aside class="ats-floating-lang-pill" aria-label="Quick Language Switcher">
  <div class="ats-floating-globe-icon" aria-hidden="true">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="12" r="10"></circle>
      <line x1="2" y1="12" x2="22" y2="12"></line>
      <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
    </svg>
  </div>
  <button 
    type="button" 
    class="ats-floating-lang-btn active" 
    data-lang="en" 
    onclick="atsSetLanguage('en')" 
    aria-label="Switch to English"
  >
    EN
  </button>
  <span class="ats-floating-sep">|</span>
  <button 
    type="button" 
    class="ats-floating-lang-btn" 
    data-lang="id" 
    onclick="atsSetLanguage('id')" 
    aria-label="Ganti ke Bahasa Indonesia"
  >
    ID
  </button>
</aside>

<style>
  /* ========================================================
     CSS RULES FOR DUAL-LANGUAGE TOGGLING
     ======================================================== */
  html[lang="en"] .ats-lang-id { display: none !important; }
  html[lang="en"] .ats-lang-en { display: inline !important; }
  html[lang="id"] .ats-lang-en { display: none !important; }
  html[lang="id"] .ats-lang-id { display: inline !important; }

  html[lang="en"] .ats-lang-block-id { display: none !important; }
  html[lang="en"] .ats-lang-block-en { display: block !important; }
  html[lang="id"] .ats-lang-block-en { display: none !important; }
  html[lang="id"] .ats-lang-block-id { display: block !important; }

  /* 1. Inline Navbar Switcher Styling */
  .ats-lang-switcher {
    display: inline-flex;
    align-items: center;
    gap: 2px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.22);
    border-radius: 9999px;
    padding: 3px 4px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    user-select: none;
  }

  .ats-lang-btn {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.75);
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 5px 10px;
    border-radius: 9999px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    outline: none;
  }

  .ats-lang-btn:hover:not(.active) {
    color: #FFFFFF;
    background: rgba(255, 255, 255, 0.08);
  }

  .ats-lang-btn.active {
    background: #FFFFFF;
    color: #0F172A;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  .ats-lang-sep {
    color: rgba(255, 255, 255, 0.35);
    font-size: 11px;
    font-weight: 500;
  }

  /* 2. Floating Quick Switcher */
  .ats-floating-lang-pill {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9990;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(15, 23, 42, 0.88);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 9999px;
    padding: 5px 8px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.28), 0 2px 6px rgba(0, 0, 0, 0.15);
    transition: all 0.25s ease;
    user-select: none;
  }

  .ats-floating-lang-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
    border-color: rgba(225, 29, 72, 0.4);
    background: rgba(15, 23, 42, 0.95);
  }

  .ats-floating-globe-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #E11D48;
    padding-left: 2px;
  }

  .ats-floating-lang-btn {
    background: transparent;
    border: none;
    color: #94A3B8;
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 4px 8px;
    border-radius: 9999px;
    cursor: pointer;
    transition: all 0.2s ease;
    outline: none;
  }

  .ats-floating-lang-btn:hover:not(.active) {
    color: #FFFFFF;
  }

  .ats-floating-lang-btn.active {
    background: #E11D48;
    color: #FFFFFF;
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.4);
  }

  .ats-floating-sep {
    color: rgba(255, 255, 255, 0.25);
    font-size: 11px;
  }

  @media (max-width: 768px) {
    .ats-floating-lang-pill {
      bottom: 16px;
      right: 16px;
      padding: 4px 6px;
    }
    .ats-floating-lang-btn {
      font-size: 11px;
      padding: 4px 7px;
    }
  }
</style>

<!-- Load Global i18n Engine -->
<script src="{{ asset('js/ats-i18n.js') }}"></script>
