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
      "nav.panel_builder": "PANEL BUILDER",
      "nav.products": "PRODUCTS",
      "nav.price_list": "PRICE LIST",
      "nav.projects": "PROJECTS",
      "nav.article": "ARTICLE",
      "nav.contact": "CONTACT US",

      // Hero
      "hero.brand_tag": "ELECTRICAL SUPPLIER",
      "hero.eyebrow": "AUTHORIZED SCHNEIDER ELECTRIC DISTRIBUTOR SURABAYA",
      "hero.headline": "Authorized Schneider Electric Distributor & Switchboard Panel Builder in Surabaya",
      "hero.subheadline": "Official Schneider Electric, Vinsa, GAE, and Legrand distributor in Surabaya. Supplying genuine electrical components with ready stock warehouse & certified panel manufacturing.",
      "hero.btn_products": "Product Catalog",
      "hero.btn_panel": "Contact Us",
      "hero.btn_product_list": "Product Catalog",
      "hero.btn_contact_us": "Contact Us",
      "hero.badge_certified": "Certified Panel Builder",
      "hero.badge_stock": "Ready Stock Across Indonesia",
      "hero.stat_clients": "1,000+ Industrial Clients",
      "hero.stat_ready": "Thousands of Ready Stock SKUs",
      
      // Trusted By
      "trusted.badge": "Enterprise & Infrastructure",
      "trusted.title_prefix": "Trusted by over",
      "trusted.title_suffix": "Company",
      "trusted.over": "Trusted By Over",
      "trusted.companies": "Companies",
      "trusted.subtitle": "Support electrical needs across industries.",

      // Walking Ribbon
      "ribbon.text1": "Certified Industrial Electrical Supplier",
      "ribbon.text2": "Authorized Distributor Schneider Electric • Vinsa • Legrand • GAE",
      "ribbon.text3": "Nationwide Delivery Across Indonesia",

      // Products Section
      "products.pill": "Our Product",
      "products.headline": "The right products<br>for every project.",
      "products.subtitle": "Explore electrical essentials for power distribution, motor control, and industrial automation.",
      "products.shelf_label": "OUR BEST SELLER PRODUCT",
      "products.ready_stock": "Ready Stock",
      "products.request_quote": "View Specs",
      "products.view_specs": "View Specs",
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
      "features.stock_title": "Ready Stock Inventory",
      "features.stock_desc": "Our main warehouse maintains thousands of breaker, switchgear, and inverter SKUs ready for fast dispatch.",
      "features.logistics_title": "Nationwide Logistics",
      "features.logistics_desc": "Dependable, insured freight logistics delivering safely to industrial project sites across Indonesia.",
      "features.support_title": "Engineering Specialists",
      "features.support_desc": "Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with certified engineers.",

      // Projects 3D Carousel
      "projects.title": "Electrical Engineering Project Portfolio",
      "projects.subtitle": "Proven track record in supplying industrial electrical distribution switchboards, certified automation systems, and critical power infrastructure across Indonesia.",
      "projects.drag_hint": "Drag or use arrows to rotate • Click card to view details",
      "projects.empty_notice": "Portfolio is not yet available.",

      // Home Technical Articles
      "articles.badge": "BLOG & TECHNICAL ARTICLES",
      "articles.title": "Blog, Articles & Industrial Electrical Insights",
      "articles.subtitle": "Authoritative blog guides, technical articles on IEC 61439 switchboard standards, component selection, and industrial electrical insights from Surabaya's premier distributor.",
      "articles.btn_all": "Explore All Blog Articles",

      // Price List Page
      "pricelist.breadcrumb_home": "Home",
      "pricelist.breadcrumb_current": "Price List & Catalogs",
      "pricelist.badge": "OFFICIAL PRICE LIST & PRINCIPAL CATALOGS",
      "pricelist.title": "Official Price List & Catalogs",
      "pricelist.subtitle": "Browse and download the latest official price lists directly from principal manufacturers (Schneider Electric, GAE, Vinsa, DV Electric). Download complete PDF catalogs for project tender estimation, BoQ budgeting, and industrial electrical component procurement.",
      "pricelist.search_placeholder": "Search catalog, series, or brand...",
      "pricelist.count_suffix": "Catalogs",
      "pricelist.filter_all": "All Brands",
      "pricelist.tax_incl": "Incl. 11% VAT",
      "pricelist.tax_excl": "Excl. 11% VAT",
      "pricelist.btn_view": "View PDF",
      "pricelist.btn_download": "Download",
      "pricelist.btn_whatsapp": "Inquire Project Discount via WhatsApp",
      "pricelist.empty_title": "No matching catalogs found",
      "pricelist.empty_desc": "Try another keyword or select the All Brands option.",
      "pricelist.empty_reset": "Reset Search",
      "pricelist.brands_badge": "BRAND DIRECTORY",
      "pricelist.brands_title": "Explore by Brand Principal",
      "pricelist.brands_sub": "Select a brand to view technical specifications and official distributor product lines.",
      "pricelist.products_count": "Products",
      "pricelist.view_catalog": "View Catalog →",
      "pricelist.cta_badge": "TENDER & BOQ SUBMISSION",
      "pricelist.cta_title": "Need Tender Support Letters or Special Project Quotations?",
      "pricelist.cta_desc": "Submit your Bill of Quantities (BoQ) or material specifications. Our Sales Engineering team is ready to assist with official distributor discounts and manufacturer support letters.",
      "pricelist.cta_btn_wa": "Consult BoQ on WhatsApp",
      "pricelist.cta_btn_contact": "Contact Head Office",

      // Live Chat Widget
      "chat.toast_app": "ATS Support",
      "chat.toast_time": "Just now",
      "chat.toast_title": "ATS Support Online",
      "chat.toast_desc": "Need BoQ quotation, Schneider/Siemens switchboards, or component pricing? Chat with ATS Support now.",
      "chat.btn_chat": "Chat with ATS Support",
      "chat.btn_later": "Later",
      "chat.drawer_title": "ATS Support",
      "chat.drawer_sub": "PT Anugerah Tama Sejati • Live Online",
      "chat.welcome_p1": "Hello! 👋 Welcome to <strong>PT Anugerah Tama Sejati</strong>.",
      "chat.welcome_p2": "How can we assist you with electrical switchboard specifications, Motor Control Centers (MCC), SCADA, or BoQ component quotations for Schneider, Siemens, and Mitsubishi?",
      "chat.identity_title": "Consultation Identity",
      "chat.identity_req": "(Required)",
      "chat.name_placeholder": "Your Name / Company Name *",
      "chat.contact_placeholder": "WhatsApp Number / Email *",
      "chat.msg_placeholder": "Type your inquiry here...",
      "chat.btn_send": "Send",
      "chat.typing_indicator": "ATS Support is typing...",

      // About Us Publications
      "about.compro_badge": "INDONESIA • OFFICIAL PUBLICATION",
      "about.compro_title": "OUR COMPANY PROFILE",
      "about.compro_desc": "PT. Anugerah Tama Sejati is headquartered in Surabaya, East Java, Indonesia. Our company specializes in the procurement of electrical equipment, particularly for industrial sectors. We also provide optimal solutions and premier service for our clients across Manufacturing, Building Infrastructure, OEM, MEP Contractors, and Switchboard Panel Makers. Established on August 1st, 2019, our core concept is fulfilling all electrical equipment and distribution needs across Indonesia.",
      "about.compro_btn": "Download PDF",
      "about.panel_badge": "ENGINEERING REFERENCE • 2026 EDITION",
      "about.panel_title": "ATS PANEL MAKER & PROJECT REFERENCE",
      "about.panel_desc": "Comprehensive engineering portfolio documenting custom fabrication of Low Voltage Main Distribution Panels (LVMDP), Motor Control Centers (MCC), Power Factor Capacitor Banks, Generator-Grid Synchronizing Switchgear, and certified industrial protection installations across Indonesia. Fully compliant with IEC 61439 and SNI testing standards.",
      "about.panel_btn": "Download PDF",

      // Footer
      "footer.cta_title": "Ready to Power Your Industrial Infrastructure?",
      "footer.cta_desc": "Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with our certified electrical engineering specialists.",
      "footer.btn_wa": "WhatsApp Hotline",
      "footer.btn_quote": "Request BoQ Quotation",
      "footer.col1_header": "Company Profile",
      "footer.tagline": "Industrial Electrical Supplier & Panel Maker",
      "footer.bio": "Trusted nationwide distributor since 2019. Providing certified low-voltage distribution switchboards, industrial automation components, and genuine electrical equipment.",
      "footer.badge1": "Schneider Authorized Dealer",
      "footer.badge2": "GAE Authorized Dealer",
      "footer.badge3": "Legrand Authorized Dealer",
      "footer.badge4": "Certified Panel Maker",
      "footer.hours": "Mon–Fri 08:30–17:00 | Sat 08:30–14:00 WIB",
      "footer.col2_header": "Product Catalogue",
      "footer.col3_header": "Company",
      "footer.col4_header": "Showrooms & Hubs",
      "footer.tab_hq": "Surabaya - Merr",
      "footer.tab_sby": "Surabaya - Jagalan",
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
      "nav.panel_builder": "JASA PANEL",
      "nav.products": "PRODUK",
      "nav.price_list": "DAFTAR HARGA",
      "nav.projects": "PROYEK",
      "nav.article": "ARTIKEL",
      "nav.contact": "HUBUNGI KAMI",

      // Hero
      "hero.brand_tag": "DISTRIBUTOR RESMI",
      "hero.eyebrow": "DISTRIBUTOR RESMI SCHNEIDER ELECTRIC SURABAYA",
      "hero.headline": "Distributor Resmi Schneider Electric & Panel Maker di Surabaya",
      "hero.subheadline": "Distributor resmi Schneider Electric, Vinsa, GAE, dan Legrand di Surabaya. Menyediakan komponen elektrikal original ready stock gudang & perakitan panel listrik bergaransi.",
      "hero.btn_products": "Lihat Katalog Produk",
      "hero.btn_panel": "Konsultasi Panel Listrik",
      "hero.btn_product_list": "Lihat Katalog Produk",
      "hero.btn_contact_us": "Konsultasi Panel Listrik",
      "hero.badge_certified": "Perakit Panel Bersertifikat",
      "hero.badge_stock": "Ready Stock Ribuan SKU",
      "hero.stat_clients": "1.000+ Klien Industri",
      "hero.stat_ready": "Ribuan SKU Siap Kirim",

      // Trusted By
      "trusted.badge": "Perusahaan & Infrastruktur",
      "trusted.title_prefix": "Dipercaya lebih dari",
      "trusted.title_suffix": "Perusahaan",
      "trusted.over": "Dipercaya Oleh Lebih Dari",
      "trusted.companies": "Perusahaan",
      "trusted.subtitle": "Mendukung kebutuhan kelistrikan di berbagai sektor industri.",

      // Walking Ribbon
      "ribbon.text1": "Supplier Elektrikal Industri Bersertifikat",
      "ribbon.text2": "Distributor Resmi Schneider Electric • Vinsa • Legrand • GAE",
      "ribbon.text3": "Pengiriman Cepat ke Seluruh Pelosok Indonesia",

      // Products Section
      "products.pill": "Produk Kami",
      "products.headline": "Produk yang tepat<br>untuk setiap proyek.",
      "products.subtitle": "Jelajahi komponen elektrikal penting untuk distribusi daya, kontrol motor, dan otomasi industri.",
      "products.shelf_label": "PRODUK PALING LARIS KAMI",
      "products.ready_stock": "Ready Stock",
      "products.request_quote": "Lihat Spesifikasi",
      "products.view_specs": "Lihat Spesifikasi",
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
      "features.stock_title": "Ready Stock Komponen",
      "features.stock_desc": "Gudang utama kami siap dengan ribuan stok breaker, inverter, dan komponen panel untuk pengiriman cepat.",
      "features.logistics_title": "Logistik Seluruh Nusantara",
      "features.logistics_desc": "Pengiriman kargo terpercaya dan berasuransi, tiba dengan aman di lokasi proyek industri Anda.",
      "features.support_title": "Dukungan Tim Ahli Elektrikal",
      "features.support_desc": "Konsultasikan kebutuhan BoQ, kalkulasi kapasitas panel, atau sistem otomasi langsung dengan engineer kami.",

      // Projects 3D Carousel
      "projects.title": "Portofolio Proyek Unggulan & Rekayasa Elektrikal",
      "projects.subtitle": "Rekam jejak terbukti dalam menyuplai panel distribusi tegangan rendah, sistem otomasi industri, dan infrastruktur daya krusial di seluruh Indonesia.",
      "projects.drag_hint": "Geser atau gunakan panah untuk memutar • Klik kartu untuk detail",
      "projects.empty_notice": "Portofolio belum tersedia.",

      // Home Technical Articles
      "articles.badge": "BLOG & ARTIKEL KELISTRIKAN",
      "articles.title": "Blog, Artikel & Wawasan Rekayasa Kelistrikan",
      "articles.subtitle": "Kumpulan artikel blog dan panduan teknis seputar standar panel listrik IEC 61439, pemilihan komponen proteksi, serta wawasan rekayasa kelistrikan dari distributor resmi terpercaya.",
      "articles.btn_all": "Lihat Semua Blog & Artikel",

      // Price List Page
      "pricelist.breadcrumb_home": "Beranda",
      "pricelist.breadcrumb_current": "Daftar Harga & Katalog",
      "pricelist.badge": "DAFTAR HARGA RESMI & KATALOG PRINSIPAL",
      "pricelist.title": "Pricelist & Katalog Resmi",
      "pricelist.subtitle": "Jelajahi dan unduh daftar harga resmi terbaru langsung dari pabrikan prinsipal (Schneider Electric, GAE, Vinsa, DV Electric). Unduh katalog lengkap berformat PDF untuk kebutuhan RAB, tender proyek, dan pengadaan komponen listrik industri.",
      "pricelist.search_placeholder": "Cari katalog, seri, atau brand...",
      "pricelist.count_suffix": "Katalog",
      "pricelist.filter_all": "Semua Brand",
      "pricelist.tax_incl": "Termasuk PPN 11%",
      "pricelist.tax_excl": "Belum Termasuk PPN 11%",
      "pricelist.btn_view": "Lihat PDF",
      "pricelist.btn_download": "Unduh",
      "pricelist.btn_whatsapp": "Tanya Diskon Proyek via WhatsApp",
      "pricelist.empty_title": "Tidak ada katalog yang cocok",
      "pricelist.empty_desc": "Coba gunakan kata kunci pencarian yang lain atau pilih opsi Semua Brand.",
      "pricelist.empty_reset": "Reset Pencarian",
      "pricelist.brands_badge": "DIREKTORI BRAND",
      "pricelist.brands_title": "Jelajahi Berdasarkan Brand Principal",
      "pricelist.brands_sub": "Pilih brand untuk melihat rincian spesifikasi teknis dan lini produk distributor resmi.",
      "pricelist.products_count": "Produk",
      "pricelist.view_catalog": "Lihat Katalog →",
      "pricelist.cta_badge": "PENGAJUAN TENDER & BOQ",
      "pricelist.cta_title": "Butuh Surat Dukungan Tender atau Penawaran Harga Khusus Proyek?",
      "pricelist.cta_desc": "Kirimkan daftar Bill of Quantities (BoQ) atau spek material proyek Anda. Tim Sales Engineer PT. Anugerah Tama Sejati siap membantu perhitungan diskon resmi distributor serta surat dukungan pabrikan.",
      "pricelist.cta_btn_wa": "Konsultasi BoQ via WhatsApp",
      "pricelist.cta_btn_contact": "Hubungi Kantor Pusat",

      // Live Chat Widget
      "chat.toast_app": "ATS Support",
      "chat.toast_time": "Baru saja",
      "chat.toast_title": "ATS Support Online",
      "chat.toast_desc": "Butuh penawaran BoQ, panel listrik Schneider/Siemens, atau harga komponen? Hubungi ATS Support sekarang.",
      "chat.btn_chat": "Chat dengan ATS Support",
      "chat.btn_later": "Nanti",
      "chat.drawer_title": "ATS Support",
      "chat.drawer_sub": "PT Anugerah Tama Sejati • Online Langsung",
      "chat.welcome_p1": "Halo! 👋 Selamat datang di <strong>PT Anugerah Tama Sejati</strong>.",
      "chat.welcome_p2": "Ada yang bisa kami bantu seputar spesifikasi panel listrik, motor control center (MCC), SCADA, atau penawaran BoQ komponen Schneider, Siemens, dan Mitsubishi?",
      "chat.identity_title": "Identitas Konsultasi",
      "chat.identity_req": "(Wajib diisi)",
      "chat.name_placeholder": "Nama Anda / Nama PT *",
      "chat.contact_placeholder": "No. WhatsApp / Email *",
      "chat.msg_placeholder": "Ketik pesan konsultasi ke ATS Support...",
      "chat.btn_send": "Kirim",
      "chat.typing_indicator": "ATS Support sedang mengetik...",

      // About Us Publications
      "about.compro_badge": "INDONESIA • PUBLIKASI RESMI",
      "about.compro_title": "PROFIL PERUSAHAAN KAMI",
      "about.compro_desc": "PT. Anugerah Tama Sejati berpusat di Surabaya, Jawa Timur, Indonesia. Perusahaan kami bergerak di bidang pengadaan peralatan listrik khususnya untuk industri. Kami juga memberikan solusi dan pelayanan yang terbaik bagi semua pelanggan kami dalam bidang Industri, Building, OEM, Kontraktor ME, dan Panel Maker. Perusahaan kami didirikan sejak 1 Agustus 2019 dengan satu konsep yaitu memenuhi semua kebutuhan listrik bagi masyarakat Indonesia.",
      "about.compro_btn": "Unduh PDF",
      "about.panel_badge": "PORTOFOLIO REKAYASA • EDISI 2026",
      "about.panel_title": "ATS PANEL MAKER & REFERENSI PROYEK",
      "about.panel_desc": "Dokumen portofolio fabrikasi Low Voltage Main Distribution Panel (LVMDP), Motor Control Center (MCC), Capacitor Bank, Synchronizing Panel, serta instalasi proteksi elektrikal industri terkemuka. Seluruh perakitan memenuhi standar pengujian ketat IEC 61439 dan SNI untuk menjamin keandalan operasional fasilitas industri Anda.",
      "about.panel_btn": "Unduh PDF",

      // Footer
      "footer.cta_title": "Siap Mengoptimalkan Infrastruktur Elektrikal Industri Anda?",
      "footer.cta_desc": "Konsultasikan kebutuhan Bill of Quantities (BoQ), kapasitas panel, atau sistem otomasi langsung dengan spesialis kami.",
      "footer.btn_wa": "Hotline WhatsApp",
      "footer.btn_quote": "Permintaan Penawaran BoQ",
      "footer.col1_header": "Profil Perusahaan",
      "footer.tagline": "Supplier Elektrikal Industri & Pembuat Panel",
      "footer.bio": "Distributor terpercaya berskala nasional sejak 2019. Menyediakan panel distribusi tegangan rendah, komponen otomasi, dan peralatan listrik original.",
      "footer.badge1": "Schneider Authorized Dealer",
      "footer.badge2": "GAE Authorized Dealer",
      "footer.badge3": "Legrand Authorized Dealer",
      "footer.badge4": "Perakit Panel Bersertifikat",
      "footer.hours": "Sen–Jum 08:30–17:00 | Sab 08:30–14:00 WIB",
      "footer.col2_header": "Product Catalogue",
      "footer.col3_header": "Perusahaan",
      "footer.col4_header": "Kantor & Showroom",
      "footer.tab_hq": "Surabaya - Merr",
      "footer.tab_sby": "Surabaya - Jagalan",
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

    return 'en'; // Primary language is English by default
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
        // Respect dedicated bilingual containers
        if (el.classList.contains('ats-lang-en') && lang !== 'en') return;
        if (el.classList.contains('ats-lang-id') && lang !== 'id') return;

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

      // D. Element title and aria-label attributes
      document.querySelectorAll('[data-i18n-title-en]').forEach(el => {
        const title = el.getAttribute('data-i18n-title-' + lang);
        if (title && el.getAttribute('title') !== title) {
          el.setAttribute('title', title);
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

  // 8. Global Email Redirect: Automatically redirect any mailto: clicks directly to Gmail Web Compose
  document.addEventListener('click', function(e) {
    var mailLink = e.target.closest && e.target.closest('a[href^="mailto:"]');
    if (!mailLink) return;

    var rawHref = mailLink.getAttribute('href') || '';
    var mailtoData = rawHref.replace(/^mailto:/i, '');
    var parts = mailtoData.split('?');
    var recipient = decodeURIComponent(parts[0] || 'sales@atstekno.com');
    var query = parts[1] || '';
    
    var params = new URLSearchParams(query);
    var subject = params.get('subject') || 'Konsultasi & Penawaran Panel Listrik - PT Anugerah Tama Sejati';
    var body = params.get('body') || 'Halo Tim Sales PT Anugerah Tama Sejati,\n\nSaya ingin berkonsultasi mengenai kebutuhan panel listrik dan komponen industri.\n\nTerima kasih.';

    var gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1' +
      '&to=' + encodeURIComponent(recipient) +
      '&su=' + encodeURIComponent(subject) +
      '&body=' + encodeURIComponent(body);

    e.preventDefault();
    window.open(gmailUrl, '_blank', 'noopener,noreferrer');
  });

})();
