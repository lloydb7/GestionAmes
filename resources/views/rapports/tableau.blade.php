@extends('layouts.app')

@section('title', 'Tableau de Suivi des Âmes')

@section('content')
<div class="container mt-4">
    <h3 class="text-center mb-4">Tableau de Suivi des Âmes</h3>

    <!-- Bouton d'exportation CSV -->
    <a href="{{ route('rapport.exportCSV') }}" class="btn btn-success mb-3">
         <i class="fas fa-file-csv"></i> Exporter en CSV
    </a>

    <!-- Tableau des données -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="bg-light">
                <tr>
                    <th>Date Premier Contact</th>
                    <th>Évangéliste (Star)</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Dernier Appel</th>
                    <th>Venu à l'Église</th>
                    <th>Famille d'Impact</th>
                    <th>Formation Initiale</th>
                    <th>Numéro Entretien</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row->date_premier_contact)->format('d/m/Y') }}</td>
                    <td>{{ $row->star_name }}</td>
                    <td>{{ $row->nom }}</td>
                    <td>{{ $row->prenom }}</td>
                    <td>{{ $row->telephone }}</td>
                    <td>{{ $row->dernier_suivi ? \Carbon\Carbon::parse($row->dernier_suivi)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $row->venu_eglise }}</td>
                    <td>{{ $row->famille_impact }}</td>
                    <td>{{ $row->formation_initiale }}</td>
                    <td>{{ $row->numero_entretien }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">Aucune donnée disponible.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    
    </div>
</div>
@endsection

<!-- Swag Pagination Style -->
<style>
.pagination .page-item.active .page-link {
    background-color: #6610f2;
    color: white;
    border-radius: 50%;
    border: none;
}

.pagination .page-link {
    color: #6610f2;
    margin: 0 4px;
    border-radius: 50%;
    border: 1px solid #6610f2;
}

.pagination .page-link:hover {
    background-color: #6610f2;
    color: white;
}
</style>