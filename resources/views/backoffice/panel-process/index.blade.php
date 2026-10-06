@extends('backoffice.layouts.app')

@section('title', 'Panel Building Process (33 Steps Editor)')
@section('breadcrumb', 'Panel Building Process')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
  <div>
    <h1 class="page-title" style="font-size: 1.5rem; font-weight: 800; color: #0F172A; margin: 0 0 6px 0;">
      Panel Building Process Editor (33 Steps)
    </h1>
    <p class="page-subtitle" style="font-size: 0.88rem; color: #64748B; margin: 0;">
      Edit all 33 production steps, 6 manufacturing phases, machinery facilities, and photos for <a href="{{ route('services.panel') }}" target="_blank" style="color: #E11D48; font-weight: 600;">/jasa-pembuatan-panel-listrik</a>.
    </p>
  </div>
  <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
    <a href="{{ route('services.panel') }}" target="_blank" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 6px;">
      <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      View Live Page
    </a>
    <form action="{{ route('backoffice.panel-process.reset') }}" method="POST" onsubmit="return confirm('Are you sure you want to reset all 33 steps to the default English content? Custom edits will be overwritten.');" style="display: inline;">
      @csrf
      <button type="submit" class="btn btn-secondary btn-sm" style="color: #64748B;">
        Reset to Default English
      </button>
    </form>
    <button type="button" onclick="document.getElementById('panelProcessForm').submit();" class="btn btn-primary btn-sm" style="display: inline-flex; align-items: center; gap: 6px; background: #E11D48; border-color: #E11D48; color: #fff; font-weight: 700; padding: 7px 16px;">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
      Save All Changes
    </button>
  </div>
</div>

@if(session('success'))
<div style="background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
  <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
  <span>{{ session('success') }}</span>
</div>
@endif

<!-- Segmented Navigation Tabs -->
<div style="display: flex; gap: 6px; border-bottom: 2px solid #E2E8F0; margin-bottom: 24px; overflow-x: auto; padding-bottom: 2px;">
  <button type="button" class="tab-btn active" onclick="switchTab('tab-steps')" id="btn-tab-steps" style="padding: 10px 18px; font-weight: 700; font-size: 0.9rem; border: none; background: transparent; cursor: pointer; border-bottom: 3px solid #E11D48; color: #E11D48;">
    33 Production Steps ({{ count($data['steps']) }})
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-phases')" id="btn-tab-phases" style="padding: 10px 18px; font-weight: 600; font-size: 0.9rem; border: none; background: transparent; cursor: pointer; color: #64748B;">
    6 Manufacturing Phases
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-general')" id="btn-tab-general" style="padding: 10px 18px; font-weight: 600; font-size: 0.9rem; border: none; background: transparent; cursor: pointer; color: #64748B;">
    Hero & Intro Copy
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-facilities')" id="btn-tab-facilities" style="padding: 10px 18px; font-weight: 600; font-size: 0.9rem; border: none; background: transparent; cursor: pointer; color: #64748B;">
    Production Facilities (Machines)
  </button>
  <button type="button" class="tab-btn" onclick="switchTab('tab-quality')" id="btn-tab-quality" style="padding: 10px 18px; font-weight: 600; font-size: 0.9rem; border: none; background: transparent; cursor: pointer; color: #64748B;">
    Quality Assurance Note
  </button>
</div>

