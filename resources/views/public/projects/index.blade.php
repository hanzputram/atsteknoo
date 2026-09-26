@extends('layouts.app')

@section('title', 'Engineering Projects Portfolio - PT. Anugerah Tama Sejati')
@section('meta_description', 'Portfolio of low-voltage switchboard manufacturing, plant electrical distribution, and industrial automation installations by PT. Anugerah Tama Sejati.')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">
                <span class="ats-lang-en">Engineering Portfolio</span><span class="ats-lang-id">Portofolio Rekayasa</span>
            </span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                    <span class="ats-lang-en">Engineering Portfolio</span>
                    <span class="ats-lang-id">Portofolio Rekayasa</span>
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    <span class="ats-lang-en">Projects &amp; Panel Manufacturing</span>
                    <span class="ats-lang-id">Proyek &amp; Fabrikasi Panel Listrik</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl">
                    <span class="ats-lang-en">Proven track record in low-voltage switchboard assembly, generator-grid synchronization, and industrial electrical solutions nationwide.</span>
                    <span class="ats-lang-id">Rekam jejak terpercaya dalam perakitan panel distribusi tegangan rendah, sinkronisasi genset, dan solusi kelistrikan industri di seluruh Indonesia.</span>
                </p>
            </div>

            <!-- Categories Filter -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('projects.index') }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ !request('category') ? 'bg-rose-600 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} transition">
                    <span class="ats-lang-en">All Categories</span><span class="ats-lang-id">Semua Kategori</span>
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('projects.index', ['category' => $cat->slug]) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ request('category') === $cat->slug ? 'bg-rose-600 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} transition">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $p)
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden group">
            <!-- Cover Image -->
            <a href="{{ route('projects.show', $p->slug) }}" class="h-60 bg-slate-100 relative overflow-hidden block">
                @if($p->coverImage)
                    <img src="{{ route('media.view', $p->cover_image_id) }}" alt="{{ $p->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <img src="{{ $p->image_url }}" alt="{{ $p->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="w-full h-full items-center justify-center text-slate-400 text-xs font-mono" style="display:none;">No Image</div>
                @endif

                @if($p->category)
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/95 backdrop-blur-xs text-slate-800 shadow-xs">
                        {{ $p->category->name }}
                    </span>
                @endif
            </a>

            <!-- Card Body -->
            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <!-- Meta Info: Location & Year -->
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-2">
                        @if($p->location)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                {{ $p->location }}
                            </span>
                        @endif
                        @if($p->completion_year)
                            <span>&bull;</span>
                            <span><span class="ats-lang-en">Year</span><span class="ats-lang-id">Tahun</span> {{ $p->completion_year }}</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-rose-600 transition leading-snug mb-3">
                        <a href="{{ route('projects.show', $p->slug) }}">{{ $p->title }}</a>
                    </h3>

                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-4">
                        {{ $p->summary }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-400">
                        <span class="ats-lang-en">Engineering Scope</span>
                        <span class="ats-lang-id">Lingkup Rekayasa</span>
                    </span>
                    <a href="{{ route('projects.show', $p->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-700 transition">
                        <span class="ats-lang-en">View Project &rarr;</span>
                        <span class="ats-lang-id">Lihat Proyek &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-slate-400">
            <span class="ats-lang-en">No active projects found.</span>
            <span class="ats-lang-id">Belum ada portofolio proyek yang ditemukan.</span>
        </div>
        @endforelse
    </div>

    @if($projects->total() > 0)
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $projects->links() }}
    </div>
    @endif
</div>
@endsection
