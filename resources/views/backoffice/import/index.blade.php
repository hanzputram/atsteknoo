@extends('backoffice.layouts.app')

@section('title', 'Import Center Produk')
@section('header', 'Import Center')

@section('content')
<div class="space-y-8">
    <!-- Top Action Bar & Download Tools -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Import & Update Massal Produk</h2>
            <p class="text-sm text-slate-500">Kelola katalog produk dalam skala besar menggunakan spreadsheet Excel (.xlsx)</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('backoffice.import.template') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Unduh Template Produk (.xlsx)
            </a>
            <a href="{{ route('backoffice.import.export') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 font-semibold text-xs rounded-xl transition">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Katalog Lengkap (.xlsx)
            </a>
        </div>
    </div>

    <!-- Grid: Form Upload & Petunjuk Kontrak Data -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Form Upload -->
        <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-slate-900 mb-1">Unggah Berkas Impor</h3>
            <p class="text-xs text-slate-500 mb-5">Pilih mode pencocokan dan unggah file .xlsx</p>

            <form action="{{ route('backoffice.import.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Mode Pencocokan SKU <span class="text-red-500">*</span></label>
                    <select name="mode" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                        <option value="upsert" selected>Upsert (Rekomendasi - Buat Baru & Perbarui)</option>
                        <option value="create_only">Create Only (Hanya Buat SKU Baru)</option>
                        <option value="update_only">Update Only (Hanya Perbarui SKU Existing)</option>
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Upsert otomatis mendeteksi apakah SKU sudah ada atau belum.</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pilih File Excel (.xlsx) <span class="text-red-500">*</span></label>
                    <input type="file" name="file" accept=".xlsx" required class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-1">Maksimal 20 MiB. Pastikan berformat .xlsx standar.</p>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        Validasi & Buka Preview
                    </button>
                </div>
            </form>
        </div>

        <!-- Panduan Aturan Impor -->
        <div class="lg:col-span-2 bg-slate-50/80 rounded-2xl border border-slate-200/80 p-6 space-y-4 text-xs text-slate-600">
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Aturan & Kontrak Pengisian Data
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-xs">
                    <h4 class="font-bold text-slate-800 mb-1">1. Format SKU Teks</h4>
                    <p>Kolom <code>sku</code> wajib berupa teks (Text). Prefix huruf, nol depan (misal: <code>000123</code>), dan tanda hubung (<code>FORT-AB-001</code>) tetap dipertahankan secara utuh.</p>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-xs">
                    <h4 class="font-bold text-slate-800 mb-1">2. Gambar Google Drive</h4>
                    <p>Mendukung link share publik Google Drive pada kolom <code>link_gdrive</code> & <code>gallery_links</code>. Gambar diunduh dan disimpan aman ke media server lokal.</p>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-xs">
                    <h4 class="font-bold text-slate-800 mb-1">3. Sel Kosong vs __CLEAR__</h4>
                    <p>Sel kosong pada update berarti <strong>mempertahankan</strong> nilai lama. Untuk menghapus nilai field opsional secara sengaja, isi sel dengan token <code>__CLEAR__</code>.</p>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-xs">
                    <h4 class="font-bold text-slate-800 mb-1">4. Sheet Spesifikasi Teknis</h4>
                    <p>Spesifikasi teknis diisi pada sheet <code>product_specifications</code> dengan pasangan SKU + attribute_code. Dukungan operasi <code>upsert</code> dan <code>remove</code>.</p>
                </div>
            </div>

            <div class="p-3 bg-amber-50 text-amber-800 rounded-xl border border-amber-200/70 text-[11px] flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span><strong>Kebijakan Non-Transaksional:</strong> Kolom penjualan seperti harga, diskon, dan stok otomatis diabaikan karena katalog ini murni portofolio & spesifikasi engineering.</span>
            </div>
        </div>
    </div>

    <!-- Riwayat Pekerjaan Impor (Import Job History) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-base font-bold text-slate-900">Riwayat Pekerjaan Impor</h3>
                <p class="text-xs text-slate-500">Daftar berkas impor yang pernah diproses oleh tim</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">ID Job</th>
                        <th class="py-3.5 px-6">Nama File</th>
                        <th class="py-3.5 px-6">Mode</th>
                        <th class="py-3.5 px-6">Hasil Validasi</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Pengunggah</th>
                        <th class="py-3.5 px-6">Waktu</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($history as $job)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-4 px-6 font-mono text-xs font-bold text-slate-700">#{{ $job->id }}</td>
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <span class="truncate block max-w-xs" title="{{ $job->file_name }}">{{ $job->file_name }}</span>
                            <span class="text-[11px] text-slate-400 font-normal">{{ number_format($job->file_size / 1024, 1) }} KB</span>
                        </td>
                        <td class="py-4 px-6 text-xs uppercase font-mono font-medium text-slate-600">{{ $job->mode }}</td>
                        <td class="py-4 px-6 text-xs">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-700 font-semibold">{{ $job->valid_rows }} valid</span>
                                @if($job->error_rows > 0)
                                    <span class="text-rose-600 font-semibold">&bull; {{ $job->error_rows }} error</span>
                                @endif
                                <span class="text-slate-400">/ {{ $job->total_rows }} total</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if($job->status === 'completed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                            @elseif($job->status === 'ready')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">Siap Dieksekusi</span>
                            @elseif($job->status === 'processing')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">Memproses...</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">Gagal</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">{{ $job->user->name ?? 'Sistem' }}</td>
                        <td class="py-4 px-6 text-xs text-slate-500">{{ $job->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('backoffice.import.preview', $job->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-xs font-semibold transition">
                                    Detail / Preview
                                </a>
                                @if($job->error_report_path)
                                <a href="{{ route('backoffice.import.error-report', $job->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg text-xs font-semibold transition" title="Unduh Laporan Kesalahan">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Report
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-slate-400">Belum ada riwayat berkas impor. Silakan unggah file baru di atas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($history->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $history->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
