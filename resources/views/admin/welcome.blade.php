<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>🍺 Admin</h2>
            <nav>
                <ul>
                    <li><a href="#" class="active">Dashboard</a></li>
                    <li><a href="{{ route('admin.products.index') }}">Produits</a></li>
                    <li><a href="#">Catégories</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main -->
        <main class="main-content">
            <!-- Header -->
            <header class="topbar">
                <div class="user-info">
                    <span>Bienvenue Admin</span>
                    <img src="https://via.placeholder.com/30" alt="User">
                </div>
            </header>

            <!-- Cards -->
            <h1>Dashboard</h1>

            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Revenue</h3>
                    <p>{{ $totalRevenue }} €</p>
                </div>
                <div class="card">
                    <h3>Orders</h3>
                    <p>{{ $ordersCount }}</p>
                </div>
                <div class="card">
                    <h3>Active Sessions</h3>
                    <p>{{ $activeSessions }}</p>
                </div>
                <div class="card">
                    <h3>Total Sessions</h3>
                    <p>{{ $totalSessions }}</p>
                </div>
            </div>
        </main>
    </div>
</body>


</html>