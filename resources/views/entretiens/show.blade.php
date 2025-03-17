@extends('layouts.app')

@section('title', 'Détails de l\'Entretien')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-eye"></i> Détails de l'Entretien</h3>

            <!-- Bouton Retour vers la page précédente -->
            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm shadow">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <h4 class="text-center text-uppercase fw-bold">{{ $ame->nom }} {{ $ame->prenom }}</h4>

            <div class="row mt-4">
                <!-- Colonne 1 -->
                <div class="col-md-6">
                    <p><i class="fas fa-hashtag"></i> <strong>Numéro d'Entretien :</strong> 
                        <span class="badge bg-primary">#{{ $entretien->numero_entretien }}</span>
                    </p>
                    <p><i class="fas fa-calendar-alt"></i> <strong>Date de l'Entretien :</strong> 
                        {{ \Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y') }}
                    </p>
                    <p><i class="fas fa-user"></i> <strong>Évangéliste :</strong> {{ $entretien->user->name }}</p>
                    <p><i class="fas fa-exclamation-triangle"></i> <strong>Défis :</strong> 
                        {{ $entretien->defis ?? 'Aucun' }}
                    </p>
                </div>

                <!-- Colonne 2 -->
                <div class="col-md-6">
                    <p><i class="fas fa-sticky-note"></i> <strong>Résumé :</strong> 
                        {{ $entretien->resume ?? 'Non spécifié' }}
                    </p>
                    <p><i class="fas fa-chart-line"></i> <strong>Évaluation :</strong> 
                        <span class="badge 
                            {{ $entretien->evaluation == 'faible engagement' ? 'bg-danger' :
                               ($entretien->evaluation == 'moyen engagement' ? 'bg-warning' :
                               ($entretien->evaluation == 'fort engagement' ? 'bg-info' : 'bg-success')) }}">
                            {{ ucfirst($entretien->evaluation) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des Suivis -->
    @if($suivis->count() > 0)
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-secondary text-white">
                <h3 class="mb-0"><i class="fas fa-history"></i> Rappel Historique des Suivis</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>Date d'Appel</th>
                                <th>Venu à l'Église</th>
                                <th>Formation Initiale</th>
                                <th>Famille Impact</th>
                                <th>Niveau d'Engagement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suivis as $suivi)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($suivi->date_appel)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge {{ $suivi->venu_eglise ? 'bg-success' : 'bg-danger' }}">
                                        {{ $suivi->venu_eglise ? 'Oui ('.\Carbon\Carbon::parse($suivi->date_venu_eglise)->format('d/m/Y').')' : 'Non' }}
                                    </span>
                                </td>
                                <td>
                                    @if($suivi->formation_initiale)
                                        <span class="badge bg-info">
                                            Commencé : {{ \Carbon\Carbon::parse($suivi->date_debut_formation)->format('d/m/Y') }} 
                                            ({{ ucfirst($suivi->etat_formation) }})
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Non inscrit</span>
                                    @endif
                                </td>
                                <td>
                                    @if($suivi->assiste_famille_impact)
                                        <span class="badge bg-info">
                                            Présent : {{ \Carbon\Carbon::parse($suivi->date_famille_impact)->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Non assisté</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge 
                                        {{ $suivi->niveau_engagement == 'faible' ? 'bg-danger' :
                                        ($suivi->niveau_engagement == 'moyen' ? 'bg-warning' :
                                        ($suivi->niveau_engagement == 'engagé' ? 'bg-info' : 'bg-success')) }} ">
                                        {{ ucfirst($suivi->niveau_engagement) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Stylisée -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Pagination">
                        <ul class="pagination pagination-lg shadow-lg">
                            <!-- Bouton "Précédent" -->
                            @if ($suivis->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link text-primary border-primary" href="{{ $suivis->previousPageUrl() }}">
                                        <i class="fas fa-angle-double-left"></i>
                                    </a>
                                </li>
                            @endif

                            <!-- Numéros de Pages -->
                            @foreach ($suivis->getUrlRange(1, $suivis->lastPage()) as $page => $url)
                                <li class="page-item {{ $suivis->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link {{ $suivis->currentPage() == $page ? 'bg-primary text-white border-primary' : 'text-primary border-primary' }}" href="{{ $url }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            <!-- Bouton "Suivant" -->
                            @if ($suivis->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link text-primary border-primary" href="{{ $suivis->nextPageUrl() }}">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    @else
        <!-- Message si aucun suivi trouvé -->
        <p class="text-center mt-3 text-muted">Aucun suivi enregistré pour cette âme.</p>
    @endif

</div>

@endsection
