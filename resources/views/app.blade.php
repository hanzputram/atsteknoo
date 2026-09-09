<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT. Anugerah Tama Sejati - Best Electrical Supplier</title>
  <meta name="description"
    content="PT. Anugerah Tama Sejati - Your trusted one-stop supplier for all electrical and wiring components. Authorized Schneider Electric Distributor Surabaya.">

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet">

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
      --color-bg-page: #F8FAFC;

      --shadow-card: 0 20px 40px -15px rgba(225, 29, 72, 0.12), 0 10px 25px -5px rgba(0, 0, 0, 0.05);
      --shadow-float: 0 16px 36px rgba(0, 0, 0, 0.1);

      --transition-base: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Page Root: Top-Anchored, Natural Website Canvas (Stable at any zoom level) */
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

    /* ========================================================
       MASTER PAGE CONTAINER (Maintains Structure at Any Zoom)
       ======================================================== */
    .master-site-container {
      width: 100%;
      max-width: 1480px;
      margin: 0 auto;
      padding: 36px 32px 64px 32px;
      display: flex;
      flex-direction: column;
      gap: 36px;
      box-sizing: border-box;
    }

    /* ========================================================
       HERO CARD CONTAINER
       ======================================================== */
    .hero-container {
      width: 100%;
      min-height: 660px;
      position: relative;
      border-radius: 40px;
      margin: 0 auto;
      filter: drop-shadow(0 20px 35px rgba(15, 23, 42, 0.08));
      transition: var(--transition-base);
    }

    /* Native Unstretched Photo Background Layer (Clipped by SVG Notch) */
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
      background: linear-gradient(100deg, rgba(10, 15, 29, 0.88) 0%, rgba(15, 23, 42, 0.78) 45%, rgba(15, 23, 42, 0.62) 80%, rgba(10, 15, 29, 0.72) 100%);
      pointer-events: none;
    }

    /* Responsive SVG Background Shape (Exact Notch Geometry from Framer) */
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

    /* Content Layout Over the SVG */
    .hero-inner-wrapper {
      position: relative;
      z-index: 3;
      width: 100%;
      min-height: 660px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 40px 60px 52px 60px;
    }

    /* ========================================================
       TOP NAVIGATION BAR (Clean, Non-Overlapping Desktop Layout)
       ======================================================== */
    .hero-navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    /* Brand Left */
    .brand-group {
      display: flex;
      align-items: center;
      gap: 16px;
      text-decoration: none;
      color: inherit;
    }

    .brand-logo-wrap {
      width: 54px;
      height: 54px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 12px;
      padding: 4px;
      border: 1px solid rgba(255, 255, 255, 0.22);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
      transition: var(--transition-base);
    }

    .brand-logo-wrap:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      border-color: rgba(255, 255, 255, 0.35);
    }

    .brand-logo-img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .brand-text-block {
      display: flex;
      flex-direction: column;
    }

    .brand-company-title {
      font-size: 20px;
      font-weight: 700;
      letter-spacing: -0.01em;
      color: #FFFFFF;
      line-height: 1.2;
    }

    .brand-company-tag {
      font-size: 13.5px;
      font-weight: 500;
      letter-spacing: 0.18em;
      color: rgba(255, 255, 255, 0.75);
      text-transform: uppercase;
      margin-top: 3px;
    }

    /* Nav Container with Links & Language Switcher */
    .nav-container {
      display: flex;
      align-items: center;
      gap: 28px;
    }

    /* Nav Links Right */
    .nav-menu {
      display: flex;
      align-items: center;
      gap: 32px;
      list-style: none;
    }

    .nav-item a {
      font-size: 15px;
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

    /* ========================================================
       HERO MAIN BODY (Two-Column Desktop Grid)
       ======================================================== */
    .hero-main-grid {
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      align-items: center;
      gap: 48px;
      padding-top: 16px;
      padding-bottom: 24px;
      flex: 1;
    }

    /* Left Hero Column */
    .hero-left-column {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #FFFFFF;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      padding: 6px 14px;
      border-radius: 999px;
      width: fit-content;
      border: 1px solid rgba(255, 255, 255, 0.22);
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
    }

    .hero-eyebrow svg {
      color: #FF7676;
    }

    /* Main Headline */
    .hero-headline {
      font-size: clamp(2.75rem, 4.2vw, 4.25rem);
      font-weight: 800;
      line-height: 1.08;
      letter-spacing: -0.025em;
      color: #FFFFFF;
    }

    .hero-headline .text-gradient-accent {
      background: linear-gradient(135deg, #FFFFFF 0%, #E2E8F0 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Subheadline Description */
    .hero-subheadline {
      font-size: clamp(1.15rem, 1.45vw, 1.35rem);
      font-weight: 300;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.88);
      max-width: 540px;
    }

    /* Hero Action CTA Group (Enlarged & Positioned into SVG Bottom Pocket) */
    .hero-cta-group {
      display: flex;
      align-items: center;
      gap: 18px;
      margin-top: 48px;
      flex-wrap: wrap;
    }

    /* Left Button: Crisp White Pill */
    .btn-cta-white,
    .btn-cta-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      background: #FFFFFF;
      color: #0F172A;
      font-family: var(--font-sans);
      font-size: 16.5px;
      font-weight: 700;
      padding: 16px 36px;
      border-radius: 999px;
      text-decoration: none;
      border: 1.5px solid rgba(255, 255, 255, 0.95);
      box-shadow: 0 10px 28px rgba(0, 0, 0, 0.18), 0 2px 6px rgba(0, 0, 0, 0.08);
      transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
      cursor: pointer;
    }

    .btn-cta-white:hover,
    .btn-cta-primary:hover {
      background: #F8FAFC;
      transform: translateY(-3px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.26);
      color: #000000;
    }

    .btn-cta-white svg,
    .btn-cta-primary svg {
      color: #0F172A;
      transition: transform 0.25s ease;
    }

    .btn-cta-white:hover svg,
    .btn-cta-primary:hover svg {
      transform: translateX(4px);
    }

    /* Right Button: Frosted Glass Dark Pill with Pure White Text */
    .btn-cta-dark,
    .btn-cta-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      background: rgba(255, 255, 255, 0.12);
      color: #FFFFFF;
      font-family: var(--font-sans);
      font-size: 16.5px;
      font-weight: 700;
      padding: 16px 34px;
      border-radius: 999px;
      text-decoration: none;
      border: 1.5px solid rgba(255, 255, 255, 0.28);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 10px 28px rgba(0, 0, 0, 0.22);
      transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
      cursor: pointer;
    }

    .btn-cta-dark:hover,
    .btn-cta-secondary:hover {
      background: rgba(255, 255, 255, 0.22);
      transform: translateY(-3px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
      border-color: rgba(255, 255, 255, 0.5);
    }

    .btn-cta-dark svg,
    .btn-cta-secondary svg {
      color: #FF7676;
      transition: transform 0.25s ease;
    }

    .btn-cta-dark:hover svg,
    .btn-cta-secondary:hover svg {
      transform: scale(1.12);
    }

    /* ========================================================
       RIGHT COLUMN: INTERACTIVE SWIPER CAROUSEL
       ======================================================== */
    .hero-showcase-column {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      margin: 0;
    }

    .card-carousel-container {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 14px;
    }

    /* Ukuran kontainer carousel utama */
    .mySwiper {
      width: 250px;
      height: 360px;
      padding: 10px 0;
      overflow: visible !important;
    }

    /* Base style untuk setiap kartu Swiper */
    .swiper-slide {
      border-radius: 0;
      overflow: visible !important;
      background: transparent !important;
      box-shadow: none !important;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    /* Inner Card Frame (Berisi gambar dan mengontrol rotasi dinamis) */
    .card-inner-frame {
      width: 250px;
      height: 360px;
      border-radius: 16px;
      overflow: hidden;
      background-color: #0F172A;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.14), 0 2px 6px rgba(0, 0, 0, 0.05);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      transform-origin: center center;
      transition: transform 0.65s cubic-bezier(0.34, 1.35, 0.64, 1), box-shadow 0.4s ease;
      user-select: none;
    }

    .card-inner-frame img {
      width: 100%;
      height: 100%;
      display: block;
      transition: transform 0.65s cubic-bezier(0.34, 1.35, 0.64, 1);
    }

    /* Gambar Vertikal: Memenuhi seluruh area kartu secara tegak */
    .swiper-slide.is-vertical .card-inner-frame {
      transform: rotate(0deg);
    }

    .swiper-slide.is-vertical .card-inner-frame img {
      object-fit: cover;
    }

    /* ========================================================
       PENGATURAN FOTO HORIZONTAL:
       - Di dalam stack / antrean: berdiri VERTICAL
       - Ketika gilirannya (Active): ROTATE KE HORIZONTAL
       - Ketika selesai giliran: BALIK JADI VERTICAL LAGI
       ======================================================== */
    .swiper-slide.is-horizontal .card-inner-frame {
      /* Posisi default di dalam stack: Berdiri vertikal sama seperti kartu lain */
      transform: rotate(0deg);
    }

    /* Di dalam antrean (tidak aktif), foto landscape diposisikan berdiri vertikal */
    .swiper-slide.is-horizontal:not(.swiper-slide-active) .card-inner-frame img {
      width: 360px;
      height: 250px;
      max-width: none;
      max-height: none;
      transform: rotate(90deg);
      object-fit: cover;
    }

    /* KETIKA GILIRANNYA (Active Slide): ROTATE KE HORIZONTAL! */
    .swiper-slide.is-horizontal.swiper-slide-active .card-inner-frame {
      transform: rotate(-90deg);
      box-shadow: 0 20px 44px rgba(0, 0, 0, 0.3), 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .swiper-slide.is-horizontal.swiper-slide-active .card-inner-frame img {
      width: 360px;
      height: 250px;
      max-width: none;
      max-height: none;
      transform: rotate(90deg);
      object-fit: cover;
    }

    /* Indikator Badge Landscape */
    .horizontal-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      background: rgba(15, 23, 42, 0.75);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      color: #FFFFFF;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      z-index: 5;
      pointer-events: none;
      transition: opacity 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* Kartu responsif */
    @media (max-width: 480px) {
      .mySwiper {
        width: 220px;
        height: 315px;
      }
      .card-inner-frame {
        width: 220px;
        height: 315px;
        border-radius: 14px;
      }
      .swiper-slide.is-horizontal:not(.swiper-slide-active) .card-inner-frame img,
      .swiper-slide.is-horizontal.swiper-slide-active .card-inner-frame img {
        width: 315px;
        height: 220px;
      }
    }

    /* ========================================================
       WALKING BRAND LOGOS (HERO NOTCH MARQUEE)
       ======================================================== */
    .hero-notch-marquee-wrapper {
      position: absolute;
      bottom: 8px;
      left: 45%;
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
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(-50%);
      }
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

    /* ========================================================
       MODAL LIGHTBOX (Zoom-in Certificate Detail)
       ======================================================== */
    .cert-lightbox-modal {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.85);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .cert-lightbox-modal.show {
      opacity: 1;
      visibility: visible;
    }

    /* ========================================================
       INTERACTIVE MODALS (Product List & Contact Us)
       ======================================================== */
    .interactive-modal {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.75);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      opacity: 0;
      visibility: hidden;
      transition: all 0.25s ease;
    }

    .interactive-modal.show {
      opacity: 1;
      visibility: visible;
    }

    .modal-box {
      background: #FFFFFF;
      border-radius: 24px;
      width: 100%;
      max-width: 660px;
      max-height: 88vh;
      overflow-y: auto;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(226, 232, 240, 0.9);
      display: flex;
      flex-direction: column;
      animation: modalPop 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes modalPop {
      0% { transform: scale(0.95) translateY(12px); opacity: 0; }
      100% { transform: scale(1) translateY(0); opacity: 1; }
    }

    .modal-header {
      padding: 18px 24px;
      border-bottom: 1px solid #E2E8F0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      background: #FFFFFF;
      z-index: 3;
    }

    .modal-header h3 {
      font-size: 18px;
      font-weight: 700;
      color: #0F172A;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .modal-header p {
      font-size: 12px;
      color: #64748B;
      margin-top: 2px;
    }

    .modal-close-btn {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      border: none;
      background: #F1F5F9;
      color: #475569;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      transition: var(--transition-base);
    }

    .modal-close-btn:hover {
      background: #E2E8F0;
      color: #0F172A;
    }

    .modal-body {
      padding: 20px 24px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    /* Product modal list cards */
    .product-catalog-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .catalog-item-card {
      padding: 14px;
      border-radius: 14px;
      border: 1px solid #E2E8F0;
      background: #F8FAFC;
      display: flex;
      flex-direction: column;
      gap: 6px;
      transition: var(--transition-base);
    }

    .catalog-item-card:hover {
      background: #FFFFFF;
      border-color: #CBD5E1;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transform: translateY(-2px);
    }

    .catalog-brand-badge {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #059669;
      background: #ECFDF5;
      padding: 2px 7px;
      border-radius: 6px;
      width: fit-content;
    }

    .catalog-item-title {
      font-size: 13.5px;
      font-weight: 700;
      color: #0F172A;
      line-height: 1.3;
    }

    .catalog-item-desc {
      font-size: 11.5px;
      color: #64748B;
      line-height: 1.4;
    }

    .catalog-action-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 4px;
      padding-top: 6px;
      border-top: 1px dashed #E2E8F0;
    }

    .catalog-quote-btn {
      font-size: 11.5px;
      font-weight: 600;
      color: #2563EB;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: color 0.2s ease;
    }

    .catalog-quote-btn:hover {
      color: #1D4ED8;
      text-decoration: underline;
    }

    /* Contact modal cards */
    .contact-channels-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .contact-channel-card {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 18px;
      border-radius: 16px;
      border: 1px solid #E2E8F0;
      background: #F8FAFC;
      text-decoration: none;
      color: inherit;
      transition: var(--transition-base);
    }

    .contact-channel-card:hover {
      background: #FFFFFF;
      border-color: #2563EB;
      box-shadow: 0 4px 16px rgba(37, 99, 235, 0.08);
      transform: translateX(4px);
    }

    .channel-icon-wrap {
      width: 42px;
      height: 42px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .channel-info h4 {
      font-size: 14px;
      font-weight: 700;
      color: #0F172A;
    }

    .channel-info p {
      font-size: 12px;
      color: #64748B;
    }

    @media (max-width: 640px) {
      .product-catalog-grid {
        grid-template-columns: 1fr;
      }
    }

    .lightbox-content-box {
      max-width: 860px;
      max-height: 90vh;
      background: #FFFFFF;
      border-radius: 20px;
      padding: 16px;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
      transform: scale(0.92);
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .cert-lightbox-modal.show .lightbox-content-box {
      transform: scale(1);
    }

    .lightbox-img {
      max-width: 100%;
      max-height: 78vh;
      object-fit: contain;
      border-radius: 12px;
    }

    .lightbox-close-btn {
      position: absolute;
      top: -16px;
      right: -16px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #0F172A;
      color: #FFFFFF;
      border: 2px solid #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 18px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
      transition: var(--transition-base);
    }

    .lightbox-close-btn:hover {
      background: #E11D48;
      transform: scale(1.1);
    }

    .lightbox-caption {
      margin-top: 10px;
      font-size: 13.5px;
      font-weight: 600;
      color: #334155;
      text-align: center;
    }

    /* ========================================================
       DOWNSTREAM SUPPORTING SECTIONS (Provides Web Harmony on Zoom Out)
       ======================================================== */
    .supporting-content-wrapper {
      display: flex;
      flex-direction: column;
      gap: 32px;
      width: 100%;
    }

    /* Partner Brands Ribbon */
    .partners-strip {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(226, 232, 240, 0.8);
      border-radius: 20px;
      padding: 20px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .partners-label {
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 0.12em;
      color: #64748B;
      text-transform: uppercase;
    }

    .partners-logos {
      display: flex;
      align-items: center;
      gap: 28px;
      flex-wrap: wrap;
    }

    .partner-brand-item {
      font-size: 14px;
      font-weight: 700;
      color: #334155;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      opacity: 0.85;
      transition: var(--transition-base);
    }

    .partner-brand-item:hover {
      opacity: 1;
      color: #0F172A;
      transform: translateY(-1px);
    }

    .partner-brand-item .icon-circle {
      width: 24px;
      height: 24px;
      border-radius: 6px;
      background: #F1F5F9;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }

    /* 4-Column Feature Cards Grid */
    .features-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      width: 100%;
    }

    .feature-card {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 20px;
      padding: 24px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
      transition: var(--transition-base);
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
      border-color: #CBD5E1;
    }

    .feature-icon-wrap {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: #FFF1F2;
      color: #E11D48;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      margin-bottom: 4px;
    }

    .feature-title {
      font-size: 16px;
      font-weight: 700;
      color: #0F172A;
    }

    .feature-desc {
      font-size: 13px;
      color: #64748B;
      line-height: 1.5;
    }

    /* Website Footer Strip */
    .site-footer-strip {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 24px;
      border-top: 1px solid #E2E8F0;
      font-size: 12.5px;
      color: #64748B;
      flex-wrap: wrap;
      gap: 12px;
    }

    /* ========================================================
       RESPONSIVE ADAPTATIONS
       ======================================================== */
    @media (max-width: 1200px) {
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 1120px) {
      .hero-inner-wrapper {
        padding: 36px 40px 48px 40px;
      }

      .hero-main-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .hero-showcase-column {
        justify-content: flex-start;
      }

      .cert-carousel-card {
        max-width: 100%;
      }
    }

    @media (max-width: 860px) {
      .master-site-container {
        padding: 16px 16px 48px 16px;
      }

      .hero-inner-wrapper {
        padding: 28px 24px 36px 24px;
      }

      .hero-navbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
      }

      .nav-menu {
        flex-wrap: wrap;
        gap: 18px;
      }

      .hero-headline {
        font-size: 2.35rem;
      }

      .features-grid {
        grid-template-columns: 1fr;
      }

      .carousel-stage {
        height: 240px;
      }
    }
  </style>
</head>

<body>

  <!-- Master Site Container (Grounds the entire page layout at any zoom level) -->
  <div class="master-site-container" id="siteContainer">

    <!-- Main Hero Component with Responsive Framer Geometry -->
    <main class="hero-container" id="heroCardContainer">

      <!-- Native Unstretched Photo Background Layer (Clipped to Exact Notch Shape via objectBoundingBox) -->
      <div class="hero-photo-layer">
        <img src="{{ asset('images/hero-bg.png') }}" class="hero-photo-img" alt="Electrical Engineer Control Panel">
        <div class="hero-photo-overlay"></div>
      </div>

      <!-- Responsive SVG Background (Same Notch & Curve Geometry as Framer) -->
      <svg class="hero-svg-bg" viewBox="0 0 1135 648" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <!-- Normalized ClipPath for zero-stretch HTML photo clipping -->
          <clipPath id="heroNormClip" clipPathUnits="objectBoundingBox">
            <path d="M 0.08540 0.99949 C 0.08540 0.99949 0.32582 1.00064 0.34511 0.99949 C 0.36440 0.99834 0.37994 0.96806 0.37994 0.96806 L 0.43616 0.88162 C 0.43616 0.88162 0.44645 0.86731 0.46999 0.86669 C 0.49353 0.86608 0.82834 0.86669 0.91776 0.86669 C 1.00719 0.86669 0.99985 0.71554 0.99985 0.71554 L 0.99985 0.12965 C 0.99985 0.12965 0.99902 0.00000 0.91776 0.00000 C 0.83650 0.00000 0.14743 0.00000 0.07545 0.00000 C 0.00348 0.00000 0.00182 0.12965 0.00182 0.12965 C 0.00182 0.12965 -0.00227 0.72406 0.00182 0.86669 C 0.00592 1.00933 0.08540 0.99949 0.08540 0.99949 Z" />
          </clipPath>

          <linearGradient id="atsBorderGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="rgba(255,255,255,0.22)" />
            <stop offset="100%" stop-color="rgba(255,255,255,0.06)" />
          </linearGradient>
        </defs>

        <!-- Border Outline along the curved profile -->
        <path d="M 96.934 647.668 
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

        <!-- ================= TOP NAVIGATION ================= -->
        <header class="hero-navbar">
          <!-- Logo + Brand Identification -->
          <a href="#home" class="brand-group">
            <div class="brand-logo-wrap">
              <!-- 3D Prism Logo (Embedded base64) -->
              <img class="brand-logo-img"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAMAAABOo35HAAAAn1BMVEUAAAASCgrIyMi4uLjz8vKcnJzg4OBMaXH+/v4NCQkBAQFRUVEBAQGIiIgKCgoAAAB4eHgQDQ0AAAAAAAADAwPU1NQAAABoaGgAAACsrKwyMjIAAAD3AAD8AAD8AACUkZHk5OTaAAD8IiP8/PzZ2dn9WFj9kZL+yspHAAD7AACDg4P15uaxsbH+/v5ubm7o6OhDMTGysrL8AAETDg6jAADqqgVXAAAAMnRSTlP8C/7+/f7+AP4ZgP6i/i+9/kLU82X+4f3r/v5O85PNO5hP/tBY/f7+/mSFtdCvrXXS9GXBbQAAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAmUdEVYdFJhdwAKeG1wCiAgICAxMjAwCjNjM2Y3ODcwNjE2MzZiNjU3NDIwNjI2NTY3Njk2ZTNkMjdlZmJiYmYyNzIwNjk2NDNkMjc1NzM1NGQzMDRkNzA0MzY1Njg2OQo0ODdhNzI2NTUzN2E0ZTU0NjM3YTZiNjMzOTY0MjczZjNlMGEzYzc4M2E3ODZkNzA2ZDY1NzQ2MTIwNzg2ZDZjNmU3MzNhNzgKM2QyNzYxNjQ2ZjYyNjUzYTZlNzMzYTZkNjU3NDYxMmYyNzNlMGEzYzcyNjQ2NjNhNTI0NDQ2MjA3ODZkNmM2ZTczM2E3MjY0CjY2M2QyNzY4NzQ3NDcwM2EyZjJmNzc3Nzc3MmU3NzMzMmU2ZjcyNjcyZjMxMzkzOTM5MmYzMDMyMmYzMjMyMmQ3MjY0NjYyZAo3Mzc5NmU3NDYxNzgyZDZlNzMyMzI3M2UwYTBhMjAzYzcyNjQ2NjNhNDQ2NTczNjM3MjY5NzA3NDY5NmY2ZTIwNzI2NDY2M2EKNjE2MjZmNzU3NDNkMjcyNzBhMjAyMDc4NmQ2YzZlNzMzYTQxNzQ3NDcyNjk2MjNkMjc2ODc0NzQ3MDNhMmYyZjZlNzMyZTYxCjc0NzQ3MjY5NjI3NTc0Njk2ZjZlMmU2MzZmNmQyZjYxNjQ3MzJmMzEyZTMwMmYyNzNlMGEyMDIwM2M0MTc0NzQ3MjY5NjIzYQo0MTY0NzMzZTBhMjAyMDIwM2M3MjY0NjYzYTUzNjU3MTNlMGEyMDIwMjAyMDNjNzI2NDY2M2E2YzY5MjA3MjY0NjYzYTcwNjEKNzI3MzY1NTQ3OTcwNjUzZDI3NTI2NTczNmY3NTcyNjM2NTI3M2UwYTIwMjAyMDIwMjAzYzQxNzQ3NDcyNjk2MjNhNDM3MjY1CjYxNzQ2NTY0M2UzMjMwMzIzNTJkMzEzMTJkMzEzMTNjMmY0MTc0NzQ3MjY5NjIzYTQzNzI2NTYxNzQ2NTY0M2UwYTIwMjAyMAoyMDIwM2M0MTc0NzQ3MjY5NjIzYTQ1Nzg3NDQ5NjQzZTYxMzEzMDM5MzI2NjY0MzYyZDM4MzIzODY1MmQzNDM3MzAzODJkNjIKMzQ2MjM3MmQ2MzM5MzUzNzM1MzQ2MTM1MzIzNTM2MzczYzJmNDE3NDc0NzI2OTYyM2E0NTc4NzQ0OTY0M2UwYTIwMjAyMDIwCjIwM2M0MTc0NzQ3MjY5NjIzYTQ2NjI0OTY0M2UzNTMyMzUzMjM2MzUzOTMxMzQzMTM3MzkzNTM4MzAzYzJmNDE3NDc0NzI2OQo2MjNhNDY2MjQ5NjQzZTBhMjAyMDIwMjAyMDNjNDE3NDc0NzI2OTYyM2E1NDZmNzU2MzY4NTQ3OTcwNjUzZTMyM2MyZjQxNzQKNzQ3MjY5NjIzYTU0NmY3NTYzNjg1NDc5NzA2NTNlMGEyMDIwMjAyMDNjMmY3MjY0NjYzYTZjNjkzZTBhMjAyMDIwM2MyZjcyCjY0NjYzYTUzNjU3MTNlMGEyMDIwM2MyZjQxNzQ3NDcyNjk2MjNhNDE2NDczM2UwYTIwM2MyZjcyNjQ2NjNhNDQ2NTczNjM3Mgo2OTcwNzQ2OTZmNmUzZTBhMGEyMDNjNzI2NDY2M2E0NDY1NzM2MzcyNjk3MDc0Njk2ZjZlMjA3MjY0NjYzYTYxNjI2Zjc1NzQKM2QyNzI3MGEyMDIwNzg2ZDZjNmU3MzNhNjQ2MzNkMjc2ODc0NzQ3MDNhMmYyZjcwNzU3MjZjMmU2ZjcyNjcyZjY0NjMyZjY1CjZjNjU2ZDY1NmU3NDczMmYzMTJlMzEyZjI3M2UwYTIwMjAzYzY0NjMzYTc0Njk3NDZjNjUzZTBhMjAyMDIwM2M3MjY0NjYzYQo0MTZjNzQzZTBhMjAyMDIwMjAzYzcyNjQ2NjNhNmM2OTIwNzg2ZDZjM2E2YzYxNmU2NzNkMjc3ODJkNjQ2NTY2NjE3NTZjNzQKMjczZTQ0NjU3MzYxNjk2ZTIwNzQ2MTZlNzA2MTIwNmE3NTY0NzU2YzIwMmQyMDMxM2MyZjcyNjQ2NjNhNmM2OTNlMGEyMDIwCjIwM2MyZjcyNjQ2NjNhNDE2Yzc0M2UwYTIwMjAzYzJmNjQ2MzNhNzQ2OTc0NmM2NTNlMGEyMDNjMmY3MjY0NjYzYTQ0NjU3Mwo2MzcyNjk3MDc0Njk2ZjZlM2UwYTBhMjAzYzcyNjQ2NjNhNDQ2NTczNjM3MjY5NzA3NDY5NmY2ZTIwNzI2NDY2M2E2MTYyNmYKNzU3NDNkMjcyNzBhMjAyMDc4NmQ2YzZlNzMzYTcwNjQ2NjNkMjc2ODc0NzQ3MDNhMmYyZjZlNzMyZTYxNjQ2ZjYyNjUyZTYzCjZmNmQyZjcwNjQ2NjJmMzEyZTMzMmYyNzNlMGEyMDIwM2M3MDY0NjYzYTQxNzU3NDY4NmY3MjNlNTM2MTZjNjU3MzIwNGM2OQo3Mzc0NzI2OTZiMjA0ZjZlNmM2OTZlNjUzYzJmNzA2NDY2M2E0MTc1NzQ2ODZmNzIzZTBhMjAzYzJmNzI2NDY2M2E0NDY1NzMKNjM3MjY5NzA3NDY5NmY2ZTNlMGEwYTIwM2M3MjY0NjYzYTQ0NjU3MzYzNzI2OTcwNzQ2OTZmNmUyMDcyNjQ2NjNhNjE2MjZmCjc1NzQzZDI3MjcwYTIwMjA3ODZkNmM2ZTczM2E3ODZkNzAzZDI3Njg3NDc0NzAzYTJmMmY2ZTczMmU2MTY0NmY2MjY1MmU2Mwo2ZjZkMmY3ODYxNzAyZjMxMmUzMDJmMjczZTBhMjAyMDNjNzg2ZDcwM2E0MzcyNjU2MTc0NmY3MjU0NmY2ZjZjM2U0MzYxNmUKNzY2MTIwMjg1MjY1NmU2NDY1NzI2NTcyMjkyMDY0NmY2MzNkNDQ0MTQ3MzQ1NzJkMzk1OTc4NjU3MzIwNzU3MzY1NzIzZDU1CjQxNDYzMDRlNDEzMTM0Njk0MjY3MjA2MjcyNjE2ZTY0M2Q0MjQxNDYzMDRlNTA1MzU2MzE0ZDQ5MjA3NDY1NmQ3MDZjNjE3NAo2NTNkM2MyZjc4NmQ3MDNhNDM3MjY1NjE3NDZmNzI1NDZmNmY2YzNlMGEyMDNjMmY3MjY0NjYzYTQ0NjU3MzYzNzI2OTcwNzQKNjk2ZjZlM2UwYTNjMmY3MjY0NjYzYTUyNDQ0NjNlMGEzYzJmNzgzYTc4NmQ3MDZkNjU3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"
                alt="PT. Anugerah Tama Sejati Logo">
            </div>
            <div class="brand-text-block">
              <span class="brand-company-title">PT. ANUGERAH TAMA SEJATI</span>
              <span class="brand-company-tag" data-i18n="hero.brand_tag">ELECTRICAL SUPPLIER</span>
            </div>
          </a>

          <!-- Desktop Navigation Items (Properly Spaced with Language Switcher) -->
          <nav class="nav-container">
            <ul class="nav-menu">
              <li class="nav-item active"><a href="{{ route('home') }}" data-i18n="nav.home">HOME</a></li>
              <li class="nav-item"><a href="{{ route('about.index') }}" data-i18n="nav.about">ABOUT US</a></li>
              <li class="nav-item"><a href="{{ route('products.index') }}" data-i18n="nav.products">PRODUCTS</a></li>
              <li class="nav-item"><a href="{{ route('articles.index') }}" data-i18n="nav.article">ARTICLE</a></li>
              <li class="nav-item"><a href="{{ route('contact.index') }}" data-i18n="nav.contact">CONTACT US</a></li>
            </ul>

            <!-- Global Multilingual Language Switcher (EN Primary / ID Secondary) -->
            @include('components.language-switcher')
          </nav>
        </header>

        <!-- ================= HERO MAIN CONTENT ================= -->
        <section class="hero-main-grid">

          <!-- Left Text Column -->
          <div class="hero-left-column">
            <h1 class="hero-headline">
              <span data-i18n="hero.headline_pre">Discover Your</span><br>
              <span class="text-gradient-accent" data-i18n="hero.headline_highlight">Best Electrical</span> <span data-i18n="hero.headline_post">Supplier</span>
            </h1>

            <p class="hero-subheadline" data-i18n="hero.subheadline">
              Your trusted one-stop supplier for all electrical and wiring components.
            </p>

            <!-- Action Buttons: Product List & Contact Us -->
            <div class="hero-cta-group">
              <button type="button" class="btn-cta-white" id="btnProductList" onclick="openProductModal()">
                <span data-i18n="hero.btn_product_list">Product List</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </button>

              <button type="button" class="btn-cta-dark" id="btnContactUs" onclick="openContactModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span data-i18n="hero.btn_contact_us">Contact Us</span>
              </button>
            </div>
          </div>

          <!-- Right Column: Interactive Certificate Carousel (Clean Minimal Cards Stack) -->
          <div class="hero-showcase-column">
            @php
              // Tampilkan persis 3 sertifikat saja
              $photos = [
                (object)['is_horizontal' => true, 'path' => 'cert/cert-schneider.png', 'title' => 'Schneider Electric Partner 2026'],
                (object)['is_horizontal' => false, 'path' => 'cert/cert-gae.png', 'title' => 'GAE Authorized Distributor'],
                (object)['is_horizontal' => true, 'path' => 'cert/cert-legrand.jpg', 'title' => 'Legrand Official Retailer Partner'],
              ];
            @endphp

            <div class="card-carousel-container">
              <!-- Swiper Main Stage (Klik kartu langsung untuk looping) -->
              <div class="swiper mySwiper" id="heroSwiper" title="Click card to view next certificate">
                <div class="swiper-wrapper">
                  @foreach($photos as $index => $photo)
                    <div class="swiper-slide {{ $photo->is_horizontal ? 'is-horizontal' : 'is-vertical' }}" data-index="{{ $index }}">
                      <div class="card-inner-frame">
                        <img src="{{ asset('storage/' . $photo->path) }}" onerror="this.src='{{ asset('certificates/' . basename($photo->path)) }}'" alt="Official Certificate of PT. ATS" loading="lazy">
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

        </section>

      </div>

      <!-- Dynamic Walking Brand Logos in Hero Notch (Marquee Ticker) -->
      <div class="hero-notch-marquee-wrapper" id="notchMarquee" title="Authorized Brands &amp; Official Partners - PT. Anugerah Tama Sejati">
        <div class="marquee-track">
          <!-- Set 1 (All 14 Official Brand Logos) -->
          <div class="marquee-logo-card"><img src="logos/1.png" alt="Schneider Electric Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/2.png" alt="GAE Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/vinsa.png" alt="VINSA France" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/DV.webp" alt="DV Electrical Products" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Legrand.webp" alt="Legrand" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Socomec.png" alt="Socomec" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Autonics.webp" alt="Autonics" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Himel.webp" alt="Himel" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Panasonic.png" alt="Panasonic" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Philips.webp" alt="Philips" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Fluke.webp" alt="Fluke" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Boss.webp" alt="Boss" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Jembo.webp" alt="Jembo Cable" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/supremexxx.webp" alt="Supreme Cable" loading="lazy"></div>

          <!-- Set 2 (Seamless Duplicate for Infinite Loop) -->
          <div class="marquee-logo-card"><img src="logos/1.png" alt="Schneider Electric Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/2.png" alt="GAE Authorized Dealer" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/vinsa.png" alt="VINSA France" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/DV.webp" alt="DV Electrical Products" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Legrand.webp" alt="Legrand" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Socomec.png" alt="Socomec" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Autonics.webp" alt="Autonics" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Himel.webp" alt="Himel" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Panasonic.png" alt="Panasonic" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Philips.webp" alt="Philips" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Fluke.webp" alt="Fluke" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Boss.webp" alt="Boss" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/Jembo.webp" alt="Jembo Cable" loading="lazy"></div>
          <div class="marquee-logo-card"><img src="logos/supremexxx.webp" alt="Supreme Cable" loading="lazy"></div>
        </div>
      </div>
    </main>

    <!-- ================= SUPPORTING SECTIONS ================= -->
    <div class="supporting-content-wrapper">

      <!-- ================= LIFTED CAROUSEL: CUSTOMER & KLIEN TERKENAL ================= -->
      @include('components.customer-carousel')

      <!-- ================= CURVED WALKING TEXT (FRAMER-INSPIRED RIBBON) ================= -->
      @include('components.curved-walking-text')

      <!-- ================= OUR PRODUCT SECTION (SESUAI MOCKUP FIGMA) ================= -->
      @include('components.our-products')

      <!-- 4-Column Feature Highlights -->
      <section class="features-grid">
        <div class="feature-card">
          <div class="feature-icon-wrap">🛡️</div>
          <h3 class="feature-title" data-i18n="features.genuine_title">100% Genuine Products</h3>
          <p class="feature-desc" data-i18n="features.genuine_desc">All components come with direct manufacturer warranty and authentic certificates of origin.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrap" style="background: #EFF6FF; color: #2563EB;">⚡</div>
          <h3 class="feature-title" data-i18n="features.stock_title">Surabaya Ready Stock</h3>
          <p class="feature-desc" data-i18n="features.stock_desc">Our main warehouse maintains thousands of breaker, switchgear, and inverter SKUs ready for fast dispatch.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrap" style="background: #ECFDF5; color: #059669;">🚚</div>
          <h3 class="feature-title" data-i18n="features.logistics_title">Nationwide Logistics</h3>
          <p class="feature-desc" data-i18n="features.logistics_desc">Dependable, insured freight logistics delivering safely to industrial project sites across Indonesia.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrap" style="background: #FDF4FF; color: #C026D3;">💬</div>
          <h3 class="feature-title" data-i18n="features.support_title">Engineering Specialists</h3>
          <p class="feature-desc" data-i18n="features.support_desc">Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with certified engineers.</p>
        </div>
      </section>

    </div>

  </div>

  <!-- ================= ENDLESS 3D CAROUSEL: OUR PROJECTS (FRAMER-INSPIRED) ================= -->
  @include('components.our-projects-carousel')

  <!-- Industrial Skyline Footer with 3 Interactive Google Maps Embeds (Full Width - Outside Container) -->
  @include('components.footer')

  <!-- Lightbox Modal for Zooming Certificates -->
  <div class="cert-lightbox-modal" id="certLightbox" onclick="closeLightbox()">
    <div class="lightbox-content-box" onclick="event.stopPropagation()">
      <button type="button" class="lightbox-close-btn" onclick="closeLightbox()" aria-label="Close">&times;</button>
      <img src="" alt="Certificate Preview" class="lightbox-img" id="lightboxImg">
      <div class="lightbox-caption" id="lightboxCaption">Official Certificate</div>
    </div>
  </div>

  <!-- Interactive Product List Modal -->
  <div class="interactive-modal" id="productModal" onclick="closeProductModal()">
    <div class="modal-box" onclick="event.stopPropagation()">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <h3>⚡ Featured Product Catalog</h3>
          <p>Official industrial electrical &amp; automation components from PT. Anugerah Tama Sejati</p>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeProductModal()" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="product-catalog-grid">
          <div class="catalog-item-card">
            <span class="catalog-brand-badge">Schneider Electric</span>
            <div class="catalog-item-title">MasterPact MTZ / NT / NW</div>
            <div class="catalog-item-desc">Air Circuit Breakers (ACB) 630A up to 6300A, low-voltage primary electrical distribution protection.</div>
            <div class="catalog-action-row">
              <span style="font-size: 11px; color: #059669; font-weight: 600;">Ready Stock</span>
              <a href="https://wa.me/6281234567890?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20request%20a%20quotation%20for%20MasterPact%20ACB" target="_blank" class="catalog-quote-btn">Request Quotation &rarr;</a>
            </div>
          </div>

          <div class="catalog-item-card">
            <span class="catalog-brand-badge">Schneider Electric</span>
            <div class="catalog-item-title">ComPact NSX &amp; CVS Series</div>
            <div class="catalog-item-desc">Molded Case Circuit Breakers (MCCB) 16A up to 1600A, reliable for industrial distribution switchboards.</div>
            <div class="catalog-action-row">
              <span style="font-size: 11px; color: #059669; font-weight: 600;">Ready Stock</span>
              <a href="https://wa.me/6281234567890?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20request%20a%20quotation%20for%20ComPact%20MCCB" target="_blank" class="catalog-quote-btn">Request Quotation &rarr;</a>
            </div>
          </div>

          <div class="catalog-item-card">
            <span class="catalog-brand-badge">Schneider Electric</span>
            <div class="catalog-item-title">Altivar Process &amp; Machine</div>
            <div class="catalog-item-desc">Variable Speed Drives (VFD/Inverter) ATV320, ATV630, ATV930 for precision industrial motor control.</div>
            <div class="catalog-action-row">
              <span style="font-size: 11px; color: #059669; font-weight: 600;">Ready Stock</span>
              <a href="https://wa.me/6281234567890?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20request%20a%20quotation%20for%20Altivar%20Inverter" target="_blank" class="catalog-quote-btn">Request Quotation &rarr;</a>
            </div>
          </div>

          <div class="catalog-item-card">
            <span class="catalog-brand-badge">Schneider Electric</span>
            <div class="catalog-item-title">TeSys D &amp; F Series</div>
            <div class="catalog-item-desc">Magnetic Contactors &amp; Overload Relays for motor starting from 9A up to 1000A premium grade.</div>
            <div class="catalog-action-row">
              <span style="font-size: 11px; color: #059669; font-weight: 600;">Ready Stock</span>
              <a href="https://wa.me/6281234567890?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20request%20a%20quotation%20for%20TeSys%20Contactors" target="_blank" class="catalog-quote-btn">Request Quotation &rarr;</a>
            </div>
          </div>

          <div class="catalog-item-card">
            <span class="catalog-brand-badge" style="color: #DC2626; background: #FEE2E2;">Legrand Indonesia</span>
            <div class="catalog-item-title">Plexo™ &amp; Enclosures XL³</div>
            <div class="catalog-item-desc">Weatherproof IP66 industrial enclosure boxes, modular distribution, and industrial switches.</div>
            <div class="catalog-action-row">
              <span style="font-size: 11px; color: #059669; font-weight: 600;">Ready Stock</span>
              <a href="https://wa.me/6281234567890?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20request%20a%20quotation%20for%20Legrand%20Products" target="_blank" class="catalog-quote-btn">Request Quotation &rarr;</a>
            </div>
          </div>

          <div class="catalog-item-card">
            <span class="catalog-brand-badge" style="color: #2563EB; background: #EFF6FF;">GAE Group</span>
            <div class="catalog-item-title">Power Quality &amp; Metering</div>
            <div class="catalog-item-desc">Digital Energy Meters, Capacitor Banks, Surge Protection Devices, and Current Transformers (CT).</div>
            <div class="catalog-action-row">
              <span style="font-size: 11px; color: #059669; font-weight: 600;">Ready Stock</span>
              <a href="https://wa.me/6281234567890?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20request%20a%20quotation%20for%20GAE%20Products" target="_blank" class="catalog-quote-btn">Request Quotation &rarr;</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Interactive Contact Us Modal -->
  <div class="interactive-modal" id="contactModal" onclick="closeContactModal()">
    <div class="modal-box" onclick="event.stopPropagation()">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <h3>📞 Contact Sales &amp; Engineering Team</h3>
          <p>PT. Anugerah Tama Sejati &bull; Ready to assist with technical inquiries &amp; project quotations</p>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeContactModal()" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="contact-channels-list">
          <a href="https://wa.me/6281234567890?text=Hello%20PT%20Anugerah%20Tama%20Sejati,%20I%20would%20like%20to%20inquire%20about%20components%20and%20price%20quotation" target="_blank" class="contact-channel-card">
            <div class="channel-icon-wrap" style="background: #ECFDF5; color: #059669;">💬</div>
            <div class="channel-info">
              <h4>WhatsApp Official Sales</h4>
              <p>Prompt response for orders, warehouse stock verification, and formal quotation requests (08:30 - 17:00 WIB)</p>
            </div>
          </a>

          <a href="tel:03159178887" class="contact-channel-card">
            <div class="channel-icon-wrap" style="background: #EFF6FF; color: #2563EB;">📞</div>
            <div class="channel-info">
              <h4>Surabaya Office Hotline: (031) 59178887</h4>
              <p>Call our hotline for technical coordination, project procurement &amp; tax invoicing</p>
            </div>
          </a>

          <div class="contact-channel-card" style="cursor: default;">
            <div class="channel-icon-wrap" style="background: #FEF3C7; color: #D97706;">📍</div>
            <div class="channel-info">
              <h4>Head Office &amp; Main Warehouse</h4>
              <p>Jl. Kenjeran No. 485, Gading, Tambaksari, Surabaya, East Java 60134, Indonesia</p>
            </div>
          </div>

          <a href="mailto:sales@anugerahtamasejati.com" class="contact-channel-card">
            <div class="channel-icon-wrap" style="background: #FDF4FF; color: #C026D3;">✉️</div>
            <div class="channel-info">
              <h4>Email: sales@anugerahtamasejati.com</h4>
              <p>Submit your BoQ (Bill of Quantity) or single-line diagram for component estimations</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Swiper JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Interactive Swiper & Modals JavaScript Logic -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Inisialisasi Swiper murni 3 kartu (tanpa duplikasi)
      const swiper = new Swiper('.mySwiper', {
        effect: 'cards',
        grabCursor: true,
        cardsEffect: {
          perSlideOffset: 8,   // Jarak geser antar tumpukan kartu
          perSlideRotate: 2,   // Derajat rotasi tumpukan belakang
          rotate: true,
          slideShadows: false
        },
        loop: false,   // Murni 3 kartu di DOM tanpa cloning
        rewind: true,  // Memungkinkan kembali ke awal/akhir saat mencapai batas
        speed: 500,
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
          stopOnLastSlide: false,
          pauseOnMouseEnter: false,
        },
        resistance: false,
        resistanceRatio: 0,
        preventClicks: true,
        preventClicksPropagation: true,
      });

      // Fungsi looping maju (0 -> 1 -> 2 -> 0)
      function nextSlide() {
        if (swiper.isEnd) {
          swiper.slideTo(0);
        } else {
          swiper.slideNext();
        }
      }

      // Fungsi looping mundur (0 -> 2 -> 1 -> 0)
      function prevSlide() {
        if (swiper.isBeginning) {
          swiper.slideTo(swiper.slides.length - 1);
        } else {
          swiper.slidePrev();
        }
      }

      // 1. Ketika kartu diklik: otomatis loop ke giliran kartu berikutnya dan reset timer autoplay
      swiper.on('click', () => {
        nextSlide();
        if (swiper.autoplay) {
          swiper.autoplay.start();
        }
      });

      // 2. Deteksi gesture swipe drag: jika geser di ujung batas, loop tanpa mentok
      swiper.on('touchEnd', () => {
        const diff = swiper.touches.diff;
        // diff < -35 artinya drag ke kiri (maju)
        if (diff < -35 && swiper.isEnd) {
          swiper.slideTo(0);
        }
        // diff > 35 artinya drag ke kanan (mundur)
        else if (diff > 35 && swiper.isBeginning) {
          swiper.slideTo(swiper.slides.length - 1);
        }
        if (swiper.autoplay) {
          swiper.autoplay.start();
        }
      });

      // Keyboard navigation (Esc untuk modal, panah kiri/kanan untuk navigasi kartu)
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          closeProductModal();
          closeContactModal();
        }
        if (e.key === 'ArrowRight') nextSlide();
        if (e.key === 'ArrowLeft') prevSlide();
      });
    });

    // Modal handlers for Product List & Contact Us
    function openProductModal() {
      document.getElementById('productModal').classList.add('show');
    }

    function closeProductModal() {
      document.getElementById('productModal').classList.remove('show');
    }

    function openContactModal() {
      document.getElementById('contactModal').classList.add('show');
    }

    function closeContactModal() {
      document.getElementById('contactModal').classList.remove('show');
    }
  </script>

</body>

</html>