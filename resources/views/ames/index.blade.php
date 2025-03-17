@extends('layouts.app')

@section('title', 'Liste des Âmes Évangélisées')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-cross"></i> Liste des Âmes</h3>
        <a href="{{ route('ames.create') }}" class="btn btn-dark">
            <i class="fas fa-plus-circle"></i> Ajouter une Âme
        </a>
    </div>

    <div class="card-body">
        <!-- Champ de recherche -->
        <div class="mb-4">
            <form method="GET" action="{{ route('ames.index') }}" class="d-flex align-items-center justify-content-center">
                <!-- Champ de recherche avec icône -->
                <div class="input-group shadow-sm" style="max-width: 400px;">
                    <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control border-primary" placeholder="Rechercher une âme..." 
                        value="{{ request('search') }}">
                </div>

                <!-- Bouton de recherche stylé -->
                <button class="btn btn-primary ms-3 shadow" type="submit">
                    <i class="fas fa-search"></i> Rechercher
                </button>

                <!-- Bouton de réinitialisation stylé -->
                @if(request('search'))
                    <a href="{{ route('ames.index') }}" class="btn btn-danger ms-3 shadow">
                        <i class="fas fa-times-circle"></i> Réinitialiser
                    </a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
        <!-- Tableau des âmes -->
            <table class="table table-hover table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Premier Contact</th>
                        <th>Prière du Salut</th>
                        <th>Invitation au Temple</th>
                        <th>Formation Initiale</th>
                        <th>STAR</th>
                        <th>Famille Impact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ames as $ame)
                    <tr>
                        <td><strong>{{ $ame->nom }}</strong></td>
                        <td>{{ $ame->prenom }}</td>
                        <td>{{ $ame->date_premier_contact ? \Carbon\Carbon::parse($ame->date_premier_contact)->format('d/m/Y') : 'N/A' }}</td>
                        <td><span class="badge {{ $ame->priere_du_salut ? 'bg-success' : 'bg-danger' }}">{{ $ame->priere_du_salut ? 'Oui' : 'Non' }}</span></td>
                        <td><span class="badge {{ $ame->invitation_temple ? 'bg-success' : 'bg-danger' }}">{{ $ame->invitation_temple ? 'Oui' : 'Non' }}</span></td>
                        <td><span class="badge {{ $ame->invitation_fi ? 'bg-success' : 'bg-danger' }}">{{ $ame->invitation_fi ? 'Oui' : 'Non' }}</span></td>
                        <td><span class="badge {{ $ame->user ? 'bg-success' : 'bg-secondary' }}">{{ $ame->user->name ?? 'Non assigné' }}</span></td>
                        <td><span class="badge {{ $ame->familleImpact ? 'bg-info' : 'bg-secondary' }}">{{ $ame->familleImpact->nom ?? 'Non affecté' }}</span></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('ames.show', $ame->id) }}" class="dropdown-item"><i class="fas fa-eye"></i> Voir</a></li>
                                    <li><a href="{{ route('ames.edit', $ame->id) }}" class="dropdown-item"><i class="fas fa-edit"></i> Modifier</a></li>

                                    @if(Auth::user()->role === 'star')
                                    <li><a href="{{ route('suivis.create', $ame->id) }}" class="dropdown-item"><i class="fas fa-chart-line"></i> Ajouter Suivi</a></li>
                                    <li><a href="{{ route('entretiens.create', $ame->id) }}" class="dropdown-item"><i class="fas fa-comments"></i> Ajouter Entretien</a></li>
                                    @endif

                                    <li>
                                        <form action="{{ route('ames.destroy', $ame->id) }}" method="POST" class="dropdown-item">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Voulez-vous vraiment supprimer cette âme ?');">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <!-- Pagination Swag -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg shadow-lg">
                        <!-- Bouton "Précédent" -->
                        @if ($ames->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="{{ $ames->previousPageUrl() }}">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Numéros de page stylés -->
                        @foreach ($ames->getUrlRange(1, $ames->lastPage()) as $page => $url)
                            <li class="page-item {{ $ames->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link {{ $ames->currentPage() == $page ? 'bg-primary text-white border-primary' : 'text-primary border-primary' }}" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        <!-- Bouton "Suivant" -->
                        @if ($ames->hasMorePages())
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="{{ $ames->nextPageUrl() }}">
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
</div>
@endsection
