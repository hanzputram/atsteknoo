<!-- ========================================================
     ENDLESS 3D CAROUSEL: OUR PROJECTS (FRAMER-INSPIRED)
     PT. Anugerah Tama Sejati - Engineering Case Studies
     ======================================================== -->

<section class="p3d-section-wrapper" id="our-projects">
  <div class="p3d-container">
    <!-- Section Header (English / Indonesian) -->
    <div class="p3d-header">
      <h2 class="p3d-title" data-i18n="projects.title">Flagship Projects &amp; Electrical Engineering Portfolio</h2>
      <p class="p3d-subtitle" data-i18n="projects.subtitle">
        Proven track record in supplying industrial electrical distribution switchboards, certified automation systems, and critical power infrastructure across Indonesia.
      </p>
    </div>
  </div>

  <!-- 3D Carousel Stage Area -->
  <div class="p3d-stage-wrapper" id="p3dStage">
    <!-- Atmospheric Edge Fog Masks (Framer Fog Fade) -->
    <div class="p3d-fog-edge p3d-fog-left" aria-hidden="true"></div>
    <div class="p3d-fog-edge p3d-fog-right" aria-hidden="true"></div>

    <!-- 3D Viewport -->
    <div class="p3d-viewport" id="p3dViewport">
      <!-- 3D Cylinder Anchor -->
      <div class="p3d-cylinder" id="p3dCylinder">

        @php
          $projectData = [
            [
              'title' => 'Pakuwon Mall & Superblock Power Substation',
              'badge' => 'Commercial High-Rise',
              'badge_color' => '#E11D48',
              'location' => 'West Surabaya, Indonesia',
              'year' => '2024',
              'image' => asset('images/projects/project-1-substation.jpg'),
              'specs' => 'Schneider MasterPact MTZ 3200A • GAE Capacitor 600kVAR',
            ],
            [
              'title' => 'Indofood CBP Motor Control Center (MCC)',
              'badge' => 'Food & Beverage',
              'badge_color' => '#10B981',
              'location' => 'Pasuruan, East Java',
              'year' => '2024',
              'image' => asset('images/projects/project-2-indofood-mcc.jpg'),
              'specs' => 'Schneider Altivar ATV930 VFD • TeSys Deca Contactors',
            ],
            [
              'title' => 'PT Bumi Menara Internusa Cold Chain & SCADA',
              'badge' => 'Cold Storage & SCADA',
              'badge_color' => '#0284C7',
              'location' => 'Dampit & Surabaya',
              'year' => '2023 - 2024',
              'image' => asset('images/projects/project-3-coldstorage.jpg'),
              'specs' => 'Socomec ATS 1600A • GAE Digital Power Metering',
            ],
            [
              'title' => 'PT Dua Kelinci Packaging Automation',
              'badge' => 'Smart Automation',
              'badge_color' => '#D97706',
              'location' => 'Pati, Central Java',
              'year' => '2024',
              'image' => asset('images/projects/project-4-scada-control.jpg'),
              'specs' => 'Autonics Sensors • Legrand XL³ Panels • Schneider PLC',
            ],
            [
              'title' => 'Charoen Pokphand MV Switchgear & Feedmill',
              'badge' => 'Agro-Industrial MV',
              'badge_color' => '#9333EA',
              'location' => 'Sidoarjo, East Java',
              'year' => '2023',
              'image' => asset('images/projects/project-5-packaging-vfd.jpg'),
              'specs' => 'Schneider MasterPact 2500A • Supreme XLPE Cables',
            ],
            [
              'title' => 'Freeport Smelter Heavy Industrial Switchgear',
              'badge' => 'Heavy Mining & Smelter',
              'badge_color' => '#BE123C',
              'location' => 'JIIPE SEZ, Gresik',
              'year' => '2024',
              'image' => asset('images/projects/project-6-smelter-heavy.jpg'),
              'specs' => 'Schneider MasterPact NW 4000A • IP66 Enclosures',
            ],
            [
              'title' => 'Surabaya Tier-3 Data Center Power Busway',
              'badge' => 'Critical Infrastructure',
              'badge_color' => '#06B6D4',
              'location' => 'Central Surabaya',
              'year' => '2024',
              'image' => asset('images/projects/project-7-datacenter-busway.jpg'),
              'specs' => 'Dual Redundant Busway Trunking • Legrand Modular PDU',
            ],
            [
              'title' => 'Maspion Industrial Estate 20kV Substation',
              'badge' => 'Industrial Estate 20kV',
              'badge_color' => '#6366F1',
              'location' => 'Manyar, Gresik',
              'year' => '2023 - 2024',
              'image' => asset('images/projects/project-8-industrial-park.jpg'),
              'specs' => 'Ring Main Unit (RMU) • GAE Metering • Jembo Cables',
            ],
            [
              'title' => 'Petrokimia Gresik Industrial Automation',
              'badge' => 'Chemical & Fertilizer',
              'badge_color' => '#059669',
              'location' => 'Gresik, East Java',
              'year' => '2024',
              'image' => asset('images/projects/project-1-substation.jpg'),
              'specs' => 'Schneider TeSys Contactors • Altivar Process Inverters',
            ],
            [
              'title' => 'Mayora Indah Food Processing MCC',
              'badge' => 'Food Manufacturing',
              'badge_color' => '#E11D48',
              'location' => 'Pasuruan, East Java',
              'year' => '2023 - 2024',
              'image' => asset('images/projects/project-2-indofood-mcc.jpg'),
              'specs' => 'Schneider Altivar 630 VFD • GAE Class 1 SPD',
            ],
            [
              'title' => 'Ciputra World Surabaya Power Center',
              'badge' => 'Commercial Complex',
              'badge_color' => '#2563EB',
              'location' => 'Mayjen Sungkono, Surabaya',
              'year' => '2024',
              'image' => asset('images/projects/project-3-coldstorage.jpg'),
              'specs' => 'Schneider MasterPact 4000A • Socomec ATS Units',
            ],
            [
              'title' => 'Teluk Lamong Port Terminal Infrastructure',
              'badge' => 'Port & Marine Logistics',
              'badge_color' => '#7C3AED',
              'location' => 'Surabaya Port Zone',
              'year' => '2023',
              'image' => asset('images/projects/project-4-scada-control.jpg'),
              'specs' => 'Heavy Duty Marine IP66 Panels • Fluke Power Analyzers',
            ],
          ];
        @endphp

        @foreach($projectData as $index => $item)
          <div class="p3d-card" data-slot="{{ $index }}" data-project-index="{{ $index }}" role="button" tabindex="0">
            <div class="p3d-card-inner">
              <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="p3d-card-img" loading="eager">
              <div class="p3d-card-scrim"></div>
              <div class="p3d-card-badge" style="background: {{ $item['badge_color'] }};">{{ $item['badge'] }}</div>
              <div class="p3d-card-content">
                <div class="p3d-card-meta">
                  <span>📍 {{ $item['location'] }}</span>
                  <span>•</span>
                  <span>{{ $item['year'] }}</span>
                </div>
                <h3 class="p3d-card-title">{{ $item['title'] }}</h3>
                <div class="p3d-card-specs">{{ $item['specs'] }}</div>
                <div class="p3d-card-cta">
                  <span>View Specifications</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>
