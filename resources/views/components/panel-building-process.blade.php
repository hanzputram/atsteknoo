@props(['standalone' => false])

@php
    $data = \App\Services\PanelProcessService::getData();
    $intro = $data['intro'] ?? [];
    $sectionLine = $data['section_line'] ?? [];
    $explorer = $data['explorer'] ?? [];
    $directory = $data['directory'] ?? [];
    $facilities = $data['facilities'] ?? [];
    $quality = $data['quality'] ?? [];
    $phases = $data['phases'] ?? [];
    $steps = $data['steps'] ?? [];

    $resolveImg = function($name) {
        if (!$name) return '';
        if (str_starts_with($name, 'http://') || str_starts_with($name, 'https://') || str_starts_with($name, '/')) {
            return $name;
        }
        return asset('panel-building-process/images/' . (str_contains($name, '.') ? $name : $name . '.webp'));
    };
@endphp

@once
    <link rel="stylesheet" href="{{ asset('panel-building-process/css/process.css') }}">
    <link rel="stylesheet" href="{{ asset('panel-building-process/css/equipment.css') }}">
    <script>
        window.ATS_PROCESS_DATA = @json($data);
    </script>
    <script src="{{ asset('panel-building-process/js/process.js') }}" defer></script>
    <script src="{{ asset('panel-building-process/js/three.min.js') }}" defer></script>
    <script src="{{ asset('panel-building-process/js/equipment-scene.js') }}" defer></script>
    <script src="{{ asset('panel-building-process/js/equipment.js') }}" defer></script>
@endonce

