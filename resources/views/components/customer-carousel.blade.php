@props([
    'customers' => null,
    'count' => 1000,
])

@php
    // Fallback data customer
    $baseCustomers = $customers ?? [
        [
            'id'       => 1,
            'name'     => 'Indofood Sukses Makmur',
            'tag'      => 'FMCG',
            'logo'     => asset('images/customers/indofood.png'),
            'subtitle' => 'Schneider Automation & Inverter Line',
        ],
        [
            'id'       => 2,
            'name'     => 'Dua Kelinci',
            'tag'      => 'Confectionery',
            'logo'     => asset('images/customers/dua-kelinci.png'),
            'subtitle' => 'Motor Protection & TeSys Control',
        ],
        [
            'id'       => 3,
            'name'     => 'Pakuwon Group',
            'tag'      => 'Property',
            'logo'     => asset('images/customers/pakuwon.png'),
            'subtitle' => 'Mega Superblock & Distribution Switchgear',
        ],
        [
            'id'       => 4,
            'name'     => 'Bumi Menara Internusa',
            'tag'      => 'Cold Storage',
            'logo'     => asset('images/customers/bmi.png'),
            'subtitle' => 'Power Quality & Corrosion-Resistant Breakers',
        ],
        [
            'id'       => 5,
            'name'     => 'Charoen Pokphand',
            'tag'      => 'Agro-Industry',
            'logo'     => asset('images/customers/pokphand.png'),
            'subtitle' => 'Feedmill Control & Distribution Panels',
        ],
    ];

    // Duplikasi data agar Swiper loop berjalan mulus di dalam 5 slot
    $displayCustomers = array_merge($baseCustomers, $baseCustomers, $baseCustomers);
@endphp

<!-- Swiper CSS via CDN -->
@once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endonce

<style>
  /* ========================================================
     CUSTOMER CAROUSEL: STRICT 5-CARD VIEWPORT (NO OVERFLOW ON ZOOM OUT)
     ======================================================== */
  .figma-customer-section {
    position: relative;
    width: 100%;
    max-width: 1200px; /* Terkunci rapi sesuai lebar grid desktop */
    margin: 0 auto;
    padding: 16px 0 10px 0;
    box-sizing: border-box;
    overflow: hidden !important; /* HIDE SEMUA KARTU DI LUAR FRAME SAAT ZOOM OUT */
  }

  /* Swiper viewport: overflow hidden memotong semua slide samping saat zoom out */
  .figma-customer-swiper {
    width: 100%;
    padding-top: 36px !important;
    padding-bottom: 24px !important;
    overflow: hidden !important; /* HIDE SLIDE EKSTRA */
    box-sizing: border-box;
  }

  /* Slide Samping (Kartu 1, 2, 4, 5): Posisi dasar */
  .figma-customer-swiper .swiper-slide {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    transition: transform 0.45s cubic-bezier(0.22, 1, 0.36, 1),
                opacity 0.4s ease;
    opacity: 0.8;
    will-change: transform, opacity;
  }

  /* Kartu Kotak Abu-abu Bersih (Persis seperti di wireframe) */
  .figma-customer-card {
    position: relative;
    width: 100%;
    height: 180px;
    border-radius: 20px;
    background: #D8DCE3;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 18px;
    box-sizing: border-box;
    transition: all 0.45s cubic-bezier(0.22, 1, 0.36, 1);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
  }

  /* Kartu Tengah (Active Slide): TERANGKAT KE ATAS & TINGGI */
  .figma-customer-swiper .swiper-slide-active {
    opacity: 1 !important;
    z-index: 10;
  }

  .figma-customer-swiper .swiper-slide-active .figma-customer-card {
    height: 225px !important;
    transform: translateY(-22px) !important;
    background: #E2E6ED !important;
    box-shadow: 0 16px 36px -8px rgba(15, 23, 42, 0.12) !important;
  }

  /* Logo Perusahaan */
  .figma-card-logo {
    max-height: 68px;
    max-width: 80%;
    object-fit: contain;
    filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.04));
    transition: transform 0.3s ease;
  }

  .figma-customer-swiper .swiper-slide-active .figma-card-logo {
    max-height: 82px;
    transform: scale(1.04);
  }

  /* Label Nama Customer di Bawah Kartu: HANYA MUNCUL DI KARTU TENGAH SEPERTI DI FIGMA */
  .figma-customer-caption {
    font-size: 13px;
    font-weight: 800;
    color: #0F172A;
    text-align: center;
    margin-top: 8px;
    letter-spacing: -0.01em;
    height: 20px;
    line-height: 20px;
    transition: opacity 0.35s ease, transform 0.35s ease;
  }

  .figma-customer-swiper .swiper-slide-active .figma-customer-caption {
    opacity: 1;
    transform: translateY(-16px);
  }

  .figma-customer-swiper .swiper-slide:not(.swiper-slide-active) .figma-customer-caption {
    opacity: 0;
    transform: translateY(0);
    pointer-events: none;
  }
