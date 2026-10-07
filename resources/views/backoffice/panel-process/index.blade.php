@extends('backoffice.layouts.app')

@section('title', 'Panel Building Process & Facilities Editor')
@section('breadcrumb', 'Panel Building Process')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
  <div>
    <div style="display: inline-flex; align-items: center; gap: 6px; background: #FFF1F2; border: 1px solid #FECDD3; color: #E11D48; padding: 3px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px;">
      <span style="width: 6px; height: 6px; border-radius: 50%; background: #E11D48; display: inline-block;"></span>
      Production Workflow CMS
    </div>
    <h1 class="page-title" style="font-size: 1.6rem; font-weight: 800; color: #0F172A; margin: 0 0 6px 0;">
      Panel Building Process &amp; Machinery Fleet Manager
    </h1>
    <p class="page-subtitle" style="font-size: 0.88rem; color: #64748B; margin: 0;">
      Kelola foto workshop, spesifikasi 8 mesin fasilitas, 33 tahap pengerjaan, 6 fase manufaktur, dan teks pengantar untuk <a href="{{ route('panel-building-process') }}" target="_blank" style="color: #E11D48; font-weight: 700; text-decoration: underline;">/panel-building-process</a>.
    </p>
  </div>
  <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
    <a href="{{ route('panel-building-process') }}" target="_blank" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 700;">
      <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      Lihat Halaman Publik
    </a>
    <form action="{{ route('backoffice.panel-process.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset seluruh data kembali ke setelan default bahasa Inggris (8 mesin & 33 tahap)? Perubahan kustom akan ditimpa.');" style="display: inline;">
      @csrf
      <button type="submit" class="btn btn-secondary btn-sm" style="color: #64748B; font-weight: 600;">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        Reset ke Default
      </button>
    </form>
    <button type="button" onclick="document.getElementById('panelProcessForm').submit();" class="btn btn-primary btn-sm" style="display: inline-flex; align-items: center; gap: 6px; background: #E11D48; border-color: #E11D48; color: #fff; font-weight: 700; padding: 8px 18px; border-radius: 8px; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
      Simpan Semua Perubahan
    </button>
  </div>
</div>

@if(session('success'))
<div style="background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534; padding: 14px 18px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
  <div style="display: flex; align-items: center; gap: 10px;">
    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
    <span>{{ session('success') }}</span>
  </div>
  <a href="{{ route('panel-building-process') }}" target="_blank" style="color: #15803D; font-size: 13px; font-weight: 700; text-decoration: underline;">Cek Halaman Live &rarr;</a>
</div>
@endif

<!-- Segmented Navigation Tabs -->
<div style="display: flex; gap: 8px; border-bottom: 2px solid #E2E8F0; margin-bottom: 24px; overflow-x: auto; padding-bottom: 2px;">
  <button type="button" class="tab-btn active" onclick="switchTab('tab-facilities')" id="btn-tab-facilities" style="padding: 10px 18px; font-weight: 700; font-size: 0.92rem; border: none; background: transparent; cursor: pointer; border-bottom: 3px solid #E11D48; color: #E11D48; white-space: nowrap; display: inline-flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
    <span>Fasilitas Mesin Workshop ({{ count($data['facilities']['machines'] ?? []) }})</span>
  </button>
  @php
    $allSteps = $data['steps'] ?? [];
    $activeStepsCount = count(array_filter($allSteps, fn($st) => empty($st['is_hidden'])));
    $hiddenStepsCount = count($allSteps) - $activeStepsCount;
  @endphp
  <button type="button" class="tab-btn" onclick="switchTab('tab-steps')" id="btn-tab-steps" style="padding: 10px 18px; font-weight: 600; font-size: 0.92rem; border: none; background: transparent; cursor: pointer; color: #64748B; white-space: nowrap; display: inline-flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
    <span>33 Tahap Pengerjaan (<span id="backoffice-tab-active-count">{{ $activeStepsCount }}</span>/{{ count($allSteps) }})</span>
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-phases')" id="btn-tab-phases" style="padding: 10px 18px; font-weight: 600; font-size: 0.92rem; border: none; background: transparent; cursor: pointer; color: #64748B; white-space: nowrap; display: inline-flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
    <span>6 Fase Manufaktur</span>
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-general')" id="btn-tab-general" style="padding: 10px 18px; font-weight: 600; font-size: 0.92rem; border: none; background: transparent; cursor: pointer; color: #64748B; white-space: nowrap; display: inline-flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
    <span>Hero &amp; Pengantar</span>
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-quality')" id="btn-tab-quality" style="padding: 10px 18px; font-weight: 600; font-size: 0.92rem; border: none; background: transparent; cursor: pointer; color: #64748B; white-space: nowrap; display: inline-flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
    <span>Jaminan Mutu (Quality)</span>
  </button>
</div>