</section>

<!-- ========================================================
     PROJECT DETAILS MODAL (FULL SPEC & CONSULTATION CTA)
     ======================================================== -->
<div class="p3d-modal-backdrop" id="projectDetailModal" onclick="closeProjectModal()">
  <div class="p3d-modal-window" onclick="event.stopPropagation()">
    <!-- Modal Close Button -->
    <button type="button" class="p3d-modal-close" onclick="closeProjectModal()" aria-label="Close modal">&times;</button>

    <!-- Modal Header Media -->
    <div class="p3d-modal-hero">
      <img src="" alt="Project Preview" id="p3dModalImg" class="p3d-modal-hero-img">
      <div class="p3d-modal-hero-scrim"></div>
      <div class="p3d-modal-hero-badge" id="p3dModalBadge">Commercial Substation</div>
      <div class="p3d-modal-hero-titles">
        <div class="p3d-modal-hero-meta" id="p3dModalMeta">📍 Surabaya • 2024</div>
        <h2 class="p3d-modal-hero-h2" id="p3dModalTitle">Project Name</h2>
      </div>
    </div>

    <!-- Modal Content Body -->
    <div class="p3d-modal-body">
      <div class="p3d-modal-grid">
        <!-- Left Column: Scope & Solution -->
        <div class="p3d-modal-info-col">
          <div class="p3d-modal-sec-title">Project Overview &amp; Technical Scope</div>
          <p class="p3d-modal-desc" id="p3dModalDesc">Project details...</p>

          <div class="p3d-modal-highlight-box">
            <div class="p3d-highlight-icon">⚡</div>
            <div class="p3d-highlight-text">
              <strong>Quality Standards &amp; Certification:</strong> All supplied components include official manufacturer Certificates of Origin (CoO) and warranties from Schneider Electric, Legrand, and GAE Group.
            </div>
          </div>
        </div>

        <!-- Right Column: BoQ Components & Direct Action -->
        <div class="p3d-modal-boq-col">
          <div class="p3d-modal-sec-title">Supplied Electrical Equipment (BoQ)</div>
          <ul class="p3d-modal-boq-list" id="p3dModalBoq">
            <!-- Dynamically populated -->
          </ul>

          <div class="p3d-modal-action-card">
            <h4>Planning a Similar Project?</h4>
            <p>Consult your Bill of Quantities (BoQ), switchboard sizing, or automation needs directly with our certified engineering specialists.</p>
            <a href="#" id="p3dModalWaBtn" target="_blank" class="p3d-modal-cta-btn">
              <span>Consult Engineering Team on WhatsApp</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     CSS STYLES FOR ENDLESS 3D CAROUSEL
     ======================================================== -->
