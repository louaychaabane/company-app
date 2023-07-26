@extends('layouts.main')
@section('content')
    <div class="hero-section">
        <img src="{{ asset('images/login-bg.jpg') }}" alt="">
    </div>
    <div class="login">
        <h1>Espace RH</h1>

    </div>
    <div class="login-page">
        <div class="form">
            <form class="rh-login-form" action="{{route('rh-login')}}" method="POST">
                @csrf
                <input type="email" placeholder="E-mail" name="email" />
                <input type="password" placeholder="Mot de passe" name="password" />
                <button type="submit">login</button>
            </form>

            {{-- <form class="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif
                <input type="email" placeholder="E-mail" name="email" />
                <input type="password" placeholder="Mot de passe" name="password" />

                <button type="submit">login</button>
                
            </form> --}}
        </div>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('/js/login.js') }}"></script>
@endsection
