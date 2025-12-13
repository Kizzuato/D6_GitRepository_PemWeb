<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start bg-dark" id="sidenav-main">
  <div class="sidenav-header">
    <a class="navbar-brand text-white m-0 d-flex align-items-center" href="{{ route('dashboard') }}">
      <img src="{{ asset('../assets/img/forte.png') }}" class="navbar-brand-img h-100" alt="logo">
      <!-- <span class="ms-2 font-weight-bold">POSU Admin</span> -->
    </a>
  </div>

  <hr class="horizontal light mt-2 mb-2">

  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">

      {{-- Dashboard --}}
      <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
          <div class="icon icon-shape icon-sm bg-gradient-primary shadow-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-white text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1 text-white">Dashboard</span>
        </a>
      </li>

      {{-- Tables / Data --}}
      <li class="nav-item">
        <a class="nav-link {{ request()->is('tables') ? 'active' : '' }}" href="/table-data">
          <div class="icon icon-shape icon-sm bg-gradient-warning shadow-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 text-white text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1 text-white">Tables</span>
        </a>
      </li>

      {{-- Garis Pembatas --}}
      <li class="nav-item mt-3">
        <h6 class="ps-4 text-uppercase text-xs font-weight-bolder text-white-50">Account</h6>
      </li>

      <!-- {{-- Logout --}}
            <li class="nav-item">
                <a class="nav-link" href="">
                    <div class="icon icon-shape icon-sm bg-gradient-danger shadow-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-power text-white text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Logout</span>
                </a>
            </li> -->

    </ul>
  </div>
</aside>