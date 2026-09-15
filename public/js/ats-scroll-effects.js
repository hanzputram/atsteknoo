/**
 * ATS Tekno — Lenis Smooth Scroll & Framer-style Text Reveal on Scroll
 * Inspired by Framer Marketplace: revealtextonscroll
 */
(function() {
  'use strict';

  let lenisInstance = null;
  const registeredElements = new Set();
  let intersectionObserver = null;

  // --------------------------------------------------------------------------
  // 1. Lenis Smooth Scroll Initialization
  // --------------------------------------------------------------------------
  function initLenis() {
    if (typeof Lenis === 'undefined') {
      console.warn('[ATS Scroll] Lenis library not found.');
      return;
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      document.documentElement.classList.add('lenis-disabled');
      return;
    }

    try {
      lenisInstance = new Lenis({
        duration: 1.15,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 0.95,
        touchMultiplier: 1.6,
        infinite: false,
      });

      window.atsLenis = lenisInstance;

      function raf(time) {
        lenisInstance.raf(time);
        requestAnimationFrame(raf);
      }
      requestAnimationFrame(raf);

      // Listen to scroll for scroll-scrub text illumination
      lenisInstance.on('scroll', onScrollUpdate);
    } catch (err) {
      console.error('[ATS Scroll] Error initializing Lenis:', err);
    }
  }

  // Fallback if Lenis is not active
  window.addEventListener('scroll', onScrollUpdate, { passive: true });

  // --------------------------------------------------------------------------
  // 2. Framer-style Text Splitting & Word Masking
  // --------------------------------------------------------------------------

  function splitContainerText(container, startIndex = 0) {
    let wordIndex = startIndex;
    const childNodes = Array.from(container.childNodes);

    childNodes.forEach(node => {
      if (node.nodeType === Node.TEXT_NODE) {
        const text = node.textContent;
        if (!text || text.trim() === '') return;

        // Split words and whitespace tokens
        const tokens = text.split(/(\s+)/);
        const frag = document.createDocumentFragment();

        tokens.forEach(token => {
          if (token === '') return;
          if (/^\s+$/.test(token)) {
            frag.appendChild(document.createTextNode(token));
          } else {
            const mask = document.createElement('span');
            mask.className = 'ats-word-mask';

            const word = document.createElement('span');
            word.className = 'ats-reveal-word';
            word.textContent = token;
            word.style.setProperty('--word-index', wordIndex);
            wordIndex++;

            mask.appendChild(word);
            frag.appendChild(mask);
          }
        });

        container.replaceChild(frag, node);
      } else if (node.nodeType === Node.ELEMENT_NODE) {
        // Recurse into formatting elements (span, strong, em, b, i, a)
        // Skip already-masked spans to prevent double wrapping
        if (!node.classList.contains('ats-word-mask') && !node.classList.contains('ats-reveal-word')) {
          wordIndex = splitContainerText(node, wordIndex);
        }
      }
    });

    return wordIndex;
  }

  function splitElementIntoWords(el) {
    if (el.dataset.atsSplit === 'true') return;

    // Check for bilingual sub-containers
    const enChild = el.querySelector('.ats-lang-en');
    const idChild = el.querySelector('.ats-lang-id');

    if (enChild && idChild) {
      splitContainerText(enChild, 0);
      splitContainerText(idChild, 0);
    } else {
      splitContainerText(el, 0);
    }

    el.dataset.atsSplit = 'true';
  }

  // --------------------------------------------------------------------------
  // 3. Observer & Animation Triggering
  // --------------------------------------------------------------------------
  function setupObserver() {
    if (intersectionObserver) {
      intersectionObserver.disconnect();
    }

    intersectionObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-in-view');
          if (!entry.target.hasAttribute('data-reveal-repeat')) {
            intersectionObserver.unobserve(entry.target);
          }
        } else if (entry.target.hasAttribute('data-reveal-repeat')) {
          entry.target.classList.remove('is-in-view');
        }
      });
    }, {
      threshold: 0.12,
      rootMargin: '0px 0px -40px 0px'
    });
  }

  function attachElements() {
    setupObserver();

    // Elements to automatically empower with Framer Reveal on Scroll
    const selectors = [
      '[data-reveal-text]',
      '.reveal-text-on-scroll',
      '.hero-headline',
      '.section-title',
      '.section-reveal-title'
    ];

    const targets = document.querySelectorAll(selectors.join(', '));
    targets.forEach(el => {
      splitElementIntoWords(el);
      registeredElements.add(el);

      if (!el.hasAttribute('data-reveal-scrub')) {
        intersectionObserver.observe(el);
      }

      // If already in top viewport, trigger immediately with smooth delay
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight * 0.75 && rect.bottom > 0) {
        setTimeout(() => {
          el.classList.add('is-in-view');
        }, 80);
      }
    });
  }

  // --------------------------------------------------------------------------
  // 4. Scroll-Scrub Reveal (Framer Progressive Illumination Mode)
  // --------------------------------------------------------------------------
  function onScrollUpdate() {
    const scrubTargets = document.querySelectorAll('[data-reveal-scrub], .reveal-text-scrub');
    if (scrubTargets.length === 0) return;

    const vh = window.innerHeight;

    scrubTargets.forEach(el => {
      const rect = el.getBoundingClientRect();
      const words = el.querySelectorAll('.ats-reveal-word');
      if (words.length === 0) return;

      const triggerStart = vh * 0.85;
      const triggerEnd = vh * 0.25;
      const progress = Math.min(Math.max((triggerStart - rect.top) / (triggerStart - triggerEnd), 0), 1);

      const totalWords = words.length;
      words.forEach((w, idx) => {
        const threshold = idx / totalWords;
        if (progress >= threshold) {
          w.classList.add('is-scrubbed');
        } else {
          w.classList.remove('is-scrubbed');
        }
      });
    });
  }

  // --------------------------------------------------------------------------
  // 5. Re-synchronize on Language Change or Dynamic DOM Updates
  // --------------------------------------------------------------------------
  window.addEventListener('atsLanguageChanged', () => {
    // Re-trigger reveal animation on visible language
    registeredElements.forEach(el => {
      if (el.classList.contains('is-in-view')) {
        // Re-apply in-view class to animate newly displayed language
        const words = el.querySelectorAll('.ats-reveal-word');
        words.forEach(w => {
          w.style.transition = 'none';
          void w.offsetWidth;
          w.style.transition = '';
        });
      }
    });
  });

  // Public API
  window.atsScroll = {
    init: attachElements,
    getLenis: () => lenisInstance,
    scrollTo: (target, options) => {
      if (lenisInstance) {
        lenisInstance.scrollTo(target, options);
      } else {
        const targetEl = typeof target === 'string' ? document.querySelector(target) : target;
        if (targetEl) targetEl.scrollIntoView({ behavior: 'smooth' });
      }
    }
  };

  // Bootstrap on DOM Ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      initLenis();
      attachElements();
    });
  } else {
    initLenis();
    attachElements();
  }
})();
