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
                    <li><a href="{{ route('admin.welcome') }}" class="active">Dashboard</a></li>
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
                    <span>Bienvenue {{ Auth::check() ? Auth::user()->name : 'invité' }}</span>
                    <img src="{{ asset('assets/images/pp1.webp') }}" alt="User" width="50" height="50">
                </div>
            </header>

            <!-- Dashboard Stats -->
            <h1>Dashboard</h1>
            <div class="dashboard-cards">
                <!-- Nombre de Produits -->
                <div class="card">
                    <h3>Produits au catalogue</h3>
                    <p>{{ $productsCount }}</p>
                </div>

                <!-- Revenu Total -->
                <div class="card">
                    <h3>Revenu Total</h3>
                    <p>{{ number_format($totalRevenue, 2, ',', ' ') }} €</p>
                </div>

                <!-- Nombre de Commandes -->
                <div class="card">
                    <h3>Commandes</h3>
                    <p>{{ $ordersCount }}</p>
                </div>

                <!-- Sessions Actives -->
                <div class="card">
                    <h3>Sessions Actives</h3>
                    <p>{{ $activeSessions }}</p>
                </div>

                <!-- Total des Sessions -->
                <div class="card">
                    <h3>Total des Sessions</h3>
                    <p>{{ $totalSessions }}</p>
                </div>

                <!-- Nombre d'Utilisateurs -->
                <div class="card">
                    <h3>Utilisateurs Inscrits</h3>
                    <p>{{ $usersCount }}</p>
                </div>
            </div>

            <!-- Répartition des Ventes par Format -->
            <h2>Ventes par Format</h2>
            <table>
                <thead>
                    <tr>
                        <th>Format</th>
                        <th>Ventes Totales (€)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesByFormat as $sale)
                        <tr>
                            <td>{{ $sale->format }}</td>
                            <td>{{ number_format($sale->sales, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Import/Export BD -->
            <div class="db-buttons">
                <!-- Export via GET -->
                <a href="{{ route('admin.database.export') }}" class="btn btn-export">
                    Exporter la base de données
                </a>

                <!-- Import -->
                <form action="{{ route('admin.database.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="sql_file" required>
                    <button type="submit" class="btn btn-import">
                        Importer la base de données
                    </button>
                </form>
            </div>

        </main>
    </div>
</body>

</html>