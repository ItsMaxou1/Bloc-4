<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminOrderController extends Controller
{
    /**
     * Affiche la liste des commandes.
     */
    public function index()
    {
        // On charge la relation user pour afficher le nom
        $orders = Order::with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }
}
