@extends('backoffice.layouts.app')

@section('title', 'Tag Artikel')
@section('header', 'Tag Artikel')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
    <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
        <h3 class="text-base font-bold text-slate-900 mb-1">Tambah Tag Baru</h3>
        <p class="text-xs text-slate-500 mb-5">Label topik teknis untuk memudahkan penelusuran artikel</p>

        <form action="{{ route('backoffice.tags.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Tag <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Genset, MCB, Safety" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
            </div>
            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                Simpan Tag
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-900">Daftar Tag</h3>
            <span class="text-xs text-slate-500">{{ count($tags) }} total tag</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-5">Nama Tag</th>
                        <th class="py-3 px-5">Slug</th>
                        <th class="py-3 px-5">Jumlah Artikel</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tags as $t)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-5 font-semibold text-slate-900">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-medium border border-blue-100">
                                #{{ $t->name }}
                            </span>
                        </td>
                        <td class="py-3.5 px-5 text-slate-500 font-mono text-xs">{{ $t->slug }}</td>
                        <td class="py-3.5 px-5 text-slate-600 text-xs">{{ $t->articles_count }} artikel</td>
                        <td class="py-3.5 px-5 text-right">
                            @if(auth()->user()->isAdmin())
                            <form action="{{ route('backoffice.tags.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tag ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-slate-400 text-xs">Belum ada tag yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