<div class="ats-process" id="ats-panel-process" data-asset-base="{{ asset('panel-building-process/images') }}">
    <div class="wrap">
        @if ($standalone)
            <header class="site-head">
                <a class="brand" href="{{ route('home') }}" aria-label="ATS Tekno Home">
                    <b>ATS</b> tekno<small>INDUSTRIAL ELECTRICAL SOLUTIONS</small>
                </a>
                <nav aria-label="Page navigation">
                    <a href="#ats-process-phases">Process</a>
                    <a href="#equipment">Facilities</a>
                    <a href="#ats-quality">Quality</a>
                </nav>
                <span class="head-tag">MANUFACTURING / PANEL BUILDING</span>
            </header>
        @endif

        <main>
            @if (!$standalone)
                <nav class="ats-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <span class="sep">&rsaquo;</span>
                    <a href="{{ route('services.panel') }}">Panel Builder</a>
                    <span class="sep">&rsaquo;</span>
                    <span class="current">33-Stage Manufacturing Process</span>
                </nav>
            @endif

            <!-- Hero Introduction -->
            <section class="intro">
                <div>
                    <span class="eyebrow">{{ $intro['eyebrow'] ?? 'Behind Every Switchboard' }}</span>
                    <h1>{!! $intro['title'] ?? 'Precision.' !!}<br><span class="ats-accent">{!! $intro['title_em'] ?? 'In every process.' !!}</span></h1>
                </div>
                <div class="intro-copy">
                    <p>{{ $intro['description'] ?? 'From initial technical specifications to fully commissioned switchboards. Discover how each enclosure is engineered, laser-cut, formed, powder-coated, assembled, and verified.' }}</p>
                    <div class="intro-stat">
                        <strong>{{ $intro['stat_steps_num'] ?? '33' }}</strong>
                        <span>{!! $intro['stat_steps_label'] ?? "Production<br>Steps" !!}</span>
                        <strong>{{ $intro['stat_phases_num'] ?? '06' }}</strong>
                        <span>{!! $intro['stat_phases_label'] ?? "Integrated<br>Phases" !!}</span>
                    </div>
                </div>
            </section>

            <!-- 6 Manufacturing Phases Grid -->
            <section id="ats-process-phases" aria-label="Six Integrated Switchboard Manufacturing Phases">
                <div class="section-line">
                    <h2>{{ $sectionLine['title'] ?? 'The Making of a Switchboard' }}</h2>
                    <p>{{ $sectionLine['hint'] ?? 'Hover over cards to preview · Click to explore detailed steps' }}</p>
                </div>
                <div class="phase-grid" id="ats-phase-grid">
                    @foreach($phases as $i => $p)
                        <article class="phase-card reveal" style="transition-delay: {{ $i * 45 }}ms">
                            <div class="phase-photo">
                                <img src="{{ $resolveImg($p['image']) }}" alt="{{ $p['title'] }} - ATS Tekno Switchboard Fabrication" width="402" height="267" loading="lazy">
                                <span class="photo-caption">{{ $p['caption'] }}</span>
                            </div>
                            <div class="phase-heading">
                                <span class="phase-no">{{ sprintf('%02d', $i + 1) }}</span>
                                <div>
                                    <h3>{{ $p['title'] }}</h3>
                                    <span class="phase-range">STEP {{ sprintf('%02d', $p['from'] + 1) }} — {{ sprintf('%02d', $p['to'] + 1) }}</span>
                                </div>
                            </div>
                            <p class="phase-desc">{{ $p['desc'] }}</p>
                            <button class="phase-link" data-phase="{{ $i }}">
                                Explore {{ $p['to'] - $p['from'] + 1 }} steps <span class="plus" aria-hidden="true">+</span>
                            </button>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>
    </div>

    <!-- Interactive Step Explorer & Auto-Tour -->
    <section class="explorer" id="ats-explorer" aria-labelledby="ats-explorer-title">
        <div class="wrap">
            <div class="explorer-top">
                <div>
                    <span class="eyebrow">{{ $explorer['eyebrow'] ?? 'Process Explorer' }}</span>
                    <h2 id="ats-explorer-title">{{ $explorer['title'] ?? 'Explore Every Step.' }}</h2>
                </div>
                <button class="tour" id="ats-tour" aria-pressed="false">
                    <span id="ats-tour-icon" aria-hidden="true">▷</span>
                    <span id="ats-tour-label">{{ $explorer['tour_button_play'] ?? 'Play Process Tour' }}</span>
                </button>
            </div>
            <div class="phase-tabs" id="ats-phase-tabs" role="tablist" aria-label="Select Manufacturing Phase"></div>
            <div class="explorer-layout">
                <div class="step-list" id="ats-step-list" aria-label="Steps within Phase"></div>
                <article class="detail" id="ats-detail" aria-labelledby="ats-detail-title"></article>
            </div>
            <div class="sequence" id="ats-sequence" aria-label="33-Step Fast Navigation"></div>
        </div>
    </section>

    <!-- Complete 33-Step Directory Accordion (Server-Rendered for SEO Crawlers) -->
    <div class="wrap">
        <section class="directory" id="ats-directory">
            <div class="directory-title">
                <h2>{{ $directory['title'] ?? 'Full Production Workflow. Zero Compromise.' }}</h2>
                <span>{!! $directory['subtitle'] ?? "01 — 33<br>Click to expand step details" !!}</span>
            </div>
            <div class="directory-grid" id="ats-directory-grid">
                @foreach($phases as $pIdx => $p)
                    <div class="directory-phase">
                        <h3><span>{{ sprintf('%02d', $pIdx + 1) }}</span>{{ $p['title'] }}</h3>
                        @php
                            $phaseSteps = array_slice($steps, $p['from'], $p['to'] - $p['from'] + 1);
                        @endphp
                        @foreach($phaseSteps as $j => $s)
                            @php
                                $stepIdx = $p['from'] + $j;
                            @endphp
                            <details>
                                <summary>
                                    <span class="num">{{ sprintf('%02d', $stepIdx + 1) }}</span>
                                    {{ $s['title'] }}
                                    <span class="symbol" aria-hidden="true">+</span>
                                </summary>
                                <p>{{ $s['description'] }}</p>
                                <button class="directory-open" data-step="{{ $stepIdx }}" data-scroll="true">
                                    {{ $directory['button_label'] ?? 'View step details' }}
                                </button>
                            </details>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Production Machinery Facilities Section (Interactive Fleet Studio) -->
        @include('components.panel-fleet', [
            'facilities' => $facilities,
            'steps' => $steps,
            'phases' => $phases,
            'resolveImg' => $resolveImg,
        ])

        <!-- Quality Assurance Note -->
        <section class="quality-note" id="ats-quality">
            <h2>{!! $quality['title'] ?? "Quality Verified<br>at Every Milestone." !!}</h2>
            <p>{{ $quality['description'] ?? "Engineering drawing audits, dimensional tolerance checks, surface degreasing, coating thickness, and electrical continuity serve as mandatory inspection gates before proceeding to subsequent stages. Execution procedures, pretreatment chemistry, oven curing profiles, and testing scopes strictly adhere to project specifications and client-approved shop drawings." }}</p>
        </section>

        @if ($standalone)
            <footer class="site-foot">
                <span>PT Anugerah Tama Sejati · ATS Tekno</span>
                <span>Switchboard Panel Building Process</span>
                <a href="{{ route('home') }}">atstekno.com</a>
            </footer>
        @endif
    </div>

    <noscript>
        <div class="wrap">
            <p style="padding: 20px 0; color: #64748B;">
                Please enable JavaScript in your browser to experience the full interactive 33-step switchboard fabrication explorer.
            </p>
        </div>
    </noscript>
</div>
