<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
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
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to find the Etudiant by email_etu
        $etudiant = Etudiant::where('email_etu', $request->email)->first();

        if (!$etudiant || !Hash::check($request->password, $etudiant->password_etu)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Auth::login($etudiant, $request->boolean('remember'));
        $request->session()->regenerate();
        $request->session()->put('etudiant_id', $etudiant->id_etudiant);

        // Redirect based on step
        switch ($etudiant->step) {
            case 1: return redirect()->route('Etape1');
            case 2: return redirect()->route('Etape2');
            case 3: return redirect()->route('Etape3');
            case 4: return redirect()->route('Etape4');
            case 5: return redirect()->route('Etape5');
            case 6: return redirect()->route('Etape6');
            default: return redirect()->route('dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
