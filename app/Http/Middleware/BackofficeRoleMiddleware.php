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
     * @param  string|null  $roles  Required roles (e.g. 'admin' or 'admin,editor')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
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

        // 3. Check if user has valid backoffice access
        if (!$user->canAccessBackoffice()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'FORBIDDEN',
                    'message' => 'Anda tidak memiliki hak akses ke backoffice.',
                ], 403);
            }

            abort(403, 'Akses ditolak: Anda tidak memiliki izin untuk membuka backoffice.');
        }

        // 4. Superadmin has omnipotent access to all features
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // 5. Check granular module permission based on route name
        $routeName = (string) $request->route()?->getName();
        $module = $this->resolveModuleFromRoute($routeName);

        if ($module !== null && !$user->hasPermission($module)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'FORBIDDEN_MODULE',
                    'message' => "Anda tidak memiliki izin untuk mengakses modul '{$module}'.",
                ], 403);
            }

            abort(403, "Akses ditolak: Anda tidak memiliki izin untuk mengakses modul ini.");
        }

        // 6. Check specific role requirement if specified
        if (!empty($roles)) {
            $allowedRoles = [];
            foreach ($roles as $r) {
                foreach (explode(',', (string) $r) as $subRole) {
                    $trimmed = trim($subRole);
                    if ($trimmed !== '') {
                        $allowedRoles[] = $trimmed;
                    }
                }
            }

            $hasRole = in_array($user->role, $allowedRoles);
            $hasPerm = $module !== null && $user->hasPermission($module);

            // Allow if user matches allowed roles OR has explicit module permission
            if (!$hasRole && !$hasPerm) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'FORBIDDEN_ROLE',
                        'message' => 'Aksi ini tidak diizinkan untuk peran Anda.',
                    ], 403);
                }

                abort(403, 'Akses ditolak: Peran atau izin Anda tidak mencukupi untuk membuka fitur ini.');
            }
        }

        return $next($request);
    }

    /**
     * Map route name to module key for permission checking.
     */
    protected function resolveModuleFromRoute(string $routeName): ?string
    {
        if (str_starts_with($routeName, 'backoffice.products.')) return 'products';
        if (str_starts_with($routeName, 'backoffice.product-categories.')) return 'product_categories';
        if (str_starts_with($routeName, 'backoffice.brands.')) return 'brands';
        if (str_starts_with($routeName, 'backoffice.import.')) return 'import_products';
        if (str_starts_with($routeName, 'backoffice.certificates.')) return 'certificates';
        if (str_starts_with($routeName, 'backoffice.projects.')) return 'projects';
        if (str_starts_with($routeName, 'backoffice.project-categories.')) return 'projects';
        if (str_starts_with($routeName, 'backoffice.articles.')) return 'articles';
        if (str_starts_with($routeName, 'backoffice.article-categories.')) return 'articles';
        if (str_starts_with($routeName, 'backoffice.tags.')) return 'articles';
        if (str_starts_with($routeName, 'backoffice.pages.')) return 'pages';
        if (str_starts_with($routeName, 'backoffice.media-library.')) return 'media_library';
        if (str_starts_with($routeName, 'backoffice.live-chats.')) return 'live_chats';
        if (str_starts_with($routeName, 'backoffice.inquiries.')) return 'inquiries';
        if (str_starts_with($routeName, 'backoffice.ai-knowledge.')) return 'ai_knowledge';
        if (str_starts_with($routeName, 'backoffice.settings.')) return 'settings';
        if (str_starts_with($routeName, 'backoffice.users.')) return 'users';
        if ($routeName === 'backoffice.dashboard') return 'dashboard';

        return null;
    }
}
