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

        // Update step to 6
        $etudiant->step = 6;
        $etudiant->save();

        // Get the type_admission for this user
        $admis = DB::table('admis')
            ->where('cne', $etudiant->cne_etu)
            ->whereIn('type_admission', ['LP', 'LA'])
            ->first();

        // Get the selected filière
        $filiere = DB::table('filiere')->where('id_filiere', $request->id_filiere)->first();
        $type_admission = $admis ? $admis->type_admission : null;

        // Get the full label for type_admission
        $admis_type = DB::table('admis_type')->where('id_admis_type', $type_admission)->first();
        $type_admis_label = $admis_type ? $admis_type->details_admis_type : $type_admission;

        // Store only names in session
        session([
            'filiere_nom' => $filiere ? $filiere->intitule_filiere_fr : '',
            'type_admis_label' => $type_admis_label,
        ]);

        return redirect()->route('Etape6')->with('success', 'Votre choix a été enregistré.');
    }
}
    