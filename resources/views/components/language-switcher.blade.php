<!-- ========================================================
     ATS TEKNO - INLINE NAVBAR GLASSMORPHISM LANGUAGE SWITCHER
     Dedicated Mode for panel-building-process: English (EN) | Français (FR)
     Standard Mode for other pages: English (EN) | Indonesian (ID)
     ======================================================== -->

@php
  $isProcessPage = request()->routeIs('panel-building-process*') 
                || request()->is('panel-building-process*') 
                || request()->is('proses-pembuatan-panel*') 
                || request()->is('jasa-pembuatan-panel*');

  if ($isProcessPage) {
    $activeLang = request()->cookie('ats_lang_process') ?: ($_COOKIE['ats_lang_process'] ?? 'en');
    if ($activeLang !== 'fr' && $activeLang !== 'en') {
      $activeLang = 'en';
    }
  } else {
    $activeLang = request()->cookie('ats_lang') ?: ($_COOKIE['ats_lang'] ?? 'en');
    if ($activeLang !== 'id' && $activeLang !== 'en') {
      $activeLang = 'en';
    }
  }
@endphp

<!-- Inline Navigation Switcher (Segmented Glass Pill) -->
<div class="ats-lang-switcher" role="group" aria-label="Language Selector">
  @if ($isProcessPage)
    {{-- Dedicated EN / FR Mode for Panel Building Process Page --}}
    <button 
      type="button" 
      class="ats-lang-btn {{ $activeLang === 'en' ? 'active' : '' }}" 
      data-lang="en" 
      onclick="atsSwitchProcessLang('en'); return false;" 
      aria-label="Switch to English"
      title="English"
    >
      <span class="ats-flag-icon">EN</span>
    </button>
    <span class="ats-lang-sep" aria-hidden="true">/</span>
    <button 
      type="button" 
      class="ats-lang-btn {{ $activeLang === 'fr' ? 'active' : '' }}" 
      data-lang="fr" 
      onclick="atsSwitchProcessLang('fr'); return false;" 
      aria-label="Passer au Français"
      title="Français"
    >
      <span class="ats-flag-icon">FR</span>
    </button>
  @else
    {{-- Standard EN / ID Mode for General Website --}}
    <button 
      type="button" 
      class="ats-lang-btn {{ $activeLang === 'en' ? 'active' : '' }}" 
      data-lang="en" 
      onclick="atsSetLanguage('en'); return false;" 
      aria-label="Switch to English"
      title="English (Default)"
    >
      <span class="ats-flag-icon">EN</span>
    </button>
    <span class="ats-lang-sep" aria-hidden="true">/</span>
    <button 
      type="button" 
      class="ats-lang-btn {{ $activeLang === 'id' ? 'active' : '' }}" 
      data-lang="id" 
      onclick="atsSetLanguage('id'); return false;" 
      aria-label="Ganti ke Bahasa Indonesia"
      title="Bahasa Indonesia"
    >
      <span class="ats-flag-icon">ID</span>
    </button>
  @endif
</div>

