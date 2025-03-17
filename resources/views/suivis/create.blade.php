@extends('layouts.app')

@section('title', 'Ajouter un Suivi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h3 class="mb-0 flex-grow-1"><i class="fas fa-user-check"></i> Ajouter un Suivi</h3>
            <!-- 
            <a href="{{ route('suivis.index') }}" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            -->
            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
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

            <form action="{{ route('suivis.store', $ame->id) }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Nom de l'Âme -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Âme</label>
                        <input type="text" class="form-control" value="{{ $ame->nom }} {{ $ame->prenom }}" disabled>
                    </div>

                    <!-- Date de l'Appel -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de l'Appel</label>
                        <input type="date" name="date_appel" class="form-control @error('date_appel') is-invalid @enderror" required>
                        @error('date_appel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Défis -->
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-exclamation-circle"></i> Défis rencontrés</label>
                    <textarea name="defis" class="form-control @error('defis') is-invalid @enderror" rows="2"></textarea>
                    @error('defis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Venue à l'Église -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-church"></i> Venue à l'Église</label>
                        <select name="venu_eglise" class="form-select">
                            <option value="0">Non</option>    
                            <option value="1">Oui</option> 
                        </select>
                    </div>

                    <!-- Date de Venue à l'Église -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar"></i> Date de Venue</label>
                        <input type="date" name="date_venu_eglise" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <!-- Formation Initiale -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-graduation-cap"></i> Formation Initiale</label>
                        <select name="formation_initiale" class="form-select">
                            <option value="0">Non</option>    
                            <option value="1">Oui</option>            
                        </select>
                    </div>

                    <!-- Date de Début de Formation -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar"></i> Début de Formation</label>
                        <input type="date" name="date_debut_formation" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <!-- État de la Formation -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-tasks"></i> État de la Formation</label>
                        <select name="etat_formation" class="form-select">
                            <option value="">Non spécifié</option>
                            <option value="début">Début</option>
                            <option value="en cours">En cours</option>
                            <option value="terminé">Terminé</option>
                        </select>
                    </div>

                    <!-- Participation à la Famille Impact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-users"></i> Assiste à la Famille Impact</label>
                        <select name="assiste_famille_impact" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>
                </div>

                <!-- Niveau d'Engagement -->
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-chart-line"></i> Niveau d'Engagement</label>
                    <select name="niveau_engagement" class="form-select @error('niveau_engagement') is-invalid @enderror">
                        <option value="faible">Faible</option>
                        <option value="moyen">Moyen</option>
                        <option value="engagé">Engagé</option>
                        <option value="très engagé">Très Engagé</option>
                    </select>
                    @error('niveau_engagement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Enregistrer Suivi
                    </button>
                    <!--
                    <a href="{{ route('suivis.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                    -->
                    <!-- Bouton Retour vers la page précédente -->
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
