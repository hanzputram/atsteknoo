@extends('layouts.app')

@section('title', '403 - Access Denied / Akses Ditolak - PT. Anugerah Tama Sejati')
@section('robots', 'noindex, nofollow')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-24 sm:py-32 text-center">
    <div class="w-20 h-20 rounded-3xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-6 text-3xl font-black">
        403
    </div>
    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-3">
        <span class="ats-lang-en">Access Denied (Forbidden)</span>
        <span class="ats-lang-id">Akses Ditolak (Forbidden)</span>
    </h1>
    <p class="text-sm sm:text-base text-slate-600 max-w-md mx-auto mb-8">
        <span class="ats-lang-en">You do not have permission to access this area or action. Please check your credentials or log in with an authorized role.</span>
        <span class="ats-lang-id">Anda tidak memiliki izin untuk mengakses area atau tindakan ini. Silakan periksa kembali akun Anda atau masuk dengan peran yang sesuai.</span>
    </p>
    <div class="flex flex-wrap items-center justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-sm transition">
            <span class="ats-lang-en">Return to Home</span>
            <span class="ats-lang-id">Kembali ke Beranda</span>
        </a>
        <a href="{{ route('backoffice.login') }}" class="px-6 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-xl shadow-xs transition">
            <span class="ats-lang-en">Backoffice Login</span>
            <span class="ats-lang-id">Masuk Backoffice</span>
        </a>
    </div>
</div>
@endsection
