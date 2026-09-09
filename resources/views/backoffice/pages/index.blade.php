@extends('backoffice.layouts.app')

@section('title', 'Halaman Statis & Perusahaan')
@section('header', 'Kelola Halaman')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-slate-900">Halaman Perusahaan</h2>
        <p class="text-sm text-slate-500">Kelola konten profil, visi-misi, dan halaman statis resmi perusahaan</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Kunci Halaman</th>
                        <th class="py-3.5 px-6">Judul Halaman</th>
                        <th class="py-3.5 px-6">Slug URL</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Terakhir Diperbarui</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pages as $p)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-4 px-6 font-mono text-xs font-semibold text-blue-600">
                            {{ $p->page_key }}
                        </td>
                        <td class="py-4 px-6 font-semibold text-slate-900">{{ $p->title }}</td>
                        <td class="py-4 px-6 text-slate-500 font-mono text-xs">/{{ $p->slug }}</td>
                        <td class="py-4 px-6">
                            @if($p->status === 'published')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">Published</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">Draft</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500">{{ $p->updated_at->format('d M Y, H:i') }}</td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('backoffice.pages.edit', $p->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-xs font-semibold transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Edit Konten
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">Belum ada data halaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
