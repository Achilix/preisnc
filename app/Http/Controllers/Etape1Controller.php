<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;

class Etape1Controller extends Controller
{
    public function showEtape1(Request $request)
    {
        // Get the etudiant_id from session (set after registration)
        $etudiantId = session('etudiant_id');
        if (!$etudiantId) {
            return redirect()->route('pre-register.form')->withErrors(['error' => 'Session expirée, veuillez recommencer.']);
        }

        $etudiant = DB::table('etudiant')->where('id_etudiant', $etudiantId)->first();
        $situations = DB::table('situation_familiale')->get();
        $provinces = DB::table('province')->get();
        $countries = DB::table('pays')->get();
        $nationalities = DB::table('nationalite')->get();
        $hebergements = DB::table('hebergement')->get();
        $regions = DB::table('region')->select('id_region', 'intitule_region_fr')->get();
        $ville = DB::table('ville')->get();

        return view('Etape1', compact('etudiant', 'situations', 'provinces', 'countries', 'nationalities', 'hebergements', 'regions', 'ville'));
    }

    public function handleForm(Request $request)
    {
        $etudiantId = session('etudiant_id');
        if (!$etudiantId) {
            return redirect()->route('pre-register.form')->withErrors(['error' => 'Session expirée, veuillez recommencer.']);
        }

        $etudiant = DB::table('etudiant')->where('id_etudiant', $etudiantId)->first();
        if (!$etudiant) {
            return redirect()->back()->with('error', 'Étudiant introuvable.');
        }

        // Validate the input
        $request->validate([
            'nom_ar' => ['required', 'string', 'max:50', 'regex:/^[\p{Arabic}\s]+$/u'],
            'prenom_ar' => ['required', 'string', 'max:50', 'regex:/^[\p{Arabic}\s]+$/u'],
            'lieu_naissance_ar' => ['required', 'string', 'max:100', 'regex:/^[\p{Arabic}\s]+$/u'],
            'nom_fr' => 'required|string|max:50',
            'prenom_fr' => 'required|string|max:50',
            'cin' => 'required|string|max:10',
            'sexe' => 'required|in:M,F',
            'situation' => 'required|string',
            'country_birth' => 'required|integer',
            'lieu_naissance_fr' => 'required|string|max:100',
            'province_naissance' => 'required',
            'nationality' => 'required|integer',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:1024',
            'ville' => 'required|string|max:20',
            'region' => 'required|string|max:50',
            'hebergement' => 'required|integer',
            'couverture_medicale' => 'required|string|in:RAMED,CNSS,CNOPS,autre',
            'compte_bancaire' => 'required|string|in:yes,no',
            'numero_compte' => 'nullable|string|max:24',
            'croppedImageData' => $etudiant->photo_etu ? 'nullable|string' : 'required|string',
        ], [
            'nom_ar.regex' => 'Le nom en arabe doit être saisi en caractères arabes uniquement.',
            'prenom_ar.regex' => 'Le prénom en arabe doit être saisi en caractères arabes uniquement.',
            'lieu_naissance_ar.regex' => 'Le lieu de naissance en arabe doit être saisi en caractères arabes uniquement.',
        ]);

        // Save the cropped image
        if ($request->has('croppedImageData')) {
            $imageData = $request->input('croppedImageData');
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = $etudiant->cne_etu . '.png'; // Use the CNE as the file name

            Storage::disk('public')->put('photos/' . $imageName, base64_decode($image));

            // Update the student's photo path in the database
            $etudiant->photo_etu = 'photos/' . $imageName;
        }

        // Update the student's data
        $etudiant->nom_ar_etu = $request->nom_ar;
        $etudiant->nom_fr_etu = $request->nom_fr;
        $etudiant->prenom_ar_etu = $request->prenom_ar;
        $etudiant->prenom_fr_etu = $request->prenom_fr;
        $etudiant->cin_etu = $request->cin;
        $etudiant->sexe_etu = $request->sexe;
        $etudiant->id_situation = $request->situation;
        $etudiant->date_de_naissance_etu = $request->birthday;
        $etudiant->id_pays_naissance = $request->country_birth;
        $etudiant->lieu_naissance_etu_fr = $request->lieu_naissance_fr;
        $etudiant->lieu_naissance_etu_ar = $request->lieu_naissance_ar;
        $etudiant->id_province_naissance = $request->province_naissance;
        $etudiant->id_nationalite = $request->nationality;
        $etudiant->telephone_etu = $request->telephone;
        $etudiant->adresse_etu = $request->adresse;
        $etudiant->ville_etu = $request->ville;
        $etudiant->region_etu = $request->region;
        $etudiant->id_hebergement = $request->hebergement;
        $etudiant->couverture = $request->couverture_medicale;
        $etudiant->ncb = $request->compte_bancaire === 'yes' ? $request->numero_compte : null;

        // Update the step to 2
        $etudiant->step = 2;

        // Save the updated data
        DB::table('etudiant')->where('id_etudiant', $etudiantId)->update([
            'nom_ar_etu' => $etudiant->nom_ar_etu,
            'nom_fr_etu' => $etudiant->nom_fr_etu,
            'prenom_ar_etu' => $etudiant->prenom_ar_etu,
            'prenom_fr_etu' => $etudiant->prenom_fr_etu,
            'cin_etu' => $etudiant->cin_etu,
            'sexe_etu' => $etudiant->sexe_etu,
            'id_situation' => $etudiant->id_situation,
            'date_de_naissance_etu' => $etudiant->date_de_naissance_etu,
            'id_pays_naissance' => $etudiant->id_pays_naissance,
            'lieu_naissance_etu_fr' => $etudiant->lieu_naissance_etu_fr,
            'lieu_naissance_etu_ar' => $etudiant->lieu_naissance_etu_ar,
            'id_province_naissance' => $etudiant->id_province_naissance,
            'id_nationalite' => $etudiant->id_nationalite,
            'telephone_etu' => $etudiant->telephone_etu,
            'adresse_etu' => $etudiant->adresse_etu,
            'ville_etu' => $etudiant->ville_etu,
            'region_etu' => $etudiant->region_etu,
            'id_hebergement' => $etudiant->id_hebergement,
            'couverture' => $etudiant->couverture,
            'ncb' => $etudiant->ncb,
            'step' => $etudiant->step,
            'photo_etu' => $etudiant->photo_etu,
        ]);

        // Redirect to the next step (no id in URL)
        return redirect()->route('Etape2')->with('success', 'Les informations ont été mises à jour avec succès.');
    }
}
