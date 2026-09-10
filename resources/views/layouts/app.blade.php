<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'PT. Anugerah Tama Sejati - Best Electrical Supplier')</title>
  <meta name="description" content="@yield('meta_description', 'PT. Anugerah Tama Sejati - Your trusted one-stop supplier for all industrial electrical and wiring components.')">
  <meta name="robots" content="@yield('robots', 'index, follow')">

  <!-- GEO Meta Tags (Surabaya, East Java & AI Crawlability) -->
  <meta name="geo.region" content="ID-JI">
  <meta name="geo.placename" content="Surabaya, East Java, Indonesia">
  <meta name="geo.position" content="-7.250445;112.768845">
  <meta name="ICBM" content="-7.250445, 112.768845">
  <meta name="geo.country" content="ID">

  <!-- Open Graph / SEO -->
  <meta property="og:title" content="@yield('title', 'PT. Anugerah Tama Sejati')">
  <meta property="og:description" content="@yield('meta_description', 'Leading industrial electrical and automation distributor in Indonesia.')">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="PT. Anugerah Tama Sejati">

  <!-- Schema.org JSON-LD LocalBusiness -->
  <script type="application/ld+json">
  {
    "{{ '@context' }}": "https://schema.org",
    "@type": ["LocalBusiness", "ElectricalSupplyStore", "WholesaleStore"],
    "name": "PT. Anugerah Tama Sejati",
    "alternateName": "PT ATS - Best Electrical Supplier & Panel Maker",
    "description": "Authorized industrial electrical distributor and switchboard panel maker in Surabaya, East Java, Indonesia.",
    "url": "{{ url('/') }}",
    "telephone": "+62-31-59178887",
    "email": "sales@atstekno.com",
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
    }
  }
  </script>

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN for Modern Utility Layouts -->
  <script src="https://cdn.tailwindcss.com"></script>
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
      font-weight: 700;
      letter-spacing: 0.05em;
      color: #334155;
      padding: 8px 14px;
      border-radius: 9999px;
      transition: all 0.2s ease;
      text-transform: uppercase;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }

    .nav-link:hover {
      color: var(--color-primary);
      background-color: rgba(225, 29, 72, 0.06);
    }

    .nav-link.active {
      color: #FFFFFF;
      background-color: var(--color-primary);
      box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);
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
        <nav class="hidden lg:flex items-center gap-1">
          <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" data-i18n="nav.home">HOME</a>
          <a href="{{ route('about.index') }}" class="nav-link {{ request()->routeIs('about.*') ? 'active' : '' }}" data-i18n="nav.about">ABOUT US</a>
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
          <button type="button" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition" aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Navigation Dropdown -->
    <div id="mobileMenu" class="hidden lg:hidden border-t border-slate-200 bg-white/95 backdrop-blur-md px-4 pt-3 pb-5 space-y-1">
      <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('home') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.home">HOME</a>
      <a href="{{ route('about.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('about.*') ? 'bg-rose-50 text-rose-600' : 'text-slate-700 hover:bg-slate-50' }}" data-i18n="nav.about">ABOUT US</a>
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

  @stack('scripts')
</body>

</html>
