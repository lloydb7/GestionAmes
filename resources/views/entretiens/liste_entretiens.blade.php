@extends('layouts.app')

@section('title', 'Mes Entretiens Réalisés')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-list"></i> Mes Entretiens Réalisés</h3>
            <!--
            <a href="{{ route('entretiens.create', Auth::user()->id) }}" class="btn btn-success btn-sm shadow">
                <i class="fas fa-plus-circle"></i> Ajouter Entretien
            </a>
            -->
        </div>

        <div class="card-body">
            <!-- Champ de recherche swag -->
            <div class="mb-4">
                <form method="GET" action="{{ route('entretiens.liste_entretiens') }}" class="d-flex align-items-center justify-content-center">
                    <div class="input-group shadow-sm" style="max-width: 400px;">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-primary" 
                            placeholder="Rechercher un entretien..." value="{{ request('search') }}">
                    </div>

                    <button class="btn btn-primary ms-3 shadow" type="submit">
                        <i class="fas fa-search"></i> Rechercher
                    </button>

                    @if(request('search'))
                        <a href="{{ route('entretiens.liste_entretiens') }}" class="btn btn-danger ms-3 shadow">
                            <i class="fas fa-times-circle"></i> Réinitialiser
                        </a>
                    @endif
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Date</th>
                            <th>Âme</th>
                            <th># Entretien</th>
                            <th>Évaluation</th>
                            <th>Voir</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entretiens as $entretien)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y') }}</td>
                            <td><strong>{{ $entretien->ame->nom }} {{ $entretien->ame->prenom }}</strong></td>
                            <td><strong>{{ $entretien->numero_entretien }} </strong></td>
                            <td>
                                <span class="badge 
                                    {{ $entretien->evaluation == 'faible engagement' ? 'bg-danger' :
                                       ($entretien->evaluation == 'moyen engagement' ? 'bg-warning' :
                                       ($entretien->evaluation == 'fort engagement' ? 'bg-info' : 'bg-success')) }}">
                                    {{ ucfirst($entretien->evaluation) }}
                                </span>
                            </td>
                            <td>                                
                                <a href="{{ route('entretiens.show', $entretien->id) }}" class="btn btn-outline-info btn-sm shadow">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('entretiens.edit', $entretien->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                            </td>

                            <td>
                                <form action="{{ route('entretiens.destroy', $entretien->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cet entretien ?');">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
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
                        @if ($entretiens->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted rounded-circle">
                                    <i class="fas fa-angle-double-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link text-primary border-primary rounded-circle" href="{{ $entretiens->previousPageUrl() }}">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Numéros de Pages Stylés -->
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
                                <a class="page-link text-primary border-primary rounded-circle" href="{{ $entretiens->nextPageUrl() }}">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted rounded-circle">
                                    <i class="fas fa-angle-double-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