<script>
  (function() {
    const isProcessPage = {{ $isProcessPage ? 'true' : 'false' }};

    window.atsSwitchProcessLang = function(lang) {
      if (lang !== 'en' && lang !== 'fr') lang = 'en';

      // 1. Persistence
      try {
        localStorage.setItem('ats_lang_process', lang);
        localStorage.setItem('ats_lang', lang);
      } catch (e) {}
      document.cookie = "ats_lang_process=" + lang + ";path=/;max-age=31536000;SameSite=Lax";
      document.cookie = "ats_lang=" + lang + ";path=/;max-age=31536000;SameSite=Lax";

      // 2. Set root HTML attributes
      document.documentElement.setAttribute('lang', lang);
      document.documentElement.setAttribute('data-lang', lang);

      // 3. Update Switcher Buttons
      document.querySelectorAll('.ats-lang-btn').forEach(function(btn) {
        if (btn.getAttribute('data-lang') === lang) {
          btn.classList.add('active');
          btn.setAttribute('aria-pressed', 'true');
        } else {
          btn.classList.remove('active');
          btn.setAttribute('aria-pressed', 'false');
        }
      });

      // 4. Update data-i18n navbar items
      const navDict = {
        fr: {
          "nav.home": "ACCUEIL",
          "nav.about": "À PROPOS",
          "nav.panel_builder": "FABRICANT DE TABLEAUX",
          "nav.process": "PROCESSUS",
          "nav.products": "PRODUITS",
          "nav.price_list": "TARIFS",
          "nav.projects": "PROJETS",
          "nav.article": "ARTICLES",
          "nav.contact": "CONTACT",
          "hero.brand_tag": "FOURNISSEUR ÉLECTRIQUE"
        },
        en: {
          "nav.home": "HOME",
          "nav.about": "ABOUT US",
          "nav.panel_builder": "PANEL BUILDER",
          "nav.process": "PROCESS",
          "nav.products": "PRODUCTS",
          "nav.price_list": "PRICE LIST",
          "nav.projects": "PROJECTS",
          "nav.article": "ARTICLE",
          "nav.contact": "CONTACT US",
          "hero.brand_tag": "ELECTRICAL SUPPLIER"
        }
      };
      const curNav = navDict[lang] || navDict.en;
      document.querySelectorAll('[data-i18n]').forEach(function(el) {
        const k = el.getAttribute('data-i18n');
        if (curNav[k]) {
          el.textContent = curNav[k];
        }
      });

      // 5. Update Search Placeholder
      const sInput = document.getElementById('p33-search-input');
      if (sInput) {
        sInput.placeholder = (lang === 'fr') 
          ? (sInput.getAttribute('data-placeholder-fr') || 'Rechercher des étapes (ex. laser, pliage, thermolaquage, jeux de barres, FAT)...')
          : (sInput.getAttribute('data-placeholder-en') || 'Search steps (e.g., laser, bending, powder coating, busbar, FAT)...');
      }

      // 6. Broadcast event
      window.dispatchEvent(new CustomEvent('atsLanguageChanged', { detail: { lang: lang } }));
    };

    if (isProcessPage) {
      window.atsSetLanguage = window.atsSwitchProcessLang;
    } else {
      window.atsSetLanguage = function(lang) {
        if (lang !== 'en' && lang !== 'id') lang = 'en';
        try { localStorage.setItem('ats_lang', lang); } catch (e) {}
        document.cookie = "ats_lang=" + lang + ";path=/;max-age=31536000;SameSite=Lax";
        document.documentElement.setAttribute('lang', lang);
        document.documentElement.setAttribute('data-lang', lang);
        document.querySelectorAll('.ats-lang-btn').forEach(function(btn) {
          if (btn.getAttribute('data-lang') === lang) {
            btn.classList.add('active');
            btn.setAttribute('aria-pressed', 'true');
          } else {
            btn.classList.remove('active');
            btn.setAttribute('aria-pressed', 'false');
          }
        });
        window.dispatchEvent(new CustomEvent('atsLanguageChanged', { detail: { lang: lang } }));
      };
    }

    // Auto-init on page load
    document.addEventListener('DOMContentLoaded', function() {
      let saved;
      if (isProcessPage) {
        saved = localStorage.getItem('ats_lang_process') || '{{ $activeLang }}';
        if (saved !== 'en' && saved !== 'fr') saved = 'en';
        window.atsSwitchProcessLang(saved);
      } else {
        saved = localStorage.getItem('ats_lang') || '{{ $activeLang }}';
        if (saved !== 'en' && saved !== 'id') saved = 'en';
        window.atsSetLanguage(saved);
      }
    });
  })();
</script>

<style>
  /* ========================================================
     CSS RULES FOR DUAL-LANGUAGE TOGGLING (EN, ID, FR)
     ======================================================== */
  /* English Active */
  html[lang="en"] .ats-lang-id,
  html[lang="en"] .ats-lang-fr,
  html:not([lang="id"]):not([lang="fr"]) .ats-lang-id,
  html:not([lang="id"]):not([lang="fr"]) .ats-lang-fr { display: none !important; }
  
  html[lang="en"] .ats-lang-en,
  html:not([lang="id"]):not([lang="fr"]) .ats-lang-en { display: inline !important; }
  
  html[lang="en"] .ats-lang-block-id,
  html[lang="en"] .ats-lang-block-fr,
  html:not([lang="id"]):not([lang="fr"]) .ats-lang-block-id,
  html:not([lang="id"]):not([lang="fr"]) .ats-lang-block-fr { display: none !important; }
  
  html[lang="en"] .ats-lang-block-en,
  html:not([lang="id"]):not([lang="fr"]) .ats-lang-block-en { display: block !important; }

  /* Indonesian Active */
  html[lang="id"] .ats-lang-en,
  html[lang="id"] .ats-lang-fr { display: none !important; }
  html[lang="id"] .ats-lang-id { display: inline !important; }
  html[lang="id"] .ats-lang-block-en,
  html[lang="id"] .ats-lang-block-fr { display: none !important; }
  html[lang="id"] .ats-lang-block-id { display: block !important; }

  /* French Active */
  html[lang="fr"] .ats-lang-en,
  html[lang="fr"] .ats-lang-id { display: none !important; }
  html[lang="fr"] .ats-lang-fr { display: inline !important; }
  html[lang="fr"] .ats-lang-block-en,
  html[lang="fr"] .ats-lang-block-id { display: none !important; }
  html[lang="fr"] .ats-lang-block-fr { display: block !important; }

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
