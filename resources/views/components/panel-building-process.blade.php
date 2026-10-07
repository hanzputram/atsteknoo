@props(['standalone' => false])

@php
    $data = \App\Services\PanelProcessService::getData();
    $facilities = $data['facilities'] ?? [];
    $steps = $data['steps'] ?? [];
    $phases = $data['phases'] ?? [];
    $visibleStepsCount = count(array_filter($steps, fn($s) => empty($s['is_hidden'])));

    $allMachinesHide = !empty($facilities['hide_animation']) || (
        count($facilities['machines'] ?? []) > 0 && 
        !array_filter($facilities['machines'] ?? [], fn($m) => empty($m['hide_animation']))
    );

    $resolveImg = function($name) {
        if (!$name) return '';
        if (str_starts_with($name, 'http://') || str_starts_with($name, 'https://') || str_starts_with($name, '/')) {
            return $name;
        }
        $webpCandidate = preg_replace('/\.(jpe?g|png)$/i', '.webp', $name);
        if (file_exists(public_path('panel-building-process/images/' . $webpCandidate))) {
            return asset('panel-building-process/images/' . $webpCandidate);
        }
        return asset('panel-building-process/images/' . (str_contains($name, '.') ? $name : $name . '.webp'));
    };
@endphp

@once
    <link rel="stylesheet" href="{{ asset('panel-building-process/css/process.css') }}?v={{ @filemtime(public_path('panel-building-process/css/process.css')) }}">
    <link rel="stylesheet" href="{{ asset('panel-building-process/css/equipment.css') }}?v={{ @filemtime(public_path('panel-building-process/css/equipment.css')) }}">
    <link rel="stylesheet" href="{{ asset('panel-building-process/css/process-steps.css') }}?v={{ @filemtime(public_path('panel-building-process/css/process-steps.css')) }}">
    @if (!$allMachinesHide)
    <script src="{{ asset('panel-building-process/js/three.min.js') }}?v={{ @filemtime(public_path('panel-building-process/js/three.min.js')) }}" defer></script>
    <script src="{{ asset('panel-building-process/js/equipment-scene.js') }}?v={{ @filemtime(public_path('panel-building-process/js/equipment-scene.js')) }}" defer></script>
    @endif
    <script src="{{ asset('panel-building-process/js/equipment.js') }}?v={{ @filemtime(public_path('panel-building-process/js/equipment.js')) }}" defer></script>
@endonce

<div class="ats-process" id="ats-panel-process" data-asset-base="{{ asset('panel-building-process/images') }}">
    <div class="wrap">
        @if ($standalone)
            <header class="site-head">
                <a class="brand" href="{{ route('home') }}" aria-label="ATS Tekno Home">
                    <b>ATS</b> tekno<small>INDUSTRIAL ELECTRICAL SOLUTIONS</small>
                </a>
                <nav aria-label="Page navigation">
                    <a href="#equipment">Facilities</a>
                    <a href="#process-steps">{{ $visibleStepsCount }}-Step Process</a>
                    <a href="{{ route('services.panel') }}">Panel Builder Service</a>
                </nav>
                <span class="head-tag">MANUFACTURING / PRODUCTION FACILITIES</span>
            </header>
        @else
            <nav class="ats-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Home</span>
                </a>
                <span class="sep">&rsaquo;</span>
                <a href="{{ route('services.panel') }}">Panel Builder</a>
                <span class="sep">&rsaquo;</span>
                <span class="current">Production Facilities & {{ $visibleStepsCount }}-Stage Process</span>
            </nav>
        @endif

        <main>
            <!-- Production Machinery Facilities Section (Interactive Fleet Studio) -->
            @include('components.panel-fleet', [
                'facilities' => $facilities,
                'steps' => $steps,
                'phases' => $phases,
                'resolveImg' => $resolveImg,
            ])

            <!-- Complete 33-Stage Industrial Manufacturing Process Section with Photos -->
            @include('components.panel-process-steps', [
                'steps' => $steps,
                'phases' => $phases,
                'resolveImg' => $resolveImg,
            ])
        </main>

        @if ($standalone)
            <footer class="site-foot">
                <span>PT Anugerah Tama Sejati · ATS Tekno</span>
                <span>Switchboard Panel Production Facilities</span>
                <a href="{{ route('home') }}">atstekno.com</a>
            </footer>
        @endif
    </div>
</div>
