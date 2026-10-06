{{--
    33-Stage Complete Manufacturing Process Showcase with Photos
    Clean light-mode industrial design, matched 100% to ATS Tekno Brand Identity.
    Features: Phase filter pills, instant live search, card grid with process photos,
    technical activities, inspection checkpoints, and verified outputs.
--}}
@php
    $getStepPhoto = function ($step, $idx) use ($resolveImg) {
        $img = $step['image'] ?? '';
        return match($idx + 1) {
            1, 2, 3, 4 => $resolveImg('engineering.webp'),
            5 => $resolveImg('factory.webp'),
            6 => $resolveImg('machine-shearing.webp'),
            7 => $resolveImg('machine-laser.jpg'),
            8 => $resolveImg('machine-bending.jpg'),
            9 => $resolveImg('machine-punching.jpg'),
            10 => $resolveImg('bending.webp'),
            11 => $resolveImg('welding.webp'),
            12 => $resolveImg('fabrication.webp'),
            13, 14, 15, 16, 17, 18, 19 => $resolveImg('surface.webp'),
            20, 22 => $resolveImg('coating.webp'),
            21 => $resolveImg('curing.webp'),
            23, 24 => $resolveImg('assembly.webp'),
            25 => $resolveImg('bending.webp'),
            26, 27 => $resolveImg('assembly.webp'),
            28, 29, 30 => $resolveImg('quality.webp'),
            31 => $resolveImg('engineering.webp'),
            32, 33 => $resolveImg('factory.webp'),
            default => $resolveImg($img ?: 'engineering.webp'),
        };
    };

    $getPhaseIndex = function ($idx) use ($phases) {
        foreach ($phases as $pIdx => $p) {
            if ($idx >= ($p['from'] ?? 0) && $idx <= ($p['to'] ?? 0)) {
                return $pIdx;
            }
        }
        return 0;
    };

    $getPhaseTitle = function ($idx) use ($phases) {
        foreach ($phases as $p) {
            if ($idx >= ($p['from'] ?? 0) && $idx <= ($p['to'] ?? 0)) {
                return $p['title'] ?? 'Manufacturing';
            }
        }
        return 'Manufacturing';
    };
@endphp

