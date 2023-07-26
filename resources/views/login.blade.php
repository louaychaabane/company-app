@extends('layouts.main')
@section('content')
    <div class="hero-section">
        <img src="{{ asset('images/login-bg.jpg') }}" alt="">
    </div>
    <div class="login">
        <h1>Login / Sign Up</h1>

    </div>
    <div class="login-page">
        <div class="form">
            <form class="register-form" action="{{ route('register') }}" method="POST">
                @csrf
                @error('id_employee')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
                @error('cin')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
                <input type="text" placeholder="nom" name="name" />
                <input type="text" placeholder="ID employé" name="id_employee" />
                <input type="text" placeholder="CIN" name="cin" />
                <input type="text" placeholder="Téléphone" name="phone" />
                <input type="date" placeholder="Date de naissance" name="date_of_birth" />
                <select name="specialite" class="form-specialite">
                    <option value="Electricité">Electricité</option>
                    <option value="Chimie">Chimie</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Finance">Finance</option>

                </select>
                <input type="password" placeholder="Mot de passe" name="password" />
                <button type="submit">create</button>
                <p class="message">Vous avez déjà un compte? <a href="#">Connexion</a></p>
            </form>
            <form class="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif
                <input type="text" placeholder="ID Employé" name="id_employee" />
                <input type="text" placeholder="CIN" name="cin" />
                <input type="password" placeholder="Mot de passe" name="password" />

                <button type="submit">login</button>
                <p class="message">Vous n'avez pas un compte? <a href="#">Creer un compte</a></p>
                <p class="message"><a href="#">Mot de passe oublié</a></p>
            </form>
        </div>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('/js/login.js') }}"></script>
@endsection
