@extends('layouts.layout')

@section('title', 'Étape 3 - Informations Familiales / المعلومات العائلية')

@section('content')
    <h1 class="text-center mb-4">Étape 3 - Informations Familiales / المعلومات العائلية</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Etape3.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <h4>Père / الأب</h4>
        <div class="mb-3">
            <label for="cin_pere" class="form-label">CIN du père / رقم بطاقة الأب</label>
            <input type="text" id="cin_pere" name="cin_pere" class="form-control" value="{{ old('cin_pere') }}">
        </div>
        <div class="mb-3">
            <label for="nom_pere" class="form-label">Nom du père / اسم الأب</label>
            <input type="text" id="nom_pere" name="nom_pere" class="form-control" value="{{ old('nom_pere') }}">
        </div>
        <div class="mb-3">
            <label for="prenom_pere" class="form-label">Prénom du père / اسم الأب الشخصي</label>
            <input type="text" id="prenom_pere" name="prenom_pere" class="form-control" value="{{ old('prenom_pere') }}">
        </div>
        <div class="mb-3">
            <label for="naissance_pere" class="form-label">Date de naissance du père / تاريخ ميلاد الأب</label>
            <input type="date" id="naissance_pere" name="naissance_pere" class="form-control" value="{{ old('naissance_pere') }}">
        </div>
        <div class="mb-3">
            <label for="id_cat_socio_pro_pere" class="form-label">Catégorie socioprofessionnelle du père / الفئة الاجتماعية المهنية للأب</label>
            <select id="id_cat_socio_pro_pere" name="id_cat_socio_pro_pere" class="form-select" required>
                <option value="" disabled selected>Choisissez une catégorie / اختر فئة</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id_cat_socio_pro }}"
                        data-decede="{{ Str::contains(Str::lower($cat->intitule_cat_socio_pro_fr), 'décédé') ? '1' : '0' }}"
                        {{ old('id_cat_socio_pro_pere') == $cat->id_cat_socio_pro ? 'selected' : '' }}>
                        {{ $cat->intitule_cat_socio_pro_fr }} @if($cat->intitule_cat_socio_pro_ar) / {{ $cat->intitule_cat_socio_pro_ar }} @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3" id="date_deces_pere_div" style="display: none;">
            <label for="date_deces_pere" class="form-label">Date de décès du père / تاريخ وفاة الأب</label>
            <input type="date" id="date_deces_pere" name="date_deces_pere" class="form-control" value="{{ old('date_deces_pere') }}">
        </div>

        <hr>

        <h4>Mère / الأم</h4>
        <div class="mb-3">
            <label for="cin_mere" class="form-label">CIN de la mère / رقم بطاقة الأم</label>
            <input type="text" id="cin_mere" name="cin_mere" class="form-control" value="{{ old('cin_mere') }}">
        </div>
        <div class="mb-3">
            <label for="nom_mere" class="form-label">Nom de la mère / اسم الأم</label>
            <input type="text" id="nom_mere" name="nom_mere" class="form-control" value="{{ old('nom_mere') }}">
        </div>
        <div class="mb-3">
            <label for="prenom_mere" class="form-label">Prénom de la mère / اسم الأم الشخصي</label>
            <input type="text" id="prenom_mere" name="prenom_mere" class="form-control" value="{{ old('prenom_mere') }}">
        </div>
        <div class="mb-3">
            <label for="naissance_mere" class="form-label">Date de naissance de la mère / تاريخ ميلاد الأم</label>
            <input type="date" id="naissance_mere" name="naissance_mere" class="form-control" value="{{ old('naissance_mere') }}">
        </div>
        <div class="mb-3">
            <label for="id_cat_socio_pro_mere" class="form-label">Catégorie socioprofessionnelle de la mère / الفئة الاجتماعية المهنية للأم</label>
            <select id="id_cat_socio_pro_mere" name="id_cat_socio_pro_mere" class="form-select" required>
                <option value="" disabled selected>Choisissez une catégorie / اختر فئة</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id_cat_socio_pro }}"
                        data-decede="{{ Str::contains(Str::lower($cat->intitule_cat_socio_pro_fr), 'décédé') ? '1' : '0' }}"
                        {{ old('id_cat_socio_pro_mere') == $cat->id_cat_socio_pro ? 'selected' : '' }}>
                        {{ $cat->intitule_cat_socio_pro_fr }} @if($cat->intitule_cat_socio_pro_ar) / {{ $cat->intitule_cat_socio_pro_ar }} @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3" id="date_deces_mere_div" style="display: none;">
            <label for="date_deces_mere" class="form-label">Date de décès de la mère / تاريخ وفاة الأم</label>
            <input type="date" id="date_deces_mere" name="date_deces_mere" class="form-control" value="{{ old('date_deces_mere') }}">
        </div>

        <hr>

        <h4>Tuteur / الولي</h4>
        <div class="mb-3">
            <label for="type_tuteur" class="form-label">Type de tuteur / نوع الولي</label>
            <select id="type_tuteur" name="type_tuteur" class="form-select" required>
                <option value="PERE" {{ old('type_tuteur') == 'PERE' ? 'selected' : '' }}>Père / الأب</option>
                <option value="MERE" {{ old('type_tuteur') == 'MERE' ? 'selected' : '' }}>Mère / الأم</option>
                <option value="AUTRE" {{ old('type_tuteur') == 'AUTRE' ? 'selected' : '' }}>Autre / آخر</option>
            </select>
        </div>
        <div id="tuteur_autre_fields" style="display: {{ old('type_tuteur') == 'AUTRE' ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="nom_prenom_tuteur" class="form-label">Nom et prénom du tuteur / اسم ونسب الولي</label>
                <input type="text" id="nom_prenom_tuteur" name="nom_prenom_tuteur" class="form-control" value="{{ old('nom_prenom_tuteur') }}">
            </div>
            <div class="mb-3">
                <label for="adresse_tuteur" class="form-label">Adresse du tuteur / عنوان الولي</label>
                <input type="text" id="adresse_tuteur" name="adresse_tuteur" class="form-control" value="{{ old('adresse_tuteur') }}">
            </div>
            <div class="mb-3">
                <label for="id_cat_socio_pro_tuteur" class="form-label">Catégorie socio-professionnelle du tuteur / الفئة الاجتماعية المهنية للولي</label>
                <select id="id_cat_socio_pro_tuteur" name="id_cat_socio_pro_tuteur" class="form-select">
                    <option value="" disabled selected>Choisissez une catégorie / اختر فئة</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id_cat_socio_pro }}" {{ old('id_cat_socio_pro_tuteur') == $cat->id_cat_socio_pro ? 'selected' : '' }}>
                            {{ $cat->intitule_cat_socio_pro_fr }} @if($cat->intitule_cat_socio_pro_ar) / {{ $cat->intitule_cat_socio_pro_ar }} @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Adresse des parents -->
        <div class="mb-3">
            <label for="adresse_tuteur" class="form-label">Adresse des parents / عنوان الأبوين</label>
            <input type="text" id="adresse_tuteur" name="adresse_tuteur" class="form-control" value="{{ old('adresse_tuteur') }}">
        </div>

        <!-- Pays -->
        <div class="mb-3">
            <label for="id_pays" class="form-label">Pays / البلد</label>
            <select id="id_pays" name="id_pays" class="form-select" required>
                <option value="" disabled selected>Choisissez un pays / اختر بلداً</option>
                @foreach($pays as $p)
                    <option value="{{ $p->id_pays }}" {{ old('id_pays') == $p->id_pays ? 'selected' : '' }}>
                        {{ $p->intitule_pays_fr }} @if($p->intitule_pays_ar) / {{ $p->intitule_pays_ar }} @endif
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Province -->
        <div class="mb-3">
            <label for="id_province_parents" class="form-label">Province / الإقليم</label>
            <select id="id_province_parents" name="id_province_parents" class="form-select" required>
                <option value="" disabled selected>Choisissez une province / اختر إقليماً</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id_province }}" {{ old('id_province_parents') == $province->id_province ? 'selected' : '' }}>
                        {{ $province->intitule_province_fr }} @if($province->intitule_province_ar) / {{ $province->intitule_province_ar }} @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="telephone_familial" class="form-label">Téléphone familial / الهاتف العائلي</label>
            <input type="text" id="telephone_familial" name="telephone_familial" class="form-control" value="{{ old('telephone_familial') }}">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
    Valider / تحقق