<form id="panelProcessForm" action="{{ route('backoffice.panel-process.update') }}" method="POST">
  @csrf

  <!-- ================= TAB 1: PRODUCTION FACILITIES (8 MACHINES) ================= -->
  <div id="tab-facilities" class="tab-content">
    <div class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 22px; max-width: 100%; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
      <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
        <svg width="18" height="18" fill="none" stroke="#E11D48" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        Header Section Fasilitas Mesin (#equipment)
      </h3>
      <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 14px;">
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Eyebrow Badge</label>
          <input type="text" name="facilities[eyebrow]" value="{{ $data['facilities']['eyebrow'] ?? 'Production Facilities' }}" class="form-control" style="width: 100%; font-size: 13px;">
        </div>
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Heading Title</label>
          <input type="text" name="facilities[title]" value="{{ $data['facilities']['title'] ?? 'Machinery Engineered for Precision.' }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 700;">
        </div>
      </div>
      <div class="form-group" style="margin: 0;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Deskripsi Fasilitas</label>
        <textarea name="facilities[description]" rows="2" class="form-control" style="width: 100%; font-size: 13px;">{{ $data['facilities']['description'] ?? '' }}</textarea>
      </div>

      <!-- Global Hide 3D Animation Toggle -->
      <div style="margin-top: 16px; padding: 14px 18px; background: #F8FAFC; border: 1.5px solid #E2E8F0; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 12px;">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: #FFF1F2; color: #E11D48; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
          </div>
          <div>
            <div style="font-size: 13.5px; font-weight: 800; color: #0F172A;">Fitur Hide Animation (Sembunyikan Animasi 3D Semua Mesin)</div>
            <div style="font-size: 12px; color: #64748B;">Jika diaktifkan, animasi 3D simulasi akan disembunyikan dan foto workshop di bawahnya otomatis full-size menggantikan tempat animasi.</div>
          </div>
        </div>
        <label style="position: relative; display: inline-flex; align-items: center; cursor: pointer; user-select: none; background: #FFFFFF; border: 1.5px solid #CBD5E1; padding: 6px 14px; border-radius: 9999px;">
          <input type="checkbox" name="facilities[hide_animation]" value="1" {{ !empty($data['facilities']['hide_animation']) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #E11D48; cursor: pointer;">
          <span style="margin-left: 8px; font-size: 13px; font-weight: 800; color: #0F172A;">Hide All 3D</span>
        </label>
      </div>
    </div>

    <!-- 8 Machinery Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(460px, 1fr)); gap: 24px;">
      @foreach($data['facilities']['machines'] as $mIdx => $machine)
        @php
          $mImg = $machine['image'] ?? 'machine-laser.jpg';
          $mImgUrl = (str_starts_with($mImg, 'http') || str_starts_with($mImg, '/'))
              ? $mImg
              : asset('panel-building-process/images/' . (str_contains($mImg, '.') ? $mImg : $mImg . '.webp'));
          $modelKind = $machine['model'] ?? match(true) {
              str_contains(strtolower($machine['title']), 'laser') => 'laser',
              str_contains(strtolower($machine['title']), 'press') || str_contains(strtolower($machine['title']), 'bend') => 'bend',
              str_contains(strtolower($machine['title']), 'punch') => 'punch',
              str_contains(strtolower($machine['title']), 'shear') => 'shear',
              str_contains(strtolower($machine['title']), 'pickle') || str_contains(strtolower($machine['title']), 'hcl') => 'pickling',
              str_contains(strtolower($machine['title']), 'lime') || str_contains(strtolower($machine['title']), 'phosphate') => 'phosphate',
              str_contains(strtolower($machine['title']), 'powder') || str_contains(strtolower($machine['title']), 'cure') => 'powder',
              str_contains(strtolower($machine['title']), 'wiring') || str_contains(strtolower($machine['title']), 'switchgear') => 'wiring',
              default => 'cabinet'
          };
        @endphp
        <div class="panel-card" style="background: #FFFFFF; border: 1.5px solid #E2E8F0; border-radius: 16px; padding: 22px; box-shadow: 0 2px 8px rgba(15,23,42,0.04); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s;">
          <div>
            <!-- Header bar of machine card -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; gap: 10px;">
              <div style="display: flex; align-items: center; gap: 8px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 8px; background: #0F172A; color: #FFF; font-weight: 800; font-size: 13px;">
                  {{ sprintf('%02d', $mIdx + 1) }}
                </span>
                <span style="font-size: 11px; font-weight: 800; color: #E11D48; letter-spacing: 0.05em; background: #FFF1F2; padding: 3px 8px; border-radius: 6px;">
                  FLEET {{ sprintf('%02d', $mIdx + 1) }} / {{ sprintf('%02d', count($data['facilities']['machines'])) }}
                </span>
              </div>
              <span style="font-size: 11px; font-weight: 700; color: #475569; background: #F1F5F9; border: 1px solid #CBD5E1; padding: 3px 8px; border-radius: 6px; text-transform: uppercase;">
                3D: {{ strtoupper($modelKind) }}
              </span>
              <input type="hidden" name="facilities[machines][{{ $mIdx }}][model]" value="{{ $modelKind }}">
            </div>

            <!-- Per-Machine Hide Animation Toggle -->
            <div style="margin-bottom: 12px; padding: 8px 12px; background: #F1F5F9; border: 1px solid #E2E8F0; border-radius: 8px; display: flex; align-items: center; justify-content: space-between;">
              <span style="font-size: 11.5px; font-weight: 700; color: #334155; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Hide Animasi & Foto Full-Size:
              </span>
              <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer; font-size: 11.5px; font-weight: 800; color: #0F172A;">
                <input type="checkbox" name="facilities[machines][{{ $mIdx }}][hide_animation]" value="1" {{ (!empty($machine['hide_animation'])) ? 'checked' : '' }} style="accent-color: #E11D48; cursor: pointer;">
                <span>Hide 3D</span>
              </label>
            </div>

            <!-- Machine Photo Preview & Actions -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 12px; margin-bottom: 16px;">
              <div style="position: relative; height: 190px; border-radius: 10px; overflow: hidden; background: #0B1120; border: 1px solid #CBD5E1; margin-bottom: 10px;">
                <img id="preview-machine-{{ $mIdx }}" 
                     src="{{ $mImgUrl }}" 
                     alt="{{ $machine['title'] }}" 
                     style="width: 100%; height: 100%; object-fit: cover; display: block;">
                <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(15, 23, 42, 0.85); color: #FFF; font-size: 10.5px; font-weight: 700; padding: 4px 10px; border-radius: 6px; backdrop-filter: blur(4px);">
                  <span id="label-machine-file-{{ $mIdx }}">{{ $machine['image'] ?? 'Default' }}</span>
                </div>
              </div>

              <!-- Action buttons for Photo -->
              <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <input type="file" id="file-machine-{{ $mIdx }}" accept="image/*" style="display: none;" onchange="uploadPhotoAjax('file-machine-{{ $mIdx }}', 'machine', {{ $mIdx }}, 'preview-machine-{{ $mIdx }}', 'input-machine-img-{{ $mIdx }}', 'upload-status-machine-{{ $mIdx }}', 'label-machine-file-{{ $mIdx }}')">
                <button type="button" onclick="document.getElementById('file-machine-{{ $mIdx }}').click()" class="btn btn-sm" style="background: #0F172A; color: #FFF; font-size: 11.5px; font-weight: 700; padding: 6px 12px; border-radius: 7px; display: inline-flex; align-items: center; gap: 5px; cursor: pointer;">
                  <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                  Upload Foto Baru
                </button>
                <button type="button" onclick="openPhotoPicker('machine', {{ $mIdx }}, 'preview-machine-{{ $mIdx }}', 'input-machine-img-{{ $mIdx }}', 'label-machine-file-{{ $mIdx }}')" class="btn btn-sm btn-secondary" style="font-size: 11.5px; font-weight: 700; padding: 6px 12px; border-radius: 7px; display: inline-flex; align-items: center; gap: 5px; cursor: pointer;">
                  <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  Pilih dari Galeri
                </button>
                <input type="text" id="input-machine-img-{{ $mIdx }}" name="facilities[machines][{{ $mIdx }}][image]" value="{{ $machine['image'] ?? '' }}" class="form-control" style="font-size: 11px; flex: 1; min-width: 120px; padding: 5px 8px; font-family: monospace;" placeholder="filename.jpg">
              </div>
              <div id="upload-status-machine-{{ $mIdx }}" style="font-size: 11.5px; font-weight: 600; margin-top: 6px; display: none;"></div>
            </div>

            <!-- Numbers & Machine Title -->
            <div style="display: flex; gap: 10px; margin-bottom: 12px;">
              <div style="width: 75px;">
                <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Jumlah</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][count]" value="{{ $machine['count'] }}" class="form-control" style="width: 100%; font-size: 15px; font-weight: 800; text-align: center;" required>
              </div>
              <div style="width: 110px;">
                <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Satuan</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][unit]" value="{{ $machine['unit'] }}" class="form-control" style="width: 100%; font-size: 12px; font-weight: 600;" required>
              </div>
              <div style="flex: 1;">
                <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Nama Mesin / Stasiun</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][title]" value="{{ $machine['title'] }}" class="form-control" style="width: 100%; font-size: 13.5px; font-weight: 700;" required>
              </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 12px;">
              <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Deskripsi Kapabilitas</label>
              <textarea name="facilities[machines][{{ $mIdx }}][desc]" rows="2" class="form-control" style="width: 100%; font-size: 12.5px; line-height: 1.5;" required>{{ $machine['desc'] }}</textarea>
            </div>

            <!-- Tags -->
            <div style="margin-bottom: 12px;">
              <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Key Capabilities &amp; Parameter (Pisahkan dengan koma)</label>
              <input type="text" name="facilities[machines][{{ $mIdx }}][tags]" value="{{ is_array($machine['tags'] ?? null) ? implode(', ', $machine['tags']) : ($machine['tags'] ?? '') }}" class="form-control" style="width: 100%; font-size: 12px;" placeholder="e.g. 1,500 W Resonator, ±0.05 mm Tolerance">
            </div>

            <!-- Connected Workflow Step -->
            <div style="background: #F1F5F9; border-radius: 8px; padding: 10px 12px; display: flex; gap: 10px; align-items: center;">
              <div style="flex: 1;">
                <label style="font-size: 10.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 2px;">Terhubung dengan Tahap Proses:</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][powers_step]" value="{{ $machine['powers_step'] ?? '' }}" class="form-control" placeholder="e.g. Step 07: CNC Laser Cutting" style="font-size: 11.5px; font-weight: 600;">
              </div>
              <div style="width: 80px;">
                <label style="font-size: 10.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 2px;">Step Index</label>
                <input type="number" name="facilities[machines][{{ $mIdx }}][powers_step_index]" value="{{ $machine['powers_step_index'] ?? 0 }}" min="0" max="32" class="form-control" style="font-size: 12px; text-align: center;">
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ================= TAB 2: 33 PRODUCTION STEPS ================= -->
  <div id="tab-steps" class="tab-content" style="display: none;">
    <!-- Step Jump Bar & Filter -->
    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 18px 20px; border-radius: 14px; margin-bottom: 24px;">
      <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 14px;">
        <div>
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 3px;">
            <strong style="color: #0F172A; font-size: 0.98rem;">Navigasi &amp; Filter Tahap Pengerjaan:</strong>
            <span style="font-size: 11px; font-weight: 800; background: #E0E7FF; color: #3730A3; padding: 2px 8px; border-radius: 6px;">Fitur Hide Step Aktif</span>
          </div>
          <span style="color: #64748B; font-size: 0.85rem;">Klik nomor untuk lompat ke tahap. Centang <b>"Sembunyikan Step"</b> pada tahap yang kurang penting agar tidak tampil di halaman publik. Nomor tahap publik otomatis diatur ulang tanpa celah.</span>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
          <div style="display: inline-flex; border: 1.5px solid #CBD5E1; border-radius: 8px; overflow: hidden; background: #FFF;">
            <button type="button" class="btn-vis-filter" data-vis="all" onclick="filterStepsVisibility('all')" style="padding: 6px 12px; font-size: 11.5px; font-weight: 700; border: none; background: #0F172A; color: #FFF; cursor: pointer;">
              Semua ({{ count($allSteps) }})
            </button>
            <button type="button" class="btn-vis-filter" data-vis="active" onclick="filterStepsVisibility('active')" style="padding: 6px 12px; font-size: 11.5px; font-weight: 700; border: none; background: #FFF; color: #334155; border-left: 1px solid #CBD5E1; cursor: pointer;">
              Aktif (<span id="count-filter-active">{{ $activeStepsCount }}</span>)
            </button>
            <button type="button" class="btn-vis-filter" data-vis="hidden" onclick="filterStepsVisibility('hidden')" style="padding: 6px 12px; font-size: 11.5px; font-weight: 700; border: none; background: #FFF; color: #E11D48; border-left: 1px solid #CBD5E1; cursor: pointer;">
              Disembunyikan (<span id="count-filter-hidden">{{ $hiddenStepsCount }}</span>)
            </button>
          </div>
          <input type="text" id="backoffice-step-search" placeholder="Cari nama tahap (cth: laser, hcl, wiring)..." oninput="applyBackofficeFilters()" class="form-control" style="font-size: 12px; width: 230px; padding: 6px 12px; border-radius: 8px;">
        </div>
      </div>
      <div style="display: flex; gap: 5px; flex-wrap: wrap;">
        @foreach($data['steps'] as $idx => $s)
          @php $isStepHidden = !empty($s['is_hidden']); @endphp
          <a href="#step-card-{{ $idx }}" 
             id="step-jump-pill-{{ $idx }}" 
             data-hidden="{{ $isStepHidden ? '1' : '0' }}"
             title="Tahap {{ sprintf('%02d', $idx + 1) }}{{ $isStepHidden ? ' (Disembunyikan)' : '' }}"
             style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: {{ $isStepHidden ? '#FFF1F2' : '#FFF' }}; border: 1.5px solid {{ $isStepHidden ? '#FECDD3' : '#CBD5E1' }}; color: {{ $isStepHidden ? '#E11D48' : '#1E293B' }}; font-size: 11.5px; font-weight: 800; text-decoration: none; transition: all 0.15s;" 
             onmouseover="this.style.borderColor='#E11D48'; this.style.color='#E11D48';" 
             onmouseout="this.style.borderColor=this.getAttribute('data-hidden') === '1' ? '#FECDD3' : '#CBD5E1'; this.style.color=this.getAttribute('data-hidden') === '1' ? '#E11D48' : '#1E293B';">
            {{ sprintf('%02d', $idx + 1) }}
          </a>
        @endforeach
      </div>
    </div>

    <!-- 33 Steps Cards -->
    <div style="display: flex; flex-direction: column; gap: 24px;" id="backoffice-steps-container">
      @foreach($data['steps'] as $idx => $step)
        @php
          $phaseIndex = 0;
          foreach($data['phases'] as $pIdx => $p) {
            if ($idx >= $p['from'] && $idx <= $p['to']) {
              $phaseIndex = $pIdx;
              break;
            }
          }
          $phaseName = $data['phases'][$phaseIndex]['title'] ?? 'Phase ' . ($phaseIndex + 1);
          $sImg = $step['image'] ?? '';
          $defaultStepImg = match($idx + 1) {
              1, 2, 3, 4 => 'engineering.webp',
              5 => 'factory.webp',
              6 => 'machine-shearing.webp',
              7 => 'machine-laser.jpg',
              8 => 'machine-bending.jpg',
              9 => 'machine-punching.jpg',
              10 => 'bending.webp',
              11 => 'welding.webp',
              12 => 'fabrication.webp',
              13, 14, 15, 16, 17, 18, 19 => 'surface.webp',
              20, 22 => 'coating.webp',
              21 => 'curing.webp',
              23, 24 => 'assembly.webp',
              25 => 'bending.webp',
              26, 27 => 'assembly.webp',
              28, 29, 30 => 'quality.webp',
              31 => 'engineering.webp',
              32, 33 => 'factory.webp',
              default => 'engineering.webp',
          };
          $effectiveImg = (!empty($sImg) && !in_array($sImg, ['engineering', 'fabrication', 'surface', 'coating', 'assembly', 'quality']))
              ? $sImg
              : $defaultStepImg;
          $sImgUrl = (str_starts_with($effectiveImg, 'http') || str_starts_with($effectiveImg, '/'))
              ? $effectiveImg
              : asset('panel-building-process/images/' . (str_contains($effectiveImg, '.') ? $effectiveImg : $effectiveImg . '.webp'));
          $isThisStepHidden = !empty($step['is_hidden']);
        @endphp

        <div id="step-card-{{ $idx }}" 
             class="panel-card backoffice-step-card" 
             data-step-hidden="{{ $isThisStepHidden ? '1' : '0' }}"
             data-step-text="{{ strtolower($step['title'] . ' ' . $step['subtitle'] . ' ' . $step['description']) }}" 
             style="background: #FFFFFF; border: 1.5px solid {{ $isThisStepHidden ? '#FECDD3' : '#E2E8F0' }}; border-radius: 16px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,0.03); transition: border-color 0.2s;">
          <!-- Step Header Bar -->
          <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F1F5F9; padding-bottom: 14px; margin-bottom: 18px; flex-wrap: wrap; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <span id="step-num-badge-{{ $idx }}" style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: {{ $isThisStepHidden ? '#E11D48' : '#0F172A' }}; color: #FFF; font-weight: 800; font-size: 15px; transition: background 0.2s;">
                {{ sprintf('%02d', $idx + 1) }}
              </span>
              <div>
                <div style="display: flex; align-items: center; gap: 6px;">
                  <span style="font-size: 11px; font-weight: 800; color: #E11D48; text-transform: uppercase; letter-spacing: 0.06em;">
                    FASE {{ sprintf('%02d', $phaseIndex + 1) }}: {{ strtoupper($phaseName) }}
                  </span>
                  <span id="status-pill-{{ $idx }}" style="font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 5px; {{ $isThisStepHidden ? 'background: #FFF1F2; color: #E11D48; border: 1px solid #FECDD3;' : 'background: #F0FDF4; color: #166534; border: 1px solid #BBF7D0;' }}">
                    {{ $isThisStepHidden ? 'DISEMBUNYIKAN' : 'TAMPIL DI WEB' }}
                  </span>
                </div>
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 2px 0 0 0;">
                  Step {{ sprintf('%02d', $idx + 1) }}: {{ $step['title'] }}
                </h3>
              </div>
            </div>

            <!-- Hide Step Toggle Control -->
            <div style="display: flex; align-items: center; gap: 10px;">
              <label id="toggle-label-{{ $idx }}" style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; user-select: none; background: {{ $isThisStepHidden ? '#FFF1F2' : '#F8FAFC' }}; border: 1.5px solid {{ $isThisStepHidden ? '#E11D48' : '#CBD5E1' }}; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 800; color: {{ $isThisStepHidden ? '#E11D48' : '#334155' }}; transition: all 0.2s;">
                <input type="checkbox" 
                       name="steps[{{ $idx }}][is_hidden]" 
                       value="1" 
                       id="step-hidden-check-{{ $idx }}"
                       {{ $isThisStepHidden ? 'checked' : '' }} 
                       onchange="onStepHiddenToggle({{ $idx }}, this.checked)" 
                       style="width: 17px; height: 17px; accent-color: #E11D48; cursor: pointer;">
                <span id="toggle-text-{{ $idx }}">{{ $isThisStepHidden ? 'Tahap Disembunyikan (Hidden)' : 'Sembunyikan Tahap Ini' }}</span>
              </label>

              <span style="font-size: 11.5px; color: #64748B; background: #F1F5F9; border: 1px solid #E2E8F0; padding: 5px 9px; border-radius: 6px; font-weight: 700; font-family: monospace;">
                INDEX #{{ $idx }}
              </span>
            </div>
          </div>

          <!-- Hidden Notice Banner -->
          <div id="hidden-alert-{{ $idx }}" style="display: {{ $isThisStepHidden ? 'block' : 'none' }}; background: #FFF1F2; border: 1px dashed #FDA4AF; color: #9F1239; padding: 10px 16px; border-radius: 10px; margin-bottom: 18px; font-size: 12.5px; font-weight: 600;">
            ⚠️ <strong>Tahap ini sedang disembunyikan.</strong> Tidak akan dimunculkan pada tampilan publik website <code>/panel-building-process</code>. Nomor urut tahap pada website publik otomatis disesuaikan berurutan tanpa jeda.
          </div>

          <div style="display: grid; grid-template-columns: 1fr 310px; gap: 24px;">
            <!-- Left Side: Text Fields -->
            <div style="display: flex; flex-direction: column; gap: 14px;">
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Judul Teknis (Original English Name)
                  </label>
                  <input type="text" name="steps[{{ $idx }}][title]" value="{{ $step['title'] }}" class="form-control" style="width: 100%; font-size: 13.5px; font-weight: 700;" required>
                </div>
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Sub-Judul Tampilan (Customer Heading)
                  </label>
                  <input type="text" name="steps[{{ $idx }}][subtitle]" value="{{ $step['subtitle'] }}" class="form-control" style="width: 100%; font-size: 13px;" required>
                </div>
              </div>

              <div class="form-group" style="margin: 0;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                  Deskripsi Lengkap Proses
                </label>
                <textarea name="steps[{{ $idx }}][description]" rows="3" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.55;" required>{{ $step['description'] }}</textarea>
              </div>

              <div class="form-group" style="margin: 0;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 3px;">
                  Aktivitas Pengerjaan (Key Work Activities — 1 baris per poin)
                </label>
                <span style="display: block; font-size: 11px; color: #64748B; margin-bottom: 6px;">Setiap baris baru otomatis menjadi 1 tanda centang pada kartu di website.</span>
                <textarea name="steps[{{ $idx }}][activities]" rows="3" class="form-control" style="width: 100%; font-size: 12.5px; line-height: 1.5; font-family: inherit;">{{ is_array($step['activities']) ? implode("\n", $step['activities']) : $step['activities'] }}</textarea>
              </div>

              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Pos Inspeksi Mutu (Quality Checkpoint)
                  </label>
                  <textarea name="steps[{{ $idx }}][checkpoint]" rows="2" class="form-control" style="width: 100%; font-size: 12.5px; line-height: 1.45;">{{ $step['checkpoint'] }}</textarea>
                </div>
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Output Terverifikasi (Verified Output)
                  </label>
                  <textarea name="steps[{{ $idx }}][output]" rows="2" class="form-control" style="width: 100%; font-size: 12.5px; line-height: 1.45;">{{ $step['output'] }}</textarea>
                </div>
              </div>
            </div>

            <!-- Right Side: Photo Card & Upload -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; display: flex; flex-direction: column; justify-content: space-between;">
              <div>
                <span style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 8px;">
                  Foto Dokumentasi Tahap {{ sprintf('%02d', $idx + 1) }}
                </span>
                <div style="width: 100%; height: 180px; border-radius: 8px; overflow: hidden; background: #0B1120; position: relative; border: 1px solid #CBD5E1; margin-bottom: 10px;">
                  <img id="preview-step-{{ $idx }}" src="{{ $sImgUrl }}" alt="Step {{ $idx + 1 }} Photo" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                  <div style="position: absolute; bottom: 6px; left: 6px; background: rgba(15, 23, 42, 0.85); color: #FFF; font-size: 10px; font-weight: 700; padding: 3px 8px; border-radius: 4px; backdrop-filter: blur(4px);">
                    <span id="label-step-file-{{ $idx }}">{{ $effectiveImg }}</span>
                  </div>
                </div>

                <div style="display: flex; gap: 6px; margin-bottom: 8px;">
                  <input type="file" id="file-step-{{ $idx }}" accept="image/*" style="display: none;" onchange="uploadPhotoAjax('file-step-{{ $idx }}', 'step', {{ $idx }}, 'preview-step-{{ $idx }}', 'input-step-img-{{ $idx }}', 'upload-status-step-{{ $idx }}', 'label-step-file-{{ $idx }}')">
                  <button type="button" onclick="document.getElementById('file-step-{{ $idx }}').click()" class="btn btn-sm" style="flex: 1; background: #0F172A; color: #FFF; font-size: 11px; font-weight: 700; padding: 6px 8px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    Upload Baru
                  </button>
                  <button type="button" onclick="openPhotoPicker('step', {{ $idx }}, 'preview-step-{{ $idx }}', 'input-step-img-{{ $idx }}', 'label-step-file-{{ $idx }}')" class="btn btn-sm btn-secondary" style="flex: 1; font-size: 11px; font-weight: 700; padding: 6px 8px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Pilih Galeri
                  </button>
                </div>

                <input type="text" id="input-step-img-{{ $idx }}" name="steps[{{ $idx }}][image]" value="{{ $step['image'] ?? '' }}" class="form-control" style="width: 100%; font-size: 11px; font-family: monospace; padding: 5px 8px;" placeholder="custom-filename.jpg">
              </div>
              <div id="upload-status-step-{{ $idx }}" style="font-size: 11px; font-weight: 600; margin-top: 6px; display: none;"></div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ================= TAB 3: 6 MANUFACTURING PHASES ================= -->
  <div id="tab-phases" class="tab-content" style="display: none;">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(460px, 1fr)); gap: 24px;">
      @foreach($data['phases'] as $pIdx => $phase)
        @php
          $pImgFile = $phase['image'] ?? 'engineering';
          $pImgUrl = (str_starts_with($pImgFile, 'http') || str_starts_with($pImgFile, '/'))
              ? $pImgFile
              : asset('panel-building-process/images/' . (str_contains($pImgFile, '.') ? $pImgFile : $pImgFile . '.webp'));
        @endphp
        <div class="panel-card" style="background: #FFFFFF; border: 1.5px solid #E2E8F0; border-radius: 16px; padding: 22px; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
          <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F1F5F9; padding-bottom: 12px; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #0F172A; color: #FFF; font-weight: 800; font-size: 13px;">
                {{ sprintf('%02d', $pIdx + 1) }}
              </span>
              <h3 style="font-size: 1.1rem; font-weight: 800; color: #0F172A; margin: 0;">
                Fase {{ sprintf('%02d', $pIdx + 1) }}: {{ $phase['title'] }}
              </h3>
            </div>
            <span style="font-size: 11.5px; font-weight: 700; color: #E11D48; background: #FFF1F2; padding: 3px 8px; border-radius: 6px;">
              Steps {{ sprintf('%02d', ($phase['from'] ?? 0) + 1) }} — {{ sprintf('%02d', ($phase['to'] ?? 0) + 1) }}
            </span>
          </div>

          <div style="display: grid; grid-template-columns: 140px 1fr; gap: 16px; margin-bottom: 14px;">
            <div>
              <div style="width: 100%; height: 110px; border-radius: 8px; overflow: hidden; background: #0B1120; border: 1px solid #CBD5E1; margin-bottom: 6px;">
                <img id="preview-phase-{{ $pIdx }}" src="{{ $pImgUrl }}" alt="{{ $phase['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <input type="file" id="file-phase-{{ $pIdx }}" accept="image/*" style="display: none;" onchange="uploadPhotoAjax('file-phase-{{ $pIdx }}', 'phase', {{ $pIdx }}, 'preview-phase-{{ $pIdx }}', 'input-phase-img-{{ $pIdx }}', 'upload-status-phase-{{ $pIdx }}', 'label-phase-file-{{ $pIdx }}')">
              <button type="button" onclick="document.getElementById('file-phase-{{ $pIdx }}').click()" class="btn btn-sm btn-secondary" style="width: 100%; font-size: 10.5px; font-weight: 700; padding: 4px; border-radius: 6px;">
                Ganti Foto
              </button>
              <input type="hidden" id="input-phase-img-{{ $pIdx }}" name="phases[{{ $pIdx }}][image]" value="{{ $phase['image'] ?? '' }}">
              <span id="upload-status-phase-{{ $pIdx }}" style="font-size: 10.5px; display: none;"></span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 10px;">
              <div>
                <label style="display: block; font-size: 11.5px; font-weight: 700; color: #334155; margin-bottom: 3px;">Nama Fase</label>
                <input type="text" name="phases[{{ $pIdx }}][title]" value="{{ $phase['title'] }}" class="form-control" style="font-size: 13px; font-weight: 700;" required>
              </div>
              <div>
                <label style="display: block; font-size: 11.5px; font-weight: 700; color: #334155; margin-bottom: 3px;">Caption / Sub-title</label>
                <input type="text" name="phases[{{ $pIdx }}][caption]" value="{{ $phase['caption'] ?? '' }}" class="form-control" style="font-size: 12px;">
              </div>
            </div>
          </div>

          <div>
            <label style="display: block; font-size: 11.5px; font-weight: 700; color: #334155; margin-bottom: 3px;">Deskripsi Ringkas Fase</label>
            <textarea name="phases[{{ $pIdx }}][desc]" rows="2" class="form-control" style="font-size: 12px; line-height: 1.5;">{{ $phase['desc'] ?? '' }}</textarea>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ================= TAB 4: HERO & INTRO ================= -->
  <div id="tab-general" class="tab-content" style="display: none;">
    <div class="panel-card" style="background: #FFFFFF; border: 1.5px solid #E2E8F0; border-radius: 16px; padding: 24px; max-width: 900px; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
      <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 18px 0;">Hero Introduction Header</h3>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Top Eyebrow Text</label>
          <input type="text" name="intro[eyebrow]" value="{{ $data['intro']['eyebrow'] ?? 'Behind Every Switchboard' }}" class="form-control" style="width: 100%; font-size: 13px;" required>
        </div>
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Main Title First Line</label>
          <input type="text" name="intro[title]" value="{{ $data['intro']['title'] ?? 'Precision.' }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 700;" required>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Highlighted Italic Sub-Headline (Red Accent)</label>
          <input type="text" name="intro[title_em]" value="{{ $data['intro']['title_em'] ?? 'In every process.' }}" class="form-control" style="width: 100%; font-size: 13px; color: #E11D48; font-weight: 700;" required>
        </div>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Intro Paragraph</label>
        <textarea name="intro[description]" rows="3" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.6;" required>{{ $data['intro']['description'] ?? '' }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; background: #F8FAFC; padding: 16px; border-radius: 12px; border: 1px solid #E2E8F0; margin-bottom: 24px;">
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 1 Angka</label>
          <input type="text" name="intro[stat_steps_num]" value="{{ $data['intro']['stat_steps_num'] ?? '33' }}" class="form-control" style="width: 100%; font-weight: 800; font-size: 16px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 1 Label (HTML)</label>
          <input type="text" name="intro[stat_steps_label]" value="{{ $data['intro']['stat_steps_label'] ?? 'Production<br>Steps' }}" class="form-control" style="width: 100%; font-size: 12px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 2 Angka</label>
          <input type="text" name="intro[stat_phases_num]" value="{{ $data['intro']['stat_phases_num'] ?? '06' }}" class="form-control" style="width: 100%; font-weight: 800; font-size: 16px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 2 Label (HTML)</label>
          <input type="text" name="intro[stat_phases_label]" value="{{ $data['intro']['stat_phases_label'] ?? 'Integrated<br>Phases' }}" class="form-control" style="width: 100%; font-size: 12px;">
        </div>
      </div>
    </div>
  </div>

  <!-- ================= TAB 5: QUALITY ASSURANCE ================= -->
  <div id="tab-quality" class="tab-content" style="display: none;">
    <div class="panel-card" style="background: #FFFFFF; border: 1.5px solid #E2E8F0; border-radius: 16px; padding: 24px; max-width: 850px; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
      <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 16px 0;">Quality Assurance Policy</h3>
      <div class="form-group" style="margin-bottom: 16px;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Quality Heading (HTML)</label>
        <input type="text" name="quality[title]" value="{{ $data['quality']['title'] ?? 'Quality Verified<br>at Every Milestone.' }}" class="form-control" style="width: 100%; font-size: 13.5px; font-weight: 700;">
      </div>
      <div class="form-group" style="margin: 0;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Quality Narrative / Audit Policy</label>
        <textarea name="quality[description]" rows="5" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.6;">{{ $data['quality']['description'] ?? '' }}</textarea>
      </div>
    </div>
  </div>

  <!-- Floating Sticky Save Bar -->
  <div style="position: sticky; bottom: 16px; z-index: 40; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); padding: 14px 24px; border-radius: 14px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 10px 30px rgba(0,0,0,0.35); margin-top: 36px; border: 1px solid rgba(255,255,255,0.12);">
    <div style="display: flex; align-items: center; gap: 10px;">
      <span style="width: 8px; height: 8px; border-radius: 50%; background: #10B981; display: inline-block;"></span>
      <span style="color: #F8FAFC; font-size: 13px; font-weight: 600;">
        Perubahan foto dan spesifikasi tersinkronisasi langsung ke website publik.
      </span>
    </div>
    <button type="submit" class="btn btn-primary" style="background: #E11D48; border-color: #E11D48; color: #FFF; font-weight: 800; padding: 10px 26px; border-radius: 8px; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4);">
      <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
      Simpan Semua Perubahan
    </button>
  </div>
</form>

<!-- ===== MODAL GALERI FOTO WORKSHOP ===== -->
<div id="photoPickerModal" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 20px;">
  <div style="background: #FFFFFF; border-radius: 18px; width: 100%; max-width: 860px; max-height: 85vh; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.4); border: 1px solid #E2E8F0;">
    <!-- Modal Header -->
    <div style="padding: 18px 22px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between; background: #F8FAFC;">
      <div>
        <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0F172A;">Pilih Foto dari Galeri Workshop ATS</h3>
        <p style="margin: 2px 0 0 0; font-size: 12px; color: #64748B;">Klik foto yang diinginkan untuk langsung menerapkannya pada kartu.</p>
      </div>
      <button type="button" onclick="closePhotoPicker()" style="width: 32px; height: 32px; border-radius: 8px; border: 1px solid #CBD5E1; background: #FFF; color: #0F172A; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>
    </div>

    <!-- Modal Filter Bar -->
    <div style="padding: 12px 22px; border-bottom: 1px solid #F1F5F9; display: flex; align-items: center; gap: 10px;">
      <svg width="15" height="15" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" id="modalPhotoSearch" placeholder="Cari nama file foto (cth: laser, bending, assembly)..." oninput="filterModalPhotos(this.value)" class="form-control" style="font-size: 12px; border: none; padding: 4px; box-shadow: none;">
    </div>

    <!-- Modal Body: Photo Grid -->
    <div style="padding: 20px 22px; overflow-y: auto; flex: 1; display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 14px;" id="modalPhotoGrid">
      @if(!empty($availablePhotos))
        @foreach($availablePhotos as $p)
          <div class="modal-photo-item" data-photo-name="{{ strtolower($p['filename']) }}" onclick="selectPhotoFromModal('{{ $p['filename'] }}', '{{ $p['url'] }}')" style="border: 2px solid #E2E8F0; border-radius: 10px; overflow: hidden; cursor: pointer; transition: all 0.15s; background: #0B1120;" onmouseover="this.style.borderColor='#E11D48'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.transform='none';">
            <div style="height: 110px; overflow: hidden;">
              <img src="{{ $p['url'] }}" alt="{{ $p['filename'] }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 6px 8px; background: #FFF; border-top: 1px solid #E2E8F0;">
              <span style="display: block; font-size: 11px; font-weight: 700; color: #0F172A; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $p['filename'] }}">
                {{ $p['filename'] }}
              </span>
            </div>
          </div>
        @endforeach
      @else
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748B;">
          Belum ada foto tambahan di direktori workshop. Anda dapat mengupload foto baru menggunakan tombol Upload.
        </div>
      @endif
    </div>
  </div>
</div>

<script>
  let activePickerTarget = {
    type: null,
    index: null,
    previewId: null,
    inputId: null,
    labelId: null
  };

  function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(b => {
      b.style.borderBottom = 'none';
      b.style.color = '#64748B';
      b.style.fontWeight = '600';
    });
    const target = document.getElementById(tabId);
    if (target) target.style.display = 'block';
    const activeBtn = document.getElementById('btn-' + tabId);
    if (activeBtn) {
      activeBtn.style.borderBottom = '3px solid #E11D48';
      activeBtn.style.color = '#E11D48';
      activeBtn.style.fontWeight = '700';
    }
  }

  let currentVisibilityFilter = 'all';

  function filterStepsVisibility(mode) {
    currentVisibilityFilter = mode;
    document.querySelectorAll('.btn-vis-filter').forEach(btn => {
      const isCur = btn.getAttribute('data-vis') === mode;
      btn.style.background = isCur ? '#0F172A' : '#FFFFFF';
      btn.style.color = isCur ? '#FFFFFF' : (btn.getAttribute('data-vis') === 'hidden' ? '#E11D48' : '#334155');
      btn.style.borderColor = isCur ? '#0F172A' : '#CBD5E1';
    });
    applyBackofficeFilters();
  }

  function applyBackofficeFilters() {
    const searchInput = document.getElementById('backoffice-step-search');
    const q = (searchInput?.value || '').trim().toLowerCase();
    const cards = document.querySelectorAll('.backoffice-step-card');

    cards.forEach(card => {
      const isHidden = card.getAttribute('data-step-hidden') === '1';
      let matchVis = true;
      if (currentVisibilityFilter === 'active') matchVis = !isHidden;
      if (currentVisibilityFilter === 'hidden') matchVis = isHidden;

      const text = card.getAttribute('data-step-text') || '';
      const matchSearch = !q || text.includes(q);

      card.style.display = (matchVis && matchSearch) ? 'block' : 'none';
    });
  }

  function filterBackofficeSteps(query) {
    applyBackofficeFilters();
  }

  function onStepHiddenToggle(idx, isChecked) {
    const card = document.getElementById('step-card-' + idx);
    const pill = document.getElementById('step-jump-pill-' + idx);
    const numBadge = document.getElementById('step-num-badge-' + idx);
    const statusPill = document.getElementById('status-pill-' + idx);
    const toggleLabel = document.getElementById('toggle-label-' + idx);
    const toggleText = document.getElementById('toggle-text-' + idx);
    const alertEl = document.getElementById('hidden-alert-' + idx);

    if (card) {
      card.setAttribute('data-step-hidden', isChecked ? '1' : '0');
      card.style.borderColor = isChecked ? '#FECDD3' : '#E2E8F0';
    }

    if (isChecked) {
      if (numBadge) numBadge.style.background = '#E11D48';
      if (statusPill) {
        statusPill.textContent = 'DISEMBUNYIKAN';
        statusPill.style.background = '#FFF1F2';
        statusPill.style.color = '#E11D48';
        statusPill.style.borderColor = '#FECDD3';
      }
      if (toggleLabel) {
        toggleLabel.style.background = '#FFF1F2';
        toggleLabel.style.borderColor = '#E11D48';
        toggleLabel.style.color = '#E11D48';
      }
      if (toggleText) toggleText.textContent = 'Tahap Disembunyikan (Hidden)';
      if (alertEl) alertEl.style.display = 'block';
      if (pill) {
        pill.style.background = '#FFF1F2';
        pill.style.borderColor = '#FECDD3';
        pill.style.color = '#E11D48';
        pill.setAttribute('data-hidden', '1');
      }
    } else {
      if (numBadge) numBadge.style.background = '#0F172A';
      if (statusPill) {
        statusPill.textContent = 'TAMPIL DI WEB';
        statusPill.style.background = '#F0FDF4';
        statusPill.style.color = '#166534';
        statusPill.style.borderColor = '#BBF7D0';
      }
      if (toggleLabel) {
        toggleLabel.style.background = '#F8FAFC';
        toggleLabel.style.borderColor = '#CBD5E1';
        toggleLabel.style.color = '#334155';
      }
      if (toggleText) toggleText.textContent = 'Sembunyikan Tahap Ini';
      if (alertEl) alertEl.style.display = 'none';
      if (pill) {
        pill.style.background = '#FFF';
        pill.style.borderColor = '#CBD5E1';
        pill.style.color = '#1E293B';
        pill.setAttribute('data-hidden', '0');
      }
    }

    updateHiddenCounters();
  }

  function updateHiddenCounters() {
    const cards = document.querySelectorAll('.backoffice-step-card');
    let hidden = 0, active = 0;
    cards.forEach(c => {
      if (c.getAttribute('data-step-hidden') === '1') {
        hidden++;
      } else {
        active++;
      }
    });

    const tabActiveCount = document.getElementById('backoffice-tab-active-count');
    if (tabActiveCount) tabActiveCount.textContent = active;

    const countActiveEl = document.getElementById('count-filter-active');
    if (countActiveEl) countActiveEl.textContent = active;

    const countHiddenEl = document.getElementById('count-filter-hidden');
    if (countHiddenEl) countHiddenEl.textContent = hidden;
  }

  function uploadPhotoAjax(fileInputId, targetType, targetIndex, previewId, textInputId, statusId, labelId) {
    const fileInput = document.getElementById(fileInputId);
    const statusEl = document.getElementById(statusId);
    const previewEl = document.getElementById(previewId);
    const textInput = document.getElementById(textInputId);
    const labelEl = labelId ? document.getElementById(labelId) : null;

    if (!fileInput.files || !fileInput.files[0]) return;

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('target_type', targetType);
    formData.append('target_index', targetIndex);
    formData.append('_token', '{{ csrf_token() }}');

    statusEl.style.display = 'block';
    statusEl.style.color = '#2563EB';
    statusEl.innerHTML = '<span style="display:inline-flex; align-items:center; gap:5px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/></svg> Mengunggah foto (' + (file.size / 1024).toFixed(0) + ' KB)...</span>';

    fetch('{{ route("backoffice.panel-process.upload-photo") }}', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        previewEl.src = data.url + '?v=' + new Date().getTime();
        textInput.value = data.filename;
        if (labelEl) labelEl.textContent = data.filename;
        statusEl.style.color = '#166534';
        statusEl.innerHTML = '✓ Foto berhasil diupload &amp; tersimpan: <b>' + data.filename + '</b>';
      } else {
        statusEl.style.color = '#DC2626';
        statusEl.textContent = 'Gagal: ' + (data.message || 'Upload gagal');
      }
    })
    .catch(err => {
      statusEl.style.color = '#DC2626';
      statusEl.textContent = 'Gagal: ' + err.message;
    });
  }

  function openPhotoPicker(type, index, previewId, inputId, labelId) {
    activePickerTarget = { type, index, previewId, inputId, labelId };
    const modal = document.getElementById('photoPickerModal');
    if (modal) {
      modal.style.display = 'flex';
      const search = document.getElementById('modalPhotoSearch');
      if (search) {
        search.value = '';
        filterModalPhotos('');
        search.focus();
      }
    }
  }

  function closePhotoPicker() {
    const modal = document.getElementById('photoPickerModal');
    if (modal) modal.style.display = 'none';
  }

  function filterModalPhotos(query) {
    const q = query.trim().toLowerCase();
    document.querySelectorAll('.modal-photo-item').forEach(el => {
      const name = el.getAttribute('data-photo-name') || '';
      el.style.display = (!q || name.includes(q)) ? 'block' : 'none';
    });
  }

  function selectPhotoFromModal(filename, url) {
    if (!activePickerTarget.type) return;

    const previewEl = document.getElementById(activePickerTarget.previewId);
    const textInput = document.getElementById(activePickerTarget.inputId);
    const labelEl = activePickerTarget.labelId ? document.getElementById(activePickerTarget.labelId) : null;

    if (previewEl) previewEl.src = url + '?v=' + new Date().getTime();
    if (textInput) textInput.value = filename;
    if (labelEl) labelEl.textContent = filename;

    // Send instant update to server
    const formData = new FormData();
    formData.append('filename', filename);
    formData.append('target_type', activePickerTarget.type);
    formData.append('target_index', activePickerTarget.index);
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route("backoffice.panel-process.select-photo") }}', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      closePhotoPicker();
    })
    .catch(err => {
      console.error('Error selecting photo:', err);
      closePhotoPicker();
    });
  }

  // Close modal on backdrop click or ESC
  window.addEventListener('keydown', e => {
    if (e.key === 'Escape') closePhotoPicker();
  });
  const pickerModal = document.getElementById('photoPickerModal');
  if (pickerModal) {
    pickerModal.addEventListener('click', e => {
      if (e.target === pickerModal) closePhotoPicker();
    });
  }
</script>
@endsection
