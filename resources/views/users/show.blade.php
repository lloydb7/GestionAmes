@extends('layouts.app')

@section('title', 'Détails de l\'Utilisateur')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h3 class="mb-0"><i class="fas fa-user-circle"></i> Détails de l'Utilisateur</h3>
                </div>

                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=100&rounded=true" 
                             alt="Avatar de {{ $user->name }}" 
                             class="rounded-circle shadow-sm">
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-user me-2 text-primary"></i>
                            <strong>Nom :</strong> {{ $user->name }}
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <strong>Email :</strong> {{ $user->email }}
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-user-tag me-2 text-primary"></i>
                            <strong>Rôle :</strong> <span class="badge bg-dark">{{ ucfirst($user->role) }}</span>
                        </li>
                    </ul>
                </div>

                <div class="card-footer text-center bg-light rounded-bottom">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
