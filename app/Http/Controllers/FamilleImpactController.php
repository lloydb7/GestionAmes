<?php

namespace App\Http\Controllers;

use App\Models\FamilleImpact;
use App\Models\Ame;
use Illuminate\Http\Request;

class FamilleImpactController extends Controller
{
    /**
     * Afficher la liste des Familles Impact.
     */
    public function index(Request $request)
    {
        $query = FamilleImpact::query();
    
        // Vérifie si un terme de recherche est saisi
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('pilote1_nom', 'LIKE', "%{$search}%")
                  ->orWhere('pilote2_nom', 'LIKE', "%{$search}%");
        }
    
        $familles = $query->paginate(10);
    
        return view('familles.index', compact('familles'));
    }
   
    

    /**
     * Afficher le formulaire de création d'une Famille Impact.
     */
    public function create()
    {
        return view('familles.create');
    }

    /**
     * Enregistrer une nouvelle Famille Impact.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:famille_impacts,nom',
            'pilote1_nom' => 'required|string',
            'pilote1_tel' => 'required|string',
            'pilote2_nom' => 'nullable|string',
            'pilote2_tel' => 'nullable|string',
        ]);

        FamilleImpact::create($request->all());
        return redirect()->route('familles.index')->with('success', 'Famille Impact ajoutée avec succès.');
    }

    /**
     * Afficher une Famille Impact et les âmes qui y sont rattachées.
     */
    public function show(FamilleImpact $famille)
    {
        $ames = $famille->ames; // Récupérer les âmes affectées à cette famille
        return view('familles.show', compact('famille', 'ames'));
    }

    /**
     * Afficher le formulaire d'édition d'une Famille Impact.
     */
    public function edit(FamilleImpact $famille)
    {
        return view('familles.edit', compact('famille'));
    }

    /**
     * Mettre à jour une Famille Impact.
     */
    public function update(Request $request, FamilleImpact $famille)
    {
        $request->validate([
            'nom' => 'required|string|unique:famille_impacts,nom,' . $famille->id,
            'pilote1_nom' => 'required|string',
            'pilote1_tel' => 'required|string',
            'pilote2_nom' => 'nullable|string',
            'pilote2_tel' => 'nullable|string',
        ]);

        $famille->update($request->all());
        return redirect()->route('familles.index')->with('success', 'Famille Impact mise à jour avec succès.');
    }

    /**
     * Supprimer une Famille Impact.
     */
    public function destroy(FamilleImpact $famille)
    {
        $famille->delete();
        return redirect()->route('familles.index')->with('success', 'Famille Impact supprimée avec succès.');
    }

    /**
     * Affecter une âme à une Famille Impact.
     */
    public function assignAme(Request $request, FamilleImpact $famille)
    {
        $request->validate([
            'ame_id' => 'required|exists:ames,id',
        ]);

        $ame = Ame::findOrFail($request->ame_id);
        $ame->famille_impact_id = $famille->id;
        $ame->save();

        return redirect()->route('familles.show', $famille->id)->with('success', 'Âme assignée avec succès.');
    }
}
