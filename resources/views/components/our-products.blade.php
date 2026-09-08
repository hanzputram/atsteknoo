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
    box-shadow: 0 12px 36px rgba(15, 23, 42, 0.08);
  }

  /* Heading "Our Product" */
  .figma-products-title {
    font-size: clamp(1.8rem, 3.5vw, 2.5rem);
    font-weight: 800;
    color: #000000;
    letter-spacing: -0.025em;
    margin: 0 0 20px 6px;
    line-height: 1.15;
  }

  /* Shelf Canvas Container: Rasio proporsi identik 1312x622 dari SVG */
  .figma-shelf-stage {
    position: relative;
    width: 100%;
    aspect-ratio: 1312 / 622;
    min-height: 520px;
    box-sizing: border-box;
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

  /* Area Kartu Slider: Diberi jarak nyaman (breathing room) di atas notch SVG */
  .figma-shelf-cards-layer {
    position: absolute;
    top: 28px;
    left: 24px;
    right: 24px;
    bottom: 23%; /* Jarak lega dan proporsional di atas lekukan notch SVG */
    z-index: 2;
    display: flex;
    align-items: stretch;
  }

  .product-swiper-container {
    width: 100%;
    height: 100% !important;
  }

  /* Kartu Produk (Dark Slate Gray persis seperti di Foto 2) */
  .figma-product-card {
    background: #4E545F;
    border-radius: 22px;
    height: 100%;
    padding: 24px 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.14);
    cursor: pointer;
    text-decoration: none;
    color: #FFFFFF;
    position: relative;
    overflow: hidden;
  }

  .figma-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25);
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
    font-size: 11.5px;
    font-weight: 800;
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
    font-size: 11.5px;
    font-weight: 800;
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
    width: 48px;
    height: 48px;
    border-radius: 9999px;
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    color: #0F172A;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .figma-product-nav-btn:hover {
    background: #0F172A;
    color: #FFFFFF;
    border-color: #0F172A;
    transform: scale(1.08);
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.22);
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
    
    <!-- Title: "Our Product" -->
    <h2 class="figma-products-title">
      Our Product
    </h2>

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
                  <div class="figma-product-desc">Air Circuit Breakers (ACB) 630A s/d 6300A, proteksi jaringan listrik utama tegangan rendah.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Ready Stock Surabaya</span>
                  <span class="figma-product-cta">Minta Penawaran &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 2: ComPact NSX MCCB -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">ComPact NSX &amp; CVS</div>
                  <div class="figma-product-desc">Molded Case Circuit Breakers (MCCB) 16A s/d 1600A, handal untuk panel distribusi pabrik.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Ready Stock Surabaya</span>
                  <span class="figma-product-cta">Minta Penawaran &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 3: Altivar Inverter / VFD -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">Altivar ATV630 / ATV320</div>
                  <div class="figma-product-desc">Variable Speed Drives (VFD/Inverter) untuk kendali motor industri presisi &amp; hemat energi.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Ready Stock Surabaya</span>
                  <span class="figma-product-cta">Minta Penawaran &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 4: TeSys D & F Contactors -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge">Schneider Electric</span>
                  <div class="figma-product-name">TeSys D &amp; F Series</div>
                  <div class="figma-product-desc">Magnetic Contactors &amp; Overload Relays untuk starting motor 9A s/d 1000A kualitas premium.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Ready Stock Surabaya</span>
                  <span class="figma-product-cta">Minta Penawaran &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 5: Legrand Plexo Enclosures -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge" style="background: rgba(225,29,72,0.25); color: #FFE4E6;">Legrand Indonesia</span>
                  <div class="figma-product-name">Plexo™ IP66 &amp; Enclosures XL³</div>
                  <div class="figma-product-desc">Panel box industrial IP66 weatherproof, modular distribution, dan switch industri resmi Legrand.</div>
                </div>
                <div class="figma-product-footer">
                  <span>Ready Stock Surabaya</span>
                  <span class="figma-product-cta">Minta Penawaran &rarr;</span>
                </div>
              </div>
            </div>

            <!-- Product Card 6: GAE Power Quality -->
            <div class="swiper-slide">
              <div class="figma-product-card" onclick="openProductModal()">
                <div>
                  <span class="figma-product-badge" style="background: rgba(37,99,235,0.25); color: #DBEAFE;">GAE Group</span>
                  <div class="figma-product-name">Power Quality &amp; Metering</div>
                  <div class="figma-product-desc">Digital Energy Meters, Capacitor Banks, Surge Protection, dan Current Transformer (CT).</div>
                </div>
                <div class="figma-product-footer">
                  <span>Ready Stock Surabaya</span>
                  <span class="figma-product-cta">Minta Penawaran &rarr;</span>
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
          <button type="button" class="figma-product-nav-btn product-prev" aria-label="Produk Sebelumnya">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
          </button>
          <button type="button" class="figma-product-nav-btn product-next" aria-label="Produk Berikutnya">
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
