@extends('layouts.app')

@php
    $rawTitle = $category->meta_title ?: ($category->name . ' - Kategori Produk');
    $categoryTitle = preg_replace('/\s*[-|]\s*(PT\.?\s*Anugerah\s*Tama\s*Sejati|ATS\s*Tekno).*$/i', '', $rawTitle);
    $categoryTitle = trim($categoryTitle) . ' | ATS Tekno';

    $rawDesc = $category->meta_description ?: ($category->description ?: ('Lihat katalog produk ' . $category->name . ' dari distributor resmi PT. Anugerah Tama Sejati Surabaya.'));
    $cleanDesc = \App\Support\TextSanitizer::cleanDescription($rawDesc);

    $categorySchema = [
        '@context' => 'https://schema.org',
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
                'name' => 'Product Catalog',
                'item' => route('products.index'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $category->name,
                'item' => route('product-categories.show', $category->slug),
            ]
        ]
    ];

    $categorySchemaJson = json_encode(
        $categorySchema,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
    );
@endphp

@section('title', $categoryTitle)
@section('meta_description', $cleanDesc)
@section('canonical', request()->has('page') && (int)request('page') > 1 ? route('product-categories.show', [$category->slug, 'page' => request('page')]) : route('product-categories.show', $category->slug))

@push('schema')
<script type="application/ld+json">
{!! $categorySchemaJson !!}
</script>
@endpush

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <a href="{{ route('products.index') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Product Catalog</span><span class="ats-lang-id">Katalog Produk</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">{{ $category->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-blue-50 text-blue-700 border border-blue-200 mb-3">
                    <span class="ats-lang-en">Product Category</span><span class="ats-lang-id">Kategori Produk Proteksi & Distribusi</span>
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    @if($category->slug === 'power-distribution-circuit-breakers')
                        <span class="ats-lang-en">Power Distribution & Circuit Breakers</span>
                        <span class="ats-lang-id">Distribusi Tenaga & Sirkuit Pemutus Listrik (Circuit Breakers)</span>
                    @else
                        {{ $category->name }}
                    @endif
                </h1>
                <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl leading-relaxed">
                    @if($category->slug === 'power-distribution-circuit-breakers')
                        <span class="ats-lang-id">Distributor resmi komponen proteksi dan distribusi tenaga di Surabaya. Tersedia lengkap MCB, MCCB, ACB, RCCB, RCBO, dan Surge Arrester berstandar SNI / IEC dari Schneider Electric, GAE, dan brand terkemuka.</span>
                        <span class="ats-lang-en">{{ $category->description ?: 'Rangkaian komponen elektrikal dalam klasifikasi ' . $category->name . '.' }}</span>
                    @else
                        {{ $category->description ?: 'Rangkaian komponen elektrikal dalam klasifikasi ' . $category->name . '.' }}
                    @endif
                </p>
            </div>

            <!-- Subcategories Chips & Quick Filters -->
            <div class="flex flex-wrap items-center gap-2">
                @if($category->slug === 'power-distribution-circuit-breakers')
                    <a href="{{ route('products.index', ['category' => $category->slug, 'search' => 'MCB']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-rose-500 hover:text-rose-600 transition shadow-2xs">
                        MCB
                    </a>
                    <a href="{{ route('products.index', ['category' => $category->slug, 'search' => 'MCCB']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-rose-500 hover:text-rose-600 transition shadow-2xs">
                        MCCB
                    </a>
                    <a href="{{ route('products.index', ['category' => $category->slug, 'search' => 'ACB']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-rose-500 hover:text-rose-600 transition shadow-2xs">
                        ACB
                    </a>
                    <a href="{{ route('products.index', ['category' => $category->slug, 'search' => 'RCCB']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-rose-500 hover:text-rose-600 transition shadow-2xs">
                        RCCB / ELCB
                    </a>
                    <a href="{{ route('products.index', ['category' => $category->slug, 'search' => 'RCBO']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-rose-500 hover:text-rose-600 transition shadow-2xs">
                        RCBO
                    </a>
                    <a href="{{ route('products.index', ['category' => $category->slug, 'search' => 'Surge']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-rose-500 hover:text-rose-600 transition shadow-2xs">
                        SPD / Arrester
                    </a>
                @endif
                @if($category->children->isNotEmpty())
                    @foreach($category->children as $sub)
                        <a href="{{ route('product-categories.show', $sub->slug) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-blue-500 hover:text-blue-600 transition shadow-2xs">
                            {{ $sub->name }}
                        </a>
                    @endforeach
                @endif
            </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $prod)
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col overflow-hidden group">
            <a href="{{ route('products.show', $prod->slug) }}" class="h-64 sm:h-72 bg-white p-3 sm:p-4 flex items-center justify-center relative overflow-hidden border-b border-slate-100">
                @if($prod->main_image_url)
                    <img src="{{ $prod->main_image_url }}" alt="{{ $prod->mainImage->alt_text ?? $prod->name }}" class="w-full h-full max-h-full max-w-full object-contain group-hover:scale-105 transition duration-300" onerror="this.onerror=null; this.classList.add('hidden'); if(this.nextElementSibling) this.nextElementSibling.classList.remove('hidden');">
                    <div class="hidden text-slate-300 flex flex-col items-center gap-1">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-[10px] font-mono uppercase tracking-wider">No Image</span>
                    </div>
                @else
                    <div class="text-slate-300 flex flex-col items-center gap-1">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-[10px] font-mono uppercase tracking-wider">No Image</span>
                    </div>
                @endif

                @if($prod->brand)
                    <span class="absolute top-3 left-3 z-10 px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-wider uppercase bg-white/95 backdrop-blur-xs text-slate-800 border border-slate-200/80 shadow-xs">
                        {{ $prod->brand->name }}
                    </span>
                @endif
            </a>

            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-xs text-slate-400 font-mono block mb-1">{{ $prod->sku }}</span>
                    <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition text-base leading-snug line-clamp-2 mb-2">
                        <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                        {{ $prod->short_description }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-semibold text-emerald-700">
                        <span class="ats-lang-en">BoQ Ready</span><span class="ats-lang-id">Tersedia BoQ</span>
                    </span>
                    <a href="{{ route('products.show', $prod->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-700 transition">
                        <span class="ats-lang-en">Details &rarr;</span><span class="ats-lang-id">Detail &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-slate-400 text-sm">
            <span class="ats-lang-en">No active products found in this category.</span>
            <span class="ats-lang-id">Belum ada produk aktif dalam kategori ini.</span>
        </div>
        @endforelse
    </div>

    @if($products->total() > 0)
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $products->onEachSide(1)->links() }}
    </div>
    @endif
</div>
@endsection
