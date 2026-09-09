@extends('layouts.app')

@section('title', ($project->meta_title ?: $project->title) . ' - Portofolio PT. Anugerah Tama Sejati')
@section('meta_description', $project->meta_description ?: ($project->summary ?: 'Rincian proyek rekayasa panel dan pekerjaan kelistrikan ' . $project->title))

@section('content')
<div class="bg-slate-50 py-6 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Beranda</a>
            <span>&rsaquo;</span>
            <a href="{{ route('projects.index') }}" class="hover:text-rose-600 transition">Portofolio Proyek</a>
            <span>&rsaquo;</span>
            <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $project->title }}</span>
        </nav>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 space-y-10">
    <!-- Project Header -->
    <div class="space-y-4">
        <div class="flex flex-wrap items-center gap-2">
            @if($project->category)
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-200">
                    {{ $project->category->name }}
                </span>
            @endif
            @if($project->location)
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                    Lokasi: {{ $project->location }}
                </span>
            @endif
            @if($project->completion_year)
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                    Selesai: {{ $project->completion_year }}
                </span>
            @endif
        </div>

        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
            {{ $project->title }}
        </h1>

        @if($project->summary)
        <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-medium">
            {{ $project->summary }}
        </p>
        @endif
    </div>

    <!-- Main Project Cover Image -->
    @if($project->coverImage)
    <div class="rounded-3xl overflow-hidden shadow-md border border-slate-200 h-96 sm:h-[450px]">
        <img src="{{ route('media.view', $project->cover_image_id) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
    </div>
    @endif

    <!-- Scope of Work Box (if exists) -->
    @if($project->scope_of_work)
    <div class="p-6 rounded-3xl bg-blue-50/70 border border-blue-100 space-y-2">
        <h3 class="text-xs font-bold uppercase tracking-wider text-blue-900 flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            Ruang Lingkup Pekerjaan (Scope of Work)
        </h3>
        <div class="text-sm text-blue-950 whitespace-pre-line leading-relaxed">
            {{ $project->scope_of_work }}
        </div>
    </div>
    @endif

    <!-- WYSIWYG Content Description -->
    @if($project->content_html)
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10">
        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base">
            {!! $project->content_html !!}
        </div>
    </div>
    @endif

    <!-- Project Gallery Multi-Image -->
    @if($project->galleryUsages->isNotEmpty())
    <div class="space-y-4">
        <h3 class="text-xl font-bold text-slate-900">Dokumentasi Foto Proyek</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($project->galleryUsages as $g)
                @if($g->media)
                <div class="h-60 rounded-2xl overflow-hidden border border-slate-200 shadow-xs bg-slate-100">
                    <img src="{{ route('media.view', $g->media_id) }}" alt="Dokumentasi" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- CTA Consultation -->
    <div class="p-8 rounded-3xl bg-slate-900 text-white flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="text-lg sm:text-xl font-bold">Memiliki Kebutuhan Perakitan Serupa?</h3>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Konsultasikan gambar diagram satu garis (SLD) dan BoQ Anda dengan tim rekayasa kami.</p>
        </div>
        <a href="{{ route('contact.index') }}" class="px-6 py-3.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shrink-0 transition">
            Hubungi Tim Engineering
        </a>
    </div>
</div>
@endsection
