@extends('layouts.app')

@section('title', ($product->meta_title ?: $product->name) . ' - PT. Anugerah Tama Sejati')
@section('meta_description', $product->meta_description ?: ($product->short_description ?: 'Spesifikasi teknis ' . $product->name . ' dari distributor resmi PT. Anugerah Tama Sejati.'))

@section('content')
<div class="bg-slate-50 py-6 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center flex-wrap gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Beranda</a>
            <span>&rsaquo;</span>
            <a href="{{ route('products.index') }}" class="hover:text-rose-600 transition">Katalog Produk</a>
            @if($product->primaryCategory)
                <span>&rsaquo;</span>
                <a href="{{ route('product-categories.show', $product->primaryCategory->slug) }}" class="hover:text-rose-600 transition">{{ $product->primaryCategory->name }}</a>
            @endif
            <span>&rsaquo;</span>
            <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    <!-- Main Product Grid: Gallery Left, Info Right -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        <!-- Image & Gallery Column (5 cols) -->
        <div class="lg:col-span-5 space-y-4">
            <!-- Main Featured Image Canvas -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-8 flex items-center justify-center h-80 sm:h-96 relative overflow-hidden">
                @if($product->mainImage)
                    <img id="mainProductImg" src="{{ route('media.view', $product->main_image_id) }}" alt="{{ $product->mainImage->alt_text ?? $product->name }}" class="max-h-full max-w-full object-contain transition-all duration-300">
                @else
                    <div class="text-slate-300 flex flex-col items-center gap-2">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-mono uppercase">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Switcher (if gallery exists) -->
            @if($product->galleryUsages->isNotEmpty())
            <div class="flex items-center gap-3 overflow-x-auto pb-2">
                @if($product->mainImage)
                <button type="button" onclick="document.getElementById('mainProductImg').src='{{ route('media.view', $product->main_image_id) }}'" class="w-16 h-16 rounded-xl bg-white border-2 border-rose-500 p-2 flex items-center justify-center shrink-0 hover:opacity-90 transition">
                    <img src="{{ route('media.view', $product->main_image_id) }}" class="max-h-full max-w-full object-contain" alt="Main">
                </button>
                @endif

                @foreach($product->galleryUsages as $g)
                    @if($g->media)
                    <button type="button" onclick="document.getElementById('mainProductImg').src='{{ route('media.view', $g->media_id) }}'" class="w-16 h-16 rounded-xl bg-white border border-slate-200 p-2 flex items-center justify-center shrink-0 hover:border-rose-400 transition">
                        <img src="{{ route('media.view', $g->media_id) }}" class="max-h-full max-w-full object-contain" alt="Gallery">
                    </button>
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        <!-- Product Details Column (7 cols) -->
        <div class="lg:col-span-7 space-y-6">
            <!-- Brand Badge & SKU Row -->
            <div class="flex flex-wrap items-center justify-between gap-3">
                @if($product->brand)
                    <a href="{{ route('brands.show', $product->brand->slug) }}" class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-100 hover:bg-slate-200 text-slate-800 transition">
                        <span>Brand: {{ $product->brand->name }}</span>
                    </a>
                @endif

                <div class="flex items-center gap-2 text-xs font-mono text-slate-500 bg-white px-3 py-1 rounded-lg border border-slate-200">
                    <span class="text-slate-400">SKU:</span>
                    <span class="font-bold text-slate-800">{{ $product->sku }}</span>
                </div>
            </div>

            <!-- Product Title -->
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                {{ $product->name }}
            </h1>

            <!-- Categories Tags -->
            @if($product->categories->isNotEmpty())
            <div class="flex flex-wrap items-center gap-2">
                @foreach($product->categories as $c)
                    <a href="{{ route('product-categories.show', $c->slug) }}" class="text-xs px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium transition">
                        {{ $c->name }}
                    </a>
                @endforeach
            </div>
            @endif

            <!-- Short Summary -->
            @if($product->short_description)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-sm text-slate-700 leading-relaxed">
                {{ $product->short_description }}
            </div>
            @endif

            <!-- Action Consultation & Datasheet -->
            <div class="flex flex-wrap items-center gap-4 pt-2">
                @php
                    $waText = "Halo Tim Sales & Engineering PT. Anugerah Tama Sejati,\nSaya tertarik untuk konsultasi dan penawaran teknis untuk produk:\n- Nama: {$product->name}\n- SKU: {$product->sku}\n\nMohon informasi ketersediaan spesifikasi teknis dan BoQ.";
                @endphp
                <a href="https://wa.me/6281288997788?text={{ urlencode($waText) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-2xl shadow-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    Konsultasi & Permintaan BoQ
                </a>

                @if($product->datasheet)
                <a href="{{ route('media.view', $product->datasheet_id) }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-3.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 font-bold text-sm rounded-2xl shadow-xs transition">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Unduh Datasheet PDF
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Product Details Tabs: Description & Technical Specifications -->
    <div class="mt-16 space-y-10">
        <!-- Technical Specifications Section -->
        @if($product->specifications->isNotEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
            <div class="flex items-center gap-3 pb-4 mb-6 border-b border-slate-100">
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900">Spesifikasi Teknis & Parameter</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50/80 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200/80">
                            <th class="py-3 px-5">Kelompok Parameter</th>
                            <th class="py-3 px-5">Karakteristik / Label</th>
                            <th class="py-3 px-5">Nilai Teknis</th>
                            <th class="py-3 px-5">Satuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($product->specifications as $spec)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                {{ $spec->group ?: 'Umum' }}
                            </td>
                            <td class="py-3.5 px-5 font-semibold text-slate-800">
                                {{ $spec->label }}
                            </td>
                            <td class="py-3.5 px-5 font-mono text-slate-900 font-medium">
                                {{ $spec->value }}
                            </td>
                            <td class="py-3.5 px-5 font-mono text-xs text-slate-500">
                                {{ $spec->unit ?: '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- WYSIWYG Sanitized Description -->
        @if($product->description_html)
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
            <div class="flex items-center gap-3 pb-4 mb-6 border-b border-slate-100">
                <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900">Uraian & Deskripsi Produk</h2>
            </div>

            <div class="prose prose-slate max-w-none text-sm sm:text-base leading-relaxed text-slate-700">
                {!! $product->description_html !!}
            </div>
        </div>
        @endif
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
    <div class="mt-16 pt-12 border-t border-slate-200">
        <h2 class="text-2xl font-bold text-slate-900 mb-8">Produk Terkait Lainnya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $rel)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col overflow-hidden group">
                <a href="{{ route('products.show', $rel->slug) }}" class="h-44 bg-slate-50 p-4 flex items-center justify-center border-b border-slate-100">
                    @if($rel->mainImage)
                        <img src="{{ route('media.view', $rel->main_image_id) }}" alt="{{ $rel->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition">
                    @else
                        <span class="text-slate-300 text-xs font-mono">No Image</span>
                    @endif
                </a>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <span class="text-[11px] text-slate-400 font-mono block mb-1">{{ $rel->sku }}</span>
                        <h4 class="font-bold text-slate-900 text-sm group-hover:text-rose-600 transition line-clamp-2">
                            <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                        </h4>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400">{{ $rel->brand->name ?? '' }}</span>
                        <a href="{{ route('products.show', $rel->slug) }}" class="font-bold text-rose-600">Detail &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
