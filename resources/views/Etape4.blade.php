<!-- filepath: c:\Users\hatim\OneDrive\Desktop\preinsc\resources\views\Etape4.blade.php -->
@extends('layouts.layout')

@section('title', 'Étape 4 - Informations complémentaires')

@section('content')
    <h1 class="text-center mb-4">Étape 4 - Informations complémentaires / معلومات إضافية</h1>

    <form action="{{ route('Etape4.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <div class="mb-4">
            <label class="form-label d-block mb-2">
                Avez-vous un handicap ? / هل لديك إعاقة؟
            </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="handicap" name="handicap" value="1" {{ old('handicap') ? 'checked' : '' }} onchange="toggleHandicapFields()">
                <label class="form-check-label" for="handicap">Oui / نعم</label>
            </div>
        </div>

        <div id="handicap_fields" style="display: {{ old('handicap') ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="id_handicap" class="form-label">Type de handicap / نوع الإعاقة</label>
                <select id="id_handicap" name="id_handicap" class="form-select">
                    <option value="">-- Choisissez -- / اختر --</option>
                    @foreach($handicaps as $h)
                        <option value="{{ $h->id_handicap }}" {{ old('id_handicap') == $h->id_handicap ? 'selected' : '' }}>
                            {{ $h->intitule_handicap_fr }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="num_carte_handicap" class="form-label">Numéro carte handicap / رقم بطاقة الإعاقة</label>
                <input type="text" id="num_carte_handicap" name="num_carte_handicap" class="form-control" value="{{ old('num_carte_handicap') }}">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label d-block mb-2">
                Êtes-vous salarié ou fonctionnaire ? / هل أنت أجير أو موظف؟
            </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="salarie" name="salarie" value="1" {{ old('salarie') ? 'checked' : '' }} onchange="toggleSocioProFields()">
                <label class="form-check-label" for="salarie">Oui / نعم</label>
            </div>
        </div>

        <!-- Socio-pro fields (already inside #socio_pro_fields) -->
        <div id="socio_pro_fields" style="display: {{ old('salarie') ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="id_cat_socio_pro" class="form-label">Catégorie socio-professionnelle / الفئة الاجتماعية المهنية</label>
                <select id="id_cat_socio_pro" name="id_cat_socio_pro" class="form-select">
                    <option value="">-- Choisissez -- / اختر --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id_cat_socio_pro }}" {{ old('id_cat_socio_pro') == $cat->id_cat_socio_pro ? 'selected' : '' }}>
                            {{ $cat->intitule_cat_socio_pro_fr }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="fonction_etu" class="form-label">Numéro carte fonctionnaire / رقم بطاقة الموظف</label>
                <input type="text" id="fonction_etu" name="fonction_etu" class="form-control" value="{{ old('fonction_etu') }}">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Valider / تحقق
            </button>
        </div>
    </form>

    <script>
        function toggleHandicapFields() {
            document.getElementById('handicap_fields').style.display =
                document.getElementById('handicap').checked ? 'block' : 'none';
        }

        function toggleSocioProFields() {
            document.getElementById('socio_pro_fields').style.display =
                document.getElementById('salarie').checked ? 'block' : 'none';
        }
    </script>
@endsection
