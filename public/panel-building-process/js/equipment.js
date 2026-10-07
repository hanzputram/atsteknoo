/**
 * ATS Tekno — Machinery Fleet Studio controller (#equipment)
 * Clean light industrial studio: tab switching, auto fleet tour, 3D orbit drag,
 * real-time telemetry HUD, 3D tilt photo card, and accessible zoom lightbox.
 */
(() => {
  'use strict';

  const sec = document.getElementById('equipment');
  if (!sec) return;
  sec.classList.add('js');

  const $ = (s, c = sec) => c.querySelector(s);
  const $$ = (s, c = sec) => Array.from(c.querySelectorAll(s));
  const clamp = (v, a, b) => Math.min(b, Math.max(a, v));
  const lerp = (a, b, t) => a + (b - a) * t;
  const pad = (n, l = 2) => String(Math.round(n)).padStart(l, '0');
  const easeOutExpo = t => (t >= 1 ? 1 : 1 - Math.pow(2, -10 * t));

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const slides = $$('.eq-slide');
  const tabs = $$('.eq-tab');
  const photos = $$('.eq-photo');
  const panels = $$('.eq-panel-slide');
  const n = slides.length;
  if (!n) return;

  const studio = $('#eq-studio');
  const viewport = $('#eq-viewport');
  const canvas = $('#eq-canvas');
  const card = $('#eq-photo-card');
  const tourBtn = $('#eq-tour-btn');
  const tourText = $('#eq-tour-text');

  /* ------------------------------------------------------------------
     Count-up animation
  ------------------------------------------------------------------ */
  function countTo(el, to, dur = 1000) {
    if (!el) return;
    cancelAnimationFrame(el._raf);
    if (reduced) { el.textContent = pad(to); return; }
    const from = 0;
    const t0 = performance.now();
    const step = now => {
      const p = clamp((now - t0) / dur, 0, 1);
      el.textContent = pad(lerp(from, to, easeOutExpo(p)));
      if (p < 1) el._raf = requestAnimationFrame(step);
    };
    el._raf = requestAnimationFrame(step);
  }

  // Animate header stats once in view
  const stats = $$('[data-count]');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        stats.forEach((el, i) => setTimeout(() => countTo(el, Number(el.dataset.count || 0), 1200), 100 + i * 80));
        io.disconnect();
      });
    }, { threshold: 0.2 });
    io.observe(sec);
  } else {
    stats.forEach(el => { el.textContent = pad(Number(el.dataset.count || 0)); });
  }

  /* ------------------------------------------------------------------
     Three.js WebGL Scene
  ------------------------------------------------------------------ */
  const hudMode = $('#eq-hud-mode');
  const hudL = [0, 1, 2].map(i => $('#eq-hud-l' + i));
  const hudV = [0, 1, 2].map(i => $('#eq-hud-v' + i));
  let scene = null;

  if (window.THREE && window.ATSFleetScene) {
    try {
      scene = window.ATSFleetScene.create({
        canvas,
        host: viewport,
        reduced,
        onHud(title, rows) {
          if (hudMode && hudMode.textContent !== title) hudMode.textContent = title;
          rows.forEach((r, i) => {
            if (hudL[i] && hudL[i].textContent !== r[0]) hudL[i].textContent = r[0];
            if (hudV[i]) hudV[i].textContent = r[1];
          });
        },
        onLost() { sec.classList.add('eq-no-webgl'); },
      });
    } catch (err) {
      console.warn('[ATS Fleet] WebGL scene failed:', err);
      scene = null;
    }
  }

  /* ------------------------------------------------------------------
     Machine Switching State
  ------------------------------------------------------------------ */
  let active = -1;

  function setActive(i, instant = false) {
    i = clamp(i, 0, n - 1);
    if (i === active) return;
    active = i;

    slides.forEach((s, k) => {
      const isCur = k === i;
      s.classList.toggle('is-active', isCur);
      s.setAttribute('aria-hidden', isCur ? 'false' : 'true');
    });

    tabs.forEach((t, k) => {
      const isCur = k === i;
      t.classList.toggle('is-active', isCur);
      t.setAttribute('aria-selected', isCur ? 'true' : 'false');
      t.tabIndex = isCur ? 0 : -1;
    });

    panels.forEach((p, k) => {
      p.classList.toggle('is-active', k === i);
    });

    photos.forEach((p, k) => {
      p.classList.toggle('is-active', k === i);
    });

    // Check if 3D animation is hidden for this machine or globally
    const isCurHide = (slides[i]?.dataset?.hideAnimation === '1') || (sec?.dataset?.globalHideAnimation === '1');
    if (viewport) {
      viewport.classList.toggle('is-hidden', isCurHide);
      viewport.style.display = isCurHide ? 'none' : '';
    }
    const photoStrip = $('.eq-photo-strip');
    if (photoStrip) {
      photoStrip.classList.toggle('is-full-size', isCurHide);
    }

    const numEl = $('[data-count-to]', slides[i]);
    if (numEl) countTo(numEl, Number(numEl.dataset.countTo || 0), 900);

    if (scene) {
      if (isCurHide) {
        stop();
      } else {
        scene.setMachine(slides[i].dataset.kind, instant);
        if (typeof scene.resize === 'function') {
          scene.resize();
        }
        if (inView && !document.hidden) {
          start();
        }
      }
    }
  }

  setActive(0, true);

  // Tab click & keyboard navigation
  tabs.forEach((tab, i) => {
    tab.addEventListener('click', () => {
      pauseTour(12000);
      setActive(i);
    });
    tab.addEventListener('keydown', e => {
      if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
        e.preventDefault();
        const next = (i + 1) % n;
        pauseTour(12000);
        setActive(next);
        tabs[next].focus();
      } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
        e.preventDefault();
        const prev = (i - 1 + n) % n;
        pauseTour(12000);
        setActive(prev);
        tabs[prev].focus();
      }
    });
  });

  /* ------------------------------------------------------------------
     Auto Fleet Tour
  ------------------------------------------------------------------ */
  let tourPlaying = true;
  let tourTimer = null;
  let resumeTourTimeout = null;

  function nextMachine() {
    setActive((active + 1) % n);
  }

  function startTour() {
    stopTour();
    tourPlaying = true;
    if (tourBtn) {
      tourBtn.setAttribute('aria-pressed', 'true');
      if (tourText) tourText.textContent = 'Auto Tour Active';
    }
    tourTimer = setInterval(() => {
      if (!document.hidden && inView) {
        nextMachine();
      }
    }, 7000);
  }

  function stopTour() {
    if (tourTimer) {
      clearInterval(tourTimer);
      tourTimer = null;
    }
    tourPlaying = false;
    if (tourBtn) {
      tourBtn.setAttribute('aria-pressed', 'false');
      if (tourText) tourText.textContent = 'Tour Paused';
    }
  }

  function pauseTour(duration = 10000) {
    if (!tourPlaying) return;
    if (tourTimer) clearInterval(tourTimer);
    clearTimeout(resumeTourTimeout);
    resumeTourTimeout = setTimeout(() => {
      if (tourPlaying) startTour();
    }, duration);
  }

  if (tourBtn) {
    tourBtn.addEventListener('click', () => {
      if (tourPlaying) {
        stopTour();
      } else {
        startTour();
      }
    });
  }

  // Pause tour on mouse hover / user interaction with studio
  if (studio) {
    studio.addEventListener('pointerenter', () => {
      if (tourPlaying && tourTimer) clearInterval(tourTimer);
    });
    studio.addEventListener('pointerleave', () => {
      if (tourPlaying) startTour();
    });
  }

  /* ------------------------------------------------------------------
     Viewport: Drag to orbit 3D model
  ------------------------------------------------------------------ */
  let dragging = false, lastX = 0;
  if (viewport) {
    viewport.addEventListener('pointerdown', e => {
      if (e.pointerType === 'mouse' && e.button !== 0) return;
      dragging = true;
      lastX = e.clientX;
      viewport.classList.add('is-drag');
      pauseTour(15000);
      try { viewport.setPointerCapture(e.pointerId); } catch (err) { /* noop */ }
      if (scene) scene.dragStart();
    });

    viewport.addEventListener('pointermove', e => {
      if (dragging) {
        const dx = e.clientX - lastX;
        lastX = e.clientX;
        if (scene) scene.dragMove(dx);
      } else if (scene) {
        const r = viewport.getBoundingClientRect();
        const px = ((e.clientX - r.left) / r.width - 0.5) * 2;
        const py = ((e.clientY - r.top) / r.height - 0.5) * 2;
        scene.setPointer(px, py);
      }
    });

    const endDrag = () => {
      if (!dragging) return;
      dragging = false;
      viewport.classList.remove('is-drag');
      if (scene) scene.dragEnd();
    };
    viewport.addEventListener('pointerup', endDrag);
    viewport.addEventListener('pointercancel', endDrag);
  }

  /* ------------------------------------------------------------------
     3D-tilt Photo Card (Desktop only, event-driven, pause when idle)
  ------------------------------------------------------------------ */
  const hasFinePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  if (card && !reduced && hasFinePointer) {
    let tRX = 0, tRY = 0, cRX = 0, cRY = 0, tiltRaf = 0, isHovering = false;

    function tiltLoop() {
      const dX = Math.abs(cRX - tRX);
      const dY = Math.abs(cRY - tRY);
      if (dX > 0.01 || dY > 0.01 || isHovering) {
        cRX = lerp(cRX, tRX, 0.12);
        cRY = lerp(cRY, tRY, 0.12);
        card.style.transform = `perspective(600px) rotateX(${cRX.toFixed(2)}deg) rotateY(${cRY.toFixed(2)}deg)`;
        tiltRaf = requestAnimationFrame(tiltLoop);
      } else {
        card.style.transform = '';
        tiltRaf = 0;
      }
    }

    card.addEventListener('pointerenter', () => {
      isHovering = true;
      if (!tiltRaf) tiltRaf = requestAnimationFrame(tiltLoop);
    });

    card.addEventListener('pointermove', e => {
      const r = card.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width;
      const py = (e.clientY - r.top) / r.height;
      tRY = (px - 0.5) * 14;
      tRX = -(py - 0.5) * 12;
      if (!tiltRaf) tiltRaf = requestAnimationFrame(tiltLoop);
    });

    card.addEventListener('pointerleave', () => {
      isHovering = false;
      tRX = 0;
      tRY = 0;
      if (!tiltRaf) tiltRaf = requestAnimationFrame(tiltLoop);
    });
  }

  /* ------------------------------------------------------------------
     Step Explorer Bridge (Jump to 33-step Explorer)
  ------------------------------------------------------------------ */
  $$('[data-eq-jump]').forEach(b => {
    b.addEventListener('click', () => {
      const stepIdx = Number(b.dataset.eqJump || 0);
      window.dispatchEvent(new CustomEvent('ats:select-step', { detail: { index: stepIdx } }));
    });
  });

  /* ------------------------------------------------------------------
     High-Resolution Photo Lightbox
  ------------------------------------------------------------------ */
  const lb = $('#eq-lb');
  const lbImg = $('#eq-lb-img', lb);
  const lbTitle = $('#eq-lb-title', lb);
  const lbMeta = $('#eq-lb-meta', lb);
  let lbIndex = 0, lbReturn = null;
  if (lb) document.body.appendChild(lb);

  function lbShow(i) {
    lbIndex = (i + n) % n;
    const s = slides[lbIndex];
    if (!s) return;
    lbImg.style.opacity = '0';
    const done = () => { lbImg.style.opacity = '1'; };
    lbImg.onload = done;
    lbImg.src = s.dataset.image;
    lbImg.alt = s.dataset.title || '';
    if (lbImg.complete) done();
    if (lbTitle) lbTitle.textContent = s.dataset.title || '';
    if (lbMeta) lbMeta.textContent = `${(s.dataset.meta || '').trim()} · ATS Workshop Surabaya · ${pad(lbIndex + 1)}/${pad(n)}`;
  }

  function lbOpen(i) {
    if (!lb) return;
    lbReturn = document.activeElement;
    lbShow(i);
    lb.style.display = 'flex';
    lb.setAttribute('aria-hidden', 'false');
    document.documentElement.style.overflow = 'hidden';
    const closeBtn = $('.eq-lb-close', lb);
    if (closeBtn) closeBtn.focus();
  }

  function lbClose() {
    if (!lb || lb.style.display === 'none') return;
    lb.style.display = 'none';
    lb.setAttribute('aria-hidden', 'true');
    document.documentElement.style.overflow = '';
    if (lbReturn && lbReturn.focus) lbReturn.focus();
  }

  $$('[data-eq-inspect]').forEach(b => b.addEventListener('click', () => lbOpen(active)));
  if (card) {
    card.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        lbOpen(active);
      }
    });
  }

  if (lb) {
    lb.addEventListener('click', e => { if (e.target.closest('[data-eq-lb-close]')) lbClose(); });
    const prevBtn = $('#eq-lb-prev', lb);
    const nextBtn = $('#eq-lb-next', lb);
    if (prevBtn) prevBtn.addEventListener('click', () => lbShow(lbIndex - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => lbShow(lbIndex + 1));

    document.addEventListener('keydown', e => {
      if (lb.style.display === 'none') return;
      if (e.key === 'Escape') lbClose();
      else if (e.key === 'ArrowRight') lbShow(lbIndex + 1);
      else if (e.key === 'ArrowLeft') lbShow(lbIndex - 1);
    });
  }

  /* ------------------------------------------------------------------
     Main Animation Loop (Three.js Scene Rendering - Fully Adaptive)
  ------------------------------------------------------------------ */
  let raf = 0, last = 0, inView = false;

  function shouldRender() {
    if (!inView || document.hidden || !scene) return false;
    if (viewport && (viewport.classList.contains('is-hidden') || viewport.style.display === 'none')) {
      return false;
    }
    return true;
  }

  function loop(now) {
    if (!shouldRender()) {
      raf = 0;
      return;
    }
    raf = requestAnimationFrame(loop);
    const dt = Math.min(0.05, (now - last) / 1000 || 0.016);
    last = now;
    scene.render(dt);
  }

  function start() {
    if (raf || !shouldRender()) return;
    last = performance.now();
    raf = requestAnimationFrame(loop);
  }

  function stop() {
    if (raf) {
      cancelAnimationFrame(raf);
      raf = 0;
    }
  }

  if ('IntersectionObserver' in window) {
    new IntersectionObserver(entries => {
      inView = entries[0].isIntersecting;
      if (inView && !document.hidden) {
        start();
        if (tourPlaying && !tourTimer) startTour();
      } else {
        stop();
        if (tourTimer) { clearInterval(tourTimer); tourTimer = null; }
      }
    }, { rootMargin: '120px 0px' }).observe(sec);
  } else {
    inView = true;
    start();
    startTour();
  }

  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      stop();
    } else if (inView) {
      start();
    }
  });

  /* ------------------------------------------------------------------
     Deep Link Scroll Alignment: /panel-building-process#equipment
  ------------------------------------------------------------------ */
  if (location.hash === '#equipment') {
    const align = () => {
      const top = sec.getBoundingClientRect().top + window.scrollY - 30;
      window.scrollTo({ top, behavior: 'smooth' });
    };
    setTimeout(align, 100);
    window.addEventListener('load', () => setTimeout(align, 300), { once: true });
  }
})();
