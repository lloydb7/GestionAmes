@extends('layouts.app')

@section('title', 'Suivi des Âmes')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-user-check"></i> Suivi des Âmes</h3>
        </div>

        <div class="card-body">
            <!-- Champ de recherche swag -->
            <div class="mb-4">
                <form method="GET" action="{{ route('suivis.index') }}" class="d-flex align-items-center justify-content-center">
                    <div class="input-group shadow-sm" style="max-width: 400px;">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-primary" 
                               placeholder="Rechercher une âme suivie..." value="{{ request('search') }}">
                    </div>

                    <button class="btn btn-primary ms-3 shadow" type="submit">
                        <i class="fas fa-search"></i> Rechercher
                    </button>

                    @if(request('search'))
                        <a href="{{ route('suivis.index') }}" class="btn btn-danger ms-3 shadow">
                            <i class="fas fa-times-circle"></i> Réinitialiser
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Âme</th>
                            <th>Date Premier Contact</th>
                            <th>Date Dernier Appel</th>
                            <th>Venu à l'Église</th>
                            <th>Formation Initiale</th>
                            <th>Famille Impact</th>
                            <th>Star</th>
                            @if(Auth::user()->role === 'star')
                            <th>Star</th>
                            @endif
                            <th>Historique</th>
                            <th>Entretien</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suivis as $suivi)
                        <tr>
                            <td><strong>{{ $suivi->ame->nom }} {{ $suivi->ame->prenom }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($suivi->ame->date_premier_contact)->format('d/m/Y') }}</td>
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
                            <td><span class="badge bg-success">{{ $suivi->user->name }}</span></td>
                            @if(Auth::user()->role === 'star')
                            <td>

                                
                                    <a href="{{ route('suivis.create', $suivi->ame->id) }}" class="btn btn-sm btn-outline-primary shadow">
                                        <i class="fas fa-plus-circle"></i> Ajouter Suivi
                                    </a>
                            </td>
                            @endif
                            <td>
                                <!-- Bouton Historique -->
                                <a href="{{ route('suivis.historique', $suivi->ame->id) }}" class="btn btn-sm btn-outline-secondary shadow">
                                    <i class="fas fa-history"></i> Historique
                                </a>
                                

                            </td>
                            <td>
                                <!-- Ajout du bouton "Entretien" -->
                                <a href="{{ route('entretiens.index', $suivi->ame->id) }}" class="btn btn-outline-primary btn-sm shadow">
                                    <i class="fas fa-comments"></i> Entretiens
                                </a>
                            </td>
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

            <!-- CSS personnalisé pour la pagination -->
            <style>
                .pagination .page-item .page-link {
                    color: #007bff;
                    border: 1px solid #007bff;
                    padding: 10px 15px;
                    margin: 3px;
                    border-radius: 8px;
                    transition: all 0.3s ease-in-out;
                }

                .pagination .page-item.active .page-link {
                    background-color: #007bff;
                    color: white;
                    border-radius: 8px;
                    font-weight: bold;
                    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
                }

                .pagination .page-item .page-link:hover {
                    background-color: #0056b3;
                    color: white;
                    transform: scale(1.1);
                }

                .pagination .page-item.disabled .page-link {
                    background-color: #e9ecef;
                    color: #6c757d;
                    border: none;
                    cursor: not-allowed;
                }

                .rounded-circle {
                    border-radius: 50px !important;
                }
            </style>

        </div>
    </div>
</div>
@endsection