</style>

<!-- SECTION WRAPPER -->
<section class="figma-customer-section" id="clients">
  <div style="width: 100%; margin: 0 auto; box-sizing: border-box; overflow: hidden;">

    <!-- Minimalist Centered Header with Counter Effect (Persis Mockup) -->
    <div style="text-align: center; margin-bottom: 8px;">
      <h2 style="font-size: clamp(1.75rem, 3.5vw, 2.5rem); font-weight: 800; color: #0F172A; letter-spacing: -0.025em; margin: 0; line-height: 1.2;">
        Trusted By Over <span class="customer-counter-number" data-target="{{ $count }}" style="color: #0F172A; font-weight: 800; font-variant-numeric: tabular-nums;">0</span>+ Companies
      </h2>
    </div>

    <!-- SWIPER CAROUSEL: TEPAT 5 KARTU, TERKUNCI OVERFLOW HIDDEN -->
    <div style="position: relative; width: 100%; overflow: hidden;">
      <div class="swiper figma-customer-swiper customerSwiper">
        <div class="swiper-wrapper">
          
          @foreach($displayCustomers as $customer)
            <div class="swiper-slide">
              
              <!-- Rounded Card Visual -->
              <div class="figma-customer-card">
                <img 
                  src="{{ $customer['logo'] }}" 
                  alt="Logo {{ $customer['name'] }}" 
                  loading="lazy"
                  class="figma-card-logo"
                />
              </div>

              <!-- Label Nama Klien (Hanya muncul di kartu tengah seperti 'Pakuwon Group' di mockup) -->
              <div class="figma-customer-caption">
                {{ $customer['name'] }}
              </div>

            </div>
          @endforeach

        </div>
      </div>
    </div>

  </div>
</section>

<!-- Swiper JS via CDN -->
@once
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endonce

<!-- JAVASCRIPT: SWIPER 5-SLIDES & COUNTER ANIMATION -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 1. Inisialisasi Counter Effect untuk "1000+"
    const counterEl = document.querySelector('.customer-counter-number');
    if (counterEl) {
      let counterStarted = false;
      const target = parseInt(counterEl.getAttribute('data-target') || '1000', 10);
      const duration = 1600;

      const animateCount = () => {
        const startTime = performance.now();
        const step = (now) => {
          const elapsed = now - startTime;
          const progress = Math.min(elapsed / duration, 1);
          const easeOut = 1 - Math.pow(1 - progress, 4);
          const current = Math.floor(easeOut * target);
          
          counterEl.textContent = current;

          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            counterEl.textContent = target;
          }
        };
        requestAnimationFrame(step);
      };

      if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting && !counterStarted) {
              counterStarted = true;
              animateCount();
            }
          });
        }, { threshold: 0.2 });

        const targetSection = document.getElementById('clients');
        if (targetSection) observer.observe(targetSection);
      } else {
        animateCount();
      }
    }

    // 2. Inisialisasi Swiper Centered 5-Slides (Menampilkan 5 kartu di Desktop, kartu ke-3 selalu di tengah)
    const customerSwiper = new Swiper('.customerSwiper', {
      centeredSlides: true,
      loop: true,
      initialSlide: 2, // Pakuwon Group tepat di tengah mula-mula
      speed: 600,
      grabCursor: true,
      slideToClickedSlide: true,
      spaceBetween: 16,

      // Mobile: 1 - 2 kartu
      slidesPerView: 1.4,

      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },

      breakpoints: {
        480: {
          slidesPerView: 2.1,
          spaceBetween: 16,
        },
        640: {
          slidesPerView: 3.1,
          spaceBetween: 18,
        },
        768: {
          slidesPerView: 3.8,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 5, // Tepat 5 kartu di Desktop persis seperti mockup Figma
          spaceBetween: 18,
        },
        1280: {
          slidesPerView: 5, // Tetap 5 kartu di Desktop layar lebar (tidak akan meluber saat zoom-out)
          spaceBetween: 20,
        }
      },

      on: {
        init: function () {
          this.update();
        },
      }
    });
  });
</script>
