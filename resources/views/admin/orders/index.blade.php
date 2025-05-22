<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Commandes Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>🍺 Admin</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.welcome') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.products.index') }}">Produits</a></li>
                    <li><a href="{{ route('admin.orders.index') }}" class="active">Commandes</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main -->
        <main class="main-content">
            <header class="topbar">
                <div class="user-info" style="display:flex;align-items:center;gap:1rem;">
                    <span>Bienvenue {{ Auth::user()->name }}</span>
                </div>
            </header>

            <h1>Liste des commandes</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Total TTC</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ number_format($order->total_included_tax, 2, ',', ' ') }} €</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($order->status ?? '—') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center">Aucune commande</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        </main>
    </div>
</body>

</html>