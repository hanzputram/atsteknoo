@extends('layouts.app')

@php
    $rawTitle = $article->meta_title ?: $article->title;
    $articleTitle = preg_replace('/\s*[-|]\s*(PT\.?\s*Anugerah\s*Tama\s*Sejati|ATS\s*Tekno).*$/i', '', $rawTitle);
    $articleTitle = trim($articleTitle) . ' | ATS Tekno';

    $rawDesc = $article->meta_description ?: ($article->excerpt ?: ('Artikel panduan kelistrikan: ' . $article->title . ' dari PT. Anugerah Tama Sejati Surabaya.'));
    $cleanDesc = trim(preg_replace('/\s+/', ' ', strip_tags($rawDesc)));

    $articleSchema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => route('home'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => 'Articles',
                        'item' => route('articles.index'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 3,
                        'name' => $article->title,
                        'item' => route('articles.show', $article->slug),
                    ]
                ]
            ],
            array_filter([
                '@type' => 'Article',
                'headline' => $article->title,
                'description' => $cleanDesc,
                'image' => $article->featured_image_url ?: null,
                'datePublished' => optional($article->published_at)->toIso8601String() ?: optional($article->created_at)->toIso8601String(),
                'dateModified' => optional($article->updated_at)->toIso8601String(),
                'author' => [
                    '@type' => 'Organization',
                    'name' => 'PT. Anugerah Tama Sejati',
                    'url' => url('/'),
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'PT. Anugerah Tama Sejati',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('images/ats-logo.png'),
                    ]
                ],
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => route('articles.show', $article->slug),
                ]
            ])
        ]
    ];

    $articleSchemaJson = json_encode(
        $articleSchema,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
    );
@endphp

@section('title', $articleTitle)
@section('meta_description', $cleanDesc)
@section('canonical', route('articles.show', $article->slug))

@push('schema')
<script type="application/ld+json">
{!! $articleSchemaJson !!}
</script>
@endpush

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

        @php
            $wordCount = str_word_count(strip_tags($article->content_html));
            $readMinutes = max(2, ceil($wordCount / 180));
        @endphp

        <div class="flex flex-wrap items-center justify-between gap-4 pt-3 border-t border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="relative w-11 h-11 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 border border-slate-700/80 flex items-center justify-center font-black text-rose-500 text-xs shadow-xs shrink-0">
                    <span>ATS</span>
                    <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-[8px] text-white font-bold" title="Penulis Rekayasa Teknis Terverifikasi">✓</span>
                </div>
                <div>
                    <span class="font-bold text-slate-900 block text-sm leading-tight">{{ $article->author_display_name ?: 'ATS Engineering Team' }}</span>
                    <span class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span class="ats-lang-en">Electrical Specialist &amp; Technical Team</span>
                        <span class="ats-lang-id">Spesialis Elektrikal &amp; Rekayasa Teknis</span>
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-400 bg-slate-100/80 px-3 py-1.5 rounded-xl">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <time datetime="{{ $article->published_at ? $article->published_at->toIso8601String() : '' }}">
                    {{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}
                </time>
                <span>&bull;</span>
                <span>~{{ $readMinutes }} mnt baca</span>
            </div>
        </div>
    </header>

    <!-- Featured Thumbnail -->
    @if($article->thumbnail_url)
    <div class="rounded-3xl overflow-hidden shadow-sm border border-slate-200 mb-10 h-72 sm:h-96">
        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->thumbnail_alt ?: $article->title }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/projects/project-1-substation.jpg') }}';">
    </div>
    @endif

    <!-- Main Content Body (Sanitized WYSIWYG) -->
    <div class="wysiwyg-content prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed">
        {!! $article->content_html !!}
    </div>

    <!-- Tags List -->
    @if($article->tags->isNotEmpty())
    <div class="mt-12 pt-6 border-t border-slate-200">
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-1">
                <span class="ats-lang-en">Related Topics:</span>
                <span class="ats-lang-id">Topik Rekayasa:</span>
            </span>
            @foreach($article->tags as $t)
                <a href="{{ route('articles.index', ['tag' => $t->slug]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-700 hover:text-rose-600 border border-slate-200/80 hover:border-rose-200 text-xs font-semibold transition duration-200">
                    <span class="text-rose-500 font-bold">#</span>
                    <span>{{ $t->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Engineering Consultation Callout Box -->
    <div class="my-10 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-850 to-slate-900 text-white shadow-xl border border-slate-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-8 -mr-8 w-48 h-48 bg-rose-600/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-lg">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-rose-500/20 text-rose-300 border border-rose-500/30">
                    <span>⚡ B2B Engineering Support</span>
                </span>
                <h3 class="text-xl sm:text-2xl font-bold font-outfit text-white tracking-tight">
                    <span class="ats-lang-en">Need Technical Sizing or Component Supply?</span>
                    <span class="ats-lang-id">Butuh Perhitungan Teknis atau Pasokan Komponen?</span>
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    <span class="ats-lang-en">Consult your switchboard component specs, breaker coordination, or Bill of Quantities (BoQ) with our certified electrical engineering team.</span>
                    <span class="ats-lang-id">Konsultasikan kebutuhan komponen panel, koordinasi breaker Schneider/Siemens, atau kalkulasi BoQ proyek Anda bersama certified electrical engineer PT. ATS.</span>
                </p>
            </div>
            <div class="flex flex-col sm:flex-row md:flex-col gap-2.5 shrink-0">
                <a href="https://wa.me/6282223332830?text={{ urlencode('Halo ATS Tekno, saya membaca artikel ' . $article->title . ' dan ingin konsultasi teknis / penawaran BoQ.') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs tracking-wide transition duration-200 shadow-md">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span class="ats-lang-en">Consult via WhatsApp</span>
                    <span class="ats-lang-id">Konsultasi via WhatsApp</span>
                </a>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs tracking-wide transition duration-200 border border-slate-700">
                    <span class="ats-lang-en">Request Formal BoQ &rarr;</span>
                    <span class="ats-lang-id">Minta Penawaran BoQ &rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Share & Navigation Footer -->
    <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-rose-600 transition">
            <span class="ats-lang-en">&larr; Back to Articles</span>
            <span class="ats-lang-id">&larr; Kembali ke Daftar Artikel</span>
        </a>

        <div class="flex items-center gap-2 text-xs">
            <span class="text-slate-400 font-bold mr-1">
                <span class="ats-lang-en">Share:</span>
                <span class="ats-lang-id">Bagikan:</span>
            </span>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition" title="Bagikan ke WhatsApp">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-600 hover:text-white flex items-center justify-center transition" title="Bagikan ke LinkedIn">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
            <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 border border-slate-200 hover:bg-slate-200 flex items-center justify-center transition" title="Salin Tautan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
            </button>
        </div>
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
