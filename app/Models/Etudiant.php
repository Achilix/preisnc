<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Etudiant extends Authenticatable
{
    protected $table = 'etudiant';
    protected $primaryKey = 'id_etudiant';

    public $timestamps = false; // <--- Add this line

    protected $fillable = [
        'cne_etu',
        'cin_etu',
        'nom_fr_etu',
        'prenom_fr_etu',
        'nom_ar_etu',
        'prenom_ar_etu',
        'date_de_naissance_etu',
        'sexe_etu',
        'annee_obtention_bac_etu',
        'note_bac_etu',
        'email_etu',
        'password_etu',
        'id_province_bac',
        'id_academie',
        'id_mention',
        'massar_etu',
        'nationalite_bac',
        'id_type_bac',
        'id_situation',
        'id_pays_naissance',
        'lieu_naissance_etu_fr',
        'lieu_naissance_etu_ar',
        'id_province_naissance',
        'id_nationalite',
        'telephone_etu',
        'adresse_etu',
        'ville_etu',
        'region_etu',
        'id_hebergement',
        'couverture',
        'ncb',
        'photo_etu',
        'id_type_lycee',
        'cin_pere',
        'nom_pere',
        'prenom_pere',
        'naissance_pere',
        'id_cat_socio_pro_pere',
        'date_deces_pere',
        'cin_mere',
        'nom_mere',
        'prenom_mere',
        'naissance_mere',
        'id_cat_socio_pro_mere',
        'date_deces_mere',
        'type_tuteur',
        'adresse_tuteur',
        'id_pays',
        'id_province_parents',
        'id_cat_socio_pro',
        'nom_prenom_tuteur',
        'tel_tuteur',
        'id_handicap',
        'num_carte_handicap',
        'id_type_etablissement',
        'id_filiere',
        'step',
    ];

    protected $dates = ['last_student_update'];

    // Tell Laravel to use your custom fields
    public function getAuthIdentifierName()
    {
        return 'id_etudiant';
    }

    public function getAuthPassword()
    {
        return $this->password_etu;
    }

    public function getEmailForPasswordReset()
    {
        return $this->email_etu;
    }
    public function getEmailAttribute()
    {
        return $this->email_etu;
    }

    protected static function booted()
    {
        static::updating(function ($etudiant) {
            $etudiant->last_student_update = now();
        });
    }
}
