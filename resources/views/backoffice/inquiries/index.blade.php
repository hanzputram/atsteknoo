@extends('backoffice.layouts.app')

@section('title', 'Pesan Masuk (Inquiries)')
@section('header', 'Pesan Masuk')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Kotak Masuk Pesan Pelanggan</h2>
            <p class="text-sm text-slate-500">Pesan dan permintaan konsultasi teknis yang masuk via form kontak website</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('backoffice.inquiries.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">Semua</a>
            <a href="{{ route('backoffice.inquiries.index', ['status' => 'unread']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'unread' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">Belum Dibaca</a>
            <a href="{{ route('backoffice.inquiries.index', ['status' => 'handled']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'handled' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">Ditangani</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Pengirim</th>
                        <th class="py-3.5 px-6">Kontak</th>
                        <th class="py-3.5 px-6">Subjek</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Waktu Masuk</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($inquiries as $inq)
                    <tr class="hover:bg-slate-50/60 transition {{ $inq->status === 'unread' ? 'bg-blue-50/30 font-semibold' : '' }}">
                        <td class="py-4 px-6">
                            <div class="text-slate-900">{{ $inq->name }}</div>
                            @if($inq->company)
                                <div class="text-xs text-slate-500 font-normal">{{ $inq->company }}</div>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">
                            <div>{{ $inq->email }}</div>
                            @if($inq->phone)
                                <div class="text-slate-400 font-mono">{{ $inq->phone }}</div>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-slate-800 font-medium">
                            <span class="truncate block max-w-xs">{{ $inq->subject ?: '(Tanpa Subjek)' }}</span>
                        </td>
                        <td class="py-4 px-6">
                            @if($inq->status === 'unread')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">Baru</span>
                            @elseif($inq->status === 'read')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">Dibaca</span>
                            @elseif($inq->status === 'handled')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">Ditangani</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200">Spam</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500 font-normal">
                            {{ $inq->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('backoffice.inquiries.show', $inq->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-xs font-semibold transition">
                                Detail Pesan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">Tidak ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $inquiries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
