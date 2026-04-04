<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // 1. If they are an Admin, send them to the Admin Panel
        if ($user->hasRole('Super-Admin') || $user->role === 'Super-Admin' || $user->role === 'super_admin') {
            return redirect()->intended('/admin');
        }

        // 2. If they are an Artist, send them to the Artist Dashboard
        if ($user->hasRole('Verified-Artist') || $user->role === 'Verified-Artist') {
            return redirect()->intended('/app');
        }

        // 3. If they are a Client, send them to the public directory
        return redirect()->intended('/artists');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}