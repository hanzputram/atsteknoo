<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);

        return view('backoffice.users.index', compact('users'));
    }

    public function create()
    {
        return view('backoffice.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
            'role' => ['required', 'in:admin,editor'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'name' => trim($request->name),
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => $request->boolean('is_active', true),
            'email_verified_at' => now(),
        ]);

        AuditLog::log('CREATE', 'User', $user->id, ['email' => $user->email, 'role' => $user->role]);

        return redirect()->route('backoffice.users.index')->with('success', "Pengguna '{$user->email}' berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('backoffice.users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:12', 'confirmed'],
            'role' => ['required', 'in:admin,editor'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $newActive = $request->boolean('is_active', true);
        $newRole = $request->role;

        // Last active admin protection
        if ($user->role === 'admin' && ($newRole !== 'admin' || !$newActive)) {
            $otherActiveAdmins = User::where('role', 'admin')
                ->where('is_active', true)
                ->where('id', '!=', $user->id)
                ->count();

            if ($otherActiveAdmins === 0) {
                return back()->withInput()->withErrors([
                    'role' => 'Tidak dapat mengubah role atau menonaktifkan Admin aktif terakhir dalam sistem.',
                ]);
            }
        }

        $payload = [
            'name' => trim($request->name),
            'email' => strtolower(trim($request->email)),
            'role' => $newRole,
            'is_active' => $newActive,
        ];

        if ($request->filled('password')) {
            $payload['password'] = Hash::make($request->password);
        }

        $user->update($payload);

        AuditLog::log('UPDATE', 'User', $user->id, ['email' => $user->email, 'role' => $user->role, 'is_active' => $user->is_active]);

        return redirect()->route('backoffice.users.index')->with('success', "Data pengguna '{$user->email}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'Anda tidak dapat menghapus akun Anda sendiri saat sedang aktif.']);
        }

        if ($user->role === 'admin') {
            $otherActiveAdmins = User::where('role', 'admin')
                ->where('is_active', true)
                ->where('id', '!=', $user->id)
                ->count();

            if ($otherActiveAdmins === 0) {
                return back()->withErrors(['user' => 'Tidak dapat menghapus Admin aktif terakhir dalam sistem.']);
            }
        }

        $email = $user->email;
        $user->delete();

        AuditLog::log('DELETE', 'User', $id, ['email' => $email]);

        return redirect()->route('backoffice.users.index')->with('success', "Pengguna '{$email}' berhasil dihapus.");
    }
}
