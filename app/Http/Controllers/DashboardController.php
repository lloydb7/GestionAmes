<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Ame;
use App\Models\Suivi;
use App\Models\Entretien;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'star') {
            $queryAmes = Ame::where('user_id', $user->id);
        } else {
            $queryAmes = Ame::query();
        }

        $total_ames = $queryAmes->count();
        $total_accept_christ = $queryAmes->where('priere_du_salut', true)->count();

        $total_suivis = Suivi::whereIn('ame_id', $queryAmes->pluck('id'))->distinct('ame_id')->count('ame_id');
        $total_eglise = Suivi::where('venu_eglise', true)->whereIn('ame_id', $queryAmes->pluck('id'))->distinct('ame_id')->count('ame_id');
        $total_fi = Suivi::where('formation_initiale', true)->whereIn('ame_id', $queryAmes->pluck('id'))->distinct('ame_id')->count('ame_id');
        $total_famille = Suivi::where('assiste_famille_impact', true)->whereIn('ame_id', $queryAmes->pluck('id'))->distinct('ame_id')->count('ame_id');

        $entretiens = Entretien::whereIn('ame_id', $queryAmes->pluck('id'));
        $total_premier_entretien = $entretiens->where('numero_entretien', 1)->distinct('ame_id')->count('ame_id');
        $total_deuxieme_entretien = Entretien::whereIn('ame_id', $queryAmes->pluck('id'))->where('numero_entretien', 2)->distinct('ame_id')->count('ame_id');
        $total_troisieme_entretien = Entretien::whereIn('ame_id', $queryAmes->pluck('id'))->where('numero_entretien', 3)->distinct('ame_id')->count('ame_id');

        $denominateur = $total_ames > 0 ? $total_ames : 1;

        $pourcent_accept = round(($total_accept_christ / $denominateur) * 100, 2);
        $pourcent_suivi = round(($total_suivis / $denominateur) * 100, 2);
        $pourcent_eglise = round(($total_eglise / $denominateur) * 100, 2);
        $pourcent_fi = round(($total_fi / $denominateur) * 100, 2);
        $pourcent_famille = round(($total_famille / $denominateur) * 100, 2);
        $pourcent_premier = round(($total_premier_entretien / $denominateur) * 100, 2);
        $pourcent_deuxieme = round(($total_deuxieme_entretien / $denominateur) * 100, 2);
        $pourcent_troisieme = round(($total_troisieme_entretien / $denominateur) * 100, 2);

        $amesParMois = Ame::select(
            DB::raw("MONTH(date_premier_contact) as mois"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy(DB::raw("MONTH(date_premier_contact)"))
        ->pluck('total', 'mois')
        ->toArray();

        $premierEntretienParMois = Entretien::where('numero_entretien', 1)
        ->select(
            DB::raw("MONTH(date_entretien) as mois"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy(DB::raw("MONTH(date_entretien)"))
        ->pluck('total', 'mois')
        ->toArray();

        // Nombre de stars pour admin
        $total_stars = null;
        if ($user->role !== 'star') {
            $total_stars = User::where('role', 'star')->count();
        }

        return view('dashboard', compact(
            'total_ames', 'total_accept_christ', 'pourcent_accept',
            'total_suivis', 'pourcent_suivi', 'total_eglise', 'pourcent_eglise',
            'total_fi', 'pourcent_fi', 'total_famille', 'pourcent_famille',
            'total_premier_entretien', 'pourcent_premier',
            'total_deuxieme_entretien', 'pourcent_deuxieme',
            'total_troisieme_entretien', 'pourcent_troisieme','amesParMois', 'premierEntretienParMois','total_stars'
        ));
    }

    public function exportTableau(){
        $data = DB::table('ames')
            ->leftJoin('users', 'ames.user_id', '=', 'users.id')
            ->leftJoin('suivis', function($join) {
                $join->on('suivis.ame_id', '=', 'ames.id')
                     ->whereRaw('suivis.date_appel = (SELECT MAX(date_appel) FROM suivis s WHERE s.ame_id = ames.id)');
            })
            ->leftJoin('entretiens', 'entretiens.ame_id', '=', 'ames.id')
            ->select(
                'ames.date_premier_contact',
                'users.name as star_name',
                'ames.nom',
                'ames.prenom',
                'ames.telephone',
                'suivis.date_appel as dernier_suivi',
                DB::raw('CASE WHEN suivis.venu_eglise = 1 THEN "Oui" ELSE "Non" END as venu_eglise'),
                DB::raw('CASE WHEN suivis.assiste_famille_impact = 1 THEN "Oui" ELSE "Non" END as famille_impact'),
                DB::raw('CASE WHEN suivis.formation_initiale = 1 THEN "Oui" ELSE "Non" END as formation_initiale'),
                DB::raw('COALESCE(MAX(entretiens.numero_entretien), "Aucun") as numero_entretien')
            )
            ->groupBy('ames.id')
            ->get();
    
        return view('rapports.tableau', compact('data'));
    }
    
}
