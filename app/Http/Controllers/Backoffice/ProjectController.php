<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\MediaAsset;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\HtmlSanitizerService;
use App\Services\MediaService;
use App\Services\ProjectExcelService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['category', 'coverImage']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('project_code', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%");
            });
        }

        if ($catId = $request->input('category_id')) {
            $query->where('category_id', $catId);
        }

        if ($request->filled('is_featured')) {
            $query->where('is_featured', (bool) $request->input('is_featured'));
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $projects = $query->latest('updated_at')->paginate(20)->withQueryString();
        $categories = ProjectCategory::orderBy('name')->get();

        return view('backoffice.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = ProjectCategory::orderBy('name')->get();

        return view('backoffice.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_code' => ['nullable', 'string', 'max:64', 'unique:projects,project_code'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
            'category_id' => ['nullable', 'exists:project_categories,id'],
            'cover_image' => ['nullable', 'image', 'max:10240'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        $coverImageId = null;
        if ($request->hasFile('cover_image')) {
            $media = MediaService::storeUpload($request->file('cover_image'), 'image');
            $coverImageId = $media->id;
        }

        $contentClean = HtmlSanitizerService::clean($request->input('content_html'));

        $status = $request->input('status', 'published') ?: 'published';
        $categoryId = $request->category_id ?: ProjectCategory::first()?->id;

        $code = $request->input('project_code') ?: 'PRJ-' . strtoupper(Str::random(6));

        $project = Project::create([
            'project_code' => $code,
            'title' => trim($request->title),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'summary' => $request->summary,
            'content_html' => $contentClean,
            'category_id' => $categoryId,
            'client_name' => $request->client_name,
            'location' => $request->location,
            'completion_year' => $request->completion_year,
            'scope_of_work' => $request->scope_of_work,
            'cover_image_id' => $coverImageId,
            'cover_alt' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => (int) $request->input('sort_order', 0),
            'status' => $status,
            'published_at' => $status === 'published' ? now() : null,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        // Multi-image gallery upload
        if ($request->hasFile('gallery_images')) {
            $idx = 0;
            foreach ($request->file('gallery_images') as $gFile) {
                $gMedia = MediaService::storeUpload($gFile, 'image');
                MediaService::attach($gMedia->id, Project::class, $project->id, 'gallery', $idx, $project->title);
                $idx++;
            }
        }

        AuditLog::log('CREATE', 'Project', $project->id, ['code' => $project->project_code, 'title' => $project->title]);

        return redirect()->route('backoffice.projects.index')->with('success', "Project '{$project->title}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $project = Project::with(['category', 'coverImage', 'galleryUsages.media'])->findOrFail($id);
        $categories = ProjectCategory::orderBy('name')->get();

        return view('backoffice.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'project_code' => ['required', 'string', 'max:64', Rule::unique('projects', 'project_code')->ignore($project->id)],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($project->id)],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        $coverImageId = $project->cover_image_id;
        if ($request->hasFile('cover_image')) {
            $media = MediaService::storeUpload($request->file('cover_image'), 'image');
            $coverImageId = $media->id;
        }

        $contentClean = HtmlSanitizerService::clean($request->input('content_html'));

        if ($request->status === 'published' && !$request->category_id) {
            return back()->withInput()->withErrors(['category_id' => 'Kategori project wajib dipilih sebelum publikasi.']);
        }

        $publishedAt = $project->published_at;
        if ($request->status === 'published' && !$publishedAt) {
            $publishedAt = now();
        }

        $project->update([
            'project_code' => trim($request->project_code),
            'title' => trim($request->title),
            'slug' => $request->slug ? Str::slug($request->slug) : $project->slug,
            'summary' => $request->summary,
            'content_html' => $contentClean,
            'category_id' => $request->category_id,
            'client_name' => $request->client_name,
            'location' => $request->location,
            'completion_year' => $request->completion_year,
            'scope_of_work' => $request->scope_of_work,
            'cover_image_id' => $coverImageId,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => (int) $request->input('sort_order', 0),
            'status' => $request->status,
            'published_at' => $publishedAt,
            'lock_version' => $project->lock_version + 1,
            'updated_by' => auth()->id(),
        ]);

        if ($request->hasFile('gallery_images')) {
            $currentMax = $project->galleryUsages()->max('sort_order') ?? -1;
            foreach ($request->file('gallery_images') as $gFile) {
                $currentMax++;
                $gMedia = MediaService::storeUpload($gFile, 'image');
                MediaService::attach($gMedia->id, Project::class, $project->id, 'gallery', $currentMax, $project->title);
            }
        }

        AuditLog::log('UPDATE', 'Project', $project->id, ['title' => $project->title]);

        return redirect()->route('backoffice.projects.index')->with('success', "Project '{$project->title}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $project = Project::findOrFail($id);
        $title = $project->title;
        $project->delete();

        AuditLog::log('DELETE', 'Project', $project->id, ['title' => $title]);

        return redirect()->route('backoffice.projects.index')->with('success', "Project '{$title}' berhasil dihapus.");
    }

    public function toggleStatus(int $id)
    {
        $project = Project::findOrFail($id);
        $newStatus = $project->status === 'published' ? 'draft' : 'published';
        $publishedAt = $newStatus === 'published' ? ($project->published_at ?: now()) : $project->published_at;

        if ($newStatus === 'published' && !$project->category_id) {
            $project->category_id = ProjectCategory::first()?->id;
        }

        $project->update([
            'status' => $newStatus,
            'published_at' => $publishedAt,
            'updated_by' => auth()->id(),
        ]);

        AuditLog::log('UPDATE', 'Project', $project->id, ['status' => $newStatus]);

        $msg = $newStatus === 'published'
            ? "Project '{$project->title}' berhasil dipublikasikan!"
            : "Project '{$project->title}' dialihkan menjadi draft.";

        return back()->with('success', $msg);
    }

    public function downloadTemplate(ProjectExcelService $excelService)
    {
        $path = $excelService->generateTemplate();
        return response()->download($path, 'ATS_Project_Import_Template.xlsx')->deleteFileAfterSend(true);
    }

    public function importExcel(Request $request, ProjectExcelService $excelService)
    {
        $request->validate([
            'excel_file' => ['required', 'file', 'mimes:xlsx,xls', 'max:20480'],
        ]);

        try {
            $result = $excelService->import($request->file('excel_file'));
            return redirect()->route('backoffice.projects.index')->with(
                'success',
                "Impor project berhasil: {$result['created']} project baru ditambahkan, {$result['updated']} diperbarui."
            );
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal memproses file Excel: ' . $e->getMessage());
        }
    }
}
