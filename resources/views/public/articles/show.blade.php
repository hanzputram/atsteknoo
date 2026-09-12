@extends('layouts.app')

@section('title', ($article->meta_title ?: $article->title) . ' - PT. Anugerah Tama Sejati')
@section('meta_description', $article->meta_description ?: ($article->excerpt ?: 'Artikel teknis kelistrikan ' . $article->title))

@section('content')
<div class="bg-slate-50 py-6 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <a href="{{ route('articles.index') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Articles</span><span class="ats-lang-id">Artikel</span>
            </a>
            @if($article->category)
                <span>&rsaquo;</span>
                <span class="text-slate-600">{{ $article->category->name }}</span>
            @endif
            <span>&rsaquo;</span>
            <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $article->title }}</span>
        </nav>
    </div>
</div>

<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    <!-- Article Header -->
    <header class="space-y-4 mb-8">
        @if($article->category)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-200">
                {{ $article->category->name }}
            </span>
        @endif

        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
            {{ $article->title }}
        </h1>

        <div class="flex items-center gap-4 text-xs text-slate-500 pt-2 border-t border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-600">
                    {{ strtoupper(substr($article->author_display_name ?: ($article->author->name ?? 'ATS'), 0, 1)) }}
                </div>
                <div>
                    <span class="font-bold text-slate-800 block">{{ $article->author_display_name ?: ($article->author->name ?? 'Tim Engineering ATS') }}</span>
                    <span class="text-[11px] text-slate-400">
                        <span class="ats-lang-en">Technical Writer</span>
                        <span class="ats-lang-id">Penulis Teknis</span>
                    </span>
                </div>
            </div>
            <span>&bull;</span>
            <time datetime="{{ $article->published_at ? $article->published_at->toIso8601String() : '' }}">
                {{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}
            </time>
        </div>
    </header>

    <!-- Featured Thumbnail -->
    @if($article->thumbnail)
    <div class="rounded-3xl overflow-hidden shadow-sm border border-slate-200 mb-10 h-72 sm:h-96">
        <img src="{{ route('media.view', $article->thumbnail_id) }}" alt="{{ $article->thumbnail_alt ?: $article->title }}" class="w-full h-full object-cover">
    </div>
    @endif

    <!-- Main Content Body (Sanitized WYSIWYG) -->
    <div class="wysiwyg-content prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed">
        {!! $article->content_html !!}
    </div>

    <!-- Tags List -->
    @if($article->tags->isNotEmpty())
    <div class="mt-12 pt-6 border-t border-slate-200 flex flex-wrap items-center gap-2">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-2">
            <span class="ats-lang-en">Related Topics:</span>
            <span class="ats-lang-id">Topik Terkait:</span>
        </span>
        @foreach($article->tags as $t)
            <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold">
                #{{ $t->name }}
            </span>
        @endforeach
    </div>
    @endif

    <!-- Back to Articles Button -->
    <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-rose-600 transition">
            <span class="ats-lang-en">&larr; Back to Articles</span>
            <span class="ats-lang-id">&larr; Kembali ke Daftar Artikel</span>
        </a>
    </div>
</article>

<!-- Related Articles Section -->
@if($relatedArticles->isNotEmpty())
<div class="bg-slate-50 border-t border-slate-200/80 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-8">
            <span class="ats-lang-en">Related Articles</span>
            <span class="ats-lang-id">Artikel Terkait</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $rel)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 flex flex-col justify-between group">
                <div>
                    <span class="text-[11px] text-slate-400 block mb-1">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</span>
                    <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition text-sm mb-2">
                        <a href="{{ route('articles.show', $rel->slug) }}">{{ $rel->title }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 line-clamp-2">{{ $rel->excerpt }}</p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 text-right">
                    <a href="{{ route('articles.show', $rel->slug) }}" class="text-xs font-bold text-rose-600">
                        <span class="ats-lang-en">Read &rarr;</span>
                        <span class="ats-lang-id">Baca &rarr;</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
