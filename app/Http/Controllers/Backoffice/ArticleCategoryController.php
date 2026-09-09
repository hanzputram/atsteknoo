<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::withCount('articles')->orderBy('sort_order')->orderBy('name')->get();

        return view('backoffice.article-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backoffice.article-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:64', 'unique:article_categories,code'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:article_categories,slug'],
        ]);

        $cat = ArticleCategory::create([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('CREATE', 'ArticleCategory', $cat->id, ['code' => $cat->code, 'name' => $cat->name]);

        return redirect()->route('backoffice.article-categories.index')->with('success', "Kategori artikel '{$cat->name}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $category = ArticleCategory::findOrFail($id);

        return view('backoffice.article-categories.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $category = ArticleCategory::findOrFail($id);

        $request->validate([
            'code' => ['required', 'string', 'max:64', Rule::unique('article_categories', 'code')->ignore($category->id)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('article_categories', 'slug')->ignore($category->id)],
        ]);

        $category->update([
            'code' => strtoupper(trim($request->code)),
            'name' => trim($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : $category->slug,
            'description' => $request->description,
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLog::log('UPDATE', 'ArticleCategory', $category->id, ['code' => $category->code, 'name' => $category->name]);

        return redirect()->route('backoffice.article-categories.index')->with('success', "Kategori artikel '{$category->name}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $category = ArticleCategory::withCount('articles')->findOrFail($id);

        if ($category->articles_count > 0) {
            return back()->withErrors(['category' => "Kategori '{$category->name}' masih digunakan oleh {$category->articles_count} artikel dan tidak dapat dihapus."]);
        }

        $name = $category->name;
        $category->delete();

        AuditLog::log('DELETE', 'ArticleCategory', $category->id, ['name' => $name]);

        return redirect()->route('backoffice.article-categories.index')->with('success', "Kategori '{$name}' berhasil dihapus.");
    }
}
