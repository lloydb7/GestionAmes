@extends('layouts.app')

@section('title', isset($ame) ? 'Modifier l\'Entretien de ' . $ame->nom . ' ' . $ame->prenom : 'Modifier l\'Entretien')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-edit"></i> Modifier l'Entretien</h3>

            <!-- Affichage des erreurs -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('entretiens.index', $entretien->ame_id) }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('entretiens.update', $entretien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de l'Entretien</label>
                    <input type="date" name="date_entretien" class="form-control" value="{{ $entretien->date_entretien }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-exclamation-triangle"></i> Défis rencontrés</label>
                    <textarea name="defis" class="form-control" rows="2">{{ $entretien->defis }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-sticky-note"></i> Résumé/Recommandation</label>
                    <textarea name="resume" class="form-control" rows="2">{{ $entretien->resume }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-chart-line"></i> Niveau d'Engagement</label>
                    <select name="evaluation" class="form-select">
                        <option value="faible" {{ $entretien->evaluation == 'faible' ? 'selected' : '' }}>Faible Engagement</option>
                        <option value="moyen" {{ $entretien->evaluation == 'moyen' ? 'selected' : '' }}>Moyen Engagement</option>
                        <option value="engagé" {{ $entretien->evaluation == 'engagé' ? 'selected' : '' }}>Engagé</option>
                        <option value="très engagé" {{ $entretien->evaluation == 'très engagé' ? 'selected' : '' }}>Très Engagé</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="fas fa-save"></i> Mettre à Jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
