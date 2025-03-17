<?php

namespace App\Http\Controllers;

use App\Models\Star;
use Illuminate\Http\Request;

class StarController extends Controller
{
    public function index()
    {
        $stars = Star::all();
        return view('stars.index', compact('stars'));
    }

    public function create()
    {
        return view('stars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'sexe' => 'required|in:Masculin,Féminin',
            'contact' => 'nullable|string',
            'email' => 'required|email|unique:stars',
            'responsabilite_eglise' => 'nullable|string',
        ]);

        Star::create($request->all());
        return redirect()->route('stars.index');
    }

    public function destroy(Star $star)
    {
        $star->delete();
        return redirect()->route('stars.index');
    }
}