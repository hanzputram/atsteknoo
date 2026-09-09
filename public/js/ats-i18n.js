/**
 * ATS TEKNO - GLOBAL MULTILINGUAL I18N SYSTEM
 * Primary Language: English ('en') [DEFAULT]
 * Secondary Language: Indonesian ('id')
 * Applies globally across all pages and components cleanly with zero loops.
 */

(function() {
  'use strict';

  // 1. Comprehensive Centralized Dictionary
  window.ATS_DICTIONARY = {
    en: {
      // Nav
      "nav.home": "HOME",
      "nav.about": "ABOUT US",
      "nav.projects": "PROJECTS",
      "nav.products": "PRODUCTS",
      "nav.contact": "CONTACT US",
      "nav.article": "ARTICLE",

      // Hero
      "hero.brand_tag": "ELECTRICAL SUPPLIER",
      "hero.eyebrow": "AUTHORIZED INDUSTRIAL DISTRIBUTOR",
      "hero.headline_pre": "Discover Your",
      "hero.headline_highlight": "Best Electrical",
      "hero.headline_post": "Supplier",
      "hero.subheadline": "Your trusted one-stop supplier for all electrical and wiring components.",
      "hero.btn_product_list": "Product List",
      "hero.btn_contact_us": "Contact Us",
      "hero.badge_certified": "Certified Panel Builder",
      "hero.badge_stock": "Surabaya Ready Stock",
      "hero.stat_clients": "1,000+ Industrial Clients",
      "hero.stat_ready": "Thousands of Ready Stock SKUs",

      // Trusted By
      "trusted.over": "Trusted By Over",
      "trusted.companies": "Companies",
      "trusted.subtitle": "Support electrical needs across industries.",

      // Walking Ribbon
      "ribbon.text1": "Certified Industrial Electrical Supplier",
      "ribbon.text2": "Authorized Distributor Schneider Electric • Legrand • GAE",
      "ribbon.text3": "Nationwide Delivery Across Indonesia",

      // Products Section
      "products.pill": "Our Product",
      "products.headline": "The right products<br>for every project.",
      "products.subtitle": "Explore electrical essentials for power distribution, motor control, and industrial automation.",
      "products.shelf_label": "OUR BEST SELLER PRODUCT",
      "products.ready_stock": "Surabaya Ready Stock",
      "products.request_quote": "Request Quotation →",
      "products.card1_title": "MasterPact MTZ / NT / NW",
      "products.card1_desc": "Air Circuit Breakers (ACB) 630A up to 6300A, low-voltage primary electrical distribution protection.",
      "products.card2_title": "ComPact NSX & CVS",
      "products.card2_desc": "Molded Case Circuit Breakers (MCCB) 16A up to 1600A, reliable for industrial distribution switchboards.",
      "products.card3_title": "Altivar ATV630 / ATV320",
      "products.card3_desc": "Variable Speed Drives (VFD/Inverter) for precision industrial motor speed control & energy savings.",
      "products.card4_title": "TeSys D & F Series",
      "products.card4_desc": "Magnetic Contactors & Overload Relays for motor starting from 9A up to 1000A premium grade.",
      "products.card5_title": "Plexo™ IP66 & Enclosures XL³",
      "products.card5_desc": "Weatherproof IP66 industrial enclosure boxes, modular distribution, and industrial switches.",
      "products.card6_title": "Power Quality & Metering",
      "products.card6_desc": "Digital Energy Meters, Power Factor Capacitor Banks, Surge Protection, and Current Transformers (CT).",

      // Features Grid
      "features.genuine_title": "100% Genuine Products",
      "features.genuine_desc": "All components come with direct manufacturer warranty and authentic certificates of origin.",
      "features.stock_title": "Surabaya Ready Stock",
      "features.stock_desc": "Our main warehouse maintains thousands of breaker, switchgear, and inverter SKUs ready for fast dispatch.",
      "features.logistics_title": "Nationwide Logistics",
      "features.logistics_desc": "Dependable, insured freight logistics delivering safely to industrial project sites across Indonesia.",
      "features.support_title": "Engineering Specialists",
      "features.support_desc": "Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with certified engineers.",

      // Projects 3D Carousel
      "projects.title": "Flagship Projects & Electrical Engineering Portfolio",
      "projects.subtitle": "Proven track record in supplying industrial electrical distribution switchboards, certified automation systems, and critical power infrastructure across Indonesia.",
      "projects.drag_hint": "Drag or use arrows to rotate • Click card to view details",

      // Footer
      "footer.cta_title": "Ready to Power Your Industrial Infrastructure?",
      "footer.cta_desc": "Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with our certified electrical engineering specialists.",
      "footer.btn_wa": "WhatsApp Hotline",
      "footer.btn_quote": "Request BoQ Quotation",
      "footer.col1_header": "Company Profile",
      "footer.tagline": "Industrial Electrical Supplier & Panel Maker",
      "footer.bio": "Trusted nationwide distributor since 2019. Providing certified low-voltage distribution switchboards, industrial automation components, and genuine electrical equipment.",
      "footer.badge1": "Schneider Authorized",
      "footer.badge2": "Legrand Partner",
      "footer.badge3": "GAE Group",
      "footer.badge4": "Certified Panel Maker",
      "footer.hours": "Mon–Fri 08:30–17:00 | Sat 08:30–14:00 WIB",
      "footer.col2_header": "Solutions",
      "footer.col3_header": "Company",
      "footer.col4_header": "Showrooms & Hubs",
      "footer.tab_hq": "Head Office",
      "footer.tab_sby": "Surabaya Hub",
      "footer.tab_pandaan": "Pandaan Hub",
      "footer.rights": "All rights reserved.",
      "footer.back_to_top": "Back to Top ↑",

      // Modals
      "modal.product_title": "Electrical Products & Solutions Catalog",
      "modal.contact_title": "Contact Engineering Team",
      "modal.contact_desc": "Send us your technical inquiry or consult directly with our panel building engineers."
    },

    id: {
      // Nav
      "nav.home": "BERANDA",
      "nav.about": "TENTANG KAMI",
      "nav.projects": "PROYEK",
      "nav.products": "PRODUK",
      "nav.contact": "HUBUNGI KAMI",
      "nav.article": "ARTIKEL",

      // Hero
      "hero.brand_tag": "SUPPLIER ELEKTRIKAL",
      "hero.eyebrow": "DISTRIBUTOR RESMI SURABAYA",
      "hero.headline_pre": "Temukan Mitra",
      "hero.headline_highlight": "Elektrikal Terbaik",
      "hero.headline_post": "Anda",
      "hero.subheadline": "Supplier terpercaya dan terlengkap untuk seluruh kebutuhan komponen elektrikal dan perpanelan Anda.",
      "hero.btn_product_list": "Daftar Produk",
      "hero.btn_contact_us": "Hubungi Kami",
      "hero.badge_certified": "Perakit Panel Bersertifikat",
      "hero.badge_stock": "Ready Stock Surabaya",
      "hero.stat_clients": "1.000+ Klien Industri",
      "hero.stat_ready": "Ribuan SKU Siap Kirim",

      // Trusted By
      "trusted.over": "Dipercaya Oleh Lebih Dari",
      "trusted.companies": "Perusahaan",
      "trusted.subtitle": "Mendukung kebutuhan kelistrikan di berbagai sektor industri.",

      // Walking Ribbon
      "ribbon.text1": "Supplier Elektrikal Industri Bersertifikat",
      "ribbon.text2": "Distributor Resmi Schneider Electric • Legrand • GAE",
      "ribbon.text3": "Pengiriman Cepat ke Seluruh Pelosok Indonesia",

      // Products Section
      "products.pill": "Produk Kami",
      "products.headline": "Produk yang tepat<br>untuk setiap proyek.",
      "products.subtitle": "Jelajahi komponen elektrikal penting untuk distribusi daya, kontrol motor, dan otomasi industri.",
      "products.shelf_label": "PRODUK PALING LARIS KAMI",
      "products.ready_stock": "Ready Stock Surabaya",
      "products.request_quote": "Minta Penawaran →",
      "products.card1_title": "MasterPact MTZ / NT / NW",
      "products.card1_desc": "Air Circuit Breaker (ACB) 630A hingga 6300A, proteksi utama distribusi listrik tegangan rendah.",
      "products.card2_title": "ComPact NSX & CVS",
      "products.card2_desc": "Molded Case Circuit Breaker (MCCB) 16A hingga 1600A, andal untuk panel distribusi pabrik & gedung.",
      "products.card3_title": "Altivar ATV630 / ATV320",
      "products.card3_desc": "Variable Speed Drive (Inverter/VFD) untuk kendali presisi motor industri & efisiensi daya.",
      "products.card4_title": "TeSys D & F Series",
      "products.card4_desc": "Magnetic Contactor & Overload Relay untuk starter motor 9A hingga 1000A kualitas premium.",
      "products.card5_title": "Plexo™ IP66 & Enclosures XL³",
      "products.card5_desc": "Box panel enclosure tahan cuaca & debu IP66, distribusi modular, dan sakelar industri.",
      "products.card6_title": "Power Quality & Metering",
      "products.card6_desc": "Digital Power Meter, Kapasitor Bank Cos Phi, Surge Protection, dan Current Transformer (CT).",

      // Features Grid
      "features.genuine_title": "100% Produk Asli & Original",
      "features.genuine_desc": "Seluruh produk dilengkapi garansi resmi pabrikan dan sertifikat keaslian resmi (CoO).",
      "features.stock_title": "Ready Stock di Surabaya",
      "features.stock_desc": "Gudang utama kami siap dengan ribuan stok breaker, inverter, dan komponen panel untuk pengiriman cepat.",
      "features.logistics_title": "Logistik Seluruh Nusantara",
      "features.logistics_desc": "Pengiriman kargo terpercaya dan berasuransi, tiba dengan aman di lokasi proyek industri Anda.",
      "features.support_title": "Dukungan Tim Ahli Elektrikal",
      "features.support_desc": "Konsultasikan kebutuhan BoQ, kalkulasi kapasitas panel, atau sistem otomasi langsung dengan engineer kami.",

      // Projects 3D Carousel
      "projects.title": "Portofolio Proyek Unggulan & Rekayasa Elektrikal",
      "projects.subtitle": "Rekam jejak terbukti dalam menyuplai panel distribusi tegangan rendah, sistem otomasi industri, dan infrastruktur daya krusial di seluruh Indonesia.",
      "projects.drag_hint": "Geser atau gunakan panah untuk memutar • Klik kartu untuk detail",

      // Footer
      "footer.cta_title": "Siap Mengoptimalkan Infrastruktur Elektrikal Industri Anda?",
      "footer.cta_desc": "Konsultasikan kebutuhan Bill of Quantities (BoQ), kapasitas panel, atau sistem otomasi langsung dengan spesialis kami.",
      "footer.btn_wa": "Hotline WhatsApp",
      "footer.btn_quote": "Permintaan Penawaran BoQ",
      "footer.col1_header": "Profil Perusahaan",
      "footer.tagline": "Supplier Elektrikal Industri & Pembuat Panel",
      "footer.bio": "Distributor terpercaya berskala nasional sejak 2019. Menyediakan panel distribusi tegangan rendah, komponen otomasi, dan peralatan listrik original.",
      "footer.badge1": "Schneider Authorized",
      "footer.badge2": "Mitra Resmi Legrand",
      "footer.badge3": "GAE Group",
      "footer.badge4": "Perakit Panel Bersertifikat",
      "footer.hours": "Sen–Jum 08:30–17:00 | Sab 08:30–14:00 WIB",
      "footer.col2_header": "Solusi Produk",
      "footer.col3_header": "Perusahaan",
      "footer.col4_header": "Kantor & Showroom",
      "footer.tab_hq": "Kantor Pusat",
      "footer.tab_sby": "Cabang Surabaya",
      "footer.tab_pandaan": "Cabang Pandaan",
      "footer.rights": "Hak cipta dilindungi undang-undang.",
      "footer.back_to_top": "Kembali ke Atas ↑",

      // Modals
      "modal.product_title": "Katalog Produk & Solusi Elektrikal",
      "modal.contact_title": "Hubungi Tim Penjualan & Teknik",
      "modal.contact_desc": "Kirimkan pertanyaan teknis atau jadwalkan diskusi langsung dengan tim spesialis panel kami."
    }
  };

  // 2. Retrieve Current Language (Default to 'en')
  window.atsGetLanguage = function() {
    try {
      const stored = localStorage.getItem('ats_lang');
      if (stored === 'id' || stored === 'en') return stored;
    } catch (e) {}

    // Check cookie fallback
    const match = document.cookie.match(/(?:^|;\s*)ats_lang=([^;]+)/);
    if (match && (match[1] === 'id' || match[1] === 'en')) return match[1];

    return 'en'; // Primary language is English
  };

  // Safe translation execution flag to prevent any infinite loops
  let isUpdating = false;

  // 3. Set Language and Apply to Entire Page
  window.atsSetLanguage = function(lang) {
    if (lang !== 'en' && lang !== 'id') lang = 'en';

    // Store in localStorage & Cookie
    try {
      localStorage.setItem('ats_lang', lang);
    } catch (e) {}

    document.cookie = "ats_lang=" + lang + ";path=/;max-age=31536000;SameSite=Lax";

    // Set HTML lang attribute for CSS rules
    document.documentElement.setAttribute('lang', lang);
    document.documentElement.setAttribute('data-lang', lang);

    // Apply translations to DOM safely
    applyTranslations(lang);

    // Update all switcher buttons in the DOM
    updateSwitcherUI(lang);

    // Dispatch global event for custom components
    window.dispatchEvent(new CustomEvent('atsLanguageChanged', {
      detail: { lang: lang }
    }));
  };

  // 4. Apply Translations to All Matching Elements
  function applyTranslations(lang) {
    if (isUpdating) return;
    isUpdating = true;

    try {
      const dict = window.ATS_DICTIONARY[lang] || window.ATS_DICTIONARY.en;

      // A. Elements with data-i18n="key"
      document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        const targetVal = dict[key];
        if (targetVal !== undefined) {
          if (targetVal.includes('<') && targetVal.includes('>')) {
            if (el.innerHTML !== targetVal) el.innerHTML = targetVal;
          } else {
            if (el.textContent !== targetVal) el.textContent = targetVal;
          }
        }
      });

      // B. Elements with inline data-i18n-en and data-i18n-id
      document.querySelectorAll('[data-i18n-en]').forEach(el => {
        const text = el.getAttribute('data-i18n-' + lang);
        if (text) {
          if (text.includes('<') && text.includes('>')) {
            if (el.innerHTML !== text) el.innerHTML = text;
          } else {
            if (el.textContent !== text) el.textContent = text;
          }
        }
      });

      // C. Form input placeholders
      document.querySelectorAll('[data-i18n-placeholder-en]').forEach(el => {
        const placeholder = el.getAttribute('data-i18n-placeholder-' + lang);
        if (placeholder && el.getAttribute('placeholder') !== placeholder) {
          el.setAttribute('placeholder', placeholder);
        }
      });
    } finally {
      isUpdating = false;
    }
  }

  // 5. Synchronize All Switcher Buttons in the UI
  function updateSwitcherUI(lang) {
    document.querySelectorAll('.ats-lang-btn, .ats-floating-lang-btn').forEach(btn => {
      const btnLang = btn.getAttribute('data-lang');
      if (btnLang === lang) {
        btn.classList.add('active');
        btn.setAttribute('aria-pressed', 'true');
      } else {
        btn.classList.remove('active');
        btn.setAttribute('aria-pressed', 'false');
      }
    });
  }

  // 6. Public Helper to query a translated string
  window.atsT = function(key, fallback) {
    const lang = window.atsGetLanguage();
    const dict = window.ATS_DICTIONARY[lang] || window.ATS_DICTIONARY.en;
    return dict[key] || fallback || key;
  };

  // 7. Auto-initialize on DOM ready - completely safe and loop-free
  function init() {
    const initialLang = window.atsGetLanguage();
    window.atsSetLanguage(initialLang);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
