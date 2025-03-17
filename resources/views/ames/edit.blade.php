@extends('layouts.app')

@section('title', 'Modifier une Âme')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h3 class="mb-0"><i class="fas fa-edit"></i> Modifier une Âme</h3>
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

            <form action="{{ route('ames.update', $ame->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $ame->nom) }}" required>
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $ame->prenom) }}" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Sexe -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Sexe</label>
                        <select name="sexe" class="form-select">
                            <option value="Masculin" {{ $ame->sexe == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                            <option value="Féminin" {{ $ame->sexe == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>

                    <!-- Âge -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar"></i> Âge</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age', $ame->age) }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Adresse -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Adresse</label>
                        <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $ame->adresse) }}">
                    </div>

                    <!-- Téléphone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $ame->telephone) }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Date de Premier Contact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de Premier Contact</label>
                        <input type="date" name="date_premier_contact" class="form-control" value="{{ old('date_premier_contact', $ame->date_premier_contact) }}" required>
                    </div>

                    <!-- Évangéliste -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user-tie"></i> Évangéliste</label>
                        <select name="user_id" class="form-select">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $ame->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Famille Impact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-users"></i> Famille Impact</label>
                        <select name="famille_impact_id" class="form-select">
                            <option value="" {{ is_null($ame->famille_impact_id) ? 'selected' : '' }}>Non affecté</option>
                            @foreach($familles as $famille)
                                <option value="{{ $famille->id }}" {{ $ame->famille_impact_id == $famille->id ? 'selected' : '' }}>
                                    {{ $famille->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Prière du Salut -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-praying-hands"></i> Prière du Salut</label>
                        <select name="priere_du_salut" class="form-select">
                            <option value="1" {{ $ame->priere_du_salut == 1 ? 'selected' : '' }}>Oui</option>
                            <option value="0" {{ $ame->priere_du_salut == 0 ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Invitation au Temple -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-church"></i> Invitation au Temple</label>
                        <select name="invitation_temple" class="form-select">
                            <option value="1" {{ $ame->invitation_temple == 1 ? 'selected' : '' }}>Oui</option>
                            <option value="0" {{ $ame->invitation_temple == 0 ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>

                    <!-- Invitation à la FI -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-book"></i> Invitation à la FI</label>
                        <select name="invitation_fi" class="form-select">
                            <option value="1" {{ $ame->invitation_fi == 1 ? 'selected' : '' }}>Oui</option>
                            <option value="0" {{ $ame->invitation_fi == 0 ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <!-- 
                    <a href="{{ route('ames.index') }}" class="btn btn-secondary btn-lg">
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
