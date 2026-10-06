{{--
    Machinery Fleet Studio (#equipment)
    Server-rendered (SEO + no-JS friendly). Enhanced by equipment.js (scroll-driven stage)
    and equipment-scene.js (Three.js simulation).

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
        if (strtolower($m['unit'] ?? '') === 'units') {
            $totalUnits += $eqNum($m['count'] ?? 0);
        }
    }
    $eqStats = [
        ['value' => $totalUnits ?: $machineCount, 'label' => 'Production Machines'],
        ['value' => $machineCount, 'label' => 'Machine Families'],
        ['value' => count($steps ?? []), 'label' => 'Process Steps'],
        ['value' => count($phases ?? []), 'label' => 'Integrated Phases'],
    ];
@endphp

@if ($machineCount)
<section class="eq" id="equipment" aria-labelledby="eq-title" style="--eq-n: {{ $machineCount }}">

    {{-- ===== Header ===== --}}
    <div class="eq-bg eq-bg--head" aria-hidden="true">
        <span class="eq-orb eq-orb--a"></span>
        <span class="eq-orb eq-orb--b"></span>
        <span class="eq-noise"></span>
    </div>

    <header class="eq-head wrap" id="eq-head">
        <span class="eq-eyebrow">{{ $facilities['eyebrow'] ?? 'Production Facilities' }}</span>
        <h2 class="eq-title" id="eq-title">{{ $facilities['title'] ?? 'Machinery Engineered for Precision.' }}</h2>
        <div class="eq-head-row">
            <p class="eq-lead">{{ $facilities['description'] ?? 'Sheet metal fabrication and enclosure assembly supported by high-precision CNC machinery.' }}</p>
            <dl class="eq-stats">
                @foreach ($eqStats as $st)
                    <div class="eq-stat">
                        <dt>{{ $st['label'] }}</dt>
                        <dd data-count="{{ $st['value'] }}">{{ sprintf('%02d', $st['value']) }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </header>

    {{-- ===== Velocity marquee ===== --}}
    <div class="eq-marquee" aria-hidden="true">
        <div class="eq-marquee-track" id="eq-marquee-track">
            @for ($g = 0; $g < 2; $g++)
                <div class="eq-marquee-group">
                    @foreach ($machines as $m)
                        <span class="eq-marquee-item">{{ $m['title'] }}</span>
                        <span class="eq-marquee-star">✦</span>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>

    {{-- ===== Scroll-driven stage ===== --}}
    <div class="eq-scroll" id="eq-scroll">
        <div class="eq-stage" id="eq-stage">
            <div class="eq-bg" aria-hidden="true">
                <span class="eq-orb eq-orb--a"></span>
                <span class="eq-orb eq-orb--b"></span>
                <span class="eq-noise"></span>
            </div>
            <div class="eq-ghost" aria-hidden="true" id="eq-ghost">01</div>

            <div class="eq-grid wrap">
                {{-- Left: machine information --}}
                <div class="eq-info">
                    <div class="eq-meta">
                        <span class="eq-index" id="eq-index" aria-live="polite">FLEET 01 / {{ sprintf('%02d', $machineCount) }}</span>
                        <span class="eq-live"><i></i> LIVE SIMULATION</span>
                    </div>

                    <div class="eq-slides">
                        @foreach ($machines as $i => $m)
                            @php
                                $kind = $eqKind($m);
                                $tags = $eqTags($m['tags'] ?? []);
                                $num = $eqNum($m['count'] ?? 0);
                                $imgSrc = $resolveImg($m['image'] ?? 'machine-laser.jpg');
                            @endphp
                            <article class="eq-slide {{ $i === 0 ? 'is-active' : '' }}"
                                     data-index="{{ $i }}"
                                     data-kind="{{ $kind }}"
                                     data-step-index="{{ $m['powers_step_index'] ?? 0 }}"
                                     data-title="{{ $m['title'] }}"
                                     data-meta="{{ $m['count'] ?? '' }} {{ $m['unit'] ?? '' }}"
                                     data-image="{{ $imgSrc }}"
                                     aria-hidden="{{ $i === 0 ? 'false' : 'true' }}">
                                <h3 class="eq-slide-title">{{ $m['title'] }}</h3>

                                <div class="eq-count-row eq-r" style="--d:1">
                                    <div class="eq-count">
                                        <strong data-count-to="{{ $num }}">{{ sprintf('%02d', $num) }}</strong>
                                        <span>{{ $m['unit'] ?? 'units' }}<br>operational</span>
                                    </div>
                                    <div class="eq-stepchip">
                                        <small>INTEGRATED PROCESS STAGE</small>
                                        <b>{{ $m['powers_step'] ?? 'Process Step' }}</b>
                                    </div>
                                </div>

                                <p class="eq-desc eq-r" style="--d:2">{{ $m['desc'] ?? '' }}</p>

                                <ul class="eq-tags">
                                    @foreach ($tags as $ti => $tag)
                                        <li class="eq-r" style="--d:{{ 3 + $ti * 0.5 }}">{{ $tag }}</li>
                                    @endforeach
                                </ul>

                                <div class="eq-actions eq-r" style="--d:5.5">
                                    <button type="button" class="eq-btn eq-btn--primary" data-eq-jump="{{ $m['powers_step_index'] ?? 0 }}">
                                        <span>View in 33-Step Process</span>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                                    </button>
                                    <button type="button" class="eq-btn eq-btn--ghost" data-eq-inspect>
                                        <span>Inspect photo</span>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M11 8v6M8 11h6"/></svg>
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- Right: WebGL simulation + real photo --}}
                <div class="eq-visual">
                    <div class="eq-viewport" id="eq-viewport" data-eq-cursor="drag" data-eq-cursor-label="DRAG">
                        <canvas id="eq-canvas" aria-hidden="true"></canvas>
                        <div class="eq-hud" aria-hidden="true">
                            <i class="eq-corner eq-corner--tl"></i><i class="eq-corner eq-corner--tr"></i>
                            <i class="eq-corner eq-corner--bl"></i><i class="eq-corner eq-corner--br"></i>
                            <div class="eq-hud-top">
                                <span class="eq-hud-mode" id="eq-hud-mode">FIBER LASER · NESTING PATH</span>
                                <span class="eq-hud-rt"><i></i> REAL-TIME</span>
                            </div>
                            <div class="eq-hud-read">
                                <div><span id="eq-hud-l0">—</span><b id="eq-hud-v0">—</b></div>
                                <div><span id="eq-hud-l1">—</span><b id="eq-hud-v1">—</b></div>
                                <div><span id="eq-hud-l2">—</span><b id="eq-hud-v2">—</b></div>
                            </div>
                            <div class="eq-hud-hint">DRAG TO ORBIT</div>
                        </div>
                    </div>

                    <div class="eq-photos">
                        <button type="button" class="eq-photo-card" id="eq-photo-card" data-eq-inspect data-eq-cursor="inspect" data-eq-cursor-label="INSPECT" aria-label="Inspect actual machine photo">
                            @foreach ($machines as $i => $m)
                                <img class="eq-photo {{ $i === 0 ? 'is-active' : '' }}"
                                     src="{{ $resolveImg($m['image'] ?? 'machine-laser.jpg') }}"
                                     alt="{{ $m['title'] }} — ATS Tekno production floor, Surabaya"
                                     width="640" height="480"
                                     {{ $i === 0 ? '' : 'loading=lazy' }} decoding="async" draggable="false">
                            @endforeach
                            <span class="eq-photo-expand" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                            </span>
                            <span class="eq-photo-tag"><span><i></i> ACTUAL UNIT</span><span>ATS · SURABAYA</span></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Rail --}}
            <nav class="eq-rail wrap" aria-label="Machinery fleet">
                <div class="eq-rail-inner" role="tablist" id="eq-rail">
                    @foreach ($machines as $i => $m)
                        <button type="button" class="eq-rail-btn {{ $i === 0 ? 'is-active' : '' }}" role="tab"
                                aria-selected="{{ $i === 0 ? 'true' : 'false' }}" tabindex="{{ $i === 0 ? 0 : -1 }}" data-index="{{ $i }}">
                            <span class="eq-rail-num">{{ sprintf('%02d', $i + 1) }}</span>
                            <span class="eq-rail-name">{{ $m['title'] }}</span>
                            <span class="eq-rail-unit">{{ $m['count'] ?? '' }} {{ $m['unit'] ?? '' }}</span>
                        </button>
                    @endforeach
                </div>
            </nav>
            <div class="eq-scrollhint" id="eq-scrollhint" aria-hidden="true">SCROLL</div>

            <div class="eq-cursor" id="eq-cursor" aria-hidden="true">
                <span class="eq-cursor-ring"></span>
                <span class="eq-cursor-label" id="eq-cursor-label"></span>
            </div>
        </div>
    </div>

    {{-- ===== Lightbox (relocated to <body> by JS) ===== --}}
    <div class="eq-lb" id="eq-lb" role="dialog" aria-modal="true" aria-label="Machine photo inspection" aria-hidden="true">
        <div class="eq-lb-backdrop" data-eq-lb-close></div>
        <figure class="eq-lb-figure">
            <button type="button" class="eq-lb-close" data-eq-lb-close aria-label="Close">&times;</button>
            <div class="eq-lb-frame" id="eq-lb-frame"><img id="eq-lb-img" src="" alt="" draggable="false"></div>
            <figcaption class="eq-lb-cap">
                <div><strong id="eq-lb-title"></strong><span id="eq-lb-meta"></span></div>
                <div class="eq-lb-nav">
                    <button type="button" id="eq-lb-prev" aria-label="Previous machine">&larr;</button>
                    <button type="button" id="eq-lb-next" aria-label="Next machine">&rarr;</button>
                </div>
            </figcaption>
        </figure>
    </div>
</section>
@endif
