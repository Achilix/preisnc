{{-- filepath: resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.layout')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="mb-4 text-center">Mot de passe oublié ?</h2>
        <div class="mb-4 text-secondary text-center">
            {{ __('Vous avez oublié votre mot de passe ? Entrez votre adresse email et nous vous enverrons un lien pour le réinitialiser.') }}
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror"
                       type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                    Envoyer le lien de réinitialisation
                </button>
            </div>
        </form>
    </div>
@endsection
