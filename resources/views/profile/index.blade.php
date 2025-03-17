@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Mon Profil</h3>
    </div>

    <div class="card-body">
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Rôle :</strong> {{ ucfirst($user->role) }}</p>
    </div>
</div>
@endsection
