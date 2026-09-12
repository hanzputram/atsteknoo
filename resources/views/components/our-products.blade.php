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
    overflow: visible;
  }

  /* SVG Background Layer (Soft Clean White Shelf) */
  .figma-shelf-svg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    pointer-events: none;
    filter: drop-shadow(0 20px 40px rgba(15, 23, 42, 0.06)) drop-shadow(0 2px 8px rgba(15, 23, 42, 0.04));
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

  /* Kartu Produk (Dark Slate Gray dengan elevasi halus) */
  .figma-product-card {
    background: #4E545F;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 22px;
    width: 100%;
    height: 100%;
    padding: 22px 20px 18px 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.28s ease, box-shadow 0.28s ease;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.07);
    cursor: pointer;
    text-decoration: none;
    color: #FFFFFF;
    position: relative;
  }

  .figma-product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
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

  /* Label Kiri: Terpusat di sayap kiri notch */
  .shelf-label-left {
    position: absolute;
    left: 20%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-size: clamp(11px, 1.1vw, 15px);
    font-weight: 700;
    letter-spacing: clamp(0.05em, 0.08vw, 0.12em);
    color: #475569;
    text-transform: uppercase;
    white-space: nowrap;
    user-select: none;
    max-width: 30%;
    text-align: center;
  }

  /* Label Kanan: Terpusat di sayap kanan notch */
  .shelf-label-right {
    position: absolute;
    left: 80%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-size: clamp(11px, 1.1vw, 15px);
    font-weight: 700;
    letter-spacing: clamp(0.05em, 0.08vw, 0.12em);
    color: #475569;
    text-transform: uppercase;
    white-space: nowrap;
    user-select: none;
    max-width: 30%;
    text-align: center;
  }

  /* Tombol Tengah: Tepat di titik tengah plat notch (X = 50%, Y = 50% dari bar) */
  .shelf-buttons-center {
    position: absolute;
    left: 50%;
    top: 48%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    pointer-events: auto;
  }

  .shelf-buttons-pair {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 12px;
  }

  .figma-product-nav-btn {
    width: 50px;
    height: 50px;
    min-width: 50px;
    min-height: 50px;
    border-radius: 50%;
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    color: #0F172A;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .figma-product-nav-btn:hover {
    background: #0F172A;
    color: #FFFFFF;
    border-color: #0F172A;
    transform: scale(1.08);
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.14);
  }

  .figma-product-nav-btn:active {
    transform: scale(0.94);
  }

  .figma-product-nav-btn.swiper-button-disabled {
    opacity: 0.35;
    background: #F8FAFC;
    border-color: #E2E8F0;
    color: #94A3B8;
    cursor: not-allowed;
    pointer-events: none;
    box-shadow: none;
  }

  .shelf-label-mobile {
    display: none;
  }

  @media (max-width: 1024px) {
    .figma-shelf-bottom-bar {
      height: 84px;
    }
    .shelf-buttons-center {
      top: 58%;
    }
    .figma-product-nav-btn {
      width: 46px;
      height: 46px;
      min-width: 46px;
      min-height: 46px;
    }
  }

  @media (max-width: 860px) {
    .figma-products-outer {
      padding: 24px 16px;
      border-radius: 28px;
    }
    .figma-shelf-stage {
      aspect-ratio: auto;
      height: 500px;
    }
    .figma-shelf-cards-layer {
      bottom: 96px;
      top: 18px;
      left: 14px;
      right: 14px;
    }
    .figma-shelf-bottom-bar {
      height: 84px;
    }
    .shelf-buttons-center {
      top: 58%;
    }
    .shelf-label-left {
      left: 20%;
      top: 50%;
      font-size: 11px;
      letter-spacing: 0.06em;
    }
    .shelf-label-right {
      left: 80%;
      top: 50%;
      font-size: 11px;
      letter-spacing: 0.06em;
    }
    .figma-product-nav-btn {
      width: 46px;
      height: 46px;
      min-width: 46px;
      min-height: 46px;
    }
  }

  @media (max-width: 640px) {
    .figma-shelf-stage {
      height: 500px;
    }
    .figma-shelf-cards-layer {
      bottom: 106px;
      top: 14px;
      left: 12px;
      right: 12px;
    }
    .figma-shelf-bottom-bar {
      height: 98px;
    }
    .shelf-label-left,
    .shelf-label-right {
      display: none;
    }
    .shelf-buttons-center {
      flex-direction: column;
      gap: 8px;
      top: 48%;
    }
    .shelf-label-mobile {
      display: block;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 0.12em;
      color: #334155;
      text-transform: uppercase;
      text-align: center;
      user-select: none;
      white-space: nowrap;
    }
    .shelf-buttons-pair {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      gap: 14px;
    }
    /* Mobile nav button: larger, prominent, easy to tap (per user request) */
    .figma-product-nav-btn {
      width: 56px;
      height: 56px;
      min-width: 56px;
      min-height: 56px;
      border-radius: 50%;
      box-shadow: 0 6px 16px rgba(15, 23, 42, 0.12);
    }
    .figma-product-nav-btn svg {
      width: 24px;
      height: 24px;
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
          <span class="figma-products-pill-text" data-i18n="products.pill">Our Product</span>
          <span class="figma-products-red-bar" aria-hidden="true"></span>
        </div>
        <h2 class="figma-products-headline" data-i18n="products.headline">
          The right products<br>for every project.
        </h2>
      </div>

      <div class="figma-products-header-right">
        <p class="figma-products-subtitle" data-i18n="products.subtitle">
          Explore electrical essentials for power distribution, motor control, and industrial automation.
        </p>
      </div>
    </div>

    <!-- Shelf Stage Canvas -->
    <div class="figma-shelf-stage">
      
      <!-- Soft Clean White Shelf SVG with crisp border & subtle gradient -->
      <svg class="figma-shelf-svg" id="figmaShelfSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1312 622" preserveAspectRatio="none" fill="none">
        <defs>
          <linearGradient id="shelfBgGrad" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#FFFFFF" />
            <stop offset="100%" stop-color="#F8FAFC" />
          </linearGradient>
        </defs>
        <path 
          id="shelfBgPath"
          d="M64 0H1248C1283.35 0 1312 28.6538 1312 64V558C1312 593.346 1283.35 622 1248 622H841.2C812.286 622 786.738 603.18 778.167 575.565L773.541 560.66C767.697 541.832 750.278 529 730.563 529H581.437C561.722 529 544.303 541.832 538.459 560.66L533.833 575.565C525.262 603.18 499.714 622 470.8 622H64C28.6538 622 0 593.346 0 558V64C0 28.6538 28.6538 0 64 0Z" 
          fill="url(#shelfBgGrad)" 
          stroke="#E2E8F0" 
          stroke-width="1.5"
          vector-effect="non-scaling-stroke"
        />
      </svg>

      <!-- Content Layer: Swiper Kartu Produk duduk pas di atas notch tanpa jeda kosong -->
      <div class="figma-shelf-cards-layer">
        
        <!-- Swiper Slider Produk -->
        <div class="swiper product-swiper-container ourProductSwiper">
          <div class="swiper-wrapper">
            @php
              $shelfProducts = isset($bestSellerProducts) && count($bestSellerProducts) > 0
                ? $bestSellerProducts
                : (isset($featuredProducts) && count($featuredProducts) > 0
                    ? $featuredProducts
                    : \App\Models\Product::published()->with(['brand', 'mainImage'])->where('is_featured', true)->orderBy('sort_order')->orderBy('id', 'desc')->take(16)->get());

              if ($shelfProducts->isEmpty()) {
                $shelfProducts = \App\Models\Product::published()->with(['brand', 'mainImage'])->orderBy('sort_order')->orderBy('id', 'desc')->take(6)->get();
              }
            @endphp

            @forelse($shelfProducts as $product)
              @php
                $brandName = $product->brand ? $product->brand->name : 'ATS Tekno';
                $badgeStyle = '';
                if (stripos($brandName, 'Legrand') !== false) {
                  $badgeStyle = 'background: rgba(225,29,72,0.25); color: #FFE4E6;';
                } elseif (stripos($brandName, 'GAE') !== false) {
                  $badgeStyle = 'background: rgba(37,99,235,0.25); color: #DBEAFE;';
                }
                $productUrl = route('products.show', $product->slug);
              @endphp
              <div class="swiper-slide">
                <a href="{{ $productUrl }}" class="figma-product-card" title="Lihat detail {{ $product->name }}">
                  <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 2px;">
                      <span class="figma-product-badge" style="{{ $badgeStyle }}">{{ $brandName }}</span>
                      @if($product->sku)
                        <span style="font-size: 10.5px; font-family: monospace; color: #94A3B8; font-weight: 600; letter-spacing: 0.02em;">{{ $product->sku }}</span>
                      @endif
                    </div>

                    @if($product->main_image_url)
                      <div style="height: 125px; width: 100%; display: flex; align-items: center; justify-content: center; background: #ffffff; border-radius: 12px; margin-top: 10px; overflow: hidden; padding: 6px; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.05);">
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%; width: 100%; height: 100%; object-fit: contain;" onerror="this.onerror=null; this.parentElement.style.display='none';">
                      </div>
                    @endif

                    <div class="figma-product-name">{{ $product->name }}</div>
                    <div class="figma-product-desc">
                      {{ $product->short_description ?: Str::limit(strip_tags($product->description_html), 110) }}
                    </div>
                  </div>
                  <div class="figma-product-footer">
                    <span>Surabaya Ready Stock</span>
                    <span class="figma-product-cta">Request Quotation &rarr;</span>
                  </div>
                </a>
              </div>
            @empty
              <div class="swiper-slide">
                <div class="figma-product-card" style="justify-content: center; align-items: center; text-align: center;">
                  <div style="color: #CBD5E1; font-size: 14px;">Belum ada produk yang dipilih sebagai Best Seller.</div>
                </div>
              </div>
            @endforelse
          </div>
        </div>

      </div>

      <!-- Bottom Shelf Bar: Tepat bersarang di lekukan notch SVG (Persis Foto 2) -->
      <div class="figma-shelf-bottom-bar">
        <span class="shelf-label-left" data-i18n="products.shelf_label">OUR BEST SELLER PRODUCT</span>

        <!-- Center Notch with Round Buttons nestled in the notch curve -->
        <div class="shelf-buttons-center">
          <span class="shelf-label-mobile" data-i18n="products.shelf_label">OUR BEST SELLER PRODUCT</span>
          <div class="shelf-buttons-pair">
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
        </div>

        <span class="shelf-label-right" data-i18n="products.shelf_label">OUR BEST SELLER PRODUCT</span>
      </div>

    </div>

  </div>

</section>

<!-- INISIALISASI SWIPER & RESPONSIVE SHELF GEOMETRY -->
<script>
  (function() {
    function initShelf() {
      const stageEl = document.querySelector('.figma-shelf-stage');
      const svgEl = document.getElementById('figmaShelfSvg');
      const pathEl = document.getElementById('shelfBgPath');

      const desktopPath = "M64 0H1248C1283.35 0 1312 28.6538 1312 64V558C1312 593.346 1283.35 622 1248 622H841.2C812.286 622 786.738 603.18 778.167 575.565L773.541 560.66C767.697 541.832 750.278 529 730.563 529H581.437C561.722 529 544.303 541.832 538.459 560.66L533.833 575.565C525.262 603.18 499.714 622 470.8 622H64C28.6538 622 0 593.346 0 558V64C0 28.6538 28.6538 0 64 0Z";

      function updateShelfGeometry() {
        if (!stageEl || !svgEl || !pathEl) return;
        const w = stageEl.clientWidth;
        const h = stageEl.clientHeight;
        if (w <= 0 || h <= 0) return;

        // Desktop >= 1024px: Maintain exact baseline artwork
        if (w >= 1024) {
          svgEl.setAttribute('viewBox', '0 0 1312 622');
          pathEl.setAttribute('d', desktopPath);
          return;
        }

        // Tablet & Mobile: 1:1 responsive geometry preserving notch & corner ratios
        svgEl.setAttribute('viewBox', `0 0 ${w} ${h}`);
        const cornerR = w >= 640 ? 36 : 28;
        const notchDepth = w >= 640 ? 82 : 84;
        const notchPlateauW = w >= 640 ? 175 : 210;
        const chamferW = w >= 640 ? 46 : 36;

        const centerX = w / 2;
        const notchTopY = h - notchDepth;

        const pLeft = centerX - notchPlateauW / 2;
        const pRight = centerX + notchPlateauW / 2;
        const bLeft = Math.max(cornerR + 10, pLeft - chamferW);
        const bRight = Math.min(w - cornerR - 10, pRight + chamferW);

        const d = `M ${cornerR} 0 ` +
          `H ${w - cornerR} ` +
          `C ${w - cornerR * 0.45} 0 ${w} ${cornerR * 0.45} ${w} ${cornerR} ` +
          `V ${h - cornerR} ` +
          `C ${w} ${h - cornerR * 0.45} ${w - cornerR * 0.45} ${h} ${w - cornerR} ${h} ` +
          `H ${bRight} ` +
          `C ${bRight - chamferW * 0.4} ${h} ${pRight + chamferW * 0.4} ${notchTopY} ${pRight} ${notchTopY} ` +
          `H ${pLeft} ` +
          `C ${pLeft - chamferW * 0.4} ${notchTopY} ${bLeft + chamferW * 0.4} ${h} ${bLeft} ${h} ` +
          `H ${cornerR} ` +
          `C ${cornerR * 0.45} ${h} 0 ${h - cornerR * 0.45} 0 ${h - cornerR} ` +
          `V ${cornerR} ` +
          `C 0 ${cornerR * 0.45} ${cornerR * 0.45} 0 ${cornerR} 0 Z`;

        pathEl.setAttribute('d', d);
      }

      updateShelfGeometry();
      window.addEventListener('resize', updateShelfGeometry);

      new Swiper('.ourProductSwiper', {
        slidesPerView: 1.15,
        spaceBetween: 14,
        speed: 500,
        grabCursor: true,
        loop: false,
        navigation: {
          nextEl: '.product-next',
          prevEl: '.product-prev',
        },
        breakpoints: {
          480: {
            slidesPerView: 1.5,
            spaceBetween: 16,
          },
          640: {
            slidesPerView: 2.1,
            spaceBetween: 18,
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
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initShelf);
    } else {
      initShelf();
    }
  })();
</script>
