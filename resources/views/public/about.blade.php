@extends('layouts.app')

@section('title', ($page->meta_title ?? 'About Us') . ' - PT. Anugerah Tama Sejati')
@section('meta_description', $page->meta_description ?? 'Profil resmi PT. Anugerah Tama Sejati, distributor resmi komponen elektrikal industri di Surabaya, Indonesia.')

@section('content')
<div class="bg-slate-50 py-12 sm:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Beranda</a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">Tentang Kami</span>
        </nav>

        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                Corporate Profile
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
                {{ $page->title ?? 'Tentang PT. Anugerah Tama Sejati' }}
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mt-3 max-w-3xl leading-relaxed">
                Mitra terpercaya pengadaan komponen kelistrikan industri, panel builder, dan solusi distribusi tenaga listrik di seluruh Indonesia.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 space-y-16">
    <!-- Vision & Mission Grid -->
    @if(!empty($page->sections_data))
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @if(!empty($page->sections_data['vision']))
        <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-xs space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900">Visi Perusahaan</h3>
            <p class="text-sm text-slate-600 leading-relaxed">
                {{ $page->sections_data['vision'] }}
            </p>
        </div>
        @endif

        @if(!empty($page->sections_data['mission']))
        <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-xs space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900">Misi Perusahaan</h3>
            <p class="text-sm text-slate-600 leading-relaxed">
                {{ $page->sections_data['mission'] }}
            </p>
        </div>
        @endif
    </div>
    @endif

    <!-- Main Content WYSIWYG -->
    @if(!empty($page->content_html))
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-8 sm:p-12">
        <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed">
            {!! $page->content_html !!}
        </div>
    </div>
    @endif

    <!-- Partner Brands Showcase -->
    @if($brands->isNotEmpty())
    <div class="space-y-8">
        <div class="text-center max-w-xl mx-auto">
            <span class="text-xs font-bold uppercase tracking-wider text-rose-600">Jaringan Prinsipal</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Mitra Pabrikan Resmi</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-2">Komponen asli bergaransi dari produsen kelistrikan kelas dunia.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($brands as $b)
            <a href="{{ route('brands.show', $b->slug) }}" class="bg-white p-4 rounded-2xl border border-slate-200/80 hover:border-rose-300 shadow-xs hover:shadow-md transition flex items-center justify-center h-20 group">
                @if($b->logo)
                    <img src="{{ route('media.view', $b->logo_id) }}" alt="{{ $b->name }}" class="max-h-full max-w-[80%] object-contain group-hover:scale-105 transition">
                @else
                    <span class="text-xs font-black text-slate-700 font-mono">{{ $b->name }}</span>
                @endif
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
