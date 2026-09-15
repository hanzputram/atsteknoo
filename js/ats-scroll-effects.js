/**
 * ATS Tekno — Lenis Smooth Scroll & Framer-style Text Reveal on Scroll Engine
 * Self-contained, resilient bundle with embedded Lenis v1.1.18 & auto CSS injection.
 * Inspired by Framer Marketplace: revealtextonscroll
 */

// ============================================================================
// 1. Embedded Lenis v1.1.18 (Self-contained, prevents any missing dependency)
// ============================================================================
(function() {
  if (typeof window === 'undefined' || typeof window.Lenis !== 'undefined') return;
  var k="1.1.18";function w(r,t,e){return Math.max(r,Math.min(t,e))}function W(r,t,e){return(1-e)*r+e*t}function z(r,t,e,i){return W(r,t,1-Math.exp(-e*i))}function x(r,t){return(r%t+t)%t}var y=class{isRunning=!1;value=0;from=0;to=0;currentTime=0;lerp;duration;easing;onUpdate;advance(t){if(!this.isRunning)return;let e=!1;if(this.duration&&this.easing){this.currentTime+=t;let i=w(0,this.currentTime/this.duration,1);e=i>=1;let s=e?1:this.easing(i);this.value=this.from+(this.to-this.from)*s}else this.lerp?(this.value=z(this.value,this.to,this.lerp*60,t),Math.round(this.value)===this.to&&(this.value=this.to,e=!0)):(this.value=this.to,e=!0);e&&this.stop(),this.onUpdate?.(this.value,e)}stop(){this.isRunning=!1}fromTo(t,e,{lerp:i,duration:s,easing:o,onStart:l,onUpdate:h}){this.from=this.value=t,this.to=e,this.lerp=i,this.duration=s,this.easing=o,this.currentTime=0,this.isRunning=!0,l?.(),this.onUpdate=h}};function R(r,t){let e;return function(...i){let s=this;clearTimeout(e),e=setTimeout(()=>{e=void 0,r.apply(s,i)},t)}}var E=class{constructor(t,e,{autoResize:i=!0,debounce:s=250}={}){this.wrapper=t;this.content=e;i&&(this.debouncedResize=R(this.resize,s),this.wrapper instanceof Window?window.addEventListener("resize",this.debouncedResize,!1):(this.wrapperResizeObserver=new ResizeObserver(this.debouncedResize),this.wrapperResizeObserver.observe(this.wrapper)),this.contentResizeObserver=new ResizeObserver(this.debouncedResize),this.contentResizeObserver.observe(this.content)),this.resize()}width=0;height=0;scrollHeight=0;scrollWidth=0;debouncedResize;wrapperResizeObserver;contentResizeObserver;destroy(){this.wrapperResizeObserver?.disconnect(),this.contentResizeObserver?.disconnect(),this.wrapper===window&&this.debouncedResize&&window.removeEventListener("resize",this.debouncedResize,!1)}resize=()=>{this.onWrapperResize(),this.onContentResize()};onWrapperResize=()=>{this.wrapper instanceof Window?(this.width=window.innerWidth,this.height=window.innerHeight):(this.width=this.wrapper.clientWidth,this.height=this.wrapper.clientHeight)};onContentResize=()=>{this.wrapper instanceof Window?(this.scrollHeight=this.content.scrollHeight,this.scrollWidth=this.content.scrollWidth):(this.scrollHeight=this.wrapper.scrollHeight,this.scrollWidth=this.wrapper.scrollWidth)};get limit(){return{x:this.scrollWidth-this.width,y:this.scrollHeight-this.height}}};var f=class{events={};emit(t,...e){let i=this.events[t]||[];for(let s=0,o=i.length;s<o;s++)i[s]?.(...e)}on(t,e){return this.events[t]?.push(e)||(this.events[t]=[e]),()=>{this.events[t]=this.events[t]?.filter(i=>e!==i)}}off(t,e){this.events[t]=this.events[t]?.filter(i=>e!==i)}destroy(){this.events={}}};var _=100/6,u={passive:!1},T=class{constructor(t,e={wheelMultiplier:1,touchMultiplier:1}){this.element=t;this.options=e;window.addEventListener("resize",this.onWindowResize,!1),this.onWindowResize(),this.element.addEventListener("wheel",this.onWheel,u),this.element.addEventListener("touchstart",this.onTouchStart,u),this.element.addEventListener("touchmove",this.onTouchMove,u),this.element.addEventListener("touchend",this.onTouchEnd,u)}touchStart={x:0,y:0};lastDelta={x:0,y:0};window={width:0,height:0};emitter=new f;on(t,e){return this.emitter.on(t,e)}destroy(){this.emitter.destroy(),window.removeEventListener("resize",this.onWindowResize,!1),this.element.removeEventListener("wheel",this.onWheel,u),this.element.removeEventListener("touchstart",this.onTouchStart,u),this.element.removeEventListener("touchmove",this.onTouchMove,u),this.element.removeEventListener("touchend",this.onTouchEnd,u)}onTouchStart=t=>{let{clientX:e,clientY:i}=t.targetTouches?t.targetTouches[0]:t;this.touchStart.x=e,this.touchStart.y=i,this.lastDelta={x:0,y:0},this.emitter.emit("scroll",{deltaX:0,deltaY:0,event:t})};onTouchMove=t=>{let{clientX:e,clientY:i}=t.targetTouches?t.targetTouches[0]:t,s=-(e-this.touchStart.x)*this.options.touchMultiplier,o=-(i-this.touchStart.y)*this.options.touchMultiplier;this.touchStart.x=e,this.touchStart.y=i,this.lastDelta={x:s,y:o},this.emitter.emit("scroll",{deltaX:s,deltaY:o,event:t})};onTouchEnd=t=>{this.emitter.emit("scroll",{deltaX:this.lastDelta.x,deltaY:this.lastDelta.y,event:t})};onWheel=t=>{let{deltaX:e,deltaY:i,deltaMode:s}=t,o=s===1?_:s===2?this.window.width:1,l=s===1?_:s===2?this.window.height:1;e*=o,i*=l,e*=this.options.wheelMultiplier,i*=this.options.wheelMultiplier,this.emitter.emit("scroll",{deltaX:e,deltaY:i,event:t})};onWindowResize=()=>{this.window={width:window.innerWidth,height:window.innerHeight}}};var L=class{_isScrolling=!1;_isStopped=!1;_isLocked=!1;_preventNextNativeScrollEvent=!1;_resetVelocityTimeout=null;__rafID=null;isTouching;time=0;userData={};lastVelocity=0;velocity=0;direction=0;options;targetScroll;animatedScroll;animate=new y;emitter=new f;dimensions;virtualScroll;constructor({wrapper:t=window,content:e=document.documentElement,eventsTarget:i=t,smoothWheel:s=!0,syncTouch:o=!1,syncTouchLerp:l=.075,touchInertiaMultiplier:h=35,duration:S,easing:d=H=>Math.min(1,1.001-Math.pow(2,-10*H)),lerp:c=.1,infinite:p=!1,orientation:b="vertical",gestureOrientation:n="vertical",touchMultiplier:a=1,wheelMultiplier:v=1,autoResize:g=!0,prevent:m,virtualScroll:N,overscroll:M=!0,autoRaf:O=!1,__experimental__naiveDimensions:D=!1}={}){window.lenisVersion=k,(!t||t===document.documentElement||t===document.body)&&(t=window),this.options={wrapper:t,content:e,eventsTarget:i,smoothWheel:s,syncTouch:o,syncTouchLerp:l,touchInertiaMultiplier:h,duration:S,easing:d,lerp:c,infinite:p,gestureOrientation:n,orientation:b,touchMultiplier:a,wheelMultiplier:v,autoResize:g,prevent:m,virtualScroll:N,overscroll:M,autoRaf:O,__experimental__naiveDimensions:D},this.dimensions=new E(t,e,{autoResize:g}),this.updateClassName(),this.targetScroll=this.animatedScroll=this.actualScroll,this.options.wrapper.addEventListener("scroll",this.onNativeScroll,!1),this.options.wrapper.addEventListener("pointerdown",this.onPointerDown,!1),this.virtualScroll=new T(i,{touchMultiplier:a,wheelMultiplier:v}),this.virtualScroll.on("scroll",this.onVirtualScroll),this.options.autoRaf&&(this.__rafID=requestAnimationFrame(this.raf))}destroy(){this.emitter.destroy(),this.options.wrapper.removeEventListener("scroll",this.onNativeScroll,!1),this.options.wrapper.removeEventListener("pointerdown",this.onPointerDown,!1),this.virtualScroll.destroy(),this.dimensions.destroy(),this.cleanUpClassName(),this.__rafID&&cancelAnimationFrame(this.__rafID)}on(t,e){return this.emitter.on(t,e)}off(t,e){return this.emitter.off(t,e)}setScroll(t){this.isHorizontal?this.rootElement.scrollLeft=t:this.rootElement.scrollTop=t}onPointerDown=t=>{t.button===1&&this.reset()};onVirtualScroll=t=>{if(typeof this.options.virtualScroll=="function"&&this.options.virtualScroll(t)===!1)return;let{deltaX:e,deltaY:i,event:s}=t;if(this.emitter.emit("virtual-scroll",{deltaX:e,deltaY:i,event:s}),s.ctrlKey||s.lenisStopPropagation)return;let o=s.type.includes("touch"),l=s.type.includes("wheel");this.isTouching=s.type==="touchstart"||s.type==="touchmove";let h=e===0&&i===0;if(this.options.syncTouch&&o&&s.type==="touchstart"&&h&&!this.isStopped&&!this.isLocked){this.reset();return}let d=this.options.gestureOrientation==="vertical"&&i===0||this.options.gestureOrientation==="horizontal"&&e===0;if(h||d)return;let c=s.composedPath();c=c.slice(0,c.indexOf(this.rootElement));let p=this.options.prevent;if(c.find(m=>m instanceof HTMLElement&&(typeof p=="function"&&p?.(m)||m.hasAttribute?.("data-lenis-prevent")||o&&m.hasAttribute?.("data-lenis-prevent-touch")||l&&m.hasAttribute?.("data-lenis-prevent-wheel"))))return;if(this.isStopped||this.isLocked){s.preventDefault();return}if(!(this.options.syncTouch&&o||this.options.smoothWheel&&l)){this.isScrolling="native",this.animate.stop(),s.lenisStopPropagation=!0;return}let n=i;this.options.gestureOrientation==="both"?n=Math.abs(i)>Math.abs(e)?i:e:this.options.gestureOrientation==="horizontal"&&(n=e),(!this.options.overscroll||this.options.infinite||this.options.wrapper!==window&&(this.animatedScroll>0&&this.animatedScroll<this.limit||this.animatedScroll===0&&i>0||this.animatedScroll===this.limit&&i<0))&&(s.lenisStopPropagation=!0),s.preventDefault();let a=o&&this.options.syncTouch,g=o&&s.type==="touchend"&&Math.abs(n)>5;g&&(n=this.velocity*this.options.touchInertiaMultiplier),this.scrollTo(this.targetScroll+n,{programmatic:!1,...a?{lerp:g?this.options.syncTouchLerp:1}:{lerp:this.options.lerp,duration:this.options.duration,easing:this.options.easing}})};resize(){this.dimensions.resize(),this.animatedScroll=this.targetScroll=this.actualScroll,this.emit()}emit(){this.emitter.emit("scroll",this)}onNativeScroll=()=>{if(this._resetVelocityTimeout!==null&&(clearTimeout(this._resetVelocityTimeout),this._resetVelocityTimeout=null),this._preventNextNativeScrollEvent){this._preventNextNativeScrollEvent=!1;return}if(this.isScrolling===!1||this.isScrolling==="native"){let t=this.animatedScroll;this.animatedScroll=this.targetScroll=this.actualScroll,this.lastVelocity=this.velocity,this.velocity=this.animatedScroll-t,this.direction=Math.sign(this.animatedScroll-t),this.isStopped||(this.isScrolling="native"),this.emit(),this.velocity!==0&&(this._resetVelocityTimeout=setTimeout(()=>{this.lastVelocity=this.velocity,this.velocity=0,this.isScrolling=!1,this.emit()},400))}};reset(){this.isLocked=!1,this.isScrolling=!1,this.animatedScroll=this.targetScroll=this.actualScroll,this.lastVelocity=this.velocity=0,this.animate.stop()}start(){this.isStopped&&(this.reset(),this.isStopped=!1)}stop(){this.isStopped||(this.reset(),this.isStopped=!0)}raf=t=>{let e=t-(this.time||t);this.time=t,this.animate.advance(e*.001),this.options.autoRaf&&(this.__rafID=requestAnimationFrame(this.raf))};scrollTo(t,{offset:e=0,immediate:i=!1,lock:s=!1,duration:o=this.options.duration,easing:l=this.options.easing,lerp:h=this.options.lerp,onStart:S,onComplete:d,force:c=!1,programmatic:p=!0,userData:b}={}){if(!((this.isStopped||this.isLocked)&&!c)){if(typeof t=="string"&&["top","left","start"].includes(t))t=0;else if(typeof t=="string"&&["bottom","right","end"].includes(t))t=this.limit;else{let n;if(typeof t=="string"?n=document.querySelector(t):t instanceof HTMLElement&&t?.nodeType&&(n=t),n){if(this.options.wrapper!==window){let v=this.rootElement.getBoundingClientRect();e-=this.isHorizontal?v.left:v.top}let a=n.getBoundingClientRect();t=(this.isHorizontal?a.left:a.top)+this.animatedScroll}}if(typeof t=="number"){if(t+=e,t=Math.round(t),this.options.infinite?p&&(this.targetScroll=this.animatedScroll=this.scroll):t=w(0,t,this.limit),t===this.targetScroll){S?.(this),d?.(this);return}if(this.userData=b??{},i){this.animatedScroll=this.targetScroll=t,this.setScroll(this.scroll),this.reset(),this.preventNextNativeScrollEvent(),this.emit(),d?.(this),this.userData={};return}p||(this.targetScroll=t),this.animate.fromTo(this.animatedScroll,t,{duration:o,easing:l,lerp:h,onStart:()=>{s&&(this.isLocked=!0),this.isScrolling="smooth",S?.(this)},onUpdate:(n,a)=>{this.isScrolling="smooth",this.lastVelocity=this.velocity,this.velocity=n-this.animatedScroll,this.direction=Math.sign(this.velocity),this.animatedScroll=n,this.setScroll(this.scroll),p&&(this.targetScroll=n),a||this.emit(),a&&(this.reset(),this.emit(),d?.(this),this.userData={},this.preventNextNativeScrollEvent())}})}}}preventNextNativeScrollEvent(){this._preventNextNativeScrollEvent=!0,requestAnimationFrame(()=>{this._preventNextNativeScrollEvent=!1})}get rootElement(){return this.options.wrapper===window?document.documentElement:this.options.wrapper}get limit(){return this.options.__experimental__naiveDimensions?this.isHorizontal?this.rootElement.scrollWidth-this.rootElement.clientWidth:this.rootElement.scrollHeight-this.rootElement.clientHeight:this.dimensions.limit[this.isHorizontal?"x":"y"]}get isHorizontal(){return this.options.orientation==="horizontal"}get actualScroll(){return this.isHorizontal?this.rootElement.scrollLeft:this.rootElement.scrollTop}get scroll(){return this.options.infinite?x(this.animatedScroll,this.limit):this.animatedScroll}get progress(){return this.limit===0?1:this.scroll/this.limit}get isScrolling(){return this._isScrolling}set isScrolling(t){this._isScrolling!==t&&(this._isScrolling=t,this.updateClassName())}get isStopped(){return this._isStopped}set isStopped(t){this._isStopped!==t&&(this._isStopped=t,this.updateClassName())}get isLocked(){return this._isLocked}set isLocked(t){this._isLocked!==t&&(this._isLocked=t,this.updateClassName())}get isSmooth(){return this.isScrolling==="smooth"}get className(){let t="lenis";return this.isStopped&&(t+=" lenis-stopped"),this.isLocked&&(t+=" lenis-locked"),this.isScrolling&&(t+=" lenis-scrolling"),this.isScrolling==="smooth"&&(t+=" lenis-smooth"),t}updateClassName(){this.cleanUpClassName(),this.rootElement.className=`${this.rootElement.className} ${this.className}`.trim()}cleanUpClassName(){this.rootElement.className=this.rootElement.className.replace(/lenis(-\w+)?/g,"").trim()}};
  window.Lenis = L;
  globalThis.Lenis = L;
})();

