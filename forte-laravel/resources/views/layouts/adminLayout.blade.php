<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FORTE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-gray-800 text-white p-4">
        <h1 class="text-xl font-bold">FORTE - Admin Panel</h1>
    </header>

    <div class="flex">
        <nav class="w-64 bg-gray-700 text-white min-h-screen p-4">
            <ul>
                <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a></li>
                <li class="mb-2"><a href="{{ route('admin.users.index') }}" class="hover:underline">Manage Users</a></li>
                <li class="mb-2"><a href="{{ route('admin.sensors.index') }}" class="hover:underline">Manage Sensors</a></li>
                <li class="mb-2"><a href="{{ route('admin.reports.index') }}" class="hover:underline">Manage Reports</a></li>
            </ul>
        </nav>

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
