<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class BlogArticleController extends Controller
{
    /**
     * Display published articles listing.
     */
    public function index(Request $request)
    {
        $query = Article::published()->with(['category', 'thumbnail', 'author']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($catSlug = $request->input('category')) {
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        if ($tagSlug = $request->input('tag')) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        $perPage = (int) $request->input('per_page', 9);
        if ($perPage < 1 || $perPage > 100) {
            $perPage = 9;
        }

        $articles = $query->latest('published_at')->paginate($perPage)->withQueryString();
        $categories = ArticleCategory::active()->orderBy('name')->get();

        return view('public.articles.index', compact('articles', 'categories'));
    }

    /**
     * Display individual article reading page.
     */
    public function show(string $slug)
    {
        $article = Article::published()
            ->with(['category', 'thumbnail', 'tags', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->take(3)
            ->get();

        return view('public.articles.show', compact('article', 'relatedArticles'));
    }
}
