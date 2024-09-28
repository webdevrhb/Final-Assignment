<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Rental - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" rel="stylesheet" />
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" type="button" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarTogglerDemo02">
            <!-- Centered Nav Links -->
            <ul class="navbar-nav mb-lg-0 mb-2 mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.cars.index') }}"> Add Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.rentals.index') }}">Add Rentals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.customers.index') }}">Add Customers</a>
                </li>
            </ul>
            <!-- Right-aligned logout link -->
            <ul class="navbar-nav mb-lg-0 mb-2 ms-auto">
                <span class="navbar-text mx-2 text-white"></span>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('home') }}">Back </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container mt-2">
        @yield('content')
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"></script>

    @yield('scripts')

</body>

</html>
