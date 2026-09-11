@extends('layouts.app')

@section('title', ($category->meta_title ?: $category->name) . ' - Kategori Produk PT. Anugerah Tama Sejati')
@section('meta_description', $category->meta_description ?: ($category->description ?: 'Lihat katalog produk ' . $category->name . ' dari distributor resmi PT. Anugerah Tama Sejati.'))

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
                    <span class="ats-lang-en">Product Category</span><span class="ats-lang-id">Kategori Produk</span>
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $category->name }}</h1>
                <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl">
                    {{ $category->description ?: 'Rangkaian komponen elektrikal dalam klasifikasi ' . $category->name . '.' }}
                </p>
            </div>

            <!-- Subcategories Chips if exist -->
            @if($category->children->isNotEmpty())
            <div class="flex flex-wrap items-center gap-2">
                @foreach($category->children as $sub)
                    <a href="{{ route('product-categories.show', $sub->slug) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-blue-500 hover:text-blue-600 transition shadow-xs">
                        {{ $sub->name }}
                    </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $prod)
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col overflow-hidden group">
            <a href="{{ route('products.show', $prod->slug) }}" class="h-56 bg-slate-50/70 p-6 flex items-center justify-center relative overflow-hidden border-b border-slate-100">
                @if($prod->mainImage)
                    <img src="{{ route('media.view', $prod->main_image_id) }}" alt="{{ $prod->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition duration-300">
                @else
                    <span class="text-slate-300 text-xs font-mono">No Image</span>
                @endif

                @if($prod->brand)
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-wider uppercase bg-white/90 backdrop-blur-xs text-slate-800 border border-slate-200/80 shadow-xs">
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

    @if($products->hasPages())
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
