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
        $users = User::orderByRaw("CASE WHEN role = 'superadmin' THEN 0 WHEN role = 'admin' THEN 1 ELSE 2 END")
            ->orderBy('name')
            ->paginate(20);

        return view('backoffice.users.index', compact('users'));
    }

    public function create()
    {
        $availableModules = User::availableModules();

        return view('backoffice.users.create', compact('availableModules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:superadmin,admin,editor,cs,support,custom'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Only superadmin can create another superadmin
        if ($request->role === 'superadmin' && !auth()->user()->isSuperAdmin()) {
            return back()->withInput()->withErrors([
                'role' => 'Hanya Super Administrator yang berhak menetapkan peran Super Administrator.',
            ]);
        }

        // Determine permissions
        $permissions = $request->input('permissions', []);
        if ($request->role === 'superadmin') {
            $permissions = ['*'];
        } elseif (empty($permissions) && $request->role !== 'custom') {
            $permissions = User::getDefaultPermissionsForRole($request->role);
        }

        $user = User::create([
            'name' => trim($request->name),
            'username' => $request->filled('username') ? trim($request->username) : null,
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'permissions' => $permissions,
            'is_active' => $request->boolean('is_active', true),
            'email_verified_at' => now(),
        ]);

        AuditLog::log('CREATE', 'User', $user->id, [
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'permissions' => $permissions,
        ]);

        return redirect()->route('backoffice.users.index')->with('success', "Pengguna '{$user->name}' dengan peran '{$user->role_label}' berhasil didaftarkan.");
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        // Regular admin cannot edit a superadmin
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit akun Super Administrator.');
        }

        $availableModules = User::availableModules();

        return view('backoffice.users.edit', compact('user', 'availableModules'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        // Regular admin cannot edit a superadmin
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit akun Super Administrator.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:50', 'alpha_dash', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:superadmin,admin,editor,cs,support,custom'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Only superadmin can assign superadmin role
        if ($request->role === 'superadmin' && !auth()->user()->isSuperAdmin()) {
            return back()->withInput()->withErrors([
                'role' => 'Hanya Super Administrator yang berhak menetapkan peran Super Administrator.',
            ]);
        }

        $newActive = $request->boolean('is_active', true);
        $newRole = $request->role;

        // Last active superadmin or admin protection
        if (in_array($user->role, ['superadmin', 'admin']) && (!in_array($newRole, ['superadmin', 'admin']) || !$newActive)) {
            $otherActiveAdmins = User::whereIn('role', ['superadmin', 'admin'])
                ->where('is_active', true)
                ->where('id', '!=', $user->id)
                ->count();

            if ($otherActiveAdmins === 0) {
                return back()->withInput()->withErrors([
                    'role' => 'Tidak dapat mengubah role atau menonaktifkan Administrator aktif terakhir dalam sistem.',
                ]);
            }
        }

        // Determine permissions
        $permissions = $request->input('permissions', []);
        if ($newRole === 'superadmin') {
            $permissions = ['*'];
        } elseif (empty($permissions) && $newRole !== 'custom') {
            $permissions = User::getDefaultPermissionsForRole($newRole);
        }

        $payload = [
            'name' => trim($request->name),
            'username' => $request->filled('username') ? trim($request->username) : null,
            'email' => strtolower(trim($request->email)),
            'role' => $newRole,
            'permissions' => $permissions,
            'is_active' => $newActive,
        ];

        if ($request->filled('password')) {
            $payload['password'] = Hash::make($request->password);
        }

        $user->update($payload);

        AuditLog::log('UPDATE', 'User', $user->id, [
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'permissions' => $permissions,
            'is_active' => $user->is_active,
        ]);

        return redirect()->route('backoffice.users.index')->with('success', "Data pengguna '{$user->name}' berhasil diperbarui.");
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'Anda tidak dapat menghapus akun Anda sendiri saat sedang aktif.']);
        }

        // Regular admin cannot delete a superadmin
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->withErrors(['user' => 'Hanya Super Administrator yang dapat menghapus akun Super Administrator.']);
        }

        if (in_array($user->role, ['superadmin', 'admin'])) {
            $otherActiveAdmins = User::whereIn('role', ['superadmin', 'admin'])
                ->where('is_active', true)
                ->where('id', '!=', $user->id)
                ->count();

            if ($otherActiveAdmins === 0) {
                return back()->withErrors(['user' => 'Tidak dapat menghapus Administrator aktif terakhir dalam sistem.']);
            }
        }

        $email = $user->email;
        $user->delete();

        AuditLog::log('DELETE', 'User', $id, ['email' => $email]);

        return redirect()->route('backoffice.users.index')->with('success', "Pengguna '{$email}' berhasil dihapus.");
    }
}
