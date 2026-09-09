<style>
  /* ========================================================
     FIGMA WIREFRAME: OUR PRODUCT (100% EXACT FOTO KE-2 MATCH)
     ======================================================== */
  .figma-our-products-wrapper {
    width: 100%;
    max-width: 1200px;
    margin: 24px auto;
    box-sizing: border-box;
  }

  /* Outer Slate Gray Container */
  .figma-products-outer {
    background: #8E94A0;
    border-radius: 40px;
    padding: 34px 30px 34px 30px;
    box-sizing: border-box;
    position: relative;
    box-shadow: none;
  }

  /* Header Grid (Two Columns persis Foto 1 & 2) */
  .figma-products-header-grid {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 24px;
    flex-wrap: wrap;
    padding: 0 4px;
  }

  .figma-products-header-left {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .figma-products-pill-label {
    display: inline-flex;
    align-items: center;
    gap: 14px;
  }

  .figma-products-pill-text {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0F172A;
    letter-spacing: -0.01em;
  }

  .figma-products-red-bar {
    display: inline-block;
    width: 46px;
    height: 6px;
    background: #E11D48;
    border-radius: 9999px;
  }

  .figma-products-headline {
    font-size: clamp(1.8rem, 3.2vw, 2.6rem);
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.03em;
    line-height: 1.18;
    margin: 0;
  }

  .figma-products-header-right {
    max-width: 440px;
    padding-bottom: 4px;
  }

  .figma-products-subtitle {
    font-size: clamp(0.95rem, 1.2vw, 1.1rem);
    color: #334155;
    font-weight: 500;
    line-height: 1.45;
    margin: 0;
  }

  /* Shelf Canvas Container: Rasio proporsi identik 1312x622 dari SVG */
  .figma-shelf-stage {
    position: relative;
    width: 100%;
    aspect-ratio: 1312 / 622;
    min-height: 520px;
    box-sizing: border-box;
    border-radius: 48px;
    overflow: hidden;
  }

  /* SVG Background Layer (Exact SVG dari Figma) */
  .figma-shelf-svg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    pointer-events: none;
  }

  /* Area Kartu Slider: Diberi jarak proporsional di dalam canvas shelf tanpa bocor di sudut */
  .figma-shelf-cards-layer {
    position: absolute;
    top: 24px;
    left: 44px;
    right: 44px;
    bottom: 23%; /* Jarak aman dan proporsional di atas lekukan notch SVG */
    z-index: 2;
    display: flex;
    align-items: stretch;
    overflow: hidden; /* Mencegah kartu tembus keluar sudut kiri & kanan shelf */
  }

  .product-swiper-container {
    width: 100%;
    height: 100% !important;
    padding-top: 18px !important; /* Ruang angkat hover tanpa pernah menyentuh batas overflow */
    padding-bottom: 18px !important; /* Ruang bayangan kartu tanpa terpotong */
    box-sizing: border-box;
    overflow: visible !important;
  }

  .product-swiper-container .swiper-slide {
    height: auto !important;
    display: flex;
    align-items: stretch;
    padding: 0 4px;
    box-sizing: border-box;
  }

  /* Kartu Produk (Dark Slate Gray persis seperti di Foto 2) */
  .figma-product-card {
    background: #4E545F;
    border-radius: 22px;
    width: 100%;
    height: 100%;
    padding: 22px 20px 18px 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.28s ease;
    box-shadow: none !important;
    cursor: pointer;
    text-decoration: none;
    color: #FFFFFF;
    position: relative;
  }

  .figma-product-card:hover {
    transform: translateY(-8px);
    box-shadow: none !important;
    background: #444A54;
  }

  .figma-product-badge {
    display: inline-block;
    align-self: flex-start;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    background: rgba(255, 255, 255, 0.14);
    color: #F8FAFC;
    backdrop-filter: blur(8px);
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  .figma-product-name {
    font-size: 1.25rem;
    font-weight: 800;
    line-height: 1.25;
    color: #FFFFFF;
    margin-top: 12px;
    letter-spacing: -0.01em;
  }

  .figma-product-desc {
    font-size: 0.82rem;
    color: #CBD5E1;
    line-height: 1.45;
    margin-top: 8px;
  }

  .figma-product-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 11px;
    color: #94A3B8;
  }

  .figma-product-cta {
    color: #FDA4AF;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s;
  }

  .figma-product-card:hover .figma-product-cta {
    color: #FFFFFF;
  }

  /* ========================================================
     BOTTOM NOTCH BAR (KOORDINAT MATEMATIS PERSIS FOTO 2)
     ======================================================== */
  .figma-shelf-bottom-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 15%; /* Pas 93px / 622px */
    z-index: 3;
    pointer-events: none;
  }

  /* Label Kiri: Terpusat di sayap kiri notch (X = 20.4%) */
  .shelf-label-left {
    position: absolute;
    left: 20.4%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-size: 20px;
    font-weight: 400;
    letter-spacing: 0.12em;
    color: #1E293B;
    text-transform: uppercase;
    white-space: nowrap;
    user-select: none;
  }

  /* Label Kanan: Terpusat di sayap kanan notch (X = 79.6%) */
  .shelf-label-right {
    position: absolute;
    left: 79.6%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-size: 20px;
    font-weight: 400;
    letter-spacing: 0.12em;
    color: #1E293B;
    text-transform: uppercase;
    white-space: nowrap;
    user-select: none;
  }

  /* Tombol Tengah: Tepat di titik tengah plat notch (X = 50%, Y = 50% dari bar) */
  .shelf-buttons-center {
    position: absolute;
    left: 50%;
    top: 48%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    gap: 12px;
    pointer-events: auto;
  }

  .figma-product-nav-btn {
    width: 95px;
    height: 65px;
    border-radius: 9999px;
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    color: #0F172A;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: none;
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .figma-product-nav-btn:hover {
    background: #0F172A;
    color: #FFFFFF;
    border-color: #0F172A;
    transform: scale(1.08);
    box-shadow: none;
  }

  .figma-product-nav-btn:active {
    transform: scale(0.94);
  }

  .figma-product-nav-btn.swiper-button-disabled {
    opacity: 0.4;
    background: #E2E8F0;
    border-color: #CBD5E1;
    color: #94A3B8;
    cursor: not-allowed;
    pointer-events: none;
    box-shadow: none;
  }

  @media (max-width: 860px) {
    .figma-products-outer {
      padding: 24px 16px;
      border-radius: 28px;
    }
    .figma-shelf-stage {
      aspect-ratio: auto;
      height: 520px;
    }
    .figma-shelf-cards-layer {
      bottom: 120px;
      top: 18px;
      left: 14px;
      right: 14px;
    }
    .figma-shelf-bottom-bar {
      height: 85px;
    }
    .shelf-label-left {
      left: 18%;
      font-size: 9px;
      letter-spacing: 0.08em;
    }
    .shelf-label-right {
      left: 82%;
      font-size: 9px;
      letter-spacing: 0.08em;
    }
    .figma-product-nav-btn {
      width: 42px;
      height: 42px;
    }
  }

  @media (max-width: 580px) {
    .shelf-label-left,
    .shelf-label-right {
      display: none; /* Sembunyikan label di HP kecil agar tidak bertubrukan */
    }
    .figma-product-nav-btn {
      width: 38px;
      height: 38px;
    }
  }
</style>

<!-- OUR PRODUCT SECTION (100% EXACT MATCH FOTO KE-2) -->
<section class="figma-our-products-wrapper" id="products">
  
  <!-- Outer Slate Gray Frame (#8E94A0) -->
    
    <!-- Figma Header Row: Two columns -->
    <div class="figma-products-header-grid">
      <div class="figma-products-header-left">
        <div class="figma-products-pill-label">
          <span class="figma-products-pill-text">Our Product</span>
          <span class="figma-products-red-bar" aria-hidden="true"></span>
        </div>
        <h2 class="figma-products-headline">
          The right products<br>for every project.
        </h2>
      </div>

      <div class="figma-products-header-right">
        <p class="figma-products-subtitle">
          Explore electrical essentials for power distribution, motor control, and industrial automation.
        </p>
      </div>
    </div>

    <!-- Shelf Stage Canvas -->
    <div class="figma-shelf-stage">
      
      <!-- Exact SVG Background from user with the curved bottom notch -->
      <svg class="figma-shelf-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1312 622" preserveAspectRatio="none" fill="none">
        <path d="M64 0H1248C1283.35 0 1312 28.6538 1312 64V558C1312 593.346 1283.35 622 1248 622H841.2C812.286 622 786.738 603.18 778.167 575.565L773.541 560.66C767.697 541.832 750.278 529 730.563 529H581.437C561.722 529 544.303 541.832 538.459 560.66L533.833 575.565C525.262 603.18 499.714 622 470.8 622H64C28.6538 622 0 593.346 0 558V64C0 28.6538 28.6538 0 64 0Z" fill="#D9D9D9"/>
      </svg>

      <!-- Content Layer: Swiper Kartu Produk duduk pas di atas notch tanpa jeda kosong -->
      <div class="figma-shelf-cards-layer">
        
        <!-- Swiper Slider Produk -->
        <div class="swiper product-swiper-container ourProductSwiper">
          <div class="swiper-wrapper">
            
            <!-- Product Card 1: MasterPact MTZ ACB -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">MasterPact MTZ / NT / NW</div>
                  <div class="figma-product-desc">Air Circuit Breakers (ACB) 630A up to 6300A, low-voltage primary electrical distribution protection.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Surabaya Ready Stock</span>
                  <span class="figma-product-cta">Request Quotation &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 2: ComPact NSX MCCB -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">ComPact NSX &amp; CVS</div>
                  <div class="figma-product-desc">Molded Case Circuit Breakers (MCCB) 16A up to 1600A, reliable for industrial distribution switchboards.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Surabaya Ready Stock</span>
                  <span class="figma-product-cta">Request Quotation &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 3: Altivar Inverter / VFD -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">Altivar ATV630 / ATV320</div>
                  <div class="figma-product-desc">Variable Speed Drives (VFD/Inverter) for precision industrial motor speed control &amp; energy savings.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Surabaya Ready Stock</span>
                  <span class="figma-product-cta">Request Quotation &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 4: TeSys D & F Contactors -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">TeSys D &amp; F Series</div>
                  <div class="figma-product-desc">Magnetic Contactors &amp; Overload Relays for motor starting from 9A up to 1000A premium grade.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Surabaya Ready Stock</span>
                  <span class="figma-product-cta">Request Quotation &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 5: Legrand Plexo Enclosures -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge" style="background: rgba(225,29,72,0.25); color: #FFE4E6;">Legrand Indonesia</span>
                  <div class="figma-product-name">Plexo™ IP66 &amp; Enclosures XL³</div>
                  <div class="figma-product-desc">Weatherproof IP66 industrial enclosure boxes, modular distribution, and industrial switches.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Surabaya Ready Stock</span>
                  <span class="figma-product-cta">Request Quotation &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 6: GAE Power Quality -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge" style="background: rgba(37,99,235,0.25); color: #DBEAFE;">GAE Group</span>
                  <div class="figma-product-name">Power Quality &amp; Metering</div>
                  <div class="figma-product-desc">Digital Energy Meters, Power Factor Capacitor Banks, Surge Protection, and Current Transformers (CT).</div>
                </div>
                <div class="figma-product-footer">
                  <span>Surabaya Ready Stock</span>
                  <span class="figma-product-cta">Request Quotation &rarr;</span>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Bottom Shelf Bar: Tepat bersarang di lekukan notch SVG (Persis Foto 2) -->
      <div class="figma-shelf-bottom-bar">
        <span class="shelf-label-left">OUR BEST SELLER PRODUCT</span>

        <!-- Center Notch with Round Buttons nestled in the notch curve -->
        <div class="shelf-buttons-center">
          <button type="button" class="figma-product-nav-btn product-prev" aria-label="Previous Product">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
          </button>
          <button type="button" class="figma-product-nav-btn product-next" aria-label="Next Product">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
          </button>
        </div>

        <span class="shelf-label-right">OUR BEST SELLER PRODUCT</span>
      </div>

    </div>

  </div>

</section>

<!-- INSIALISASI SWIPER OUR PRODUCT -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.ourProductSwiper', {
      slidesPerView: 1.2,
      spaceBetween: 16,
      speed: 500,
      grabCursor: true,
      loop: false,
      navigation: {
        nextEl: '.product-next',
        prevEl: '.product-prev',
      },
      breakpoints: {
        520: {
          slidesPerView: 1.8,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 2.4,
          spaceBetween: 18,
        },
        1024: {
          slidesPerView: 3.2,
          spaceBetween: 20,
        },
        1280: {
          slidesPerView: 3.6,
          spaceBetween: 22,
        }
      }
    });
  });
</script>
