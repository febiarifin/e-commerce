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
                    <li class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" href="#!"><i class="fab fa-google"></i> Sign in</a>
                    </li>
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

    <!-- JS -->
    @include('layouts.js')
    <!-- End JS -->
</body>

</html>
