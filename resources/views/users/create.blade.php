@extends('layouts.app')

@section('title', 'Créer un Utilisateur')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 text-center"><i class="fas fa-user-plus"></i> Ajouter un Utilisateur</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <!-- Champ Nom -->
                        <div class="form-group mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Nom :</label>
                            <input type="text" name="name" class="form-control" placeholder="Entrez le nom" required>
                        </div>

                        <!-- Champ Email -->
                        <div class="form-group mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email :</label>
                            <input type="email" name="email" class="form-control" placeholder="Entrez l'email" required>
                        </div>

                        <!-- Champ Mot de Passe -->
                        <div class="form-group mb-3">
                            <label class="form-label"><i class="fas fa-lock"></i> Mot de passe :</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <!-- Sélection du Rôle -->
                        <div class="form-group mb-3">
                            <label class="form-label"><i class="fas fa-user-tag"></i> Rôle :</label>
                            <select name="role" class="form-control">
                                <option value="super_admin">Super Admin</option>
                                <option value="admin_general">Administrateur Général</option>
                                <option value="star">Évangéliste (STAR)</option>
                            </select>
                        </div>

                        <!-- Bouton Soumettre -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Enregistrer l'Utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bouton Retour -->
            <div class="text-center mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