<section class="p33-section" id="process-steps" aria-labelledby="p33-title">
    {{-- Section Header --}}
    <header class="p33-head">
        <div class="p33-head-badge">
            <span class="p33-head-dot"></span>
            <span>33-STAGE INDUSTRIAL WORKFLOW · ZERO COMPROMISE</span>
        </div>
        <h2 class="p33-title" id="p33-title">33 Tahap Proses Pembuatan Panel Listrik</h2>
        <p class="p33-lead">
            Standar manufaktur switchboard panel industri ATS Tekno Surabaya: setiap tahapan dari perancangan engineering, fabrikasi plat, perlakuan kimiawi, pengecatan, hingga perakitan dan pengujian FAT didokumentasikan secara transparan dengan pos inspeksi mutu terverifikasi.
        </p>

        {{-- Process Highlights Stats --}}
        <div class="p33-stats">
            <div class="p33-stat-item">
                <strong>33</strong>
                <span>Tahapan Terintegrasi</span>
            </div>
            <div class="p33-stat-sep"></div>
            <div class="p33-stat-item">
                <strong>06</strong>
                <span>Fase Manufaktur</span>
            </div>
            <div class="p33-stat-sep"></div>
            <div class="p33-stat-item">
                <strong>100%</strong>
                <span>Inspeksi Terverifikasi</span>
            </div>
            <div class="p33-stat-sep"></div>
            <div class="p33-stat-item">
                <strong>IEC</strong>
                <span>Standar 61439-1/2</span>
            </div>
        </div>
    </header>

    {{-- Controls: Phase Filter Tabs & Live Search Bar --}}
    <div class="p33-controls">
        <nav class="p33-tabs" role="tablist" aria-label="Filter processes by manufacturing phase">
            <button type="button" class="p33-tab is-active" data-phase-filter="all" role="tab" aria-selected="true">
                <span>Semua Proses</span>
                <span class="p33-tab-count">{{ count($steps) }}</span>
            </button>
            @foreach ($phases as $pIdx => $p)
                @php
                    $stepCount = ($p['to'] ?? 0) - ($p['from'] ?? 0) + 1;
                @endphp
                <button type="button" class="p33-tab" data-phase-filter="{{ $pIdx }}" role="tab" aria-selected="false">
                    <span>{{ sprintf('%02d', $pIdx + 1) }}. {{ $p['title'] }}</span>
                    <span class="p33-tab-count">{{ $stepCount }}</span>
                </button>
            @endforeach
        </nav>

        {{-- Search Input --}}
        <div class="p33-search-box">
            <svg class="p33-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="p33-search-input" class="p33-search-input" placeholder="Cari tahap (contoh: laser, bending, hcl, powder, busbar, wiring, fat)..." aria-label="Cari dari 33 proses">
            <button type="button" id="p33-search-clear" class="p33-search-clear" aria-label="Reset pencarian" style="display: none;">&times;</button>
        </div>
    </div>

    {{-- Active Filter Counter Alert --}}
    <div class="p33-filter-status" id="p33-filter-status" aria-live="polite">
        Menampilkan <b id="p33-visible-count">{{ count($steps) }}</b> dari {{ count($steps) }} tahap proses pembuatan panel
    </div>

    {{-- 33 Process Cards Grid --}}
    <div class="p33-grid" id="p33-grid">
        @foreach ($steps as $i => $s)
            @php
                $photo = $getStepPhoto($s, $i);
                $phaseIdx = $getPhaseIndex($i);
                $phaseTitle = $getPhaseTitle($i);
                $activities = $s['activities'] ?? [];
                if (!is_array($activities)) {
                    $activities = array_filter(array_map('trim', explode("\n", (string) $activities)));
                }
            @endphp
            <article class="p33-card"
                     data-step-index="{{ $i }}"
                     data-phase="{{ $phaseIdx }}"
                     data-title="{{ strtolower($s['title'] ?? '') }}"
                     data-subtitle="{{ strtolower($s['subtitle'] ?? '') }}"
                     data-desc="{{ strtolower($s['description'] ?? '') }}"
                     data-output="{{ strtolower($s['output'] ?? '') }}"
                     data-checkpoint="{{ strtolower($s['checkpoint'] ?? '') }}">

                {{-- Photo Container --}}
                <div class="p33-card-media"
                     data-p33-inspect
                     data-photo-src="{{ $photo }}"
                     data-photo-title="Step {{ sprintf('%02d', $i + 1) }}: {{ $s['title'] }}"
                     role="button"
                     tabindex="0"
                     aria-label="Lihat foto resolusi tinggi untuk Step {{ sprintf('%02d', $i + 1) }}">
                    <img class="p33-card-img"
                         src="{{ $photo }}"
                         alt="Step {{ sprintf('%02d', $i + 1) }}: {{ $s['title'] }} — ATS Tekno Workshop Surabaya"
                         width="480"
                         height="260"
                         loading="lazy"
                         decoding="async">
                    <div class="p33-card-badges">
                        <span class="p33-pill-step">
                            <span class="p33-step-dot"></span>
                            STEP {{ sprintf('%02d', $i + 1) }}
                        </span>
                        <span class="p33-pill-phase">{{ strtoupper($phaseTitle) }}</span>
                    </div>
                    <div class="p33-media-hover">
                        <span class="p33-zoom-hint">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M11 8v6M8 11h6"/></svg>
                            Perbesar Foto
                        </span>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p33-card-body">
                    <div class="p33-title-group">
                        @if (!empty($s['subtitle']))
                            <h3 class="p33-step-subtitle">{{ $s['subtitle'] }}</h3>
                        @endif
                        <h4 class="p33-step-title">{{ $s['title'] }}</h4>
                    </div>

                    <p class="p33-step-desc">{{ $s['description'] ?? '' }}</p>

                    @if (!empty($activities))
                        <div class="p33-activities">
                            <span class="p33-block-label">AKTIVITAS PENGERJAAN</span>
                            <ul class="p33-act-list">
                                @foreach (array_slice($activities, 0, 3) as $act)
                                    <li>
                                        <svg class="p33-check-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span>{{ $act }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Quality Checkpoint & Output --}}
                    <div class="p33-meta-footer">
                        @if (!empty($s['checkpoint']))
                            <div class="p33-checkpoint-box">
                                <span class="p33-box-label">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    POS INSPEKSI MUTU
                                </span>
                                <p class="p33-box-text">{{ $s['checkpoint'] }}</p>
                            </div>
                        @endif

                        @if (!empty($s['output']))
                            <div class="p33-output-box">
                                <span class="p33-box-label p33-box-label--output">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    OUTPUT TERVERIFIKASI
                                </span>
                                <p class="p33-box-text">{{ $s['output'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    {{-- Empty State (if search finds nothing) --}}
    <div class="p33-empty" id="p33-empty" style="display: none;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <h3>Tidak ada tahapan yang cocok</h3>
        <p>Coba kata kunci lain atau klik "Semua Proses" untuk melihat 33 tahapan lengkap.</p>
        <button type="button" class="p33-empty-btn" id="p33-empty-reset">Reset Pencarian</button>
    </div>

    {{-- Process Step Lightbox Modal --}}
    <div class="p33-modal" id="p33-modal" role="dialog" aria-modal="true" aria-label="Tampilan Foto Resolusi Tinggi" aria-hidden="true">
        <div class="p33-modal-backdrop" id="p33-modal-backdrop"></div>
        <div class="p33-modal-dialog" style="background: #FFFFFF !important; border: 1px solid #E2E8F0 !important; border-radius: 20px !important; overflow: hidden !important; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5) !important;">
            <button type="button" class="p33-modal-close" id="p33-modal-close" aria-label="Tutup foto" title="Tutup (ESC)" style="position: absolute; top: 16px; right: 16px; z-index: 50; width: 42px; height: 42px; border-radius: 50%; background: #FFFFFF !important; color: #0F172A !important; border: 1.5px solid #CBD5E1 !important; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <div class="p33-modal-media" style="background: #0B1120 !important;">
                <img id="p33-modal-img" src="" alt="ATS Tekno Workshop Inspection">
            </div>
            <div class="p33-modal-caption" style="background: #FFFFFF !important; border-top: 1px solid #E2E8F0 !important; padding: 20px 24px !important;">
                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                    <span class="p33-modal-badge" style="display: inline-flex !important; align-items: center !important; gap: 6px !important; font-family: 'Outfit', sans-serif !important; font-size: 11px !important; font-weight: 800 !important; letter-spacing: 0.08em !important; color: #E11D48 !important; background: #FFF1F2 !important; border: 1px solid #FECDD3 !important; padding: 3px 10px !important; border-radius: 6px !important; text-transform: uppercase !important;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #E11D48; display: inline-block;"></span>
                        FASILITAS &amp; DOKUMENTASI AKTUAL · ATS SURABAYA
                    </span>
                </div>
                <strong id="p33-modal-title" style="display: block !important; font-family: 'Outfit', sans-serif !important; font-size: 18px !important; font-weight: 800 !important; color: #0F172A !important; line-height: 1.35 !important; margin: 0 !important;"></strong>
            </div>
        </div>
    </div>
</section>

{{-- Client-side Filter & Interactive Search Controller --}}
<script>
(() => {
    'use strict';
    const sec = document.getElementById('process-steps');
    if (!sec) return;

    const cards = Array.from(sec.querySelectorAll('.p33-card'));
    const tabs = Array.from(sec.querySelectorAll('[data-phase-filter]'));
    const searchInput = document.getElementById('p33-search-input');
    const searchClear = document.getElementById('p33-search-clear');
    const statusCount = document.getElementById('p33-visible-count');
    const emptyState = document.getElementById('p33-empty');
    const emptyReset = document.getElementById('p33-empty-reset');

    let currentPhase = 'all';
    let currentSearch = '';

    function filterCards() {
        const query = currentSearch.trim().toLowerCase();
        let visibleCount = 0;

        cards.forEach(card => {
            const cardPhase = card.dataset.phase;
            const matchesPhase = currentPhase === 'all' || cardPhase === currentPhase;

            let matchesQuery = true;
            if (query) {
                const title = card.dataset.title || '';
                const subtitle = card.dataset.subtitle || '';
                const desc = card.dataset.desc || '';
                const output = card.dataset.output || '';
                const checkpoint = card.dataset.checkpoint || '';
                matchesQuery = title.includes(query) ||
                               subtitle.includes(query) ||
                               desc.includes(query) ||
                               output.includes(query) ||
                               checkpoint.includes(query);
            }

            const visible = matchesPhase && matchesQuery;
            card.style.display = visible ? 'flex' : 'none';
            if (visible) visibleCount++;
        });

        if (statusCount) statusCount.textContent = visibleCount;
        if (emptyState) emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
        if (searchClear) searchClear.style.display = query ? 'block' : 'none';
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => {
                t.classList.remove('is-active');
                t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('is-active');
            tab.setAttribute('aria-selected', 'true');
            currentPhase = tab.dataset.phaseFilter;
            filterCards();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', e => {
            currentSearch = e.target.value;
            filterCards();
        });
    }

    if (searchClear) {
        searchClear.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            currentSearch = '';
            filterCards();
            if (searchInput) searchInput.focus();
        });
    }

    if (emptyReset) {
        emptyReset.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            currentSearch = '';
            currentPhase = 'all';
            tabs.forEach((t, i) => {
                t.classList.toggle('is-active', i === 0);
                t.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
            });
            filterCards();
        });
    }

    // Modal Lightbox
    const modal = document.getElementById('p33-modal');
    const modalImg = document.getElementById('p33-modal-img');
    const modalTitle = document.getElementById('p33-modal-title');
    const modalClose = document.getElementById('p33-modal-close');
    const modalBackdrop = document.getElementById('p33-modal-backdrop');

    function openModal(src, title) {
        if (!modal || !modalImg) return;
        modalImg.src = src;
        modalImg.alt = title;
        if (modalTitle) modalTitle.textContent = title;
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    sec.querySelectorAll('[data-p33-inspect]').forEach(btn => {
        btn.addEventListener('click', () => {
            const src = btn.dataset.photoSrc;
            const title = btn.dataset.photoTitle || '';
            if (src) openModal(src, title);
        });
        btn.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                btn.click();
            }
        });
    });

    if (modalClose) modalClose.addEventListener('click', closeModal);
    if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);
    window.addEventListener('keydown', e => {
        if (e.key === 'Escape' && modal && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
})();
</script>
