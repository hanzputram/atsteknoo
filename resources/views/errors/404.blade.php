@extends('layouts.app')

@section('title', '404 - Page Not Found / Halaman Tidak Ditemukan - PT. Anugerah Tama Sejati')
@section('robots', 'noindex, nofollow')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-24 sm:py-32 text-center">
    <div class="w-20 h-20 rounded-3xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-6 text-3xl font-black">
        404
    </div>
    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-3">
        <span class="ats-lang-en">Page Not Found</span>
        <span class="ats-lang-id">Halaman Tidak Ditemukan</span>
    </h1>
    <p class="text-sm sm:text-base text-slate-600 max-w-md mx-auto mb-8">
        <span class="ats-lang-en">The page or product you are looking for might have been moved, renamed, or is no longer published.</span>
        <span class="ats-lang-id">Halaman atau produk yang Anda cari mungkin telah dipindahkan, diganti tautannya, atau tidak lagi dipublikasikan.</span>
    </p>
    <div class="flex flex-wrap items-center justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
            <span class="ats-lang-en">Return to Home</span>
            <span class="ats-lang-id">Kembali ke Beranda</span>
        </a>
        <a href="{{ route('products.index') }}" class="px-6 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-xl shadow-xs transition">
            <span class="ats-lang-en">Browse Product Catalog</span>
            <span class="ats-lang-id">Jelajahi Katalog Produk</span>
        </a>
    </div>
</div>
@endsection
