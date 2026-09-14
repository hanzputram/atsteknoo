@extends('layouts.app')

@section('title', 'Industrial Electrical Products Catalog - PT. Anugerah Tama Sejati')
@section('meta_description', 'Explore our comprehensive catalog of industrial electrical equipment: ACB, MCCB, Inverters, Contactors, and panel accessories from Schneider, Legrand, Socomec, GAE.')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Home</span><span class="ats-lang-id">Beranda</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">
                <span class="ats-lang-en">Product Catalog</span><span class="ats-lang-id">Katalog Produk</span>
            </span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                    <span class="ats-lang-en">Industrial Catalog</span>
                    <span class="ats-lang-id">Katalog Industri</span>
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    <span class="ats-lang-en">Electrical Components Catalog</span>
                    <span class="ats-lang-id">Katalog Komponen Elektrikal</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl">
                    <span class="ats-lang-en">Discover technical specifications and genuine switchgear, automation, and power distribution components meeting international standards.</span>
                    <span class="ats-lang-id">Temukan spesifikasi teknis dan komponen switchgear, otomasi, serta distribusi daya original yang memenuhi standar internasional.</span>
                </p>
            </div>

            <!-- Stats Badge -->
            <div class="bg-white px-5 py-3 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4 shrink-0">
                <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">
                        <span class="ats-lang-en">Total Active Products</span>
                        <span class="ats-lang-id">Total Produk Aktif</span>
                    </span>
                    <span class="text-xl font-bold text-slate-900 block">
                        {{ $products->total() }} <span class="ats-lang-en">Components</span><span class="ats-lang-id">Komponen</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    <!-- Search & Filter Controls -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs mb-8">
        <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search Keyword -->
            <div class="lg:col-span-1">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    <span class="ats-lang-en">Search Product / SKU</span>
                    <span class="ats-lang-id">Cari Produk / SKU</span>
                </label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           data-i18n-placeholder-en="Type product name or SKU..."
                           data-i18n-placeholder-id="Ketik nama produk atau SKU..."
                           placeholder="Type product name or SKU..."
                           class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Brand Filter -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    <span class="ats-lang-en">Filter Brand</span>
                    <span class="ats-lang-id">Pilih Brand</span>
                </label>
                <select name="brand" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm bg-white">
                    <option value="" {{ empty(request('brand')) ? 'selected' : '' }}>Brand Utama (Schneider, Vinsa, Supreme, GAE, Legrand)</option>
                    <option value="all" {{ request('brand') === 'all' ? 'selected' : '' }}>Semua Brand (Seluruh Katalog)</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->slug }}" {{ request('brand') === $b->slug ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    <span class="ats-lang-en">Category</span>
                    <span class="ats-lang-id">Kategori</span>
                </label>
                <select name="category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm bg-white">
                    <option value="">All Categories / Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sorting & Submit -->
            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        <span class="ats-lang-en">Sort Order</span>
                        <span class="ats-lang-id">Urutan</span>
                    </label>
                    <select name="sort" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm bg-white">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest / Terbaru</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A - Z)</option>
                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name (Z - A)</option>
                        <option value="sku_asc" {{ request('sort') === 'sku_asc' ? 'selected' : '' }}>SKU (A - Z)</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm rounded-xl transition shadow-xs">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'brand', 'category', 'sort']))
                <a href="{{ route('products.index', request()->filled('per_page') ? ['per_page' => request('per_page')] : []) }}" class="p-2.5 border border-slate-200 hover:bg-slate-50 text-slate-500 rounded-xl transition" title="Reset Filter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </a>
                @endif
                <input type="hidden" name="per_page" value="{{ request('per_page', 25) }}">
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $prod)
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col overflow-hidden group">
            <!-- Product Image Container with contain -->
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

            <!-- Product Card Body -->
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <!-- SKU & Category -->
                    <div class="flex items-center justify-between text-xs text-slate-400 font-mono mb-2">
                        <span class="text-slate-500 font-semibold">{{ $prod->sku }}</span>
                        @if($prod->primaryCategory)
                            <span class="truncate max-w-[120px] font-sans">{{ $prod->primaryCategory->name }}</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition text-base leading-snug line-clamp-2 mb-2">
                        <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                    </h3>

                    <!-- Short Description -->
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                        {{ $prod->short_description ?: 'Industrial quality electrical components meeting international standards.' }}
                    </p>
                </div>

                <!-- Footer Action Row -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="ats-lang-en">Technical Specs</span>
                        <span class="ats-lang-id">Spesifikasi Teknis</span>
                    </span>
                    <a href="{{ route('products.show', $prod->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-700 group-hover:translate-x-0.5 transition">
                        <span class="ats-lang-en">View Details &rarr;</span>
                        <span class="ats-lang-id">Lihat Detail &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-base font-bold text-slate-800">
                <span class="ats-lang-en">No products found</span>
                <span class="ats-lang-id">Tidak ada produk yang ditemukan</span>
            </h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                <span class="ats-lang-en">Try different search keywords or reset filter options.</span>
                <span class="ats-lang-id">Coba kata kunci pencarian yang berbeda atau atur ulang opsi filter.</span>
            </p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition">
                <span class="ats-lang-en">Reset Search</span>
                <span class="ats-lang-id">Reset Pencarian</span>
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->total() > 0)
    <div class="mt-12 pt-6 border-t border-slate-200">
        {{ $products->onEachSide(1)->links() }}
    </div>
    @endif
</div>
@endsection
