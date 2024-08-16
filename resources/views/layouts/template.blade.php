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
    <div class="wrapper">
        <!-- Sidebar -->
        @if (!$is_auth)
            @include('partials.sidebar')
        @endif
        <!-- End Sidebar -->

        <div class="main-panel">

            <!-- Header -->
            @if (!$is_auth)
                @include('partials.header')
            @endif
            <!-- End Header -->

            <div class="container">
                <!-- Page Header -->
                @if (!$is_auth)
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Pages</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">
                                    @if ($active == 'dashboard')
                                        Dashboard
                                    @elseif ($active == 'product')
                                        Product
                                    @elseif ($active == 'report')
                                        Report
                                    @endif
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">{{ $title }}</a>
                            </li>
                        </ul>
                    </div>
                @endif
                <!--   End Page Header   -->

                <!--   Content   -->
                @yield('content')
                <!--   End Content   -->

            </div>

            <!--   Footer   -->
            @if (!$is_auth)
                @include('partials.footer')
            @endif
            <!--   End Footer   -->
        </div>

    </div>

    <!-- JS -->
    @include('layouts.js')
    <!-- End JS -->
</body>

</html>
