<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BackofficeAuthController extends Controller
{
    /**
     * Show backoffice login form.
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->canAccessBackoffice()) {
            return redirect()->route('backoffice.dashboard');
        }

        return view('backoffice.auth.login');
    }

    /**
     * Handle backoffice login attempt with rate limiting.
     */
    public function login(Request $request)
    {
        $loginInput = $request->input('username') ?? $request->input('email');

        $request->validate([
            'username' => ['required_without:email', 'nullable', 'string'],
            'email' => ['required_without:username', 'nullable', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required_without' => 'Username wajib diisi.',
            'email.required_without' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $errorField = $request->filled('username') ? 'username' : 'email';
        $throttleKey = Str::transliterate(Str::lower($loginInput) . '|' . $request->ip());

        // Max 5 attempts per minute
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                $errorField => ["Terlalu banyak percobaan login. Silakan coba kembali dalam {$seconds} detik."],
            ]);
        }

        $remember = $request->boolean('remember');
        $password = (string) $request->input('password');

        // Attempt login via username first, then fallback to email
        $authenticated = Auth::attempt(['username' => $loginInput, 'password' => $password], $remember);
        if (!$authenticated) {
            $authenticated = Auth::attempt(['email' => $loginInput, 'password' => $password], $remember);
        }

        if ($authenticated) {
            $user = Auth::user();

            if (!$user->is_active || !in_array($user->role, ['admin', 'editor', 'cs', 'support'])) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                RateLimiter::hit($throttleKey);

                throw ValidationException::withMessages([
                    $errorField => ['Akun Anda tidak memiliki izin untuk mengakses backoffice.'],
                ]);
            }

            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            $defaultRoute = match($user->role) {
                'cs', 'support' => route('backoffice.live-chats.index'),
                'editor' => route('backoffice.products.index'),
                default => route('backoffice.dashboard'),
            };

            return redirect()->intended($defaultRoute);
        }

        RateLimiter::hit($throttleKey);

        throw ValidationException::withMessages([
            $errorField => ['Username atau password yang Anda masukkan salah.'],
        ]);
    }

    /**
     * Handle backoffice logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('backoffice.login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    /**
     * Show change password form.
     */
    public function showPasswordForm()
    {
        return view('backoffice.auth.password');
    }

    /**
     * Update current user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password lama tidak cocok.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
