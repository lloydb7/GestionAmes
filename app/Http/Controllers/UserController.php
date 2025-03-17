<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Vérifie si un terme de recherche est saisi
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('role', 'LIKE', "%{$search}%");
            });
        }

        // Ne pas afficher les super_admins
        $users = $query->where('role', '!=', 'super_admin')->paginate(10);

        return view('users.index', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:super_admin,admin_general,star'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,admin_general,star',
            'password' => 'nullable|min:6|confirmed', // Validation du mot de passe
        ]);
    
        // Mettre à jour les informations de l'utilisateur
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
    
        // Vérifier si un mot de passe a été entré
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur essaye de se supprimer lui-même
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Vérifier si l'utilisateur est un Super Admin et empêcher sa suppression
        if ($user->role === 'super_admin') {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer un Super Admin.');
        }

        // Supprimer l'utilisateur si les conditions sont respectées
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
    
}