@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h3 class="mb-0 flex-grow-1"><i class="fas fa-user"></i> Détails de l'Âme</h3>
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
                    <p><i class="fas fa-venus-mars"></i> <strong>Sexe :</strong> {{ $ame->sexe }}</p>
                    <p><i class="fas fa-birthday-cake"></i> <strong>Âge :</strong> {{ $ame->age }} ans</p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Adresse :</strong> {{ $ame->adresse ?? 'Non renseigné' }}</p>
                    <p><i class="fas fa-phone"></i> <strong>Téléphone :</strong> {{ $ame->telephone ?? 'Non renseigné' }}</p>
                    <p><i class="fas fa-user-tie"></i> <strong>Évangéliste en charge :</strong> {{ $ame->user->name ?? 'Non assigné' }}</p>
                </div>

                <!-- Colonne 2 -->
                <div class="col-md-6">
                    <p><i class="fas fa-users"></i> <strong>Famille Impact :</strong> {{ $ame->familleImpact->nom ?? 'Non assigné' }}</p>
                    <p><i class="fas fa-calendar-alt"></i> <strong>Date de Premier Contact :</strong> 
                        {{ \Carbon\Carbon::parse($ame->date_premier_contact)->format('d/m/Y') ?? 'Non renseigné' }}
                    </p>
                    <p><i class="fas fa-praying-hands"></i> <strong>Prière du Salut :</strong> 
                        <span class="badge {{ $ame->priere_du_salut ? 'bg-success' : 'bg-danger' }}">
                            {{ $ame->priere_du_salut ? 'Oui' : 'Non' }}
                        </span>
                    </p>
                    <p><i class="fas fa-church"></i> <strong>Invitation au Temple :</strong> 
                        <span class="badge {{ $ame->invitation_temple ? 'bg-success' : 'bg-danger' }}">
                            {{ $ame->invitation_temple ? 'Oui' : 'Non' }}
                        </span>
                    </p>
                    <p><i class="fas fa-book"></i> <strong>Formation Initiale :</strong> 
                        <span class="badge {{ $ame->invitation_fi ? 'bg-success' : 'bg-danger' }}">
                            {{ $ame->invitation_fi ? 'Oui' : 'Non' }}
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
            <h3 class="mb-0"><i class="fas fa-history"></i> Historique des Suivis</h3>
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

                            @if(Auth::user()->role !== 'star')
                                <th>Évangéliste</th>
                            @endif
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
                                    <span class="badge bg-info">Commencé : {{ \Carbon\Carbon::parse($suivi->date_debut_formation)->format('d/m/Y') }} ({{ ucfirst($suivi->etat_formation) }})</span>
                                @else
                                    <span class="badge bg-secondary">Non inscrit</span>
                                @endif
                            </td>
                            <td>
                                @if($suivi->assiste_famille_impact)
                                    <span class="badge bg-info">Présent : {{ \Carbon\Carbon::parse($suivi->date_famille_impact)->format('d/m/Y') }}</span>
                                @else
                                    <span class="badge bg-secondary">Non assisté</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    {{ $suivi->niveau_engagement == 'faible' ? 'bg-danger' :
                                       ($suivi->niveau_engagement == 'moyen' ? 'bg-warning' :
                                       ($suivi->niveau_engagement == 'engagé' ? 'bg-info' : 'bg-success')) }}">
                                    {{ ucfirst($suivi->niveau_engagement) }}
                                </span>
                            </td>

                            @if(Auth::user()->role !== 'star')
                                <td><span class="badge bg-success">{{ $suivi->user->name }}</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination stylisée -->
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

                        <!-- Numéros de page stylisés -->
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
    @endif

    <!-- Historique des Entretiens -->
    @if($entretiens->count() > 0)
    <div class="card shadow-lg mt-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-comments"></i> Historique des Entretiens</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Date d'Entretien</th>
                            <th>Défis</th>
                            <th>Résumé</th>
                            <th>Évaluation</th>
                            @if(Auth::user()->role !== 'star')
                                <th>Évangéliste</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entretiens as $entretien)
                        <tr>
                            <td><strong>{{ \Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y') }}</strong></td>
                            <td>
                                <span class="badge {{ $entretien->defis ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                    {{ $entretien->defis ?? 'Aucun' }}
                                </span>
                            </td>
                            <td>{{ $entretien->resume ?? 'Non spécifié' }}</td>
                            <td>
                                <span class="badge 
                                    {{ $entretien->evaluation == 'faible engagement' ? 'bg-danger' :
                                    ($entretien->evaluation == 'moyen engagement' ? 'bg-warning text-dark' :
                                    ($entretien->evaluation == 'fort engagement' ? 'bg-info' : 'bg-success')) }}">
                                    {{ ucfirst($entretien->evaluation) }}
                                </span>
                            </td>
                            @if(Auth::user()->role !== 'star')
                                <td><span class="badge bg-primary">{{ $entretien->user->name }}</span></td>
                            @endif
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
                        @if ($entretiens->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="{{ $entretiens->previousPageUrl() }}">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Numéros de page stylisés -->
                        @foreach ($entretiens->getUrlRange(1, $entretiens->lastPage()) as $page => $url)
                            <li class="page-item {{ $entretiens->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link {{ $entretiens->currentPage() == $page ? 'bg-primary text-white border-primary' : 'text-primary border-primary' }}" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        <!-- Bouton "Suivant" -->
                        @if ($entretiens->hasMorePages())
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="{{ $entretiens->nextPageUrl() }}">
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
    @endif

</div>
@endsection
