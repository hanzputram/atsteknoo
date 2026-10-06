(() => {
    'use strict';
    const root = document.getElementById('ats-panel-process');
    if (!root) return;

    // Load dynamic data from window.ATS_PROCESS_DATA if available (set via Blade component)
    const rawData = window.ATS_PROCESS_DATA || {};
    const phases = (rawData.phases && rawData.phases.length) ? rawData.phases : [
        { title: 'Engineering', from: 0, to: 5, image: 'engineering', caption: 'Technical specifications translated into production-ready drawings.', desc: 'Requirements gathering, CAD schematics, client approval, and production planning.' },
        { title: 'Fabrication', from: 6, to: 11, image: 'fabrication', caption: 'Sheet metal precision-cut and formed into structural enclosures.', desc: 'Laser cutting, CNC punching, hydraulic bending, welding, and seam dressing.' },
        { title: 'Surface Treatment', from: 12, to: 18, image: 'surface', caption: 'Substrate chemically prepared for optimal coating adhesion and durability.', desc: 'Degreasing, pickling, neutralization, cascade rinsing, and drying.' },
        { title: 'Coating', from: 19, to: 21, image: 'coating', caption: 'Resilient industrial protective finish for high environmental resistance.', desc: 'Electrostatic powder application, high-temperature curing, and DFT inspection.' },
        { title: 'Assembly', from: 22, to: 26, image: 'assembly', caption: 'Enclosure, switchgear, busbars, and wiring integrated into one unified system.', desc: 'Mechanical assembly, component installation, busbar fabrication, and wiring.' },
        { title: 'Quality & Delivery', from: 27, to: 32, image: 'quality', caption: 'Comprehensive FAT testing, certification, crating, and site dispatch.', desc: 'Electrical testing, FAT simulation, documentation, packing, and dispatch.' }
    ];

    const rawSteps = (rawData.steps && rawData.steps.length) ? rawData.steps : [];
    const steps = rawSteps.map(s => {
        if (Array.isArray(s)) return s;
        return [
            s.title || '',
            s.subtitle || '',
            s.description || '',
            Array.isArray(s.activities) ? s.activities : (s.activities ? String(s.activities).split('\n').filter(Boolean) : []),
            s.checkpoint || '',
            s.output || '',
            s.image || ''
        ];
    });

    let current = 0, timer = null, playing = false;
    const $ = id => root.querySelector('#ats-' + id);
    const pad = n => String(n).padStart(2, '0');
    const phaseFor = n => phases.findIndex(p => n >= p.from && n <= p.to);
    const assetBase = (root.dataset.assetBase || '').replace(/\/$/, '');
    const asset = name => {
        if (!name) return '';
        if (name.startsWith('http://') || name.startsWith('https://') || name.startsWith('/')) return name;
        return name.includes('.') ? assetBase + '/' + name : assetBase + '/' + name + '.webp';
    };

    const tourLabelPlay = (rawData.explorer && rawData.explorer.tour_button_play) ? rawData.explorer.tour_button_play : 'Play Process Tour';
    const tourLabelPause = (rawData.explorer && rawData.explorer.tour_button_pause) ? rawData.explorer.tour_button_pause : 'Pause Tour';
    const directoryBtnLabel = (rawData.directory && rawData.directory.button_label) ? rawData.directory.button_label : 'View step details';

    if ($('phase-grid')) {
        $('phase-grid').innerHTML = phases.map((p, i) => `
            <article class="phase-card reveal" style="transition-delay:${i * 45}ms">
                <div class="phase-photo">
                    <img src="${asset(p.image)}" alt="${p.title} - ATS Tekno Documentation" width="402" height="267">
                    <span class="photo-caption">${p.caption}</span>
                </div>
                <div class="phase-heading">
                    <span class="phase-no">${pad(i + 1)}</span>
                    <div>
                        <h3>${p.title}</h3>
                        <span class="phase-range">STEP ${pad(p.from + 1)} — ${pad(p.to + 1)}</span>
                    </div>
                </div>
                <p class="phase-desc">${p.desc}</p>
                <button class="phase-link" data-phase="${i}">Explore ${p.to - p.from + 1} steps <span class="plus" aria-hidden="true">+</span></button>
            </article>
        `).join('');
    }

    if ($('phase-tabs')) {
        $('phase-tabs').innerHTML = phases.map((p, i) => `
            <button class="phase-tab" role="tab" id="ats-tab-${i}" aria-controls="ats-step-list" aria-selected="${i === 0}" tabindex="${i === 0 ? 0 : -1}" data-phase="${i}">
                ${pad(i + 1)} &nbsp; ${p.title}
            </button>
        `).join('');
    }

    if ($('sequence')) {
        $('sequence').innerHTML = steps.map((s, i) => `
            <button data-step="${i}" aria-label="Step ${i + 1}: ${s[0]}" title="${pad(i + 1)} · ${s[0]}" aria-current="${i === 0 ? 'step' : 'false'}">
                ${pad(i + 1)}
            </button>
        `).join('');
    }

    if ($('directory-grid')) {
        $('directory-grid').innerHTML = phases.map((p, i) => `
            <div class="directory-phase">
                <h3><span>${pad(i + 1)}</span>${p.title}</h3>
                ${steps.slice(p.from, p.to + 1).map((s, j) => `
                    <details>
                        <summary><span class="num">${pad(p.from + j + 1)}</span>${s[0]}<span class="symbol" aria-hidden="true">+</span></summary>
                        <p>${s[2]}</p>
                        <button class="directory-open" data-step="${p.from + j}" data-scroll="true">${directoryBtnLabel}</button>
                    </details>
                `).join('')}
            </div>
        `).join('');
    }

    function select(n, scroll = false) {
        current = Math.max(0, Math.min(steps.length - 1, n));
        const pi = phaseFor(current);
        const p = phases[pi];
        const s = steps[current];

        root.querySelectorAll('.phase-tab').forEach((b, i) => {
            b.setAttribute('aria-selected', i === pi);
            b.tabIndex = i === pi ? 0 : -1;
        });

        if ($('step-list')) {
            $('step-list').setAttribute('role', 'tabpanel');
            $('step-list').setAttribute('aria-labelledby', 'ats-tab-' + pi);
            $('step-list').innerHTML = steps.slice(p.from, p.to + 1).map((v, j) => `
                <button class="step-item" data-step="${p.from + j}" aria-current="${p.from + j === current ? 'step' : 'false'}">
                    <span>${pad(p.from + j + 1)}</span>${v[0]}
                </button>
            `).join('');
        }

        if ($('detail')) {
            const stepPhoto = s[6] ? asset(s[6]) : asset(p.image);
            $('detail').innerHTML = `
                <div class="detail-hero">
                    <div class="detail-heading">
                        <div class="detail-meta">
                            <b>STEP ${pad(current + 1)} / ${steps.length}</b>
                            <span>${p.title.toUpperCase()}</span>
                        </div>
                        <h3 id="ats-detail-title">${s[1]}</h3>
                        <p class="detail-en">${s[0]}</p>
                    </div>
                    <div class="detail-photo">
                        <img src="${stepPhoto}" alt="${s[0]} - ATS Tekno Switchboard Fabrication" width="402" height="267">
                    </div>
                </div>
                <div class="detail-body">
                    <p class="detail-description">${s[2]}</p>
                    <div class="detail-columns">
                        <div>
                            <h4>Activities Carried Out</h4>
                            <ul>${(s[3] || []).map(t => `<li>${t}</li>`).join('')}</ul>
                        </div>
                        <div>
                            <h4>Quality Checkpoint</h4>
                            <ul><li>${s[4]}</li></ul>
                        </div>
                    </div>
                    <div class="output">
                        <b>OUTPUT</b>
                        <span>${s[5]}</span>
                    </div>
                </div>
                <div class="detail-controls">
                    <button data-action="prev" ${current === 0 ? 'disabled' : ''}>&larr; Previous</button>
                    <span>${pad(current + 1)} of ${steps.length} steps</span>
                    <button data-action="next" ${current === steps.length - 1 ? 'disabled' : ''}>Next Step &rarr;</button>
                </div>
                <div class="progress-track" aria-hidden="true">
                    <div class="progress-fill" style="width:${((current + 1) / steps.length) * 100}%"></div>
                </div>
            `;

            $('detail').classList.remove('changing');
            void $('detail').offsetWidth;
            $('detail').classList.add('changing');
        }

        root.querySelectorAll('.sequence button').forEach((b, i) => b.setAttribute('aria-current', i === current ? 'step' : 'false'));
        if (scroll && $('explorer')) {
            $('explorer').scrollIntoView({
                behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
                block: 'start'
            });
        }
    }

    function stop() {
        clearInterval(timer);
        timer = null;
        playing = false;
        if ($('tour')) {
            $('tour').setAttribute('aria-pressed', 'false');
            if ($('tour-icon')) $('tour-icon').textContent = '▶';
            if ($('tour-label')) $('tour-label').textContent = tourLabelPlay;
        }
    }

    root.addEventListener('click', e => {
        const b = e.target.closest('button');
        if (!b) return;
        if (b.hasAttribute('data-phase')) {
            stop();
            select(phases[Number(b.dataset.phase)].from, !b.classList.contains('phase-tab'));
        } else if (b.hasAttribute('data-step')) {
            stop();
            const hadFocus = document.activeElement === b, wasList = b.classList.contains('step-item');
            select(Number(b.dataset.step), b.dataset.scroll === 'true');
            if (hadFocus && wasList) $('step-list').querySelector('[aria-current="step"]').focus({ preventScroll: true });
        } else if (b.dataset.action) {
            stop();
            select(current + (b.dataset.action === 'next' ? 1 : -1));
            $('detail').querySelector(`[data-action="${b.dataset.action}"]`).focus({ preventScroll: true });
        }
    });

    if ($('phase-tabs')) {
        $('phase-tabs').addEventListener('keydown', e => {
            if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(e.key)) return;
            const b = e.target.closest('.phase-tab');
            if (!b) return;
            e.preventDefault();
            let i = Number(b.dataset.phase);
            i = e.key === 'Home' ? 0 : e.key === 'End' ? 5 : (i + (e.key === 'ArrowRight' ? 1 : 5)) % 6;
            stop();
            select(phases[i].from);
            $('phase-tabs').children[i].focus();
        });
    }

    if ($('tour')) {
        $('tour').addEventListener('click', () => {
            if (playing) {
                stop();
                return;
            }
            if (current === steps.length - 1) select(0);
            playing = true;
            $('tour').setAttribute('aria-pressed', 'true');
            if ($('tour-icon')) $('tour-icon').textContent = 'Ⅱ';
            if ($('tour-label')) $('tour-label').textContent = tourLabelPause;
            timer = setInterval(() => {
                if (document.hidden) return;
                if (current >= steps.length - 1) {
                    stop();
                    return;
                }
                select(current + 1);
                if (current === steps.length - 1) stop();
            }, 6500);
        });
    }

    /* ========================================================
       7. INTERACTIVE MACHINERY FLEET STUDIO
       ======================================================== */
    function initMachineStudio() {
        const facSec = $('facilities');
        if (!facSec) return;

        let machines = [];
        try {
            machines = JSON.parse(facSec.dataset.machines || '[]');
        } catch (e) {
            machines = [];
        }
        if (!machines || !machines.length) {
            machines = (rawData.facilities && rawData.facilities.machines) ? rawData.facilities.machines : [];
        }
        if (!machines || !machines.length) return;

        let activeMachineIdx = 0;
        let machineTimer = null;
        let machineTourPlaying = false;

        const stageEl = $('machine-stage');
        const stageImg = $('stage-img');
        const stageCount = $('stage-count');
        const stageUnit = $('stage-unit');
        const stageIdx = $('stage-idx');
        const stageTitle = $('stage-title');
        const stageDesc = $('stage-desc');
        const stageTags = $('stage-tags');
        const stageStepTitle = $('stage-step-title');
        const stageJumpBtn = $('stage-jump-btn');
        const tourBtn = $('machine-tour-btn');
        const zoomBtn = $('stage-zoom-btn');
        const lightbox = $('machine-lightbox');
        const lightboxImg = $('lightbox-img');
        const lightboxCaption = $('lightbox-caption');
        const lightboxClose = $('lightbox-close');
        const lightboxBackdrop = $('lightbox-backdrop');

        function setMachine(idx, animate = true) {
            activeMachineIdx = Math.max(0, Math.min(machines.length - 1, idx));
            const m = machines[activeMachineIdx];
            if (!m) return;

            if (animate && stageEl) {
                stageEl.classList.remove('changing');
                void stageEl.offsetWidth; // force reflow
                stageEl.classList.add('changing');
            }

            if (stageImg) {
                stageImg.src = asset(m.image || 'machine-laser.jpg');
                stageImg.alt = m.title || 'Machine';
            }
            if (stageCount) stageCount.textContent = m.count || '01';
            if (stageUnit) stageUnit.textContent = m.unit || 'UNITS';
            if (stageIdx) stageIdx.textContent = `FLEET ${pad(activeMachineIdx + 1)} / ${pad(machines.length)}`;
            if (stageTitle) stageTitle.textContent = m.title || '';
            if (stageDesc) stageDesc.innerHTML = (m.desc || '').replace(/\n/g, '<br>');

            if (stageTags) {
                const tags = Array.isArray(m.tags) ? m.tags : (m.tags ? String(m.tags).split(',').map(t => t.trim()).filter(Boolean) : []);
                stageTags.innerHTML = tags.map(t => `
                    <span class="stage-tag-chip">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                        ${t}
                    </span>
                `).join('');
            }

            if (stageStepTitle) {
                stageStepTitle.textContent = m.powers_step || 'Integrated Process Step';
            }
            if (stageJumpBtn) {
                stageJumpBtn.dataset.stepIndex = m.powers_step_index ?? 0;
            }

            // Sync fleet cards
            root.querySelectorAll('.fleet-card').forEach((card, cIdx) => {
                const isActive = cIdx === activeMachineIdx;
                card.classList.toggle('active', isActive);
                card.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
        }

        function stopMachineTour() {
            if (machineTimer) {
                clearInterval(machineTimer);
                machineTimer = null;
            }
            machineTourPlaying = false;
            if (tourBtn) {
                tourBtn.setAttribute('aria-pressed', 'false');
                const span = tourBtn.querySelector('span');
                if (span) span.textContent = 'Auto Fleet Tour';
            }
        }

        function startMachineTour() {
            stopMachineTour();
            machineTourPlaying = true;
            if (tourBtn) {
                tourBtn.setAttribute('aria-pressed', 'true');
                const span = tourBtn.querySelector('span');
                if (span) span.textContent = 'Pause Fleet Tour';
            }
            machineTimer = setInterval(() => {
                if (document.hidden) return;
                const nextIdx = (activeMachineIdx + 1) % machines.length;
                setMachine(nextIdx, true);
            }, 4500);
        }

        if (tourBtn) {
            tourBtn.addEventListener('click', () => {
                if (machineTourPlaying) {
                    stopMachineTour();
                } else {
                    startMachineTour();
                }
            });
        }

        // Fleet card clicks
        root.querySelectorAll('.fleet-card').forEach((card) => {
            card.addEventListener('click', () => {
                stopMachineTour();
                const idx = Number(card.dataset.machineIndex || 0);
                setMachine(idx, true);
            });
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    card.click();
                }
            });
        });

        // Jump to 33-step Explorer
        if (stageJumpBtn) {
            stageJumpBtn.addEventListener('click', () => {
                stopMachineTour();
                const stepIdx = Number(stageJumpBtn.dataset.stepIndex || 0);
                select(stepIdx, true);
            });
        }

        // Lightbox Inspection Modal
        function openLightbox() {
            const m = machines[activeMachineIdx];
            if (!m || !lightbox || !lightboxImg) return;
            lightboxImg.src = asset(m.image || 'machine-laser.jpg');
            if (lightboxCaption) {
                lightboxCaption.textContent = `${m.title} — ${m.count} ${m.unit} | ATS Manufacturing Fleet`;
            }
            lightbox.style.display = 'flex';
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            if (!lightbox) return;
            lightbox.style.display = 'none';
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        if (zoomBtn) zoomBtn.addEventListener('click', openLightbox);
        if (stageImg) {
            stageImg.style.cursor = 'zoom-in';
            stageImg.addEventListener('click', openLightbox);
        }
        if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
        if (lightboxBackdrop) lightboxBackdrop.addEventListener('click', closeLightbox);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox && lightbox.style.display === 'flex') {
                closeLightbox();
            }
        });
    }

    document.addEventListener('visibilitychange', () => {
        if (document.hidden && playing) stop();
    });

    select(0);
    initMachineStudio();

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(entries => entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                observer.unobserve(e.target);
            }
        }), { threshold: .08 });
        root.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    } else {
        root.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
    }
})();
