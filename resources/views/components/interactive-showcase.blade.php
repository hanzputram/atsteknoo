<!-- ========================================================
     INTERACTIVE SHOWCASE DECK: ENGINEERING EXCELLENCE & ABOUT US
     Concept inspired by modern presentation card deck (Markus style)
     Tailored to ATS TEKNO Industrial Slate, Navy & Crisp Glass aesthetic
     ======================================================== -->
<style>
  .ats-showcase-section {
    position: relative;
    width: 100%;
    margin: 20px auto 40px auto;
    box-sizing: border-box;
  }

  /* Main Container Frame */
  .ats-showcase-container {
    background: linear-gradient(135deg, #0A1120 0%, #0F172A 60%, #1E293B 100%);
    border-radius: 36px;
    padding: 40px 44px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.05);
    position: relative;
    overflow: hidden;
  }

  /* Decorative Ambient Background Gradients (Subtle Electrical Glow, No Pink) */
  .ats-showcase-container::before {
    content: '';
    position: absolute;
    top: -120px;
    right: -100px;
    width: 450px;
    height: 450px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(6, 182, 212, 0.08) 50%, transparent 70%);
    pointer-events: none;
    z-index: 1;
    filter: blur(40px);
  }

  .ats-showcase-container::after {
    content: '';
    position: absolute;
    bottom: -100px;
    left: 10%;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 65%);
    pointer-events: none;
    z-index: 1;
    filter: blur(40px);
  }

  /* Top Header with Deck Tab Switcher */
  .ats-showcase-header {
    position: relative;
    z-index: 5;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .ats-showcase-title-wrap {
    max-width: 580px;
  }

  .ats-showcase-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #38BDF8;
    background: rgba(56, 189, 248, 0.1);
    border: 1px solid rgba(56, 189, 248, 0.25);
    padding: 4px 12px;
    border-radius: 999px;
    margin-bottom: 12px;
  }

  .ats-showcase-heading {
    font-size: clamp(1.85rem, 3.2vw, 2.6rem);
    font-weight: 800;
    color: #FFFFFF;
    line-height: 1.15;
    letter-spacing: -0.02em;
    margin: 0 0 10px 0;
  }

  .ats-showcase-heading span {
    background: linear-gradient(135deg, #FFFFFF 20%, #93C5FD 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  } 

  .ats-showcase-desc {
    font-size: 0.92rem;
    color: #94A3B8;
    line-height: 1.55;
    margin: 0;
  }

  /* Slide Tab Selector Pills (Presentation Deck Style) */
  .ats-deck-tabs-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(15, 23, 42, 0.7);
    padding: 6px;
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    flex-wrap: wrap;
  }

  .ats-deck-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 11px;
    border: none;
    background: transparent;
    color: #94A3B8;
    font-family: inherit;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .ats-deck-tab-btn:hover {
    color: #FFFFFF;
    background: rgba(255, 255, 255, 0.08);
  }

  .ats-deck-tab-btn.active {
    background: #FFFFFF;
    color: #0F172A;
    font-weight: 700;
    box-shadow: 0 4px 14px rgba(255, 255, 255, 0.2);
  }

  .ats-deck-tab-btn.active svg {
    color: #2563EB;
  }

  /* Deck Canvas Stage */
  .ats-deck-stage {
    position: relative;
    z-index: 5;
    min-height: 480px;
    width: 100%;
  }

  /* Slide Panels */
  .ats-deck-slide {
    display: none;
    opacity: 0;
    transform: translateY(12px);
    transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .ats-deck-slide.active {
    display: block;
    opacity: 1;
    transform: translateY(0);
  }

  /* ========================================================
     SLIDE 1: CENTER SUBJECT & FLOATING WIDGETS (EXACT MARKUS COMPOSITION)
     ======================================================== */
  .slide-hero-composition {
    display: grid;
    grid-template-columns: 1.15fr 1fr 1.15fr;
    align-items: center;
    gap: 24px;
    min-height: 480px;
    position: relative;
  }

  /* Central Portrait Visual with Circular Luminous Backplate */
  .deck-center-subject {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    min-height: 400px;
  }

  .deck-center-circle-bg {
    position: absolute;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1D4ED8 0%, #0284C7 50%, #0F172A 100%);
    box-shadow: 0 0 60px rgba(37, 99, 235, 0.35), inset 0 2px 20px rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.15);
    z-index: 1;
  }

  .deck-center-img-frame {
    position: relative;
    z-index: 2;
    width: 290px;
    height: 370px;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
    border: 1.5px solid rgba(255, 255, 255, 0.2);
    background: #000E1A;
  }

  .deck-center-img-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
  }

  /* Floating Year Pill Badge (Center Overlay like '2019' in reference) */
  .deck-floating-year-badge {
    position: absolute;
    bottom: -14px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(15, 23, 42, 0.92);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1.5px solid rgba(255, 255, 255, 0.25);
    padding: 6px 18px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
    z-index: 4;
    white-space: nowrap;
  }

  .deck-floating-year-badge .year-num {
    font-size: 1.15rem;
    font-weight: 800;
    color: #FFFFFF;
    letter-spacing: -0.01em;
  }

  .deck-floating-year-badge .year-label {
    font-size: 11px;
    font-weight: 600;
    color: #38BDF8;
    text-transform: uppercase;
    letter-spacing: 0.08em;
  }

  /* Left Side: Floating Quote & Profile Cards */
  .deck-left-widgets {
    display: flex;
    flex-direction: column;
    gap: 18px;
    z-index: 3;
  }

  .deck-quote-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 22px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    transition: transform 0.3s ease, border-color 0.3s ease;
  }

  .deck-quote-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.07);
  }

  .deck-quote-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
  }

  .deck-quote-avatar {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563EB, #0284C7);
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 15px;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
  }

  .deck-quote-author h4 {
    font-size: 15px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0;
  }

  .deck-quote-author p {
    font-size: 11.5px;
    color: #38BDF8;
    margin: 2px 0 0 0;
    font-weight: 500;
  }

  .deck-quote-text {
    font-size: 0.86rem;
    color: #CBD5E1;
    line-height: 1.55;
    margin: 0;
    font-style: italic;
  }

  /* Metric Pill on Left */
  .deck-stat-pill-card {
    background: rgba(255, 255, 255, 0.94);
    border-radius: 16px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.4);
  }

  .deck-stat-pill-card .stat-left-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .deck-stat-pill-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #EFF6FF;
    color: #2563EB;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .deck-stat-pill-card .stat-title {
    font-size: 12px;
    font-weight: 600;
    color: #475569;
  }

  .deck-stat-pill-card .stat-value {
    font-size: 18px;
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.02em;
  }

  /* Right Side: Skill / Metric Progress Bars & Target Badge */
  .deck-right-widgets {
    display: flex;
    flex-direction: column;
    gap: 14px;
    z-index: 3;
  }

  .deck-progress-widget {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    transition: transform 0.25s ease;
  }

  .deck-progress-widget:hover {
    transform: translateX(4px);
    border-color: rgba(255, 255, 255, 0.22);
  }

  .deck-progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-size: 13px;
    font-weight: 700;
    color: #FFFFFF;
  }

  .deck-progress-header .pct-badge {
    font-size: 12.5px;
    font-weight: 800;
    color: #38BDF8;
    background: rgba(56, 189, 248, 0.12);
    padding: 2px 8px;
    border-radius: 6px;
  }

  .deck-progress-bar-bg {
    width: 100%;
    height: 8px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 999px;
    overflow: hidden;
    position: relative;
  }

  .deck-progress-bar-fill {
    height: 100%;
    border-radius: 999px;
    transition: width 1s cubic-bezier(0.16, 1, 0.3, 1);
  }

  /* Floating Target / Seal Badge (Like Target Icon in reference) */
  .deck-target-badge-card {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(15, 23, 42, 0.6) 100%);
    border: 1px solid rgba(56, 189, 248, 0.3);
    border-radius: 16px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
  }

  .deck-target-icon-wrap {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #2563EB;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(37, 99, 235, 0.4);
    flex-shrink: 0;
  }

  .deck-target-info h5 {
    font-size: 13.5px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0;
  }

  .deck-target-info p {
    font-size: 11.5px;
    color: #94A3B8;
    margin: 2px 0 0 0;
  }

  /* ========================================================
     SLIDE 2: MISSION & QUALITY PILLARS (3-Card Layout)
     ======================================================== */
  .slide-pillars-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    align-items: stretch;
    min-height: 460px;
    padding: 10px 0;
  }

  .pillar-feature-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 24px;
    padding: 28px 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
  }

  .pillar-feature-card:hover {
    transform: translateY(-6px);
    border-color: rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
  }

  .pillar-top-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .pillar-step-badge {
    font-size: 1.75rem;
    font-weight: 800;
    color: rgba(255, 255, 255, 0.15);
    letter-spacing: -0.02em;
    font-variant-numeric: tabular-nums;
  }

  .pillar-icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
  }

  .pillar-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 10px 0;
    letter-spacing: -0.01em;
  }

  .pillar-desc {
    font-size: 0.88rem;
    color: #94A3B8;
    line-height: 1.6;
    margin: 0 0 20px 0;
  }

  .pillar-metric-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.06);
    color: #E2E8F0;
    border: 1px solid rgba(255, 255, 255, 0.1);
    width: fit-content;
  }

  /* ========================================================
     SLIDE 3: MEET OUR SPECIALIST TEAM (Avatar Pills & Roles)
     ======================================================== */
  .slide-team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    min-height: 460px;
    padding: 10px 0;
  }

  .team-profile-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 22px;
    padding: 24px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .team-profile-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.22);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.3);
  }

  .team-avatar-wrap {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 16px;
    position: relative;
    padding: 3px;
    background: linear-gradient(135deg, #2563EB, #38BDF8);
  }

  .team-avatar-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #0F172A;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFFFFF;
    font-size: 24px;
    font-weight: 800;
  }

  .team-member-name {
    font-size: 1.05rem;
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 4px 0;
  }

  .team-member-role {
    font-size: 0.8rem;
    font-weight: 600;
    color: #38BDF8;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .team-member-bio {
    font-size: 0.82rem;
    color: #94A3B8;
    line-height: 1.5;
    margin-bottom: 16px;
  }

  .team-skill-badge {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    color: #CBD5E1;
    font-weight: 600;
  }

  /* ========================================================
     SLIDE 4: MILESTONE TIMELINE (2019 -> 2026 Cards)
     ======================================================== */
  .slide-timeline-layout {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 30px;
    align-items: center;
    min-height: 460px;
    padding: 10px 0;
  }

  .timeline-cards-flow {
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .timeline-card-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 18px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 18px;
    transition: all 0.25s ease;
  }

  .timeline-card-item:hover {
    background: rgba(255, 255, 255, 0.09);
    border-color: rgba(255, 255, 255, 0.25);
    transform: translateX(6px);
  }

  .timeline-year-pill {
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 800;
    background: #FFFFFF;
    color: #0F172A;
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
  }

  .timeline-info-block h4 {
    font-size: 14.5px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 3px 0;
  }

  .timeline-info-block p {
    font-size: 12.5px;
    color: #94A3B8;
    line-height: 1.45;
    margin: 0;
  }

  .timeline-featured-preview {
    background: rgba(15, 23, 42, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.14);
    border-radius: 24px;
    padding: 26px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .timeline-preview-tag {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: #10B981;
    background: rgba(16, 185, 129, 0.12);
    padding: 4px 10px;
    border-radius: 6px;
    width: fit-content;
    text-transform: uppercase;
  }

  /* ========================================================
     SLIDE 5: TECHNICAL EXPERTISE MATRIX (Cards & Specs)
     ======================================================== */
  .slide-specs-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    min-height: 460px;
    padding: 10px 0;
  }

  .spec-feature-box {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 24px 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.25s ease;
  }

  .spec-feature-box:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.24);
    transform: translateY(-4px);
  }

  .spec-box-header {
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #38BDF8;
    margin-bottom: 10px;
  }

  .spec-box-rating {
    font-size: 1.85rem;
    font-weight: 800;
    color: #FFFFFF;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
  }

  .spec-box-desc {
    font-size: 0.84rem;
    color: #94A3B8;
    line-height: 1.5;
  }

  /* Bottom Controls: Slide Index & Nav Arrows */
  .ats-deck-controls-row {
    position: relative;
    z-index: 5;
    margin-top: 28px;
    padding-top: 18px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .ats-deck-indicator {
    font-size: 12px;
    font-weight: 700;
    color: #64748B;
    letter-spacing: 0.1em;
  }

  .ats-deck-indicator span {
    color: #FFFFFF;
  }

  .ats-deck-arrows {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .ats-deck-arrow-btn {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.16);
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .ats-deck-arrow-btn:hover {
    background: #FFFFFF;
    color: #0F172A;
    border-color: #FFFFFF;
    transform: scale(1.06);
  }

  /* Responsive Breakpoints */
  @media (max-width: 1100px) {
    .slide-hero-composition {
      grid-template-columns: 1fr;
      gap: 32px;
    }
    .deck-center-subject {
      order: 1;
      min-height: 340px;
    }
    .deck-left-widgets {
      order: 2;
    }
    .deck-right-widgets {
      order: 3;
    }
    .slide-pillars-grid,
    .slide-specs-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    .slide-team-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    .slide-timeline-layout {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .ats-showcase-container {
      padding: 24px 20px;
      border-radius: 24px;
    }
    .ats-deck-tabs-nav {
      width: 100%;
      overflow-x: auto;
    }
    .slide-pillars-grid,
    .slide-specs-grid,
    .slide-team-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<!-- SECTION ANCHOR: ABOUT US -->
<section class="ats-showcase-section" id="about">
  <div class="ats-showcase-container">

    <!-- Top Header: Title & Interactive Deck Switcher -->
    <div class="ats-showcase-header">
      <div class="ats-showcase-title-wrap">
        <div class="ats-showcase-eyebrow">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          Engineering Excellence &amp; Story
        </div>
        <h2 class="ats-showcase-heading">
          Empowering Industry with<br>
          <span>Precision &amp; Technical Reliability</span>
        </h2>
        <p class="ats-showcase-desc">
          Explore our certified capabilities, technical milestones, dedicated team, and high-performance low-voltage distribution systems.
        </p>
      </div>

      <!-- Presentation Deck Tabs -->
      <div class="ats-deck-tabs-nav" role="tablist">
        <button type="button" class="ats-deck-tab-btn active" onclick="switchShowcaseDeck(0)" id="deck-tab-0" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          01. Overview
        </button>
        <button type="button" class="ats-deck-tab-btn" onclick="switchShowcaseDeck(1)" id="deck-tab-1" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
          02. Mission
        </button>
        <button type="button" class="ats-deck-tab-btn" onclick="switchShowcaseDeck(2)" id="deck-tab-2" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          03. Team
        </button>
        <button type="button" class="ats-deck-tab-btn" onclick="switchShowcaseDeck(3)" id="deck-tab-3" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          04. Milestones
        </button>
        <button type="button" class="ats-deck-tab-btn" onclick="switchShowcaseDeck(4)" id="deck-tab-4" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          05. Expertise
        </button>
      </div>
    </div>

    <!-- Deck Stage -->
    <div class="ats-deck-stage">

      <!-- ========================================================
           SLIDE 0: OVERVIEW & LEADERSHIP (Markus Deck Composition)
           ======================================================== -->
      <div class="ats-deck-slide active" id="deck-slide-0">
        <div class="slide-hero-composition">

          <!-- Left Side: Floating Quote & Stat Card -->
          <div class="deck-left-widgets">
            <div class="deck-quote-card">
              <div class="deck-quote-header">
                <div class="deck-quote-avatar">ATS</div>
                <div class="deck-quote-author">
                  <h4>Engineering Commitment</h4>
                  <p>Chief Technical Director</p>
                </div>
              </div>
              <p class="deck-quote-text">
                "Precision in low-voltage electrical distribution is never an option—it is the foundational guarantee for industrial safety, continuous factory uptime, and long-term asset protection."
              </p>
            </div>

            <!-- Metric Pill Card -->
            <div class="deck-stat-pill-card">
              <div class="stat-left-wrap">
                <div class="deck-stat-pill-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div>
                  <div class="stat-title">Project Reliability</div>
                  <div class="stat-value">99.8% Uptime</div>
                </div>
              </div>
              <span style="font-size: 11px; font-weight: 700; color: #059669; background: #ECFDF5; padding: 4px 8px; border-radius: 6px;">Verified</span>
            </div>

            <div class="deck-stat-pill-card">
              <div class="stat-left-wrap">
                <div class="deck-stat-pill-icon" style="background: #FEF3C7; color: #D97706;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
                <div>
                  <div class="stat-title">Central Stock Inventory</div>
                  <div class="stat-value">12,000+ SKUs</div>
                </div>
              </div>
              <span style="font-size: 11px; font-weight: 700; color: #2563EB; background: #EFF6FF; padding: 4px 8px; border-radius: 6px;">Surabaya</span>
            </div>
          </div>

          <!-- Center: Subject Portrait with Circular Backplate -->
          <div class="deck-center-subject">
            <div class="deck-center-circle-bg"></div>
            <div class="deck-center-img-frame">
              <img src="{{ asset('images/engineer-studio.jpg') }}" alt="Chief Electrical Engineer - PT. Anugerah Tama Sejati" loading="lazy">
            </div>
            <!-- Floating Year Milestone Badge -->
            <div class="deck-floating-year-badge">
              <span class="year-num">2019</span>
              <span class="year-label">Established &bull; Surabaya</span>
            </div>
          </div>

          <!-- Right Side: Progress Bars & Target Badge -->
          <div class="deck-right-widgets">
            <!-- Progress Bar 1 -->
            <div class="deck-progress-widget">
              <div class="deck-progress-header">
                <span>LV Switchboard Fabrication</span>
                <span class="pct-badge">99%</span>
              </div>
              <div class="deck-progress-bar-bg">
                <div class="deck-progress-bar-fill" style="width: 99%; background: linear-gradient(90deg, #2563EB, #38BDF8);"></div>
              </div>
            </div>

            <!-- Progress Bar 2 -->
            <div class="deck-progress-widget">
              <div class="deck-progress-header">
                <span>Schneider Integration Compliance</span>
                <span class="pct-badge" style="color: #10B981; background: rgba(16, 185, 129, 0.12);">100%</span>
              </div>
              <div class="deck-progress-bar-bg">
                <div class="deck-progress-bar-fill" style="width: 100%; background: linear-gradient(90deg, #059669, #10B981);"></div>
              </div>
            </div>

            <!-- Progress Bar 3 -->
            <div class="deck-progress-widget">
              <div class="deck-progress-header">
                <span>Same-Day Stock Dispatch</span>
                <span class="pct-badge" style="color: #F59E0B; background: rgba(245, 158, 11, 0.12);">95%</span>
              </div>
              <div class="deck-progress-bar-bg">
                <div class="deck-progress-bar-fill" style="width: 95%; background: linear-gradient(90deg, #D97706, #FBBF24);"></div>
              </div>
            </div>

            <!-- Floating Target / Certification Badge -->
            <div class="deck-target-badge-card">
              <div class="deck-target-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
              </div>
              <div class="deck-target-info">
                <h5>Certified Panel Maker</h5>
                <p>IEC 61439-1/2 Compliance &amp; Factory Testing</p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ========================================================
           SLIDE 1: MISSION & PILLARS
           ======================================================== -->
      <div class="ats-deck-slide" id="deck-slide-1">
        <div class="slide-pillars-grid">
          <!-- Pillar 1 -->
          <div class="pillar-feature-card">
            <div>
              <div class="pillar-top-row">
                <div class="pillar-icon-box" style="background: rgba(37, 99, 235, 0.15); color: #38BDF8; border: 1px solid rgba(56, 189, 248, 0.3);">
                  <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <span class="pillar-step-badge">01</span>
              </div>
              <h3 class="pillar-title">100% Authenticity Guarantee</h3>
              <p class="pillar-desc">
                We supply exclusively genuine components procured directly from global brand principals (Schneider Electric, Legrand, GAE). Every breaker and drive carries verifiable serial numbers and authentic manufacturer warranty.
              </p>
            </div>
            <div class="pillar-metric-tag">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              Direct Authorized Distribution
            </div>
          </div>

          <!-- Pillar 2 -->
          <div class="pillar-feature-card">
            <div>
              <div class="pillar-top-row">
                <div class="pillar-icon-box" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3);">
                  <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <span class="pillar-step-badge">02</span>
              </div>
              <h3 class="pillar-title">Immediate Stock Fulfillment</h3>
              <p class="pillar-desc">
                Industrial downtime cannot wait. With multi-point hubs across Surabaya and Pandaan, we keep critical Air Circuit Breakers, MCCBs, Contactors, and Altivar inverters on shelf for fast emergency delivery.
              </p>
            </div>
            <div class="pillar-metric-tag" style="color: #6EE7B7; border-color: rgba(16, 185, 129, 0.25);">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              Multi-Point East Java Warehouses
            </div>
          </div>

          <!-- Pillar 3 -->
          <div class="pillar-feature-card">
            <div>
              <div class="pillar-top-row">
                <div class="pillar-icon-box" style="background: rgba(245, 158, 11, 0.15); color: #FBBF24; border: 1px solid rgba(245, 158, 11, 0.3);">
                  <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <span class="pillar-step-badge">03</span>
              </div>
              <h3 class="pillar-title">Certified Panel Assembly</h3>
              <p class="pillar-desc">
                From Main Distribution Switchboards (MDB) to Sub-Distribution, Capacitor Banks, and Synchronizing AMF-ATS panels, our specialized workshop builds custom panels complying strictly with IEC electrical safety codes.
              </p>
            </div>
            <div class="pillar-metric-tag" style="color: #FCD34D; border-color: rgba(245, 158, 11, 0.25);">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              IEC 61439 Certified Fabrication
            </div>
          </div>
        </div>
      </div>

      <!-- ========================================================
           SLIDE 2: MEET OUR SPECIALIST TEAM
           ======================================================== -->
      <div class="ats-deck-slide" id="deck-slide-2">
        <div class="slide-team-grid">
          <!-- Member 1 -->
          <div class="team-profile-card">
            <div class="team-avatar-wrap">
              <div class="team-avatar-inner">SE</div>
            </div>
            <h4 class="team-member-name">Switchboard Design</h4>
            <div class="team-member-role">SLD &amp; Layout Engineering</div>
            <p class="team-member-bio">Specializing in busbar current density sizing, thermal dissipation simulations, and custom enclosure engineering.</p>
            <span class="team-skill-badge">AutoCAD &bull; IEC Standards</span>
          </div>

          <!-- Member 2 -->
          <div class="team-profile-card">
            <div class="team-avatar-wrap" style="background: linear-gradient(135deg, #059669, #10B981);">
              <div class="team-avatar-inner">AE</div>
            </div>
            <h4 class="team-member-name">Automation &amp; Drives</h4>
            <div class="team-member-role">VFD &amp; PLC Integration</div>
            <p class="team-member-bio">Configuration of Altivar ATV630/930 drives, motor starting relays, and Modbus/Ethernet industrial telemetry.</p>
            <span class="team-skill-badge">Altivar &bull; TeSys Controls</span>
          </div>

          <!-- Member 3 -->
          <div class="team-profile-card">
            <div class="team-avatar-wrap" style="background: linear-gradient(135deg, #D97706, #FBBF24);">
              <div class="team-avatar-inner">QA</div>
            </div>
            <h4 class="team-member-name">Quality Assurance</h4>
            <div class="team-member-role">Dielectric &amp; Trip Testing</div>
            <p class="team-member-bio">Rigorous insulation resistance testing, primary injection secondary testing, and trip unit calibration.</p>
            <span class="team-skill-badge">Megger &bull; Hi-Pot Testing</span>
          </div>

          <!-- Member 4 -->
          <div class="team-profile-card">
            <div class="team-avatar-wrap" style="background: linear-gradient(135deg, #7C3AED, #A855F7);">
              <div class="team-avatar-inner">CS</div>
            </div>
            <h4 class="team-member-name">Site Commissioning</h4>
            <div class="team-member-role">On-Site Energization</div>
            <p class="team-member-bio">Coordinating power energization, sync testing for AMF-ATS generators, and client facility operator training.</p>
            <span class="team-skill-badge">24/7 Field Support</span>
          </div>
        </div>
      </div>

      <!-- ========================================================
           SLIDE 3: JOURNEY & MILESTONES (2019 - 2026)
           ======================================================== -->
      <div class="ats-deck-slide" id="deck-slide-3">
        <div class="slide-timeline-layout">
          <!-- Flow of timeline cards -->
          <div class="timeline-cards-flow">
            <div class="timeline-card-item">
              <div class="timeline-year-pill">2019</div>
              <div class="timeline-info-block">
                <h4>Company Establishment in Surabaya</h4>
                <p>PT. Anugerah Tama Sejati was founded with the mission to provide reliable, authentic electrical distribution supplies to East Java industries.</p>
              </div>
            </div>

            <div class="timeline-card-item">
              <div class="timeline-year-pill" style="background: #EFF6FF; color: #2563EB;">2021</div>
              <div class="timeline-info-block">
                <h4>Custom Panel Builder Facility</h4>
                <p>Invested in specialized switchboard manufacturing machinery, certified assembly workshop, and copper busbar processing line.</p>
              </div>
            </div>

            <div class="timeline-card-item">
              <div class="timeline-year-pill" style="background: #ECFDF5; color: #059669;">2024</div>
              <div class="timeline-info-block">
                <h4>Official Schneider &amp; Legrand Partnership</h4>
                <p>Awarded Authorized Schneider Electric Dealer status and official distributor partnership for Legrand and GAE Group products.</p>
              </div>
            </div>

            <div class="timeline-card-item">
              <div class="timeline-year-pill" style="background: #FFFBEB; color: #D97706;">2026</div>
              <div class="timeline-info-block">
                <h4>Pandaan Hub &amp; Digital Supply Operations</h4>
                <p>Expansion of the modern showroom in The Taman Dayu Pandaan and deployment of computerized inventory tracking for rapid project dispatch.</p>
              </div>
            </div>
          </div>

          <!-- Featured Milestone Card -->
          <div class="timeline-featured-preview">
            <span class="timeline-preview-tag">Growth Milestone</span>
            <h3 style="font-size: 1.4rem; font-weight: 800; color: #FFFFFF; margin: 0; letter-spacing: -0.01em;">
              Over 7 Years of Industrial Trust Across Indonesia
            </h3>
            <p style="font-size: 0.88rem; color: #CBD5E1; line-height: 1.6; margin: 0;">
              From supplying single breaker components to engineering complete main distribution centers for mega superblocks, cold storage, and food manufacturing facilities.
            </p>
            <div style="display: flex; gap: 12px; margin-top: 6px;">
              <div style="background: rgba(255,255,255,0.06); padding: 10px 14px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                <div style="font-size: 1.3rem; font-weight: 800; color: #38BDF8;">1,000+</div>
                <div style="font-size: 11px; color: #94A3B8;">Corporate Clients</div>
              </div>
              <div style="background: rgba(255,255,255,0.06); padding: 10px 14px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                <div style="font-size: 1.3rem; font-weight: 800; color: #10B981;">100%</div>
                <div style="font-size: 11px; color: #94A3B8;">Certified Quality</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ========================================================
           SLIDE 4: TECHNICAL EXPERTISE MATRIX
           ======================================================== -->
      <div class="ats-deck-slide" id="deck-slide-4">
        <div class="slide-specs-grid">
          <div class="spec-feature-box">
            <div>
              <div class="spec-box-header">Current Rating</div>
              <div class="spec-box-rating">Up to 6,300A</div>
              <p class="spec-box-desc">Main Distribution Switchboards engineered for heavy industrial power loads utilizing MasterPact MTZ and NW breakers.</p>
            </div>
            <span class="pillar-metric-tag">High Capacity</span>
          </div>

          <div class="spec-feature-box">
            <div>
              <div class="spec-box-header">Short-Circuit Withstand</div>
              <div class="spec-box-rating">100 kA / 1s</div>
              <p class="spec-box-desc">Busbar mechanical structures calculated to withstand catastrophic short-circuit electromagnetic stresses safely.</p>
            </div>
            <span class="pillar-metric-tag" style="color: #6EE7B7;">Heavy Duty</span>
          </div>

          <div class="spec-feature-box">
            <div>
              <div class="spec-box-header">Weatherproof Ingress</div>
              <div class="spec-box-rating">IP40 - IP66</div>
              <p class="spec-box-desc">Plexo and XL³ modular enclosures resisting severe chemical, coastal, moisture, and particulate environments.</p>
            </div>
            <span class="pillar-metric-tag" style="color: #FCD34D;">Corrosion Resistant</span>
          </div>

          <div class="spec-feature-box">
            <div>
              <div class="spec-box-header">Form Separation</div>
              <div class="spec-box-rating">Form 2b to 4b</div>
              <p class="spec-box-desc">Internal compartmentalization shielding operators and isolating functional units during live maintenance work.</p>
            </div>
            <span class="pillar-metric-tag" style="color: #C084FC;">Operator Safety</span>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom Controls: Slide Counter & Nav Arrows -->
    <div class="ats-deck-controls-row">
      <div class="ats-deck-indicator">
        DECK SLIDE <span id="deckCurrentSlide">01</span> / 05
      </div>
      <div class="ats-deck-arrows">
        <button type="button" class="ats-deck-arrow-btn" onclick="prevShowcaseDeck()" aria-label="Previous Slide">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <button type="button" class="ats-deck-arrow-btn" onclick="nextShowcaseDeck()" aria-label="Next Slide">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>
    </div>

  </div>
</section>

<!-- JAVASCRIPT LOGIC FOR INTERACTIVE DECK -->
<script>
  let currentDeckIndex = 0;
  const totalDeckSlides = 5;

  function switchShowcaseDeck(index) {
    if (index < 0) index = totalDeckSlides - 1;
    if (index >= totalDeckSlides) index = 0;
    currentDeckIndex = index;

    // 1. Update Tabs
    for (let i = 0; i < totalDeckSlides; i++) {
      const tab = document.getElementById('deck-tab-' + i);
      const slide = document.getElementById('deck-slide-' + i);
      if (tab) {
        if (i === index) {
          tab.classList.add('active');
          tab.setAttribute('aria-selected', 'true');
        } else {
          tab.classList.remove('active');
          tab.setAttribute('aria-selected', 'false');
        }
      }
      if (slide) {
        if (i === index) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      }
    }

    // 2. Update Indicator
    const indicatorEl = document.getElementById('deckCurrentSlide');
    if (indicatorEl) {
      indicatorEl.textContent = '0' + (index + 1);
    }
  }

  function nextShowcaseDeck() {
    switchShowcaseDeck(currentDeckIndex + 1);
  }

  function prevShowcaseDeck() {
    switchShowcaseDeck(currentDeckIndex - 1);
  }
</script>
