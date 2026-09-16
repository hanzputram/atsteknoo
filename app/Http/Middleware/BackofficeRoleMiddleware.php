<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackofficeRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  $role  Required role (e.g. 'admin')
     */
    public function handle(Request $request, Closure $next, ?string $role = null): Response
    {
        $user = $request->user();

        // 1. Check if user is logged in
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'UNAUTHENTICATED',
                    'message' => 'Sesi backoffice tidak ditemukan atau telah kedaluwarsa.',
                ], 401);
            }

            return redirect()->guest(route('backoffice.login'));
        }

        // 2. Check if user account is active
        if (!$user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'ACCOUNT_INACTIVE',
                    'message' => 'Akun backoffice Anda telah dinonaktifkan.',
                ], 403);
            }

            return redirect()->route('backoffice.login')->withErrors([
                'email' => 'Akun Anda tidak aktif. Silakan hubungi Administrator.',
            ]);
        }

        // 3. Check if user has valid backoffice role
        if (!in_array($user->role, ['admin', 'editor', 'cs', 'support'])) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'FORBIDDEN',
                    'message' => 'Anda tidak memiliki hak akses ke backoffice.',
                ], 403);
            }

            abort(403, 'Akses ditolak: Anda tidak memiliki izin untuk membuka backoffice.');
        }

        // 4. Check specific role requirement if specified (e.g. 'admin' or 'admin,editor')
        if ($role) {
            $allowedRoles = array_map('trim', explode(',', $role));
            if (!in_array($user->role, $allowedRoles)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'FORBIDDEN_ROLE',
                        'message' => 'Aksi ini tidak diizinkan untuk peran Anda.',
                    ], 403);
                }

                abort(403, 'Akses ditolak: Peran Anda tidak memiliki izin untuk mengakses fitur ini.');
            }
        }

        return $next($request);
    }
}
