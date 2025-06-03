{{-- filepath: c:\Users\hatim\OneDrive\Desktop\preinsc\resources\views\Etape6.blade.php --}}
@extends('layouts.layout')

@section('title', 'Étape 6 - Récapitulatif / الملخص')

@section('content')
    @php
        $user = Auth::user();
    @endphp

    <h1 class="text-center mb-4">Étape 6 - Récapitulatif / الملخص</h1>

    <div class="border p-4 rounded" style="max-width: 500px; margin: 0 auto;">
        <div class="mb-3 text-center">
            <strong>CNE :</strong> {{ $user->cne_etu }}
        </div>
        <div class="mb-3 text-center">
            <strong>Nom :</strong> {{ $user->nom_fr_etu }}
        </div>
        <div class="mb-3 text-center">
            <strong>Prénom :</strong> {{ $user->prenom_fr_etu }}
        </div>
        <div class="mb-3 text-center">
            <strong>Filière choisie :</strong> {{ $filiere_nom }}
        </div>
        <div class="mb-3 text-center">
            <strong>Type d'admission :</strong> {{ $type_admis_label }}
        </div>
        <form action="{{ route('recu.download') }}" method="POST" class="text-center mt-4">
            @csrf
            <button type="submit" class="btn custom-btn"
                style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Télécharger le reçu / تحميل الوصل
            </button>
        </form>
    </div>
@endsection
