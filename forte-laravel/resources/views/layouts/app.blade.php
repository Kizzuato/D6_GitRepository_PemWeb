<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Argon Dashboard CSS -->
    <link id="pagestyle" href="{{ asset('../assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/custom.css') }}" rel="stylesheet" />
    @stack('styles')


</head>

<body class="g-sidenav-show bg-dark text-white dark-version">

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <main class="main-content position-relative border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">

                <!-- LEFT: Breadcrumb + Title -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-white" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                            @yield('title', 'Dashboard')
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        @yield('title', 'Dashboard')
                    </h6>
                </nav>

                <!-- RIGHT: Profile -->
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end">
                    <ul class="navbar-nav justify-content-end">

                        <li class="nav-item dropdown d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Profile</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item border-radius-md" href="#">
                                        <i class="fa fa-user me-2"></i> My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="#">
                                        <i class="fa fa-cog me-2"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md text-danger" href="#">
                                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <!-- Core JS -->
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    <div class="fixed-plugin d-none"></div>

    @stack('scripts')

</body>

</html>
