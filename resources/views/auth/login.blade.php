<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBooking - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Import Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            background: url("{{ asset('images/background.jpg') }}") no-repeat center center fixed;
            background-size: cover;
        }
        .container-fluid {
            height: 100vh;
        }
        .left-side {
            background: url("{{ asset('images/bca-building.jpg') }}") no-repeat center center;
            background-size: cover;
            position: relative;
        }
        
    </style>
</head>
<body>
    <div class="container-fluid d-flex p-0">
        <!-- Left side with image + logo -->
        <div class="col-md-6 left-side d-none d-md-block">
            <div class="logo">
                <img src="{{ asset('images/bca-logo.png') }}" alt="BCA Logo">
            </div>
        </div>

        <!-- Right side with login -->
        <div class="col-md-6 right-side">
            <!-- Title outside the box -->
            <div class="title">MyBooking</div>
            <div class="subtitle">All Your Bookings, Simplified</div>

            <div class="login-box">
                <!-- "Login Here" inside the box -->
                <div class="login-title">Login Here</div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label class="form-label" for="id">
                            User ID <span class="required">*</span>
                        </label>
                        <input type="text" name="id" class="form-control" placeholder="Type your user ID ex. 0123" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="password">
                            Password <span class="required">*</span>
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="Type your password ex. 123456" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form>
                <div class="register-text">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
