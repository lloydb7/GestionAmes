@extends('layouts.app')

@section('title', 'Modifier l\'Utilisateur')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h3 class="mb-0"><i class="fas fa-user-edit"></i> Modifier l'Utilisateur</h3>
        </div>

        <div class="card-body p-4">
            <!-- Affichage des erreurs globaux -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nom :</label>
                        <input type="text" name="name" class="form-control shadow-sm @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email :</label>
                        <input type="email" name="email" class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Rôle -->
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user-tag"></i> Rôle :</label>
                    <select name="role" class="form-select shadow-sm @error('role') is-invalid @enderror">
                        <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>👑 Super Admin</option>
                        <option value="admin_general" {{ $user->role == 'admin_general' ? 'selected' : '' }}>⚙️ Administrateur Général</option>
                        <option value="star" {{ $user->role == 'star' ? 'selected' : '' }}>⭐ Évangéliste (STAR)</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nouveau Mot de Passe (Optionnel) -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Nouveau Mot de Passe (laisser vide pour ne pas changer) :</label>
                        <input type="password" name="password" class="form-control shadow-sm @error('password') is-invalid @enderror" placeholder="Laisser vide si inchangé">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Confirmer le Nouveau Mot de Passe :</label>
                        <input type="password" name="password_confirmation" class="form-control shadow-sm @error('password_confirmation') is-invalid @enderror" placeholder="Confirmez le mot de passe">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
