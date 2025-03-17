@extends('layouts.app')

@section('title', 'Ajouter une Âme')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-user-plus"></i> Nouvelle Âme</h3>

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
        </div>

        <div class="card-body">
            <form action="{{ route('ames.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nom</label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                               value="{{ old('nom') }}" placeholder="Entrez le nom" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Prénom</label>
                        <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                               value="{{ old('prenom') }}" placeholder="Entrez le prénom" required>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Sexe -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Sexe</label>
                        <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                            <option value="Masculin" {{ old('sexe') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                            <option value="Féminin" {{ old('sexe') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                        </select>
                        @error('sexe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Âge -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar"></i> Âge</label>
                        <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                               value="{{ old('age') }}" placeholder="Entrez l'âge" required>
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Adresse -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Adresse</label>
                        <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                               value="{{ old('adresse') }}" placeholder="Entrez l'adresse">
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                               value="{{ old('telephone') }}" placeholder="Entrez le téléphone">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Date de Premier Contact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de Premier Contact</label>
                        <input type="date" name="date_premier_contact" class="form-control @error('date_premier_contact') is-invalid @enderror" 
                               value="{{ old('date_premier_contact') }}" required>
                        @error('date_premier_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Utilisateur Connecté -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-star"></i> Star</label>
                        <input type="text" class="form-control input-solid" value="{{ Auth::user()->name }}" disabled>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Famille Impact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-users"></i> Famille Impact</label>
                        <select name="famille_impact_id" class="form-select @error('famille_impact_id') is-invalid @enderror">
                            <option value="">Non affecté</option>
                            @foreach($familles as $famille)
                                <option value="{{ $famille->id }}" {{ old('famille_impact_id') == $famille->id ? 'selected' : '' }}>
                                    {{ $famille->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('famille_impact_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prière du Salut -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-praying-hands"></i> Prière du Salut</label>
                        <select name="priere_du_salut" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Invitation au Temple -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-church"></i> Invitation au Temple</label>
                        <select name="invitation_temple" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>  
                        </select>
                    </div>

                    <!-- Invitation à la FI -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-book"></i> Invitation à la FI</label>
                        <select name="invitation_fi" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option> 
                        </select>
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('ames.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
