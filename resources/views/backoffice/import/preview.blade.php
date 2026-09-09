@extends('backoffice.layouts.app')

@section('title', 'Preview Rencana Impor #' . $job->id)
@section('header', 'Preview Impor Produk')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb & Header Info -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('backoffice.import.index') }}" class="hover:text-blue-600 transition">Import Center</a>
                <span>&rsaquo;</span>
                <span>Job #{{ $job->id }}</span>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Validasi & Rencana Impor: {{ $job->file_name }}</h2>
            <p class="text-sm text-slate-500">Mode: <span class="font-mono uppercase font-semibold text-slate-700">{{ $job->mode }}</span> &bull; Diunggah oleh: {{ $job->user->name ?? 'Staf' }}</p>
        </div>

        <div class="flex items-center gap-3">
            @if($job->error_report_path)
            <a href="{{ route('backoffice.import.error-report', $job->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold rounded-xl transition">
                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Unduh Laporan Error Excel (.xlsx)
            </a>
            @endif
            <a href="{{ route('backoffice.import.index') }}" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold rounded-xl transition">
                Kembali
            </a>
        </div>
    </div>

    <!-- Summary KPI Cards -->
    @php
        $createCount = 0;
        $updateCount = 0;
        $unchangedCount = 0;
        $errorCount = 0;
        foreach($units as $u) {
            if (!($u['valid'] ?? false)) {
                $errorCount++;
            } elseif (($u['action'] ?? '') === 'create') {
                $createCount++;
            } elseif (($u['action'] ?? '') === 'update') {
                $updateCount++;
            } else {
                $unchangedCount++;
            }
        }
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
            <span class="text-xs text-slate-400 font-medium block">Total Unit Baris</span>
            <span class="text-2xl font-bold text-slate-900 mt-1 block">{{ count($units) }}</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
            <span class="text-xs text-emerald-600 font-medium block">Akan Dibuat (New)</span>
            <span class="text-2xl font-bold text-emerald-600 mt-1 block">{{ $createCount }}</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
            <span class="text-xs text-blue-600 font-medium block">Akan Diperbarui</span>
            <span class="text-2xl font-bold text-blue-600 mt-1 block">{{ $updateCount }}</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
            <span class="text-xs text-slate-500 font-medium block">Tidak Berubah</span>
            <span class="text-2xl font-bold text-slate-600 mt-1 block">{{ $unchangedCount }}</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
            <span class="text-xs text-rose-600 font-medium block">Unit Bermasalah</span>
            <span class="text-2xl font-bold text-rose-600 mt-1 block">{{ $errorCount }}</span>
        </div>
    </div>

    <!-- Alert Box if Errors -->
    @if($errorCount > 0)
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 flex items-start gap-3">
        <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="text-xs text-rose-800 space-y-1">
            <p class="font-bold">Ditemukan {{ $errorCount }} unit SKU dengan kesalahan validasi atau konflik.</p>
            <p>Anda dapat mengunduh laporan error, memperbaiki file di Excel, lalu mengunggah kembali. Atau centang opsi <strong>"Import hanya baris valid"</strong> di bawah untuk mengeksekusi {{ count($units) - $errorCount }} unit yang lolos verifikasi.</p>
        </div>
    </div>
    @endif

    <!-- Form Eksekusi / Konfirmasi -->
    @if($job->status !== 'completed')
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
        <form action="{{ route('backoffice.import.execute', $job->id) }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            @csrf

            <div class="space-y-2">
                @if($errorCount > 0)
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="skip_errors" value="1" required class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-xs font-semibold text-slate-700">Saya memahami dan ingin mengimpor hanya baris yang valid ({{ count($units) - $errorCount }} unit)</span>
                </label>
                @else
                <div class="flex items-center gap-2 text-xs text-emerald-700 font-semibold">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Semua unit tervalidasi dan siap untuk diterapkan ke database.
                </div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Konfirmasi & Terapkan Perubahan
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 font-semibold flex items-center gap-2">
        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        Pekerjaan impor ini telah berhasil dieksekusi dan disimpan ke katalog produk.
    </div>
    @endif

    <!-- Unit Preview Table / List -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-base font-bold text-slate-900">Rincian Per Unit SKU</h3>
                <p class="text-xs text-slate-500">Periksa aksi, nama, media staged, dan spesifikasi per produk</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">SKU / Normalisasi</th>
                        <th class="py-3.5 px-6">Aksi Direncanakan</th>
                        <th class="py-3.5 px-6">Nama Produk</th>
                        <th class="py-3.5 px-6">Brand & Kategori</th>
                        <th class="py-3.5 px-6">Media Utama & Galeri</th>
                        <th class="py-3.5 px-6">Spesifikasi Teknis</th>
                        <th class="py-3.5 px-6">Status Validasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($units as $u)
                    <tr class="hover:bg-slate-50/60 transition {{ !($u['valid'] ?? false) ? 'bg-rose-50/20' : '' }}">
                        <td class="py-4 px-6 font-mono text-xs font-bold text-slate-800">
                            {{ $u['sku'] }}
                        </td>
                        <td class="py-4 px-6">
                            @if(($u['action'] ?? '') === 'create')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">+ Baru</span>
                            @elseif(($u['action'] ?? '') === 'update')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">&bull; Update</span>
                            @elseif(($u['action'] ?? '') === 'unchanged')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">Sama</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">Error</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            {{ $u['payload']['name'] ?? '(Nama Kosong / Belum Ada)' }}
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">
                            <div>Brand ID: {{ $u['payload']['brand_id'] ?? '-' }}</div>
                            <div class="text-[11px] text-slate-400">Kategori: {{ count($u['payload']['category_ids'] ?? []) }} dipilih</div>
                        </td>
                        <td class="py-4 px-6 text-xs">
                            <div class="flex items-center gap-2">
                                @if(!empty($u['payload']['staged_main_image_id']))
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                                        <img src="{{ route('media.view', $u['payload']['staged_main_image_id']) }}" class="w-full h-full object-contain" alt="Preview">
                                    </div>
                                    <span class="text-emerald-600 font-semibold text-[11px]">Ada Gambar</span>
                                @else
                                    <span class="text-slate-400 text-[11px]">(Tanpa Gambar Baru)</span>
                                @endif
                            </div>
                            @if(!empty($u['payload']['staged_gallery_ids']))
                                <div class="text-[10px] text-slate-500 mt-1">+ {{ count($u['payload']['staged_gallery_ids']) }} galeri staged</div>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">
                            {{ count($u['payload']['specifications'] ?? []) }} item
                        </td>
                        <td class="py-4 px-6">
                            @if($u['valid'] ?? false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">Lolos</span>
                            @else
                                <div class="space-y-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-50 text-rose-700">Gagal</span>
                                    @foreach($u['errors'] ?? [] as $err)
                                        <div class="text-[11px] text-rose-600 font-normal leading-tight">{{ $err }}</div>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400">Tidak ada baris data pada rencana ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
