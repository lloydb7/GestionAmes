@extends('layouts.app')

@section('title', 'Créer une Famille Impact')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-home"></i> Créer une Famille Impact</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('familles.store') }}" method="POST">
                        @csrf

                        <!-- Nom de la famille -->
                        <div class="form-group mb-3">
                            <label><i class="fas fa-users"></i> Nom de la famille</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Famille Lumière" required>
                        </div>

                        <!-- Pilote 1 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label><i class="fas fa-user"></i> Nom Pilote 1</label>
                                    <input type="text" name="pilote1_nom" class="form-control" placeholder="Nom du Pilote 1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label><i class="fas fa-phone"></i> Téléphone Pilote 1</label>
                                    <input type="text" name="pilote1_tel" class="form-control" placeholder="Téléphone Pilote 1" required>
                                </div>
                            </div>
                        </div>

                        <!-- Pilote 2 (Optionnel) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label><i class="fas fa-user"></i> Nom Pilote 2 (Optionnel)</label>
                                    <input type="text" name="pilote2_nom" class="form-control" placeholder="Nom du Pilote 2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label><i class="fas fa-phone"></i> Téléphone Pilote 2 (Optionnel)</label>
                                    <input type="text" name="pilote2_tel" class="form-control" placeholder="Téléphone Pilote 2">
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Créer la Famille
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- Bouton Retour -->
            <div class="text-center mt-3">
                <a href="{{ route('familles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
