<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Etape4Controller extends Controller
{
    public function show(Request $request)
    {
        $handicaps = DB::table('handicap')->get();
        $categories = DB::table('categorie_socio_pro')->get();
        return view('Etape4', compact('handicaps', 'categories'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'handicap' => 'nullable|in:1',
            'id_handicap' => 'required_if:handicap,1|nullable|string|max:2|exists:handicap,id_handicap',
            'num_carte_handicap' => 'nullable|string|max:10',
            'salarie' => 'nullable|in:1',
            'id_cat_socio_pro' => 'required_if:salarie,1|nullable|integer|exists:categorie_socio_pro,id_cat_socio_pro',
            'fonction_etu' => 'nullable|string|max:100',
        ]);

        $etudiantId = session('etudiant_id');
        if (!$etudiantId) {
            return redirect()->route('pre-register.form')->withErrors(['error' => 'Session expirée, veuillez recommencer.']);
        }

        DB::table('etudiant')->where('id_etudiant', $etudiantId)->update([
            'id_handicap' => $request->has('handicap') ? $request->id_handicap : null,
            'num_carte_handicap' => $request->has('handicap') ? $request->num_carte_handicap : null,
            'id_situation' => $request->has('salarie') ? 1 : null,
            'id_cat_socio_pro' => $request->has('salarie') ? $request->id_cat_socio_pro : null,
            'fonction_etu' => $request->fonction_etu,
            'step' => 5,
        ]);

        return redirect()->route('Etape5')->with('success', 'Informations complémentaires enregistrées avec succès.');
    }
}
