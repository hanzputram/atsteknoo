@extends('layouts.app')

@section('title', 'Official Price List & Brand Catalogs 2026 - PT. Anugerah Tama Sejati')
@section('meta_description', 'Browse and download official electrical price lists and product catalogs from authorized global principals: Schneider Electric, GAE, Vinsa, DV Electric, Legrand, Socomec, and Autonics.')

@section('content')
<!-- ========================================================
     HEADER BANNER & BREADCRUMBS
     ======================================================== -->
<div class="bg-gradient-to-b from-slate-50 via-white to-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition flex items-center gap-1 font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span data-i18n="pricelist.breadcrumb_home">Home</span>
            </a>
            <span class="text-slate-400">&rsaquo;</span>
            <span class="text-slate-900 font-bold" data-i18n="pricelist.breadcrumb_current">Price List &amp; Catalogs</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3" data-i18n="pricelist.badge">
                    OFFICIAL PRICE LIST &amp; PRINCIPAL CATALOGS
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight" data-i18n="pricelist.title">
                    Official Price List &amp; Catalogs
                </h1>
                <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed" data-i18n="pricelist.subtitle">
                    Browse and download the latest official price lists directly from principal manufacturers (Schneider Electric, GAE, Vinsa, DV Electric). Download complete PDF catalogs for project tender estimation, BoQ budgeting, and industrial electrical component procurement.
                </p>
            </div>

            <!-- Real-time Search Box & Counter (Moved Up) -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto shrink-0">
                <!-- Search Input -->
                <div class="relative min-w-[280px] sm:min-w-[320px]">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text"
                           id="priceSearchInput"
                           onkeyup="filterPriceCards()"
                           placeholder="Search catalog, series, or brand..."
                           data-i18n-placeholder-en="Search catalog, series, or brand..."
                           data-i18n-placeholder-id="Cari katalog, seri, atau brand..."
                           class="w-full pl-9 pr-8 py-3 bg-white border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/15 transition shadow-xs">
                    <button type="button"
                            id="clearSearchBtn"
                            onclick="clearPriceSearch()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 hidden">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Results Counter -->
                <span id="priceListCount" class="px-4 py-3 bg-white text-slate-700 text-xs font-bold rounded-xl border border-slate-200 text-center whitespace-nowrap shadow-xs">
                    <span id="priceCountNum">{{ count($priceLists) }}</span> <span class="ats-lang-en">Catalogs</span><span class="ats-lang-id">Katalog</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-14">

    <!-- ========================================================
         OFFICIAL PRICELIST GRID (LISTRIKONLINE STYLE + ATS POLISH)
         ======================================================== -->
    <section class="space-y-6" id="pricelists">

        <!-- Quick Filter Brand Buttons -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none" id="brandFilterBar">
            <button type="button"
                    onclick="filterByBrand('all', this)"
                    class="brand-filter-btn active px-4 py-2 rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap">
                <span class="ats-lang-en">All Brands</span><span class="ats-lang-id">Semua Brand</span>
            </button>
            <button type="button"
                    onclick="filterByBrand('Schneider Electric', this)"
                    class="brand-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap">
                Schneider Electric
            </button>
            <button type="button"
                    onclick="filterByBrand('GAE', this)"
                    class="brand-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap">
                GAE
            </button>

            <button type="button"
                    onclick="filterByBrand('Vinsa', this)"
                    class="brand-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap">
                Vinsa
            </button>
            <button type="button"
                    onclick="filterByBrand('DV Electric', this)"
                    class="brand-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap">
                DV Electric
            </button>
        </div>

        <!-- Price List Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-7" id="priceGrid">
            @forelse($priceLists as $item)
            <article class="price-item-card bg-white rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-rose-300 transition-all duration-300 flex flex-col overflow-hidden group"
                     data-brand="{{ $item->brand_name }}"
                     data-title="{{ strtolower($item->title) }}"
                     data-desc="{{ strtolower($item->description) }}"
                     data-year="{{ $item->edition_year }}">

                <!-- Cover Image Container (Aspect 16:10 with Hover Zoom) -->
                <a href="{{ $item->view_url }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="relative aspect-[16/10] bg-slate-100 overflow-hidden block"
                   aria-label="Open {{ $item->title }} in a new tab">
                    <img src="{{ $item->image_asset_url }}"
                         alt="Cover thumbnail: {{ $item->title }}"
                         width="800"
                         height="500"
                         loading="lazy"
                         decoding="async"
                         onerror="this.onerror=null;this.src='{{ asset('images/pricelists/placeholder.png') }}';"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <!-- Floating Badges -->
                    <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider bg-slate-900/90 backdrop-blur-sm text-white shadow-xs">
                            {{ $item->brand_name }}
                        </span>
                        @if($item->edition_year)
                        <span class="px-2 py-1 rounded-md text-[10px] font-black tracking-wider bg-rose-600 text-white shadow-xs">
                            {{ $item->edition_year }}
                        </span>
                        @endif
                    </div>

                    <!-- Tax Status Pill -->
                    @if($item->tax_note)
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold backdrop-blur-md shadow-xs {{ str_contains(strtolower($item->tax_note), 'termasuk') ? 'bg-emerald-600/90 text-white' : 'bg-slate-900/80 text-amber-300' }}">
                            @if(str_contains(strtolower($item->tax_note), 'belum') || str_contains(strtolower($item->tax_note), 'excl') || str_contains(strtolower($item->tax_note), 'tidak'))
                                <span class="ats-lang-en">Excl. 11% VAT</span><span class="ats-lang-id">{{ $item->tax_note }}</span>
                            @else
                                <span class="ats-lang-en">Incl. 11% VAT</span><span class="ats-lang-id">{{ $item->tax_note }}</span>
                            @endif
                        </span>
                    </div>
                    @endif

                    <!-- Subtle Dark Scrim on Hover -->
                    <div class="absolute inset-0 bg-slate-950/0 group-hover:bg-slate-950/15 transition-colors duration-300"></div>
                </a>

                <!-- Card Body -->
                <div class="p-5 sm:p-6 flex flex-col flex-1 gap-3">
                    <!-- Title -->
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-rose-600 transition-colors leading-snug">
                        <a href="{{ $item->view_url }}" target="_blank" rel="noopener noreferrer">
                            {{ $item->title }}
                        </a>
                    </h3>

                    <!-- Meta Description -->
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed font-normal">
                        {{ $item->description }}
                    </p>

                    <!-- Scope / Category Pill -->
                    @if($item->category)
                    <div class="mt-auto pt-2">
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-500 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100 truncate max-w-full">
                            📁 {{ $item->category }}
                        </span>
                    </div>
                    @endif

                    <!-- Actions (Matching listrikonline layout elevated with ATS styling) -->
                    <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-stretch sm:items-center gap-2 mt-auto">
                        <!-- View PDF ↗ -->
                        <a href="{{ $item->view_url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200/80 hover:border-transparent transition-all shadow-xs flex-1">
                            <span class="ats-lang-en">View PDF</span><span class="ats-lang-id">Lihat PDF</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>

                        <!-- Download Button -->
                        <a href="{{ $item->effective_download_url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-800 border border-slate-200 hover:border-slate-300 transition-all shadow-xs flex-1">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span class="ats-lang-en">Download</span><span class="ats-lang-id">Unduh</span>
                        </a>

                        <!-- WhatsApp Special Quotation / BoQ Support Button -->
                        <a href="https://wa.me/6282223332830?text=Halo%20PT%20Anugerah%20Tama%20Sejati,%20saya%20tertarik%20dengan%20{{ urlencode($item->title) }}%20dan%20ingin%20konsultasi%20diskon%20proyek%20/%20penawaran%20BoQ"
                           target="_blank"
                           rel="noopener noreferrer"
                           title="Inquire Project Discount via WhatsApp"
                           data-i18n-title-en="Inquire Project Discount via WhatsApp"
                           data-i18n-title-id="Tanya Diskon Proyek via WhatsApp"
                           class="inline-flex items-center justify-center p-2.5 rounded-xl text-emerald-600 hover:text-white bg-emerald-50 hover:bg-emerald-600 border border-emerald-200/80 transition-all shadow-xs shrink-0"
                           aria-label="WhatsApp">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-slate-200/80">
                <span class="ats-lang-en">No active official price lists found.</span>
                <span class="ats-lang-id">Belum ada data katalog price list resmi yang aktif.</span>
            </div>
            @endforelse
        </div>

        <!-- No Results Fallback for JavaScript Search -->
        <div id="noSearchResults" class="hidden py-16 text-center bg-white rounded-3xl border border-slate-200/80">
            <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h4 class="text-base font-bold text-slate-800" data-i18n="pricelist.empty_title">No matching catalogs found</h4>
            <p class="text-xs text-slate-500 mt-1" data-i18n="pricelist.empty_desc">Try another keyword or select the All Brands option.</p>
            <button type="button" onclick="clearPriceSearch()" class="mt-4 px-4 py-2 bg-rose-600 text-white rounded-xl text-xs font-bold hover:bg-rose-700 transition" data-i18n="pricelist.empty_reset">
                Reset Search
            </button>
        </div>
    </section>

    <!-- ========================================================
         BRAND PRINCIPALS DIRECTORY & CATALOGS
         ======================================================== -->
    <section class="space-y-6 pt-4 border-t border-slate-200/80" id="brands">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-rose-600" data-i18n="pricelist.brands_badge">BRAND DIRECTORY</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1" data-i18n="pricelist.brands_title">
                    Explore by Brand Principal
                </h2>
            </div>
            <p class="text-xs sm:text-sm text-slate-500" data-i18n="pricelist.brands_sub">
                Select a brand to view technical specifications and official distributor product lines.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($brands as $b)
            @if(strtolower($b->slug ?? '') !== 'fort' && strtolower($b->name ?? '') !== 'fort')
            <a href="{{ route('price-list.show', $b->slug) }}" class="bg-white rounded-3xl border border-slate-200/80 p-6 flex flex-col items-center justify-between text-center shadow-xs hover:shadow-xl hover:border-rose-300 transition-all duration-300 group min-h-[220px]">
                
                <!-- Brand Official Logo Container -->
                <div class="h-20 w-full flex items-center justify-center p-2 mb-2">
                    @if($b->logo_url)
                        <img src="{{ $b->logo_url }}" alt="{{ $b->name }} Logo" class="max-h-full max-w-[85%] object-contain group-hover:scale-110 transition-transform duration-300">
                    @else
                        <span class="text-lg font-black text-slate-800 tracking-tight font-mono group-hover:text-rose-600 transition">{{ $b->name }}</span>
                    @endif
                </div>

                <!-- Brand Details -->
                <div class="w-full pt-3 border-t border-slate-100 space-y-1">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-rose-600 transition truncate">
                        {{ $b->name }}
                    </h3>
                    
                    <div class="flex items-center justify-center gap-2 text-xs text-slate-500">
                        @if($b->products_count > 0)
                            <span class="font-medium text-slate-600">{{ $b->products_count }} <span class="ats-lang-en">Products</span><span class="ats-lang-id">Produk</span></span>
                            <span>&bull;</span>
                        @endif
                        <span class="text-rose-600 font-bold group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-1">
                            <span class="ats-lang-en">View Catalog &rarr;</span><span class="ats-lang-id">Lihat Katalog &rarr;</span>
                        </span>
                    </div>
                </div>

            </a>
            @endif
            @empty
            <div class="col-span-full py-16 text-center text-slate-400">
                <span class="ats-lang-en">No active brand catalogs found.</span>
                <span class="ats-lang-id">Tidak ditemukan katalog brand aktif.</span>
            </div>
            @endforelse
        </div>
    </section>

    <!-- ========================================================
         BOTTOM CTA: DIRECT INQUIRY & BOQ SUPPORT
         ======================================================== -->
    <div class="bg-slate-50 rounded-3xl p-8 sm:p-10 border border-slate-200/80 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 text-center md:text-left">
            <span class="text-xs font-black uppercase tracking-widest text-rose-600" data-i18n="pricelist.cta_badge">TENDER &amp; BOQ SUBMISSION</span>
            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight" data-i18n="pricelist.cta_title">
                Need Tender Support Letters or Special Project Quotations?
            </h3>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl" data-i18n="pricelist.cta_desc">
                Submit your Bill of Quantities (BoQ) or material specifications. Our Sales Engineering team is ready to assist with official distributor discounts and manufacturer support letters.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3 shrink-0">
            <a href="https://wa.me/6282223332830?text=Halo%20PT%20Anugerah%20Tama%20Sejati,%20saya%20ingin%20mengajukan%20BoQ%20dan%20meminta%20penawaran%20harga%20khusus%20proyek"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm rounded-xl shadow-md transition">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span data-i18n="pricelist.cta_btn_wa">Consult BoQ on WhatsApp</span>
            </a>

            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-5 py-3.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 font-bold text-sm rounded-xl transition">
                <span data-i18n="pricelist.cta_btn_contact">Contact Head Office</span>
            </a>
        </div>
    </div>

