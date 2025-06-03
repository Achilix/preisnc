<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;

class Etape5Controller extends Controller
{
    public function show(Request $request)
    {
        // Get Marrakech city id (adjust if needed)
        $ville = DB::table('ville')->where('nom_ville', 'MARRAKECH')->first();

        // Get the établissement with id = 104 in Marrakech
        $etablissement = DB::table('etablissement')
            ->where('id_etablissement', 104)
            ->first();

        // Check if the établissement was found
        if (!$etablissement) {
            return view('Etape5', [
                'centre' => $ville->nom_ville,
                'etablissement' => null,
                'filieres' => null,
            ]);
        }

        $cne = \Illuminate\Support\Facades\Auth::user()->cne_etu ?? null;
        if (!$cne) {
            abort(403, 'CNE non trouvé pour l\'utilisateur.');
        }

        // Check if the student is admitted with LP or LA
        $admis = DB::table('admis')
            ->where('cne', $cne)
            ->whereIn('type_admission', ['LP', 'LA'])
            ->exists();

        if (!$admis) {
            abort(403, 'Vous n\'êtes pas autorisé à continuer la préinscription.');
        }

        // Get all filières without join
        $filieres = DB::table('filiere')
            ->select('id_filiere', 'intitule_filiere_fr', 'intitule_filiere_ar')
            ->get();

        return view('Etape5', [
            'centre' => $ville->nom_ville,
            'etablissement' => $etablissement,
            'filieres' => $filieres,
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'id_etablissement' => 'required|integer',
            'id_filiere' => 'required|integer',
        ]);

        // Get the authenticated user
        $etudiant = $request->user();

        // Check if the user exists in admis table with the selected id_filiere
        $admis = DB::table('admis')
            ->where('cne', $etudiant->cne_etu)
            ->where('id_filiere', $request->id_filiere)
            ->whereIn('type_admission', ['LP', 'LA'])
            ->first();

        if (!$admis) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['id_filiere' => 'Vous n\'êtes pas admis dans cette filière.']);
        }

        // Update step to 6
        $etudiant->step = 6;
        $etudiant->save();

        // Insert into inscrit table
        DB::table('inscrit')->insert([
            'id_etudiant' => $etudiant->id_etudiant,
            'id_filiere' => $request->id_filiere,
            'id_etat' => 1,
            'date_inscription' => now(),
            'niveau' => 1,
            'last_year' => null,
            'numero_dossier' => null,
            'code_pieces_manquantes' => null,
        ]);

        return redirect()->route('Etape6')->with('success', 'Votre choix a été enregistré.');
    }
}
