<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PreRegisterController extends Controller
{
    public function handleForm(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'codeMassar' => 'required|string',
            'dateNaissance' => 'required|date',
            'anneeBac' => 'required|string',
            'g-recaptcha-response' => 'required',
            'agreeRules' => 'accepted',
        ]);

        // Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return back()->withErrors(['error' => 'Échec de la validation reCAPTCHA.']);
        }

        // Check if the account already exists in the etudiant table
        $existingEtudiant = DB::table('etudiant')
            ->where('cne_etu', $request->input('codeMassar'))
            ->first();

        if ($existingEtudiant) {
            return back()->withErrors(['error' => 'Un compte avec ce code Massar existe déjà.']);
        }

        // Retrieve the record from the ministere table
        $ministere = DB::table('ministere')
            ->where('cne', $request->input('codeMassar'))
            ->where('datenaissance', $request->input('dateNaissance'))
            ->where('anneebac', $request->input('anneeBac'))
            ->where('active', 1)
            ->first();

        if ($ministere) {
            // Optionally store info in session
            session(['user_id' => $ministere->id]);
            // Redirect to next step
            return redirect()->route('register')->with('success', 'Vous avez été redirigé vers l\'étape suivante.');
        } else {
            return back()->withErrors(['error' => 'Aucun utilisateur actif trouvé avec les informations fournies.']);
        }
    }

    public function showForm()
    {
        return view('pre_register');
    }
}
