<!-- filepath: c:\Users\hatim\OneDrive\Desktop\campus_preinscription\resources\views\Etape1.blade.php -->
@extends('layouts.layout')

@section('title', 'Étape 1 - Préinscription')

@section('content')
    <h1 class="text-center mb-4">Étape 1 - Préinscription / التسجيل المسبق</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('Etape1.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <!-- CNE -->
        <div class="mb-3">
            <label for="cne" class="form-label">CNE / رمز مسار</label>
            <p class="form-control-plaintext">{{ $etudiant->cne_etu ?? 'N/A' }}</p>
        </div>

        <!-- Last Name in Arabic -->
        <div class="mb-3">
            <label for="nom_ar" class="form-label">Nom en Arabe / الاسم العائلي بالعربية</label>
            <input type="text" id="nom_ar" lang="ar" name="nom_ar" class="form-control" value="{{ old('nom_ar', $etudiant->nom_ar_etu) }}" required>
        </div>

        <!-- Last Name in French -->
        <div class="mb-3">
            <label for="nom_fr" class="form-label">Nom en Français / الاسم العائلي بالفرنسية</label>
            <input type="text" id="nom_fr" name="nom_fr" class="form-control" value="{{ old('nom_fr', $etudiant->nom_fr_etu) }}" required>
        </div>

        <!-- First Name in Arabic -->
        <div class="mb-3">
            <label for="prenom_ar" class="form-label">Prénom en Arabe / الاسم الشخصي بالعربية</label>
            <input type="text" id="prenom_ar" name="prenom_ar" class="form-control" value="{{ old('prenom_ar', $etudiant->prenom_ar_etu) }}" required>
        </div>

        <!-- First Name in French -->
        <div class="mb-3">
            <label for="prenom_fr" class="form-label">Prénom en Français / الاسم الشخصي بالفرنسية</label>
            <input type="text" id="prenom_fr" name="prenom_fr" class="form-control" value="{{ old('prenom_fr', $etudiant->prenom_fr_etu) }}" required>
        </div>

        <!-- CIN -->
        <div class="mb-3">
            <label for="cin" class="form-label">CIN / رقم البطاقة الوطنية</label>
            <input type="text" id="cin" name="cin" class="form-control" value="{{ old('cin', $etudiant->cin_etu) }}" required>
        </div>

        <!-- Sex -->
        <div class="mb-3">
            <label for="sexe" class="form-label">Sexe / الجنس</label>
            <select id="sexe" name="sexe" class="form-select" required>
                <option value="M" {{ old('sexe', $etudiant->sexe_etu) == 'M' ? 'selected' : '' }}>Masculin / ذكر</option>
                <option value="F" {{ old('sexe', $etudiant->sexe_etu) == 'F' ? 'selected' : '' }}>Féminin / أنثى</option>
            </select>
        </div>

        <!-- Situationship -->
        <div class="mb-3">
            <label for="situation" class="form-label">Situation Familiale / الحالة العائلية</label>
            <select id="situation" name="situation" class="form-select" required>
                <option value="" disabled selected>Choisissez une situation / اختر الحالة العائلية</option>
                @foreach($situations as $situation)
                    <option value="{{ $situation->id_situation }}"
                        {{ old('situation', $etudiant->id_situation) == $situation->id_situation ? 'selected' : '' }}>
                        {{ $situation->intitule_situation_fr_ }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Birthday -->
        <div class="mb-3">
            <label for="birthday" class="form-label">Date de Naissance / تاريخ الميلاد</label>
            <p class="form-control-plaintext">{{ $etudiant->date_de_naissance_etu }}</p>
        </div>

        <!-- Country of Birth -->
        <div class="mb-3">
            <label for="country_birth" class="form-label">Pays de Naissance / بلد الميلاد</label>
            <select id="country_birth" name="country_birth" class="form-select" required>
                <option value="" disabled selected>Choisissez un pays / اختر بلداً</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id_pays }}"
                        {{ old('country_birth', $etudiant->id_pays_naissance) == $country->id_pays ? 'selected' : '' }}>
                        {{ $country->intitule_pays_fr }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Province de Naissance -->
        <div class="mb-3">
            <label for="province_naissance" class="form-label">Province de Naissance / إقليم الميلاد</label>
            <select id="province_naissance" name="province_naissance" class="form-select" required>
                <option value="" disabled selected>Choisissez une province / اختر إقليماً</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id_province }}"
                        {{ old('province_naissance', $etudiant->id_province_naissance) == $province->id_province ? 'selected' : '' }}>
                        {{ $province->intitule_province_fr }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Lieu de Naissance in French -->
        <div class="mb-3">
            <label for="lieu_naissance_fr" class="form-label">Lieu de Naissance (Français) / مكان الولادة (بالفرنسية)</label>
            <input type="text" id="lieu_naissance_fr" name="lieu_naissance_fr" class="form-control" value="{{ old('lieu_naissance_fr', $etudiant->lieu_naissance_etu_fr) }}" required>
        </div>

        <!-- Lieu de Naissance in Arabic -->
        <div class="mb-3">
            <label for="lieu_naissance_ar" class="form-label">Lieu de Naissance (Arabe) / مكان الولادة (بالعربية)</label>
            <input type="text" id="lieu_naissance_ar" name="lieu_naissance_ar" class="form-control" value="{{ old('lieu_naissance_ar', $etudiant->lieu_naissance_etu_ar) }}" required>
        </div>

        <!-- Nationality -->
        <div class="mb-3">
            <label for="nationality" class="form-label">Nationalité / الجنسية</label>
            <select id="nationality" name="nationality" class="form-select" required>
                <option value="" disabled selected>Choisissez une nationalité / اختر الجنسية</option>
                @foreach($nationalities as $nationality)
                    <option value="{{ $nationality->id_nationalite }}"
                        {{ old('nationality', $etudiant->id_nationalite) == $nationality->id_nationalite ? 'selected' : '' }}>
                        {{ $nationality->intitule_nationalite_fr }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Telephone Number -->
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone / الهاتف</label>
            <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone', $etudiant->telephone_etu) }}" required>
        </div>

        <!-- Adresse Personnelle -->
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse Personnelle / العنوان الشخصي</label>
            <textarea id="adresse" name="adresse" class="form-control" rows="3" required>{{ old('adresse', $etudiant->adresse_etu) }}</textarea>
        </div>

        <!-- Ville -->
        <div class="mb-3">
            <label for="ville" class="form-label">Ville / المدينة</label>
            <select id="ville" name="ville" class="form-select" required>
                <option value="" disabled selected>Choisissez une ville / اختر مدينة</option>
                @foreach($ville as $v)
                    <option value="{{ $v->id_ville }}"
                        {{ old('ville', $etudiant->ville_etu) == $v->id_ville ? 'selected' : '' }}>
                        {{ $v->nom_ville }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Région -->
        <div class="mb-3">
            <label for="region" class="form-label">Région / الجهة</label>
            <select id="region" name="region" class="form-select" required>
                <option value="" disabled selected>Choisissez une région / اختر جهة</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id_region }}"
                        {{ old('region', $etudiant->region_etu) == $region->id_region ? 'selected' : '' }}>
                        {{ $region->intitule_region_fr }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Type Hébergement -->
        <div class="mb-3">
            <label for="hebergement" class="form-label">Type d'Hébergement / نوع السكن</label>
            <select id="hebergement" name="hebergement" class="form-select" required>
                <option value="" disabled selected>Choisissez un type / اختر نوع السكن</option>
                @foreach($hebergements as $hebergement)
                    <option value="{{ $hebergement->id_hebergement }}"
                        {{ old('hebergement', $etudiant->id_hebergement) == $hebergement->id_hebergement ? 'selected' : '' }}>
                        {{ $hebergement->intitule_hebergement_fr }} / {{ $hebergement->intitule_hebergement_ar }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Couverture Médicale -->
        <div class="mb-3">
            <label for="couverture_medicale" class="form-label">Type de Couverture Médicale / نوع التغطية الطبية</label>
            <select id="couverture_medicale" name="couverture_medicale" class="form-select" required>
                <option value="" disabled selected>Choisissez un type / اختر نوع التغطية</option>
                <option value="RAMED" {{ old('couverture_medicale', $etudiant->couverture) == 'RAMED' ? 'selected' : '' }}>RAMED</option>
                <option value="CNSS" {{ old('couverture_medicale', $etudiant->couverture) == 'CNSS' ? 'selected' : '' }}>CNSS</option>
                <option value="CNOPS" {{ old('couverture_medicale', $etudiant->couverture) == 'CNOPS' ? 'selected' : '' }}>CNOPS</option>
                <option value="autre" {{ old('couverture_medicale', $etudiant->couverture) == 'autre' ? 'selected' : '' }}>Autre / أخرى</option>
            </select>
        </div>

        <!-- Compte Bancaire -->
        <div class="mb-3">
            <label for="compte_bancaire" class="form-label">Avez-vous un compte bancaire ? / هل لديك حساب بنكي؟</label>
            <select id="compte_bancaire" name="compte_bancaire" class="form-select" onchange="toggleBankAccountField()" required>
                <option value="yes" {{ old('compte_bancaire', $etudiant->ncb) ? 'selected' : '' }}>Oui / نعم</option>
                <option value="no" {{ old('compte_bancaire', $etudiant->ncb) ? '' : 'selected' }}>Non / لا</option>
            </select>
        </div>

        <!-- Numéro du Compte Bancaire -->
        <div class="mb-3" id="bank_account_field" style="display: {{ old('compte_bancaire', $etudiant->ncb) ? 'block' : 'none' }};">
            <label for="numero_compte" class="form-label">Numéro du Compte Bancaire / رقم الحساب البنكي</label>
            <input type="text" id="numero_compte" name="numero_compte" class="form-control" value="{{ old('numero_compte', $etudiant->ncb) }}">
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="photo" class="form-label">Photo d'identité / صورة الهوية</label>
            <input type="file" id="photo" name="photo" class="form-control" accept="image/*" onchange="loadImage(event)" @if(!$etudiant->photo_etu) required @endif>
            <small class="form-text text-muted">
                <strong>Instructions:</strong>
                <ul>
                    <li>La photo doit être récente avec un fond clair. / يجب أن تكون الصورة حديثة بخلفية واضحة.</li>
                    <li>Le visage doit être visible et sans lunettes. / يجب أن يكون الوجه مرئيًا وبدون نظارات.</li>
                    <li>La taille de l'image ne doit pas dépasser 3 Mo. / يجب ألا يتجاوز حجم الصورة 3 ميغابايت.</li>
                    <li>Le visage doit occuper le centre de l'image (64-72 mm). / يجب أن يشغل الوجه مركز الصورة (64-72 ملم).</li>
                    <li>La taille finale de l'image doit être de 340x265 px. / يجب أن يكون الحجم النهائي للصورة 340x265 بكسل.</li>
                </ul>
            </small>
        </div>

        <!-- Image Preview and Cropper -->
        <div class="mb-3">
            <label class="form-label">Prévisualisation et édition / معاينة وتحرير</label>
            <div>
                <img id="preview"
                     style="max-width: 100%; {{ $etudiant->photo_etu ? '' : 'display: none;' }}"
                     alt="Image Preview"
                     @if($etudiant->photo_etu)
                         src="{{ asset('storage/' . $etudiant->photo_etu) }}"
                     @endif
                >
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="cropButton" style="display: none;" onclick="cropImage()">Recadrer l'image / قص الصورة</button>
        </div>

        <!-- Cropped Image Output -->
        <div class="mb-3">
            <label class="form-label">Image recadrée / الصورة المقصوصة</label>
            <div>
                <img id="croppedImage" style="max-width: 100%; display: none;" alt="Cropped Image">
            </div>
            <!-- Hidden input to store cropped image data -->
            <input type="hidden" id="croppedImageData" name="croppedImageData">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Valider / تحقق
            </button>
        </div>
    </form>

    <!-- Include Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        let cropper;
        window.addEventListener('DOMContentLoaded', function() {
            const preview = document.getElementById('preview');
            if (preview.src && preview.src !== window.location.href && preview.style.display !== 'none') {
                document.getElementById('cropButton').style.display = 'inline-block';
            }
        });

        const loadImage = (event) => {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 3 * 1024 * 1024) {
                    alert('La taille de l\'image ne doit pas dépasser 3 Mo. / يجب ألا يتجاوز حجم الصورة 3 ميغابايت.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';

                    // Destroy previous cropper instance if it exists
                    if (cropper) {
                        cropper.destroy();
                    }

                    // Initialize Cropper.js
                    cropper = new Cropper(preview, {
                        aspectRatio: 340 / 265,
                        viewMode: 1,
                        autoCropArea: 1,
                    });

                    document.getElementById('cropButton').style.display = 'inline-block';
                };
                reader.readAsDataURL(file);
            }
        };

        const cropImage = () => {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 340,
                    height: 265,
                });

                // Show cropped image
                const croppedImage = document.getElementById('croppedImage');
                croppedImage.src = canvas.toDataURL();
                croppedImage.style.display = 'block';

                // Save cropped image data to hidden input
                document.getElementById('croppedImageData').value = canvas.toDataURL();
            }
        };

        function toggleBankAccountField() {
            const compteBancaire = document.getElementById('compte_bancaire').value;
            const bankAccountField = document.getElementById('bank_account_field');
            if (compteBancaire === 'yes') {
                bankAccountField.style.display = 'block';
            } else {
                bankAccountField.style.display = 'none';
            }
        }
    </script>
@endsection
