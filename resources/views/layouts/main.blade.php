<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="https://d7ieeqxtzpkza.cloudfront.net/wp-content/uploads/2018/02/ag43-gct-groupe-chimique-tunisien.jpg">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
    {{-- @yield('styles') --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../scripts/preventScroll.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <title>Groupe Chimique Tunisien</title>


</head>

<body>
    <header id="header">
        <nav class="navbar">
            <img src="{{ asset('/images/logo-gct.png') }}" />
            <div class="rect-logo"></div>
            <ul class="nav-menu">

                <li class="nav-item">
                    @if (!session('id_employee') && !session('rhloggedIn'))
                        <a href="/" class="nav-link">Home</a>
                    @elseif (session('id_employee'))
                        <a href="{{ '/employeeDashboard' }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ '/rhDashboard' }}" class="nav-link">Dashboard</a>
                    @endif
                </li>


                @if (!session('rhloggedIn'))
                    <li class="nav-item">
                        <a href="/rhLogin" class="nav-link">Espace RH</a>
                    </li>
                @endif

                @if (session('id_employee') || session('rhloggedIn'))
                    <form action="{{ route('logout') }}" method="GET">
                        @csrf
                        <button class="logout-btn" type="submit" class="nav-link">Logout</button>
                    </form>
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Login</a>
                    </li>
                @endif
            </ul>
        </nav>
    </header>
    <main>

        @yield('content')

    </main>
    <footer>

        <div class="footer">
            <p>&copy; 2023 <a href="/aboutMe" class="nav-link">Louay Chaabane</a>. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
