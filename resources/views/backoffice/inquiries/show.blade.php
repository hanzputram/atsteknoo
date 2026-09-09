@extends('backoffice.layouts.app')

@section('title', 'Detail Pesan Masuk')
@section('header', 'Detail Pesan Masuk')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('backoffice.inquiries.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Pesan
        </a>

        <!-- Form Ubah Status -->
        <form action="{{ route('backoffice.inquiries.status', $inquiry->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold px-3 py-1.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white">
                <option value="unread" {{ $inquiry->status === 'unread' ? 'selected' : '' }}>Baru / Belum Dibaca</option>
                <option value="read" {{ $inquiry->status === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                <option value="handled" {{ $inquiry->status === 'handled' ? 'selected' : '' }}>Selesai Ditangani</option>
                <option value="spam" {{ $inquiry->status === 'spam' ? 'selected' : '' }}>Tandai Spam</option>
            </select>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-100 gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-900">{{ $inquiry->subject ?: '(Tanpa Subjek)' }}</h2>
                <div class="text-xs text-slate-400 mt-1">Diterima pada {{ $inquiry->created_at->format('d F Y, pukul H:i:s') }}</div>
            </div>
            <div>
                @if($inquiry->status === 'handled')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai Ditangani</span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">Status: {{ ucfirst($inquiry->status) }}</span>
                @endif
            </div>
        </div>

        <!-- Info Pengirim -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50/70 p-4 rounded-xl border border-slate-100 text-sm">
            <div>
                <span class="text-xs text-slate-400 block mb-0.5">Nama Pengirim</span>
                <span class="font-semibold text-slate-800">{{ $inquiry->name }}</span>
                @if($inquiry->company)
                    <span class="text-xs text-slate-500 block">Perusahaan: {{ $inquiry->company }}</span>
                @endif
            </div>
            <div>
                <span class="text-xs text-slate-400 block mb-0.5">Kontak Pengirim</span>
                <a href="mailto:{{ $inquiry->email }}" class="text-blue-600 hover:underline block">{{ $inquiry->email }}</a>
                @if($inquiry->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" class="text-emerald-600 hover:underline font-mono text-xs block mt-0.5">WhatsApp / Telp: {{ $inquiry->phone }}</a>
                @endif
            </div>
        </div>

        <!-- Isi Pesan -->
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Isi Pesan / Kebutuhan Teknis</h3>
            <div class="p-5 rounded-xl bg-white border border-slate-200 text-slate-800 whitespace-pre-line leading-relaxed text-sm">
                {{ $inquiry->message }}
            </div>
        </div>

        <!-- Tindakan Balas -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->subject) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Balas via Email
                </a>
                @if($inquiry->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}?text={{ urlencode('Halo Bapak/Ibu ' . $inquiry->name . ', terima kasih telah menghubungi PT. Anugerah Tama Sejati.') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                    Hubungi via WhatsApp
                </a>
                @endif
            </div>

            @if(auth()->user()->isAdmin())
            <form action="{{ route('backoffice.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Hapus Pesan</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
