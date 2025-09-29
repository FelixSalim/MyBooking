<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyBooking')</title>

    @yield('styles')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f9fc;
        }

        .banner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            /* adjust as needed */
            background: url("{{ asset('images/bca-building.jpg') }}") center/cover no-repeat;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-5">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/images/bca-logo.png" alt="BCA Logo">
        </a>
        <div class="collapse navbar-collapse ms-5">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link @if (Request::is('home')) active @endif"
                        href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link @if (Request::is('room')) active @endif"
                        href="#">Room</a></li>
            </ul>
            <span class="navbar-text fw-bold text-white">MyBooking <br>
                <small class="fw-normal">All Your Bookings, Simplified</small>
            </span>
        </div>
    </nav>

    <!-- Banner with Nav -->
    <div class="banner">
        <div class="banner-overlay"></div>
        <div class="title-container">
            <h1 class="banner-title">@yield('page-title')</h1>
        </div>
    </div>

    <!-- White Content Box -->
    <div class="container-fluid p-0">
        <div class="content-box">
            @yield('content')
            <div class="box-footer p-3">
                <a href="{{ route('home') }}">Back to Home</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
