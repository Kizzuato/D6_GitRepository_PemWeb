<aside class="sidenav navbar navbar-vertical navbar-expand-xs fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        {{-- TOMBOL CLOSE (Hanya muncul di Mobile) --}}
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>

        <a class="navbar-brand text-white m-0 d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/forte.png') }}" class="navbar-brand-img h-100" alt="logo">
        </a>
    </div>

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('map') ? 'active' : '' }}" href="/map">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-map text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Map</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('table-data') ? 'active' : '' }}" href="/table-data">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Tables</span>
                </a>
            </li>



            {{-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Other Pages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('setting') ? 'active' : '' }}" href="/setting">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings-gear-65 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Setting</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-spaceship text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">About Rover</span>
                </a>
            </li> --}}

        </ul>
    </div>
</aside>
