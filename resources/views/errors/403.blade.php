{{-- filepath: resources/views/errors/403.blade.php --}}
@extends('layouts.layout')

@section('title', 'Erreur 403')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="display-1">403</h1>
    <h2>Accès refusé</h2>
    <p>{{ $exception->getMessage() ?: "Vous n'avez pas la permission d'accéder à cette page." }}</p>
</div>
@endsection
