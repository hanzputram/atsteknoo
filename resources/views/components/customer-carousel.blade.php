@props([
    'customers' => null,
])

@php
    $clientLogos = [
        [
            'name' => 'Bumi Menara Internusa',
            'logo' => asset('images/customers/bmi.png'),
            'alt'  => 'BMI Bumi Menara Internusa',
        ],
        [
            'name' => 'Charoen Pokphand',
            'logo' => asset('images/customers/pokphand.png'),
            'alt'  => 'Pokphand',
        ],
        [
            'name' => 'Indofood Sukses Makmur',
            'logo' => asset('images/customers/indofood.png'),
            'alt'  => 'Indofood',
        ],
        [
            'name' => 'Pakuwon Group',
            'logo' => asset('images/customers/pakuwon.png'),
            'alt'  => 'Pakuwon Group',
        ],
        [
            'name' => 'Dua Kelinci',
            'logo' => asset('images/customers/dua-kelinci.png'),
            'alt'  => 'Dua Kelinci',
        ],
    ];
@endphp

<!-- ========================================================
     FIGMA DESIGN: TRUSTED BY OVER 1,000+ COMPANY
     100% Pixel-Accurate to Figma Screenshot 1
     ======================================================== -->
<section class="trusted-by-section" id="trusted-by">
  <div class="trusted-by-container">
    
    <!-- Top Header Row -->
    <div class="trusted-header-grid">
      <!-- Left Column: Title & Counter -->
      <div class="trusted-title-wrap">
        <div class="trusted-line-one">
          <span class="trusted-label-over" data-i18n="trusted.over">Trusted By Over</span>
          <div class="trusted-red-rule" aria-hidden="true"></div>
        </div>
        <div class="trusted-line-two">
          <span class="trusted-counter-red"><span class="counter-val" data-target="1000">1,000</span>+</span>
          <span class="trusted-company-text" data-i18n="trusted.companies">Companies</span>
        </div>
      </div>

      <!-- Right Column: Subtitle Text -->
      <div class="trusted-subtitle-wrap">
        <p class="trusted-subtitle" data-i18n="trusted.subtitle">Support electrical needs across industries.</p>
      </div>
    </div>

    <!-- 5 Customer Logo Cards Grid -->
    <div class="trusted-cards-grid">
      @foreach($clientLogos as $client)
        <div class="trusted-logo-card" title="{{ $client['name'] }}">
          <img 
            src="{{ $client['logo'] }}" 
            alt="{{ $client['alt'] }}" 
            loading="lazy"
            class="trusted-logo-img"
          />
        </div>
      @endforeach
    </div>

  </div>
</section>

<style>
  /* ========================================================
     TRUSTED BY OVER 1,000+ COMPANY STYLES (FIGMA MATCH)
     ======================================================== */
  .trusted-by-section {
    width: 100%;
    max-width: 1200px;
    margin: 30px auto 10px auto;
    padding: 0 16px;
    box-sizing: border-box;
  }

  .trusted-by-container {
    width: 100%;
  }

  /* Header Row */
  .trusted-header-grid {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 24px;
    gap: 20px;
    flex-wrap: wrap;
  }

  .trusted-title-wrap {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 320px;
  }

  .trusted-line-one {
    display: flex;
    align-items: center;
    gap: 16px;
    width: 100%;
  }

  .trusted-label-over {
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: clamp(1.4rem, 2.2vw, 2rem);
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.02em;
    white-space: nowrap;
    line-height: 1.1;
  }

  .trusted-red-rule {
    flex: 1;
    max-width: 420px;
    height: 2.5px;
    background: #E11D48;
    border-radius: 9999px;
  }

  .trusted-line-two {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-top: 4px;
    padding-left: clamp(24px, 4vw, 55px);
  }

  .trusted-counter-red {
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: clamp(1.6rem, 2.5vw, 2.3rem);
    font-weight: 900;
    color: #E11D48;
    letter-spacing: -0.02em;
    line-height: 1.1;
  }

  .trusted-company-text {
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: clamp(1.4rem, 2.2vw, 2rem);
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.02em;
    line-height: 1.1;
  }

  .trusted-subtitle-wrap {
    display: flex;
    align-items: flex-end;
    padding-bottom: 4px;
  }

  .trusted-subtitle {
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: clamp(0.95rem, 1.2vw, 1.125rem);
    color: #334155;
    font-weight: 500;
    margin: 0;
    line-height: 1.4;
  }

  /* 5 Logo Cards Grid (Persis di Mockup) */
  .trusted-cards-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    width: 100%;
    box-sizing: border-box;
  }

  .trusted-logo-card {
    background: linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
    border: 1.5px solid #E2E8F0;
    border-radius: 22px;
    height: 140px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 24px;
    box-sizing: border-box;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.03);
    position: relative;
    overflow: hidden;
  }

  .trusted-logo-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(225, 29, 72, 0.4), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .trusted-logo-card:hover {
    transform: translateY(-6px);
    background: #FFFFFF;
    border-color: rgba(225, 29, 72, 0.35);
    box-shadow: 0 16px 32px -4px rgba(15, 23, 42, 0.08), 0 4px 14px rgba(225, 29, 72, 0.08);
  }

  .trusted-logo-card:hover::before {
    opacity: 1;
  }

  .trusted-logo-img {
    max-height: 64px;
    max-width: 85%;
    object-fit: contain;
    filter: none !important;
    transition: transform 0.3s ease;
  }

  .trusted-logo-card:hover .trusted-logo-img {
    transform: scale(1.05);
  }

  /* Responsive Breakpoints */
  @media (max-width: 992px) {
    .trusted-cards-grid {
      grid-template-columns: repeat(3, 1fr);
    }
    .trusted-red-rule {
      max-width: 260px;
    }
  }

  @media (max-width: 640px) {
    .trusted-cards-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
    }
    .trusted-logo-card {
      height: 110px;
      border-radius: 16px;
      padding: 14px;
    }
    .trusted-logo-img {
      max-height: 48px;
    }
    .trusted-header-grid {
      flex-direction: column;
      align-items: flex-start;
      gap: 12px;
    }
    .trusted-line-two {
      padding-left: 0;
    }
    .trusted-red-rule {
      display: none;
    }
  }
</style>

<script>
  // Subtle counter animation if target is present
  document.addEventListener('DOMContentLoaded', () => {
    const counter = document.querySelector('.trusted-counter-red .counter-val');
    if (!counter) return;

    let hasRun = false;
    const target = 1000;
    const duration = 1400;

    const runCounter = () => {
      const start = performance.now();
      const step = (now) => {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const ease = 1 - Math.pow(1 - progress, 4);
        const val = Math.floor(ease * target);
        counter.textContent = val.toLocaleString();
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          counter.textContent = "1,000";
        }
      };
      requestAnimationFrame(step);
    };

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && !hasRun) {
          hasRun = true;
          runCounter();
        }
      }, { threshold: 0.3 });
      const sec = document.getElementById('trusted-by');
      if (sec) observer.observe(sec);
    } else {
      runCounter();
    }
  });
</script>
