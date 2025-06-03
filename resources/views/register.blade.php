@extends('layouts.layout')

@section('title', 'Étape 0 - Préinscription')

@section('content')
    <h1 class="text-center mb-4">Étape 0 - Préinscription / التسجيل المسبق</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email / البريد الإلكتروني</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="confirmEmail" class="form-label">Confirmez l'Email / تأكيد البريد الإلكتروني</label>
            <input type="email" id="confirmEmail" name="confirmEmail" class="form-control" value="{{ old('confirmEmail') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de Passe / كلمة المرور</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmez le Mot de Passe / تأكيد كلمة المرور</label>
            <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" required>
        </div>
            <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
            @error('g-recaptcha-response')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                Valider / تحقق
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
