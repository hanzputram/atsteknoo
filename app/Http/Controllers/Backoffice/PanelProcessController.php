<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Services\PanelProcessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PanelProcessController extends Controller
{
    public function index()
    {
        $data = PanelProcessService::getData();

        // Scan workshop images in public/panel-building-process/images
        $imgDir = public_path('panel-building-process/images');
        $availablePhotos = [];
        if (is_dir($imgDir)) {
            $files = scandir($imgDir);
            foreach ($files as $f) {
                if ($f !== '.' && $f !== '..' && preg_match('/\.(jpe?g|png|webp|svg)$/i', $f)) {
                    $availablePhotos[] = [
                        'filename' => $f,
                        'url' => asset('panel-building-process/images/' . $f),
                    ];
                }
            }
        }

        return view('backoffice.panel-process.index', compact('data', 'availablePhotos'));
    }

    public function update(Request $request)
    {
        $current = PanelProcessService::getData();

        // 1. Process Intro & General Info
        if ($request->has('intro')) {
            $current['intro']['eyebrow'] = trim($request->input('intro.eyebrow', $current['intro']['eyebrow']));
            $current['intro']['title'] = trim($request->input('intro.title', $current['intro']['title']));
            $current['intro']['title_em'] = trim($request->input('intro.title_em', $current['intro']['title_em']));
            $current['intro']['description'] = trim($request->input('intro.description', $current['intro']['description']));
            $current['intro']['stat_steps_num'] = trim($request->input('intro.stat_steps_num', $current['intro']['stat_steps_num']));
            $current['intro']['stat_steps_label'] = trim($request->input('intro.stat_steps_label', $current['intro']['stat_steps_label']));
            $current['intro']['stat_phases_num'] = trim($request->input('intro.stat_phases_num', $current['intro']['stat_phases_num']));
            $current['intro']['stat_phases_label'] = trim($request->input('intro.stat_phases_label', $current['intro']['stat_phases_label']));
        }

        // Section Line
        if ($request->has('section_line')) {
            $current['section_line']['title'] = trim($request->input('section_line.title', $current['section_line']['title']));
            $current['section_line']['hint'] = trim($request->input('section_line.hint', $current['section_line']['hint']));
        }

        // Explorer
        if ($request->has('explorer')) {
            $current['explorer']['eyebrow'] = trim($request->input('explorer.eyebrow', $current['explorer']['eyebrow']));
            $current['explorer']['title'] = trim($request->input('explorer.title', $current['explorer']['title']));
            $current['explorer']['tour_button_play'] = trim($request->input('explorer.tour_button_play', $current['explorer']['tour_button_play']));
            $current['explorer']['tour_button_pause'] = trim($request->input('explorer.tour_button_pause', $current['explorer']['tour_button_pause']));
        }

        // Directory
        if ($request->has('directory')) {
            $current['directory']['title'] = trim($request->input('directory.title', $current['directory']['title']));
            $current['directory']['subtitle'] = trim($request->input('directory.subtitle', $current['directory']['subtitle']));
            $current['directory']['button_label'] = trim($request->input('directory.button_label', $current['directory']['button_label']));
        }

        // 2. Process 6 Phases
        if ($request->has('phases') && is_array($request->input('phases'))) {
            foreach ($request->input('phases') as $idx => $p) {
                if (isset($current['phases'][$idx])) {
                    $current['phases'][$idx]['title'] = trim($p['title'] ?? $current['phases'][$idx]['title']);
                    $current['phases'][$idx]['caption'] = trim($p['caption'] ?? $current['phases'][$idx]['caption']);
                    $current['phases'][$idx]['desc'] = trim($p['desc'] ?? $current['phases'][$idx]['desc']);
                    if (!empty($p['image'])) {
                        $current['phases'][$idx]['image'] = trim($p['image']);
                    }
                }
            }
        }

        // 3. Process 33 Steps
        if ($request->has('steps') && is_array($request->input('steps'))) {
            foreach ($request->input('steps') as $idx => $s) {
                if (isset($current['steps'][$idx])) {
                    $title = trim($s['title'] ?? $current['steps'][$idx]['title']);
                    $subtitle = trim($s['subtitle'] ?? $current['steps'][$idx]['subtitle']);
                    $description = trim($s['description'] ?? $current['steps'][$idx]['description']);
                    $checkpoint = trim($s['checkpoint'] ?? $current['steps'][$idx]['checkpoint']);
                    $output = trim($s['output'] ?? $current['steps'][$idx]['output']);
                    $image = !empty($s['image']) ? trim($s['image']) : $current['steps'][$idx]['image'];

                    // Activities: Parse from textarea (one per line) or array
                    $activities = [];
                    if (isset($s['activities'])) {
                        if (is_array($s['activities'])) {
                            $activities = array_values(array_filter(array_map('trim', $s['activities'])));
                        } else {
                            $lines = explode("\n", str_replace("\r", "", $s['activities']));
                            $activities = array_values(array_filter(array_map('trim', $lines)));
                        }
                    } else {
                        $activities = $current['steps'][$idx]['activities'];
                    }

                    $current['steps'][$idx] = [
                        'title' => $title,
                        'subtitle' => $subtitle,
                        'description' => $description,
                        'activities' => $activities,
                        'checkpoint' => $checkpoint,
                        'output' => $output,
                        'image' => $image,
                    ];
                }
            }
        }

        // 4. Process Facilities
        if ($request->has('facilities')) {
            $current['facilities']['eyebrow'] = trim($request->input('facilities.eyebrow', $current['facilities']['eyebrow']));
            $current['facilities']['title'] = trim($request->input('facilities.title', $current['facilities']['title']));
            $current['facilities']['description'] = trim($request->input('facilities.description', $current['facilities']['description']));

            if ($request->has('facilities.machines') && is_array($request->input('facilities.machines'))) {
                $machinesList = [];
                foreach ($request->input('facilities.machines') as $mIdx => $m) {
                    $tags = [];
                    if (isset($m['tags'])) {
                        if (is_array($m['tags'])) {
                            $tags = array_values(array_filter(array_map('trim', $m['tags'])));
                        } else {
                            $tags = array_values(array_filter(array_map('trim', preg_split('/[,\n]+/', (string) $m['tags']))));
                        }
                    }

                    $existing = $current['facilities']['machines'][$mIdx] ?? [];
                    $existingImage = $existing['image'] ?? 'fabrication.webp';
                    $existingModel = $existing['model'] ?? null;

                    $machinesList[] = [
                        'image' => !empty($m['image']) ? trim($m['image']) : $existingImage,
                        'count' => trim($m['count'] ?? '01'),
                        'unit' => trim($m['unit'] ?? 'units'),
                        'title' => trim($m['title'] ?? 'Machine'),
                        'desc' => trim($m['desc'] ?? ''),
                        'tags' => $tags,
                        'powers_step' => trim($m['powers_step'] ?? ''),
                        'powers_step_index' => isset($m['powers_step_index']) && $m['powers_step_index'] !== '' ? (int) $m['powers_step_index'] : null,
                        'model' => !empty($m['model']) ? trim($m['model']) : $existingModel,
                    ];
                }
                $current['facilities']['machines'] = $machinesList;
            }
        }

        // 5. Process Quality
        if ($request->has('quality')) {
            $current['quality']['title'] = trim($request->input('quality.title', $current['quality']['title']));
            $current['quality']['description'] = trim($request->input('quality.description', $current['quality']['description']));
        }

        PanelProcessService::saveData($current);

        AuditLog::log('UPDATE', 'PanelProcess', 1, [
            'action' => 'Panel Building Process 33 Steps Updated',
            'user' => auth()->user()?->name ?? 'Admin',
        ]);

        return redirect()->route('backoffice.panel-process.index')->with('success', 'Panel Building Process content and photos have been successfully updated!');
    }

    public function uploadPhoto(Request $request): JsonResponse
    {
        $request->validate([
            'photo' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:10240'],
            'target_type' => ['nullable', 'string', 'in:phase,step,machine'],
            'target_index' => ['nullable', 'integer', 'min:0', 'max:50'],
        ]);

        $file = $request->file('photo');
        $targetType = $request->input('target_type');
        $targetIndex = $request->input('target_index');

        $destDir = public_path('panel-building-process/images');
        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $cleanBase = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        if ($targetType && $targetIndex !== null) {
            $filename = "{$targetType}-" . str_pad($targetIndex + 1, 2, '0', STR_PAD_LEFT) . "-{$cleanBase}.{$extension}";
        } else {
            $filename = "upload-{$cleanBase}-" . time() . ".{$extension}";
        }

        $file->move($destDir, $filename);

        // Auto-update data if target specified
        $data = PanelProcessService::getData();
        if ($targetType === 'phase' && isset($data['phases'][$targetIndex])) {
            $data['phases'][$targetIndex]['image'] = $filename;
            PanelProcessService::saveData($data);
        } elseif ($targetType === 'step' && isset($data['steps'][$targetIndex])) {
            $data['steps'][$targetIndex]['image'] = $filename;
            PanelProcessService::saveData($data);
        } elseif ($targetType === 'machine' && isset($data['facilities']['machines'][$targetIndex])) {
            $data['facilities']['machines'][$targetIndex]['image'] = $filename;
            PanelProcessService::saveData($data);
        }

        return response()->json([
            'success' => true,
            'filename' => $filename,
            'url' => asset('panel-building-process/images/' . $filename),
            'message' => "Photo successfully uploaded as {$filename}!",
        ]);
    }

    public function selectPhoto(Request $request): JsonResponse
    {
        $request->validate([
            'filename' => ['required', 'string'],
            'target_type' => ['required', 'string', 'in:phase,step,machine'],
            'target_index' => ['required', 'integer', 'min:0', 'max:50'],
        ]);

        $filename = trim($request->input('filename'));
        $targetType = $request->input('target_type');
        $targetIndex = (int) $request->input('target_index');

        $data = PanelProcessService::getData();
        if ($targetType === 'phase' && isset($data['phases'][$targetIndex])) {
            $data['phases'][$targetIndex]['image'] = $filename;
            PanelProcessService::saveData($data);
        } elseif ($targetType === 'step' && isset($data['steps'][$targetIndex])) {
            $data['steps'][$targetIndex]['image'] = $filename;
            PanelProcessService::saveData($data);
        } elseif ($targetType === 'machine' && isset($data['facilities']['machines'][$targetIndex])) {
            $data['facilities']['machines'][$targetIndex]['image'] = $filename;
            PanelProcessService::saveData($data);
        }

        return response()->json([
            'success' => true,
            'filename' => $filename,
            'url' => asset('panel-building-process/images/' . $filename),
            'message' => "Photo successfully applied!",
        ]);
    }

    public function resetDefault()
    {
        PanelProcessService::resetToDefault();

        AuditLog::log('RESET', 'PanelProcess', 1, [
            'action' => 'Panel Building Process reset to default English dataset',
        ]);

        return redirect()->route('backoffice.panel-process.index')->with('success', 'Panel Building Process has been reset to the default English content.');
    }
}
