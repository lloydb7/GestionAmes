<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ame;
use App\Models\User; 
use App\Models\FamilleImpact;
use App\Models\Suivi;
use App\Models\Entretien;
use Illuminate\Support\Facades\Auth;

class AmeController extends Controller
{
    /**
     * Affiche la liste des âmes.
     */


    public function index(Request $request)
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        // Vérifier si l'utilisateur est un "star" (évangéliste)
        if ($user->role === 'star') {
            $query = Ame::where('user_id', $user->id)->with(['user', 'familleImpact']);
        } else {
            // Si c'est un administrateur, il peut voir toutes les âmes
            $query = Ame::with(['user', 'familleImpact']);
        }

        // Appliquer le tri du plus récent au plus ancien
        $query->orderBy('created_at', 'desc');

        // Vérifie si un terme de recherche est entré
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('prenom', 'LIKE', "%{$search}%")
                ->orWhere('date_premier_contact', 'LIKE', "%{$search}%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('familleImpact', function ($query) use ($search) {
                    $query->where('nom', 'LIKE', "%{$search}%");
                });
            });
        }

        $ames = $query->paginate(10); // Afficher 10 résultats par page

        return view('ames.index', compact('ames'));
    }


    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        // On sélectionne uniquement les utilisateurs qui ont le rôle "star" (évangéliste)
        $users = User::where('role', 'star')->get();
        $familles = FamilleImpact::all();
        
        return view('ames.create', compact('users', 'familles'));
    }

    public function suivis()
    {
        return $this->hasMany(Suivi::class, 'ame_id');
    }

    /**
     * Enregistre une nouvelle âme.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:Masculin,Féminin',
            'age' => 'nullable|integer|min:0|max:120',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:15',
            'priere_du_salut' => 'required|boolean',
            'invitation_temple' => 'nullable|boolean',
            'invitation_fi' => 'nullable|boolean',
            'date_premier_contact' => 'required|date',
            'famille_impact_id' => 'nullable|exists:famille_impacts,id',
        ]);
    
        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->back()->with('error', 'Vous devez être connecté pour enregistrer une âme.');
            }

            // Création de l'âme avec l'utilisateur connecté (évangéliste)
            Ame::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'sexe' => $request->sexe,
                'age' => $request->age,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'priere_du_salut' => $request->priere_du_salut,
                'invitation_temple' => $request->invitation_temple ?? 0,
                'invitation_fi' => $request->invitation_fi ?? 0,
                'date_premier_contact' => $request->date_premier_contact,
                'user_id' => $user->id, // L'ID de l'utilisateur est enregistré ici
                'famille_impact_id' => $request->famille_impact_id,
            ]);

            return redirect()->route('ames.index')->with('success', 'Âme enregistrée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    /**
     * Affiche une âme spécifique.
     */

    public function show($id)
    {
        $ame = Ame::with('familleImpact', 'user')->findOrFail($id);
    
        // Récupérer l'historique des suivis de l'âme (du plus récent au plus ancien)
        $suivis = Suivi::where('ame_id', $id)
                    ->orderBy('date_appel', 'desc')
                    ->paginate(5); // Limite à 5 suivis par page

        $entretiens = \App\Models\Entretien::where('ame_id', $id)
                    ->orderBy('date_entretien', 'desc')
                    ->paginate(5);
    
        return view('ames.show', compact('ame', 'suivis','entretiens'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit($id)
    {
        $ame = Ame::findOrFail($id);
        $users = User::where('role', 'star')->get(); // Sélectionne les évangélistes
        $familles = FamilleImpact::all();
        
        return view('ames.edit', compact('ame', 'users', 'familles'));
    }

    /**
     * Met à jour une âme.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:Masculin,Féminin',
            'age' => 'nullable|integer|min:0|max:120',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:15',
            'priere_du_salut' => 'required|boolean',
            'invitation_temple' => 'nullable|boolean',
            'invitation_fi' => 'nullable|boolean',
            'famille_impact_id' => 'nullable|exists:famille_impacts,id',
        ]);

        try {
            $ame = Ame::findOrFail($id);
            $ame->update($request->all());

            return redirect()->route('ames.index')->with('success', 'Âme mise à jour avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Supprime une âme.
     */
    public function destroy($id)
    {
        try {
            $ame = Ame::findOrFail($id);
            $ame->delete();

            return redirect()->route('ames.index')->with('success', 'Âme supprimée avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