<style>
  /* Root Section Styling (Seamless Pure White matching page canvas) */
  .p3d-section-wrapper {
    width: 100%;
    position: relative;
    padding: 56px 0 54px 0;
    background: #FFFFFF;
    overflow: hidden;
    box-sizing: border-box;
  }

  .p3d-container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
    position: relative;
    z-index: 2;
  }

  /* Section Header */
  .p3d-header {
    text-align: center;
    max-width: 820px;
    margin: 0 auto 36px auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
  }

  .p3d-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(225, 29, 72, 0.08);
    border: 1px solid rgba(225, 29, 72, 0.2);
    padding: 6px 16px;
    border-radius: 9999px;
  }

  .p3d-badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #E11D48;
    animation: p3dPulse 2s infinite ease-in-out;
  }

  @keyframes p3dPulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.85); }
  }

  .p3d-badge-text {
    font-size: 0.78rem;
    font-weight: 700;
    color: #BE123C;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }

  .p3d-title {
    font-size: clamp(2rem, 3.6vw, 2.75rem);
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.025em;
    line-height: 1.18;
    margin: 0;
  }

  .p3d-subtitle {
    font-size: clamp(0.95rem, 1.2vw, 1.06rem);
    color: #475569;
    line-height: 1.6;
    margin: 0;
    max-width: 760px;
  }

  /* ========================================================
     3D CAROUSEL STAGE & CYLINDER
     ======================================================== */
  .p3d-stage-wrapper {
    position: relative;
    width: 100%;
    height: 480px;
    margin: 10px 0 10px 0;
    overflow: hidden;
    user-select: none;
    cursor: grab;
    touch-action: pan-y;
  }

  .p3d-stage-wrapper.is-dragging {
    cursor: grabbing;
  }

  /* Atmospheric Fog Masks (Edge fade into background) */
  .p3d-fog-edge {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 220px;
    z-index: 50;
    pointer-events: none;
  }

  .p3d-fog-left {
    left: 0;
    background: linear-gradient(to right, #FFFFFF 25%, rgba(255, 255, 255, 0.8) 65%, rgba(255, 255, 255, 0) 100%);
  }

  .p3d-fog-right {
    right: 0;
    background: linear-gradient(to left, #FFFFFF 25%, rgba(255, 255, 255, 0.8) 65%, rgba(255, 255, 255, 0) 100%);
  }

  /* 3D Perspective Viewport */
  .p3d-viewport {
    width: 100%;
    height: 100%;
    perspective: 1300px;
    perspective-origin: 50% 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transform-style: preserve-3d;
  }

  /* 3D Cylinder Origin Anchor */
  .p3d-cylinder {
    position: relative;
    width: 0;
    height: 0;
    transform-style: preserve-3d;
  }

  /* Individual 3D Card (Transparent parent, clean lift without bottom artifacts) */
  .p3d-card {
    position: absolute;
    width: 260px;
    height: 385px;
    top: -192px;
    left: -130px;
    border-radius: 20px;
    background: transparent;
    transform-origin: 50% 50%;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    will-change: transform, opacity;
    cursor: pointer;
  }

  .p3d-card-inner {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    background: #0F172A;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    box-shadow: 0 16px 36px -10px rgba(15, 23, 42, 0.22), 0 0 0 1px rgba(255, 255, 255, 0.15) inset;
    transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.22s ease;
  }

  .p3d-card:hover .p3d-card-inner {
    transform: translateY(-8px);
    box-shadow: 0 20px 42px -10px rgba(15, 23, 42, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.22) inset;
  }

  .p3d-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    pointer-events: none;
    transition: transform 0.28s ease;
  }

  .p3d-card:hover .p3d-card-img {
    transform: scale(1.04);
  }

  /* Gradient Scrim for Text Readability */
  .p3d-card-scrim {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      180deg,
      rgba(15, 23, 42, 0.05) 0%,
      rgba(15, 23, 42, 0.3) 45%,
      rgba(15, 23, 42, 0.88) 80%,
      rgba(15, 23, 42, 0.98) 100%
    );
    pointer-events: none;
  }

  /* Category Tag */
  .p3d-card-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    color: #FFFFFF;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 9999px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    letter-spacing: 0.03em;
    z-index: 2;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }

  /* Card Content Overlay */
  .p3d-card-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px 18px 18px 18px;
    z-index: 3;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .p3d-card-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.74rem;
    color: #CBD5E1;
    font-weight: 500;
  }

  .p3d-card-title {
    font-size: 1.02rem;
    font-weight: 700;
    color: #FFFFFF;
    line-height: 1.25;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .p3d-card-specs {
    font-size: 0.72rem;
    color: #94A3B8;
    line-height: 1.35;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .p3d-card-cta {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.74rem;
    font-weight: 600;
    color: #FDA4AF;
    margin-top: 4px;
    transition: gap 0.2s ease, color 0.2s ease;
  }

  .p3d-card:hover .p3d-card-cta {
    color: #FFFFFF;
    gap: 8px;
  }

  /* ========================================================
     PROJECT DETAIL MODAL
     ======================================================== */
  .p3d-modal-backdrop {
    position: fixed !important;
    inset: 0 !important;
    background: rgba(15, 23, 42, 0.78);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 9999999 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }

  .p3d-modal-backdrop.is-open {
    opacity: 1;
    pointer-events: auto;
  }

  .p3d-modal-window {
    background: #FFFFFF;
    width: 100%;
    max-width: 840px;
    max-height: 90vh;
    border-radius: 28px;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4);
    transform: translateY(20px) scale(0.97);
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .p3d-modal-backdrop.is-open .p3d-modal-window {
    transform: translateY(0) scale(1);
  }

  .p3d-modal-close {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: rgba(15, 23, 42, 0.7);
    color: #FFFFFF;
    font-size: 24px;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.2s ease;
  }

  .p3d-modal-close:hover {
    background: #E11D48;
    transform: rotate(90deg);
  }

  .p3d-modal-hero {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
  }

  .p3d-modal-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .p3d-modal-hero-scrim {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.6) 60%, rgba(15, 23, 42, 0.95) 100%);
  }

  .p3d-modal-hero-badge {
    position: absolute;
    top: 24px;
    left: 28px;
    background: #E11D48;
    color: #FFFFFF;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 9999px;
    letter-spacing: 0.04em;
    z-index: 2;
  }

  .p3d-modal-hero-titles {
    position: absolute;
    bottom: 24px;
    left: 28px;
    right: 28px;
    z-index: 2;
  }

  .p3d-modal-hero-meta {
    font-size: 0.85rem;
    font-weight: 600;
    color: #FDA4AF;
    margin-bottom: 6px;
  }

  .p3d-modal-hero-h2 {
    font-size: clamp(1.35rem, 2.3vw, 1.8rem);
    font-weight: 800;
    color: #FFFFFF;
    line-height: 1.2;
    margin: 0;
  }

  .p3d-modal-body {
    padding: 28px;
  }

  .p3d-modal-grid {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 32px;
  }

  @media (max-width: 768px) {
    .p3d-modal-grid {
      grid-template-columns: 1fr;
      gap: 24px;
    }
  }

  .p3d-modal-sec-title {
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #0F172A;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .p3d-modal-sec-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #E2E8F0;
  }

  .p3d-modal-desc {
    font-size: 0.92rem;
    color: #475569;
    line-height: 1.65;
    margin: 0 0 18px 0;
  }

  .p3d-modal-highlight-box {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    padding: 14px 16px;
    font-size: 0.85rem;
    color: #334155;
    line-height: 1.5;
  }

  .p3d-highlight-icon {
    font-size: 1.25rem;
    flex-shrink: 0;
  }

  .p3d-modal-boq-list {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .p3d-modal-boq-list li {
    font-size: 0.85rem;
    color: #1E293B;
    background: #F1F5F9;
    border-radius: 10px;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
  }

  .p3d-modal-boq-list li::before {
    content: '✓';
    color: #10B981;
    font-weight: 800;
  }

  .p3d-modal-action-card {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
    border-radius: 18px;
    padding: 18px;
    color: #FFFFFF;
  }

  .p3d-modal-action-card h4 {
    font-size: 0.95rem;
    margin: 0 0 6px 0;
    font-weight: 700;
  }

  .p3d-modal-action-card p {
    font-size: 0.8rem;
    color: #94A3B8;
    line-height: 1.45;
    margin: 0 0 14px 0;
  }

  .p3d-modal-cta-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: #E11D48;
    color: #FFFFFF;
    font-size: 0.82rem;
    font-weight: 700;
    padding: 10px 16px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.2s ease;
    box-sizing: border-box;
  }

  .p3d-modal-cta-btn:hover {
    background: #BE123C;
    transform: translateY(-2px);
  }

  /* Responsive Adjustments */
  @media (max-width: 900px) {
    .p3d-stage-wrapper {
      height: 440px;
    }
    .p3d-card {
      width: 230px;
      height: 340px;
      top: -170px;
      left: -115px;
    }
    .p3d-fog-edge {
      width: 90px;
    }
  }

  @media (max-width: 600px) {
    .p3d-section-wrapper {
      padding: 56px 0 48px 0;
    }
    .p3d-stage-wrapper {
      height: 390px;
    }
    .p3d-card {
      width: 190px;
      height: 290px;
      top: -145px;
      left: -95px;
    }
    .p3d-card-title {
      font-size: 0.9rem;
    }
  }
