<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;
use PhpOffice\PhpWord\TemplateProcessor;

class Etape6Controller extends Controller
{
    public function download(Request $request)
    {
        // Get the authenticated user
        $etudiant = $request->user();

        // Get the latest inscription for this student
        $inscrit = DB::table('inscrit')
            ->where('id_etudiant', $etudiant->id_etudiant)
            ->orderByDesc('date_inscription')
            ->first();

        // Get filiere info
        $filiere = $inscrit
            ? DB::table('filiere')->where('id_filiere', $inscrit->id_filiere)->first()
            : null;
        $filiere_nom = $filiere ? $filiere->intitule_filiere_fr : '';

        // Get admission info
        $admis = DB::table('admis')->where('cne', $etudiant->cne_etu)->first();
        $type_admission = $admis ? $admis->type_admission : null;
        $admis_type = $type_admission
            ? DB::table('admis_type')->where('id_admis_type', $type_admission)->first()
            : null;
        $type_admis_label = $admis_type ? $admis_type->details_admis_type : ($type_admission ?? '');

        // Fetch etablissement info as before
        $etablissement = DB::table('etablissement')->where('id_etablissement', $inscrit->id_etablissement ?? $request->id_etablissement ?? $etudiant->id_etablissement ?? 104)->first();
        $etab_abrev = $etablissement ? ($etablissement->intitule_etablissement_abr ?? $etablissement->intitule_etablissement_fr) : '';

        // Generate barcode image (PNG)
        $barcodePath = storage_path('app/barcode.png');
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        file_put_contents($barcodePath, $generator->getBarcode($etudiant->cne_etu, $generator::TYPE_CODE_128));

        // Generate QR code image (PNG)
        $qrPath = storage_path('app/qrcode.png');
        $qrContent = "CNE: {$etudiant->cne_etu}\nNom: {$etudiant->nom_fr_etu}\nPrénom: {$etudiant->prenom_fr_etu}";
        QrCode::format('png')->size(200)->generate($qrContent, $qrPath);

        // Logo and photo paths (ensure PNG/JPG format)
        $logoPath = public_path('images/Universite_Cadi_Ayyad.png');
        $photoPath = $etudiant->photo_etu
            ? public_path('storage/' . $etudiant->photo_etu)
            : public_path('images/default_photo.png');

        // Load and fill the DOCX template
        $templatePath = storage_path('app/templates/recu.docx');
        $outputPath = storage_path('app/recu_filled_' . $etudiant->cne_etu . '.docx');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

        // Province name
        $province = DB::table('province')->where('id_province', $etudiant->id_province_naissance)->first();
        $province_nom = $province ? $province->intitule_province_fr : '';

        // Fill the template
        $templateProcessor->setValue('cne', $etudiant->cne_etu);
        $templateProcessor->setValue('nom', $etudiant->nom_fr_etu);
        $templateProcessor->setValue('prenom', $etudiant->prenom_fr_etu);
        $templateProcessor->setValue('province', $province_nom);
        $templateProcessor->setValue('filiere', $filiere_nom);
        $templateProcessor->setValue('type_admis', $type_admis_label);
        $templateProcessor->setValue('etab_abrev', $etab_abrev);
        $templateProcessor->setValue('date', now()->format('d/m/Y'));

        // Insert images (PNG/JPG only, no Imagick needed)
        $templateProcessor->setImageValue('barcode', ['path' => $barcodePath, 'width' => 200, 'height' => 60]);
        $templateProcessor->setImageValue('qrcode', ['path' => $qrPath, 'width' => 100, 'height' => 100]);
        $templateProcessor->setImageValue('logo', ['path' => $logoPath, 'width' => 100, 'height' => 100]);
        $templateProcessor->setImageValue('photo', ['path' => $photoPath, 'width' => 152, 'height' => 300]);

        $templateProcessor->saveAs($outputPath);

        // Download and delete after send
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    public function showEtape6(Request $request)
    {
        $user = $request->user();

        // Get latest inscription
        $inscrit = DB::table('inscrit')
            ->where('id_etudiant', $user->id_etudiant)
            ->orderByDesc('date_inscription')
            ->first();

        $filiere_nom = '';
        $type_admis_label = '';

        if ($inscrit) {
            $filiere = DB::table('filiere')->where('id_filiere', $inscrit->id_filiere)->first();
            $filiere_nom = $filiere ? $filiere->intitule_filiere_fr : '';

            $admis = DB::table('admis')->where('cne', $user->cne_etu)->first();
            if ($admis) {
                $admis_type = DB::table('admis_type')->where('id_admis_type', $admis->type_admission)->first();
                $type_admis_label = $admis_type ? $admis_type->details_admis_type : $admis->type_admission;
            }
        }

        return view('Etape6', [
            'user' => $user,
            'filiere_nom' => $filiere_nom,
            'type_admis_label' => $type_admis_label,
        ]);
    }
}
