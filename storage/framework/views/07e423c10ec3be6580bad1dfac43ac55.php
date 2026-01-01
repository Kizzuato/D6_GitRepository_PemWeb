<aside class="sidenav navbar navbar-vertical navbar-expand-xs fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand text-white m-0 d-flex align-items-center" href="<?php echo e(route('dashboard')); ?>">
            <img src="<?php echo e(asset('assets/img/forte.png')); ?>" class="navbar-brand-img h-100" alt="logo">
        </a>
    </div>
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                    href="<?php echo e(route('dashboard')); ?>">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('map') ? 'active' : ''); ?>" href="/map">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-map text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Map</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('table-data') ? 'active' : ''); ?>" href="/table-data">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Tables</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<?php /**PATH /home/kizzuato/Projects/i-will/rover/pemdas/forte-frontend/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>