</div>

<!-- ========================================================
     CLIENT-SIDE FILTER & REAL-TIME SEARCH SCRIPT
     ======================================================== -->
<script>
    let currentSelectedBrand = 'all';

    function filterByBrand(brand, btnElement) {
        currentSelectedBrand = brand;

        // Update active class on filter buttons
        document.querySelectorAll('.brand-filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        if (btnElement) {
            btnElement.classList.add('active');
        }

        filterPriceCards();
    }

    function filterPriceCards() {
        const query = document.getElementById('priceSearchInput').value.toLowerCase().trim();
        const clearBtn = document.getElementById('clearSearchBtn');
        if (query.length > 0) {
            clearBtn.classList.remove('hidden');
        } else {
            clearBtn.classList.add('hidden');
        }

        const cards = document.querySelectorAll('.price-item-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const cardBrand = card.getAttribute('data-brand') || '';
            const cardTitle = card.getAttribute('data-title') || '';
            const cardDesc = card.getAttribute('data-desc') || '';
            const cardYear = card.getAttribute('data-year') || '';

            // Brand match
            const brandMatch = (currentSelectedBrand === 'all') || (cardBrand.toLowerCase().includes(currentSelectedBrand.toLowerCase()));

            // Text search match
            const textMatch = query === '' || 
                              cardTitle.includes(query) || 
                              cardDesc.includes(query) || 
                              cardBrand.toLowerCase().includes(query) ||
                              cardYear.includes(query);

            if (brandMatch && textMatch) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Update count
        const countBadge = document.getElementById('priceListCount');
        if (countBadge) {
            countBadge.innerHTML = `<span id="priceCountNum">${visibleCount}</span> <span class="ats-lang-en">Catalogs</span><span class="ats-lang-id">Katalog</span>`;
        }

        // Show/hide empty state
        const noResults = document.getElementById('noSearchResults');
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    function clearPriceSearch() {
        document.getElementById('priceSearchInput').value = '';
        currentSelectedBrand = 'all';
        document.querySelectorAll('.brand-filter-btn').forEach((btn, index) => {
            if (index === 0) btn.classList.add('active');
            else btn.classList.remove('active');
        });
        filterPriceCards();
    }

    window.addEventListener('atsLanguageChanged', function() {
        filterPriceCards();
    });
</script>

<style>
    .brand-filter-btn {
        background-color: #FFFFFF;
        color: #475569;
        border: 1px solid #E2E8F0;
    }
    .brand-filter-btn:hover {
        background-color: #F8FAFC;
        color: #0F172A;
        border-color: #CBD5E1;
    }
    .brand-filter-btn.active {
        background-color: #E11D48;
        color: #FFFFFF;
        border-color: #E11D48;
    }
    .scrollbar-none::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-none {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection
