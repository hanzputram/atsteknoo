@extends('layouts.app')

@section('title', 'Brand & Prinsipal Resmi - PT. Anugerah Tama Sejati')
@section('meta_description', 'Daftar brand dan prinsipal elektrikal resmi yang didistribusikan oleh PT. Anugerah Tama Sejati: Schneider Electric, ABB, Socomec, Chint, Fort, Uticell.')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Beranda</a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold">Prinsipal Brand</span>
        </nav>

        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-600 border border-rose-200 mb-3">
                Authorized Brands
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Brand &amp; Prinsipal Terkemuka</h1>
            <p class="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl">
                Kemitraan resmi dengan produsen komponen kelistrikan global terpercaya untuk menjamin keaslian 100% dan garansi produk.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($brands as $b)
        <a href="{{ route('brands.show', $b->slug) }}" class="bg-white rounded-2xl border border-slate-200/80 p-6 flex flex-col items-center justify-center text-center shadow-xs hover:shadow-md hover:border-rose-300 transition-all duration-200 group">
            <div class="h-20 w-full flex items-center justify-center mb-4">
                @if($b->logo)
                    <img src="{{ route('media.view', $b->logo_id) }}" alt="{{ $b->name }}" class="max-h-full max-w-[80%] object-contain group-hover:scale-105 transition">
                @else
                    <span class="text-xl font-black text-slate-700 tracking-wider font-mono">{{ $b->name }}</span>
                @endif
            </div>

            <h3 class="font-bold text-slate-900 text-base group-hover:text-rose-600 transition">{{ $b->name }}</h3>
            <span class="text-xs text-slate-400 mt-1">Lihat Katalog Produk &rarr;</span>
        </a>
        @empty
        <div class="col-span-full py-12 text-center text-slate-400">
            Belum ada brand aktif yang ditampilkan.
        </div>
        @endforelse
    </div>
</div>
@endsection
