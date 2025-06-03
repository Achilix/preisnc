@extends('layouts.layout')

@section('title', 'Connexion / تسجيل الدخول')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Connexion / تسجيل الدخول</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email / البريد الإلكتروني</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email / أدخل بريدك الإلكتروني" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe / كلمة المرور</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe / أدخل كلمة المرور" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Forgot Password Link -->
            <div class="mb-3 text-end">
                <a href="{{ route('password.request') }}" class="link-secondary" style="color: rgb(162, 80, 23)">
                    Mot de passe oublié ? / نسيت كلمة المرور؟
                </a>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary custom-btn">Connexion / تسجيل الدخول</button>
            </div>
        </form>
    </div>
@endsection
