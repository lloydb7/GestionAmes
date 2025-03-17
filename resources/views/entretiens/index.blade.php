@extends('layouts.app')

@section('title', 'Entretiens de ' . $ame->nom . ' ' . $ame->prenom)

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-comments"></i> Entretiens de {{ $ame->nom }} {{ $ame->prenom }}</h3>
            <a href="{{ route('entretiens.create', $ame->id) }}" class="btn btn-success btn-sm shadow">
                <i class="fas fa-plus-circle"></i> Ajouter Entretien
            </a>

            <!-- Bouton Retour vers la page précédente -->
            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm shadow">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            @if($entretiens->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th> <!-- Numéro d'Entretien -->
                                <th>Date</th>
                                <th>Défis</th>
                                <th>Résumé</th>
                                <th>Évaluation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entretiens as $entretien)
                            <tr>
                                <td><strong>{{ $entretien->numero_entretien }}</strong></td> <!-- Affichage du Numéro d'Entretien -->
                                <td>{{ \Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y') }}</td>
                                <td>{{ $entretien->defis ?? 'Aucun' }}</td>
                                <td>{{ $entretien->resume ?? 'Non spécifié' }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $entretien->evaluation == 'faible engagement' ? 'bg-danger' :
                                           ($entretien->evaluation == 'moyen engagement' ? 'bg-warning text-dark' :
                                           ($entretien->evaluation == 'fort engagement' ? 'bg-info' : 'bg-success')) }}">
                                        {{ ucfirst($entretien->evaluation) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('entretiens.edit', $entretien->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
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

                            <!-- Numéros de Page Stylisés -->
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

            @else
                <p class="text-center">Aucun entretien enregistré pour cette âme.</p>
            @endif
        </div>
    </div>
</div>
@endsection
