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
        // Utilisation du middleware throttle : maximum 5 requêtes toutes les 3 minutes
        $this->middleware('throttle:5,3')->only('store');
        
        $user = User::where('email', $request->email)->first();
        $reason = "";

        Log::info(['Connexion attempt - PORT user' => $request->getPort(),
                    'Connexion attempt - IP user' => $request->ip()]);

        if ($user) {

            Log::info('A user attempts to connect : ' . $user);

            if ($request->password === $user->password) {
                // Authentification réussie
                Log::info(['Authentification' => 'SUCCESS','Hash_used' => $request->hashAlgorithm]);
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }

            $reason = "PASSWORD INCORRECT";
        }else{
            $reason = "USER INCORRECT";
        }

        // Authentification échouée
        $fail = ['Authentification' => 'FAILED',
        'Reason' => $reason];
        Log::info($fail);
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
