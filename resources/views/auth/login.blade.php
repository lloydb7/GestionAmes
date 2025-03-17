@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Connexion à votre compte')

@section('auth_body')


    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
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

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember"> Se souvenir de moi </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p>
        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
    </p>
    <p>
        <a href="{{ route('register') }}" class="text-center">Créer un compte</a>
    </p>
@endsection
