<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;

class Etape2Controller extends Controller
{
    public function showEtape2(Request $request)
    {
        // Get etudiant_id from session
        $etudiantId = session('etudiant_id');
        if (!$etudiantId) {
            return redirect()->route('pre-register.form')->withErrors('Session expirée, veuillez recommencer.');
        }

        $etudiant = DB::table('etudiant')->where('id_etudiant', $etudiantId)->first();
        if (!$etudiant) {
            return redirect()->route('Etape1')->withErrors('Étudiant introuvable.');
        }

        $typeBac = DB::table('type_bac')->where('id_type_bac', $etudiant->id_type_bac)->value('intitule_type_bac');
        $academie = DB::table('academie')->where('id_academie', $etudiant->id_academie)->value('intitule_academie_fr');
        $province = DB::table('province')->where('id_province', $etudiant->id_province_bac)->value('intitule_province_fr');
        $typeLycees = DB::table('type_lycee')->get();

        return view('Etape2', compact('etudiant', 'typeBac', 'academie', 'province', 'typeLycees'));
    }

    public function submitEtape2(Request $request)
    {
        $etudiantId = session('etudiant_id');
        if (!$etudiantId) {
            return redirect()->route('pre-register.form')->withErrors('Session expirée, veuillez recommencer.');
        }
        
        $etudiant = DB::table('etudiant')->where('id_etudiant', $etudiantId)->first();
        if (!$etudiant) {
            return redirect()->back()->withErrors('Étudiant introuvable.');
        }

        $request->validate([
            'etablissement_origine' => 'required|integer',
            'scan_bac' => ($etudiant->bac_etu ? 'nullable' : 'required') . '|file|mimes:pdf|max:2048',
            'scan_cin' => ($etudiant->cin_file ? 'nullable' : 'required') . '|file|mimes:pdf|max:2048',
        ]);

        $cne = $etudiant->cne_etu;

        // Ensure the directories exist
        $bacDir = storage_path('app/public/scans/baccalaureat');
        $cinDir = storage_path('app/public/scans/cin');
        if (!file_exists($bacDir)) {
            mkdir($bacDir, 0777, true);
        }
        if (!file_exists($cinDir)) {
            mkdir($cinDir, 0777, true);
        }

        // Handle Bac file
        if ($request->hasFile('scan_bac')) {
            $bacFileName = $cne . '.pdf';
            $request->file('scan_bac')->storeAs('public/scans/baccalaureat', $bacFileName);
        } else {
            $bacFileName = $etudiant->bac_etu;
        }

        // Handle CIN file
        if ($request->hasFile('scan_cin')) {
            $cinFileName = $cne . '.pdf';
            $request->file('scan_cin')->storeAs('public/scans/cin', $cinFileName);
        } else {
            $cinFileName = $etudiant->cin_file;
        }

        // Save data to the database and update the step to 3
        DB::table('etudiant')->where('id_etudiant', $etudiantId)->update([
            'id_type_lycee' => $request->etablissement_origine,
            'bac_etu' => $bacFileName,
            'cin_file' => $cinFileName,
            'step' => 3,
        ]);

        return redirect()->route('Etape3')->with('success', 'Étape 2 complétée avec succès.');
    }
}
