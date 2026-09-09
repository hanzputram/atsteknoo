<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::withCount('projects')->orderBy('sort_order')->orderBy('name')->get();

        return view('backoffice.project-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backoffice.project-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:64', 'unique:project_categories,code'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:project_categories,slug'],
        ]);

        $cat = ProjectCategory::create([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('CREATE', 'ProjectCategory', $cat->id, ['code' => $cat->code, 'name' => $cat->name]);

        return redirect()->route('backoffice.project-categories.index')->with('success', "Kategori project '{$cat->name}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $category = ProjectCategory::findOrFail($id);

        return view('backoffice.project-categories.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $category = ProjectCategory::findOrFail($id);

        $request->validate([
            'code' => ['required', 'string', 'max:64', Rule::unique('project_categories', 'code')->ignore($category->id)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('project_categories', 'slug')->ignore($category->id)],
        ]);

        $category->update([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : $category->slug,
            'description' => $request->description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('UPDATE', 'ProjectCategory', $category->id, ['code' => $category->code, 'name' => $category->name]);

        return redirect()->route('backoffice.project-categories.index')->with('success', "Kategori project '{$category->name}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $category = ProjectCategory::withCount('projects')->findOrFail($id);

        if ($category->projects_count > 0) {
            return back()->withErrors(['category' => "Kategori '{$category->name}' masih memiliki {$category->projects_count} project dan tidak dapat dihapus."]);
        }

        $name = $category->name;
        $category->delete();

        AuditLog::log('DELETE', 'ProjectCategory', $category->id, ['name' => $name]);

        return redirect()->route('backoffice.project-categories.index')->with('success', "Kategori '{$name}' berhasil dihapus.");
    }
}
