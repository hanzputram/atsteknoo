@extends('layouts.app')

@section('title', ($product->meta_title ?: $product->name) . ' - PT. Anugerah Tama Sejati')
@section('meta_description', $product->meta_description ?: ($product->short_description ?: 'Technical specifications for ' . $product->name . ' from authorized distributor PT. Anugerah Tama Sejati.'))

@section('content')
<div class="bg-slate-50 py-6 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center flex-wrap gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Home</a>
            <span>&rsaquo;</span>
            <a href="{{ route('products.index') }}" class="hover:text-rose-600 transition">Products</a>
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
                        <span class="text-xs font-mono uppercase">No Image Available</span>
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

            <!-- Action Buy at ListrikOnline & Consultation -->
            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                <!-- Red Button: Buy at ListrikOnline -->
                <a href="https://listrikonline.com/products/{{ $product->sku }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-black text-sm rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Buy at ListrikOnline</span>
                    <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>

                @php
                    $waText = "Hello Sales & Engineering Team PT. Anugerah Tama Sejati,\nI would like to inquire about technical specifications and a quote for:\n- Product: {$product->name}\n- SKU: {$product->sku}\n\nPlease share stock availability and BoQ details.";
                @endphp
                <a href="https://wa.me/6282223332830?text={{ urlencode($waText) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-3.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/90 font-bold text-sm rounded-2xl shadow-xs transition">
                    <svg class="w-4 h-4 text-emerald-600 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>Consult BoQ</span>
                </a>

                @if($product->datasheet)
                <a href="{{ route('media.view', $product->datasheet_id) }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-3.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 font-bold text-sm rounded-2xl shadow-xs transition">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Download Datasheet (PDF)</span>
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
                <h2 class="text-xl font-bold text-slate-900">Technical Specifications &amp; Parameters</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50/80 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200/80">
                            <th class="py-3 px-5">Parameter Group</th>
                            <th class="py-3 px-5">Characteristic / Label</th>
                            <th class="py-3 px-5">Technical Value</th>
                            <th class="py-3 px-5">Unit</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($product->specifications as $spec)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                {{ $spec->group ?: 'General' }}
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
                <h2 class="text-xl font-bold text-slate-900">Product Overview &amp; Description</h2>
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
        <h2 class="text-2xl font-bold text-slate-900 mb-8">Related Industrial Products</h2>

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
                        <a href="{{ route('products.show', $rel->slug) }}" class="font-bold text-rose-600">View Details &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
