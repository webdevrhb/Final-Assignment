<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" rel="stylesheet" />

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">RentalHubStation</a>
        @if (Auth::user() && Auth::user()->role == 'admin')
            <span class="navbar-text mx-2 text-white">|</span>
            <a class="navbar-brand text-white" href="/admin"><span class="text-warning">Admin</span></a>
        @endif
        <button class="navbar-toggler btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" type="button" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-success"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarTogglerDemo02">
            <div class="mx-auto"> <!-- Centering div -->



                <ul class="navbar-nav mb-lg-0 mb-2">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('frontend.cars.index') }}">Browse Cars</a></li>
                    <span class="navbar-text mx-2 text-white">|</span>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('about') }}">About</a></li>
                    <span class="navbar-text mx-2 text-white">|</span>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('contact') }}">Contact</a></li>
                </ul>




            </div>
            <ul class="navbar-nav mb-lg-0 mb-2 ms-auto"> 
                @guest
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                    <span class="navbar-text mx-2 text-white">|</span>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Register</a></li>
                @endguest
                @auth
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('frontend.rentals.index') }}">Bookings</a></li>
                    <span class="navbar-text mx-2 text-white">|</span>
                    <li class="nav-item"><a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<br>
<br>

    <div class="container mt-4">
        @yield('content')
    </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"></script>
    @yield('scripts')

</body>

</html>
