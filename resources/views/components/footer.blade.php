<style>
  /* ========================================================
     ATS INDUSTRIAL FOOTER (SKYLINE ARTWORK & 3 MAPS EMBED)
     ======================================================== */
  .ats-footer-wrapper {
    position: relative;
    width: 100%;
    margin-top: 60px;
    background: #001D34; /* Exact bottom color of skyline illustration */
    color: #F8FAFC;
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    overflow: hidden;
    box-sizing: border-box;
  }

  /* Skyline Artwork Banner at Top of Footer */
  .ats-footer-skyline-banner {
    position: relative;
    width: 100%;
    line-height: 0;
    overflow: hidden;
    background: transparent;
  }

  .ats-footer-skyline-img {
    width: 100%;
    height: auto;
    max-height: 320px;
    object-fit: cover;
    object-position: bottom center;
    display: block;
    pointer-events: none;
    user-select: none;
  }

  /* Brand Typography Overlay on the dark skyline base (Matches Foto 1) */
  .ats-footer-brand-overlay {
    position: absolute;
    bottom: 24px;
    left: 48px;
    z-index: 5;
  }

  .ats-footer-brand-title {
    font-size: clamp(1.25rem, 2.8vw, 1.85rem);
    font-weight: 800;
    letter-spacing: 0.04em;
    color: #FFFFFF;
    text-transform: uppercase;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    margin: 0;
    line-height: 1.15;
  }

  .ats-footer-brand-subtitle {
    font-size: clamp(0.75rem, 1.4vw, 0.95rem);
    font-weight: 600;
    letter-spacing: 0.16em;
    color: #94A3B8;
    text-transform: uppercase;
    margin-top: 4px;
    text-shadow: 0 1px 6px rgba(0, 0, 0, 0.5);
  }

  /* Main Footer Content Container */
  .ats-footer-body {
    max-width: 1360px;
    margin: 0 auto;
    padding: 30px 24px 40px 24px;
    box-sizing: border-box;
    position: relative;
    z-index: 10;
  }

  /* 4-Column Grid Layout (Foto 2) */
  .ats-footer-grid {
    display: grid;
    grid-template-columns: 1.15fr 1fr 1fr 1fr;
    gap: 22px;
    align-items: stretch;
  }

  /* Cards Styling */
  .ats-footer-card {
    background: rgba(255, 255, 255, 0.035);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 22px 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
  }

  .ats-footer-card:hover {
    border-color: rgba(244, 63, 94, 0.35);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.35);
  }

  /* Column 1: Contact Us & About Us Card */
  .ats-contact-header {
    font-size: 1.15rem;
    font-weight: 800;
    color: #E2E8F0;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 14px;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .ats-contact-group {
    margin-bottom: 12px;
  }

  .ats-contact-label {
    font-size: 0.8rem;
    font-weight: 700;
    color: #94A3B8;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 3px;
  }

  .ats-contact-val {
    font-size: 0.84rem;
    color: #F43F5E; /* Red accent matching Foto 2 */
    font-weight: 600;
    line-height: 1.45;
  }

  .ats-contact-val a {
    color: #F43F5E;
    text-decoration: none;
    transition: color 0.2s, text-decoration 0.2s;
  }

  .ats-contact-val a:hover {
    color: #FDA4AF;
    text-decoration: underline;
  }

  .ats-about-links {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-top: 4px;
  }

  .ats-about-link {
    font-size: 0.84rem;
    color: #F43F5E;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .ats-about-link:hover {
    color: #FDA4AF;
    transform: translateX(3px);
  }

  /* Location Cards (Head Quarter, Showroom Surabaya, Showroom Pandaan) */
  .ats-location-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #F43F5E; /* Red accent matching Foto 2 */
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
    gap: 6px;
    letter-spacing: -0.01em;
  }

  .ats-location-address {
    font-size: 0.83rem;
    color: #CBD5E1;
    line-height: 1.45;
    margin-bottom: 8px;
    min-height: 38px;
  }

  .ats-location-wa {
    font-size: 0.83rem;
    color: #F43F5E;
    font-weight: 700;
    margin-bottom: 8px;
    display: inline-block;
  }

  .ats-location-wa a {
    color: #F43F5E;
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-location-wa a:hover {
    color: #FDA4AF;
    text-decoration: underline;
  }

  .ats-location-copy {
    font-size: 0.72rem;
    color: #64748B;
    margin-bottom: 12px;
  }

  /* Map Embed Iframe Container */
  .ats-map-frame-box {
    position: relative;
    width: 100%;
    height: 230px;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: #0B253D;
    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  .ats-map-iframe {
    width: 100%;
    height: 100%;
    border: 0;
    filter: saturate(1.1) contrast(1.05);
    display: block;
  }

  /* Floating "Buka di Maps" Button */
  .ats-map-external-btn {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 10;
    background: #FFFFFF;
    color: #1E40AF;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 10px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
    transition: all 0.2s;
    user-select: none;
  }

  .ats-map-external-btn:hover {
    background: #F1F5F9;
    color: #1D4ED8;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.35);
  }

  /* Bottom Copyright Strip */
  .ats-footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    margin-top: 36px;
    padding-top: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 0.78rem;
    color: #94A3B8;
  }

  .ats-footer-bottom-brand {
    font-weight: 700;
    color: #F1F5F9;
  }

  .ats-footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 18px;
  }

  .ats-footer-bottom-links a {
    color: #94A3B8;
    text-decoration: none;
    transition: color 0.2s;
  }

  .ats-footer-bottom-links a:hover {
    color: #FFFFFF;
  }

  /* ================= RESPONSIVE DESIGN ================= */
  @media (max-width: 1200px) {
    .ats-footer-grid {
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .ats-footer-brand-overlay {
      left: 28px;
      bottom: 18px;
    }
  }

  @media (max-width: 768px) {
    .ats-footer-wrapper {
      margin-top: 40px;
    }
    .ats-footer-skyline-img {
      max-height: 200px;
    }
    .ats-footer-brand-overlay {
      left: 18px;
      bottom: 14px;
    }
    .ats-footer-body {
      padding: 20px 16px 30px 16px;
    }
    .ats-footer-grid {
      grid-template-columns: 1fr;
      gap: 18px;
    }
    .ats-location-address {
      min-height: auto;
    }
    .ats-map-frame-box {
      height: 210px;
    }
    .ats-footer-bottom {
      flex-direction: column;
      text-align: center;
      gap: 10px;
    }
  }
</style>

<!-- ================= ATS INDUSTRIAL FOOTER COMPONENT ================= -->
<footer class="ats-footer-wrapper" id="contact-locations">
  
  <!-- Skyline Banner Header (Foto 1: Electrical Grid, City Skyline & Substation) -->
  <div class="ats-footer-skyline-banner">
    <img 
      src="{{ asset('images/footer-skyline.png') }}" 
      alt="PT. Anugerah Tama Sejati - Industrial Electrical Supplier" 
      class="ats-footer-skyline-img"
      loading="lazy"
    >
    <div class="ats-footer-brand-overlay">
      <h2 class="ats-footer-brand-title">PT. ANUGERAH TAMA SEJATI</h2>
      <p class="ats-footer-brand-subtitle">ELECTRICAL SUPPLIER &bull; SURABAYA</p>
    </div>
  </div>

  <!-- Main Content Body (Foto 2: 4 Columns with Contact Details & 3 Embed Maps) -->
  <div class="ats-footer-body">
    <div class="ats-footer-grid">
      
      <!-- ================= COLUMN 1: CONTACT US & ABOUT US ================= -->
      <div class="ats-footer-card">
        <div>
          <div class="ats-contact-header">
            <span>📞</span> CONTACT US
          </div>

          <!-- Head Quarter Contact -->
          <div class="ats-contact-group">
            <div class="ats-contact-label">Head Quarter</div>
            <div class="ats-contact-val">
              <a href="tel:03159178887">031 59178887</a><br>
              <a href="tel:03159173980">031 59173980</a><br>
              <a href="https://wa.me/6282223332830?text=Halo%20PT%20ATS%20Head%20Quarter,%20saya%20ingin%20konsultasi%20komponen%20listrik" target="_blank">WA : +62 822 2333 2830</a>
            </div>
          </div>

          <!-- Showroom Surabaya Contact -->
          <div class="ats-contact-group">
            <div class="ats-contact-label">Showroom Surabaya</div>
            <div class="ats-contact-val">
              <a href="tel:03199909120">031 99909120</a><br>
              <a href="https://wa.me/6282228882830?text=Halo%20PT%20ATS%20Showroom%20Surabaya,%20saya%20ingin%20cek%20stok%20komponen" target="_blank">WA : +62 822 2888 2830</a>
            </div>
          </div>

          <!-- Showroom Pandaan Contact -->
          <div class="ats-contact-group">
            <div class="ats-contact-label">Showroom Pandaan</div>
            <div class="ats-contact-val">
              <a href="tel:03434857758">0343 4857758</a><br>
              <a href="https://wa.me/6288973783384?text=Halo%20PT%20ATS%20Showroom%20Pandaan,%20saya%20ingin%20konsultasi%20proyek" target="_blank">WA : +62 889 7378 3384</a>
            </div>
          </div>

          <!-- Email Contact -->
          <div class="ats-contact-group">
            <div class="ats-contact-label">Email</div>
            <div class="ats-contact-val">
              <a href="mailto:sales@atstekno.com">Email : sales@atstekno.com</a>
            </div>
          </div>
        </div>

        <!-- About Us Links -->
        <div style="margin-top: 14px; padding-top: 12px; border-top: 1px solid rgba(255, 255, 255, 0.08);">
          <div class="ats-contact-header" style="font-size: 1rem; margin-bottom: 8px; padding-bottom: 4px;">
            <span>ℹ️</span> ABOUT US
          </div>
          <div class="ats-about-links">
            <a href="#about" class="ats-about-link">&rarr; Our Story</a>
            <a href="#policy" class="ats-about-link">&rarr; Policy</a>
            <a href="#career" class="ats-about-link">&rarr; Career</a>
          </div>
        </div>
      </div>

      <!-- ================= COLUMN 2: HEAD QUARTER ================= -->
      <div class="ats-footer-card">
        <div>
          <h3 class="ats-location-title">
            <span>📍</span> Head Quarter
          </h3>
          <div class="ats-location-address">
            Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya
          </div>
          <div class="ats-location-wa">
            <a href="https://wa.me/6282223332830?text=Halo%20PT%20ATS%20Head%20Quarter" target="_blank">
              WA : +62 822 2333 2830
            </a>
          </div>
          <div class="ats-location-copy">
            &copy; 2019 &ndash; {{ date('Y') }} PT. Anugerah Tama Sejati
          </div>
        </div>

        <!-- Google Maps Embed 1: Head Quarter Surabaya -->
        <div class="ats-map-frame-box">
          <a 
            href="https://maps.google.com/?q=PT.+Anugerah+Tama+Sejati+Ruko+Galaxi+Bumi+Permai+J-1+No.+23+Surabaya" 
            target="_blank" 
            class="ats-map-external-btn"
            title="Buka lokasi di Google Maps"
          >
            Buka di Maps
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </a>
          <iframe 
            class="ats-map-iframe"
            src="https://maps.google.com/maps?q=PT.+Anugerah+Tama+Sejati+Ruko+Galaxi+Bumi+Permai+J-1+No.+23+Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Peta Lokasi Head Quarter PT. Anugerah Tama Sejati"
          ></iframe>
        </div>
      </div>

      <!-- ================= COLUMN 3: SHOWROOM SURABAYA ================= -->
      <div class="ats-footer-card">
        <div>
          <h3 class="ats-location-title">
            <span>🏬</span> Showroom Surabaya
          </h3>
          <div class="ats-location-address">
            Jl. Jagalan No. 38, Bongkaran Surabaya
          </div>
          <div class="ats-location-wa">
            <a href="https://wa.me/6282228882830?text=Halo%20PT%20ATS%20Showroom%20Surabaya" target="_blank">
              WA : +62 822 2888 2830
            </a>
          </div>
          <div class="ats-location-copy">
            &copy; 2019 &ndash; {{ date('Y') }} PT. Anugerah Tama Sejati
          </div>
        </div>

        <!-- Google Maps Embed 2: Showroom Surabaya (Jl. Jagalan) -->
        <div class="ats-map-frame-box">
          <a 
            href="https://maps.google.com/?q=ATStekno+Jl.+Jagalan+No.+38+Bongkaran+Surabaya" 
            target="_blank" 
            class="ats-map-external-btn"
            title="Buka lokasi di Google Maps"
          >
            Buka di Maps
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </a>
          <iframe 
            class="ats-map-iframe"
            src="https://maps.google.com/maps?q=ATStekno+Jl.+Jagalan+No.+38+Bongkaran+Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Peta Lokasi Showroom Surabaya PT. Anugerah Tama Sejati"
          ></iframe>
        </div>
      </div>

      <!-- ================= COLUMN 4: SHOWROOM PANDAAN ================= -->
      <div class="ats-footer-card">
        <div>
          <h3 class="ats-location-title">
            <span>🏭</span> Showroom Pandaan
          </h3>
          <div class="ats-location-address">
            The Taman Dayu, Cluster Palazio Boulevard, J-1No. 06, Pandaan, Pasuruan
          </div>
          <div class="ats-location-wa">
            <a href="https://wa.me/6288973783384?text=Halo%20PT%20ATS%20Showroom%20Pandaan" target="_blank">
              WA : +62 889 7378 3384
            </a>
          </div>
          <div class="ats-location-copy">
            &copy; 2019 &ndash; {{ date('Y') }} PT. Anugerah Tama Sejati
          </div>
        </div>

        <!-- Google Maps Embed 3: Showroom Pandaan (The Taman Dayu) -->
        <div class="ats-map-frame-box">
          <a 
            href="https://maps.google.com/?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan+Pasuruan" 
            target="_blank" 
            class="ats-map-external-btn"
            title="Open location in Google Maps"
          >
            Open in Maps
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </a>
          <iframe 
            class="ats-map-iframe"
            src="https://maps.google.com/maps?q=The+Taman+Dayu+Cluster+Palazio+Boulevard+Pandaan+Pasuruan&t=&z=15&ie=UTF8&iwloc=&output=embed"
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Peta Lokasi Showroom Pandaan PT. Anugerah Tama Sejati"
          ></iframe>
        </div>
      </div>

    </div>

    <!-- Bottom Copyright & Credential Strip -->
    <div class="ats-footer-bottom">
      <div>
        <span class="ats-footer-bottom-brand">&copy; 2019 &ndash; {{ date('Y') }} PT. Anugerah Tama Sejati (ATS TEKNO).</span>
        <span>Authorized Industrial Electrical Supplier &amp; Certified Panel Builder.</span>
      </div>
      <div class="ats-footer-bottom-links">
        <span>📍 Surabaya &bull; Pandaan</span>
        <span>&bull;</span>
        <a href="mailto:sales@atstekno.com">sales@atstekno.com</a>
        <span>&bull;</span>
        <a href="#contactModal" onclick="openContactModal(); return false;">Hotline Sales</a>
      </div>
    </div>

  </div>

</footer>
