@extends('layouts.layout')

@section('title', 'Étape 5 - Choix du centre, établissement et filière')

@section('content')
    <h1 class="text-center mb-4">Étape 5 - Choix du centre, établissement et filière / اختيار المركز، المؤسسة والتخصص</h1>

    <form action="{{ route('Etape5.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <!-- Centre (fixed) -->
        <div class="mb-3">
            <label class="form-label">Centre (Ville) / المركز (المدينة)</label>
            <input type="text" class="form-control" value="{{ $centre }}" readonly>
        </div>

        <!-- Établissement (fixed) -->
        <div class="mb-3">
            <label class="form-label">Établissement / المؤسسة</label>
            @if($etablissement)
                <input type="text" class="form-control" value="{{ $etablissement->intitule_etablissement_fr }}" readonly>
                <input type="hidden" name="id_etablissement" value="{{ $etablissement->id_etablissement }}">
            @else
                <input type="text" class="form-control" value="Aucun établissement trouvé" readonly>
            @endif
        </div>

        <!-- Filière (select) -->
        <div class="mb-3">
            <label for="id_filiere" class="form-label">Filière / التخصص</label>
            <select id="id_filiere" name="id_filiere" class="form-select" required>
                <option value="">-- Choisissez -- / اختر --</option>
                @if($filieres && count($filieres))
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id_filiere }}" {{ old('id_filiere') == $filiere->id_filiere ? 'selected' : '' }}>
                            {{ $filiere->intitule_filiere_fr }} @if($filiere->intitule_filiere_ar) / {{ $filiere->intitule_filiere_ar }} @endif
                        </option>
                    @endforeach
                @else
                    <option disabled>Aucune filière trouvée</option>
                @endif
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Valider / تحقق
            </button>
        </div>
    </form>
@endsection
