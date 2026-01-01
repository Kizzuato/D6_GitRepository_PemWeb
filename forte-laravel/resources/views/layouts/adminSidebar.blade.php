<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">Dashboard</a>
    </li>

    @role('superadmin')
    <li class="nav-item">
        <a class="nav-link text-success" href="/users">Manage Users</a>
    </li>
    @endrole

    @hasanyrole('admin|superadmin')
    <li class="nav-item">
        <a class="nav-link" href="/sensors">Manage Sensors</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports">Validation Reports</a>
    </li>
    @endhasanyrole

    @role('user')
    <li class="nav-item">
        <a class="nav-link" href="/my-reports">My Reports</a>
    </li>
    @endrole
</ul>
