<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entretien;
use App\Models\Ame;
use App\Models\Suivi;
use Illuminate\Support\Facades\Auth;

class EntretienController extends Controller
{
    public function index($ame_id)
    {
        $ame = Ame::findOrFail($ame_id); // Vérifier que l'âme existe

        // Récupérer tous les entretiens liés à cette âme
        $entretiens = Entretien::where('ame_id', $ame_id)
            ->orderBy('date_entretien', 'desc')
            ->paginate(10);
    
        return view('entretiens.index', compact('ame', 'entretiens'));
    }

    public function liste_entretiens(Request $request)
    {
        $user = Auth::user();
        $query = Entretien::query();
    
        // Si l'utilisateur est un "star", il ne voit que ses propres entretiens
        if ($user->role === 'star') {
            $query->where('user_id', $user->id);
        }
    
        // Vérifier si un terme de recherche est entré
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                $q->whereHas('ame', function ($subQuery) use ($search) {
                    $subQuery->where('nom', 'LIKE', "%{$search}%")
                             ->orWhere('prenom', 'LIKE', "%{$search}%");
                })
                ->orWhere('numero_entretien', 'LIKE', "%{$search}%");
            });
        }
    
        // Récupérer les entretiens paginés
        $entretiens = $query->orderBy('date_entretien', 'desc')->paginate(10);
    
        return view('entretiens.liste_entretiens', compact('entretiens'));
    }
    

    public function show($id)
    {
        $entretien = Entretien::findOrFail($id);
        $ame = Ame::findOrFail($entretien->ame_id); // Récupérer l'âme associée

        // Vérifier si l'âme a des suivis
        $suivis = Suivi::where('ame_id', $ame->id)
        ->orderBy('date_appel', 'desc')
        ->paginate(5); // Récupérer tous les suivis de l'âme

        return view('entretiens.show', compact('entretien', 'ame','suivis'));
    }

    public function create($ame_id)
    {
        $ame = Ame::findOrFail($ame_id);
        return view('entretiens.create', compact('ame'));
    }

    public function store(Request $request, $ame_id)
    {
        $request->validate([
            'date_entretien' => 'required|date',
            'defis' => 'nullable|string',
            'resume' => 'nullable|string',
            'evaluation' => 'required|in:faible,moyen,engagé,très engagé',
        ]);

            // Compter les entretiens déjà enregistrés pour cette âme
        $nombre_entretien = Entretien::where('ame_id', $ame_id)->count() + 1;

        // Vérifier qu'on ne dépasse pas 3 entretiens
        if ($nombre_entretien > 3) {
            return redirect()->back()->with('error', 'Une âme ne peut avoir que 3 entretiens.');
        }

        Entretien::create([
            'ame_id' => $ame_id,
            'user_id' => Auth::id(),
            'date_entretien' => $request->date_entretien,
            'defis' => $request->defis,
            'resume' => $request->resume,
            'evaluation' => $request->evaluation,
            'numero_entretien' => $nombre_entretien,
        ]);

        return redirect()->route('entretiens.index', $ame_id)->with('success', 'Entretien ajouté avec succès.');
    }

    public function edit($id)
    {
        $entretien = Entretien::findOrFail($id);
        return view('entretiens.edit', compact('entretien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_entretien' => 'required|date',
            'defis' => 'nullable|string',
            'resume' => 'nullable|string',
            'evaluation' => 'required|in:faible engagement,moyen engagement,fort engagement,très fort engagement',
            
        ]);

        $entretien = Entretien::findOrFail($id);
        $entretien->update($request->all());

        return redirect()->route('entretiens.index', $entretien->ame_id)->with('success', 'Entretien mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $entretien = Entretien::findOrFail($id);
        $ame_id = $entretien->ame_id;
        $entretien->delete();

        return redirect()->route('entretiens.index', $ame_id)->with('success', 'Entretien supprimé avec succès.');
    }
}
