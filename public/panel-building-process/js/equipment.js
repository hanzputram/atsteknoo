/**
 * ATS Tekno — Machinery Fleet Studio controller (#equipment)
 * Scroll-driven machine switching (desktop) / autoplay + tap (touch), word-mask reveals,
 * count-up stats, velocity marquee, 3D-tilt photo card, magnetic buttons, custom cursor,
 * drag-to-orbit WebGL viewport and an accessible zoomable lightbox.
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
  const esc = s => s.replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
  const easeOutExpo = t => (t >= 1 ? 1 : 1 - Math.pow(2, -10 * t));

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const wide = window.matchMedia('(min-width: 961px)');
  const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

  const slides = $$('.eq-slide');
  const photos = $$('.eq-photo');
  const railBtns = $$('.eq-rail-btn');
  const n = slides.length;
  if (!n) return;

  const scrollEl = $('#eq-scroll');
  const stage = $('#eq-stage');
  const viewport = $('#eq-viewport');
  const canvas = $('#eq-canvas');
  const idxEl = $('#eq-index');
  const ghostEl = $('#eq-ghost');
  const head = $('#eq-head');
  const hint = $('#eq-scrollhint');

  /* ------------------------------------------------------------------
     Typography: word-mask splitting
  ------------------------------------------------------------------ */
  function splitWords(el, outlineFrom = -1) {
    const text = el.textContent.trim().replace(/\s+/g, ' ');
    el.setAttribute('aria-label', text);
    el.innerHTML = text.split(' ').map((w, i) =>
      `<span class="eq-w${outlineFrom >= 0 && i >= outlineFrom ? ' is-outline' : ''}" style="--wi:${i}" aria-hidden="true"><span>${esc(w)}</span></span>`
    ).join(' ');
  }
  const titleEl = $('.eq-title');
  if (titleEl) splitWords(titleEl, Math.ceil(titleEl.textContent.trim().split(/\s+/).length / 2));
  slides.forEach(s => {
    const h = $('.eq-slide-title', s);
    if (h) splitWords(h);
  });

  /* ------------------------------------------------------------------
     Count-up
  ------------------------------------------------------------------ */
  function countTo(el, to, dur = 1300, from = 0) {
    cancelAnimationFrame(el._raf);
    if (reduced) { el.textContent = pad(to); return; }
    const t0 = performance.now();
    const step = now => {
      const p = clamp((now - t0) / dur, 0, 1);
      el.textContent = pad(lerp(from, to, easeOutExpo(p)));
      if (p < 1) el._raf = requestAnimationFrame(step);
    };
    el._raf = requestAnimationFrame(step);
  }

  /* ------------------------------------------------------------------
     Header reveal + stats (IntersectionObserver)
  ------------------------------------------------------------------ */
  const stats = $$('[data-count]');
  stats.forEach(el => { el.textContent = '00'; });
  if (head && 'IntersectionObserver' in window) {
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        head.classList.add('is-in');
        stats.forEach((el, i) => setTimeout(() => countTo(el, Number(el.dataset.count || 0), 1500), 650 + i * 120));
        io.disconnect();
      });
    }, { threshold: 0.25 });
    io.observe(head);
  } else if (head) {
    head.classList.add('is-in');
    stats.forEach(el => { el.textContent = pad(Number(el.dataset.count || 0)); });
  }

  /* ------------------------------------------------------------------
     WebGL scene
  ------------------------------------------------------------------ */
  const hudMode = $('#eq-hud-mode');
  const hudL = [0, 1, 2].map(i => $('#eq-hud-l' + i));
  const hudV = [0, 1, 2].map(i => $('#eq-hud-v' + i));
  let scene = null;
  const hasWebGL = !!(window.THREE && window.ATSFleetScene);
  if (hasWebGL) {
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
  if (!scene) sec.classList.add('eq-no-webgl');

  /* ------------------------------------------------------------------
     Active machine state
  ------------------------------------------------------------------ */
  let active = -1;
  let mode = wide.matches ? 'scroll' : 'tap';

  function setActive(i, instant = false) {
    i = clamp(i, 0, n - 1);
    if (i === active) return;
    active = i;
    slides.forEach((s, k) => {
      s.classList.toggle('is-active', k === i);
      s.setAttribute('aria-hidden', k === i ? 'false' : 'true');
    });
    photos.forEach((p, k) => {
      p.classList.toggle('is-active', k === i);
      p.classList.toggle('is-gone', k < i);
    });
    railBtns.forEach((b, k) => {
      b.classList.toggle('is-active', k === i);
      b.setAttribute('aria-selected', k === i ? 'true' : 'false');
      b.tabIndex = k === i ? 0 : -1;
    });
    if (idxEl) idxEl.textContent = `FLEET ${pad(i + 1)} / ${pad(n)}`;
    if (ghostEl) ghostEl.textContent = pad(i + 1);
    const num = $('[data-count-to]', slides[i]);
    if (num) countTo(num, Number(num.dataset.countTo || 0), 1100);
    if (scene) scene.setMachine(slides[i].dataset.kind, instant);
  }
  setActive(0, true);

  /* ------------------------------------------------------------------
     Scroll + autoplay driver
  ------------------------------------------------------------------ */
  let localP = 0;
  let auto = 0;
  let pauseUntil = 0;
  let scrollFrac = 0;

  function readScroll() {
    const r = scrollEl.getBoundingClientRect();
    const total = Math.max(1, r.height - window.innerHeight);
    const p = clamp(-r.top / total, 0, 1);
    const f = p * n;
    const idx = Math.min(n - 1, Math.floor(f));
    return { idx, local: p >= 1 ? 1 : f - idx, p };
  }

  function goTo(i) {
    i = clamp(i, 0, n - 1);
    if (mode === 'scroll') {
      const top = scrollEl.getBoundingClientRect().top + window.scrollY;
      const total = scrollEl.offsetHeight - window.innerHeight;
      const y = top + ((i + 0.08) / n) * total;
      if (window.atsLenis && typeof window.atsLenis.scrollTo === 'function') {
        window.atsLenis.scrollTo(y, { duration: 1.5 });
      } else {
        window.scrollTo({ top: y, behavior: reduced ? 'auto' : 'smooth' });
      }
    } else {
      pauseUntil = Date.now() + 9000;
      auto = 0;
      setActive(i);
    }
  }

  railBtns.forEach((b, i) => {
    b.addEventListener('click', () => goTo(i));
    b.addEventListener('keydown', e => {
      const keys = ['ArrowRight', 'ArrowDown', 'ArrowLeft', 'ArrowUp', 'Home', 'End'];
      if (!keys.includes(e.key)) return;
      e.preventDefault();
      let t = i;
      if (e.key === 'Home') t = 0;
      else if (e.key === 'End') t = n - 1;
      else t = (i + (e.key === 'ArrowRight' || e.key === 'ArrowDown' ? 1 : -1) + n) % n;
      goTo(t);
      railBtns[t].focus({ preventScroll: true });
    });
  });

  wide.addEventListener && wide.addEventListener('change', () => {
    mode = wide.matches ? 'scroll' : 'tap';
    auto = 0;
  });

  /* ------------------------------------------------------------------
     Magnetic buttons
  ------------------------------------------------------------------ */
  if (finePointer && !reduced) {
    $$('.eq-btn').forEach(b => {
      b.addEventListener('pointermove', e => {
        const r = b.getBoundingClientRect();
        const x = (e.clientX - (r.left + r.width / 2)) * 0.28;
        const y = (e.clientY - (r.top + r.height / 2)) * 0.4;
        b.style.transform = `translate3d(${x}px, ${y}px, 0)`;
      });
      b.addEventListener('pointerleave', () => { b.style.transform = ''; });
    });
  }

  /* ------------------------------------------------------------------
     Step-explorer jump (handled by process.js)
  ------------------------------------------------------------------ */
  $$('[data-eq-jump]').forEach(b => {
    b.addEventListener('click', () => {
      window.dispatchEvent(new CustomEvent('ats:select-step', { detail: { index: Number(b.dataset.eqJump || 0) } }));
    });
  });

  /* ------------------------------------------------------------------
     Viewport: pointer parallax + drag-to-orbit
  ------------------------------------------------------------------ */
  let dragging = false, lastX = 0;
  if (viewport) {
    viewport.addEventListener('pointerdown', e => {
      if (e.pointerType === 'mouse' && e.button !== 0) return;
      dragging = true;
      lastX = e.clientX;
      viewport.classList.add('is-drag');
      try { viewport.setPointerCapture(e.pointerId); } catch (err) { /* noop */ }
      if (scene) scene.dragStart();
    });
    viewport.addEventListener('pointermove', e => {
      if (!dragging) return;
      const dx = e.clientX - lastX;
      lastX = e.clientX;
      if (scene) scene.dragMove(dx);
    });
    const end = () => {
      if (!dragging) return;
      dragging = false;
      viewport.classList.remove('is-drag');
      if (scene) scene.dragEnd();
    };
    viewport.addEventListener('pointerup', end);
    viewport.addEventListener('pointercancel', end);
  }
  stage.addEventListener('pointermove', e => {
    if (!scene) return;
    scene.setPointer((e.clientX / window.innerWidth - 0.5) * 2, (e.clientY / window.innerHeight - 0.5) * 2);
  });

  /* ------------------------------------------------------------------
     Custom cursor
  ------------------------------------------------------------------ */
  const cursor = $('#eq-cursor');
  const cursorLabel = $('#eq-cursor-label');
  let cx = 0, cy = 0, cTx = 0, cTy = 0, cursorOn = false, cursorState = '';
  if (cursor && finePointer) {
    stage.addEventListener('pointermove', e => {
      if (!wide.matches) return;
      cTx = e.clientX;
      cTy = e.clientY;
      if (!cursorOn) {
        cursorOn = true;
        cx = cTx; cy = cTy;
        cursor.classList.add('is-on');
      }
      const t = e.target.closest('[data-eq-cursor]');
      const st = t ? t.dataset.eqCursor : '';
      if (st !== cursorState) {
        cursor.classList.remove('is-drag', 'is-inspect');
        if (st) {
          cursor.classList.add('is-' + st);
          cursorLabel.textContent = t.dataset.eqCursorLabel || '';
        }
        cursorState = st;
      }
    });
    stage.addEventListener('pointerleave', () => {
      cursorOn = false;
      cursor.classList.remove('is-on', 'is-drag', 'is-inspect');
      cursorState = '';
    });
  }

  /* ------------------------------------------------------------------
     3D-tilt photo card
  ------------------------------------------------------------------ */
  const card = $('#eq-photo-card');
  let tRX = 0, tRY = 0, cRX = 0, cRY = 0;
  if (card && finePointer && !reduced) {
    card.addEventListener('pointermove', e => {
      const r = card.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width;
      const py = (e.clientY - r.top) / r.height;
      tRY = (px - 0.5) * 18;
      tRX = -(py - 0.5) * 15;
      card.style.setProperty('--mx', (px * 100).toFixed(1) + '%');
      card.style.setProperty('--my', (py * 100).toFixed(1) + '%');
    });
    card.addEventListener('pointerleave', () => { tRX = 0; tRY = 0; });
  }

  /* ------------------------------------------------------------------
     Marquee (scroll-velocity driven)
  ------------------------------------------------------------------ */
  const mTrack = $('#eq-marquee-track');
  let mX = 0, mHalf = 0, lastY = window.scrollY, vel = 0;
  const measureMarquee = () => {
    if (!mTrack) return;
    const g = mTrack.firstElementChild;
    mHalf = g ? g.getBoundingClientRect().width : 0;
  };
  measureMarquee();
  window.addEventListener('resize', measureMarquee);
  window.addEventListener('load', measureMarquee);

  /* ------------------------------------------------------------------
     Lightbox
  ------------------------------------------------------------------ */
  const lb = $('#eq-lb');
  const lbImg = $('#eq-lb-img', lb);
  const lbFrame = $('#eq-lb-frame', lb);
  const lbTitle = $('#eq-lb-title', lb);
  const lbMeta = $('#eq-lb-meta', lb);
  let lbIndex = 0, lbReturn = null;
  if (lb) document.body.appendChild(lb); // escape the section stacking context (sticky header z-index)

  function lbShow(i) {
    lbIndex = (i + n) % n;
    const s = slides[lbIndex];
    lbFrame.classList.remove('is-zoom');
    lbImg.style.opacity = '0';
    const src = s.dataset.image;
    const done = () => { lbImg.style.opacity = '1'; };
    lbImg.onload = done;
    lbImg.src = src;
    lbImg.alt = s.dataset.title || '';
    if (lbImg.complete) done();
    lbTitle.textContent = s.dataset.title || '';
    lbMeta.textContent = `${(s.dataset.meta || '').trim()} · ATS MANUFACTURING FLEET · ${pad(lbIndex + 1)}/${pad(n)}`;
  }
  function lbOpen(i) {
    if (!lb) return;
    lbReturn = document.activeElement;
    lbShow(i);
    lb.classList.add('is-open');
    lb.setAttribute('aria-hidden', 'false');
    requestAnimationFrame(() => requestAnimationFrame(() => lb.classList.add('is-in')));
    document.documentElement.style.overflow = 'hidden';
    if (window.atsLenis && window.atsLenis.stop) window.atsLenis.stop();
    const close = $('.eq-lb-close', lb);
    if (close) close.focus({ preventScroll: true });
  }
  function lbClose() {
    if (!lb || !lb.classList.contains('is-open')) return;
    lb.classList.remove('is-in');
    lb.setAttribute('aria-hidden', 'true');
    setTimeout(() => lb.classList.remove('is-open'), 420);
    document.documentElement.style.overflow = '';
    if (window.atsLenis && window.atsLenis.start) window.atsLenis.start();
    if (lbReturn && lbReturn.focus) lbReturn.focus({ preventScroll: true });
  }
  $$('[data-eq-inspect]').forEach(b => b.addEventListener('click', () => lbOpen(active)));
  if (lb) {
    lb.addEventListener('click', e => { if (e.target.closest('[data-eq-lb-close]')) lbClose(); });
    $('#eq-lb-prev', lb).addEventListener('click', () => lbShow(lbIndex - 1));
    $('#eq-lb-next', lb).addEventListener('click', () => lbShow(lbIndex + 1));
    lbFrame.addEventListener('click', e => {
      const r = lbFrame.getBoundingClientRect();
      lbFrame.style.setProperty('--ox', ((e.clientX - r.left) / r.width * 100).toFixed(1) + '%');
      lbFrame.style.setProperty('--oy', ((e.clientY - r.top) / r.height * 100).toFixed(1) + '%');
      lbFrame.classList.toggle('is-zoom');
    });
    lbFrame.addEventListener('pointermove', e => {
      if (!lbFrame.classList.contains('is-zoom')) return;
      const r = lbFrame.getBoundingClientRect();
      lbFrame.style.setProperty('--ox', ((e.clientX - r.left) / r.width * 100).toFixed(1) + '%');
      lbFrame.style.setProperty('--oy', ((e.clientY - r.top) / r.height * 100).toFixed(1) + '%');
    });
    document.addEventListener('keydown', e => {
      if (!lb.classList.contains('is-open')) return;
      if (e.key === 'Escape') lbClose();
      else if (e.key === 'ArrowRight') lbShow(lbIndex + 1);
      else if (e.key === 'ArrowLeft') lbShow(lbIndex - 1);
      else if (e.key === 'Tab') {
        const f = $$('button', lb);
        if (!f.length) return;
        const first = f[0], last = f[f.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });
  }

  /* ------------------------------------------------------------------
     Main loop (runs only while the section is on screen)
  ------------------------------------------------------------------ */
  let raf = 0, last = 0, inView = false, railCache = [];
  function loop(now) {
    raf = requestAnimationFrame(loop);
    const dt = Math.min(0.05, (now - last) / 1000 || 0.016);
    last = now;

    // scroll velocity (for marquee)
    const y = window.scrollY;
    vel = lerp(vel, y - lastY, 0.14);
    lastY = y;

    // machine selection
    let prog = 0;
    if (mode === 'scroll') {
      const r = readScroll();
      setActive(r.idx);
      prog = r.local;
      scrollFrac = (r.idx + r.local) / n;
      railBtns.forEach((_, k) => { railCache[k] = k < r.idx ? 1 : k === r.idx ? r.local : 0; });
      if (hint) hint.style.opacity = r.p > 0.03 ? '0' : '1';
    } else {
      if (!reduced && Date.now() > pauseUntil) {
        auto += dt / 6.5;
        if (auto >= 1) { auto = 0; setActive((active + 1) % n); }
      } else if (Date.now() <= pauseUntil) {
        auto = 1;
      }
      prog = auto;
      scrollFrac = (active + prog) / n;
      railBtns.forEach((_, k) => { railCache[k] = k < active ? 1 : k === active ? prog : 0; });
    }
    railBtns.forEach((b, k) => {
      const v = railCache[k] || 0;
      if (b._p === undefined || Math.abs(b._p - v) > 0.004) { b._p = v; b.style.setProperty('--p', v.toFixed(3)); }
    });
    if (ghostEl) ghostEl.style.setProperty('--gy', `${(scrollFrac - 0.5) * -90}px`);
    if (scene) scene.setScroll(scrollFrac);

    // marquee
    if (mTrack && mHalf && !reduced) {
      mX -= (46 + Math.abs(vel) * 9) * dt * (vel < -0.5 ? -1 : 1);
      if (mX <= -mHalf) mX += mHalf;
      if (mX > 0) mX -= mHalf;
      mTrack.style.transform = `translate3d(${mX.toFixed(1)}px,0,0) skewX(${clamp(-vel * 0.18, -9, 9).toFixed(2)}deg)`;
    }

    // cursor
    if (cursor && cursorOn) {
      cx = lerp(cx, cTx, 1 - Math.exp(-dt * 18));
      cy = lerp(cy, cTy, 1 - Math.exp(-dt * 18));
      cursor.style.transform = `translate3d(${cx.toFixed(1)}px, ${cy.toFixed(1)}px, 0)`;
    }

    // photo tilt
    if (card && (Math.abs(cRX - tRX) > 0.02 || Math.abs(cRY - tRY) > 0.02)) {
      cRX = lerp(cRX, tRX, 1 - Math.exp(-dt * 10));
      cRY = lerp(cRY, tRY, 1 - Math.exp(-dt * 10));
      card.style.transform = `perspective(760px) rotateX(${cRX.toFixed(2)}deg) rotateY(${cRY.toFixed(2)}deg)`;
    }

    if (scene) scene.render(dt);
  }
  function start() {
    if (raf) return;
    last = performance.now();
    lastY = window.scrollY;
    raf = requestAnimationFrame(loop);
  }
  function stop() {
    cancelAnimationFrame(raf);
    raf = 0;
  }
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(entries => {
      inView = entries[0].isIntersecting;
      if (inView && !document.hidden) start(); else stop();
    }, { rootMargin: '240px 0px' }).observe(sec);
  } else {
    start();
  }
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) stop(); else if (inView) start();
  });

  /* ------------------------------------------------------------------
     Deep link: /panel-building-process#equipment
     The explorer above renders client-side, which shifts layout after the browser's
     native anchor jump — re-align once everything has settled.
  ------------------------------------------------------------------ */
  if (location.hash === '#equipment') {
    const align = () => {
      const top = sec.getBoundingClientRect().top + window.scrollY;
      window.scrollTo({ top, behavior: 'auto' });
    };
    setTimeout(align, 60);
    window.addEventListener('load', () => { setTimeout(align, 80); setTimeout(align, 700); }, { once: true });
  }
})();
