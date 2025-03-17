@extends('layouts.app')

@section('title', 'Historique des Suivis')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-history"></i> Historique des Suivis - {{ $ame->nom }} {{ $ame->prenom }}</h3>
            <a href="{{ route('suivis.index') }}" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
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
                <nav>
                    <ul class="pagination pagination-lg">
                        <!-- Bouton Précédent -->
                        @if ($suivis->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="{{ $suivis->previousPageUrl() }}">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Numéros de Pages -->
                        @foreach ($suivis->getUrlRange(1, $suivis->lastPage()) as $page => $url)
                            <li class="page-item {{ $suivis->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Bouton Suivant -->
                        @if ($suivis->hasMorePages())
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="{{ $suivis->nextPageUrl() }}">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>

            <!-- Tableau des Entretiens -->
            <h4 class="text-center text-primary mt-5"><i class="fas fa-comments"></i> Entretiens de l'Âme</h4>
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
                            <td>{{ \Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y') }}</td>
                            <td>{{ $entretien->defis ?? 'Aucun' }}</td>
                            <td>{{ $entretien->resume ?? 'Non spécifié' }}</td>
                            <td>
                            <span class="badge 
                                {{ $entretien->evaluation == 'faible' ? 'bg-danger' :
                                ($entretien->evaluation == 'moyen' ? 'bg-warning' :
                                ($entretien->evaluation == 'engagé' ? 'bg-info' :
                                ($entretien->evaluation == 'très engagé' ? 'bg-success' : 'bg-secondary'))) }}">
                                {{ ucfirst($entretien->evaluation) }}
                            </span>
                            </td>
                            @if(Auth::user()->role !== 'star')
                                <td><span class="badge bg-success">{{ $entretien->user->name }}</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination stylisée entretiens-->
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination pagination-lg">
                        <!-- Bouton Précédent -->
                        @if ($suivis->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="{{ $suivis->previousPageUrl() }}">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Numéros de Pages -->
                        @foreach ($suivis->getUrlRange(1, $suivis->lastPage()) as $page => $url)
                            <li class="page-item {{ $suivis->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Bouton Suivant -->
                        @if ($suivis->hasMorePages())
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="{{ $suivis->nextPageUrl() }}">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
