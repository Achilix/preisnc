@extends('layouts.layout')

@section('title', 'Étape 0 - Préinscription')

@section('content')
    <h1 class="text-center mb-4">Préinscription</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('pre-register.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <!-- Code Massar -->
        <div class="mb-3">
            <label for="codeMassar" class="form-label">Code Massar / رمز مسار</label>
            <input type="text" id="codeMassar" name="codeMassar" class="form-control" placeholder="Entrez votre Code Massar" required>
            @error('codeMassar')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Date de Naissance -->
        <div class="mb-3">
            <label for="dateNaissance" class="form-label">Date de Naissance / تاريخ الميلاد</label>
            <input type="date" id="dateNaissance" name="dateNaissance" class="form-control" required>
            @error('dateNaissance')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Année d'Obtention du Bac -->
        <div class="mb-3">
            <label for="anneeBac" class="form-label">Année d'Obtention du Bac / سنة الحصول على البكالوريا</label>
            <select id="anneeBac" name="anneeBac" class="form-select" required>
                <option value="" disabled selected>Choisissez une année / اختر سنة</option>
                @php
                    $currentYear = date('Y');
                    for ($year = $currentYear; $year >= 1980; $year--) {
                        echo "<option value=\"$year\">$year</option>";
                    }
                @endphp
            </select>
            @error('anneeBac')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Captcha -->
        <div class="mb-3">
            <label for="captcha" class="form-label">Captcha / كود التحقق</label>
            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
            @error('g-recaptcha-response')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Agree to Rules -->
        <div class="form-check mb-3">
            <input type="checkbox" id="agreeRules" name="agreeRules" class="form-check-input" required>
            <label for="agreeRules" class="form-check-label">J'accepte les règles / أوافق على القوانين</label>
            @error('agreeRules')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Rechercher / بحث
            </button>
        </div>
    </form>

    @push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endsection
