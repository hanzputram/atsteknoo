<style>
  /* ========================================================
     ATS TEKNO - MODERN INDUSTRIAL FOOTER (CLEAN & MINIMALIST)
     ======================================================== */
  :root {
    --ats-ft-bg: #001D34;
    --ats-ft-bg-darker: #001424;
    --ats-ft-surface: rgba(255, 255, 255, 0.04);
    --ats-ft-border: rgba(255, 255, 255, 0.08);
    --ats-ft-border-hover: rgba(255, 255, 255, 0.18);
    --ats-ft-text-primary: #FFFFFF;
    --ats-ft-text-secondary: #94A3B8;
    --ats-ft-text-muted: #64748B;
    --ats-ft-accent: #E11D48;
    --ats-ft-accent-hover: #BE123C;
  }

  .ats-footer-wrapper {
    position: relative;
    width: 100%;
    margin-top: 0;
    background: transparent;
    color: var(--ats-ft-text-secondary);
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    overflow: hidden;
    box-sizing: border-box;
  }

  /* 1. Full Uncut Industrial Skyline Artwork Transition */
  .ats-footer-skyline-banner {
    position: relative;
    width: 100%;
    line-height: 0;
    overflow: hidden;
    background: transparent;
    margin-bottom: -2px; /* Seamless overlap with main dark body */
    pointer-events: none;
  }

  .ats-footer-skyline-img {
    width: 100%;
    height: auto;
    display: block;
    user-select: none;
  }

  /* 2. Main Footer Body (Exact #001D34 bottom color match) */
  .ats-footer-main-section {
    width: 100%;
    background: #001D34;
    position: relative;
    z-index: 10;
  }

  /* Integrated CTA Consultation Header Strip */
  .ats-ft-cta-strip {
    max-width: 1320px;
    margin: 0 auto;
    padding: 36px 24px 32px 24px;
    box-sizing: border-box;
    border-bottom: 1px solid var(--ats-ft-border);
  }

  .ats-ft-cta-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 28px;
    flex-wrap: wrap;
  }

  .ats-ft-cta-text {
    max-width: 680px;
  }

  .ats-ft-cta-title {
    font-size: clamp(1.2rem, 1.8vw, 1.45rem);
    font-weight: 800;
    color: var(--ats-ft-text-primary);
    letter-spacing: -0.015em;
    margin: 0 0 6px 0;
    line-height: 1.25;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .ats-ft-cta-title svg {
    color: var(--ats-ft-accent);
    flex-shrink: 0;
  }

  .ats-ft-cta-desc {
    font-size: 0.9rem;
    color: var(--ats-ft-text-secondary);
    line-height: 1.5;
    margin: 0;
  }

  .ats-ft-cta-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
  }

  .ats-ft-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--ats-ft-accent);
    color: #FFFFFF;
    font-weight: 700;
    font-size: 0.88rem;
    padding: 12px 22px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.22s ease;
    box-shadow: 0 4px 16px rgba(225, 29, 72, 0.25);
  }

  .ats-ft-btn-primary:hover {
    background: var(--ats-ft-accent-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(225, 29, 72, 0.35);
    color: #FFFFFF;
  }

  .ats-ft-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.07);
    color: var(--ats-ft-text-primary);
    font-weight: 600;
    font-size: 0.88rem;
    padding: 12px 20px;
    border-radius: 12px;
    text-decoration: none;
    border: 1px solid var(--ats-ft-border);
    transition: all 0.22s ease;
  }

  .ats-ft-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.14);
    border-color: var(--ats-ft-border-hover);
    color: #FFFFFF;
    transform: translateY(-2px);
  }

  /* 3. Main Footer 4-Column Grid */
  .ats-footer-body {
    max-width: 1320px;
    margin: 0 auto;
    padding: 44px 24px 40px 24px;
    box-sizing: border-box;
  }

  .ats-footer-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.85fr 0.8fr 1.15fr;
    gap: 40px;
    align-items: start;
  }

  /* Column Headers */
  .ats-ft-col-header {
    font-size: 0.82rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    color: var(--ats-ft-text-primary);
    text-transform: uppercase;
    margin: 0 0 20px 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .ats-ft-col-header::after {
    content: '';
    width: 24px;
    height: 2px;
    background: var(--ats-ft-accent);
    border-radius: 2px;
  }

  /* Column 1: Brand & Contact Info */
  .ats-ft-brand-title {
    font-size: 1.12rem;
    font-weight: 800;
    color: #FFFFFF;
    letter-spacing: -0.01em;
    margin: 0 0 4px 0;
  }

  .ats-ft-brand-tagline {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--ats-ft-accent);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin: 0 0 12px 0;
  }

  .ats-ft-bio {
    font-size: 0.86rem;
    line-height: 1.6;
    color: var(--ats-ft-text-secondary);
    margin: 0 0 18px 0;
  }

  .ats-ft-badges-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 22px;
  }

  .ats-ft-badge {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 3px 8px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #FFFFFF;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .ats-ft-badge-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--ats-ft-accent);
  }

  .ats-ft-contact-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .ats-ft-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.84rem;
    color: var(--ats-ft-text-secondary);
  }

  .ats-ft-contact-item svg {
    flex-shrink: 0;
    margin-top: 2px;
    color: var(--ats-ft-accent);
  }

  .ats-ft-contact-item a {
    color: var(--ats-ft-text-secondary);
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-ft-contact-item a:hover {
    color: #FFFFFF;
    text-decoration: underline;
  }

  /* Columns 2 & 3: Navigation & Product Links */
  .ats-ft-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .ats-ft-nav-item a {
    font-size: 0.86rem;
    color: var(--ats-ft-text-secondary);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
  }

  .ats-ft-nav-item a:hover {
    color: #FFFFFF;
    transform: translateX(4px);
  }

  /* Column 4: Interactive Showrooms Hub */
  .ats-ft-hub-card {
    background: var(--ats-ft-surface);
    border: 1px solid var(--ats-ft-border);
    border-radius: 16px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .ats-ft-tab-group {
    display: flex;
    gap: 4px;
    background: rgba(0, 0, 0, 0.35);
    padding: 3px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.06);
  }

  .ats-ft-tab-btn {
    flex: 1;
    background: transparent;
    border: none;
    color: var(--ats-ft-text-muted);
    font-family: inherit;
    font-size: 0.76rem;
    font-weight: 700;
    padding: 7px 6px;
    border-radius: 7px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    white-space: nowrap;
    outline: none;
  }

  .ats-ft-tab-btn.active {
    background: #FFFFFF;
    color: #0F172A;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
  }

  .ats-ft-tab-btn:hover:not(.active) {
    color: #FFFFFF;
  }

  .ats-ft-panel-item {
    display: none;
    flex-direction: column;
    gap: 12px;
  }

  .ats-ft-panel-item.active {
    display: flex;
  }

  .ats-ft-loc-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
  }

  .ats-ft-loc-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: #FFFFFF;
  }

  .ats-ft-loc-tag {
    font-size: 0.68rem;
    font-weight: 700;
    background: rgba(225, 29, 72, 0.15);
    border: 1px solid rgba(225, 29, 72, 0.3);
    color: #FDA4AF;
    padding: 2px 7px;
    border-radius: 4px;
    text-transform: uppercase;
  }

  .ats-ft-loc-addr {
    font-size: 0.8rem;
    color: var(--ats-ft-text-secondary);
    line-height: 1.45;
  }

  .ats-ft-loc-quick-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
    font-size: 0.8rem;
  }

  .ats-ft-loc-wa-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #34D399;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s;
  }

  .ats-ft-loc-wa-link:hover {
    color: #6EE7B7;
    text-decoration: underline;
  }

  .ats-ft-loc-tel-link {
    color: var(--ats-ft-text-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-ft-loc-tel-link:hover {
    color: #FFFFFF;
  }

  .ats-ft-map-container {
    position: relative;
    width: 100%;
    height: 140px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--ats-ft-border);
    background: #0F172A;
  }

  .ats-ft-map-iframe {
    width: 100%;
    height: 100%;
    border: none;
    filter: brightness(0.85) contrast(1.1) invert(90%) hue-rotate(180deg);
  }

  .ats-ft-map-overlay-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #FFFFFF;
    font-size: 0.72rem;
    font-weight: 600;
    padding: 4px 9px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
    z-index: 5;
  }

  .ats-ft-map-overlay-btn:hover {
    background: var(--ats-ft-accent);
    border-color: var(--ats-ft-accent);
    color: #FFFFFF;
  }

  /* 4. Bottom Strip */
  .ats-footer-bottom {
    max-width: 1320px;
    margin: 0 auto;
    padding: 22px 24px 28px 24px;
    box-sizing: border-box;
    border-top: 1px solid var(--ats-ft-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 0.82rem;
    color: var(--ats-ft-text-muted);
  }

  .ats-ft-bottom-brand {
    color: #CBD5E1;
    font-weight: 600;
  }

  .ats-ft-bottom-right {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
  }

  .ats-ft-bottom-right a {
    color: var(--ats-ft-text-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-ft-bottom-right a:hover {
    color: #FFFFFF;
  }

  .ats-ft-top-btn {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.14);
    color: #CBD5E1;
    font-size: 0.76rem;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 8px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.2s ease;
  }

  .ats-ft-top-btn:hover {
    background: #FFFFFF;
    color: #0F172A;
    transform: translateY(-2px);
  }

  /* ================= RESPONSIVE DESIGN ================= */
  @media (max-width: 1100px) {
    .ats-footer-grid {
      grid-template-columns: 1fr 1fr;
      gap: 36px 28px;
    }
    .ats-ft-cta-inner {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media (max-width: 680px) {
    .ats-footer-wrapper {
      margin-top: 0;
    }
    .ats-footer-grid {
      grid-template-columns: 1fr;
      gap: 32px;
    }
    .ats-ft-cta-actions {
      width: 100%;
      flex-direction: column;
    }
    .ats-ft-btn-primary, .ats-ft-btn-secondary {
      width: 100%;
      justify-content: center;
    }
    .ats-footer-bottom {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .ats-ft-bottom-right {
      justify-content: center;
    }
  }
</style>

<!-- ================= ATS INDUSTRIAL FOOTER COMPONENT ================= -->
<footer class="ats-footer-wrapper" id="contact-locations">
  
  <!-- 1. Sleek Horizon Silhouette Transition -->
  <div class="ats-footer-skyline-banner">
    <img 
      src="{{ asset('images/footer-skyline.png') }}" 
      alt="ATS TEKNO Industrial Electrical Infrastructure Skyline" 
      class="ats-footer-skyline-img"
      loading="lazy"
    >
  </div>

  <!-- 2. Dark Industrial Body -->
  <div class="ats-footer-main-section">

    <!-- Integrated Engineering CTA Header Strip -->
    <div class="ats-ft-cta-strip">
      <div class="ats-ft-cta-inner">
        <div class="ats-ft-cta-text">
          <h3 class="ats-ft-cta-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            <span data-i18n="footer.cta_title">Ready to Power Your Industrial Infrastructure?</span>
          </h3>
          <p class="ats-ft-cta-desc" data-i18n="footer.cta_desc">
            Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with our certified electrical engineering specialists.
          </p>
        </div>
        <div class="ats-ft-cta-actions">
          <a href="https://wa.me/6282223332830?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20consult%20about%20electrical%20components%20and%20panel%20solutions" target="_blank" class="ats-ft-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.477-.15-.678.15-.201.301-.778.978-.954 1.179-.176.2-.351.226-.652.075-.301-.15-1.272-.469-2.423-1.496-.896-.799-1.501-1.786-1.677-2.087-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.176.201-.301.301-.502.1-.201.05-.377-.025-.527-.075-.15-.678-1.633-.929-2.235-.244-.587-.493-.507-.678-.517-.176-.01-.377-.01-.578-.01-.201 0-.527.075-.803.377s-1.054 1.03-1.054 2.511c0 1.482 1.079 2.911 1.23 3.112.15.201 2.124 3.244 5.146 4.55.719.311 1.28.497 1.718.636.722.23 1.379.197 1.899.12.579-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.176-1.431-.075-.126-.276-.201-.577-.351zM12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883zM12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.952 3.71 1.453 5.708 1.454h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0 0 20.488 3.48 11.82 11.82 0 0 0 12.05 0z"/></svg>
            <span data-i18n="footer.btn_wa">WhatsApp Hotline</span>
          </a>
          <a href="#contactModal" onclick="openContactModal(); return false;" class="ats-ft-btn-secondary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span data-i18n="footer.btn_quote">Request BoQ Quotation</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Main 4-Column Layout Grid -->
    <div class="ats-footer-body">
      <div class="ats-footer-grid">
        
        <!-- ================= COLUMN 1: BRAND PROFILE & CREDENTIALS ================= -->
        <div class="ats-ft-col">
          <div class="ats-ft-col-header" data-i18n="footer.col1_header">Company Profile</div>
          <h2 class="ats-ft-brand-title">PT. Anugerah Tama Sejati</h2>
          <div class="ats-ft-brand-tagline" data-i18n="footer.tagline">Industrial Electrical Supplier &amp; Panel Maker</div>
          
          <p class="ats-ft-bio" data-i18n="footer.bio">
            Trusted nationwide distributor since 2019. Providing certified low-voltage distribution switchboards, industrial automation components, and genuine electrical equipment.
          </p>

          <div class="ats-ft-badges-wrap">
            <span class="ats-ft-badge"><span class="ats-ft-badge-dot"></span>Schneider Authorized</span>
            <span class="ats-ft-badge"><span class="ats-ft-badge-dot"></span>Legrand Partner</span>
            <span class="ats-ft-badge"><span class="ats-ft-badge-dot"></span>GAE Group</span>
            <span class="ats-ft-badge"><span class="ats-ft-badge-dot"></span>Certified Panel Maker</span>
          </div>

          <div class="ats-ft-contact-list">
            <div class="ats-ft-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span><strong>Hotline:</strong> <a href="tel:03159178887">(031) 59178887</a> &bull; <a href="tel:03159173980">59173980</a></span>
            </div>

            <div class="ats-ft-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <span><strong>Email:</strong> <a href="mailto:sales@atstekno.com">sales@atstekno.com</a></span>
            </div>

            <div class="ats-ft-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span><strong>Hours:</strong> Mon&ndash;Fri 08:30&ndash;17:00 | Sat 08:30&ndash;14:00 WIB</span>
            </div>
          </div>
        </div>

        <!-- ================= COLUMN 2: CORE SOLUTIONS ================= -->
        <div class="ats-ft-col">
          <div class="ats-ft-col-header" data-i18n="footer.col2_header">Solutions</div>
          <ul class="ats-ft-nav-list">
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Low Voltage Switchboards (LVMDP)</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Motor Control Center (MCC &amp; VFD)</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Air Circuit Breakers (ACB) 630A&ndash;6300A</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Molded Case Circuit Breakers (MCCB)</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Variable Speed Drives (Altivar ATV)</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Automatic Transfer Switch (AMF-ATS)</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">Capacitor Banks &amp; Power Quality</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('products.index') }}">IP66 Weatherproof Enclosures</a></li>
          </ul>
        </div>

        <!-- ================= COLUMN 3: NAVIGATION & COMPANY ================= -->
        <div class="ats-ft-col">
          <div class="ats-ft-col-header" data-i18n="footer.col3_header">Company</div>
          <ul class="ats-ft-nav-list">
            <li class="ats-ft-nav-item"><a href="{{ route('about.index') }}">About ATS TEKNO</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('projects.index') }}">Flagship Engineering Projects</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('brands.index') }}">Authorized Brands &amp; Principals</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('articles.index') }}">Technical Articles &amp; Insights</a></li>
            <li class="ats-ft-nav-item"><a href="{{ route('contact.index') }}">Contact Engineering Team</a></li>
          </ul>
        </div>

        <!-- ================= COLUMN 4: OFFICES & SHOWROOMS ================= -->
        <div class="ats-ft-col">
          <div class="ats-ft-col-header" data-i18n="footer.col4_header">Showrooms &amp; Hubs</div>
          
          <div class="ats-ft-hub-card">
            <!-- Segmented Switcher Tabs -->
            <div class="ats-ft-tab-group" role="tablist">
              <button 
                type="button" 
                class="ats-ft-tab-btn active" 
                onclick="atsSwitchLocation('hq')" 
                id="btn-tab-hq" 
                role="tab" 
                aria-selected="true"
                data-i18n="footer.tab_hq"
              >
                Head Office
              </button>
              <button 
                type="button" 
                class="ats-ft-tab-btn" 
                onclick="atsSwitchLocation('sby')" 
                id="btn-tab-sby" 
                role="tab" 
                aria-selected="false"
                data-i18n="footer.tab_sby"
              >
                Surabaya Hub
              </button>
              <button 
                type="button" 
                class="ats-ft-tab-btn" 
                onclick="atsSwitchLocation('pandaan')" 
                id="btn-tab-pandaan" 
                role="tab" 
                aria-selected="false"
                data-i18n="footer.tab_pandaan"
              >
                Pandaan Hub
              </button>
            </div>

            <!-- Panel 1: Head Office Surabaya -->
            <div class="ats-ft-panel-item active" id="loc-panel-hq" role="tabpanel">
              <div class="ats-ft-loc-header">
                <span class="ats-ft-loc-title">Head Quarter (Galaxi)</span>
                <span class="ats-ft-loc-tag">Head Office</span>
              </div>
              <div class="ats-ft-loc-addr">
                Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya, East Java, Indonesia
              </div>
              <div class="ats-ft-loc-quick-bar">
                <a href="https://wa.me/6282223332830?text=Hello%20PT%20ATS%20Head%20Quarter" target="_blank" class="ats-ft-loc-wa-link">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883z"/></svg>
                  +62 822 2333 2830
                </a>
                <a href="tel:03159178887" class="ats-ft-loc-tel-link">Tel: (031) 59178887</a>
              </div>
              <div class="ats-ft-map-container">
                <a href="https://maps.google.com/?q=PT.+Anugerah+Tama+Sejati+Ruko+Galaxi+Bumi+Permai+J-1+No.+23+Surabaya" target="_blank" class="ats-ft-map-overlay-btn" title="Open in Google Maps">
                  Maps ↗
                </a>
                <iframe 
                  class="ats-ft-map-iframe"
                  src="https://maps.google.com/maps?q=PT.+Anugerah+Tama+Sejati+Ruko+Galaxi+Bumi+Permai+J-1+No.+23+Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Head Quarter Location Map"
                ></iframe>
              </div>
            </div>

            <!-- Panel 2: Showroom Jagalan Surabaya -->
            <div class="ats-ft-panel-item" id="loc-panel-sby" role="tabpanel">
              <div class="ats-ft-loc-header">
                <span class="ats-ft-loc-title">Jagalan Showroom</span>
                <span class="ats-ft-loc-tag">Component Showroom</span>
              </div>
              <div class="ats-ft-loc-addr">
                Jl. Jagalan No. 38, Bongkaran, Pabean Cantian, Surabaya, East Java
              </div>
              <div class="ats-ft-loc-quick-bar">
                <a href="https://wa.me/6282228882830?text=Hello%20PT%20ATS%20Surabaya%20Showroom" target="_blank" class="ats-ft-loc-wa-link">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883z"/></svg>
                  +62 822 2888 2830
                </a>
                <a href="tel:03199909120" class="ats-ft-loc-tel-link">Tel: (031) 99909120</a>
              </div>
              <div class="ats-ft-map-container">
                <a href="https://maps.google.com/?q=ATStekno+Jl.+Jagalan+No.+38+Bongkaran+Surabaya" target="_blank" class="ats-ft-map-overlay-btn" title="Open in Google Maps">
                  Maps ↗
                </a>
                <iframe 
                  class="ats-ft-map-iframe"
                  src="https://maps.google.com/maps?q=ATStekno+Jl.+Jagalan+No.+38+Bongkaran+Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Surabaya Showroom Map"
                ></iframe>
              </div>
            </div>

            <!-- Panel 3: Showroom Pandaan -->
            <div class="ats-ft-panel-item" id="loc-panel-pandaan" role="tabpanel">
              <div class="ats-ft-loc-header">
                <span class="ats-ft-loc-title">Pandaan Showroom</span>
                <span class="ats-ft-loc-tag">East Java Hub</span>
              </div>
              <div class="ats-ft-loc-addr">
                The Taman Dayu, Cluster Palazio Boulevard J-1 No. 06, Pandaan, Pasuruan
              </div>
              <div class="ats-ft-loc-quick-bar">
                <a href="https://wa.me/6288973783384?text=Hello%20PT%20ATS%20Pandaan%20Showroom" target="_blank" class="ats-ft-loc-wa-link">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883z"/></svg>
                  +62 889 7378 3384
                </a>
                <a href="tel:03434857758" class="ats-ft-loc-tel-link">Tel: (0343) 4857758</a>
              </div>
              <div class="ats-ft-map-container">
                <a href="https://maps.google.com/?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan+Pasuruan" target="_blank" class="ats-ft-map-overlay-btn" title="Open in Google Maps">
                  Maps ↗
                </a>
                <iframe 
                  class="ats-ft-map-iframe"
                  src="https://maps.google.com/maps?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan+Pasuruan&t=&z=15&ie=UTF8&iwloc=&output=embed"
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Pandaan Showroom Map"
                ></iframe>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- 4. Bottom Copyright Strip -->
    <div class="ats-footer-bottom">
      <div>
        <span class="ats-ft-bottom-brand">&copy; 2019 &ndash; {{ date('Y') }} PT. Anugerah Tama Sejati (ATS TEKNO).</span>
        <span data-i18n="footer.rights">All rights reserved.</span>
      </div>

      <div class="ats-ft-bottom-right">
        <span>Surabaya &bull; Pandaan &bull; East Java</span>
        <span>&bull;</span>
        <a href="mailto:sales@atstekno.com">sales@atstekno.com</a>
        <span>&bull;</span>
        <button type="button" class="ats-ft-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" aria-label="Back to top" data-i18n="footer.back_to_top">
          Back to Top &uarr;
        </button>
      </div>
    </div>

  </div>

</footer>

<script>
  // Interactive Showroom Switcher Logic
  function atsSwitchLocation(locId) {
    document.querySelectorAll('.ats-ft-tab-btn').forEach(btn => {
      btn.classList.remove('active');
      btn.setAttribute('aria-selected', 'false');
    });

    document.querySelectorAll('.ats-ft-panel-item').forEach(panel => {
      panel.classList.remove('active');
    });

    const targetBtn = document.getElementById('btn-tab-' + locId);
    const targetPanel = document.getElementById('loc-panel-' + locId);

    if (targetBtn) {
      targetBtn.classList.add('active');
      targetBtn.setAttribute('aria-selected', 'true');
    }
    if (targetPanel) {
      targetPanel.classList.add('active');
    }
  }
</script>
