<!-- ========================================================
     ATS TEKNO - INLINE NAVBAR GLASSMORPHISM LANGUAGE SWITCHER
     Primary: English (EN) | Secondary: Indonesian (ID)
     Seamlessly integrated into Navbar (Floating pill omitted)
     ======================================================== -->

<!-- Inline Navigation Switcher (Segmented Glass Pill) -->
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

  /* 1. Inline Navbar Switcher Styling (Dark Glass for Hero Navbar) */
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

  /* Adapted styling when placed inside light public-navbar-header */
  .public-navbar-header .ats-lang-switcher {
    background: rgba(15, 23, 42, 0.05);
    border-color: rgba(15, 23, 42, 0.12);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
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

  .public-navbar-header .ats-lang-btn {
    color: #64748B;
  }

  .ats-lang-btn:hover:not(.active) {
    color: #FFFFFF;
    background: rgba(255, 255, 255, 0.08);
  }

  .public-navbar-header .ats-lang-btn:hover:not(.active) {
    color: #0F172A;
    background: rgba(15, 23, 42, 0.06);
  }

  .ats-lang-btn.active {
    background: #FFFFFF;
    color: #0F172A;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  .public-navbar-header .ats-lang-btn.active {
    background: #E11D48;
    color: #FFFFFF;
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.3);
  }

  .ats-lang-sep {
    color: rgba(255, 255, 255, 0.35);
    font-size: 11px;
    font-weight: 500;
  }

  .public-navbar-header .ats-lang-sep {
    color: rgba(15, 23, 42, 0.25);
  }
</style>

<!-- Global i18n Logic Script -->
<script src="{{ asset('js/ats-i18n.js') }}"></script>
