@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="card">
    <div class="card-header">Réinitialisation du mot de passe</div>
    <div class="card-body">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Envoyer le lien de réinitialisation</button>
        </form>
    </div>
</div>
@endsection
