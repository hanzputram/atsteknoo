<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class PublicContactController extends Controller
{
    /**
     * Display the official contact page with branches and inquiry form.
     */
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('public.contact', compact('settings'));
    }

    /**
     * Submit contact inquiry with rate limiting and honeypot.
     */
    public function submit(Request $request)
    {
        // Honeypot spam check: hidden field 'website_hp' must be empty
        if ($request->filled('website_hp')) {
            return back()->with('success', 'Pesan Anda telah berhasil terkirim.');
        }

        // Rate limit: 3 inquiries per minute per IP
        $throttleKey = 'contact-inquiry|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->withErrors([
                'rate_limit' => "Terlalu banyak pengiriman pesan. Silakan tunggu {$seconds} detik.",
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:64'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactInquiry::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => trim($validated['phone'] ?? ''),
            'subject' => trim($validated['subject']),
            'message' => trim($validated['message']),
            'status' => 'unread',
            'ip_address' => $request->ip(),
        ]);

        RateLimiter::hit($throttleKey, 60);

        return back()->with('success', 'Terima kasih. Pesan Anda telah diterima oleh tim PT. Anugerah Tama Sejati. Kami akan segera menghubungi Anda.');
    }
}
