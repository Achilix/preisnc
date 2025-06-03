@extends('layouts.layout')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="mb-4 text-center">Réinitialiser le mot de passe</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autofocus>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">
                    Réinitialiser le mot de passe
                </button>
            </div>
        </form>
    </div>
@endsection
