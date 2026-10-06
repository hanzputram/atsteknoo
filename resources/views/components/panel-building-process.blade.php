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
    <script>
        window.ATS_PROCESS_DATA = @json($data);
    </script>
    <script src="{{ asset('panel-building-process/js/process.js') }}" defer></script>
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
                    <a href="#ats-facilities">Facilities</a>
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

        <!-- Production Machinery Facilities Section (Interactive Machinery Fleet Studio) -->
        @php
            $machines = $facilities['machines'] ?? [];
            $initialMachine = $machines[0] ?? [
                'image' => 'machine-laser.jpg',
                'count' => '02',
                'unit' => 'UNITS OPERATIONAL',
                'title' => 'High-Precision CNC Fiber Laser Cutting',
                'desc' => 'High-speed sheet metal processing with dual shuttle tables. Delivers sub-millimeter edge tolerances for stainless steel, mild steel, and electro-galvanized panels without thermal distortion.',
                'tags' => ['Sub-millimeter Tolerance', 'Dual Shuttle Tables', 'Clean Edge Finishing', 'Up to 16mm Steel'],
                'powers_step' => 'Step 07: CNC Laser Cutting',
                'powers_step_index' => 6,
            ];
        @endphp
        <section class="facilities" id="ats-facilities" data-machines='@json($machines)'>
            <div class="facilities-header">
                <div>
                    <span class="eyebrow">{{ $facilities['eyebrow'] ?? 'Production Facilities' }}</span>
                    <h2>{{ $facilities['title'] ?? 'Machinery Engineered for Precision.' }}</h2>
                    <p>{{ $facilities['description'] ?? 'Sheet metal fabrication and enclosure assembly supported by high-precision CNC laser cutting, punching, and multi-axis hydraulic bending.' }}</p>
                </div>
                <div>
                    <button type="button" class="machine-tour-btn" id="ats-machine-tour-btn" aria-pressed="false" title="Auto-cycle through machinery fleet">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        <span>Auto Fleet Tour</span>
                    </button>
                </div>
            </div>

            <!-- Main Interactive Spotlight Stage -->
            <div class="machine-stage" id="ats-machine-stage">
                <div class="stage-photo-wrap">
                    <div class="stage-badge">
                        <span class="stage-dot"></span> LIVE FLEET SPEC
                    </div>
                    <img id="ats-stage-img" src="{{ asset('panel-building-process/images/' . ($initialMachine['image'] ?? 'machine-laser.jpg')) }}" alt="{{ $initialMachine['title'] ?? 'Machine' }}" loading="lazy">
                    <button type="button" class="stage-zoom-btn" id="ats-stage-zoom-btn" title="Inspect full-resolution photo">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect High-Res</span>
                    </button>
                </div>
                <div class="stage-content">
                    <div>
                        <div class="stage-topline">
                            <div class="stage-count">
                                <strong id="ats-stage-count">{{ $initialMachine['count'] ?? '02' }}</strong>
                                <small id="ats-stage-unit">{{ $initialMachine['unit'] ?? 'UNITS OPERATIONAL' }}</small>
                            </div>
                            <span class="stage-index-badge" id="ats-stage-idx">FLEET 01 / {{ sprintf('%02d', count($machines)) }}</span>
                        </div>
                        <h3 id="ats-stage-title">{{ $initialMachine['title'] ?? '' }}</h3>
                        <p id="ats-stage-desc">{!! nl2br(e($initialMachine['desc'] ?? '')) !!}</p>
                    </div>

                    <div>
                        <div class="stage-specs-box">
                            <div class="stage-specs-heading">KEY CAPABILITIES & SPECS</div>
                            <div class="stage-tags" id="ats-stage-tags">
                                @foreach($initialMachine['tags'] ?? [] as $t)
                                    <span class="stage-tag-chip">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                                        {{ $t }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="stage-workflow">
                            <div>
                                <span class="stage-workflow-label">INTEGRATED PROCESS STAGE</span>
                                <strong id="ats-stage-step-title">{{ $initialMachine['powers_step'] ?? 'Step 07: CNC Laser Cutting' }}</strong>
                            </div>
                            <button type="button" class="stage-workflow-jump" id="ats-stage-jump-btn" data-step-index="{{ $initialMachine['powers_step_index'] ?? 6 }}">
                                View in 33-Step Process →
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fleet Selector Grid -->
            <div class="machine-fleet-heading">SELECT MACHINERY TO INSPECT IN STUDIO</div>
            <div class="machine-fleet-grid">
                @foreach($machines as $mIdx => $m)
                    <div class="fleet-card {{ $mIdx === 0 ? 'active' : '' }}" data-machine-index="{{ $mIdx }}" role="button" tabindex="0" aria-label="Select {{ $m['title'] }}">
                        <div class="fleet-card-img">
                            <img src="{{ asset('panel-building-process/images/' . ($m['image'] ?? 'machine-laser.jpg')) }}" alt="{{ $m['title'] }}" loading="lazy">
                            <span class="fleet-card-badge">{{ $m['count'] }} {{ $m['unit'] }}</span>
                        </div>
                        <div class="fleet-card-body">
                            <h4>{{ $m['title'] }}</h4>
                            <span class="fleet-card-hint">
                                View specs
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Machinery Lightbox Inspection Modal -->
            <div class="machine-lightbox" id="ats-machine-lightbox" style="display: none;" aria-hidden="true" role="dialog" aria-modal="true">
                <div class="lightbox-backdrop" id="ats-lightbox-backdrop"></div>
                <div class="lightbox-modal">
                    <button type="button" class="lightbox-close" id="ats-lightbox-close" aria-label="Close photo inspection">&times;</button>
                    <img id="ats-lightbox-img" src="" alt="Machine High Resolution Photo">
                    <div class="lightbox-caption" id="ats-lightbox-caption"></div>
                </div>
            </div>
        </section>

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
