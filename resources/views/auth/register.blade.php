@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_header', 'Créer un compte')

@section('auth_body')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Nom complet" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
    </form>
@endsection

@section('auth_footer')
    <p>
        <a href="{{ route('login') }}" class="text-center">Déjà inscrit ? Se connecter</a>
    </p>
@endsection
