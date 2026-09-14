@extends('layouts.app')

@section('title', 'Articles & Electrical Engineering Insights - PT. Anugerah Tama Sejati')
@section('meta_description', 'Technical articles, switchboard component selection guides, electrical safety standards, and industry news by the engineering team at PT. Anugerah Tama Sejati.')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">
                <span class="ats-lang-en">Articles &amp; Engineering Insights</span>
                <span class="ats-lang-id">Artikel &amp; Panduan Rekayasa</span>
            </span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                    <span class="ats-lang-en">Technical Knowledge Base</span>
                    <span class="ats-lang-id">Pusat Pengetahuan Teknis</span>
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    <span class="ats-lang-en">Articles &amp; Industry Insights</span>
                    <span class="ats-lang-id">Artikel &amp; Wawasan Industri</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl">
                    <span class="ats-lang-en">Technical engineering guides, power protection maintenance tips, and latest advancements in industrial automation.</span>
                    <span class="ats-lang-id">Panduan rekayasa teknis, tips perawatan proteksi kelistrikan, dan perkembangan terkini otomasi industri.</span>
                </p>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('articles.index') }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ !request('category') && !request('tag') ? 'bg-rose-600 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} transition">
                    <span class="ats-lang-en">All</span><span class="ats-lang-id">Semua</span>
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ request('category') === $cat->slug ? 'bg-rose-600 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} transition">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
        </div>

        @if(request('tag'))
        <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center gap-2 text-xs">
            <span class="text-slate-500 font-medium">Filter Topik Rekayasa:</span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-200 font-bold">
                #{{ request('tag') }}
                <a href="{{ route('articles.index', array_filter(['category' => request('category'), 'search' => request('search')])) }}" class="hover:text-rose-800 ml-1 text-sm font-black" title="Hapus filter">&times;</a>
            </span>
        </div>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $art)
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden group">
            <a href="{{ route('articles.show', $art->slug) }}" class="h-52 bg-slate-100 relative overflow-hidden block">
                <img src="{{ $art->thumbnail_url }}" alt="{{ $art->thumbnail_alt ?: $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.onerror=null; this.src='{{ asset('images/projects/project-1-substation.jpg') }}';">

                @if($art->category)
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/95 backdrop-blur-xs text-slate-800 shadow-xs">
                        {{ $art->category->name }}
                    </span>
                @endif
            </a>

            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                        <span>{{ $art->published_at ? $art->published_at->format('d F Y') : $art->created_at->format('d F Y') }}</span>
                        <span>&bull;</span>
                        <span class="font-semibold text-slate-600">{{ $art->author_display_name ?: 'ATS Engineering Team' }}</span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-rose-600 transition leading-snug mb-3">
                        <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                    </h3>

                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-4">
                        {{ $art->excerpt }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    @php
                        $articleWords = str_word_count(strip_tags($art->content_html ?? ''));
                        $readMinutes = max(1, (int) ceil($articleWords / 200));
                    @endphp
                    <span class="text-xs font-semibold text-slate-400">
                        <span class="ats-lang-en">{{ $readMinutes }} min read</span>
                        <span class="ats-lang-id">{{ $readMinutes }} menit baca</span>
                    </span>
                    <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-700 transition">
                        <span class="ats-lang-en">Read Article &rarr;</span>
                        <span class="ats-lang-id">Baca Artikel &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-slate-400">
            <span class="ats-lang-en">No published articles found.</span>
            <span class="ats-lang-id">Belum ada artikel yang dipublikasikan.</span>
        </div>
        @endforelse
    </div>

    @if($articles->total() > 0)
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