<form id="panelProcessForm" action="{{ route('backoffice.panel-process.update') }}" method="POST">
  @csrf

  <!-- ================= TAB 1: 33 PRODUCTION STEPS ================= -->
  <div id="tab-steps" class="tab-content">
    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
      <div>
        <strong style="color: #0F172A; font-size: 0.95rem;">Jump to Step:</strong>
        <span style="color: #64748B; font-size: 0.85rem; margin-left: 6px;">Select any of the 33 steps to edit description, activities, checkpoint, output, and photo.</span>
      </div>
      <div style="display: flex; gap: 4px; flex-wrap: wrap;">
        @foreach($data['steps'] as $idx => $s)
          <a href="#step-card-{{ $idx }}" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #FFF; border: 1px solid #CBD5E1; color: #334155; font-size: 11px; font-weight: 700; text-decoration: none;">
            {{ sprintf('%02d', $idx + 1) }}
          </a>
        @endforeach
      </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 20px;">
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
          $imgFile = $step['image'] ?? 'engineering';
          $imgUrl = (str_starts_with($imgFile, 'http') || str_starts_with($imgFile, '/'))
              ? $imgFile
              : asset('panel-building-process/images/' . (str_contains($imgFile, '.') ? $imgFile : $imgFile . '.webp'));
        @endphp

        <div id="step-card-{{ $idx }}" class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
          <!-- Step Header Bar -->
          <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F1F5F9; padding-bottom: 14px; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background: #0F172A; color: #FFF; font-weight: 800; font-size: 14px;">
                {{ sprintf('%02d', $idx + 1) }}
              </span>
              <div>
                <span style="font-size: 11px; font-weight: 800; color: #E11D48; text-transform: uppercase; letter-spacing: 0.05em;">
                  PHASE {{ sprintf('%02d', $phaseIndex + 1) }}: {{ strtoupper($phaseName) }}
                </span>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0F172A; margin: 2px 0 0 0;">
                  Step {{ sprintf('%02d', $idx + 1) }}: {{ $step['title'] }}
                </h3>
              </div>
            </div>
            <span style="font-size: 12px; color: #64748B; background: #F1F5F9; padding: 4px 10px; border-radius: 6px; font-weight: 600;">
              Index [{{ $idx }}]
            </span>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 280px; gap: 24px;">
            <!-- Left Side: Fields -->
            <div style="display: flex; flex-direction: column; gap: 14px;">
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Step English Title (Original Technical Name)
                  </label>
                  <input type="text" name="steps[{{ $idx }}][title]" value="{{ $step['title'] }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 600;" required>
                </div>
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Step Display Subtitle (Customer Heading)
                  </label>
                  <input type="text" name="steps[{{ $idx }}][subtitle]" value="{{ $step['subtitle'] }}" class="form-control" style="width: 100%; font-size: 13px;" required>
                </div>
              </div>

              <div class="form-group" style="margin: 0;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                  Full Process Description
                </label>
                <textarea name="steps[{{ $idx }}][description]" rows="3" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.5;" required>{{ $step['description'] }}</textarea>
              </div>

              <div class="form-group" style="margin: 0;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 3px;">
                  Activities Carried Out (1 bullet point per line)
                </label>
                <span style="display: block; font-size: 11px; color: #64748B; margin-bottom: 6px;">Each line becomes a bullet point in the "What is Done" section.</span>
                <textarea name="steps[{{ $idx }}][activities]" rows="3" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.5; font-family: inherit;">{{ is_array($step['activities']) ? implode("\n", $step['activities']) : $step['activities'] }}</textarea>
              </div>

              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Quality Checkpoint
                  </label>
                  <textarea name="steps[{{ $idx }}][checkpoint]" rows="2" class="form-control" style="width: 100%; font-size: 13px;">{{ $step['checkpoint'] }}</textarea>
                </div>
                <div class="form-group" style="margin: 0;">
                  <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                    Output / Deliverable
                  </label>
                  <textarea name="steps[{{ $idx }}][output]" rows="2" class="form-control" style="width: 100%; font-size: 13px;">{{ $step['output'] }}</textarea>
                </div>
              </div>
            </div>

            <!-- Right Side: Photo Upload & Preview -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 12px;">
              <span style="font-size: 12px; font-weight: 700; color: #334155;">Step Documentation Photo</span>
              <div style="width: 100%; height: 160px; border-radius: 8px; overflow: hidden; background: #CBD5E1; position: relative;">
                <img id="preview-step-{{ $idx }}" src="{{ $imgUrl }}" alt="Step {{ $idx + 1 }} Photo" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <div>
                <label style="font-size: 11px; font-weight: 600; color: #64748B; display: block; margin-bottom: 4px;">Photo File / Name:</label>
                <input type="text" id="input-step-img-{{ $idx }}" name="steps[{{ $idx }}][image]" value="{{ $step['image'] ?? '' }}" class="form-control" style="width: 100%; font-size: 12px; font-family: monospace; padding: 5px 8px; margin-bottom: 8px;">
                
                <input type="file" id="file-step-{{ $idx }}" accept="image/*" style="display: none;" onchange="uploadStepPhoto({{ $idx }})">
                <button type="button" onclick="document.getElementById('file-step-{{ $idx }}').click()" class="btn btn-secondary btn-sm" style="width: 100%; font-size: 12px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                  <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  Upload New Photo
                </button>
                <span id="upload-status-step-{{ $idx }}" style="font-size: 11px; color: #166534; display: none; margin-top: 4px; text-align: center;"></span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ================= TAB 2: 6 MANUFACTURING PHASES ================= -->
  <div id="tab-phases" class="tab-content" style="display: none;">
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
      @foreach($data['phases'] as $pIdx => $phase)
        @php
          $pImgFile = $phase['image'] ?? 'engineering';
          $pImgUrl = (str_starts_with($pImgFile, 'http') || str_starts_with($pImgFile, '/'))
              ? $pImgFile
              : asset('panel-building-process/images/' . (str_contains($pImgFile, '.') ? $pImgFile : $pImgFile . '.webp'));
        @endphp
        <div class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 22px;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <span style="width: 32px; height: 32px; border-radius: 8px; background: #E11D48; color: #FFF; font-weight: 800; font-size: 13px; display: inline-flex; align-items: center; justify-content: center;">
                {{ sprintf('%02d', $pIdx + 1) }}
              </span>
              <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0;">
                Phase {{ sprintf('%02d', $pIdx + 1) }}: {{ $phase['title'] }}
              </h3>
            </div>
            <span style="font-size: 11px; font-weight: 700; color: #64748B; background: #F1F5F9; padding: 3px 8px; border-radius: 4px;">
              STEPS {{ sprintf('%02d', $phase['from'] + 1) }} — {{ sprintf('%02d', $phase['to'] + 1) }}
            </span>
          </div>

          <div style="display: flex; gap: 16px; margin-bottom: 14px;">
            <div style="width: 140px; height: 100px; border-radius: 8px; overflow: hidden; background: #E2E8F0; flex-shrink: 0;">
              <img id="preview-phase-{{ $pIdx }}" src="{{ $pImgUrl }}" alt="{{ $phase['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="flex: 1;">
              <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Phase Image:</label>
              <input type="text" id="input-phase-img-{{ $pIdx }}" name="phases[{{ $pIdx }}][image]" value="{{ $phase['image'] }}" class="form-control" style="width: 100%; font-size: 12px; font-family: monospace; margin-bottom: 6px;">
              <input type="file" id="file-phase-{{ $pIdx }}" accept="image/*" style="display: none;" onchange="uploadPhasePhoto({{ $pIdx }})">
              <button type="button" onclick="document.getElementById('file-phase-{{ $pIdx }}').click()" class="btn btn-secondary btn-sm" style="font-size: 11px; padding: 4px 10px;">
                Upload New Image
              </button>
              <span id="upload-status-phase-{{ $pIdx }}" style="font-size: 11px; color: #166534; display: none; margin-left: 6px;"></span>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 12px;">
            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Phase Title</label>
            <input type="text" name="phases[{{ $pIdx }}][title]" value="{{ $phase['title'] }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 700;" required>
          </div>

          <div class="form-group" style="margin-bottom: 12px;">
            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Card Photo Overlay Caption</label>
            <input type="text" name="phases[{{ $pIdx }}][caption]" value="{{ $phase['caption'] }}" class="form-control" style="width: 100%; font-size: 12px;" required>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Phase Short Description</label>
            <textarea name="phases[{{ $pIdx }}][desc]" rows="2" class="form-control" style="width: 100%; font-size: 12px;" required>{{ $phase['desc'] }}</textarea>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ================= TAB 3: HERO & INTRO COPY ================= -->
  <div id="tab-general" class="tab-content" style="display: none;">
    <div class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 24px; max-width: 900px;">
      <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 18px 0;">Hero Introduction Header</h3>

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

      <div class="form-group" style="margin-bottom: 16px;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Intro Paragraph</label>
        <textarea name="intro[description]" rows="3" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.6;" required>{{ $data['intro']['description'] ?? '' }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; background: #F8FAFC; padding: 16px; border-radius: 10px; border: 1px solid #E2E8F0; margin-bottom: 24px;">
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 1 Number</label>
          <input type="text" name="intro[stat_steps_num]" value="{{ $data['intro']['stat_steps_num'] ?? '33' }}" class="form-control" style="width: 100%; font-weight: 800; font-size: 16px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 1 Label (HTML)</label>
          <input type="text" name="intro[stat_steps_label]" value="{{ $data['intro']['stat_steps_label'] ?? 'Production<br>Steps' }}" class="form-control" style="width: 100%; font-size: 12px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 2 Number</label>
          <input type="text" name="intro[stat_phases_num]" value="{{ $data['intro']['stat_phases_num'] ?? '06' }}" class="form-control" style="width: 100%; font-weight: 800; font-size: 16px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 700; color: #64748B;">Stat 2 Label (HTML)</label>
          <input type="text" name="intro[stat_phases_label]" value="{{ $data['intro']['stat_phases_label'] ?? 'Integrated<br>Phases' }}" class="form-control" style="width: 100%; font-size: 12px;">
        </div>
      </div>

      <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 24px 0 16px 0; border-top: 1px solid #F1F5F9; pt-4">Explorer & Directory Headings</h3>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Explorer Section Heading</label>
          <input type="text" name="explorer[title]" value="{{ $data['explorer']['title'] ?? 'Explore Every Step.' }}" class="form-control" style="width: 100%; font-size: 13px;" required>
        </div>
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tour Play Button Label</label>
          <input type="text" name="explorer[tour_button_play]" value="{{ $data['explorer']['tour_button_play'] ?? 'Play Process Tour' }}" class="form-control" style="width: 100%; font-size: 13px;" required>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Directory Accordion Heading</label>
          <input type="text" name="directory[title]" value="{{ $data['directory']['title'] ?? 'Full Production Workflow. Zero Compromise.' }}" class="form-control" style="width: 100%; font-size: 13px;" required>
        </div>
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Directory Details Button</label>
          <input type="text" name="directory[button_label]" value="{{ $data['directory']['button_label'] ?? 'View step details' }}" class="form-control" style="width: 100%; font-size: 13px;" required>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= TAB 4: PRODUCTION FACILITIES ================= -->
  <div id="tab-facilities" class="tab-content" style="display: none;">
    <div class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 24px; max-width: 900px; margin-bottom: 24px;">
      <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 16px 0;">Facilities Section Header</h3>
      <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 14px;">
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Eyebrow</label>
          <input type="text" name="facilities[eyebrow]" value="{{ $data['facilities']['eyebrow'] ?? 'Production Facilities' }}" class="form-control" style="width: 100%; font-size: 13px;">
        </div>
        <div class="form-group" style="margin: 0;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Heading Title</label>
          <input type="text" name="facilities[title]" value="{{ $data['facilities']['title'] ?? 'Machinery Engineered for Precision.' }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 700;">
        </div>
      </div>
      <div class="form-group" style="margin: 0;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Description</label>
        <textarea name="facilities[description]" rows="2" class="form-control" style="width: 100%; font-size: 13px;">{{ $data['facilities']['description'] ?? '' }}</textarea>
      </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; max-width: 1050px;">
      @foreach($data['facilities']['machines'] as $mIdx => $machine)
        <div class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.02); display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <!-- Machine Photo Preview & Upload -->
            <div style="margin-bottom: 16px;">
              <div style="position: relative; height: 160px; border-radius: 10px; overflow: hidden; background: #0F172A; border: 1px solid #CBD5E1; margin-bottom: 8px;">
                <img id="preview-machine-{{ $mIdx }}" 
                     src="{{ asset('panel-building-process/images/' . ($machine['image'] ?? 'machine-laser.jpg')) }}" 
                     alt="{{ $machine['title'] }}" 
                     style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 8px; left: 8px; background: rgba(15, 23, 42, 0.85); color: #FFF; font-size: 10px; font-weight: 800; padding: 3px 8px; border-radius: 4px; backdrop-filter: blur(4px);">
                  FLEET #{{ sprintf('%02d', $mIdx + 1) }}
                </span>
              </div>
              <div style="display: flex; align-items: center; gap: 8px;">
                <input type="file" id="file-machine-{{ $mIdx }}" accept="image/*" style="display: none;" onchange="uploadMachinePhoto({{ $mIdx }})">
                <button type="button" onclick="document.getElementById('file-machine-{{ $mIdx }}').click()" class="btn btn-sm btn-outline-secondary" style="font-size: 11px; font-weight: 700; padding: 5px 12px; display: inline-flex; align-items: center; gap: 4px;">
                  <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                  Upload New Photo
                </button>
                <input type="text" id="input-machine-img-{{ $mIdx }}" name="facilities[machines][{{ $mIdx }}][image]" value="{{ $machine['image'] ?? '' }}" class="form-control" style="font-size: 11px; width: 140px; padding: 4px 8px;" placeholder="image filename">
                <span id="upload-status-machine-{{ $mIdx }}" style="font-size: 11px; font-weight: 600; display: none;"></span>
              </div>
            </div>

            <!-- Numbers & Machine Title -->
            <div style="display: flex; gap: 10px; margin-bottom: 12px;">
              <div style="width: 80px;">
                <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Count</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][count]" value="{{ $machine['count'] }}" class="form-control" style="width: 100%; font-size: 16px; font-weight: 800; text-align: center;">
              </div>
              <div style="width: 110px;">
                <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Unit</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][unit]" value="{{ $machine['unit'] }}" class="form-control" style="width: 100%; font-size: 12px;">
              </div>
              <div style="flex: 1;">
                <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Machine Name</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][title]" value="{{ $machine['title'] }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 700;">
              </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 12px;">
              <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Capability Narrative</label>
              <textarea name="facilities[machines][{{ $mIdx }}][desc]" rows="2" class="form-control" style="width: 100%; font-size: 12px; line-height: 1.5;">{{ $machine['desc'] }}</textarea>
            </div>

            <!-- Tags -->
            <div style="margin-bottom: 12px;">
              <label style="font-size: 11px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Key Capabilities & Specs (Comma separated)</label>
              <input type="text" name="facilities[machines][{{ $mIdx }}][tags]" value="{{ is_array($machine['tags'] ?? null) ? implode(', ', $machine['tags']) : ($machine['tags'] ?? '') }}" class="form-control" style="width: 100%; font-size: 12px;" placeholder="e.g. Sub-millimeter Tolerance, Dual Shuttle Tables, Clean Edge">
            </div>

            <!-- Integration with 33 Steps -->
            <div style="background: #F1F5F9; border-radius: 8px; padding: 10px; display: flex; gap: 10px; align-items: center;">
              <div style="flex: 1;">
                <label style="font-size: 10.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 2px;">Integrated Workflow Step Title</label>
                <input type="text" name="facilities[machines][{{ $mIdx }}][powers_step]" value="{{ $machine['powers_step'] ?? '' }}" class="form-control" placeholder="e.g. Step 07: CNC Laser Cutting" style="font-size: 11.5px; font-weight: 600;">
              </div>
              <div style="width: 85px;">
                <label style="font-size: 10.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 2px;">Step Index</label>
                <input type="number" name="facilities[machines][{{ $mIdx }}][powers_step_index]" value="{{ $machine['powers_step_index'] ?? 0 }}" min="0" max="32" class="form-control" style="font-size: 12px; text-align: center;">
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ================= TAB 5: QUALITY ASSURANCE ================= -->
  <div id="tab-quality" class="tab-content" style="display: none;">
    <div class="panel-card" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 24px; max-width: 800px;">
      <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 16px 0;">Quality Assurance Note</h3>
      <div class="form-group" style="margin-bottom: 14px;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Quality Heading (HTML)</label>
        <input type="text" name="quality[title]" value="{{ $data['quality']['title'] ?? 'Quality Verified<br>at Every Milestone.' }}" class="form-control" style="width: 100%; font-size: 13px; font-weight: 700;">
      </div>
      <div class="form-group" style="margin: 0;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Quality Narrative / Audit Policy</label>
        <textarea name="quality[description]" rows="5" class="form-control" style="width: 100%; font-size: 13px; line-height: 1.6;">{{ $data['quality']['description'] ?? '' }}</textarea>
      </div>
    </div>
  </div>

  <!-- Floating Sticky Save Bar -->
  <div style="position: sticky; bottom: 16px; z-index: 40; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); padding: 14px 22px; border-radius: 14px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 10px 25px rgba(0,0,0,0.3); margin-top: 30px; border: 1px solid rgba(255,255,255,0.1);">
    <span style="color: #F8FAFC; font-size: 13px; font-weight: 600;">
      Editing Panel Building Process Content (All 33 Steps, 6 Phases, Machinery & Photos)
    </span>
    <button type="submit" class="btn btn-primary" style="background: #E11D48; border-color: #E11D48; color: #FFF; font-weight: 800; padding: 10px 24px; border-radius: 8px; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
      <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
      Save All Changes
    </button>
  </div>
</form>

<script>
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

  function uploadStepPhoto(idx) {
    const fileInput = document.getElementById('file-step-' + idx);
    const statusEl = document.getElementById('upload-status-step-' + idx);
    const previewEl = document.getElementById('preview-step-' + idx);
    const textInput = document.getElementById('input-step-img-' + idx);

    if (!fileInput.files || !fileInput.files[0]) return;

    const formData = new FormData();
    formData.append('photo', fileInput.files[0]);
    formData.append('target_type', 'step');
    formData.append('target_index', idx);
    formData.append('_token', '{{ csrf_token() }}');

    statusEl.style.display = 'block';
    statusEl.style.color = '#2563EB';
    statusEl.textContent = 'Uploading photo...';

    fetch('{{ route("backoffice.panel-process.upload-photo") }}', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        previewEl.src = data.url + '?v=' + new Date().getTime();
        textInput.value = data.filename;
        statusEl.style.color = '#166534';
        statusEl.textContent = '✓ Uploaded: ' + data.filename;
      } else {
        statusEl.style.color = '#DC2626';
        statusEl.textContent = 'Error: ' + (data.message || 'Upload failed');
      }
    })
    .catch(err => {
      statusEl.style.color = '#DC2626';
      statusEl.textContent = 'Upload failed: ' + err.message;
    });
  }

  function uploadPhasePhoto(pIdx) {
    const fileInput = document.getElementById('file-phase-' + pIdx);
    const statusEl = document.getElementById('upload-status-phase-' + pIdx);
    const previewEl = document.getElementById('preview-phase-' + pIdx);
    const textInput = document.getElementById('input-phase-img-' + pIdx);

    if (!fileInput.files || !fileInput.files[0]) return;

    const formData = new FormData();
    formData.append('photo', fileInput.files[0]);
    formData.append('target_type', 'phase');
    formData.append('target_index', pIdx);
    formData.append('_token', '{{ csrf_token() }}');

    statusEl.style.display = 'inline';
    statusEl.style.color = '#2563EB';
    statusEl.textContent = 'Uploading...';

    fetch('{{ route("backoffice.panel-process.upload-photo") }}', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        previewEl.src = data.url + '?v=' + new Date().getTime();
        textInput.value = data.filename;
        statusEl.style.color = '#166534';
        statusEl.textContent = '✓ Uploaded!';
      } else {
        statusEl.style.color = '#DC2626';
        statusEl.textContent = 'Error';
      }
    })
    .catch(err => {
      statusEl.style.color = '#DC2626';
      statusEl.textContent = 'Failed';
    });
  }

  function uploadMachinePhoto(mIdx) {
    const fileInput = document.getElementById('file-machine-' + mIdx);
    const statusEl = document.getElementById('upload-status-machine-' + mIdx);
    const previewEl = document.getElementById('preview-machine-' + mIdx);
    const textInput = document.getElementById('input-machine-img-' + mIdx);

    if (!fileInput.files || !fileInput.files[0]) return;

    const formData = new FormData();
    formData.append('photo', fileInput.files[0]);
    formData.append('target_type', 'machine');
    formData.append('target_index', mIdx);
    formData.append('_token', '{{ csrf_token() }}');

    statusEl.style.display = 'inline';
    statusEl.style.color = '#2563EB';
    statusEl.textContent = 'Uploading...';

    fetch('{{ route("backoffice.panel-process.upload-photo") }}', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        previewEl.src = data.url + '?v=' + new Date().getTime();
        textInput.value = data.filename;
        statusEl.style.color = '#166534';
        statusEl.textContent = '✓ Uploaded: ' + data.filename;
      } else {
        statusEl.style.color = '#DC2626';
        statusEl.textContent = 'Error: ' + (data.message || 'Upload failed');
      }
    })
    .catch(err => {
      statusEl.style.color = '#DC2626';
      statusEl.textContent = 'Upload failed: ' + err.message;
    });
  }
</script>
@endsection
