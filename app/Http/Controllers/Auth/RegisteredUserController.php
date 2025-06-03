<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:etudiant,email_etu'],
            'confirmEmail' => ['required', 'same:email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'g-recaptcha-response' => ['required'],
        ]);

        // Retrieve the user ID from the session (set in PreRegisterController)
        $userId = session('user_id');

        // Retrieve the user data from the ministere table
        $ministre = DB::table('ministere')->where('id', $userId)->first();

        if (!$ministre) {
            return back()->withErrors(['error' => 'Les informations de l\'utilisateur sont introuvables.']);
        }

        // Create the Etudiant using Eloquent
        $etudiant = Etudiant::create([
            'cne_etu' => $ministre->cne,
            'cin_etu' => $ministre->cin,
            'nom_fr_etu' => $ministre->nom,
            'prenom_fr_etu' => $ministre->prenom,
            'nom_ar_etu' => $ministre->nom_ar,
            'prenom_ar_etu' => $ministre->prenom_ar,
            'date_de_naissance_etu' => $ministre->datenaissance,
            'sexe_etu' => $ministre->sexe,
            'annee_obtention_bac_etu' => $ministre->anneebac,
            'note_bac_etu' => $ministre->notebac,
            'email_etu' => $request->input('email'),
            'password_etu' => Hash::make($request->input('password')),
            'id_province_bac' => $ministre->codeprovincebac,
            'id_academie' => $ministre->codeacademie,
            'id_mention' => $ministre->mention,
            'massar_etu' => $ministre->massar,
            'nationalite_bac' => $ministre->nationalite,
            'id_type_bac' => $ministre->codeseriebac,
            'step' => 1,
        ]);

        event(new Registered($etudiant));

        Auth::login($etudiant);

        session(['etudiant_id' => $etudiant->id_etudiant]);

        // Redirect to the next step WITHOUT passing the ID in the URL
        return redirect()->route('Etape1')
                         ->with('success', 'Les informations ont été enregistrées avec succès.');
    }
}
