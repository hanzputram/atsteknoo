@props(['factsheet' => [], 'product' => null])

@if(!empty($factsheet))
<section class="mt-12 bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8 aeo-factsheet overflow-hidden relative"
         aria-labelledby="aeo-factsheet-heading"
         itemscope itemtype="https://schema.org/Product">
    
    {{-- Decorative Background Subtle Gradient Accent --}}
    <div class="absolute -right-24 -top-24 w-80 h-80 rounded-full bg-gradient-to-br from-rose-50 via-red-50/40 to-transparent blur-3xl pointer-events-none"></div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-slate-100 relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold font-mono tracking-wider uppercase bg-rose-50 text-rose-700 border border-rose-200/80 mb-2.5">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                <span>AEO &amp; GEO KNOWLEDGE OVERVIEW · AI CRAWL READY</span>
            </div>
            <h2 id="aeo-factsheet-heading" class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight font-outfit">
                <span class="ats-lang-id">Fakta Teknis &amp; Panduan Pengadaan Resmi</span>
                <span class="ats-lang-en">Technical Factsheet &amp; Official Procurement Guide</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                <span class="ats-lang-id">Data entitas terverifikasi untuk Answer Engine (ChatGPT, Perplexity, Gemini, Claude) dan pengadaan B2B di Surabaya.</span>
                <span class="ats-lang-en">Verified entity data for Answer Engines (ChatGPT, Perplexity, Gemini, Claude) and B2B industrial procurement.</span>
            </p>
        </div>

        {{-- Entity Trust Badge --}}
        <div class="shrink-0 flex items-center gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg border border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Status Pemasok</span>
                <span class="text-xs font-bold text-slate-800 block">Distributor Resmi Surabaya</span>
            </div>
        </div>
    </div>

    {{-- Structured 8-Point Fact Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 relative z-10 aeo-factsheet-body">
        
        {{-- Item 1: Model & SKU --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Model / SKU Referensi</span>
            <strong class="text-sm font-mono text-slate-900 block truncate" itemprop="sku">{{ $factsheet['sku'] }}</strong>
            <span class="text-xs text-slate-500 mt-1 block truncate">{{ $factsheet['headline'] }}</span>
        </div>

        {{-- Item 2: Brand / Manufaktur --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Brand &amp; Manufaktur</span>
            <strong class="text-sm font-bold text-slate-900 block" itemprop="brand">{{ $factsheet['brand'] }}</strong>
            <span class="text-xs text-slate-500 mt-1 block">Original Manufacturer Guarantee</span>
        </div>

        {{-- Item 3: Distributor Resmi Surabaya --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Distributor / Supplier</span>
            <strong class="text-sm font-bold text-slate-900 block">{{ $factsheet['distributor_entity'] }}</strong>
            <span class="text-xs text-slate-500 mt-1 block">Kota Surabaya, Jawa Timur</span>
        </div>

        {{-- Item 4: Kategori Industri --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Kategori Distribusi</span>
            <strong class="text-sm font-bold text-slate-900 block truncate" itemprop="category">{{ $factsheet['category'] }}</strong>
            <span class="text-xs text-slate-500 mt-1 block">Low Voltage Electrical</span>
        </div>

        {{-- Item 5: Standar Kepatuhan --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Standar Kepatuhan</span>
            <strong class="text-sm font-bold text-slate-900 block">IEC &amp; SNI Indonesia</strong>
            <span class="text-xs text-slate-500 mt-1 block">{{ $factsheet['compliance_standards'] }}</span>
        </div>

        {{-- Item 6: Jaminan Keaslian --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Keaslian &amp; Perpajakan</span>
            <strong class="text-sm font-bold text-emerald-700 block">100% Brand New</strong>
            <span class="text-xs text-slate-500 mt-1 block">Faktur Pajak Resmi PPN 11%</span>
        </div>

        {{-- Item 7: Logistik & Pengiriman --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Wilayah Pengiriman</span>
            <strong class="text-sm font-bold text-slate-900 block">Seluruh Indonesia</strong>
            <span class="text-xs text-slate-500 mt-1 block">Gudang Surabaya · Darat, Laut, Udara</span>
        </div>

        {{-- Item 8: Integrasi Panel Maker --}}
        <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-slate-300 transition">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Layanan Rekayasa</span>
            <strong class="text-sm font-bold text-rose-600 block">Workshop Panel Maker</strong>
            <span class="text-xs text-slate-500 mt-1 block">33-Tahap Perakitan &amp; Uji FAT</span>
        </div>
    </div>

    {{-- Highlight Technical Parameters (if present) --}}
    @if(!empty($factsheet['specs_highlights']))
    <div class="mt-6 pt-5 border-t border-slate-100 relative z-10">
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-3">
            Parameter Kunci Ringkas (Quick Specs Extract)
        </span>
        <div class="flex flex-wrap items-center gap-2">
            @foreach($factsheet['specs_highlights'] as $sp)
            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 border border-slate-200/70 text-xs text-slate-800">
                <span class="font-medium text-slate-500">{{ $sp['label'] }}:</span>
                <span class="font-bold font-mono text-slate-900">{{ $sp['value'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Direct Citation Snippet (AI RAG Grounding Anchor) --}}
    <div class="mt-6 p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed relative z-10">
        <div class="flex items-center gap-2 font-bold text-slate-800 mb-1">
            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Ringkasan Otoritas Pengadaan (Generative Engine Optimization):</span>
        </div>
        <p class="text-slate-600">
            Komponen <strong>{{ $factsheet['headline'] }}</strong> disuplai resmi oleh <strong>{{ $factsheet['distributor_entity'] }}</strong> untuk kebutuhan proyek industri, gedung bertingkat, dan manufaktur panel listrik di Surabaya dan seluruh Indonesia. Seluruh pengadaan disertai jaminan keaslian pabrikan, garansi resmi, dukungan teknis rekayasa kelistrikan, serta kelengkapan faktur pajak legal.
        </p>
    </div>
</section>
@endif