// ============================================================================
// 2. ATS Tekno Scroll & Framer Reveal Controller
// ============================================================================
(function() {
  'use strict';

  let lenisInstance = null;
  const registeredElements = new Set();
  let intersectionObserver = null;

  // --------------------------------------------------------------------------
  // Auto-inject CSS rules to guarantee styles work even if .css file was 404
  // --------------------------------------------------------------------------
  function ensureStyles() {
    if (document.getElementById('ats-scroll-effects-runtime-css')) return;
    const style = document.createElement('style');
    style.id = 'ats-scroll-effects-runtime-css';
    style.textContent = `
      html { scroll-behavior: auto !important; }
      html.lenis, html.lenis body { height: auto; }
      .lenis.lenis-smooth { scroll-behavior: auto !important; }
      .lenis.lenis-smooth [data-lenis-prevent] { overscroll-behavior: contain; }
      .lenis.lenis-stopped { overflow: hidden; }
      .lenis.lenis-scrolling iframe { pointer-events: none; }
      .ats-word-mask { display: inline-block; overflow: hidden; vertical-align: top; line-height: inherit; padding-bottom: 0.14em; margin-bottom: -0.14em; }
      .ats-reveal-word {
        display: inline-block;
        transform: translate3d(0, 118%, 0) rotate(2.5deg);
        opacity: 0;
        filter: blur(5px);
        will-change: transform, opacity, filter;
        transition: transform 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                    opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                    filter 0.65s ease;
        transition-delay: calc(var(--word-index, 0) * 28ms + var(--base-delay, 0ms));
        transform-origin: 0% 100%;
      }
      .is-in-view .ats-reveal-word, .ats-reveal-active .ats-reveal-word {
        transform: translate3d(0, 0%, 0) rotate(0deg);
        opacity: 1;
        filter: blur(0px);
      }
      [data-reveal-scrub] .ats-word-mask, .reveal-text-scrub .ats-word-mask { overflow: visible; }
      [data-reveal-scrub] .ats-reveal-word, .reveal-text-scrub .ats-reveal-word {
        transform: none;
        filter: none;
        opacity: 0.22;
        transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), color 0.35s ease, text-shadow 0.35s ease;
      }
      [data-reveal-scrub] .ats-reveal-word.is-scrubbed, .reveal-text-scrub .ats-reveal-word.is-scrubbed {
        opacity: 1;
      }
      .reveal-fade-up {
        opacity: 0;
        transform: translate3d(0, 28px, 0);
        transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
      }
      .is-in-view.reveal-fade-up, .is-in-view .reveal-fade-up {
        opacity: 1;
        transform: translate3d(0, 0, 0);
      }
      @media (prefers-reduced-motion: reduce) {
        .ats-word-mask { overflow: visible !important; }
        .ats-reveal-word { transform: none !important; opacity: 1 !important; filter: none !important; transition: none !important; }
        .reveal-fade-up { transform: none !important; opacity: 1 !important; transition: none !important; }
        html.lenis { scroll-behavior: auto !important; }
      }
    `;
    document.head.appendChild(style);
  }

  // --------------------------------------------------------------------------
  // Lenis Smooth Scroll Initialization
  // --------------------------------------------------------------------------
  function initLenis() {
    if (typeof Lenis === 'undefined') {
      console.warn('[ATS Scroll] Lenis library not found.');
      return;
    }

    try {
      lenisInstance = new Lenis({
        autoRaf: true,
        smoothWheel: true,
        duration: 1.35,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        wheelMultiplier: 1.25,
        touchMultiplier: 2.2,
        infinite: false,
      });

      window.atsLenis = lenisInstance;
      lenisInstance.on('scroll', onScrollUpdate);
    } catch (err) {
      console.error('[ATS Scroll] Error initializing Lenis:', err);
    }
  }

  window.addEventListener('scroll', onScrollUpdate, { passive: true });

  // --------------------------------------------------------------------------
  // Framer-style Text Splitting & Word Masking
  // --------------------------------------------------------------------------
  function splitContainerText(container, startIndex = 0, baseDelayMs = 0) {
    let wordIndex = startIndex;
    const childNodes = Array.from(container.childNodes);

    childNodes.forEach(node => {
      if (node.nodeType === Node.TEXT_NODE) {
        const text = node.textContent;
        if (!text || text.trim() === '') return;

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
            if (baseDelayMs > 0) {
              word.style.setProperty('--base-delay', baseDelayMs + 'ms');
            }
            wordIndex++;

            mask.appendChild(word);
            frag.appendChild(mask);
          }
        });

        container.replaceChild(frag, node);
      } else if (node.nodeType === Node.ELEMENT_NODE) {
        if (node.tagName === 'BR') return;
        if (!node.classList.contains('ats-word-mask') && !node.classList.contains('ats-reveal-word')) {
          wordIndex = splitContainerText(node, wordIndex, baseDelayMs);
        }
      }
    });

    return wordIndex;
  }

  function splitElementIntoWords(el, force = false) {
    if (!force && el.dataset.atsSplit === 'true' && el.querySelector('.ats-reveal-word')) return;

    const baseDelay = el.classList.contains('hero-subheadline') ? 220 : 0;

    const enChild = el.querySelector('.ats-lang-en');
    const idChild = el.querySelector('.ats-lang-id');

    if (enChild && idChild) {
      splitContainerText(enChild, 0, baseDelay);
      splitContainerText(idChild, 0, baseDelay);
    } else {
      splitContainerText(el, 0, baseDelay);
    }

    el.dataset.atsSplit = 'true';
  }

  // --------------------------------------------------------------------------
  // Observer & Animation Triggering
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

  function attachElements(forceResplit = false) {
    ensureStyles();
    setupObserver();

    // 1. Text elements that get word-by-word mask reveal
    const textSelectors = [
      '[data-reveal-text]',
      '.reveal-text-on-scroll',
      '.hero-headline',
      '.hero-subheadline',
      '.figma-products-headline',
      '.p3d-title',
      '.articles-main-title',
      '.feature-title',
      '.trusted-label-over',
      '.trusted-company-text',
      '.section-title',
      '.section-reveal-title',
      '.footer-cta-title',
      '.ats-ft-cta-title'
    ];

    const textTargets = document.querySelectorAll(textSelectors.join(', '));
    textTargets.forEach(el => {
      splitElementIntoWords(el, forceResplit);
      registeredElements.add(el);

      if (!el.hasAttribute('data-reveal-scrub')) {
        intersectionObserver.observe(el);
      }

      // Check if already in viewport on page load
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight * 0.88 && rect.bottom > 0) {
        setTimeout(() => {
          el.classList.add('is-in-view');
        }, el.classList.contains('hero-headline') ? 140 : 40);
      }
    });

    // 2. Card elements that get smooth staggered fade-slide
    const cardSelectors = [
      '.feature-card',
      '.catalog-item-card',
      '.p3d-card',
      '.article-card'
    ];
    const cardTargets = document.querySelectorAll(cardSelectors.join(', '));
    cardTargets.forEach((card, idx) => {
      if (!card.classList.contains('reveal-fade-up')) {
        card.classList.add('reveal-fade-up');
        card.style.transitionDelay = (idx % 4 * 90) + 'ms';
      }
      intersectionObserver.observe(card);

      const rect = card.getBoundingClientRect();
      if (rect.top < window.innerHeight * 0.90 && rect.bottom > 0) {
        setTimeout(() => {
          card.classList.add('is-in-view');
        }, 80);
      }
    });
  }

  // --------------------------------------------------------------------------
  // Scroll-Scrub Reveal (Framer Progressive Illumination Mode)
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
  // Re-synchronize on Language Change or Dynamic DOM Updates
  // --------------------------------------------------------------------------
  window.addEventListener('atsLanguageChanged', () => {
    setTimeout(() => {
      attachElements(true);
    }, 20);
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
