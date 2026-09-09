<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\AuditLog;
use App\Models\Tag;
use App\Services\HtmlSanitizerService;
use App\Services\MediaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'thumbnail', 'author']);

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($catId = $request->input('category_id')) {
            $query->where('category_id', $catId);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $articles = $query->latest('updated_at')->paginate(20)->withQueryString();
        $categories = ArticleCategory::orderBy('name')->get();

        return view('backoffice.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = ArticleCategory::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('backoffice.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:articles,slug'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content_html' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:article_categories,id'],
            'thumbnail' => ['nullable', 'image', 'max:10240'],
            'status' => ['required', 'in:draft,published,archived'],
            'scheduled_at' => ['nullable', 'date'],
        ]);

        $thumbnailId = null;
        if ($request->hasFile('thumbnail')) {
            $media = MediaService::storeUpload($request->file('thumbnail'), 'image');
            $thumbnailId = $media->id;
        }

        $cleanContent = HtmlSanitizerService::clean($request->input('content_html'));

        // Publish validation checks
        if ($request->status === 'published' && (!$thumbnailId || !$request->category_id || empty($cleanContent))) {
            return back()->withInput()->withErrors(['status' => 'Thumbnail, Kategori, dan Konten wajib diisi sebelum publikasi.']);
        }

        $publishedAt = null;
        if ($request->status === 'published') {
            if ($request->filled('scheduled_at')) {
                $publishedAt = Carbon::parse($request->scheduled_at);
            } else {
                $publishedAt = now();
            }
        }

        $article = Article::create([
            'title' => trim($request->title),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'excerpt' => $request->excerpt ?: Str::limit(strip_tags($cleanContent), 160),
            'content_html' => $cleanContent,
            'thumbnail_id' => $thumbnailId,
            'thumbnail_alt' => $request->thumbnail_alt ?: $request->title,
            'category_id' => $request->category_id,
            'author_id' => auth()->id(),
            'author_display_name' => $request->author_display_name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->status,
            'published_at' => $publishedAt,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        if ($request->filled('tags')) {
            $article->tags()->sync($request->tags);
        }

        AuditLog::log('CREATE', 'Article', $article->id, ['title' => $article->title]);

        return redirect()->route('backoffice.articles.index')->with('success', "Artikel '{$article->title}' berhasil disimpan.");
    }

    public function edit(int $id)
    {
        $article = Article::with(['category', 'thumbnail', 'tags'])->findOrFail($id);
        $categories = ArticleCategory::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('backoffice.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, int $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($article->id)],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        $thumbnailId = $article->thumbnail_id;
        if ($request->hasFile('thumbnail')) {
            $media = MediaService::storeUpload($request->file('thumbnail'), 'image');
            $thumbnailId = $media->id;
        }

        $cleanContent = HtmlSanitizerService::clean($request->input('content_html'));

        if ($request->status === 'published' && (!$thumbnailId || !$request->category_id || empty($cleanContent))) {
            return back()->withInput()->withErrors(['status' => 'Thumbnail, Kategori, dan Konten wajib diisi sebelum publikasi.']);
        }

        $publishedAt = $article->published_at;
        if ($request->status === 'published') {
            if ($request->filled('scheduled_at')) {
                $publishedAt = Carbon::parse($request->scheduled_at);
            } elseif (!$publishedAt) {
                $publishedAt = now();
            }
        }

        $article->update([
            'title' => trim($request->title),
            'slug' => $request->slug ? Str::slug($request->slug) : $article->slug,
            'excerpt' => $request->excerpt ?: Str::limit(strip_tags($cleanContent), 160),
            'content_html' => $cleanContent,
            'thumbnail_id' => $thumbnailId,
            'thumbnail_alt' => $request->thumbnail_alt ?: $request->title,
            'category_id' => $request->category_id,
            'author_display_name' => $request->author_display_name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->status,
            'published_at' => $publishedAt,
            'lock_version' => $article->lock_version + 1,
            'updated_by' => auth()->id(),
        ]);

        $article->tags()->sync($request->tags ?? []);

        AuditLog::log('UPDATE', 'Article', $article->id, ['title' => $article->title]);

        return redirect()->route('backoffice.articles.index')->with('success', "Artikel '{$article->title}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);
        $title = $article->title;
        $article->delete();

        AuditLog::log('DELETE', 'Article', $article->id, ['title' => $title]);

        return redirect()->route('backoffice.articles.index')->with('success', "Artikel '{$title}' berhasil dihapus.");
    }
}
