<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promo Distributor Schneider Electric Surabaya & Supplier Elektrikal - PT. Anugerah Tama Sejati</title>
  <meta name="description"
    content="Klaim promo diskon pengadaan elektrikal Schneider Electric resmi di Surabaya. Ready stock MCB, MCCB, ACB MasterPact, Inverter Altivar, TeSys Contactor, dan perakitan panel maker bersertifikat. Garansi 100% original, faktur pajak PPN 11%.">
  <meta name="keywords"
    content="promo schneider surabaya, distributor schneider surabaya, diskon mcb schneider, harga mccb schneider, inverter altivar surabaya, panel maker surabaya, pt anugerah tama sejati">

  <!-- Official ATS Brand Favicon (ats2.png master) -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=ats2">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=ats2">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=ats2">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=ats2">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=ats2">

  <!-- GEO Meta Tags (Location & AI Crawlability) -->
  <meta name="geo.region" content="ID-JI">
  <meta name="geo.placename" content="Surabaya, East Java, Indonesia">
  <meta name="geo.position" content="-7.250445;112.768845">
  <meta name="ICBM" content="-7.250445, 112.768845">
  <meta name="geo.country" content="ID">

  <!-- Open Graph -->
  <link rel="canonical" href="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Promo Distributor Schneider Electric Surabaya - PT. Anugerah Tama Sejati">
  <meta property="og:description" content="Diskon proyek dan pengadaan industri komponen Schneider Electric ready stock Surabaya. Konsultasi BoQ & klaim diskon via WhatsApp sekarang.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="PT. Anugerah Tama Sejati">
  <meta property="og:image" content="{{ asset('images/ats-logo-square-256.png') }}">

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- ATS Smooth Scroll & Framer Text Reveal Styles (Dual-path delivery for localhost & shared hosting) -->
  <link rel="stylesheet" href="{{ asset('css/ats-scroll-effects.css') }}?v={{ filemtime(public_path('css/ats-scroll-effects.css')) }}">
  <link rel="stylesheet" href="{{ url('/public/css/ats-scroll-effects.css') }}?v={{ filemtime(public_path('css/ats-scroll-effects.css')) }}">

  <!-- Swiper CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    :root {
      --font-outfit: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      --font-sans: 'Plus Jakarta Sans', sans-serif;

      --color-dark: #0F172A;
      --color-gray: #475569;
      --color-light-gray: #94A3B8;
      --color-primary: #E11D48;
      --color-bg-page: #FFFFFF;

      --shadow-card: 0 20px 40px -15px rgba(225, 29, 72, 0.12), 0 10px 25px -5px rgba(0, 0, 0, 0.05);
      --shadow-float: 0 16px 36px rgba(0, 0, 0, 0.1);

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
      background-image: none;
      color: var(--color-dark);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 0;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    /* Top Urgency Announcement Bar */
    .promo-top-bar {
      width: 100%;
      background: linear-gradient(90deg, #9F1239 0%, #E11D48 50%, #BE123C 100%);
      color: #FFFFFF;
      padding: 9px 16px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.02em;
      box-shadow: 0 2px 10px rgba(159, 18, 57, 0.25);
      z-index: 40;
    }

    .promo-top-inner {
      max-width: 1480px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }

    .promo-pulse-dot {
      display: inline-block;
      width: 8px;
      height: 8px;
      background: #FACC15;
      border-radius: 50%;
      margin-right: 6px;
      animation: pulseDot 1.4s infinite;
    }

    @keyframes pulseDot {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.4); opacity: 0.6; }
    }

    .promo-countdown-pill {
      background: rgba(0, 0, 0, 0.3);
      padding: 3px 10px;
      border-radius: 999px;
      font-family: Consolas, monospace;
      font-weight: 700;
      font-size: 13px;
      color: #FEF08A;
      letter-spacing: 0.05em;
    }

    /* Master Page Container (Exact app.blade.php match) */
    .master-site-container {
      width: 100%;
      max-width: 1480px;
      margin: 0 auto;
      padding: 24px 32px 64px 32px;
      display: flex;
      flex-direction: column;
      gap: 36px;
      box-sizing: border-box;
    }

    /* Hero Card Container (Exact app.blade.php match) */
    .hero-container {
      width: 100%;
      min-height: 720px;
      position: relative;
      border-radius: 40px;
      margin: 0 auto;
      filter: drop-shadow(0 20px 35px rgba(15, 23, 42, 0.08));
      transition: var(--transition-base);
    }

    .hero-photo-layer {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      clip-path: url(#heroNormClip);
      -webkit-clip-path: url(#heroNormClip);
      overflow: hidden;
      z-index: 1;
      pointer-events: none;
    }

    .hero-photo-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center center;
      display: block;
    }

    .hero-photo-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(100deg, rgba(10, 15, 29, 0.88) 0%, rgba(15, 23, 42, 0.80) 45%, rgba(15, 23, 42, 0.65) 80%, rgba(10, 15, 29, 0.75) 100%);
      pointer-events: none;
    }

    .hero-svg-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
      pointer-events: none;
      overflow: visible;
    }

    .hero-inner-wrapper {
      position: relative;
      z-index: 3;
      width: 100%;
      height: 100%;
      min-height: 720px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 40px 48px 90px 48px;
      box-sizing: border-box;
    }

    /* Navbar (Exact app.blade.php match) */
    .hero-navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      position: relative;
      z-index: 20;
    }

    .brand-group {
      display: flex;
      align-items: center;
      gap: 16px;
      text-decoration: none;
      transition: var(--transition-base);
    }

    .brand-group:hover {
      transform: translateY(-1px);
    }

    .brand-logo-wrap {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.14);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border: 1px solid rgba(255, 255, 255, 0.28);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      padding: 7px;
    }

    .brand-logo-img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .brand-text-block {
      display: flex;
      flex-direction: column;
    }

    .brand-company-title {
      font-size: 19px;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: -0.01em;
      line-height: 1.15;
    }

    .brand-company-tag {
      font-size: 11px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.75);
      letter-spacing: 0.16em;
      text-transform: uppercase;
      margin-top: 2px;
    }

    .nav-container {
      display: flex;
      align-items: center;
      gap: 28px;
    }

    .nav-menu {
      display: flex;
      align-items: center;
      gap: 24px;
      list-style: none;
    }

    .nav-item a {
      font-size: 14.5px;
      font-weight: 500;
      color: rgba(255, 255, 255, 0.85);
      text-decoration: none;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      position: relative;
      padding: 6px 0;
      transition: var(--transition-base);
    }

    .nav-item a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #FFFFFF;
      transition: width 0.25s ease;
      border-radius: 2px;
    }

    .nav-item a:hover {
      color: #FFFFFF;
    }

    .nav-item a:hover::after,
    .nav-item.active a::after {
      width: 100%;
    }

    .nav-item.active a {
      font-weight: 700;
      color: #FFFFFF;
    }

    /* Hero Two-Column Grid */
    .hero-main-grid {
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      align-items: center;
      gap: 48px;
      padding-top: 16px;
      padding-bottom: 24px;
      flex: 1;
    }

    .hero-left-column {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 12.5px;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #FFFFFF;
      background: rgba(255, 255, 255, 0.14);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      padding: 6px 14px;
      border-radius: 999px;
      width: fit-content;
      border: 1px solid rgba(255, 255, 255, 0.25);
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
    }

    .hero-headline {
      font-size: clamp(2.4rem, 3.8vw, 3.85rem);
      font-weight: 800;
      line-height: 1.1;
      letter-spacing: -0.025em;
      color: #FFFFFF;
    }

    .hero-headline .text-gradient-accent {
      background: linear-gradient(135deg, #FFFFFF 0%, #FECDD3 50%, #FDA4AF 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-subheadline {
      font-size: clamp(1.05rem, 1.3vw, 1.22rem);
      font-weight: 300;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.92);
      max-width: 580px;
    }

    .hero-trust-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 4px;
    }

    .hero-trust-item {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-size: 12px;
      font-weight: 600;
      color: #FFFFFF;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 5px 12px;
      border-radius: 999px;
      backdrop-filter: blur(8px);
    }

    .hero-cta-group {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-top: 8px;
      flex-wrap: wrap;
    }

    /* Consistent ATS CTA Buttons */
    .btn-cta-white {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: #FFFFFF;
      color: #0F172A;
      font-size: 14.5px;
      font-weight: 700;
      letter-spacing: 0.02em;
      padding: 14px 26px;
      border-radius: 16px;
      text-decoration: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18);
      border: 1px solid rgba(255, 255, 255, 0.8);
      transition: var(--transition-base);
      cursor: pointer;
    }

    .btn-cta-white:hover {
      background: #F8FAFC;
      transform: translateY(-2px);
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.24);
      color: #E11D48;
    }

    .btn-cta-dark {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: rgba(15, 23, 42, 0.85);
      backdrop-filter: blur(12px);
      color: #FFFFFF;
      font-size: 14.5px;
      font-weight: 600;
      letter-spacing: 0.02em;
      padding: 14px 24px;
      border-radius: 16px;
      text-decoration: none;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: var(--transition-base);
      cursor: pointer;
    }

    .btn-cta-dark:hover {
      background: #0F172A;
      transform: translateY(-2px);
      border-color: rgba(255, 255, 255, 0.4);
    }

    /* Right Column: Sleek Promo RFQ Form Card */
    .hero-rfq-card {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 28px;
      padding: 28px 30px;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.26);
      border: 1px solid rgba(255, 255, 255, 0.85);
      position: relative;
      z-index: 10;
    }

    .rfq-header-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #BE123C;
      background: #FFE4E6;
      border: 1px solid #FECDD3;
      padding: 4px 10px;
      border-radius: 999px;
      margin-bottom: 8px;
    }

    .rfq-title {
      font-size: 21px;
      font-weight: 800;
      color: #0F172A;
      line-height: 1.2;
      margin-bottom: 4px;
    }

    .rfq-desc {
      font-size: 12.5px;
      color: #64748B;
      margin-bottom: 16px;
      line-height: 1.45;
    }

    .rfq-form-group {
      margin-bottom: 11px;
    }

    .rfq-label {
      display: block;
      font-size: 11.5px;
      font-weight: 700;
      color: #334155;
      margin-bottom: 4px;
    }

    .rfq-input, .rfq-select, .rfq-textarea {
      width: 100%;
      padding: 9px 13px;
      border-radius: 12px;
      border: 1px solid #CBD5E1;
      background: #F8FAFC;
      color: #0F172A;
      font-family: var(--font-sans);
      font-size: 13px;
      outline: none;
      transition: var(--transition-base);
    }

    .rfq-input:focus, .rfq-select:focus, .rfq-textarea:focus {
      border-color: #E11D48;
      background: #FFFFFF;
      box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.12);
    }

    .btn-submit-rfq {
      width: 100%;
      padding: 13px 20px;
      border-radius: 14px;
      background: linear-gradient(135deg, #E11D48 0%, #BE123C 100%);
      color: #FFFFFF;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 0.02em;
      border: none;
      box-shadow: 0 8px 20px rgba(225, 29, 72, 0.35);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: var(--transition-base);
      margin-top: 14px;
    }

    .btn-submit-rfq:hover {
      background: linear-gradient(135deg, #BE123C 0%, #9F1239 100%);
      transform: translateY(-1px);
      box-shadow: 0 12px 24px rgba(225, 29, 72, 0.45);
    }

    /* Hero Bottom Notch Marquee (Exact app.blade.php match) */
    .hero-notch-marquee-wrapper {
      position: absolute;
      bottom: 8px;
      left: 47%;
      right: 20px;
      height: 64px;
      z-index: 10;
      display: flex;
      align-items: center;
      overflow: hidden;
      mask-image: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
      -webkit-mask-image: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
      pointer-events: auto;
    }

    .marquee-track {
      display: flex;
      align-items: center;
      gap: 16px;
      width: max-content;
      animation: marqueeWalk 34s linear infinite;
      will-change: transform;
    }

    .marquee-track:hover {
      animation-play-state: paused;
    }

    @keyframes marqueeWalk {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    .marquee-logo-card {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: 44px;
      padding: 5px 14px;
      background: rgba(255, 255, 255, 0.94);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 12px;
      border: 1px solid rgba(226, 232, 240, 0.95);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      flex-shrink: 0;
      cursor: pointer;
    }

    .marquee-logo-card:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
      border-color: #CBD5E1;
      background: #FFFFFF;
    }

    .marquee-logo-card img {
      height: 26px;
      max-width: 105px;
      width: auto;
      object-fit: contain;
      display: block;
    }

    /* Supporting Content Wrapper (Exact app.blade.php match) */
    .supporting-content-wrapper {
      display: flex;
      flex-direction: column;
      gap: 36px;
      width: 100%;
    }

    /* Section Title Styles */
    .section-header-center {
      text-align: center;
      max-width: 720px;
      margin: 0 auto 12px auto;
    }

    .section-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #BE123C;
      background: #FFF1F2;
      border: 1px solid #FFE4E6;
      padding: 5px 13px;
      border-radius: 9999px;
      margin-bottom: 10px;
    }

    .section-title {
      font-size: clamp(1.85rem, 2.5vw, 2.45rem);
      font-weight: 800;
      color: #0F172A;
      letter-spacing: -0.02em;
      line-height: 1.2;
    }

    .section-desc {
      font-size: 14px;
      color: #64748B;
      line-height: 1.6;
      margin-top: 8px;
    }

    /* 6 Promo Packages Cards Grid (Features Grid Style from app.blade.php) */
    .promo-packages-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      width: 100%;
    }

    .feature-card {
      background: #FFFFFF;
      border-radius: 24px;
      padding: 26px 24px;
      border: 1px solid #E2E8F0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
      display: flex;
      flex-direction: column;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-card);
      border-color: #CBD5E1;
    }

    .feature-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .feature-icon-box {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .icon-rose { background: #FFF1F2; color: #E11D48; }
    .icon-blue { background: #EFF6FF; color: #2563EB; }
    .icon-emerald { background: #ECFDF5; color: #059669; }
    .icon-violet { background: #F5F3FF; color: #7C3AED; }

    .feature-tag {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      padding: 4px 9px;
      border-radius: 9999px;
    }

    .tag-rose { background: #FFF1F2; color: #BE123C; border: 1px solid #FFE4E6; }
    .tag-blue { background: #EFF6FF; color: #1D4ED8; border: 1px solid #DBEAFE; }
    .tag-emerald { background: #ECFDF5; color: #047857; border: 1px solid #D1FAE5; }
    .tag-violet { background: #F5F3FF; color: #6D28D9; border: 1px solid #EDE9FE; }

    .feature-title {
      font-size: 17px;
      font-weight: 800;
      color: #0F172A;
      margin-bottom: 8px;
      line-height: 1.3;
    }

    .feature-desc {
      font-size: 13px;
      color: #64748B;
      line-height: 1.55;
      margin-bottom: 18px;
      flex-grow: 1;
    }

    .feature-card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 14px;
      border-top: 1px dashed #E2E8F0;
      font-size: 12.5px;
      font-weight: 700;
      color: #E11D48;
      text-decoration: none;
      margin-top: auto;
      transition: color 0.2s ease;
    }

    .feature-card:hover .feature-card-footer {
      color: #BE123C;
    }

    .feature-arrow {
      transition: transform 0.2s ease;
    }

    .feature-card:hover .feature-arrow {
      transform: translateX(5px);
    }

    /* Fast-Quote Interactive Calculator Card */
    .quote-calc-card {
      background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
      color: #FFFFFF;
      border-radius: 32px;
      padding: 40px;
      box-shadow: 0 20px 50px rgba(15, 23, 42, 0.15);
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .calc-input-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .calc-label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      color: #CBD5E1;
      margin-bottom: 6px;
    }

    .calc-select {
      width: 100%;
      padding: 12px 16px;
      border-radius: 14px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #FFFFFF;
      font-family: var(--font-sans);
      font-size: 13.5px;
      outline: none;
      transition: var(--transition-base);
    }

    .calc-select option {
      background: #0F172A;
      color: #FFFFFF;
    }

    .calc-select:focus {
      border-color: #E11D48;
      background: rgba(255, 255, 255, 0.12);
    }

    .btn-calc-wa {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: #10B981;
      color: #FFFFFF;
      font-size: 15px;
      font-weight: 700;
      padding: 14px 28px;
      border-radius: 16px;
      border: none;
      box-shadow: 0 10px 24px rgba(16, 185, 129, 0.35);
      cursor: pointer;
      transition: var(--transition-base);
      margin: 0 auto;
    }

    .btn-calc-wa:hover {
      background: #059669;
      transform: translateY(-2px);
      box-shadow: 0 14px 30px rgba(16, 185, 129, 0.45);
    }

    /* FAQ Accordion */
    .faq-wrapper {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 12px;
      width: 100%;
    }

    .faq-item {
      background: #FFFFFF;
      border-radius: 18px;
      border: 1px solid #E2E8F0;
      overflow: hidden;
      transition: var(--transition-base);
    }

    .faq-item:hover {
      border-color: #CBD5E1;
    }

    .faq-btn {
      width: 100%;
      padding: 18px 22px;
      text-align: left;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      background: none;
      border: none;
      font-family: var(--font-outfit);
      font-size: 15.5px;
      font-weight: 700;
      color: #0F172A;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .faq-btn:hover {
      color: #E11D48;
    }

    .faq-body {
      display: none;
      padding: 0 22px 18px 22px;
      font-size: 13.5px;
      color: #475569;
      line-height: 1.6;
    }

    .faq-item.active .faq-body {
      display: block;
    }

    .faq-item.active .faq-icon {
      transform: rotate(180deg);
      color: #E11D48;
    }

    /* Mobile Drawer Styles (Exact app.blade.php match) */
    .mobile-drawer-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(10, 15, 29, 0.65);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      z-index: 9998;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }

    .mobile-drawer-backdrop.active {
      opacity: 1;
      pointer-events: auto;
    }

    .mobile-nav-drawer {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      width: 320px;
      max-width: 86vw;
      height: 100vh;
      background: #0F172A;
      color: #FFFFFF;
      z-index: 9999;
      display: flex;
      flex-direction: column;
      box-shadow: -10px 0 35px rgba(0, 0, 0, 0.5);
      border-left: 1px solid rgba(255, 255, 255, 0.1);
      transform: translateX(100%);
      transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
      overflow-y: auto;
    }

    .mobile-nav-drawer.open {
      transform: translateX(0);
    }

    .drawer-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 22px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .drawer-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .drawer-close-btn {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .drawer-close-btn:hover {
      background: #E11D48;
      border-color: #E11D48;
      transform: rotate(90deg);
    }

    .drawer-nav {
      padding: 18px 16px;
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex: 1;
    }

    .drawer-link {
      padding: 13px 16px;
      border-radius: 12px;
      color: #E2E8F0;
      font-size: 14.5px;
      font-weight: 600;
      text-decoration: none;
      letter-spacing: 0.03em;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.2s ease;
    }

    .drawer-link:hover {
      background: rgba(255, 255, 255, 0.08);
      color: #FFFFFF;
      transform: translateX(4px);
    }

    .drawer-link.active {
      background: rgba(225, 29, 72, 0.18);
      color: #FDA4AF;
      border-left: 3px solid #E11D48;
      font-weight: 700;
    }

    .drawer-arrow {
      font-size: 14px;
      color: #64748B;
      transition: transform 0.2s ease, color 0.2s ease;
    }

    .drawer-footer {
      padding: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      background: #0B1120;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .drawer-action-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .drawer-btn-primary {
      padding: 12px;
      border-radius: 10px;
      background: #E11D48;
      color: #FFFFFF;
      font-weight: 700;
      font-size: 13.5px;
      border: none;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s ease;
    }

    .drawer-btn-primary:hover {
      background: #BE123C;
    }

    .drawer-btn-whatsapp {
      padding: 11px;
      border-radius: 10px;
      background: #059669;
      color: #FFFFFF;
      font-weight: 700;
      font-size: 13px;
      text-decoration: none;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: background 0.2s ease;
    }

    .drawer-btn-whatsapp:hover {
      background: #047857;
    }

    .drawer-contact-info {
      font-size: 11.5px;
      color: #94A3B8;
      line-height: 1.6;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    /* Mobile Sticky Bottom Bar (High Conversion SEM) */
    .mobile-sticky-bar {
      display: none;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 9999;
      background: rgba(15, 23, 42, 0.96);
      backdrop-filter: blur(16px);
      padding: 12px 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.15);
      gap: 10px;
      box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.35);
    }

    .btn-mobile-call {
      flex: 1;
      padding: 12px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
      color: #FFFFFF;
      font-size: 12.5px;
      font-weight: 700;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .btn-mobile-wa {
      flex: 2;
      padding: 12px;
      border-radius: 12px;
      background: #10B981;
      color: #FFFFFF;
      font-size: 13px;
      font-weight: 800;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }

    /* Responsive Adaptations (Exact app.blade.php match) */
    @media (max-width: 1120px) {
      .hero-inner-wrapper {
        padding: 36px 36px 84px 36px;
      }
      .hero-main-grid {
        grid-template-columns: 1fr;
        gap: 36px;
      }
      .hero-notch-marquee-wrapper {
        left: 16px;
        right: 16px;
        bottom: 8px;
        height: 60px;
      }
      .promo-packages-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .calc-input-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 1024px) {
      .desktop-nav-only {
        display: none !important;
      }
      .mobile-nav-action-group {
        display: flex !important;
      }
      .mobile-sticky-bar {
        display: flex;
      }
    }

    @media (max-width: 768px) {
      .master-site-container {
        padding: 16px 16px 80px 16px;
      }
      .hero-inner-wrapper {
        padding: 24px 18px 74px 18px;
      }
      .hero-headline {
        font-size: clamp(1.85rem, 5vw, 2.35rem);
      }
      .hero-notch-marquee-wrapper {
        left: 10px;
        right: 10px;
        bottom: 6px;
        height: 52px;
      }
      .marquee-logo-card {
        height: 38px;
        padding: 4px 10px;
      }
      .marquee-logo-card img {
        height: 22px;
      }
      .promo-packages-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <!-- Google Ads Conversion Hook -->
  <script>
    window.dataLayer = window.dataLayer || [];
    function trackConversionEvent(eventName, eventDetails) {
      if (typeof window.dataLayer !== 'undefined') {
        window.dataLayer.push({
          'event': eventName,
          'event_details': eventDetails,
          'timestamp': new Date().toISOString()
        });
      }
      if (typeof gtag === 'function') {
        gtag('event', eventName, eventDetails);
      }
      console.log('Google Ads Conversion Hook:', eventName, eventDetails);
    }
  </script>
</head>

<body>

  <!-- ================= TOP URGENCY ANNOUNCEMENT BAR ================= -->
  <div class="promo-top-bar">
    <div class="promo-top-inner">
      <div style="display: flex; align-items: center;">
        <span class="promo-pulse-dot"></span>
        <span>PROMO EKSKLUSIF PROYEK SCHNEIDER SURABAYA: Diskon s/d 45%* + Tambahan Diskon Volume &amp; Free Ongkir Surabaya/Sidoarjo</span>
      </div>
      <div style="display: flex; align-items: center; gap: 8px;">
        <span>Batas Promo Hari Ini:</span>
        <span id="promoCountdown" class="promo-countdown-pill">-- : -- : --</span>
      </div>
    </div>
  </div>

  <!-- ================= MASTER SITE CONTAINER ================= -->
  <div class="master-site-container">

    <!-- ================= HERO CONTAINER (SIGNATURE ATS NOTCH) ================= -->
    <main class="hero-container" id="heroCardContainer">

      <!-- Native Unstretched Photo Background Layer (Clipped by SVG Notch) -->
      <div class="hero-photo-layer">
        <img class="hero-photo-img" src="{{ asset('images/hero-bg.png') }}"
          alt="Distributor Resmi Schneider Electric Surabaya - PT. Anugerah Tama Sejati" loading="eager">
        <div class="hero-photo-overlay"></div>
      </div>

      <!-- Responsive SVG Background Shape (Exact Notch Geometry from app.blade.php) -->
      <svg class="hero-svg-bg" id="heroSvgBg" viewBox="0 0 1137 650" fill="none" xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="none">
        <defs>
          <clipPath id="heroNormClip" clipPathUnits="objectBoundingBox">
            <path id="heroClipPath" d="M 0.08525 0.99641 
                     C 0.08525 0.99641 0.32525 0.99756 0.34450 0.99641 
                     C 0.36376 0.99526 0.37927 0.96508 0.37927 0.96508 
                     L 0.43539 0.87891 
                     C 0.43539 0.87891 0.44567 0.86464 0.46916 0.86403 
                     C 0.49266 0.86341 0.82688 0.86403 0.91615 0.86403 
                     C 1.00541 0.86403 0.99810 0.71334 0.99810 0.71334 
                     L 0.99810 0.12925 
                     C 0.99810 0.12925 0.99727 0 0.91615 0 
                     C 0.83503 0 0.14717 0 0.07532 0 
                     C 0.00347 0 0.00182 0.12925 0.00182 0.12925 
                     C 0.00182 0.12925 -0.00227 0.72184 0.00182 0.86403 
                     C 0.00590 1.00622 0.08525 0.99641 0.08525 0.99641 Z" />
          </clipPath>

          <linearGradient id="atsGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#D71840" stop-opacity="0.84" />
            <stop offset="50%" stop-color="#E11D48" stop-opacity="0.78" />
            <stop offset="100%" stop-color="#BE123C" stop-opacity="0.86" />
          </linearGradient>

          <linearGradient id="atsBorderGrad" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="rgba(255,255,255,0.22)" />
            <stop offset="100%" stop-color="rgba(255,255,255,0.06)" />
          </linearGradient>
        </defs>

        <path id="heroBorderPath" d="M 96.934 647.668 
                 C 96.934 647.668 369.806 648.415 391.702 647.668 
                 C 413.599 646.922 431.231 627.301 431.231 627.301 
                 L 495.041 571.292 
                 C 495.041 571.292 506.724 562.019 533.44 561.618 
                 C 560.155 561.217 940.166 561.618 1041.661 561.618 
                 C 1143.156 561.618 1134.835 463.672 1134.835 463.672 
                 L 1134.835 84.014 
                 C 1134.835 84.014 1133.892 0 1041.661 0  
                 C 949.43 0 167.329 0 85.64 0  
                 C 3.951 0 2.066 84.014 2.066 84.014 
                 C 2.066 84.014 -2.582 469.193 2.066 561.618 
                 C 6.714 654.043 96.934 647.668 96.934 647.668 Z" fill="none"
          stroke="url(#atsBorderGrad)" stroke-width="1.5" />
      </svg>

      <!-- Foreground Content Wrapper -->
      <div class="hero-inner-wrapper">

        <!-- ================= TOP NAVIGATION (EXACT APP.BLADE.PHP MATCH) ================= -->
        <header class="hero-navbar">
          <!-- Logo + Brand Identification -->
          <a href="{{ route('home') }}" class="brand-group">
            <div class="brand-logo-wrap">
              <img class="brand-logo-img"
                src="{{ asset('images/ats-logo.png') }}"
                onerror="this.src='{{ asset('favicon.ico') }}'"
                alt="PT. Anugerah Tama Sejati Logo">
            </div>
            <div class="brand-text-block">
              <span class="brand-company-title">PT. ANUGERAH TAMA SEJATI</span>
              <span class="brand-company-tag">ELECTRICAL SUPPLIER</span>
            </div>
          </a>

          <!-- Desktop Navigation Items -->
          <nav class="nav-container desktop-nav-only">
            <ul class="nav-menu">
              <li class="nav-item"><a href="{{ route('home') }}">HOME</a></li>
              <li class="nav-item"><a href="{{ route('about.index') }}">ABOUT US</a></li>
              <li class="nav-item"><a href="{{ route('price-list.index') }}">PRICE LIST</a></li>
              <li class="nav-item active"><a href="{{ route('promo.index') }}" style="color: #FECDD3;">PROMO</a></li>
              <li class="nav-item"><a href="{{ route('articles.index') }}">ARTICLE</a></li>
              <li class="nav-item"><a href="{{ route('contact.index') }}">CONTACT US</a></li>
            </ul>

            <!-- Global Multilingual Language Switcher -->
            @include('components.language-switcher')
          </nav>

          <!-- Mobile / Tablet Right Action Group -->
          <div class="mobile-nav-action-group" style="display: none; align-items: center; gap: 12px;">
            @include('components.language-switcher')
            <button type="button" class="mobile-hamburger-btn" id="btnMobileNavOpen" onclick="openMobileNav()" aria-label="Open Navigation Menu"
                    style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255, 255, 255, 0.14); border: 1px solid rgba(255, 255, 255, 0.25); color: #FFF; display: flex; align-items: center; justify-content: center; cursor: pointer;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
              </svg>
            </button>
          </div>
        </header>

        <!-- ================= HERO MAIN CONTENT GRID ================= -->
        <section class="hero-main-grid">

          <!-- Left Text Column -->
          <div class="hero-left-column">
            
            <div class="hero-eyebrow">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FF7676" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
              </svg>
              <span>Promo Resmi Distributor Schneider Surabaya</span>
            </div>

            <h1 class="hero-headline">
              Diskon Proyek Terbesar<br>
              <span class="text-gradient-accent">Schneider Electric</span> Surabaya
            </h1>

            <p class="hero-subheadline">
              Supplier resmi komponen elektrikal industri &amp; panel builder di Surabaya &amp; Jawa Timur. Ready stock ribuan item MCB, MCCB, ACB MasterPact, Kontaktor TeSys, dan Inverter Altivar. 100% original bergaransi pabrik &amp; siap Faktur Pajak PPN 11%.
            </p>

            <!-- Trust Badges List -->
            <div class="hero-trust-pills">
              <div class="hero-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4ADE80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Ready Stock Gudang Surabaya</span>
              </div>
              <div class="hero-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4ADE80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Garansi Resmi Pabrik + COO</span>
              </div>
              <div class="hero-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4ADE80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Faktur Pajak PPN 11% Resmi</span>
              </div>
              <div class="hero-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4ADE80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Free Ongkir Area Surabaya*</span>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="hero-cta-group">
              <a href="https://api.whatsapp.com/send?phone={{ $cleanWa }}&text={{ rawurlencode('Halo Sales ATS Tekno, saya melihat Promo Google Ads dan ingin minta penawaran diskon proyek Schneider Electric. Berikut rincian kebutuhan saya:') }}" 
                 target="_blank" 
                 rel="noopener noreferrer"
                 onclick="trackConversionEvent('ads_whatsapp_click', { location: 'hero_primary_btn' })"
                 class="btn-cta-white" 
                 id="btnHeroWhatsApp">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#059669">
                  <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.532-1.854-.772-3.037-2.656-3.13-2.78-.093-.125-.75-1.002-.75-1.913 0-.911.477-1.358.646-1.543.17-.185.372-.232.496-.232.124 0 .248.001.356.006.113.006.264-.043.413.316.155.373.53 1.292.576 1.385.046.094.077.202.015.326-.061.124-.093.202-.186.311-.093.11-.195.244-.279.328-.093.093-.19.195-.082.38.109.185.483.796 1.036 1.288.712.634 1.312.83 1.498.923.186.093.295.077.404-.047.108-.124.465-.543.589-.73.124-.185.248-.155.418-.093.17.062 1.085.511 1.271.604.186.093.31.14.356.217.046.077.046.45-.098.855z"/>
                </svg>
                <span>Klaim Promo via WhatsApp</span>
              </a>

              <a href="#quote-form" class="btn-cta-dark" id="btnHeroScrollQuote">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <span>Minta Penawaran BoQ</span>
              </a>
            </div>

          </div>

          <!-- Right Column: Conversion Lead Form Card -->
          <div class="hero-showcase-column" id="quote-form">
            <div class="hero-rfq-card">
              
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                <span class="rfq-header-badge">
                  <span class="promo-pulse-dot" style="margin-right: 2px;"></span>
                  Formulir Cepat 30 Detik
                </span>
                <span style="font-size: 11px; color: #64748B; font-weight: 600;">Respon &lt; 15 Menit</span>
              </div>

              <h2 class="rfq-title">Minta Penawaran Diskon Proyek</h2>
              <p class="rfq-desc">
                Dapatkan surat penawaran harga (SPH) resmi dengan diskon volume langsung dari Sales Engineer kami.
              </p>

              @if(session('success'))
              <div style="background: #ECFDF5; border: 1px solid #A7F3D0; border-radius: 12px; padding: 12px 14px; margin-bottom: 14px; color: #065F46; font-size: 12.5px;">
                <div style="font-weight: 700; margin-bottom: 2px;">✓ Permintaan Berhasil Terkirim!</div>
                <div>{{ session('success') }}</div>
                @if(session('whatsapp_redirect_url'))
                <div style="margin-top: 8px;">
                  <a href="{{ session('whatsapp_redirect_url') }}" target="_blank" style="display: inline-block; background: #059669; color: #FFF; padding: 6px 12px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 11.5px;">
                    Lanjut Buka WhatsApp &rarr;
                  </a>
                </div>
                @endif
              </div>
              @endif

              <form action="{{ route('promo.inquiry') }}" method="POST" id="promoLeadForm">
                @csrf
                <input type="text" name="website_hp" style="display:none !important;" tabindex="-1" autocomplete="off">
                <input type="hidden" name="utm_source" id="utm_source" value="">
                <input type="hidden" name="utm_medium" id="utm_medium" value="">
                <input type="hidden" name="utm_campaign" id="utm_campaign" value="">
                <input type="hidden" name="utm_term" id="utm_term" value="">
                <input type="hidden" name="gclid" id="gclid" value="">

                <div class="rfq-form-group">
                  <label class="rfq-label">Nama Lengkap / PIC <span style="color: #E11D48;">*</span></label>
                  <input type="text" name="name" required placeholder="Contoh: Bpk. Hendra Pratama" class="rfq-input">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;" class="rfq-form-group">
                  <div>
                    <label class="rfq-label">No. WhatsApp / HP <span style="color: #E11D48;">*</span></label>
                    <input type="tel" name="phone" required placeholder="08123456789" class="rfq-input">
                  </div>
                  <div>
                    <label class="rfq-label">Perusahaan / Instansi</label>
                    <input type="text" name="company" placeholder="PT. / CV. / Kontraktor" class="rfq-input">
                  </div>
                </div>

                <div class="rfq-form-group">
                  <label class="rfq-label">Kategori Komponen yang Dibutuhkan</label>
                  <select name="category" class="rfq-select">
                    <option value="MCB & Kontaktor TeSys (Schneider)">MCB &amp; Kontaktor TeSys (Schneider)</option>
                    <option value="MCCB Compact NSX / EasyPact (Schneider)">MCCB Compact NSX / EasyPact (Schneider)</option>
                    <option value="Inverter Altivar ATV310 / ATV630">Inverter Altivar ATV310 / ATV630</option>
                    <option value="ACB MasterPact MTZ / NW">ACB MasterPact MTZ / NW</option>
                    <option value="Fabrikasi Panel Listrik (LVMDP / MCC / Cap Bank)">Fabrikasi Panel Listrik (LVMDP / MCC)</option>
                    <option value="Multi-Brand (Legrand / Socomec / Autonics / Himel)">Multi-Brand (Legrand / Socomec / Himel)</option>
                    <option value="Lainnya / Kirim Seluruh BoQ">Lainnya / Kirim Seluruh BoQ</option>
                  </select>
                </div>

                <div class="rfq-form-group">
                  <label class="rfq-label">Catatan Kebutuhan / Tipe / Estimasi Jumlah</label>
                  <textarea name="notes" rows="2" placeholder="Contoh: Butuh MCB 3P 20A 100 pcs untuk proyek di Surabaya." class="rfq-textarea"></textarea>
                </div>

                <button type="submit" class="btn-submit-rfq">
                  <span>Kirim Permintaan Diskon Proyek</span>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
              </form>

            </div>
          </div>

        </section>

      </div>

      <!-- Dynamic Walking Brand Logos in Hero Notch (Marquee Ticker - Exact app.blade.php match) -->
      <div class="hero-notch-marquee-wrapper" id="notchMarquee" title="Authorized Brands &amp; Official Partners - PT. Anugerah Tama Sejati">
        <div class="marquee-track">
          <!-- Set 1 (Official Brand Logos) -->
          <div class="marquee-logo-card"><img src="{{ asset('logos/1.png') }}" alt="Schneider Electric Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/2.png') }}" alt="GAE Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/vinsa.png') }}" alt="VINSA France" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Legrand.webp') }}" alt="Legrand" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Socomec.png') }}" alt="Socomec" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Autonics.webp') }}" alt="Autonics" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Himel.webp') }}" alt="Himel" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Panasonic.png') }}" alt="Panasonic" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Philips.webp') }}" alt="Philips" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Fluke.webp') }}" alt="Fluke" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Boss.webp') }}" alt="Boss" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Jembo.webp') }}" alt="Jembo Cable" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/supremexxx.webp') }}" alt="Supreme Cable" loading="lazy"></div>

          <!-- Set 2 (Seamless Duplicate for Infinite Loop) -->
          <div class="marquee-logo-card"><img src="{{ asset('logos/1.png') }}" alt="Schneider Electric Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/2.png') }}" alt="GAE Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/vinsa.png') }}" alt="VINSA France" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Legrand.webp') }}" alt="Legrand" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Socomec.png') }}" alt="Socomec" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Autonics.webp') }}" alt="Autonics" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Himel.webp') }}" alt="Himel" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Panasonic.png') }}" alt="Panasonic" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Philips.webp') }}" alt="Philips" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Fluke.webp') }}" alt="Fluke" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Boss.webp') }}" alt="Boss" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/Jembo.webp') }}" alt="Jembo Cable" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="{{ asset('logos/supremexxx.webp') }}" alt="Supreme Cable" loading="lazy"></div>
        </div>
      </div>
    </main>

    <!-- ================= SUPPORTING SECTIONS (EXACT APP.BLADE.PHP MATCH) ================= -->
    <div class="supporting-content-wrapper">

      <!-- ================= CLIENTS & CUSTOMERS CAROUSEL ================= -->
      @include('components.customer-carousel')

      <!-- ================= CURVED WALKING TEXT RIBBON ================= -->
      @include('components.curved-walking-text')

      <!-- ================= 6 PROMO PACKAGES SECTION ================= -->
      <section style="width: 100%; margin-top: 10px;">
        <div class="section-header-center">
          <div class="section-tag">Paket Diskon Proyek Terpilih</div>
          <h2 class="section-title">Kategori Promo Spesial Pengadaan</h2>
          <p class="section-desc">Pilihan diskon volume untuk kontraktor ME, panel builder, instalatir, dan pabrik industri.</p>
        </div>

        <div class="promo-packages-grid">
          @foreach($promoCategories as $cat)
            @php
              $cardClass = 'feature-card-rose';
              $iconClass = 'icon-rose';
              $tagClass = 'tag-rose';
              if ($cat['id'] === 'mccb') {
                $cardClass = 'feature-card-blue';
                $iconClass = 'icon-blue';
                $tagClass = 'tag-blue';
              } elseif ($cat['id'] === 'inverter') {
                $cardClass = 'feature-card-emerald';
                $iconClass = 'icon-emerald';
                $tagClass = 'tag-emerald';
              } elseif ($cat['id'] === 'acb-masterpact') {
                $cardClass = 'feature-card-violet';
                $iconClass = 'icon-violet';
                $tagClass = 'tag-violet';
              }
            @endphp
            <div class="feature-card {{ $cardClass }}">
              <div class="feature-card-header">
                <div class="feature-icon-box {{ $iconClass }}">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                  </svg>
                </div>
                <span class="feature-tag {{ $tagClass }}">{{ $cat['discount'] }}</span>
              </div>

              <h3 class="feature-title">{{ $cat['title'] }}</h3>
              <p class="feature-desc">{{ $cat['description'] }}</p>

              <div style="font-size: 11.5px; color: #475569; margin-bottom: 14px;">
                @foreach($cat['highlights'] as $hl)
                  <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                    <span style="color: #059669; font-weight: 700;">✓</span>
                    <span>{{ $hl }}</span>
                  </div>
                @endforeach
              </div>

              <a href="https://api.whatsapp.com/send?phone={{ $cleanWa }}&text={{ rawurlencode('Halo Sales ATS Tekno, saya tertarik dengan promo kategori ' . $cat['title'] . '. Mohon info diskon harga proyeknya.') }}"
                 target="_blank"
                 rel="noopener noreferrer"
                 onclick="trackConversionEvent('ads_whatsapp_click', { category: '{{ $cat['title'] }}' })"
                 class="feature-card-footer">
                <span>Klaim Diskon Kategori Ini</span>
                <span class="feature-arrow">&rarr;</span>
              </a>
            </div>
          @endforeach
        </div>
      </section>

      <!-- ================= OUR PRODUCT SECTION (FIGMA STYLE FROM HOME) ================= -->
      @include('components.our-products', ['bestSellerProducts' => $featuredProducts])

      <!-- ================= INTERACTIVE FAST-QUOTE TO WHATSAPP CALCULATOR ================= -->
      <section class="quote-calc-card">
        <div style="text-align: center; max-width: 680px; margin: 0 auto;">
          <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(225, 29, 72, 0.2); border: 1px solid rgba(225, 29, 72, 0.35); color: #FDA4AF; padding: 4px 12px; border-radius: 999px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; margin-bottom: 10px;">
            Fast-Quote WhatsApp Generator
          </div>
          <h2 style="font-size: clamp(1.65rem, 2.3vw, 2.25rem); font-weight: 800; color: #FFFFFF; line-height: 1.2;">
            Pilih Kebutuhan Anda &amp; Dapatkan Hitungan Diskon
          </h2>
          <p style="font-size: 13.5px; color: #94A3B8; margin-top: 6px;">
            Pilih jenis produk dan jumlah unit yang dibutuhkan. Sistem akan menyusun draft penawaran resmi langsung ke WhatsApp Sales Engineer kami.
          </p>
        </div>

        <div class="calc-input-grid">
          <div>
            <label class="calc-label">1. Pilih Lini Produk</label>
            <select id="calcProduct" class="calc-select">
              <option value="Schneider MCB Acti9 / Domae">Schneider MCB (Acti9 / Domae)</option>
              <option value="Schneider Kontaktor TeSys (Deca / D)">Schneider Kontaktor TeSys (Deca / D)</option>
              <option value="Schneider MCCB (Compact NSX / EasyPact)">Schneider MCCB (Compact NSX / EasyPact)</option>
              <option value="Schneider Inverter Altivar (ATV310 / ATV630)">Schneider Inverter Altivar (ATV310 / ATV630)</option>
              <option value="Schneider ACB MasterPact (MTZ / NW)">Schneider ACB MasterPact (MTZ / NW)</option>
              <option value="Perakitan Panel Maker (LVMDP / MCC / Cap Bank)">Perakitan Panel Maker (LVMDP / MCC)</option>
              <option value="Multi-Brand Komponen Elektrikal">Multi-Brand (Legrand / Socomec / Autonics)</option>
            </select>
          </div>

          <div>
            <label class="calc-label">2. Estimasi Jumlah Unit</label>
            <select id="calcQty" class="calc-select">
              <option value="Partai Kecil (1 - 10 Unit / Sampling)">Partai Kecil (1 - 10 Unit / Sampling)</option>
              <option value="Menengah (10 - 50 Unit / Panel Maker)">Menengah (10 - 50 Unit / Panel Maker)</option>
              <option value="Proyek Besar (> 50 Unit / BoQ Pabrik)">Proyek Besar (> 50 Unit / BoQ Pabrik)</option>
              <option value="Pengadaan Berkala Bulanan">Pengadaan Berkala Bulanan (Kontrak Suplai)</option>
            </select>
          </div>

          <div>
            <label class="calc-label">3. Lokasi Proyek / Pengiriman</label>
            <select id="calcLoc" class="calc-select">
              <option value="Surabaya / Sidoarjo / Gresik (Free Ongkir*)">Surabaya / Sidoarjo / Gresik (Free Ongkir*)</option>
              <option value="Jawa Timur (Pasuruan, Malang, Mojokerto, Tuban)">Jawa Timur (Pasuruan, Malang, Mojokerto, dll)</option>
              <option value="Jawa Tengah / Jawa Barat / DKI Jakarta">Jawa Tengah / Jawa Barat / DKI Jakarta</option>
              <option value="Luar Pulau (Kalimantan, Sulawesi, Bali, Papua)">Luar Pulau (Ekspedisi Darat/Laut)</option>
            </select>
          </div>
        </div>

        <button type="button" id="btnCalcWa" class="btn-calc-wa">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.532-1.854-.772-3.037-2.656-3.13-2.78-.093-.125-.75-1.002-.75-1.913 0-.911.477-1.358.646-1.543.17-.185.372-.232.496-.232.124 0 .248.001.356.006.113.006.264-.043.413.316.155.373.53 1.292.576 1.385.046.094.077.202.015.326-.061.124-.093.202-.186.311-.093.11-.195.244-.279.328-.093.093-.19.195-.082.38.109.185.483.796 1.036 1.288.712.634 1.312.83 1.498.923.186.093.295.077.404-.047.108-.124.465-.543.589-.73.124-.185.248-.155.418-.093.17.062 1.085.511 1.271.604.186.093.31.14.356.217.046.077.046.45-.098.855z"/>
          </svg>
          <span>Buka WhatsApp dengan Rincian Ini &rarr;</span>
        </button>
      </section>

      <!-- ================= 4-COLUMN FEATURE HIGHLIGHTS (EXACT APP.BLADE.PHP MATCH) ================= -->
      <section class="features-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
        <div class="feature-card feature-card-rose">
          <div class="feature-card-header">
            <div class="feature-icon-box icon-rose">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="m9 12 2 2 4-4"></path>
              </svg>
            </div>
            <span class="feature-tag tag-rose">Authentic Direct</span>
          </div>
          <h3 class="feature-title">100% Produk Original</h3>
          <p class="feature-desc">Seluruh komponen bergaransi resmi pabrik Schneider Electric dan partner global dengan sertifikat COO.</p>
          <div class="feature-card-footer">
            <span>Garansi &amp; COO Resmi</span>
            <span class="feature-arrow">&rarr;</span>
          </div>
        </div>

        <div class="feature-card feature-card-blue">
          <div class="feature-card-header">
            <div class="feature-icon-box icon-blue">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                <path d="M12 11v4"></path>
              </svg>
            </div>
            <span class="feature-tag tag-blue">Ready Stock</span>
          </div>
          <h3 class="feature-title">Gudang Fisik Surabaya</h3>
          <p class="feature-desc">Gudang utama di Surabaya siap kirim cepat ribuan SKU MCB, MCCB, ACB, dan kontaktor tanpa inden lama.</p>
          <div class="feature-card-footer">
            <span>Stok Fisik Surabaya</span>
            <span class="feature-arrow">&rarr;</span>
          </div>
        </div>

        <div class="feature-card feature-card-emerald">
          <div class="feature-card-header">
            <div class="feature-icon-box icon-emerald">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
              </svg>
            </div>
            <span class="feature-tag tag-emerald">Ekspedisi Aman</span>
          </div>
          <h3 class="feature-title">Logistik Seluruh Indonesia</h3>
          <p class="feature-desc">Pengiriman aman &amp; bergaransi ke proyek industri di Jawa, Kalimantan, Sulawesi, hingga Papua.</p>
          <div class="feature-card-footer">
            <span>Sabang - Merauke</span>
            <span class="feature-arrow">&rarr;</span>
          </div>
        </div>

        <div class="feature-card feature-card-violet">
          <div class="feature-card-header">
            <div class="feature-icon-box icon-violet">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
              </svg>
            </div>
            <span class="feature-tag tag-violet">Certified Engineer</span>
          </div>
          <h3 class="feature-title">Dukungan Sales Engineer</h3>
          <p class="feature-desc">Konsultasi BoQ, breaker sizing, dan verifikasi proteksi elektrikal langsung dengan tim teknis bersertifikat.</p>
          <div class="feature-card-footer">
            <span>Review BoQ Gratis</span>
            <span class="feature-arrow">&rarr;</span>
          </div>
        </div>
      </section>

      <!-- ================= FAQ SECTION (TANYA JAWAB PENGADAAN) ================= -->
      <section style="width: 100%; margin-top: 10px;">
        <div class="section-header-center">
          <div class="section-tag">Tanya Jawab Pengadaan</div>
          <h2 class="section-title">Pertanyaan Seputar Promo &amp; Transaksi</h2>
          <p class="section-desc">Jawaban atas pertanyaan seputar diskon, garansi produk, faktur pajak, dan pengiriman.</p>
        </div>

        <div class="faq-wrapper">
          <div class="faq-item active">
            <button type="button" class="faq-btn">
              <span>Apakah barang yang dijual 100% baru dan original?</span>
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.25s;"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="faq-body">
              Ya, 100% original, baru dalam kemasan segel pabrik, dan bergaransi resmi. Kami adalah distributor resmi rekanan pabrikan Schneider Electric, Legrand, GAE, dan Socomec. Untuk kebutuhan tender/proyek, kami siap melampirkan Certificate of Origin (COO) dan surat otorisasi distributor.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-btn">
              <span>Apakah bisa menerbitkan Faktur Pajak PPN 11%?</span>
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.25s;"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="faq-body">
              Pasti. PT. Anugerah Tama Sejati adalah badan usaha resmi berstatus Pengusaha Kena Pajak (PKP). Setiap transaksi B2B dapat diterbitkan Faktur Pajak e-Faktur resmi sesuai NPWP perusahaan Anda.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-btn">
              <span>Bagaimana ketentuan diskon promo hingga 45%?</span>
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.25s;"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="faq-body">
              Besaran diskon dihitung berdasarkan lini kategori produk, kuantiti pemesanan, dan jenis proyek (kontraktor / panel maker). Untuk produk fast-moving seperti MCB Acti9, TeSys Contactor, dan MCCB EasyPact, diskon proyek dapat mencapai 45% dari harga pricelist resmi pabrik.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-btn">
              <span>Apakah melayani pengiriman ke luar kota atau luar pulau Jawa?</span>
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.25s;"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="faq-body">
              Sangat sering. Kami rutin mendistribusikan komponen dan panel switchboard ke berbagai proyek industri di Kalimantan, Sulawesi, Sumatera, Bali, hingga Papua via ekspedisi laut maupun udara terpercaya dengan opsi peti kayu standar keselamatan.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-btn">
              <span>Di mana alamat kantor dan gudang resmi PT. Anugerah Tama Sejati?</span>
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.25s;"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="faq-body">
              Kantor &amp; gudang fisik kami beralamat di: <strong>Ruko Galaxi Bumi Permai J-1 No. 23, Sukolilo, Surabaya, Jawa Timur 60134</strong>. Anda dapat berkunjung langsung pada hari kerja (Senin - Jumat 08:30 - 17:00 WIB) untuk verifikasi barang atau konsultasi teknis bersama Sales Engineer.
            </div>
          </div>
        </div>
      </section>

    </div>

  </div>

  <!-- ================= FOOTER (EXACT MATCH WITH APP.BLADE.PHP) ================= -->
  @include('components.footer')

  <!-- Backdrop for Mobile Right Drawer -->
  <div class="mobile-drawer-backdrop" id="mobileNavBackdrop" onclick="closeMobileNav()"></div>

  <!-- Off-Canvas Mobile Navigation Drawer -->
  <aside class="mobile-nav-drawer" id="mobileNavDrawer" aria-label="Mobile Navigation">
    <div class="drawer-header">
      <div class="drawer-brand">
        <div class="brand-logo-wrap" style="width: 38px; height: 38px;">
          <img class="brand-logo-img"
            src="{{ asset('images/ats-logo.png') }}"
            alt="PT. Anugerah Tama Sejati Logo">
        </div>
        <div>
          <div style="font-size: 14px; font-weight: 800; color: #FFFFFF; font-family: 'Outfit', sans-serif;">PT. ANUGERAH TAMA SEJATI</div>
          <div style="font-size: 9.5px; color: #94A3B8; letter-spacing: 0.08em; text-transform: uppercase;">ELECTRICAL SUPPLIER</div>
        </div>
      </div>
      <button type="button" class="drawer-close-btn" onclick="closeMobileNav()" aria-label="Close Navigation Menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <nav class="drawer-nav">
      <a href="{{ route('home') }}" class="drawer-link" onclick="closeMobileNav()">
        <span>HOME</span>
        <span class="drawer-arrow">&rarr;</span>
      </a>
      <a href="{{ route('about.index') }}" class="drawer-link" onclick="closeMobileNav()">
        <span>ABOUT US</span>
        <span class="drawer-arrow">&rarr;</span>
      </a>
      <a href="{{ route('price-list.index') }}" class="drawer-link" onclick="closeMobileNav()">
        <span>PRICE LIST</span>
        <span class="drawer-arrow">&rarr;</span>
      </a>
      <a href="{{ route('promo.index') }}" class="drawer-link active" onclick="closeMobileNav()">
        <span>PROMO</span>
        <span class="drawer-arrow">&rarr;</span>
      </a>
      <a href="{{ route('articles.index') }}" class="drawer-link" onclick="closeMobileNav()">
        <span>ARTICLE</span>
        <span class="drawer-arrow">&rarr;</span>
      </a>
      <a href="{{ route('contact.index') }}" class="drawer-link" onclick="closeMobileNav()">
        <span>CONTACT US</span>
        <span class="drawer-arrow">&rarr;</span>
      </a>
    </nav>

    <div class="drawer-footer">
      <div class="drawer-action-buttons">
        <a href="{{ url('/contact-us') }}" class="drawer-btn-primary" onclick="closeMobileNav();">
          <span>Contact Us</span>
        </a>
        <a href="https://api.whatsapp.com/send?phone={{ $cleanWa }}&text={{ rawurlencode('Halo Sales ATS Tekno, saya tertarik dengan promo Schneider Electric.') }}" target="_blank" class="drawer-btn-whatsapp">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.532-1.854-.772-3.037-2.656-3.13-2.78-.093-.125-.75-1.002-.75-1.913 0-.911.477-1.358.646-1.543.17-.185.372-.232.496-.232.124 0 .248.001.356.006.113.006.264-.043.413.316.155.373.53 1.292.576 1.385.046.094.077.202.015.326-.061.124-.093.202-.186.311-.093.11-.195.244-.279.328-.093.093-.19.195-.082.38.109.185.483.796 1.036 1.288.712.634 1.312.83 1.498.923.186.093.295.077.404-.047.108-.124.465-.543.589-.73.124-.185.248-.155.418-.093.17.062 1.085.511 1.271.604.186.093.31.14.356.217.046.077.046.45-.098.855z"/></svg>
          <span>Chat WhatsApp</span>
        </a>
      </div>
      <div class="drawer-contact-info">
        <div><strong>PT. Anugerah Tama Sejati</strong></div>
        <div>Surabaya, Jawa Timur, Indonesia</div>
        <div>Senin - Jumat: 08:00 - 17:00 | Sabtu: 08:00 - 16:00 WIB</div>
      </div>
    </div>
  </aside>

  <!-- ================= FLOATING ACTION BUTTONS ================= -->
  @include('components.floating-listrikonline-btn')
  @include('components.floating-live-chat')

  <!-- ================= MOBILE STICKY BOTTOM BAR (HIGH CONVERSION SEM) ================= -->
  <div class="mobile-sticky-bar">
    <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings['phone'] ?? '03159178887') }}"
       onclick="trackConversionEvent('ads_call_click', { location: 'mobile_sticky' })"
       class="btn-mobile-call">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
      <span>Telepon</span>
    </a>

    <a href="https://api.whatsapp.com/send?phone={{ $cleanWa }}&text={{ rawurlencode('Halo Sales ATS Tekno, saya melihat Promo Google Ads dan ingin minta penawaran diskon proyek Schneider Electric.') }}"
       target="_blank"
       rel="noopener noreferrer"
       onclick="trackConversionEvent('ads_whatsapp_click', { location: 'mobile_sticky' })"
       class="btn-mobile-wa">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.532-1.854-.772-3.037-2.656-3.13-2.78-.093-.125-.75-1.002-.75-1.913 0-.911.477-1.358.646-1.543.17-.185.372-.232.496-.232.124 0 .248.001.356.006.113.006.264-.043.413.316.155.373.53 1.292.576 1.385.046.094.077.202.015.326-.061.124-.093.202-.186.311-.093.11-.195.244-.279.328-.093.093-.19.195-.082.38.109.185.483.796 1.036 1.288.712.634 1.312.83 1.498.923.186.093.295.077.404-.047.108-.124.465-.543.589-.73.124-.185.248-.155.418-.093.17.062 1.085.511 1.271.604.186.093.31.14.356.217.046.077.046.45-.098.855z"/>
      </svg>
      <span>Klaim Promo WhatsApp</span>
    </a>
  </div>

  <!-- ================= SCRIPTS ================= -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    // Mobile Drawer Navigation handlers (Slide in from the RIGHT - Exact app.blade.php match)
    function openMobileNav() {
      const drawer = document.getElementById('mobileNavDrawer');
      const backdrop = document.getElementById('mobileNavBackdrop');
      if (drawer && backdrop) {
        drawer.classList.add('open');
        backdrop.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeMobileNav() {
      const drawer = document.getElementById('mobileNavDrawer');
      const backdrop = document.getElementById('mobileNavBackdrop');
      if (drawer && backdrop) {
        drawer.classList.remove('open');
        backdrop.classList.remove('active');
        document.body.style.overflow = '';
      }
    }

    // Dynamic 1:1 Responsive Hero Notch & ClipPath Geometry (Exact app.blade.php match)
    (function() {
      const cardEl = document.getElementById('heroCardContainer');
      const svgEl = document.getElementById('heroSvgBg');
      const clipEl = document.getElementById('heroNormClip');
      const clipPathEl = document.getElementById('heroClipPath');
      const borderPathEl = document.getElementById('heroBorderPath');

      const originalDesktopNormPath = "M 0.08540 0.99949 C 0.08540 0.99949 0.32582 1.00064 0.34511 0.99949 C 0.36440 0.99834 0.37994 0.96806 0.37994 0.96806 L 0.43616 0.88162 C 0.43616 0.88162 0.44645 0.86731 0.46999 0.86669 C 0.49353 0.86608 0.82834 0.86669 0.91776 0.86669 C 1.00719 0.86669 0.99985 0.71554 0.99985 0.71554 L 0.99985 0.12965 C 0.99985 0.12965 0.99902 0.00000 0.91776 0.00000 C 0.83650 0.00000 0.14743 0.00000 0.07545 0.00000 C 0.00348 0.00000 0.00182 0.12965 0.00182 0.12965 C 0.00182 0.12965 -0.00227 0.72406 0.00182 0.86669 C 0.00592 1.00933 0.08540 0.99949 0.08540 0.99949 Z";
      const originalDesktopBorderPath = "M 96.934 647.668 C 96.934 647.668 369.806 648.415 391.702 647.668 C 413.599 646.922 431.231 627.301 431.231 627.301 L 495.041 571.292 C 495.041 571.292 506.724 562.019 533.44 561.618 C 560.155 561.217 940.166 561.618 1041.661 561.618 C 1143.156 561.618 1134.835 463.672 1134.835 463.672 L 1134.835 84.014 C 1134.835 84.014 1133.892 0 1041.661 0 C 949.43 0 167.329 0 85.64 0 C 3.951 0 2.066 84.014 2.066 84.014 C 2.066 84.014 -2.582 469.193 2.066 561.618 C 6.714 654.043 96.934 647.668 96.934 647.668 Z";

      function updateHeroGeometry() {
        if (!cardEl || !svgEl || !clipEl || !clipPathEl || !borderPathEl) return;
        const w = cardEl.clientWidth;
        const h = cardEl.clientHeight;
        if (w <= 0 || h <= 0) return;

        if (w >= 1120) {
          svgEl.setAttribute('viewBox', '0 0 1135 648');
          clipEl.setAttribute('clipPathUnits', 'objectBoundingBox');
          clipPathEl.setAttribute('d', originalDesktopNormPath);
          borderPathEl.setAttribute('d', originalDesktopBorderPath);
          return;
        }

        svgEl.setAttribute('viewBox', `0 0 ${w} ${h}`);
        clipEl.setAttribute('clipPathUnits', 'userSpaceOnUse');

        const cornerR = w >= 768 ? 32 : 24;
        const notchH = w >= 768 ? 70 : 62;
        const notchTopY = h - notchH;

        const pathD = `M ${cornerR} 0 ` +
          `H ${w - cornerR} ` +
          `C ${w - cornerR * 0.45} 0 ${w} ${cornerR * 0.45} ${w} ${cornerR} ` +
          `V ${notchTopY - cornerR} ` +
          `C ${w} ${notchTopY - cornerR * 0.45} ${w - cornerR * 0.45} ${notchTopY} ${w - cornerR} ${notchTopY} ` +
          `H ${cornerR} ` +
          `C ${cornerR * 0.45} ${notchTopY}, 0 ${notchTopY - cornerR * 0.45}, 0 ${notchTopY - cornerR} ` +
          `V ${cornerR} ` +
          `C 0 ${cornerR * 0.45}, ${cornerR * 0.45} 0, ${cornerR} 0 Z`;

        clipPathEl.setAttribute('d', pathD);
        borderPathEl.setAttribute('d', pathD);
      }

      updateHeroGeometry();
      window.addEventListener('resize', updateHeroGeometry);
    })();

    document.addEventListener('DOMContentLoaded', function () {
      
      // 1. Capture UTM & GCLID Parameters
      const urlParams = new URLSearchParams(window.location.search);
      const utmSource = urlParams.get('utm_source') || 'google';
      const utmMedium = urlParams.get('utm_medium') || 'cpc';
      const utmCampaign = urlParams.get('utm_campaign') || 'promo_schneider_surabaya';
      const utmTerm = urlParams.get('utm_term') || '';
      const gclid = urlParams.get('gclid') || '';

      if (document.getElementById('utm_source')) document.getElementById('utm_source').value = utmSource;
      if (document.getElementById('utm_medium')) document.getElementById('utm_medium').value = utmMedium;
      if (document.getElementById('utm_campaign')) document.getElementById('utm_campaign').value = utmCampaign;
      if (document.getElementById('utm_term')) document.getElementById('utm_term').value = utmTerm;
      if (document.getElementById('gclid')) document.getElementById('gclid').value = gclid;

      // 2. Countdown Timer
      function updateCountdown() {
        const now = new Date();
        const target = new Date(now);
        target.setHours(23, 59, 59, 999);
        const diff = target - now;

        if (diff <= 0) {
          const el = document.getElementById('promoCountdown');
          if (el) el.innerText = '00 : 00 : 00';
          return;
        }

        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        const pad = (n) => String(n).padStart(2, '0');
        const el = document.getElementById('promoCountdown');
        if (el) {
          el.innerText = `${pad(hours)} : ${pad(minutes)} : ${pad(seconds)}`;
        }
      }
      setInterval(updateCountdown, 1000);
      updateCountdown();

      // 3. Fast-Quote to WhatsApp Calculator
      const calcBtn = document.getElementById('btnCalcWa');
      if (calcBtn) {
        calcBtn.addEventListener('click', function () {
          const product = document.getElementById('calcProduct').value;
          const qty = document.getElementById('calcQty').value;
          const loc = document.getElementById('calcLoc').value;

          const msg = `Halo Sales Engineer ATS Tekno, saya ingin minta penawaran diskon promo Google Ads:\n\n`
            + `📌 *Produk:* ${product}\n`
            + `📦 *Estimasi Kebutuhan:* ${qty}\n`
            + `📍 *Lokasi Proyek:* ${loc}\n\n`
            + `Mohon info harga diskon terbaik dan ketersediaan stoknya. Terima kasih!`;

          trackConversionEvent('ads_whatsapp_click', {
            type: 'quote_calculator',
            product: product,
            quantity: qty,
            location: loc
          });

          const cleanWa = '{{ $cleanWa }}';
          const url = `https://api.whatsapp.com/send?phone=${cleanWa}&text=${encodeURIComponent(msg)}`;
          window.open(url, '_blank');
        });
      }

      // 4. FAQ Accordion Toggle
      const faqItems = document.querySelectorAll('.faq-item');
      faqItems.forEach(item => {
        const btn = item.querySelector('.faq-btn');
        btn.addEventListener('click', function () {
          const isActive = item.classList.contains('active');
          faqItems.forEach(i => i.classList.remove('active'));
          if (!isActive) {
            item.classList.add('active');
          }
        });
      });

      // 5. Track Form Submit
      const form = document.getElementById('promoLeadForm');
      if (form) {
        form.addEventListener('submit', function () {
          trackConversionEvent('ads_rfq_submit', {
            source: utmSource,
            campaign: utmCampaign
          });
        });
      }

    });
  </script>
  <!-- Lenis Smooth Scroll & Framer Text Reveal On Scroll Engine (Resilient Dual-Path Delivery) -->
  <script src="{{ asset('js/ats-scroll-effects.js') }}?v={{ filemtime(public_path('js/ats-scroll-effects.js')) }}"
          onerror="if(!this.dataset.fallback){this.dataset.fallback='1';this.src='{{ url('/public/js/ats-scroll-effects.js') }}?v={{ filemtime(public_path('js/ats-scroll-effects.js')) }}';}">
  </script>
</body>
</html>
