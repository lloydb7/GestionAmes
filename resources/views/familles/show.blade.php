@extends('layouts.app')

@section('title', 'Détails de la Famille Impact')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-users"></i> Détails de la Famille Impact</h3>
        </div>

        <div class="card-body">
            <h4>Nom de la Famille : {{ $famille->nom }}</h4>
            <p><strong>Pilote 1 :</strong> {{ $famille->pilote1_nom }} ({{ $famille->pilote1_tel }})</p>
            @if($famille->pilote2_nom)
                <p><strong>Pilote 2 :</strong> {{ $famille->pilote2_nom }} ({{ $famille->pilote2_tel }})</p>
            @endif

            <h4 class="mt-4">Liste des Âmes Affectées</h4>
            @if ($ames->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>A accepté le Seigneur</th>
                                <th>Invitation à l'Église</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ames as $ame)
                            <tr>
                                <td><strong>{{ $ame->nom }}</strong></td>
                                <td>{{ $ame->prenom }}</td>
                                <td>
                                    <span class="badge {{ $ame->priere_du_salut ? 'bg-success' : 'bg-danger' }}">
                                        {{ $ame->priere_du_salut ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $ame->invitation_temple ? 'bg-success' : 'bg-danger' }}">
                                        {{ $ame->invitation_temple ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">Aucune âme n'est rattachée à cette famille.</p>
            @endif
        </div>
    </div>

    <!-- Bouton Retour -->
    <div class="text-center mt-3">
        <a href="{{ route('familles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
