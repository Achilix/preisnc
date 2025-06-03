<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Etape3Controller extends Controller
{
    public function show(Request $request)
    {
        $categories = DB::table('categorie_socio_pro')->get();
        $pays = DB::table('pays')->get();
        $provinces = DB::table('province')->get();
        return view('Etape3', compact('categories', 'pays', 'provinces'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'cin_pere' => 'required|string',
            'nom_pere' => 'required|string',
            'prenom_pere' => 'required|string',
            'naissance_pere' => 'required|date',
            'id_cat_socio_pro_pere' => 'required|integer',

            'cin_mere' => 'required|string',
            'nom_mere' => 'required|string',
            'prenom_mere' => 'required|string',
            'naissance_mere' => 'required|date',
            'id_cat_socio_pro_mere' => 'required|integer',

            'type_tuteur' => 'required|in:PERE,MERE,AUTRE',
            'adresse_tuteur' => 'required|string',
            'id_pays' => 'required|integer',
            'id_province_parents' => 'required',
            'telephone_familial' => 'required|string',
        ]);

        $etudiantId = session('etudiant_id');
        if (!$etudiantId) {
            return redirect()->route('pre-register.form')->withErrors(['error' => 'Session expirée, veuillez recommencer.']);
        }

        // Fetch selected categories to check if they are "Décédé"
        $catPere = DB::table('categorie_socio_pro')->where('id_cat_socio_pro', $request->id_cat_socio_pro_pere)->first();
        $catMere = DB::table('categorie_socio_pro')->where('id_cat_socio_pro', $request->id_cat_socio_pro_mere)->first();

        $isPereDecede = $catPere && str_contains(strtolower($catPere->intitule_cat_socio_pro_fr), 'décédé');
        $isMereDecede = $catMere && str_contains(strtolower($catMere->intitule_cat_socio_pro_fr), 'décédé');

        $data = [
            'cin_pere' => $request->cin_pere,
            'nom_pere' => $request->nom_pere,
            'prenom_pere' => $request->prenom_pere,
            'naissance_pere' => $request->naissance_pere,
            'id_cat_socio_pro_pere' => $request->id_cat_socio_pro_pere,
            'date_deces_pere' => $isPereDecede ? $request->date_deces_pere : null,

            'cin_mere' => $request->cin_mere,
            'nom_mere' => $request->nom_mere,
            'prenom_mere' => $request->prenom_mere,
            'naissance_mere' => $request->naissance_mere,
            'id_cat_socio_pro_mere' => $request->id_cat_socio_pro_mere,
            'date_deces_mere' => $isMereDecede ? $request->date_deces_mere : null,

            'type_tuteur' => $request->type_tuteur,
            'adresse_tuteur' => $request->adresse_tuteur,
            'id_pays' => $request->id_pays,
            'id_province_parents' => $request->id_province_parents,
            'step' => 4,
        ];

        // Tuteur logic
        if ($request->type_tuteur === 'PERE') {
            $data['nom_prenom_tuteur'] = $request->nom_pere . ' ' . $request->prenom_pere;
            $data['adresse_tuteur'] = $request->adresse_tuteur;
                $data['id_cat_socio_pro_tuteur'] = $request->id_cat_socio_pro_pere; // Set to father's category
        } elseif ($request->type_tuteur === 'MERE') {
            $data['nom_prenom_tuteur'] = $request->nom_mere . ' ' . $request->prenom_mere;
            $data['adresse_tuteur'] = $request->adresse_tuteur;
            $data['id_cat_socio_pro_tuteur'] = $request->id_cat_socio_pro_mere; // Set to mother's category
        } else { // AUTRE
            $data['nom_prenom_tuteur'] = $request->nom_prenom_tuteur;
            $data['adresse_tuteur'] = $request->adresse_tuteur;
            $data['id_cat_socio_pro_tuteur'] = $request->id_cat_socio_pro_tuteur;
        }
        $data['tel_tuteur'] = $request->telephone_familial;

        $typeTuteurMap = [
            'PERE' => 'P',
            'MERE' => 'M',
            'AUTRE' => 'A',
        ];
        $data['type_tuteur'] = $typeTuteurMap[$request->type_tuteur] ?? null;

        DB::table('etudiant')->where('id_etudiant', $etudiantId)->update($data);

        return redirect()->route('Etape4')->with('success', 'Informations familiales enregistrées avec succès.');
    }
}
