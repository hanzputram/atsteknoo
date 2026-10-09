{{--
    33-Stage Complete Manufacturing Process Showcase with Photos
    Clean light-mode industrial design, matched 100% to ATS Tekno Brand Identity.
    Features: Phase filter pills, instant live search, card grid with process photos,
    technical activities, inspection checkpoints, and verified outputs.
--}}
@php
    // Filter visible steps
    $visibleSteps = [];
    foreach ($steps as $originalIdx => $s) {
        if (empty($s['is_hidden'])) {
            $visibleSteps[] = array_merge($s, ['_orig_idx' => $originalIdx]);
        }
    }
    $totalSteps = count($visibleSteps);

    $getStepPhoto = function ($step, $origIdx) use ($resolveImg) {
        $img = trim($step['image'] ?? '');
        if ($img !== '' && !in_array($img, ['engineering', 'fabrication', 'surface', 'coating', 'assembly', 'quality'])) {
            return $resolveImg($img);
        }
        return match($origIdx + 1) {
            1, 2, 3, 4 => $resolveImg('engineering.webp'),
            5 => $resolveImg('factory.webp'),
            6 => $resolveImg('machine-shearing.webp'),
            7 => $resolveImg('machine-laser.webp'),
            8 => $resolveImg('machine-bending.webp'),
            9 => $resolveImg('machine-punching.webp'),
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

    $getPhaseIndex = function ($origIdx) use ($phases) {
        foreach ($phases as $pIdx => $p) {
            if ($origIdx >= ($p['from'] ?? 0) && $origIdx <= ($p['to'] ?? 0)) {
                return $pIdx;
            }
        }
        return 0;
    };

    $getPhaseTitle = function ($origIdx) use ($phases) {
        foreach ($phases as $p) {
            if ($origIdx >= ($p['from'] ?? 0) && $origIdx <= ($p['to'] ?? 0)) {
                return $p['title'] ?? 'Manufacturing';
            }
        }
        return 'Manufacturing';
    };

    // Calculate phase counts of visible steps
    $phaseCounts = [];
    foreach ($phases as $pIdx => $p) {
        $count = 0;
        foreach ($visibleSteps as $vs) {
            $oIdx = $vs['_orig_idx'];
            if ($oIdx >= ($p['from'] ?? 0) && $oIdx <= ($p['to'] ?? 0)) {
                $count++;
            }
        }
        $phaseCounts[$pIdx] = $count;
    }
    $activePhasesCount = count(array_filter($phaseCounts, fn($c) => $c > 0));
    $frProcessData = json_decode(@file_get_contents(storage_path('app/panel-process-data-fr.json')), true) ?: [];
    $frenchPhases = $frProcessData['phases'] ?? [];
    $frenchSteps = $frProcessData['steps'] ?? [];

@endphp

<section class="p33-section" id="process-steps" aria-labelledby="p33-title">
    {{-- Section Header --}}
    <header class="p33-head">
                <div class="p33-head-badge">
            <span class="p33-head-dot"></span>
            <span class="ats-lang-en">{{ $totalSteps }}-STAGE INDUSTRIAL WORKFLOW &bull; ZERO COMPROMISE</span>
            <span class="ats-lang-fr">FLUX INDUSTRIEL EN {{ $totalSteps }} ÉTAPES &bull; ZÉRO COMPROMIS</span>
        </div>
        <h2 class="p33-title" id="p33-title">
            <span class="ats-lang-en">{{ $totalSteps }}-Stage Switchboard Manufacturing Process</span>
            <span class="ats-lang-fr">Processus de Fabrication de Tableaux Électriques en {{ $totalSteps }} Étapes</span>
        </h2>
        <p class="p33-lead">
            <span class="ats-lang-en">ATS Tekno Surabaya industrial switchboard manufacturing standard: every phase from engineering design, sheet metal fabrication, chemical surface treatment, powder coating, through electrical outfitting and Factory Acceptance Testing (FAT) is transparently documented with verified quality checkpoints.</span>
            <span class="ats-lang-fr">Norme de fabrication industrielle de tableaux électriques ATS Tekno : chaque étape, de la conception technique à la tôlerie, au traitement de surface chimique, au thermolaquage, au câblage et aux essais en usine (FAT), est documentée avec des points de contrôle qualité certifiés.</span>
        </p>

        {{-- Process Highlights Stats --}}
        <div class="p33-stats">
            <div class="p33-stat-item">
                <strong>{{ sprintf('%02d', $totalSteps) }}</strong>
                <span>
                    <span class="ats-lang-en">Integrated Steps</span>
                    <span class="ats-lang-fr">Étapes Intégrées</span>
                </span>
            </div>
            <div class="p33-stat-sep"></div>
            <div class="p33-stat-item">
                <strong>{{ sprintf('%02d', $activePhasesCount) }}</strong>
                <span>
                    <span class="ats-lang-en">Production Phases</span>
                    <span class="ats-lang-fr">Phases de Production</span>
                </span>
            </div>
            <div class="p33-stat-sep"></div>
            <div class="p33-stat-item">
                <strong>100%</strong>
                <span>
                    <span class="ats-lang-en">Verified Inspection</span>
                    <span class="ats-lang-fr">Contrôle Qualité Validé</span>
                </span>
            </div>
        </div>
    </header>

    {{-- Controls: Phase Filter Tabs & Live Search Bar --}}
    <div class="p33-controls">
        <nav class="p33-tabs" role="tablist" aria-label="Filter processes by manufacturing phase">
            <button type="button" class="p33-tab is-active" data-phase-filter="all" role="tab" aria-selected="true">
                <span>
                    <span class="ats-lang-en">All Processes</span>
                    <span class="ats-lang-fr">Tous les Processus</span>
                </span>
                <span class="p33-tab-count">{{ $totalSteps }}</span>
            </button>
            @foreach ($phases as $pIdx => $p)
                @if (($phaseCounts[$pIdx] ?? 0) > 0)
                    <button type="button" class="p33-tab" data-phase-filter="{{ $pIdx }}" role="tab" aria-selected="false">
                        <span>
                            <span class="ats-lang-en">{{ sprintf('%02d', $pIdx + 1) }}. {{ $p['title'] }}</span>
                            <span class="ats-lang-fr">{{ sprintf('%02d', $pIdx + 1) }}. {{ $frenchPhases[$pIdx]['title'] ?? $p['title'] }}</span>
                        </span>
                        <span class="p33-tab-count">{{ $phaseCounts[$pIdx] }}</span>
                    </button>
                @endif
            @endforeach
        </nav>

        {{-- Search Input --}}
        <div class="p33-search-box">
            <svg class="p33-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="p33-search-input" class="p33-search-input" placeholder="Search steps (e.g., laser, bending, powder coating, busbar, FAT)..." data-placeholder-en="Search steps (e.g., laser, bending, powder coating, busbar, FAT)..." data-placeholder-fr="Rechercher des étapes (ex. laser, pliage, thermolaquage, jeux de barres, FAT)..." aria-label="Search manufacturing processes">
            <button type="button" id="p33-search-clear" class="p33-search-clear" aria-label="Clear search" style="display: none;">&times;</button>
        </div>
    </div>

    {{-- Active Filter Counter Alert --}}
    <div class="p33-filter-status" id="p33-filter-status" aria-live="polite">
        <span class="ats-lang-en">Showing <b class="p33-visible-count">{{ $totalSteps }}</b> of {{ $totalSteps }} switchboard manufacturing steps</span>
        <span class="ats-lang-fr">Affichage de <b class="p33-visible-count">{{ $totalSteps }}</b> sur {{ $totalSteps }} étapes de fabrication de tableaux</span>
    </div>

    {{-- Process Cards Grid --}}
    <div class="p33-grid" id="p33-grid">
        @foreach ($visibleSteps as $seqIdx => $s)
            @php
                $origIdx = $s['_orig_idx'];
                $photo = $getStepPhoto($s, $origIdx);
                $phaseIdx = $getPhaseIndex($origIdx);
                $phaseTitle = $getPhaseTitle($origIdx);
                $activities = $s['activities'] ?? [];
                if (!is_array($activities)) {
                    $activities = array_filter(array_map('trim', explode("\n", (string) $activities)));
                }
            @endphp
            <article class="p33-card"
                     data-step-index="{{ $seqIdx }}"
                     data-original-index="{{ $origIdx }}"
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
                     data-photo-title="Step {{ sprintf('%02d', $seqIdx + 1) }}: {{ $s['title'] }}"
                     role="button"
                     tabindex="0"
                     aria-label="View high-resolution photo for Step {{ sprintf('%02d', $seqIdx + 1) }}">
                    <img class="p33-card-img"
                         src="{{ $photo }}"
                         alt="Step {{ sprintf('%02d', $seqIdx + 1) }}: {{ $s['title'] }} — ATS Tekno Workshop Surabaya"
                         width="480"
                         height="260"
                         {{ $seqIdx < 6 ? 'loading=eager' : 'loading=lazy' }}
                         decoding="async">
                    <div class="p33-card-badges">
                        <span class="p33-pill-step">
                            <span class="p33-step-dot"></span>
                            STEP {{ sprintf('%02d', $seqIdx + 1) }}
                        </span>
                        <span class="p33-pill-phase">
                            <span class="ats-lang-en">{{ strtoupper($phaseTitle) }}</span>
                            <span class="ats-lang-fr">{{ strtoupper($frenchPhases[$phaseIdx]['title'] ?? $phaseTitle) }}</span>
                        </span>
                    </div>
                    <div class="p33-media-hover">
                        <span class="p33-zoom-hint">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M11 8v6M8 11h6"/></svg>
                            <span class="ats-lang-en">Inspect Photo</span>
                            <span class="ats-lang-fr">Agrandir Photo</span>
                        </span>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p33-card-body">
                    <div class="p33-title-group">
                        @if (!empty($s['subtitle']))
                            <h3 class="p33-step-subtitle">
                                <span class="ats-lang-en">{{ $s['subtitle'] }}</span>
                                <span class="ats-lang-fr">{{ $frenchSteps[$origIdx]['subtitle'] ?? $s['subtitle'] }}</span>
                            </h3>
                        @endif
                        <h4 class="p33-step-title">
                            <span class="ats-lang-en">{{ $s['title'] }}</span>
                            <span class="ats-lang-fr">{{ $frenchSteps[$origIdx]['title'] ?? $s['title'] }}</span>
                        </h4>
                    </div>

                    <p class="p33-step-desc">
                        <span class="ats-lang-en">{{ $s['description'] ?? '' }}</span>
                        <span class="ats-lang-fr">{{ $frenchSteps[$origIdx]['description'] ?? ($s['description'] ?? '') }}</span>
                    </p>

                    @if (!empty($activities))
                        <div class="p33-activities">
                            <span class="p33-block-label">
                                <span class="ats-lang-en">KEY WORK ACTIVITIES</span>
                                <span class="ats-lang-fr">ACTIVITÉS TECHNIQUES CLÉS</span>
                            </span>
                            <ul class="p33-act-list">
                                @foreach (array_slice($activities, 0, 3) as $aIdx => $act)
                                    <li>
                                        <svg class="p33-check-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span>
                                            <span class="ats-lang-en">{{ $act }}</span>
                                            <span class="ats-lang-fr">{{ $frenchSteps[$origIdx]['activities'][$aIdx] ?? $act }}</span>
                                        </span>
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
                                    <span class="ats-lang-en">QUALITY CHECKPOINT</span>
                                    <span class="ats-lang-fr">POINT DE CONTRÔLE QUALITÉ</span>
                                </span>
                                <p class="p33-box-text">
                                    <span class="ats-lang-en">{{ $s['checkpoint'] }}</span>
                                    <span class="ats-lang-fr">{{ $frenchSteps[$origIdx]['checkpoint'] ?? $s['checkpoint'] }}</span>
                                </p>
                            </div>
                        @endif

                        @if (!empty($s['output']))
                            <div class="p33-output-box">
                                <span class="p33-box-label p33-box-label--output">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    <span class="ats-lang-en">VERIFIED OUTPUT</span>
                                    <span class="ats-lang-fr">LIVRABLE VALIDÉ</span>
                                </span>
                                <p class="p33-box-text">
                                    <span class="ats-lang-en">{{ $s['output'] }}</span>
                                    <span class="ats-lang-fr">{{ $frenchSteps[$origIdx]['output'] ?? $s['output'] }}</span>
                                </p>
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
        <h3>
            <span class="ats-lang-en">No matching manufacturing steps found</span>
            <span class="ats-lang-fr">Aucune étape de fabrication correspondante trouvée</span>
        </h3>
        <p>
            <span class="ats-lang-en">Try searching with different technical keywords or click "All Processes" to explore the complete 33-step workflow.</span>
            <span class="ats-lang-fr">Essayez avec d'autres termes techniques ou cliquez sur "Tous les Processus" pour explorer le flux complet en 33 étapes.</span>
        </p>
        <button type="button" class="p33-empty-btn" id="p33-empty-reset">
            <span class="ats-lang-en">Reset Search</span>
            <span class="ats-lang-fr">Réinitialiser la Recherche</span>
        </button>
    </div>

    {{-- Process Step Lightbox Modal --}}
    <div class="p33-modal" id="p33-modal" role="dialog" aria-modal="true" aria-label="High-Resolution Process Photo Inspection" aria-hidden="true">
        <div class="p33-modal-backdrop" id="p33-modal-backdrop"></div>
        <div class="p33-modal-dialog" style="background: #FFFFFF !important; border: 1px solid #E2E8F0 !important; border-radius: 20px !important; overflow: hidden !important; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5) !important;">
            <button type="button" class="p33-modal-close" id="p33-modal-close" aria-label="Close photo" title="Close (ESC)" style="position: absolute; top: 16px; right: 16px; z-index: 50; width: 42px; height: 42px; border-radius: 50%; background: #FFFFFF !important; color: #0F172A !important; border: 1.5px solid #CBD5E1 !important; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <div class="p33-modal-media" style="background: #0B1120 !important;">
                <img id="p33-modal-img" src="" alt="ATS Tekno Workshop Inspection">
            </div>
            <div class="p33-modal-caption" style="background: #FFFFFF !important; border-top: 1px solid #E2E8F0 !important; padding: 20px 24px !important;">
                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                    <span class="p33-modal-badge" style="display: inline-flex !important; align-items: center !important; gap: 6px !important; font-family: 'Outfit', sans-serif !important; font-size: 11px !important; font-weight: 800 !important; letter-spacing: 0.08em !important; color: #E11D48 !important; background: #FFF1F2 !important; border: 1px solid #FECDD3 !important; padding: 3px 10px !important; border-radius: 6px !important; text-transform: uppercase !important;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #E11D48; display: inline-block;"></span>
                        <span class="ats-lang-en">ACTUAL WORKSHOP FACILITIES &bull; ATS SURABAYA</span><span class="ats-lang-fr">INSTALLATIONS RÉELLES D'ATELIER &bull; ATS SURABAYA</span>
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
    const statusCounts = document.querySelectorAll('.p33-visible-count');
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

        statusCounts.forEach(el => el.textContent = visibleCount);
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
