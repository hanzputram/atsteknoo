@extends('layouts.app')

@section('title', ($brand->meta_title ?: $brand->name) . ' - Official Distributor PT. Anugerah Tama Sejati')
@section('meta_description', $brand->meta_description ?: 'Official product catalog and technical specifications for ' . $brand->name . ' - PT. Anugerah Tama Sejati.')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Home</a>
            <span>&rsaquo;</span>
            <a href="{{ route('price-list.index') }}" class="hover:text-rose-600 transition">Price List &amp; Catalogs</a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">{{ $brand->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                @if($brand->logo_url)
                <div class="w-24 h-24 rounded-2xl bg-white p-3 border border-slate-200 shadow-xs flex items-center justify-center shrink-0">
                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain">
                </div>
                @endif
                <div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $brand->name }}</h1>
                    <p class="text-sm text-slate-600 mt-1 max-w-2xl">
                        Official catalog and technical specifications for {{ $brand->name }} industrial components.
                    </p>
                </div>
            </div>

            @if($brand->website_url)
            <div>
                <a href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold shadow-xs transition">
                    <span>Visit Official Website</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $prod)
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col overflow-hidden group">
            <a href="{{ route('products.show', $prod->slug) }}" class="h-56 bg-slate-50/70 p-6 flex items-center justify-center relative overflow-hidden border-b border-slate-100">
                @if($prod->mainImage)
                    <img src="{{ route('media.view', $prod->main_image_id) }}" alt="{{ $prod->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition duration-300">
                @else
                    <span class="text-slate-300 text-xs font-mono">No Image</span>
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
                    <span class="text-xs font-semibold text-emerald-700">BoQ Ready</span>
                    <a href="{{ route('products.show', $prod->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-700 transition">
                        View Details &rarr;
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-slate-400 text-sm">
            No active products found for this brand.
        </div>
        @endforelse
    </div>

    @if($products->hasPages())
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
