@extends('layouts.main')

@section('content')
    <div class="hero-section">
        <img src="{{ asset('images/gct-bg.jpg') }}" />
        <div class="image-overlay"></div>
    </div>
    <div class="txt-gct">
        <p>Groupe</p>
        <p>Chimique</p>
        <p>Tunisien</p>
    </div>
    <div>
        <div class="wrapper">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
            <div class="container">
                <i class="fa fa-user-plus"></i>
                <span class="num" data-val="6500">000</span>
                <span class="text">Employés</span>
            </div>
            <div class="container">
                <i class="fa fa-hourglass-o"></i>
                <span class="num" data-val="70">000</span>
                <span class="text">Années d'experience</span>
            </div>
            <div class="container">
                <i class="fa fa-dollar"></i>
                <span class="num" data-val="1065">000</span>
                <span class="text">Chiffre d'affaires</span>
            </div>

        </div>
        <!-- Script -->
        <script src="{{ asset('/js/counter.js') }}"></script>

    </div>

    <div class="txt-home">
        <div class="company">
            <h1>Groupe Chimique Tunisien</h1>
            <div class="rect-green"></div>
            <p>
                La Tunisie est le deuxième pays au monde à valoriser un grand pourcentage de sa production de phosphate
                naturel
                <b>(85%)</b>. Le GCT traite environ 6,5 millions de tonnes de phosphate naturel tunisien chaque année pour
                produire
                l’Acide Phosphorique Marchand (MGA), le Di-Ammonium Phosphaté (DAP) , le Triple Super Phosphate (TSP) et le
                Phosphate de Calcium (DCP).
            </p>

        </div>
        <img src="{{ asset('/images/gct-pic.jpg') }}" alt="">
    </div>

    <div class="img-container">
        <img src="{{ asset('/images/employee.png') }}" alt="" class="image-signup">
        <div class="image-overlay"></div>
        <div class="txt-login">
            <h3>Vous êtes un employé ?</h3>
            <p>Connectez-vous à votre compte maintenant !</p>
            <a href="/login">Login</a>

        </div>

    </div>
    <div class="maps-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d828.0456465326118!2d10.087534165627872!3d33.884951168215025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12556fda5c5e4e03%3A0x625a1ac478970e2a!2zR3JvdXBlIENoaW1pcXVlIFR1bmlzaWVuINin2YTZhdis2YXYuSDYp9mE2YPZitmF2YrYp9im2Yog2KfZhNiq2YjZhtiz!5e0!3m2!1sfr!2stn!4v1688809620083!5m2!1sfr!2stn"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="maps"></iframe>

        <img src="{{ asset('images/maps-logo.png') }}" alt="">

    </div>
    <div class="rs-container">

        <div class="rs">
            <h2>Suivez-Nous !</h2>
            <div>
                <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}"
                    rel="stylesheet">

                <div class="row">
                    <div class="col-md-12">
                        <a href="#" target="_blank" class="btn-social btn-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank" class="btn-social btn-google-plus"><i
                                class="fa fa-google-plus"></i></a>
                        <a href="#" target="_blank" class="btn-social btn-instagram"><i
                                class="fa fa-instagram"></i></a>
                        <a href="#" target="_blank" class="btn-social btn-linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>


                </div>
            </div>


        </div>
        <div class="factory--container">
            <img src="{{ asset('/images/factory.png') }}" alt="">
        </div>
    </div>
@endsection
