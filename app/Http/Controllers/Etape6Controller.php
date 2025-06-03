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

        // Always get filière and type_admission names from the session (set in Etape5)
        $filiere_nom = session('filiere_nom'); // Already the name, not the ID
        $type_admis_label = session('type_admis_label'); // Already the label, not the ID

        // Fetch etablissement info as before
        $etablissement = DB::table('etablissement')->where('id_etablissement', $request->id_etablissement ?? $etudiant->id_etablissement ?? 104)->first();
        $etab_abrev = $etablissement ? ($etablissement->intitule_etablissement_abr ?? $etablissement->intitule_etablissement_fr) : '';

        // Generate barcode image (PNG)
        $barcodePath = storage_path('app/barcode.png');
        $generator = new BarcodeGeneratorPNG();
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
        $templateProcessor = new TemplateProcessor($templatePath);

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
        return view('Etape6');
    }
}
