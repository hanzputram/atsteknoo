<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Distributor Schneider Electric Surabaya & Supplier Elektrikal - PT. Anugerah Tama Sejati')</title>
  <meta name="description" content="@yield('meta_description', 'Distributor resmi Schneider Electric di Surabaya & Jawa Timur. Supplier terlengkap MCB, MCCB, ACB, Kontaktor TeSys, Inverter Altivar, dan panel maker bersertifikat PT. Anugerah Tama Sejati.')">
  <meta name="robots" content="@yield('robots', 'index, follow')">
  <link rel="canonical" href="@yield('canonical', url()->current())">
  <link rel="alternate" hreflang="id" href="@yield('canonical', url()->current())">
  <link rel="alternate" hreflang="x-default" href="@yield('canonical', url()->current())">

  <!-- Official ATS Brand Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

  <!-- GEO Meta Tags (Surabaya, East Java & AI Crawlability) -->
  <meta name="geo.region" content="ID-JI">
  <meta name="geo.placename" content="Surabaya, East Java, Indonesia">
  <meta name="geo.position" content="-7.250445;112.768845">
  <meta name="ICBM" content="-7.250445, 112.768845">
  <meta name="geo.country" content="ID">

  <!-- Open Graph / SEO -->
  <meta property="og:title" content="@yield('title', 'Distributor Schneider Electric Surabaya - PT. Anugerah Tama Sejati')">
  <meta property="og:description" content="@yield('meta_description', 'Distributor resmi Schneider Electric di Surabaya & Jawa Timur. Ready stock MCB, MCCB, ACB, Inverter, dan fabrikasi panel listrik bersertifikat.')">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="PT. Anugerah Tama Sejati">
  <meta property="og:locale" content="id_ID">

  <!-- Schema.org JSON-LD LocalBusiness & Organization -->
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@type": ["LocalBusiness", "WholesaleStore"],
    "@id": "{{ url('/#organization') }}",
    "name": "PT. Anugerah Tama Sejati",
    "alternateName": [
      "ATS Tekno",
      "PT ATS",
      "PT Anugerah Tama Sejati"
    ],
    "description": "Authorized industrial electrical distributor and certified switchboard panel maker in Surabaya, East Java, Indonesia. Official partner of Schneider Electric, Legrand, GAE Group, Socomec, Autonics, and Himel.",
    "url": "{{ url('/') }}",
    "telephone": "+62-31-59178887",
    "email": "sales@atstekno.com",
    "priceRange": "$$",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Ruko Galaxi Bumi Permai J-1 No. 23",
      "addressLocality": "Surabaya",
      "addressRegion": "Jawa Timur",
      "postalCode": "60134",
      "addressCountry": "ID"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": -7.250445,
      "longitude": 112.768845
    },
    "hasMap": "https://maps.google.com/?q=-7.250445,112.768845"
  }
  </script>

  @stack('schema')

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- ATS Smooth Scroll & Framer Text Reveal Styles -->
  <link rel="stylesheet" href="{{ asset('css/ats-scroll-effects.css') }}">

  <!-- Tailwind CSS CDN with Typography & Forms Plugins -->
  <script src="https://cdn.tailwindcss.com?plugins=typography,forms,aspect-ratio"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            outfit: ['Outfit', 'sans-serif'],
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          },
          colors: {
            ats: {
              red: '#E11D48',
              dark: '#0F172A',
              navy: '#001D34',
              surface: '#F8FAFC',
            }
          }
        }
      }
    }
  </script>

  <style>
    :root {
      --font-outfit: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      --font-sans: 'Plus Jakarta Sans', sans-serif;

      --color-dark: #0F172A;
      --color-navy: #001D34;
      --color-gray: #475569;
      --color-light-gray: #94A3B8;
      --color-primary: #E11D48;
      --color-bg-page: #FFFFFF;

      --shadow-card: 0 20px 40px -15px rgba(225, 29, 72, 0.12), 0 10px 25px -5px rgba(0, 0, 0, 0.05);
      --transition-base: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Bilingual i18n Switching Rules */
    html[lang="en"] .ats-lang-id,
    html:not([lang="id"]) .ats-lang-id { display: none !important; }
    html[lang="en"] .ats-lang-en,
    html:not([lang="id"]) .ats-lang-en { display: inline !important; }
    html[lang="id"] .ats-lang-en { display: none !important; }
    html[lang="id"] .ats-lang-id { display: inline !important; }

    html[lang="en"] .ats-lang-block-id,
    html:not([lang="id"]) .ats-lang-block-id { display: none !important; }
    html[lang="en"] .ats-lang-block-en,
    html:not([lang="id"]) .ats-lang-block-en { display: block !important; }
    html[lang="id"] .ats-lang-block-en { display: none !important; }
    html[lang="id"] .ats-lang-block-id { display: block !important; }

    /* ==========================================================================
       Rich WYSIWYG Content & Typography Styling (Products, Articles, Projects)
       ========================================================================== */
    .wysiwyg-content,
    .prose {
      font-family: var(--font-sans);
      color: #334155;
      line-height: 1.75;
      font-size: 15px;
    }
    .wysiwyg-content h1, .prose h1 {
      font-family: var(--font-outfit);
      font-size: 1.875rem;
      font-weight: 800;
      color: #0f172a;
      margin-top: 2rem;
      margin-bottom: 0.85rem;
      line-height: 1.25;
      letter-spacing: -0.02em;
    }
    .wysiwyg-content h2, .prose h2 {
      font-family: var(--font-outfit);
      font-size: 1.45rem;
      font-weight: 700;
      color: #0f172a;
      margin-top: 1.85rem;
      margin-bottom: 0.75rem;
      line-height: 1.3;
      letter-spacing: -0.01em;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #e2e8f0;
    }
    .wysiwyg-content h3, .prose h3 {
      font-family: var(--font-outfit);
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e293b;
      margin-top: 1.5rem;
      margin-bottom: 0.6rem;
      line-height: 1.35;
      letter-spacing: -0.01em;
    }
    .wysiwyg-content h4, .prose h4 {
      font-family: var(--font-outfit);
      font-size: 1.05rem;
      font-weight: 600;
      color: #334155;
      margin-top: 1.25rem;
      margin-bottom: 0.5rem;
    }
    .wysiwyg-content h5, .prose h5,
    .wysiwyg-content h6, .prose h6 {
      font-family: var(--font-outfit);
      font-size: 0.95rem;
      font-weight: 600;
      color: #475569;
      margin-top: 1rem;
      margin-bottom: 0.4rem;
    }
    .wysiwyg-content p, .prose p {
      font-family: var(--font-sans);
      margin-top: 0;
      margin-bottom: 1.15rem;
      line-height: 1.75;
      color: #334155;
    }
    .wysiwyg-content strong, .prose strong,
    .wysiwyg-content b, .prose b {
      font-weight: 700;
      color: #0f172a;
    }
    .wysiwyg-content em, .prose em,
    .wysiwyg-content i, .prose i {
      font-style: italic;
    }
    .wysiwyg-content ul, .prose ul {
      list-style-type: disc !important;
      padding-left: 1.6rem !important;
      margin-top: 0.6rem !important;
      margin-bottom: 1.25rem !important;
    }
    .wysiwyg-content ol, .prose ol {
      list-style-type: decimal !important;
      padding-left: 1.6rem !important;
      margin-top: 0.6rem !important;
      margin-bottom: 1.25rem !important;
    }
    .wysiwyg-content li, .prose li {
      font-family: var(--font-sans);
      margin-bottom: 0.4rem;
      line-height: 1.65;
      color: #334155;
    }
    .wysiwyg-content li::marker, .prose li::marker {
      color: #e11d48;
      font-weight: 700;
    }
    .wysiwyg-content table, .prose table {
      width: 100%;
      margin-top: 1.25rem;
      margin-bottom: 1.5rem;
      border-collapse: separate;
      border-spacing: 0;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
      background: #ffffff;
    }
    .wysiwyg-content th, .prose th {
      background: #f8fafc;
      color: #0f172a;
      font-weight: 700;
      font-size: 0.82rem;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      padding: 12px 16px;
      border-bottom: 1px solid #e2e8f0;
      border-right: 1px solid #f1f5f9;
      text-align: left;
    }
    .wysiwyg-content td, .prose td {
      padding: 11px 16px;
      border-bottom: 1px solid #f1f5f9;
      border-right: 1px solid #f8fafc;
      color: #334155;
      font-size: 0.92rem;
      line-height: 1.5;
    }
    .wysiwyg-content tr:last-child td, .prose tr:last-child td {
      border-bottom: none;
    }
    .wysiwyg-content td:first-child, .prose td:first-child {
      font-weight: 600;
      color: #1e293b;
      background: #fafbfc;
      width: 32%;
      border-right: 1px solid #e2e8f0;
    }
    .wysiwyg-content tr:hover td, .prose tr:hover td {
      background: #f8fafc;
    }
    .wysiwyg-content blockquote, .prose blockquote {
      border-left: 4px solid #e11d48;
      background: #fff1f2;
      padding: 14px 20px;
      margin: 1.5rem 0;
      border-radius: 0 10px 10px 0;
      font-style: italic;
      color: #475569;
      font-size: 0.95rem;
      line-height: 1.6;
    }
    .wysiwyg-content code, .prose code {
      background: #f1f5f9;
      color: #e11d48;
      padding: 2px 7px;
      border-radius: 5px;
      font-size: 0.88em;
      font-family: Consolas, Monaco, monospace;
      font-weight: 600;
    }
    .wysiwyg-content pre, .prose pre {
      background: #0f172a;
      color: #f8fafc;
      padding: 16px 20px;
      border-radius: 10px;
      overflow-x: auto;
      font-size: 0.9em;
      line-height: 1.6;
      margin: 1.5rem 0;
    }
    .wysiwyg-content hr, .prose hr {
      border: none;
      border-top: 1px solid #e2e8f0;
      margin: 2rem 0;
    }
    .wysiwyg-content a, .prose a {
      color: #e11d48;
      text-decoration: underline;
      text-underline-offset: 3px;
      font-weight: 600;
      transition: color 0.15s;
    }
    .wysiwyg-content a:hover, .prose a:hover {
      color: #be123c;
    }
    .wysiwyg-content img, .prose img {
      max-width: 100%;
      height: auto;
      border-radius: 12px;
      margin: 1.25rem 0;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
      border: 1px solid #e2e8f0;
    }
    .wysiwyg-content figure, .prose figure,
    .wysiwyg-content .article-figure, .prose .article-figure {
      margin: 2rem 0;
      clear: both;
    }
    .wysiwyg-content .article-figure.align-center,
    .prose .article-figure.align-center {
      text-align: center;
      margin-left: auto;
      margin-right: auto;
    }
    .wysiwyg-content .article-figure.align-left,
    .prose .article-figure.align-left {
      float: left;
      margin: 0.5rem 1.75rem 1.25rem 0;
      max-width: 360px;
    }
    .wysiwyg-content .article-figure.align-right,
    .prose .article-figure.align-right {
      float: right;
      margin: 0.5rem 0 1.25rem 1.75rem;
      max-width: 360px;
    }
    .wysiwyg-content .article-figure.align-full,
    .prose .article-figure.align-full {
      width: 100%;
      text-align: center;
    }
    @media (max-width: 640px) {
      .wysiwyg-content .article-figure.align-left,
      .wysiwyg-content .article-figure.align-right,
      .prose .article-figure.align-left,
      .prose .article-figure.align-right {
        float: none !important;
        margin: 1.5rem auto !important;
        max-width: 100% !important;
        text-align: center !important;
      }
    }
    .wysiwyg-content figcaption, .prose figcaption {
      font-size: 0.82rem;
      font-weight: 600;
      color: #64748b;
      margin-top: 0.65rem;
      line-height: 1.5;
      text-align: center;
      letter-spacing: 0.02em;
    }
    .wysiwyg-content .callout-box, .prose .callout-box {
      border-radius: 16px;
      padding: 1.25rem 1.5rem;
      margin: 1.8rem 0;
      box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .wysiwyg-content .callout-info, .prose .callout-info {
      background: #fff1f2;
      border-left: 4px solid #e11d48;
      color: #9f1239;
    }
    .wysiwyg-content .callout-info h5, .prose .callout-info h5 {
      color: #881337;
      font-weight: 800;
      margin-top: 0;
      margin-bottom: 0.35rem;
      font-size: 0.95rem;
    }
    .wysiwyg-content .callout-info p, .prose .callout-info p {
      color: #9f1239;
      margin-bottom: 0;
      font-size: 0.88rem;
      line-height: 1.6;
    }
    .wysiwyg-content .article-spec-table, .prose .article-spec-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      overflow: hidden;
      margin: 1.8rem 0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--font-outfit);
      background-color: #FFFFFF;
      color: var(--color-dark);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    /* Public Header Navbar Styling */
    .public-navbar-header {
      position: sticky;
      top: 0;
      z-index: 50;
      background: rgba(255, 255, 255, 0.94);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(226, 232, 240, 0.8);
      transition: var(--transition-base);
    }

    .nav-link {
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.02em;
      color: #334155;
      padding: 6px 9px;
      border-radius: 8px;
      transition: all 0.2s ease;
      text-transform: uppercase;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      white-space: nowrap !important;
      flex-shrink: 0;
    }

    .nav-link:hover {
      color: var(--color-primary);
      background-color: rgba(225, 29, 72, 0.06);
    }

    .nav-link.active {
      color: var(--color-primary);
      font-weight: 700;
      background-color: rgba(225, 29, 72, 0.08);
      border-radius: 8px;
    }

    @media (max-width: 1360px) and (min-width: 1280px) {
      .nav-link {
        font-size: 12px;
        padding: 5px 7px;
        letter-spacing: 0.01em;
      }
    }

    .content-area-wrapper {
      flex: 1 0 auto;
      width: 100%;
      background-color: #FFFFFF;
    }
  </style>

  @stack('styles')
</head>

<body>

  <!-- ================= TOP HEADER NAVIGATION ================= -->
  <header class="public-navbar-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">

        <!-- Brand Logo & Identification (No background on logo) -->
        <a href="{{ route('home') }}" class="flex items-center gap-3.5 group text-decoration-none">
          <div class="w-12 h-12 flex items-center justify-center shrink-0 group-hover:scale-105 transition">
            <img class="w-full h-full object-contain"
                 src="{{ asset('images/ats-logo.png') }}"
                 alt="PT. Anugerah Tama Sejati Logo">
          </div>
          <div>
            <span class="block font-black tracking-tight text-slate-900 text-base sm:text-lg leading-tight group-hover:text-rose-600 transition">
              PT. ANUGERAH TAMA SEJATI
            </span>
            <span class="block text-[10px] font-bold tracking-widest text-slate-400 uppercase leading-none mt-0.5" data-i18n="hero.brand_tag">
              ELECTRICAL SUPPLIER
            </span>
          </div>
        </a>

        <!-- Desktop Navigation Items -->
        <nav class="hidden xl:flex items-center gap-1">
          <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" data-i18n="nav.home">HOME</a>
          <a href="{{ route('about.index') }}" class="nav-link {{ request()->routeIs('about.*') ? 'active' : '' }}" data-i18n="nav.about">ABOUT US</a>
          <a href="{{ route('services.panel') }}" class="nav-link {{ request()->routeIs('services.panel') ? 'active' : '' }}" data-i18n="nav.panel_builder">PANEL BUILDER</a>
          <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" data-i18n="nav.products">PRODUCTS</a>
          <a href="{{ route('price-list.index') }}" class="nav-link {{ request()->routeIs('price-list.*') || request()->routeIs('brands.*') ? 'active' : '' }}" data-i18n="nav.price_list">PRICE LIST</a>
          <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" data-i18n="nav.projects">PROJECTS</a>
          <a href="{{ route('articles.index') }}" class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" data-i18n="nav.article">ARTICLE</a>
          <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" data-i18n="nav.contact">CONTACT US</a>
        </nav>

        <!-- Right Side: Language Switcher & Mobile Menu Button -->
        <div class="flex items-center gap-3">
          @include('components.language-switcher')

          <!-- Mobile Hamburger Toggle -->
          <button type="button" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="xl:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition" aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Navigation Dropdown -->
    <div id="mobileMenu" class="hidden xl:hidden border-t border-slate-200 bg-white/95 backdrop-blur-md px-4 pt-3 pb-5 space-y-1">
      <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('home') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.home">HOME</a>
      <a href="{{ route('about.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('about.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.about">ABOUT US</a>
      <a href="{{ route('services.panel') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('services.panel') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.panel_builder">PANEL BUILDER</a>
      <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('products.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.products">PRODUCTS</a>
      <a href="{{ route('price-list.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('price-list.*') || request()->routeIs('brands.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.price_list">PRICE LIST</a>
      <a href="{{ route('projects.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('projects.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.projects">PROJECTS</a>
      <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('articles.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.article">ARTICLE</a>
      <a href="{{ route('contact.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('contact.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.contact">CONTACT US</a>
    </div>
  </header>

  <!-- ================= MAIN CONTENT SLOT ================= -->
  <main class="content-area-wrapper">
    @yield('content')
  </main>

  <!-- ================= SHARED SKYLINE FOOTER ================= -->
  @include('components.footer')

  <!-- ATS Multilingual i18n Logic -->
  <script src="{{ asset('js/ats-i18n.js') }}"></script>

  <!-- Floating Sidebar Button: Buy at Listrikonline (All Pages) -->
  @include('components.floating-listrikonline-btn')

  <!-- Floating Live Chat & Windows Desktop Notification -->
  @include('components.floating-live-chat')

  <!-- Lenis Smooth Scroll & Framer Text Reveal On Scroll Engine -->
  <script src="{{ asset('js/lenis.min.js') }}"></script>
  <script src="{{ asset('js/ats-scroll-effects.js') }}"></script>

  @stack('scripts')
</body>

</html>