</button>
        </div>
    </form>

    <script>
        function toggleDateDeces(selectId, dateDivId) {
            var select = document.getElementById(selectId);
            var dateDiv = document.getElementById(dateDivId);
            var selectedOption = select.options[select.selectedIndex];
            if (selectedOption && selectedOption.getAttribute('data-decede') === '1') {
                dateDiv.style.display = 'block';
            } else {
                dateDiv.style.display = 'none';
            }
        }

        // Initial check on page load
        toggleDateDeces('id_cat_socio_pro_pere', 'date_deces_pere_div');
        toggleDateDeces('id_cat_socio_pro_mere', 'date_deces_mere_div');

        // On change
        document.getElementById('id_cat_socio_pro_pere').addEventListener('change', function() {
            toggleDateDeces('id_cat_socio_pro_pere', 'date_deces_pere_div');
        });
        document.getElementById('id_cat_socio_pro_mere').addEventListener('change', function() {
            toggleDateDeces('id_cat_socio_pro_mere', 'date_deces_mere_div');
        });

        function toggleTuteurFields() {
            var typeTuteur = document.getElementById('type_tuteur').value;
            var autreFields = document.getElementById('tuteur_autre_fields');
            var catTuteur = document.getElementById('id_cat_socio_pro_tuteur');
            if (typeTuteur === 'AUTRE') {
                autreFields.style.display = 'block';
            } else {
                autreFields.style.display = 'none';
                // Affect the value of the father or mother
                var pereCat = document.getElementById('id_cat_socio_pro_pere').value;
                var mereCat = document.getElementById('id_cat_socio_pro_mere').value;
                if (typeTuteur === 'PERE') {
                    catTuteur.value = pereCat;
                } else if (typeTuteur === 'MERE') {
                    catTuteur.value = mereCat;
                }
            }
        }

        document.getElementById('type_tuteur').addEventListener('change', toggleTuteurFields);

        // On page load
        window.addEventListener('DOMContentLoaded', function() {
            toggleTuteurFields();
        });
    </script>
@endsection
