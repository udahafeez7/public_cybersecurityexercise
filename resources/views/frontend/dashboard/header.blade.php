<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cybersecurity Exercise">
    <meta name="author" content="Your Name">
    <title>Cybersecurity Exercise - User Dashboard</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('frontend/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <!-- IcoFont -->
    <link href="{{ asset('frontend/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/css/osahan.css') }}" rel="stylesheet">

    <style>
        /* Enhanced Navbar Styling */
        .navbar {
            background-color: #f8f9fa;
            padding: 5px 15px;
            /* Reduced padding for a smaller header size */
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            margin-left: 0;
        }

        .navbar-brand img {
            width: 180px;
            /* Reduced logo size for a smaller header */
            height: 140px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        /* Logo hover effect */
        .navbar-brand img:hover {
            transform: scale(1.05);
            background-color: #ffebeb;
        }

        .navbar-nav .nav-link {
            font-size: 14px;
            color: #333;
            font-weight: 400;
            padding: 6px 14px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
            background-color: #e0e0e0;
            border-radius: 8px;
        }

        .navbar-nav .nav-link.active {
            color: #007bff;
            font-weight: 600;
        }

        .navbar-nav .dropdown-toggle:hover {
            color: #007bff;
            background-color: #e0e0e0;
            border-radius: 8px;
        }

        .dropdown-menu {
            min-width: 180px;
            font-size: 14px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-nav .dropdown-toggle img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 6px;
            transition: all 0.3s ease;
        }

        .navbar-nav .dropdown-menu a {
            font-size: 14px;
            color: #333;
            transition: color 0.3s ease;
        }

        .navbar-nav .dropdown-menu a:hover {
            color: #007bff;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .navbar-collapse {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-collapse .ml-auto {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .dropdown-toggle img:hover {
            border: 2px solid #007bff;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img alt="logo" src="{{ asset('frontend/img/logo.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>

                    @php
                        $id = Auth::user()->id;
                        $profileData = App\Models\User::find($id);
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img alt="Profile image"
                                src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}">
                            My Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="icofont-food-cart"></i>
                                Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user.logout') }}"><i
                                    class="icofont-sale-discount"></i> Want to Quit?</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- JavaScript Dependencies -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>
