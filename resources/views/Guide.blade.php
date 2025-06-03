<div>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
</div>
@extends('layouts.layout')

@section('title', 'Guide de Préinscription')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Guide de Préinscription / دليل التسجيل القبلي</h1>
        <p class="text-center">
            L'étudiant doit choisir la nationalité de son Baccalauréat, et suivre les indications suivantes selon son choix :<br>
            يجب على الطالب اختيار جنسية شهادة البكالوريا الخاصة به واتباع التعليمات التالية حسب اختياره:
        </p>

        <div class="accordion" id="guideAccordion">
            <!-- Section 1: Pour les bacheliers marocains -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        Pour les bacheliers marocains / لحاملي البكالوريا المغربية
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#guideAccordion">
                    <div class="accordion-body">
                        <h3>I. Création de compte</h3>
                        <ul>
                            <li>Recherche du CNE : Fournir votre Code Massar et votre date de naissance;</li>
                            <li>Puisque votre baccalauréat est marocain, le Code National de l'Elève (Massar) doit contenir 1 lettre et 9 chiffres. Exemple: G412252321</li>
                            <li>Format de la date de naissance : AAAA-MM-JJ. Exemple: 1999-12-31</li>
                        </ul>
                        <p>
                            Saisie d’une adresse e-mail et d’un mot de passe : vous devrez fournir une adresse email valide, sinon, vous risquerez de ne pas achever votre préinscription.
                        </p>
                        <h3>II. Connexion à votre espace :</h3>
                        <ul>
                            <li>Connectez-vous sur la plateforme en entrant votre Code Massar et votre mot de passe,</li>
                            <li>Début de la préinscription :</li>
                        </ul>
                        <ol>
                            <li>Étape 1 : informations générales de l’étudiant, tous les champs sont obligatoires</li>
                            <li>Étape 2 : validation informations du Bac et choix du type de lycée de provenance,</li>
                            <li>Étape 3 : Situation des parents et/ou tuteur,</li>
                            <li>Étape 4 : Informations complémentaires (handicap et fonction),</li>
                            <li>Étape 5 : Choix de l’établissement et de la filière,</li>
                            <li>Étape 6 : Téléchargement et impression du reçu de préinscription.</li>
                        </ol>
                        <p>
                            <strong>Important :</strong> Vous devez vous présenter à l’établissement de votre choix, dans les délais, muni(e) du reçu de préinscription et des pièces nécessaires (Voir dossier d’inscription sur le site de l’établissement choisi), pour valider votre inscription.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 2: Pour les titulaires d'un Baccalauréat mission ou étranger -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        Pour les titulaires d'un Baccalauréat mission ou étranger / لحاملي البكالوريا الأجنبية
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#guideAccordion">
                    <div class="accordion-body">
                        <h3>I. Création de compte</h3>
                        <p>
                            Saisie d’une adresse e-mail et d’un mot de passe : vous devrez fournir une adresse email valide, sinon, vous risquerez de ne pas recevoir l’e-mail de confirmation de la création de votre compte.
                        </p>
                        <p>
                            Envoi d'un email d’informations : un CNE provisoire sera envoyé vous permettant, avec votre mot de passe déjà saisi lors de la création de compte, la connexion à votre espace pour commencer votre préinscription.
                        </p>
                        <h3>II. Connexion à votre espace</h3>
                        <p>
                            Début de la préinscription : Une fois son compte créé, l'étudiant sera en mesure d'y accéder et de commencer sa préinscription à l’établissement et dans la filière de son choix.
                        </p>
                        <ol>
                            <li>Étape 1 : informations générales de l’étudiant,</li>
                            <li>Étape 2 : saisie des informations du Bac et choix du type de lycée de provenance,</li>
                            <li>Étape 3 : Situation des parents et/ou tuteur,</li>
                            <li>Étape 4 : Informations complémentaires (handicap et fonction),</li>
                            <li>Étape 5 : Choix de l’établissement et de la filière,</li>
                            <li>Étape 6 : Téléchargement et impression du reçu de préinscription.</li>
                        </ol>
                        <p>
                            <strong>N.B :</strong> Les étudiants étrangers souhaitant s’inscrire dans l’une des filières dans un établissement de l’université Cadi Ayyad, sont obligés de passer par un parcours diplomatique; en envoyant leurs dossiers de préinscription à l’Agence Marocaine de Coopération Internationale (<a href="http://www.amci.ma" target="_blank">http://www.amci.ma</a>) pour avoir l’autorisation d’inscription délivrée par le Ministère de l’Education Nationale, de l’Enseignement Supérieur, de la Formation des Cadres et de la Recherche Scientifique. Pour plus de détails : <a href="http://www.enssup.gov.ma/index.php?option=com_content&view=article&id=314&Itemed=135" target="_blank">http://www.enssup.gov.ma</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
