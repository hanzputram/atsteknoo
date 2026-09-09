@extends('backoffice.layouts.app')

@section('title', 'Edit Pengguna: ' . $user->name)
@section('header', 'Edit Pengguna: ' . $user->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Perbarui Akun Pengguna</h2>
            <p class="text-sm text-slate-500">Edit data akun, peran akses, atau reset password staf</p>
        </div>

        <form action="{{ route('backoffice.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-4">
                <p class="text-xs font-semibold text-slate-700">Ubah Password (Kosongkan jika tidak ingin mengganti):</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Password Baru</label>
                        <input type="password" name="password" minlength="12" placeholder="Minimal 12 karakter" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" minlength="12" placeholder="Ketik ulang password" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm bg-white">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Peran Akses (Role) <span class="text-red-500">*</span></label>
                    <select name="role" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                        <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor (Kelola Katalog & Konten)</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin (Hak Penuh & Konfigurasi)</option>
                    </select>
                </div>
                <div class="pt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-slate-700">Akun Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('backoffice.users.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-sm transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">Perbarui Pengguna</button>
            </div>
        </form>
    </div>
</div>
@endsection
