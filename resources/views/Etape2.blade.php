@extends('layouts.layout')

@section('title', 'Étape 2 - Informations sur le Baccalauréat')

@section('content')
    <h1 class="text-center mb-4">Étape 2 - Informations sur le Baccalauréat / معلومات حول البكالوريا</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('Etape2.submit') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm">
        @csrf

        <!-- Année d'Obtention du Baccalauréat -->
        <div class="mb-3">
            <label for="annee_bac" class="form-label">Année d'Obtention du Baccalauréat / سنة الحصول على البكالوريا</label>
            <input type="number" id="annee_bac" name="annee_bac" class="form-control" value="{{ $etudiant->annee_obtention_bac_etu }}" readonly>
        </div>

        <!-- Série du Baccalauréat -->
        <div class="mb-3">
            <label for="serie_bac" class="form-label">Série du Baccalauréat / شعبة البكالوريا</label>
            <input type="text" id="serie_bac" name="serie_bac" class="form-control" value="{{ $typeBac }}" readonly>
        </div>

        <!-- Académie -->
        <div class="mb-3">
            <label for="academie" class="form-label">Académie / الأكاديمية</label>
            <input type="text" id="academie" name="academie" class="form-control" value="{{ $academie }}" readonly>
        </div>

        <!-- Province du Baccalauréat -->
        <div class="mb-3">
            <label for="province_bac" class="form-label">Province du Baccalauréat / إقليم البكالوريا</label>
            <input type="text" id="province_bac" name="province_bac" class="form-control" value="{{ $province }}" readonly>
        </div>

        <!-- Établissement d'Origine -->
        <div class="mb-3">
            <label for="etablissement_origine" class="form-label">Établissement d'Origine / المؤسسة الأصلية</label>
            <select id="etablissement_origine" name="etablissement_origine" class="form-select" required>
                <option value="" disabled selected>Choisissez un établissement / اختر مؤسسة</option>
                @foreach($typeLycees as $typeLycee)
                    <option value="{{ $typeLycee->id_type_lycee }}"
                        {{ $etudiant->id_type_lycee == $typeLycee->id_type_lycee ? 'selected' : '' }}>
                        {{ $typeLycee->intitule_type_lycee }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Scan du Baccalauréat Recto Verso -->
        <div class="mb-3">
            <label for="scan_bac" class="form-label">Scan du Baccalauréat (Recto Verso) / نسخة من البكالوريا (الوجهين)</label>
            <input type="file" id="scan_bac" name="scan_bac" class="form-control" accept="application/pdf" @if(!$etudiant->bac_etu) required @endif>
        </div>

        <!-- Carte d'Identité Nationale Recto Verso -->
        <div class="mb-3">
            <label for="scan_cin" class="form-label">Carte d'Identité Nationale (Recto Verso) / نسخة من البطاقة الوطنية (الوجهين)</label>
            <input type="file" id="scan_cin" name="scan_cin" class="form-control" accept="application/pdf" @if(!$etudiant->cin_file) required @endif>
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn custom-btn" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Valider / تحقق
            </button>
        </div>
    </form>
@endsection
