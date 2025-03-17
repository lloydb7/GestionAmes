@extends('layouts.app')

@section('title', 'Ajouter un Entretien pour ' . $ame->nom . ' ' . $ame->prenom)

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-comments"></i> Ajouter un Entretien</h3>
            
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
            <!--
            <a href="{{ route('entretiens.index', $ame->id) }}" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            -->
            <!-- Bouton Retour vers la page précédente -->
            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>

        </div>

        <div class="card-body">
            <form action="{{ route('entretiens.store', $ame->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de l'Entretien</label>
                    <input type="date" name="date_entretien" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-exclamation-triangle"></i> Défis rencontrés</label>
                    <textarea name="defis" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-sticky-note"></i> Résumé/Recommandation</label>
                    <textarea name="resume" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-chart-line"></i> Niveau d'Engagement</label>
                    <select name="evaluation" class="form-select">
                        <option value="faible">Faible Engagement</option>
                        <option value="moyen">Moyen Engagement</option>
                        <option value="engagé">Engagé</option>
                        <option value="très engagé">Très Engagé</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
