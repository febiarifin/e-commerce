<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('kaiadmin_lite') }}/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- CSS -->
    @include('layouts.css')
    <!-- End CSS -->
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/"><img id="MDB-logo"
                    src="{{ asset('kaiadmin_lite') }}/assets/img/kaiadmin/favicon.ico" alt="MDB Logo" draggable="false"
                    height="30" /> <span class="text-secondary fw-bold">{{ config('app.name') }}</span></a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Auth::user())
                        <li class="nav-item ms-3">
                            <span class="text-muted">{{ Auth::user()->email }}</span>
                        </li>
                        <li class="nav-item ms-3">
                            <a href="{{ route('home') }}"
                                class="btn btn-{{ $active == 'home' ? 'primary' : 'light' }} rounded-pill">Home</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a href="{{ route('orders.index') }}"
                                class="btn btn-{{ $active == 'order' ? 'primary' : 'light' }} rounded-pill">Orders</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a href="{{ route('logout') }}" class="btn btn-danger rounded-pill">Logout</a>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <button type="button" class="btn btn-black btn-rounded" data-bs-toggle="modal"
                                data-bs-target="#checkoutModal"><i class="fab fa-google"></i> Sign in
                            </button>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <div class="container">
        <div style="margin-top: 100px;">
            @yield('content')
        </div>
    </div>

    @guest
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Authentication</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <p>Sorry, you need to log in to continue the process</p>
                            <a href="{{ route('auth.google') }}" class="btn btn-primary rounded-pill"><i
                                    class="fab fa-google"></i> Sign In With Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    <!-- JS -->
    @include('layouts.js')
    <!-- End JS -->
</body>

</html>
