@extends('layouts.app')

@section('title', 'Artikel & Berita Teknik Kelistrikan - PT. Anugerah Tama Sejati')
@section('meta_description', 'Artikel teknis, panduan pemilihan komponen switchboard, standar keselamatan kelistrikan, dan kabar industri oleh tim rekayasa PT. Anugerah Tama Sejati.')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Beranda</a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">Artikel &amp; Edukasi Teknik</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                    Technical Knowledge Base
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Artikel &amp; Wawasan Industri</h1>
                <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl">
                    Panduan teknis, tips pemeliharaan proteksi daya, dan inovasi terkini dalam otomasi industri.
                </p>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('articles.index') }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ !request('category') ? 'bg-rose-600 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} transition">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ request('category') === $cat->slug ? 'bg-rose-600 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} transition">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $art)
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden group">
            <a href="{{ route('articles.show', $art->slug) }}" class="h-52 bg-slate-100 relative overflow-hidden block">
                @if($art->thumbnail)
                    <img src="{{ route('media.view', $art->thumbnail_id) }}" alt="{{ $art->thumbnail_alt ?: $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs font-mono">No Thumbnail</div>
                @endif

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
                        @if($art->author)
                            <span>&bull;</span>
                            <span>{{ $art->author_display_name ?: $art->author->name }}</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-rose-600 transition leading-snug mb-3">
                        <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                    </h3>

                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-4">
                        {{ $art->excerpt }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-400">Waktu Baca ~3 menit</span>
                    <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-700 transition">
                        Baca Artikel &rarr;
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-slate-400">
            Belum ada artikel yang dipublikasikan.
        </div>
        @endforelse
    </div>

    @if($articles->hasPages())
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
