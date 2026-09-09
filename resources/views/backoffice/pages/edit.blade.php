@extends('backoffice.layouts.app')

@section('title', 'Edit Halaman: ' . $page->title)
@section('header', 'Edit Halaman: ' . $page->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <div class="mb-6 flex justify-between items-start">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Kelola Konten: {{ $page->title }}</h2>
                <p class="text-sm text-slate-500 font-mono">Kunci: {{ $page->page_key }} &bull; URL: /{{ $page->slug }}</p>
            </div>
            <a href="{{ route(in_array($page->page_key, ['about', 'about-us']) ? 'about.index' : 'contact.index') }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-700 font-semibold bg-blue-50 px-3 py-1.5 rounded-lg transition">
                <span>Lihat di Web</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>

        <form action="{{ route('backoffice.pages.update', $page->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Halaman <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
            </div>

            @if(in_array($page->page_key, ['about', 'about-us']))
            <!-- Structured About Us Sections -->
            <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Bagian Terstruktur Profil Perusahaan</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Visi Perusahaan</label>
                    <textarea name="sections[vision]" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">{{ old('sections.vision', $page->sections_data['vision'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Misi Perusahaan</label>
                    <textarea name="sections[mission]" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">{{ old('sections.mission', $page->sections_data['mission'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Uraian Sejarah Singkat</label>
                    <textarea name="sections[history]" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">{{ old('sections.history', $page->sections_data['history'] ?? '') }}</textarea>
                </div>
            </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konten Narasi Lengkap (HTML Disanitasi)</label>
                <textarea name="content_html" rows="10" placeholder="Tuliskan uraian profil lengkap..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-mono">{{ old('content_html', $page->content_html) }}</textarea>
                <p class="text-xs text-slate-400 mt-1">Mendukung format HTML standar (p, h2, h3, ul, ol, strong, em). Script berbahaya otomatis disanitasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Title SEO</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="Judul pada mesin pencari" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                        <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Published (Tampil di Web)</option>
                        <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Description SEO</label>
                <textarea name="meta_description" rows="2" placeholder="Deskripsi ringkas untuk snippet Google..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('backoffice.pages.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-sm transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">Simpan Halaman</button>
            </div>
        </form>
    </div>
</div>
@endsection
