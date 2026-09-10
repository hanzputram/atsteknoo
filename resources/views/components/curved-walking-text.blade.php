@props([
    'text' => 'PT ANUGERAH TAMA SEJATI',
    'speed' => 1.2,
])

<!-- ========================================================
     CURVED WALKING TEXT PRO (100% UNSTRETCHED & UNCLIPPED)
     - Dynamic 1:1 ViewBox matching exact screen width (Zero Stretch)
     - Safe vertical envelope (Zero Clipping on top or bottom)
     - 100vw Full Bleed edge-to-edge
     - Pure White Background (#FFFFFF)
     ======================================================== -->
<section class="curved-walking-wrapper" id="curvedWalkingSection" aria-label="PT Anugerah Tama Sejati Walking Banner">
  <div class="curved-walking-container">
    <svg 
      id="curvedWalkingSvg" 
      viewBox="0 0 1440 170" 
      class="curved-walking-svg"
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs>
        <!-- Centerline path for ribbon and text: calculated dynamically for 1:1 zero distortion -->
        <path 
          id="curvedWalkingPath" 
          d="M -150 95 C 320 152, 680 142, 1020 95 C 1260 62, 1420 40, 1650 32" 
          fill="none" 
        />
      </defs>

      <!-- Crisp Solid Red Wave Ribbon Background (Exact ATS Brand Red #E11D48) -->
      <path 
        id="curvedWaveRibbonBg"
        d="M -150 95 C 320 152, 680 142, 1020 95 C 1260 62, 1420 40, 1650 32" 
        fill="none" 
        stroke="#E11D48" 
        stroke-width="58" 
        stroke-linecap="square"
        stroke-linejoin="round"
        class="wave-ribbon-bg"
      />

      <!-- Walking Text along the exact centerline of the ribbon -->
      <text class="curved-walking-typography" dominant-baseline="central">
        <textPath 
          id="curvedWalkingTextPath" 
          href="#curvedWalkingPath" 
          startOffset="0px"
        >
          PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp; PT ANUGERAH TAMA SEJATI &nbsp;&bull;&nbsp;
        </textPath>
      </text>
    </svg>
  </div>
</section>

<style>
  /* ========================================================
     CURVED WALKING TEXT STYLES (PURE FULL BLEED & CRISP WHITE)
     Zero horizontal scrollbar overflow via clientWidth alignment
     ======================================================== */
  .curved-walking-wrapper {
    position: relative;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 25px;
    padding: 0;
    background-color: #FFFFFF !important;
    overflow: hidden;
    user-select: none;
    box-sizing: border-box;
    display: block;
  }

  .curved-walking-container {
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
    background-color: #FFFFFF !important;
    overflow: hidden;
  }

  .curved-walking-svg {
    width: 100%;
    height: 170px;
    display: block;
    overflow: visible;
  }

  .wave-ribbon-bg {
    stroke: #E11D48;
  }

  .curved-walking-typography {
    fill: #FFFFFF;
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 18px;
    font-weight: 800;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    pointer-events: none;
  }

  @media (max-width: 768px) {
    .curved-walking-svg {
      height: 145px;
    }
    .curved-walking-typography {
      font-size: 16px;
      letter-spacing: 0.13em;
    }
    .wave-ribbon-bg {
      stroke-width: 50;
    }
  }

  @media (max-width: 480px) {
    .curved-walking-svg {
      height: 120px;
    }
    .curved-walking-typography {
      font-size: 14px;
      letter-spacing: 0.10em;
    }
    .wave-ribbon-bg {
      stroke-width: 44;
    }
  }
</style>

<script>
  /**
   * Framer-Inspired Dynamic Curved Walking Text Ticker Engine
   * Generates exact 1:1 unclipped and unstretched wave path matching client screen width.
   */
  (function() {
    function initCurvedWalkingText() {
      const svgEl = document.getElementById('curvedWalkingSvg');
      const textPathEl = document.getElementById('curvedWalkingTextPath');
      const pathDefEl = document.getElementById('curvedWalkingPath');
      const ribbonBgEl = document.getElementById('curvedWaveRibbonBg');
      const wrapperEl = document.getElementById('curvedWalkingSection');
      if (!svgEl || !textPathEl || !pathDefEl || !ribbonBgEl || !wrapperEl) return;

      // 1. Dynamic 1:1 Responsive Geometry & Full-Bleed Alignment (Zero horizontal scrollbar)
      function updateGeometry() {
        const clientWidth = Math.max(document.documentElement.clientWidth || window.innerWidth, 320);
        const height = clientWidth <= 480 ? 120 : (clientWidth <= 768 ? 145 : 170);

        // Align full bleed with clientWidth without exceeding scrollbar boundary
        if (wrapperEl.parentElement) {
          const parentRect = wrapperEl.parentElement.getBoundingClientRect();
          wrapperEl.style.width = clientWidth + 'px';
          wrapperEl.style.marginLeft = (-parentRect.left) + 'px';
        }
        
        svgEl.setAttribute('viewBox', `0 0 ${clientWidth} ${height}`);
        svgEl.style.height = height + 'px';

        // Safe vertical envelope calculations
        const yStart = height * 0.54;
        const yTroughCtrl1 = height * 0.88;
        const yTroughCtrl2 = height * 0.82;
        const yMid = height * 0.56;
        const yCrestCtrl = height * 0.26;
        const yEnd = height * 0.18;

        const pathData = `M -150 ${yStart.toFixed(1)} ` +
          `C ${(clientWidth * 0.22).toFixed(1)} ${yTroughCtrl1.toFixed(1)}, ` +
          `${(clientWidth * 0.46).toFixed(1)} ${yTroughCtrl2.toFixed(1)}, ` +
          `${(clientWidth * 0.68).toFixed(1)} ${yMid.toFixed(1)} ` +
          `C ${(clientWidth * 0.84).toFixed(1)} ${yCrestCtrl.toFixed(1)}, ` +
          `${(clientWidth * 0.94).toFixed(1)} ${(height * 0.22).toFixed(1)}, ` +
          `${(clientWidth + 150).toFixed(1)} ${yEnd.toFixed(1)}`;

        pathDefEl.setAttribute('d', pathData);
        ribbonBgEl.setAttribute('d', pathData);
      }

      updateGeometry();
      window.addEventListener('resize', updateGeometry);

      // 2. Continuous Walking Ticker
      const singlePhrase = 'PT ANUGERAH TAMA SEJATI   ✦   ';
      const repeats = 24;
      textPathEl.textContent = singlePhrase.repeat(repeats);

      let phraseLength = 440;
      try {
        const fullLength = textPathEl.getComputedTextLength();
        if (fullLength > 0) {
          phraseLength = fullLength / repeats;
        }
      } catch (e) {}

      let offset = 0;
      let speed = {{ $speed ?? 1.2 }};
      let isPaused = false;
      let isDragging = false;
      let startX = 0;
      let dragOffset = 0;

      wrapperEl.addEventListener('mouseenter', () => { isPaused = true; });
      wrapperEl.addEventListener('mouseleave', () => { isPaused = false; isDragging = false; });

      wrapperEl.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.clientX;
        dragOffset = offset;
      });
      window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        const delta = e.clientX - startX;
        offset = dragOffset + delta * 1.5;
        if (offset <= -phraseLength) offset += phraseLength;
        if (offset > 0) offset -= phraseLength;
        textPathEl.setAttribute('startOffset', offset + 'px');
      });
      window.addEventListener('mouseup', () => { isDragging = false; });

      wrapperEl.addEventListener('touchstart', (e) => {
        isDragging = true;
        startX = e.touches[0].clientX;
        dragOffset = offset;
      }, { passive: true });
      window.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        const delta = e.touches[0].clientX - startX;
        offset = dragOffset + delta * 1.5;
        if (offset <= -phraseLength) offset += phraseLength;
        if (offset > 0) offset -= phraseLength;
        textPathEl.setAttribute('startOffset', offset + 'px');
      }, { passive: true });
      window.addEventListener('touchend', () => { isDragging = false; });

      function step() {
        if (!isPaused && !isDragging) {
          offset -= speed;
          if (offset <= -phraseLength) {
            offset += phraseLength;
          }
          textPathEl.setAttribute('startOffset', offset.toFixed(2) + 'px');
        }
        requestAnimationFrame(step);
      }

      requestAnimationFrame(step);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initCurvedWalkingText);
    } else {
      initCurvedWalkingText();
    }
  })();
</script>
