<style>
  /* ========================================================
     ATS TEKNO - PREMIUM INDUSTRIAL FOOTER SYSTEM (MONOCHROME & WHITE)
     ======================================================== */
  :root {
    --ats-ft-bg-dark: #001D34;
    --ats-ft-bg-deep: #001322;
    --ats-ft-white: #FFFFFF;
    --ats-ft-slate-light: #F8FAFC;
    --ats-ft-slate-mid: #CBD5E1;
    --ats-ft-slate-muted: #94A3B8;
    --ats-ft-border: rgba(255, 255, 255, 0.1);
    --ats-ft-border-subtle: rgba(255, 255, 255, 0.06);
    --ats-ft-glass-bg: rgba(255, 255, 255, 0.035);
  }

  .ats-footer-wrapper {
    position: relative;
    width: 100%;
    align-self: stretch;
    margin-top: 60px;
    background: transparent;
    color: var(--ats-ft-slate-light);
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    overflow: hidden;
    box-sizing: border-box;
  }

  /* 1. Skyline Artwork Banner (Transparent Sky, Text Down on the Base) */
  .ats-footer-skyline-banner {
    position: relative;
    width: 100%;
    line-height: 0;
    overflow: hidden;
    background: transparent;
    margin-bottom: -1px; /* Seamless join with main footer section */
  }

  .ats-footer-skyline-img {
    width: 100%;
    height: auto;
    display: block;
    pointer-events: none;
    user-select: none;
  }



  /* 2. Main Footer Body Container */
  .ats-footer-main-section {
    width: 100%;
    background: linear-gradient(180deg, var(--ats-ft-bg-dark) 0%, var(--ats-ft-bg-deep) 100%);
    position: relative;
    z-index: 10;
  }

  /* Consultation & Action Strip */
  .ats-ft-cta-strip {
    max-width: 1400px;
    margin: 0 auto;
    padding: 24px 24px 18px 24px;
    box-sizing: border-box;
  }

  .ats-ft-cta-card {
    background: rgba(255, 255, 255, 0.045);
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 22px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
  }

  .ats-ft-cta-content h3 {
    font-size: 1.2rem;
    font-weight: 800;
    color: #FFFFFF;
    letter-spacing: -0.01em;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .ats-ft-cta-content h3 svg {
    color: #FFFFFF;
    flex-shrink: 0;
  }

  .ats-ft-cta-content p {
    font-size: 0.86rem;
    color: var(--ats-ft-slate-muted);
    margin: 0;
  }

  .ats-ft-cta-buttons {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  /* Crisp White Pill Button */
  .ats-ft-btn-white {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #FFFFFF;
    color: #0F172A;
    font-weight: 700;
    font-size: 0.88rem;
    padding: 11px 22px;
    border-radius: 12px;
    text-decoration: none;
    border: 1px solid #FFFFFF;
    transition: all 0.25s ease;
    box-shadow: 0 4px 16px rgba(255, 255, 255, 0.15);
  }

  .ats-ft-btn-white:hover {
    background: #F1F5F9;
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(255, 255, 255, 0.25);
    color: #000000;
  }

  .ats-ft-btn-white svg {
    color: #0F172A;
  }

  /* Frosted Glass Secondary Button */
  .ats-ft-btn-frosted {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.08);
    color: #FFFFFF;
    font-weight: 600;
    font-size: 0.88rem;
    padding: 11px 20px;
    border-radius: 12px;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.25s ease;
  }

  .ats-ft-btn-frosted:hover {
    background: rgba(255, 255, 255, 0.16);
    border-color: rgba(255, 255, 255, 0.35);
    color: #FFFFFF;
    transform: translateY(-2px);
  }

  .ats-ft-btn-frosted svg {
    color: #FFFFFF;
  }

  /* 3. Main Grid */
  .ats-footer-body {
    max-width: 1400px;
    margin: 0 auto;
    padding: 24px 24px 40px 24px;
    box-sizing: border-box;
  }

  .ats-footer-grid {
    display: grid;
    grid-template-columns: 1.15fr 0.9fr 0.9fr 1.35fr;
    gap: 30px;
    align-items: stretch;
  }

  /* Footer Headings */
  .ats-ft-col-title {
    font-size: 1rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    color: #FFFFFF;
    text-transform: uppercase;
    margin-bottom: 18px;
    padding-bottom: 8px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.16);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .ats-ft-col-title svg {
    color: #FFFFFF;
    flex-shrink: 0;
  }

  /* Column 1: Company Profile */
  .ats-ft-bio {
    font-size: 0.85rem;
    line-height: 1.6;
    color: var(--ats-ft-slate-muted);
    margin-bottom: 18px;
  }

  .ats-ft-badges-row {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-bottom: 20px;
  }

  .ats-ft-cert-badge {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 4px 9px;
    border-radius: 7px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.14);
    color: #FFFFFF;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .ats-ft-cert-badge svg {
    color: #FFFFFF;
  }

  .ats-ft-contact-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .ats-ft-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.84rem;
    color: var(--ats-ft-slate-mid);
  }

  .ats-ft-contact-item svg {
    flex-shrink: 0;
    margin-top: 3px;
    color: #FFFFFF;
    opacity: 0.9;
  }

  .ats-ft-contact-item a {
    color: var(--ats-ft-slate-mid);
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-ft-contact-item a:hover {
    color: #FFFFFF;
    text-decoration: underline;
  }

  /* Columns 2 & 3: Link Lists */
  .ats-ft-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .ats-ft-link-item a {
    font-size: 0.85rem;
    color: var(--ats-ft-slate-muted);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
  }

  .ats-ft-link-item a svg {
    color: rgba(255, 255, 255, 0.5);
    transition: transform 0.2s ease, color 0.2s ease;
    flex-shrink: 0;
  }

  .ats-ft-link-item a:hover {
    color: #FFFFFF;
    transform: translateX(4px);
  }

  .ats-ft-link-item a:hover svg {
    color: #FFFFFF;
    transform: translateX(2px);
  }

  /* Column 4: Interactive Multi-Location Hub */
  .ats-ft-location-hub {
    background: var(--ats-ft-glass-bg);
    border: 1px solid var(--ats-ft-border);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
  }

  /* Location Tab Switcher Buttons (Pure White Active State) */
  .ats-ft-loc-tabs {
    display: flex;
    gap: 6px;
    background: rgba(0, 0, 0, 0.3);
    padding: 4px;
    border-radius: 12px;
    margin-bottom: 14px;
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  .ats-ft-loc-tab-btn {
    flex: 1;
    background: transparent;
    border: none;
    color: var(--ats-ft-slate-muted);
    font-family: inherit;
    font-size: 0.79rem;
    font-weight: 700;
    padding: 8px 8px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.22s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    white-space: nowrap;
    outline: none;
  }

  .ats-ft-loc-tab-btn svg {
    color: currentColor;
  }

  .ats-ft-loc-tab-btn:hover {
    color: #FFFFFF;
    background: rgba(255, 255, 255, 0.07);
  }

  .ats-ft-loc-tab-btn.active {
    background: #FFFFFF;
    color: #0F172A;
    box-shadow: 0 3px 12px rgba(255, 255, 255, 0.2);
  }

  /* Tab Content Panels */
  .ats-ft-loc-panel {
    display: none;
    flex-direction: column;
    animation: atsFtFadeIn 0.3s ease;
  }

  .ats-ft-loc-panel.active {
    display: flex;
  }

  @keyframes atsFtFadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .ats-ft-loc-meta {
    margin-bottom: 12px;
  }

  .ats-ft-loc-title-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
  }

  .ats-ft-loc-name {
    font-size: 1rem;
    font-weight: 800;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .ats-ft-loc-tag {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #FFFFFF;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 3px 8px;
    border-radius: 6px;
  }

  .ats-ft-loc-address {
    font-size: 0.82rem;
    color: var(--ats-ft-slate-mid);
    line-height: 1.5;
    margin-bottom: 10px;
  }

  .ats-ft-loc-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  /* White Frosted WA button in card */
  .ats-ft-loc-wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    font-weight: 700;
    color: #FFFFFF;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.24);
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .ats-ft-loc-wa-btn:hover {
    background: #FFFFFF;
    color: #0F172A;
    border-color: #FFFFFF;
  }

  .ats-ft-loc-wa-btn:hover svg {
    color: #0F172A;
  }

  .ats-ft-loc-phone {
    font-size: 0.8rem;
    color: var(--ats-ft-slate-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-ft-loc-phone:hover {
    color: #FFFFFF;
  }

  /* Map Container */
  .ats-ft-map-box {
    position: relative;
    width: 100%;
    height: 175px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: #000E1A;
    margin-top: 10px;
    box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.4);
  }

  .ats-ft-map-iframe {
    width: 100%;
    height: 100%;
    border: 0;
    display: block;
    filter: saturate(0.9) contrast(1.05);
  }

  .ats-ft-map-direct-link {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(15, 23, 42, 0.9);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    color: #FFFFFF;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 9px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    transition: all 0.2s ease;
    z-index: 2;
  }

  .ats-ft-map-direct-link:hover {
    background: #FFFFFF;
    border-color: #FFFFFF;
    color: #0F172A;
  }

  .ats-ft-map-direct-link:hover svg {
    color: #0F172A;
  }

  /* 4. Bottom Footer Strip */
  .ats-footer-bottom {
    max-width: 1400px;
    margin: 0 auto;
    padding: 22px 24px 30px 24px;
    box-sizing: border-box;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 0.82rem;
    color: var(--ats-ft-slate-muted);
  }

  .ats-footer-bottom-brand {
    color: #FFFFFF;
    font-weight: 700;
  }

  .ats-footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  .ats-footer-bottom-links a {
    color: var(--ats-ft-slate-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-footer-bottom-links a:hover {
    color: #FFFFFF;
  }

  .ats-ft-scroll-top-btn {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.18);
    color: #FFFFFF;
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

  .ats-ft-scroll-top-btn:hover {
    background: #FFFFFF;
    border-color: #FFFFFF;
    color: #0F172A;
    transform: translateY(-2px);
  }

  .ats-ft-scroll-top-btn:hover svg {
    color: #0F172A;
  }

  /* ================= RESPONSIVE DESIGN ================= */
  @media (max-width: 1200px) {
    .ats-footer-grid {
      grid-template-columns: 1fr 1fr;
      gap: 28px;
    }
    .ats-ft-cta-card {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media (max-width: 768px) {
    .ats-footer-wrapper {
      margin-top: 40px;
    }
    .ats-footer-grid {
      grid-template-columns: 1fr;
      gap: 24px;
    }
    .ats-ft-cta-card {
      padding: 18px;
    }
    .ats-footer-bottom {
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 14px;
    }
    .ats-footer-bottom-links {
      justify-content: center;
    }
  }
</style>

<!-- ================= ATS INDUSTRIAL FOOTER COMPONENT ================= -->
<footer class="ats-footer-wrapper" id="contact-locations">
  
  <!-- 1. Skyline Artwork Banner (Clean Transparent Illustration) -->
  <div class="ats-footer-skyline-banner">
    <img 
      src="{{ asset('images/footer-skyline.png') }}" 
      alt="PT. Anugerah Tama Sejati - Industrial Electrical Supplier & Panel Builder" 
      class="ats-footer-skyline-img"
      loading="lazy"
    >
  </div>

  <!-- 2. Dark Industrial Footer Body -->
  <div class="ats-footer-main-section">

    <!-- Quick Action Consultation Strip (Clean White & Frosted Theme) -->
    <div class="ats-ft-cta-strip">
      <div class="ats-ft-cta-card">
        <div class="ats-ft-cta-content">
          <h3>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            Need Electrical Components or Industrial Panel Solutions?
          </h3>
          <p>
            Our technical team and sales engineers are ready to assist with power ratings, ampere sizing, and industrial project quotations.
          </p>
        </div>
        <div class="ats-ft-cta-buttons">
          <!-- WhatsApp Hotline Button in Crisp White -->
          <a href="https://wa.me/6282223332830?text=Hello%20PT%20ATS,%20I%20would%20like%20to%20consult%20about%20electrical%20components%20and%20panel%20solutions" target="_blank" class="ats-ft-btn-white">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.477-.15-.678.15-.201.301-.778.978-.954 1.179-.176.2-.351.226-.652.075-.301-.15-1.272-.469-2.423-1.496-.896-.799-1.501-1.786-1.677-2.087-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.176.201-.301.301-.502.1-.201.05-.377-.025-.527-.075-.15-.678-1.633-.929-2.235-.244-.587-.493-.507-.678-.517-.176-.01-.377-.01-.578-.01-.201 0-.527.075-.803.377s-1.054 1.03-1.054 2.511c0 1.482 1.079 2.911 1.23 3.112.15.201 2.124 3.244 5.146 4.55.719.311 1.28.497 1.718.636.722.23 1.379.197 1.899.12.579-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.176-1.431-.075-.126-.276-.201-.577-.351zM12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883zM12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.952 3.71 1.453 5.708 1.454h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0 0 20.488 3.48 11.82 11.82 0 0 0 12.05 0z"/></svg>
            WhatsApp Hotline
          </a>
          <!-- Request Quote / BoQ Button in Frosted Glass -->
          <a href="#contactModal" onclick="openContactModal(); return false;" class="ats-ft-btn-frosted">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Request BoQ / Quotation
          </a>
        </div>
      </div>
    </div>

    <!-- Main 4-Column Content Body -->
    <div class="ats-footer-body">
      <div class="ats-footer-grid">
        
        <!-- ================= COLUMN 1: PROFILE & CREDIBILITY ================= -->
        <div>
          <h3 class="ats-ft-col-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="2"/><line x1="15" y1="22" x2="15" y2="2"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
            PT. Anugerah Tama Sejati
          </h3>
          <p class="ats-ft-bio">
            Authorized electrical supplier and certified panel builder trusted since 2019. Providing end-to-end electrical solutions for industrial facilities, commercial complexes, and manufacturing plants across Indonesia.
          </p>

          <div class="ats-ft-badges-row">
            <span class="ats-ft-cert-badge">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              Schneider Authorized
            </span>
            <span class="ats-ft-cert-badge">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              Legrand Partner
            </span>
            <span class="ats-ft-cert-badge">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              GAE Group
            </span>
            <span class="ats-ft-cert-badge">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              Certified Panel Maker
            </span>
          </div>

          <div class="ats-ft-contact-list">
            <div class="ats-ft-contact-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <div>
                <strong>Head Office Hotline:</strong><br>
                <a href="tel:03159178887">(031) 59178887</a> &bull; <a href="tel:03159173980">(031) 59173980</a>
              </div>
            </div>

            <div class="ats-ft-contact-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <div>
                <strong>Official Email:</strong><br>
                <a href="mailto:sales@atstekno.com">sales@atstekno.com</a>
              </div>
            </div>

            <div class="ats-ft-contact-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <div>
                <strong>Operating Hours:</strong><br>
                Monday &ndash; Friday: 08:30 &ndash; 17:00 (GMT+7)<br>
                Saturday: 08:30 &ndash; 14:00 (GMT+7)
              </div>
            </div>
          </div>
        </div>

        <!-- ================= COLUMN 2: COMPONENT SOLUTIONS ================= -->
        <div>
          <h3 class="ats-ft-col-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            Component Solutions
          </h3>
          <ul class="ats-ft-links-list">
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Air Circuit Breakers (ACB)
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Molded Case Circuit Breakers (MCCB)
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Variable Speed Drives / Inverters
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Magnetic Contactors &amp; Overload Relays
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Capacitor Banks &amp; Power Quality
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Industrial Weatherproof Enclosures IP66
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Synchronizing Panels &amp; AMF-ATS
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#productModal" onclick="openProductModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Power Cables &amp; Busbar Accessories
              </a>
            </li>
          </ul>
        </div>

        <!-- ================= COLUMN 3: COMPANY & NAVIGATION ================= -->
        <div>
          <h3 class="ats-ft-col-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
            Company &amp; Navigation
          </h3>
          <ul class="ats-ft-links-list">
            <li class="ats-ft-link-item">
              <a href="{{ route('customers.index') }}">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Client &amp; Customer Portfolio
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="/#about">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                About PT. Anugerah Tama Sejati
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="/#certificates">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Certificates &amp; Authorization
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#contactModal" onclick="openContactModal(); return false;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Contact Engineering Team
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#policy">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Warranty &amp; Delivery Policy
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#career">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Careers at ATS TEKNO
              </a>
            </li>
            <li class="ats-ft-link-item">
              <a href="#faq">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                Frequently Asked Questions (FAQ)
              </a>
            </li>
          </ul>
        </div>

        <!-- ================= COLUMN 4: INTERACTIVE LOCATION HUB ================= -->
        <div>
          <h3 class="ats-ft-col-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Locations &amp; Showrooms
          </h3>

          <div class="ats-ft-location-hub">
            <!-- Location Switcher Tabs (Pure White Active State) -->
            <div class="ats-ft-loc-tabs" role="tablist">
              <button 
                type="button" 
                class="ats-ft-loc-tab-btn active" 
                onclick="atsSwitchLocation('hq')" 
                id="btn-tab-hq"
                role="tab" 
                aria-selected="true"
              >
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="2"/><line x1="15" y1="22" x2="15" y2="2"/><line x1="4" y1="12" x2="20" y2="12"/></svg>
                Head Quarter
              </button>
              <button 
                type="button" 
                class="ats-ft-loc-tab-btn" 
                onclick="atsSwitchLocation('sby')" 
                id="btn-tab-sby"
                role="tab" 
                aria-selected="false"
              >
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Surabaya
              </button>
              <button 
                type="button" 
                class="ats-ft-loc-tab-btn" 
                onclick="atsSwitchLocation('pandaan')" 
                id="btn-tab-pandaan"
                role="tab" 
                aria-selected="false"
              >
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4H2z"/></svg>
                Pandaan
              </button>
            </div>

            <!-- Panel 1: Head Quarter Surabaya -->
            <div class="ats-ft-loc-panel active" id="loc-panel-hq" role="tabpanel">
              <div class="ats-ft-loc-meta">
                <div class="ats-ft-loc-title-row">
                  <span class="ats-ft-loc-name">Head Quarter (Galaxi)</span>
                  <span class="ats-ft-loc-tag">Head Office</span>
                </div>
                <div class="ats-ft-loc-address">
                  Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya, East Java, Indonesia
                </div>
                <div class="ats-ft-loc-actions">
                  <a href="https://wa.me/6282223332830?text=Hello%20PT%20ATS%20Head%20Quarter,%20I%20would%20like%20to%20consult%20about%20a%20project" target="_blank" class="ats-ft-loc-wa-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.477-.15-.678.15-.201.301-.778.978-.954 1.179-.176.2-.351.226-.652.075-.301-.15-1.272-.469-2.423-1.496-.896-.799-1.501-1.786-1.677-2.087-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.176.201-.301.301-.502.1-.201.05-.377-.025-.527-.075-.15-.678-1.633-.929-2.235-.244-.587-.493-.507-.678-.517-.176-.01-.377-.01-.578-.01-.201 0-.527.075-.803.377s-1.054 1.03-1.054 2.511c0 1.482 1.079 2.911 1.23 3.112.15.201 2.124 3.244 5.146 4.55.719.311 1.28.497 1.718.636.722.23 1.379.197 1.899.12.579-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.176-1.431-.075-.126-.276-.201-.577-.351zM12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883zM12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.952 3.71 1.453 5.708 1.454h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0 0 20.488 3.48 11.82 11.82 0 0 0 12.05 0z"/></svg>
                    WA: +62 822 2333 2830
                  </a>
                  <a href="tel:03159178887" class="ats-ft-loc-phone">Tel: (031) 59178887</a>
                </div>
              </div>
              <div class="ats-ft-map-box">
                <a 
                  href="https://maps.google.com/?q=PT.+Anugerah+Tama+Sejati+Ruko+Galaxi+Bumi+Permai+J-1+No.+23+Surabaya" 
                  target="_blank" 
                  class="ats-ft-map-direct-link"
                  title="Open Head Quarter in Google Maps"
                >
                  Open in Maps
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
                <iframe 
                  class="ats-ft-map-iframe"
                  src="https://maps.google.com/maps?q=PT.+Anugerah+Tama+Sejati+Ruko+Galaxi+Bumi+Permai+J-1+No.+23+Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Head Quarter Location Map - PT. Anugerah Tama Sejati"
                ></iframe>
              </div>
            </div>

            <!-- Panel 2: Showroom Jagalan Surabaya -->
            <div class="ats-ft-loc-panel" id="loc-panel-sby" role="tabpanel">
              <div class="ats-ft-loc-meta">
                <div class="ats-ft-loc-title-row">
                  <span class="ats-ft-loc-name">Jagalan Showroom</span>
                  <span class="ats-ft-loc-tag">Component Showroom</span>
                </div>
                <div class="ats-ft-loc-address">
                  Jl. Jagalan No. 38, Bongkaran, Pabean Cantian, Surabaya, East Java, Indonesia
                </div>
                <div class="ats-ft-loc-actions">
                  <a href="https://wa.me/6282228882830?text=Hello%20PT%20ATS%20Surabaya%20Showroom,%20I%20would%20like%20to%20check%20component%20stock" target="_blank" class="ats-ft-loc-wa-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.477-.15-.678.15-.201.301-.778.978-.954 1.179-.176.2-.351.226-.652.075-.301-.15-1.272-.469-2.423-1.496-.896-.799-1.501-1.786-1.677-2.087-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.176.201-.301.301-.502.1-.201.05-.377-.025-.527-.075-.15-.678-1.633-.929-2.235-.244-.587-.493-.507-.678-.517-.176-.01-.377-.01-.578-.01-.201 0-.527.075-.803.377s-1.054 1.03-1.054 2.511c0 1.482 1.079 2.911 1.23 3.112.15.201 2.124 3.244 5.146 4.55.719.311 1.28.497 1.718.636.722.23 1.379.197 1.899.12.579-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.176-1.431-.075-.126-.276-.201-.577-.351zM12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883zM12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.952 3.71 1.453 5.708 1.454h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0 0 20.488 3.48 11.82 11.82 0 0 0 12.05 0z"/></svg>
                    WA: +62 822 2888 2830
                  </a>
                  <a href="tel:03199909120" class="ats-ft-loc-phone">Tel: (031) 99909120</a>
                </div>
              </div>
              <div class="ats-ft-map-box">
                <a 
                  href="https://maps.google.com/?q=ATStekno+Jl.+Jagalan+No.+38+Bongkaran+Surabaya" 
                  target="_blank" 
                  class="ats-ft-map-direct-link"
                  title="Open Surabaya Showroom in Google Maps"
                >
                  Open in Maps
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
                <iframe 
                  class="ats-ft-map-iframe"
                  src="https://maps.google.com/maps?q=ATStekno+Jl.+Jagalan+No.+38+Bongkaran+Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Jagalan Surabaya Showroom Location Map"
                ></iframe>
              </div>
            </div>

            <!-- Panel 3: Showroom Pandaan -->
            <div class="ats-ft-loc-panel" id="loc-panel-pandaan" role="tabpanel">
              <div class="ats-ft-loc-meta">
                <div class="ats-ft-loc-title-row">
                  <span class="ats-ft-loc-name">Pandaan Showroom</span>
                  <span class="ats-ft-loc-tag">East Java Branch</span>
                </div>
                <div class="ats-ft-loc-address">
                  The Taman Dayu, Cluster Palazio Boulevard, J-1 No. 06, Pandaan, Pasuruan, East Java, Indonesia
                </div>
                <div class="ats-ft-loc-actions">
                  <a href="https://wa.me/6288973783384?text=Hello%20PT%20ATS%20Pandaan%20Showroom,%20I%20would%20like%20to%20consult%20about%20stock" target="_blank" class="ats-ft-loc-wa-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.477-.15-.678.15-.201.301-.778.978-.954 1.179-.176.2-.351.226-.652.075-.301-.15-1.272-.469-2.423-1.496-.896-.799-1.501-1.786-1.677-2.087-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.176.201-.301.301-.502.1-.201.05-.377-.025-.527-.075-.15-.678-1.633-.929-2.235-.244-.587-.493-.507-.678-.517-.176-.01-.377-.01-.578-.01-.201 0-.527.075-.803.377s-1.054 1.03-1.054 2.511c0 1.482 1.079 2.911 1.23 3.112.15.201 2.124 3.244 5.146 4.55.719.311 1.28.497 1.718.636.722.23 1.379.197 1.899.12.579-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.176-1.431-.075-.126-.276-.201-.577-.351zM12.05 21.785h-.007a9.87 9.87 0 0 1-5.034-1.377l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.512-5.26c.002-5.45 4.437-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.883-9.88 9.883zM12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.952 3.71 1.453 5.708 1.454h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0 0 20.488 3.48 11.82 11.82 0 0 0 12.05 0z"/></svg>
                    WA: +62 889 7378 3384
                  </a>
                  <a href="tel:03434857758" class="ats-ft-loc-phone">Tel: (0343) 4857758</a>
                </div>
              </div>
              <div class="ats-ft-map-box">
                <a 
                  href="https://maps.google.com/?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan+Pasuruan" 
                  target="_blank" 
                  class="ats-ft-map-direct-link"
                  title="Open Pandaan Showroom in Google Maps"
                >
                  Open in Maps
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
                <iframe 
                  class="ats-ft-map-iframe"
                  src="https://maps.google.com/maps?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan+Pasuruan&t=&z=15&ie=UTF8&iwloc=&output=embed"
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Pandaan Showroom Location Map"
                ></iframe>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- 4. Bottom Copyright & Status Strip -->
    <div class="ats-footer-bottom">
      <div>
        <span class="ats-footer-bottom-brand">&copy; 2019 &ndash; {{ date('Y') }} PT. Anugerah Tama Sejati (ATS TEKNO).</span>
        <span>Authorized Electrical Supplier &amp; Industrial Panel Builder.</span>
      </div>

      <div class="ats-footer-bottom-links">
        <span>Surabaya &bull; Pandaan &bull; East Java, Indonesia</span>
        <span>&bull;</span>
        <a href="mailto:sales@atstekno.com">sales@atstekno.com</a>
        <span>&bull;</span>
        <button type="button" class="ats-ft-scroll-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" aria-label="Back to top">
          Back to Top
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
        </button>
      </div>
    </div>

  </div>

</footer>

<script>
  // Interactive Location Hub Switcher Logic
  function atsSwitchLocation(locId) {
    // 1. Reset all tab buttons
    document.querySelectorAll('.ats-ft-loc-tab-btn').forEach(btn => {
      btn.classList.remove('active');
      btn.setAttribute('aria-selected', 'false');
    });

    // 2. Hide all panels
    document.querySelectorAll('.ats-ft-loc-panel').forEach(panel => {
      panel.classList.remove('active');
    });

    // 3. Activate selected tab & panel
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
