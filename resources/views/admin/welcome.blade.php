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
                    <li><a href="#">Clients</a></li>
                    <li><a href="#">Rapports</a></li>
                    <li><a href="#">Paramètres</a></li>
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

            <h2>Ventes par Format</h2>
            <section class="graphs">
                <div class="graph-card">
                    <h3>Répartition des ventes</h3>
                    <canvas id="salesDistribution" width="400" height="400"></canvas>
                </div>
            </section>
        </main>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique circulaire : Répartition des ventes par format
    const ctxSalesDistribution = document.getElementById('salesDistribution').getContext('2d');
    const salesDistributionChart = new Chart(ctxSalesDistribution, {
        type: 'doughnut', // Type de graphique circulaire
        data: {
            labels: {!! json_encode($salesByFormat->pluck('format')) !!}, // Formats de produit
            datasets: [{
                label: 'Ventes par format',
                data: {!! json_encode($salesByFormat->pluck('sales')) !!}, // Quantité de ventes pour chaque format
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Couleur du premier segment
                    'rgba(54, 162, 235, 0.6)', // Couleur du deuxième segment
                    'rgba(255, 206, 86, 0.6)', // Couleur du troisième segment
                    'rgba(75, 192, 192, 0.6)', // Couleur du quatrième segment
                    'rgba(153, 102, 255, 0.6)', // Couleur du cinquième segment
                    'rgba(255, 159, 64, 0.6)', // Couleur du sixième segment
                ],
                borderColor: 'rgba(0, 0, 0, 0.1)', // Couleur des bordures des segments
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Position de la légende
                    labels: {
                        font: {
                            size: 14, // Taille de la police de la légende
                            family: 'Arial, sans-serif'
                        },
                        color: '#333' // Couleur du texte de la légende
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)', // Couleur de fond des tooltips
                    titleColor: '#fff', // Couleur du titre du tooltip
                    bodyColor: '#fff', // Couleur du texte du tooltip
                }
            }
        }
    });
</script>

</html>