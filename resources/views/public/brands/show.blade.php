@extends('layouts.app')

@php
    $isSchneider = ($brand->slug === 'schneider-electric' || $brand->slug === 'schneider');

    // Page Title
    if ($isSchneider) {
        $brandTitle = 'Supplier Schneider Electric Surabaya | ATS Tekno';
    } elseif ($brand->meta_title) {
        $brandTitle = preg_replace('/\s*\|\s*(PT\.?\s*Anugerah\s*Tama\s*Sejati|ATS\s*Tekno).*$/i', '', $brand->meta_title);
        $brandTitle = trim($brandTitle) . ' | ATS Tekno';
    } else {
        $brandTitle = "Supplier {$brand->name} Surabaya | ATS Tekno";
    }

    // H1 Heading
    if ($isSchneider) {
        $brandH1 = 'Supplier Schneider Electric di Surabaya';
    } else {
        $brandH1 = "Supplier {$brand->name} di Surabaya";
    }

    $rawDesc = $brand->meta_description ?: ('Katalog resmi dan spesifikasi teknis komponen elektrikal industri ' . $brand->name . ' dari distributor resmi PT. Anugerah Tama Sejati di Surabaya.');
    $cleanDesc = \App\Support\TextSanitizer::cleanDescription($rawDesc);

    $brandSchema = [
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
                        'name' => 'Price List & Catalogs',
                        'item' => route('price-list.index'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 3,
                        'name' => $brand->name,
                        'item' => route('brands.show', $brand->slug),
                    ]
                ]
            ],
            array_filter([
                '@type' => 'Brand',
                'name' => $brand->name,
                'url' => route('brands.show', $brand->slug),
                'logo' => $brand->logo_url ?: null,
                'description' => $cleanDesc,
            ])
        ]
    ];

    $brandSchemaJson = json_encode(
        $brandSchema,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
    );
@endphp

@section('title', $brandTitle)
@section('meta_description', $cleanDesc)
@section('canonical', route('brands.show', $brand->slug))

@push('schema')
<script type="application/ld+json">
{!! $brandSchemaJson !!}
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
            <a href="{{ route('price-list.index') }}" class="hover:text-rose-600 transition">
                <span class="ats-lang-en">Price List &amp; Catalogs</span><span class="ats-lang-id">Daftar Harga &amp; Katalog</span>
            </a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">{{ $brand->name }}</span>
        </nav>

        <!-- Top Hero Row: Brand Info Left, Action Buttons Right -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-5 sm:gap-6">
                @if($brand->logo_url)
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-white p-3 border border-slate-200 shadow-xs flex items-center justify-center shrink-0">
                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain">
                </div>
                @endif
                <div>
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $brandH1 }}</h1>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-200">
                            <span class="ats-lang-en">Authorized Partner</span>
                            <span class="ats-lang-id">Mitra Resmi</span>
                        </span>
                    </div>
                    <p class="text-sm text-slate-600 mt-1.5 max-w-2xl">
                        <span class="ats-lang-en">Official catalog, stock availability, and technical specifications for {{ $brand->name }} industrial components.</span>
                        <span class="ats-lang-id">Katalog resmi, ketersediaan stok, dan spesifikasi teknis komponen elektrikal industri {{ $brand->name }}.</span>
                    </p>
                </div>
            </div>

            <!-- Action Buttons (Never Squeezed) -->
            <div class="flex items-center gap-3 shrink-0 flex-wrap">
                @if($brand->website_url)
                <a href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-slate-300 text-xs font-bold shadow-xs transition whitespace-nowrap">
                    <span class="ats-lang-en">Visit Official Website</span>
                    <span class="ats-lang-id">Kunjungi Website Resmi</span>
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
                @endif

                <a href="https://wa.me/6282223332830?text={{ urlencode('Halo PT. Anugerah Tama Sejati, saya ingin konsultasi & minta penawaran harga produk ' . $brand->name) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs transition whitespace-nowrap">
                    <svg class="w-4 h-4 shrink-0 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span class="ats-lang-en">Request Quote</span>
                    <span class="ats-lang-id">Minta Penawaran</span>
                </a>
            </div>
        </div>

        <!-- Full Width Separator and Rich Description Section -->
        @if($brand->description_html)
        <div class="mt-8 pt-8 border-t border-slate-200/80">
            <div class="wysiwyg-content prose prose-slate max-w-none text-sm text-slate-700 leading-relaxed">
                {!! $brand->description_html !!}
            </div>
        </div>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
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
                        <span class="ats-lang-en">View Details &rarr;</span><span class="ats-lang-id">Lihat Detail &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-slate-400 text-sm">
            <span class="ats-lang-en">No active products found for this brand.</span>
            <span class="ats-lang-id">Belum ada produk aktif untuk brand ini.</span>
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
