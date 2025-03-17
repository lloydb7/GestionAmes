<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Suivi;
use App\Models\Entretien;
use App\Models\Ame;
use Illuminate\Support\Facades\Auth;

class SuiviController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Récupérer uniquement le dernier suivi par âme
        $query = Suivi::select('suivis.*')
            ->join(DB::raw('(SELECT ame_id, MAX(date_appel) as max_date FROM suivis GROUP BY ame_id) as latest'), function ($join) {
                $join->on('suivis.ame_id', '=', 'latest.ame_id')
                    ->on('suivis.date_appel', '=', 'latest.max_date');
            })
            ->with('ame', 'user');

        // Si l'utilisateur est un évangéliste (star), il ne voit que ses suivis
        if ($user->role === 'star') {
            $query->where('suivis.user_id', $user->id);
        }

        // Filtrage par recherche
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('ame', function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('prenom', 'LIKE', "%{$search}%");
            });
        }

        $suivis = $query->paginate(10);

        return view('suivis.index', compact('suivis'));
    }
    

    public function create($ame_id)
    {
        $ame = Ame::findOrFail($ame_id);
        return view('suivis.create', compact('ame'));
    }

    public function store(Request $request, $ame_id)
    {
        $request->validate([
            'date_appel' => 'required|date',
            'defis' => 'nullable|string',
            'venu_eglise' => 'boolean',
            'date_venu_eglise' => 'nullable|date',
            'formation_initiale' => 'boolean',
            'date_debut_formation' => 'nullable|date',
            'etat_formation' => 'nullable|in:début,en cours,terminé',
            'assiste_famille_impact' => 'boolean',
            'date_famille_impact' => 'nullable|date',
            'niveau_engagement' => 'required|in:faible,moyen,engagé,très engagé',
        ]);

        Suivi::create([
            'ame_id' => $ame_id,
            'user_id' => Auth::id(),
            'date_appel' => $request->date_appel,
            'defis' => $request->defis,
            'venu_eglise' => $request->venu_eglise,
            'date_venu_eglise' => $request->date_venu_eglise,
            'formation_initiale' => $request->formation_initiale,
            'date_debut_formation' => $request->date_debut_formation,
            'etat_formation' => $request->etat_formation,
            'assiste_famille_impact' => $request->assiste_famille_impact,
            'date_famille_impact' => $request->date_famille_impact,
            'niveau_engagement' => $request->niveau_engagement,
        ]);

        return redirect()->route('suivis.index')->with('success', 'Suivi ajouté avec succès.');
    }
 
    
    public function historique($ame_id)
    {
        $user = Auth::user();
    
        // Récupérer tous les suivis d'une âme (du plus récent au plus ancien)
        $query = Suivi::where('ame_id', $ame_id)->orderBy('date_appel', 'desc')->with('ame', 'user');
    
        // Si l'utilisateur est un évangéliste (star), il ne voit que ses suivis
        if ($user->role === 'star') {
            $query->where('user_id', $user->id);
        }

            // Récupérer les entretiens de l'âme, triés du plus récent au plus ancien
        $entretiens = Entretien::where('ame_id', $ame_id)
        ->orderBy('date_entretien', 'desc')
        ->paginate(5);
    
        $suivis = $query->paginate(10);
        $ame = Ame::findOrFail($ame_id);
    
        return view('suivis.historique', compact('suivis', 'ame','entretiens'));
    }
}
