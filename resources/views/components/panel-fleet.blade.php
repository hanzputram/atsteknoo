{{--
    Machinery Fleet Studio (#equipment)
    Clean light-mode industrial design, matched 100% to ATS Tekno Brand Identity.
    Interactive Three.js 3D Machinery Simulation + Actual Workshop Photo Inset.

    Expected vars: $facilities (array), $steps (array), $phases (array), $resolveImg (Closure)
--}}
@php
    $machines = array_values($facilities['machines'] ?? []);
    $machineCount = count($machines);

    $eqKind = function (array $m): string {
        if (!empty($m['model'])) {
            return (string) $m['model'];
        }
        $hay = strtolower(($m['title'] ?? '') . ' ' . ($m['image'] ?? ''));
        return match (true) {
            str_contains($hay, 'laser') => 'laser',
            str_contains($hay, 'brake'), str_contains($hay, 'bend') => 'bend',
            str_contains($hay, 'punch') => 'punch',
            str_contains($hay, 'shear'), str_contains($hay, 'guillotine') => 'shear',
            str_contains($hay, 'pickle') || str_contains($hay, 'pickling') || str_contains($hay, 'hcl') => 'pickling',
            str_contains($hay, 'phosphate') || str_contains($hay, 'kapur') || str_contains($hay, 'lime') => 'phosphate',
            str_contains($hay, 'powder') || str_contains($hay, 'cure') || str_contains($hay, 'curing') => 'powder',
            str_contains($hay, 'wiring') || str_contains($hay, 'wire') || str_contains($hay, 'assembly') || str_contains($hay, 'elektrik') => 'wiring',
            default => 'cabinet',
        };
    };
    $eqTags = function ($raw): array {
        if (is_array($raw)) {
            return array_values(array_filter($raw));
        }
        return array_values(array_filter(array_map('trim', explode(',', (string) $raw))));
    };
    $eqNum = fn($v) => (int) preg_replace('/\D/', '', (string) $v);

    $totalUnits = 0;
    foreach ($machines as $m) {
        $totalUnits += $eqNum($m['count'] ?? 0);
    }
    $eqStats = [
        ['value' => $totalUnits ?: $machineCount, 'label' => 'Total Operational Units'],
        ['value' => $machineCount, 'label' => 'Production Stations'],
    ];
    $globalHideAnim = !empty($facilities['hide_animation']);
    $allMachinesHide = $globalHideAnim || ($machineCount > 0 && !array_filter($machines, fn($m) => empty($m['hide_animation'])));
    $firstMachineHide = $allMachinesHide || !empty($machines[0]['hide_animation']);
@endphp

@if ($machineCount)
<section class="eq" id="equipment" aria-labelledby="eq-title" data-count="{{ $machineCount }}" data-global-hide-animation="{{ $allMachinesHide ? '1' : '0' }}">

    {{-- ===== Header ===== --}}
    <header class="eq-head" id="eq-head">
        <div class="eq-head-top">
            <div>
                <span class="eq-eyebrow">
                    <span class="eq-eyebrow-dot"></span>
                    {{ $facilities['eyebrow'] ?? 'Production Facilities' }}
                </span>
                <h2 class="eq-title" id="eq-title">{{ $facilities['title'] ?? 'Machinery Engineered for Precision.' }}</h2>
            </div>
            <div class="eq-head-actions">
                <button type="button" class="eq-tour-toggle" id="eq-tour-btn" aria-pressed="true" title="Toggle Auto Fleet Tour">
                    <span class="eq-tour-indicator">
                        <svg class="eq-tour-icon eq-tour-icon--play" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        <svg class="eq-tour-icon eq-tour-icon--pause" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                    </span>
                    <span id="eq-tour-text">Auto Tour Active</span>
                </button>
            </div>
        </div>

        <div class="eq-head-sub">
            <p class="eq-lead">{{ $facilities['description'] ?? 'Sheet metal fabrication and enclosure assembly supported by high-precision CNC laser cutting, punching, and multi-axis hydraulic bending.' }}</p>
            <div class="eq-stats">
                @foreach ($eqStats as $st)
                    <div class="eq-stat-pill">
                        <strong data-count="{{ $st['value'] }}">{{ sprintf('%02d', $st['value']) }}</strong>
                        <span>{{ $st['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </header>

    {{-- ===== Main Studio (Side-by-side: Tabs & Specs on Left, 3D Simulation & Photos on Right) ===== --}}
    <div class="eq-studio" id="eq-studio">

        {{-- Left: Machine Selector Tabs & Specs --}}
        <div class="eq-left-col">
            {{-- Tabs --}}
            <nav class="eq-nav" aria-label="Machinery Fleet Selector">
                <div class="eq-tabs" role="tablist" id="eq-tabs">
                    @foreach ($machines as $i => $m)
                        @php
                            $num = $eqNum($m['count'] ?? 0);
                            $unitStr = $m['unit'] ?? 'UNITS';
                        @endphp
                        <button type="button"
                                class="eq-tab {{ $i === 0 ? 'is-active' : '' }}"
                                role="tab"
                                id="eq-tab-{{ $i }}"
                                aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                                aria-controls="eq-slide-{{ $i }}"
                                tabindex="{{ $i === 0 ? 0 : -1 }}"
                                data-index="{{ $i }}">
                            <span class="eq-tab-num">{{ sprintf('%02d', $i + 1) }}</span>
                            <span class="eq-tab-content">
                                <b class="eq-tab-name">{{ $m['title'] }}</b>
                                <small class="eq-tab-meta">{{ $num }} {{ $unitStr }}</small>
                            </span>
                            <span class="eq-tab-bar" aria-hidden="true"></span>
                        </button>
                    @endforeach
                </div>
            </nav>

            {{-- Dynamic Specs Panel for Active Machine --}}
            <div class="eq-specs-panel">
                @foreach ($machines as $i => $m)
                    @php
                        $tags = $eqTags($m['tags'] ?? []);
                        $num = $eqNum($m['count'] ?? 0);
                    @endphp
                    <div class="eq-panel-slide {{ $i === 0 ? 'is-active' : '' }}" data-panel-index="{{ $i }}">
                        <div class="eq-specs-box">
                            <span class="eq-specs-title">KEY CAPABILITIES & PARAMETERS</span>
                            <ul class="eq-tags">
                                @foreach ($tags as $tag)
                                    <li>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        {{ $tag }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="eq-actions">
                            <button type="button" class="eq-btn eq-btn--primary" data-eq-inspect>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M11 8v6M8 11h6"/></svg>
                                <span>Inspect Workshop Photo</span>
                            </button>
                            <a href="https://wa.me/6282223332830?text=Halo%20ATS%20Tekno,%20saya%20ingin%20konsultasi%20mengenai%20fasilitas%20dan%20jasa%20pembuatan%20panel%20listrik"
                               target="_blank" rel="noopener noreferrer" class="eq-btn eq-btn--ghost">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                <span>Consult Engineering Team</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Machine Details + 3D Simulation + Real Photo --}}
        <div class="eq-right-col">
            {{-- Active Machine Title & Description --}}
            <div class="eq-slides">
                @foreach ($machines as $i => $m)
                    @php
                        $kind = $eqKind($m);
                        $num = $eqNum($m['count'] ?? 0);
                        $imgSrc = $resolveImg($m['image'] ?? 'machine-laser.jpg');
                        $isMachineHidden = $globalHideAnim || !empty($m['hide_animation']);
                    @endphp
                    <article class="eq-slide {{ $i === 0 ? 'is-active' : '' }}"
                             id="eq-slide-{{ $i }}"
                             role="tabpanel"
                             aria-labelledby="eq-tab-{{ $i }}"
                             data-index="{{ $i }}"
                             data-kind="{{ $kind }}"
                             data-title="{{ $m['title'] }}"
                             data-meta="{{ $m['count'] ?? '' }} {{ $m['unit'] ?? '' }}"
                             data-image="{{ $imgSrc }}"
                             data-hide-animation="{{ $isMachineHidden ? '1' : '0' }}"
                             aria-hidden="{{ $i === 0 ? 'false' : 'true' }}">

                        <div class="eq-slide-header">
                            <div>
                                <div class="eq-badge-row">
                                    <span class="eq-pill-badge">
                                        <span class="eq-pulse-dot"></span>
                                        FLEET {{ sprintf('%02d', $i + 1) }} / {{ sprintf('%02d', $machineCount) }}
                                    </span>
                                    <span class="eq-kind-badge">{{ strtoupper($kind) }} SPECIFICATION</span>
                                </div>
                                <h3 class="eq-slide-title">{{ $m['title'] }}</h3>
                            </div>
                            <div class="eq-stat-box">
                                <strong data-count-to="{{ $num }}">{{ sprintf('%02d', $num) }}</strong>
                                <span>{{ $m['unit'] ?? 'UNITS' }}<br>OPERATIONAL</span>
                            </div>
                        </div>

                        <p class="eq-desc">{{ $m['desc'] ?? '' }}</p>
                    </article>
                @endforeach
            </div>

            {{-- 3D Interactive Viewport --}}
            @if (!$allMachinesHide)
            <div class="eq-viewport {{ $firstMachineHide ? 'is-hidden' : '' }}" 
                 id="eq-viewport" 
                 data-eq-cursor="drag" 
                 data-eq-cursor-label="DRAG" 
                 title="Click and drag to rotate 3D machinery model"
                 style="{{ $firstMachineHide ? 'display: none;' : '' }}">
                <canvas id="eq-canvas" aria-label="Interactive 3D simulation of production machinery"></canvas>

                {{-- Real-time HUD Telemetry Badge --}}
                <div class="eq-hud" aria-hidden="true">
                    <div class="eq-hud-header">
                        <span class="eq-hud-live"><i class="eq-live-beacon"></i> REAL-TIME 3D SIMULATION</span>
                        <span class="eq-hud-mode" id="eq-hud-mode">FIBER LASER · NESTING PATH</span>
                    </div>
                    <div class="eq-hud-grid">
                        <div class="eq-hud-item"><span id="eq-hud-l0">FEED</span><b id="eq-hud-v0">1400 mm/min</b></div>
                        <div class="eq-hud-item"><span id="eq-hud-l1">POWER</span><b id="eq-hud-v1">4000 W</b></div>
                        <div class="eq-hud-item"><span id="eq-hud-l2">GAS</span><b id="eq-hud-v2">N2 1.4 MPa</b></div>
                    </div>
                </div>

                {{-- 360 Hint --}}
                <div class="eq-viewport-hint" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                    <span>DRAG TO ORBIT 360°</span>
                </div>
            </div>
            @endif

            {{-- Workshop Real Photo Inset Card --}}
            <div class="eq-photo-strip {{ ($firstMachineHide || $allMachinesHide) ? 'is-full-size' : '' }}">
                <div class="eq-photo-card" id="eq-photo-card" data-eq-inspect role="button" tabindex="0" aria-label="View actual machine photo in full resolution">
                    @foreach ($machines as $i => $m)
                        <img class="eq-photo {{ $i === 0 ? 'is-active' : '' }}"
                             src="{{ $resolveImg($m['image'] ?? 'machine-laser.jpg') }}"
                             alt="{{ $m['title'] }} — ATS Tekno Workshop, Surabaya"
                             width="640" height="420"
                             {{ $i === 0 ? '' : 'loading=lazy' }} decoding="async" draggable="false">
                    @endforeach
                    <div class="eq-photo-overlay">
                        <div class="eq-photo-tag">
                            <span class="eq-photo-dot"></span>
                            <span>ACTUAL WORKSHOP UNIT · ATS SURABAYA</span>
                        </div>
                        <span class="eq-photo-zoom-hint">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M11 8v6M8 11h6"/></svg>
                            Inspect High-Res
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Accessible Fullscreen Lightbox Modal ===== --}}
    <div class="eq-lb" id="eq-lb" role="dialog" aria-modal="true" aria-label="Machine photo inspection" aria-hidden="true" style="display: none;">
        <div class="eq-lb-backdrop" data-eq-lb-close></div>
        <figure class="eq-lb-figure" style="background: #FFFFFF !important; border: 1px solid #E2E8F0 !important; border-radius: 20px !important; overflow: hidden !important; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5) !important;">
            <button type="button" class="eq-lb-close" data-eq-lb-close aria-label="Close photo inspection" title="Close (ESC)" style="position: absolute; top: 16px; right: 16px; z-index: 50; width: 42px; height: 42px; border-radius: 50%; background: #FFFFFF !important; color: #0F172A !important; border: 1.5px solid #CBD5E1 !important; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <div class="eq-lb-frame" id="eq-lb-frame" style="background: #0B1120 !important;">
                <img id="eq-lb-img" src="" alt="" draggable="false">
            </div>
            <figcaption class="eq-lb-cap" style="background: #FFFFFF !important; border-top: 1px solid #E2E8F0 !important; padding: 20px 24px !important; display: flex !important; align-items: center !important; justify-content: space-between !important; gap: 16px !important;">
                <div class="eq-lb-cap-text" style="display: flex !important; flex-direction: column !important; gap: 4px !important; min-width: 0 !important;">
                    <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                        <span class="eq-lb-badge" style="display: inline-flex !important; align-items: center !important; gap: 6px !important; font-family: 'Outfit', sans-serif !important; font-size: 11px !important; font-weight: 800 !important; letter-spacing: 0.08em !important; color: #E11D48 !important; background: #FFF1F2 !important; border: 1px solid #FECDD3 !important; padding: 3px 10px !important; border-radius: 6px !important; width: fit-content !important; text-transform: uppercase !important;">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #E11D48; display: inline-block;"></span>
                            ACTUAL WORKSHOP FACILITIES · ATS SURABAYA
                        </span>
                    </div>
                    <strong id="eq-lb-title" style="display: block !important; font-family: 'Outfit', sans-serif !important; font-size: 20px !important; font-weight: 800 !important; color: #0F172A !important; line-height: 1.3 !important; margin: 0 !important;"></strong>
                    <span id="eq-lb-meta" style="display: block !important; font-size: 14px !important; color: #64748B !important; font-weight: 500 !important; line-height: 1.4 !important; margin-top: 2px !important;"></span>
                </div>
                <div class="eq-lb-nav" style="display: flex !important; align-items: center !important; gap: 10px !important; flex-shrink: 0 !important;">
                    <button type="button" id="eq-lb-prev" aria-label="Previous machine" title="Previous Machine (Left Arrow)" style="width: 44px !important; height: 44px !important; border-radius: 12px !important; border: 1.5px solid #CBD5E1 !important; background: #F8FAFC !important; color: #0F172A !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 1px 3px rgba(15,23,42,0.06) !important;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button type="button" id="eq-lb-next" aria-label="Next machine" title="Next Machine (Right Arrow)" style="width: 44px !important; height: 44px !important; border-radius: 12px !important; border: 1.5px solid #CBD5E1 !important; background: #F8FAFC !important; color: #0F172A !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 1px 3px rgba(15,23,42,0.06) !important;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </figcaption>
        </figure>
    </div>

</section>
@endif
