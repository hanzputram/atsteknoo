{{--
    Machinery Fleet Studio (#equipment)
    Clean light-mode industrial design (matching ATS Tekno brand identity).
    Enhanced with Three.js 3D simulations (equipment-scene.js) and interactive studio controller (equipment.js).

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
        $u = strtolower($m['unit'] ?? '');
        if (str_contains($u, 'unit')) {
            $totalUnits += $eqNum($m['count'] ?? 0);
        }
    }
    $eqStats = [
        ['value' => $totalUnits ?: $machineCount, 'label' => 'Total Machines'],
        ['value' => $machineCount, 'label' => 'Machine Families'],
        ['value' => count($steps ?? []), 'label' => 'Process Steps'],
    ];
@endphp

@if ($machineCount)
<section class="eq" id="equipment" aria-labelledby="eq-title" data-count="{{ $machineCount }}">

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
                        <span class="eq-tour-ring"></span>
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

    {{-- ===== Machine Selector Tabs ===== --}}
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

    {{-- ===== Main Studio Card (Light Luxury Industrial) ===== --}}
    <div class="eq-studio" id="eq-studio">

        {{-- Left: Machine Information & Specs --}}
        <div class="eq-info-col">
            <div class="eq-slides">
                @foreach ($machines as $i => $m)
                    @php
                        $kind = $eqKind($m);
                        $tags = $eqTags($m['tags'] ?? []);
                        $num = $eqNum($m['count'] ?? 0);
                        $imgSrc = $resolveImg($m['image'] ?? 'machine-laser.jpg');
                    @endphp
                    <article class="eq-slide {{ $i === 0 ? 'is-active' : '' }}"
                             id="eq-slide-{{ $i }}"
                             role="tabpanel"
                             aria-labelledby="eq-tab-{{ $i }}"
                             data-index="{{ $i }}"
                             data-kind="{{ $kind }}"
                             data-step-index="{{ $m['powers_step_index'] ?? 0 }}"
                             data-title="{{ $m['title'] }}"
                             data-meta="{{ $m['count'] ?? '' }} {{ $m['unit'] ?? '' }}"
                             data-image="{{ $imgSrc }}"
                             aria-hidden="{{ $i === 0 ? 'false' : 'true' }}">

                        <div class="eq-badge-row">
                            <span class="eq-pill-badge">
                                <span class="eq-pulse-dot"></span>
                                FLEET {{ sprintf('%02d', $i + 1) }} / {{ sprintf('%02d', $machineCount) }}
                            </span>
                            <span class="eq-kind-badge">{{ strtoupper($kind) }} SPECIFICATION</span>
                        </div>

                        <h3 class="eq-slide-title">{{ $m['title'] }}</h3>

                        <div class="eq-meta-row">
                            <div class="eq-stat-box">
                                <strong data-count-to="{{ $num }}">{{ sprintf('%02d', $num) }}</strong>
                                <span>{{ $m['unit'] ?? 'UNITS' }}<br>OPERATIONAL</span>
                            </div>
                            <div class="eq-step-box">
                                <span class="eq-step-label">INTEGRATED PROCESS STAGE</span>
                                <b class="eq-step-val">{{ $m['powers_step'] ?? 'Production Step' }}</b>
                            </div>
                        </div>

                        <p class="eq-desc">{{ $m['desc'] ?? '' }}</p>

                        <div class="eq-specs">
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
                            <button type="button" class="eq-btn eq-btn--primary" data-eq-jump="{{ $m['powers_step_index'] ?? 0 }}">
                                <span>View in 33-Step Process</span>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                            </button>
                            <button type="button" class="eq-btn eq-btn--ghost" data-eq-inspect>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M11 8v6M8 11h6"/></svg>
                                <span>Inspect High-Res Photo</span>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- Right: 3D WebGL Simulation + Workshop Photo Inset --}}
        <div class="eq-visual-col">
            {{-- 3D Interactive Viewport --}}
            <div class="eq-viewport" id="eq-viewport" data-eq-cursor="drag" data-eq-cursor-label="DRAG" title="Click and drag to rotate 3D machinery model">
                <canvas id="eq-canvas" aria-label="Interactive 3D simulation of production machinery"></canvas>

                {{-- Clean HUD Telemetry Badge --}}
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

                {{-- Interactive Hint --}}
                <div class="eq-viewport-hint" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                    <span>DRAG TO ORBIT 360°</span>
                </div>
            </div>

            {{-- Actual Machine Photo Inset --}}
            <div class="eq-photo-strip">
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
        <figure class="eq-lb-figure">
            <button type="button" class="eq-lb-close" data-eq-lb-close aria-label="Close modal">&times;</button>
            <div class="eq-lb-frame" id="eq-lb-frame">
                <img id="eq-lb-img" src="" alt="" draggable="false">
            </div>
            <figcaption class="eq-lb-cap">
                <div>
                    <strong id="eq-lb-title"></strong>
                    <span id="eq-lb-meta"></span>
                </div>
                <div class="eq-lb-nav">
                    <button type="button" id="eq-lb-prev" aria-label="Previous machine">&larr;</button>
                    <button type="button" id="eq-lb-next" aria-label="Next machine">&rarr;</button>
                </div>
            </figcaption>
        </figure>
    </div>

</section>
@endif
