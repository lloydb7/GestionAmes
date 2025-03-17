@extends('layouts.app')

@section('title', 'Modifier une Famille Impact')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h3 class="mb-0"><i class="fas fa-edit"></i> Modifier la Famille Impact</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('familles.update', $famille->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-users"></i> Nom de la Famille</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $famille->nom) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nom du Pilote 1</label>
                        <input type="text" name="pilote1_nom" class="form-control" value="{{ old('pilote1_nom', $famille->pilote1_nom) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Téléphone du Pilote 1</label>
                        <input type="text" name="pilote1_tel" class="form-control" value="{{ old('pilote1_tel', $famille->pilote1_tel) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nom du Pilote 2 (Facultatif)</label>
                        <input type="text" name="pilote2_nom" class="form-control" value="{{ old('pilote2_nom', $famille->pilote2_nom) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Téléphone du Pilote 2 (Facultatif)</label>
                        <input type="text" name="pilote2_tel" class="form-control" value="{{ old('pilote2_tel', $famille->pilote2_tel) }}">
                    </div>
                </div>

                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('familles.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
