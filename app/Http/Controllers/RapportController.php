<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // obligatoire
use Illuminate\Http\Request;

class RapportController extends Controller{

    public function exportTableau()
    {
        $query = DB::table('ames')
        ->leftJoin('users', 'ames.user_id', '=', 'users.id')
        ->select(
            'ames.id',
            'ames.date_premier_contact',
            'users.name AS star_name',
            'ames.nom',
            'ames.prenom',
            'ames.telephone',
            DB::raw('(SELECT MAX(date_appel) FROM suivis WHERE suivis.ame_id = ames.id) AS dernier_suivi'),
            DB::raw('(SELECT venu_eglise FROM suivis WHERE suivis.ame_id = ames.id ORDER BY date_appel DESC LIMIT 1) AS venu_eglise'),
            DB::raw('(SELECT assiste_famille_impact FROM suivis WHERE suivis.ame_id = ames.id ORDER BY date_appel DESC LIMIT 1) AS famille_impact'),
            DB::raw('(SELECT formation_initiale FROM suivis WHERE suivis.ame_id = ames.id ORDER BY date_appel DESC LIMIT 1) AS formation_initiale'),
            DB::raw('(SELECT MAX(numero_entretien) FROM entretiens WHERE entretiens.ame_id = ames.id) AS numero_entretien')
        );
    
        $data = $query->paginate(10)->appends($request->all());
    
    
        return view('rapports.tableau', compact('data'));
    }
    
    public function exportCSV()
    {
        $data = DB::table('ames')
            ->leftJoin('users', 'ames.user_id', '=', 'users.id')
            ->leftJoin(DB::raw('
                (SELECT ame_id, MAX(date_appel) AS dernier_suivi, venu_eglise, assiste_famille_impact, formation_initiale
                FROM suivis
                GROUP BY ame_id) AS suivis_max
            '), 'suivis_max.ame_id', '=', 'ames.id')
            ->leftJoin(DB::raw('
                (SELECT ame_id, MAX(numero_entretien) AS numero_entretien
                FROM entretiens
                GROUP BY ame_id) AS entretiens_max
            '), 'entretiens_max.ame_id', '=', 'ames.id')
            ->select(
                'ames.date_premier_contact',
                'users.name AS star_name',
                'ames.nom',
                'ames.prenom',
                'ames.telephone',
                'suivis_max.dernier_suivi',
                DB::raw('CASE WHEN suivis_max.venu_eglise = 1 THEN "Oui" ELSE "Non" END AS venu_eglise'),
                DB::raw('CASE WHEN suivis_max.assiste_famille_impact = 1 THEN "Oui" ELSE "Non" END AS famille_impact'),
                DB::raw('CASE WHEN suivis_max.formation_initiale = 1 THEN "Oui" ELSE "Non" END AS formation_initiale'),
                DB::raw('COALESCE(entretiens_max.numero_entretien, "Aucun") AS numero_entretien')
            )
            ->get();
            //->paginate(10);
    
        // Générer le contenu CSV
        $csvHeader = [
            'Date Premier Contact', 'Évangéliste', 'Nom', 'Prénom', 'Téléphone',
            'Dernier Suivi', 'Venu Église', 'Famille Impact', 'Formation Initiale', 'Numéro Entretien'
        ];
    
        $csvData = $data->map(function($row) {
            return (array) $row;
        });
    
        $filename = 'rapport_ames.csv';
    
        // Stream CSV
        $callback = function() use ($csvHeader, $csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeader);
    
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
    
        return Response::stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename"
        ]);
    }
    
}
