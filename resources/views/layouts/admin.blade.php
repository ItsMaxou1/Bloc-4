<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white p-3" style="min-width: 200px; height: 100vh;">
            <h4>Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.welcome') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item"><a href="{{ route('admin.products.index') }}"
                        class="nav-link text-white">Produits</a></li>
            </ul>
        </nav>

        <!-- Main content -->
        <main class="p-4 w-100">
            <h1>@yield('title')</h1>
            @yield('content')
        </main>
    </div>
</body>

</html>