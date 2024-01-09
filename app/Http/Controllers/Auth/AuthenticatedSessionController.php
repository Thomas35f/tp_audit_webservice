<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

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
        $user = User::where('email', $request->email)->first();

        if ($user) {

            Log::info('New user founded : ' . $user);

            if ($request->password === $user->password) {
                Log::info('Authentification : SUCCESS');
                // Authentification réussie
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        // Authentification échouée
        Log::info('Authentification : FAILED');
        return redirect()->route('login')->withErrors(['error' => 'Identifiants invalides']);
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