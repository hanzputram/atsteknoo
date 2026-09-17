<!-- ========================================================
     ENDLESS 3D CAROUSEL: OUR PROJECTS (FRAMER-INSPIRED)
     PT. Anugerah Tama Sejati - Engineering Case Studies
     ======================================================== -->

<section class="p3d-section-wrapper" id="our-projects">
  <div class="p3d-container">
    <!-- Section Header (English / Indonesian) -->
    <div class="p3d-header">
      <h2 class="p3d-title" data-i18n="projects.title" data-reveal-text>Electrical Engineering Project Portfolio</h2>
      <p class="p3d-subtitle" data-i18n="projects.subtitle">
        Proven track record in supplying industrial electrical distribution switchboards, certified automation systems, and critical power infrastructure across Indonesia.
      </p>
    </div>
  </div>

  @php
    $projectSource = isset($projects) && $projects->isNotEmpty()
      ? $projects
      : \App\Models\Project::published()->with(['category', 'coverImage'])->where('is_featured', true)->orderBy('sort_order')->orderBy('id', 'desc')->take(16)->get();

    if ($projectSource->isEmpty()) {
      $projectSource = \App\Models\Project::published()->with(['category', 'coverImage'])->orderBy('sort_order')->orderBy('id', 'desc')->take(16)->get();
    }

    $projectData = $projectSource->map(function($p) {
        return [
            'id' => $p->id,
            'title' => $p->title,
            'badge' => $p->badge_name,
            'badge_color' => $p->badge_color,
            'location' => $p->location ?? 'Surabaya, Indonesia',
            'year' => $p->completion_year ?? date('Y'),
            'image' => $p->image_url,
            'specs' => $p->scope_of_work ?? 'Engineering & Panel Assembly',
            'summary' => $p->summary ?: Str::limit(strip_tags($p->content_html), 130),
            'slug' => $p->slug,
        ];
    })->values()->toArray();

    // Repeat project list to ensure a full 16-segment continuous cylinder with tight, elegant card gaps (~24px - 32px)
    $displayProjects = $projectData;
    if (count($projectData) > 0 && count($projectData) < 16) {
        $repeats = (int) ceil(16 / count($projectData));
        $temp = [];
        for ($r = 0; $r < $repeats; $r++) {
            foreach ($projectData as $idx => $p) {
                $p['orig_idx'] = $idx;
                $temp[] = $p;
            }
        }
        $displayProjects = array_slice($temp, 0, 16);
    }
  @endphp

  @if(count($projectData) === 0)
    <div style="width: 100%; max-width: 520px; margin: 32px auto 56px auto; padding: 0 20px; text-align: center;">
      <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04); padding: 32px 24px;">
        <p style="font-size: 1.15rem; font-weight: 600; color: #64748B; margin: 0; letter-spacing: -0.01em;" data-i18n="projects.empty_notice">
          Portfolio is not yet available.
        </p>
      </div>
    </div>
  @else
    <!-- 3D Carousel Stage Area -->
    <div class="p3d-stage-wrapper" id="p3dStage">
      <!-- Atmospheric Edge Fog Masks (Framer Fog Fade) -->
      <div class="p3d-fog-edge p3d-fog-left" aria-hidden="true"></div>
      <div class="p3d-fog-edge p3d-fog-right" aria-hidden="true"></div>

      <!-- 3D Viewport -->
      <div class="p3d-viewport" id="p3dViewport">
        <!-- 3D Cylinder Anchor -->
        <div class="p3d-cylinder" id="p3dCylinder">
          @foreach($displayProjects as $index => $item)
            <div class="p3d-card" data-slot="{{ $index }}" data-project-index="{{ $item['orig_idx'] ?? ($index % count($projectData)) }}" onclick="openProjectModal({{ $item['orig_idx'] ?? ($index % count($projectData)) }})" role="button" tabindex="0">
              <div class="p3d-card-inner">
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="p3d-card-img" width="280" height="380" loading="lazy" decoding="async" onerror="if(!this.dataset.tried){this.dataset.tried=1;this.src=this.src.replace(/\.webp$/i,'.jpg');}else if(!this.dataset.pub){this.dataset.pub=1;this.src=this.src.replace('/images/','/public/images/');}">
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
  @endif
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
    padding: 36px 0 32px 0;
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
    margin: 0 auto 16px auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
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
    line-height: 1.25;
    margin: 0;
    padding: 0;
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
    height: 425px;
    margin: 0;
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
    width: 140px;
    z-index: 50;
    pointer-events: none;
  }

  .p3d-fog-left {
    left: 0;
    background: linear-gradient(to right, #FFFFFF 20%, rgba(255, 255, 255, 0.75) 60%, rgba(255, 255, 255, 0) 100%);
  }

  .p3d-fog-right {
    right: 0;
    background: linear-gradient(to left, #FFFFFF 20%, rgba(255, 255, 255, 0.75) 60%, rgba(255, 255, 255, 0) 100%);
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
  // Project Detailed Data Directory (Dynamically serialized from Database)
  const p3dProjectsData = {!! json_encode(array_map(function($item) {
    $specsList = !empty($item['specs']) ? array_map('trim', explode('•', $item['specs'])) : ['Custom Industrial Switchboard', 'SPLN & IEC 61439 Certified'];
    return [
      'title' => $item['title'],
      'badge' => $item['badge'],
      'location' => $item['location'],
      'year' => $item['year'],
      'image' => $item['image'],
      'desc' => $item['summary'] ?? ($item['title'] . ' electrical distribution and switchboard engineering project by PT. Anugerah Tama Sejati.'),
      'boq' => $specsList,
      'waText' => 'Hello PT ATS, I would like to inquire regarding ' . $item['title'] . ' and request a technical quotation.',
    ];
  }, $projectData)) !!};

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
      waBtn.href = `https://wa.me/6282223332830?text=${encodeURIComponent(data.waText)}`;
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

  // 3D Carousel Engine: Tight, Cohesive Spacing, Zero Overlap, Continuous Smooth Drift
  (function initP3DCarousel() {
    const stage = document.getElementById('p3dStage');
    const cards = Array.from(document.querySelectorAll('.p3d-card'));

    if (!stage || cards.length === 0) return;

    const totalCards = cards.length; // 16 cards around the circle
    const angleStep = 360 / totalCards; // 22.5 degrees per card

    // Dynamic radius tuned so cards have tight, elegant, consistent gaps (~24px - 32px)
    function getRadius() {
      const w = window.innerWidth;
      if (w < 600) return 540; // Mobile: cards 190px, step 212px, gap ~22px
      if (w < 900) return 620; // Tablet: cards 230px, step 243px, gap ~13px
      if (w < 1200) return 690; // Small desktop: cards 260px, step 271px, gap ~11px
      return 740; // Desktop: cards 260px, step 290px, gap ~30px
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
    const autoPlaySpeed = 0.038; // Smooth, gentle drift
    const friction = 0.94; // Smooth inertia damping
    let lastTime = performance.now();

    // Update 3D card transforms
    function updateCards() {
      cards.forEach((card, index) => {
        const baseAngle = index * angleStep;
        let angle = (baseAngle + currentRotation) % 360;
        if (angle > 180) angle -= 360;
        if (angle < -180) angle += 360;

        const absAngle = Math.abs(angle);

        // Hide cards past peripheral view (smooth fade across ~7 cards in viewport)
        if (absAngle > 78) {
          card.style.opacity = '0';
          card.style.visibility = 'hidden';
          card.style.pointerEvents = 'none';
        } else {
          card.style.visibility = 'visible';
          card.style.pointerEvents = 'auto';

          // Atmospheric fog fade on outer flanks (44deg to 76deg)
          let fogOpacity = 1;
          if (absAngle > 44) {
            fogOpacity = 1 - (absAngle - 44) / 32;
          }
          card.style.opacity = Math.max(0, Math.min(1, fogOpacity)).toFixed(3);

          // Concave 3D Transform: Center card is at screen plane (z=0), flanks curve gently
          const rad = (angle * Math.PI) / 180;
          const x = radius * Math.sin(rad);
          // Normalized Z: center is at 0 (full crisp size), edges curve gently into background
          const z = -radius * (1 - Math.cos(rad)) * 0.28;

          // Inward Concave Yaw: wings tilt gently inwards towards viewer/center (Framer style)
          const yaw = -angle * 0.45;

          card.style.transform = `translate3d(${x.toFixed(1)}px, 0, ${z.toFixed(1)}px) rotateY(${yaw.toFixed(1)}deg)`;
          card.style.zIndex = Math.round(100 - absAngle);
        }
      });
    }

    let isVisible = false;
    let rafId = null;

    function startAnimation() {
      if (rafId) return;
      lastTime = performance.now();
      rafId = requestAnimationFrame(animate);
    }

    function stopAnimation() {
      if (rafId) {
        cancelAnimationFrame(rafId);
        rafId = null;
      }
    }

    // Animation loop (pauses when off-screen to preserve CPU & INP)
    function animate(currentTime) {
      if (!isVisible) {
        rafId = null;
        return;
      }
      const now = currentTime || performance.now();
      const deltaMs = Math.min(now - lastTime, 100);
      lastTime = now;
      const timeScale = deltaMs / 16.667; // Normalized to 60fps

      if (!isDragging) {
        if (Math.abs(velocity) > 0.004) {
          currentRotation += velocity * timeScale;
          velocity *= Math.pow(friction, timeScale);
        } else {
          velocity = 0;
          if (!isHovered) {
            currentRotation -= autoPlaySpeed * timeScale;
          }
        }
      }

      updateCards();
      rafId = requestAnimationFrame(animate);
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

    // Observe visibility: only run animation when stage is visible on screen
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          isVisible = entry.isIntersecting;
          if (isVisible) {
            startAnimation();
          } else {
            stopAnimation();
          }
        });
      }, { rootMargin: '150px 0px' });
      observer.observe(stage);
    } else {
      isVisible = true;
      startAnimation();
    }
  })();
</script>
