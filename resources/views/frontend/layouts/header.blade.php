<nav class="navbar navbar-expand-lg navbar-dark osahan-nav"
    style="background-image: url('path-to-your-background-image.jpg');">
    <div class="container">
        {{-- <a class="navbar-brand" href="index.html"><img alt="logo" src="img/favicon.png"></a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                </li>

                @auth
                    <style>
                        nav.navbar {
                            border: 2px solid lightcoral;
                            /* Add light red border when the user is signed in */
                        }
                    </style>
                    @php
                        $id = Auth::user()->id;
                        $profileData = App\Models\User::find($id);
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img alt="Generic placeholder image"
                                src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                class="nav-osahan-pic rounded-pill"> My Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="icofont-food-cart"></i>
                                Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="icofont-sale-discount"></i>
                                Logout </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('login') }}" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            Login
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('register') }}" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