</style>

<!-- ========================================================
     JAVASCRIPT LOGIC: 3D CYLINDRICAL MATH & PHYSICS DAMPING
     ======================================================== -->
<script>
  // Project Detailed Data Directory (English)
  const p3dProjectsData = [
    {
      title: "Pakuwon Mall & Superblock Power Substation",
      badge: "Commercial High-Rise",
      location: "West Surabaya, Indonesia",
      year: "2024",
      image: "{{ asset('images/projects/project-1-substation.jpg') }}",
      desc: "Procurement and turnkey supply of primary 20kV power substation equipment and Low Voltage Main Distribution Panels (LVMDP) for East Java's largest retail and superblock residential center. Engineered for seamless high-load continuity.",
      boq: [
        "Schneider MasterPact MTZ 3200A Air Circuit Breakers (ACB)",
        "Schneider ComPact NSX Molded Case Circuit Breakers (MCCB)",
        "GAE Automatic Power Factor Correction (PFC) Bank 600 kVAR",
        "Digital Multi-Function Power Quality & Harmonics Analyzer"
      ],
      waText: "Hello PT ATS, I would like to inquire about substation equipment and LVMDP panels similar to the Pakuwon Mall project."
    },
    {
      title: "Indofood CBP Motor Control Center (MCC)",
      badge: "Food & Beverage",
      location: "Pasuruan, East Java",
      year: "2024",
      image: "{{ asset('images/projects/project-2-indofood-mcc.jpg') }}",
      desc: "Custom assembly and supply of hygienic stainless-steel Motor Control Center (MCC) panels for high-throughput food processing lines. Features Schneider Altivar variable frequency drives for ultra-precise motor synchronization.",
      boq: [
        "Schneider Altivar Process ATV930 Variable Speed Drives",
        "Schneider TeSys Deca & TeSys F Heavy Duty Contactors",
        "Schneider TeSys LRD Electronic Thermal Overload Relays",
        "IP54 Stainless-Steel Enclosures & Emergency Safety Interlocks"
      ],
      waText: "Hello PT ATS, I would like a quotation for Motor Control Center (MCC) panels and Altivar VFDs for a food processing facility."
    },
    {
      title: "PT Bumi Menara Internusa Cold Chain & SCADA",
      badge: "Cold Storage & SCADA",
      location: "Dampit & Surabaya",
      year: "2023 - 2024",
      image: "{{ asset('images/projects/project-3-coldstorage.jpg') }}",
      desc: "Industrial power automation and backup transfer infrastructure for an export-grade seafood cold storage blast freezer (-25°C). Features sub-1.2 second automatic mains failure transfer and centralized SCADA power telemetry.",
      boq: [
        "Socomec Motorized Automatic Transfer Switch (ATS) 1600A",
        "GAE Digital Energy & Temperature Telemetry Instrumentation",
        "Schneider PowerLogic Smart Gateway & Industrial Ethernet",
        "GAE Class 1 Heavy-Duty Surge Protection Devices (SPD)"
      ],
      waText: "Hello PT ATS, I would like to discuss automatic transfer switches (ATS) and power monitoring for a cold storage facility."
    },
    {
      title: "PT Dua Kelinci Packaging Automation",
      badge: "Smart Automation",
      location: "Pati, Central Java",
      year: "2024",
      image: "{{ asset('images/projects/project-4-scada-control.jpg') }}",
      desc: "Modernization of high-speed sorting and packaging lines with integrated PLC controls, precision photoelectric sensors, and Legrand XL³ modular distribution enclosures for continuous 24/7 industrial production.",
      boq: [
        "Legrand XL³ Weatherproof Industrial Modular Enclosures",
        "Autonics High-Speed Photoelectric & Proximity Sensors",
        "Schneider Modicon High-Performance PLC Control System",
        "Industrial Interface Relays & Wiring Management Ducts"
      ],
      waText: "Hello PT ATS, I need information regarding Autonics sensors and Legrand panels for packaging automation machinery."
    },
    {
      title: "Charoen Pokphand MV Switchgear & Feedmill",
      badge: "Agro-Industrial MV",
      location: "Sidoarjo, East Java",
      year: "2023",
      image: "{{ asset('images/projects/project-5-packaging-vfd.jpg') }}",
      desc: "Medium voltage protection components and primary electrical distribution for animal feed milling operations. Accommodates heavy hammer mill and pelletizer motor starting loads with tailored harmonic mitigation.",
      boq: [
        "Schneider MasterPact 2500A 4-Pole Drawout Circuit Breakers",
        "Supreme XLPE 20kV & Low-Voltage Power Cables",
        "GAE Detuned Reactors & Harmonic Filtering Capacitors",
        "Digital Protection Relays & Current Transformers (CT)"
      ],
      waText: "Hello PT ATS, I would like to request a quotation for Supreme MV cables and Schneider ACBs for an agro-industrial plant."
    },
    {
      title: "Freeport Smelter Heavy Industrial Switchgear",
      badge: "Heavy Mining & Smelter",
      location: "JIIPE SEZ, Gresik",
      year: "2024",
      image: "{{ asset('images/projects/project-6-smelter-heavy.jpg') }}",
      desc: "Engineered electrical protection components built for severe corrosive industrial and marine atmospheres at a world-scale copper smelting facility. Designed to sustain up to 4000 Amperes continuously.",
      boq: [
        "Schneider MasterPact NW 4000A Heavy-Duty ACB",
        "Himel Industrial Molded Case Breakers & Isolators",
        "VINSA Industrial High-Torque Busbar Bracing & Terminals",
        "IP66 Heavy Weatherproof Sealed Enclosure Units"
      ],
      waText: "Hello PT ATS, we require heavy-duty 4000A circuit breakers and IP66 enclosures for an industrial smelting facility."
    },
    {
      title: "Surabaya Tier-3 Data Center Power Busway",
      badge: "Critical Infrastructure",
      location: "Central Surabaya",
      year: "2024",
      image: "{{ asset('images/projects/project-7-datacenter-busway.jpg') }}",
      desc: "Mission-critical dual redundant sandwich busway distribution (A+B feeder) powering enterprise cloud servers with 99.999% uptime reliability and hot-swappable modular expansion capability.",
      boq: [
        "High-Density Sandwich Busway Trunking System",
        "Legrand Modular Power Distribution Units (PDU)",
        "Fluke Power Quality & Thermal Monitoring Logging",
        "Schneider TeSys High-Speed Static Transfer Switches"
      ],
      waText: "Hello PT ATS, we are interested in busway trunking systems and modular PDUs for a Data Center project."
    },
    {
      title: "Maspion Industrial Estate 20kV Substation",
      badge: "Industrial Estate 20kV",
      location: "Manyar, Gresik",
      year: "2023 - 2024",
      image: "{{ asset('images/projects/project-8-industrial-park.jpg') }}",
      desc: "Primary 20kV Ring Main Unit (RMU) distribution network and secondary distribution boards powering multinational manufacturing plants across a 50-hectare industrial zone.",
      boq: [
        "Medium Voltage 20kV Ring Main Unit (RMU) Switchgear",
        "GAE Central Grounding & Lightning Protection Array",
        "Jembo MV Underground Shielded Power Cables",
        "GAE Multi-Channel Billing Energy Meters"
      ],
      waText: "Hello PT ATS, please provide information regarding 20kV RMU switchgear and grounding systems for an industrial estate."
    },
    {
      title: "Petrokimia Gresik Industrial Automation",
      badge: "Chemical & Fertilizer",
      location: "Gresik, East Java",
      year: "2024",
      image: "{{ asset('images/projects/project-1-substation.jpg') }}",
      desc: "Process control automation and motor protection relays for chemical fertilizer production facilities. Ensures continuous chemical processing with fail-safe electrical interlocks.",
      boq: [
        "Schneider TeSys Heavy Duty Industrial Contactors",
        "Schneider Altivar Process Variable Speed Drives",
        "GAE Class 1 Heavy-Duty Surge Protection Devices",
        "Corrosion-Resistant Industrial Control Enclosures"
      ],
      waText: "Hello PT ATS, I would like to inquire about motor control contactors and VFDs for a chemical processing plant."
    },
    {
      title: "Mayora Indah Food Processing MCC",
      badge: "Food Manufacturing",
      location: "Pasuruan, East Java",
      year: "2023 - 2024",
      image: "{{ asset('images/projects/project-2-indofood-mcc.jpg') }}",
      desc: "Turnkey Motor Control Center supply for continuous biscuit and beverage manufacturing plants. Features harmonic filtration and high-torque motor starting panels.",
      boq: [
        "Schneider Altivar Process ATV630 Variable Speed Inverters",
        "Schneider ComPact NSX MCCB Circuit Breakers",
        "GAE Detuned Reactors & Harmonic Filtering Systems",
        "IP54 Modular Control Switchboards"
      ],
      waText: "Hello PT ATS, we are interested in MCC switchboards and Altivar inverters for Mayora food processing lines."
    },
    {
      title: "Ciputra World Surabaya Power Center",
      badge: "Commercial Complex",
      location: "Mayjen Sungkono, Surabaya",
      year: "2024",
      image: "{{ asset('images/projects/project-3-coldstorage.jpg') }}",
      desc: "Low voltage power distribution and automatic transfer systems for flagship shopping mall, hotel, and office towers with automated load shedding.",
      boq: [
        "Schneider MasterPact 4000A Air Circuit Breakers",
        "Socomec Motorized Automatic Transfer Switches",
        "GAE Digital Power Quality Metering Network",
        "Supreme Low Voltage Fire-Resistant Cables"
      ],
      waText: "Hello PT ATS, please provide a quotation for 4000A ACBs and ATS units for a commercial complex."
    },
    {
      title: "Teluk Lamong Port Terminal Infrastructure",
      badge: "Port & Marine Logistics",
      location: "Surabaya Port Zone",
      year: "2023",
      image: "{{ asset('images/projects/project-4-scada-control.jpg') }}",
      desc: "Heavy-duty electrical protection and automated quay crane power feed distribution designed for high-salinity marine environments with continuous port logistics.",
      boq: [
        "IP66 Marine Grade Weatherproof Sealed Switchboards",
        "Fluke Enterprise Power Quality & Thermal Analyzers",
        "Schneider TeSys Motor Circuit Protectors",
        "Jembo Shielded Marine & Heavy Duty Cables"
      ],
      waText: "Hello PT ATS, I would like information regarding marine IP66 switchboards and cable solutions for port terminals."
    }
  ];

  // Global Modal Opening Function
  window.openProjectModal = function(index) {
    const data = p3dProjectsData[index % p3dProjectsData.length];
    if (!data) return;

    const img = document.getElementById('p3dModalImg');
    const badge = document.getElementById('p3dModalBadge');
    const meta = document.getElementById('p3dModalMeta');
    const title = document.getElementById('p3dModalTitle');
    const desc = document.getElementById('p3dModalDesc');
    const boqEl = document.getElementById('p3dModalBoq');
    const waBtn = document.getElementById('p3dModalWaBtn');
    const modal = document.getElementById('projectDetailModal');

    if (img) img.src = data.image;
    if (badge) badge.textContent = data.badge;
    if (meta) meta.textContent = `📍 ${data.location} • ${data.year}`;
    if (title) title.textContent = data.title;
    if (desc) desc.textContent = data.desc;

    if (boqEl) {
      boqEl.innerHTML = '';
      data.boq.forEach(item => {
        const li = document.createElement('li');
        li.textContent = item;
        boqEl.appendChild(li);
      });
    }

    if (waBtn) {
      waBtn.href = `https://wa.me/6281234567890?text=${encodeURIComponent(data.waText)}`;
    }

    if (modal) {
      if (modal.parentElement !== document.body) {
        document.body.appendChild(modal);
      }
      modal.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }
  };

  window.closeProjectModal = function() {
    const modal = document.getElementById('projectDetailModal');
    if (modal) {
      modal.classList.remove('is-open');
      document.body.style.overflow = '';
    }
  };

  // Close on Escape key
  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      window.closeProjectModal();
    }
  });

  // 3D Carousel Engine: Spacious Gaps, Zero Overlap, Slow Gentle Drift
  (function initP3DCarousel() {
    const stage = document.getElementById('p3dStage');
    const cards = Array.from(document.querySelectorAll('.p3d-card'));

    if (!stage || cards.length === 0) return;

    const totalCards = cards.length; // 12 cards
    const angleStep = 360 / totalCards; // 30 degrees per card

    // Dynamic radius tuned so cards have generous gaps with ZERO overlap (broad panoramic ribbon)
    function getRadius() {
      const w = window.innerWidth;
      if (w < 600) return 480;
      if (w < 900) return 620;
      if (w < 1200) return 740;
      return 880; // Desktop radius: provides ~130px-180px gap between card centers, zero overlap
    }

    let radius = getRadius();
    window.addEventListener('resize', () => {
      radius = getRadius();
    });

    let currentRotation = 0;
    let velocity = 0;
    let isDragging = false;
    let hasDragged = false;
    let lastX = 0;
    let dragStartX = 0;
    let dragStartY = 0;
    let isHovered = false;
    const autoPlaySpeed = 0.010; // Slightly faster, smooth and graceful drift
    const friction = 0.94; // Smooth inertia damping

    // Update 3D card transforms
    function updateCards() {
      cards.forEach((card, index) => {
        const baseAngle = index * angleStep;
        let angle = (baseAngle + currentRotation) % 360;
        if (angle > 180) angle -= 360;
        if (angle < -180) angle += 360;

        const absAngle = Math.abs(angle);

        // Hide cards past peripheral view (keeps stage spacious, zero crowding, no edge-on cards)
        if (absAngle > 50) {
          card.style.opacity = '0';
          card.style.visibility = 'hidden';
          card.style.pointerEvents = 'none';
        } else {
          card.style.visibility = 'visible';
          card.style.pointerEvents = 'auto';

          // Atmospheric fog fade on outer flanks (26deg to 50deg)
          let fogOpacity = 1;
          if (absAngle > 26) {
            fogOpacity = 1 - (absAngle - 26) / 24;
          }
          card.style.opacity = Math.max(0, Math.min(1, fogOpacity)).toFixed(3);

          // Concave 3D Transform: Center card is at screen plane (z=0), flanks curve gently
          const rad = (angle * Math.PI) / 180;
          const x = radius * Math.sin(rad);
          // Normalized Z: center is at 0 (full crisp size), edges curve gently forward
          const z = radius * (1 - Math.cos(rad)) * 0.35;

          // Inward Concave Yaw: wings tilt gently inwards towards viewer/center (Framer style)
          const yaw = -angle * 0.46;

          card.style.transform = `translate3d(${x.toFixed(1)}px, 0, ${z.toFixed(1)}px) rotateY(${yaw.toFixed(1)}deg)`;
          card.style.zIndex = Math.round(z + 20);
        }
      });
    }

    // Animation loop
    function animate() {
      if (!isDragging) {
        if (Math.abs(velocity) > 0.004) {
          currentRotation += velocity;
          velocity *= friction;
        } else {
          velocity = 0;
          if (!isHovered) {
            currentRotation -= autoPlaySpeed;
          }
        }
      }

      updateCards();
      requestAnimationFrame(animate);
    }

    // Mouse Drag Mechanics
    stage.addEventListener('mousedown', (e) => {
      if (e.button !== 0) return;
      isDragging = true;
      hasDragged = false;
      lastX = e.clientX;
      dragStartX = e.clientX;
      dragStartY = e.clientY;
      velocity = 0;
      stage.classList.add('is-dragging');
    });

    window.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      const deltaX = e.clientX - lastX;
      if (Math.hypot(e.clientX - dragStartX, e.clientY - dragStartY) > 5) {
        hasDragged = true;
      }
      const sensitivity = 0.08; // Gentle, relaxing drag response
      currentRotation += deltaX * sensitivity;
      velocity = deltaX * sensitivity;
      lastX = e.clientX;
    });

    window.addEventListener('mouseup', () => {
      if (!isDragging) return;
      isDragging = false;
      stage.classList.remove('is-dragging');
      setTimeout(() => {
        hasDragged = false;
      }, 100);
    });

    // Touch Support
    stage.addEventListener('touchstart', (e) => {
      if (e.touches.length !== 1) return;
      isDragging = true;
      hasDragged = false;
      lastX = e.touches[0].clientX;
      dragStartX = e.touches[0].clientX;
      dragStartY = e.touches[0].clientY;
      velocity = 0;
      stage.classList.add('is-dragging');
    }, { passive: true });

    window.addEventListener('touchmove', (e) => {
      if (!isDragging || e.touches.length !== 1) return;
      const deltaX = e.touches[0].clientX - lastX;
      if (Math.hypot(e.touches[0].clientX - dragStartX, e.touches[0].clientY - dragStartY) > 5) {
        hasDragged = true;
      }
      const sensitivity = 0.10;
      currentRotation += deltaX * sensitivity;
      velocity = deltaX * sensitivity;
      lastX = e.touches[0].clientX;
    }, { passive: true });

    window.addEventListener('touchend', () => {
      if (!isDragging) return;
      isDragging = false;
      stage.classList.remove('is-dragging');
      setTimeout(() => {
        hasDragged = false;
      }, 100);
    });

    // Hover Pause
    stage.addEventListener('mouseenter', () => { isHovered = true; });
    stage.addEventListener('mouseleave', () => { isHovered = false; });

    // Card Click Detection: Instant responsive modal trigger
    cards.forEach((card) => {
      card.addEventListener('click', (e) => {
        if (hasDragged) return;
        const projIdx = parseInt(card.getAttribute('data-project-index'), 10);
        if (!isNaN(projIdx)) {
          window.openProjectModal(projIdx);
        }
      });

      // Keyboard Accessibility
      card.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          const projIdx = parseInt(card.getAttribute('data-project-index'), 10);
          if (!isNaN(projIdx)) {
            window.openProjectModal(projIdx);
          }
        }
      });
    });

    // Keyboard Arrow navigation when stage in view
    window.addEventListener('keydown', (e) => {
      const rect = stage.getBoundingClientRect();
      const inView = rect.top < window.innerHeight && rect.bottom > 0;
      if (!inView) return;

      if (e.key === 'ArrowLeft') {
        velocity = 1.0;
      } else if (e.key === 'ArrowRight') {
        velocity = -1.0;
      }
    });

    // Start loop
    animate();
  })();
</script>
