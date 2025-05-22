<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(20)->appends($request->query());

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all(),
            'brands' => \App\Models\Brand::all(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data['available'] = $request->has('available');
        $data['cover'] = $data['cover'] ?? 'https://blog.tubikstudio.com/...';

        $product = Product::create($data);

        if (!empty($data['variants'])) {
            foreach ($data['variants'] as $variant) {
                $product->variants()->create([
                    'format' => $variant['format'],
                    'price' => $variant['price'],
                    'stock' => $variant['stock'],
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => \App\Models\Brand::all(),
            'variants' => $product->variants,
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['available'] = $request->has('available');

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $data['cover'] = asset('storage/' . $path);
        }

        $product->update($data);

        if (!empty($data['variants'])) {
            foreach ($data['variants'] as $variantData) {
                if (!empty($variantData['id'])) {
                    $variant = $product->variants()->find($variantData['id']);
                    $variant->update($variantData);
                } else {
                    $product->variants()->create($variantData);
                }
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function dashboard()
    {
        // Récupérer les données nécessaires
        $totalRevenue = Order::sum('total_included_tax'); // Revenu total des commandes
        $ordersCount = Order::count(); // Nombre total de commandes
        $activeSessions = DB::table('sessions')
            ->where('last_activity', '>=', now()->subMinutes(30))
            ->count();
        $totalSessions = DB::table('sessions')->count();
        $usersCount = User::count(); // Nombre total d'utilisateurs inscrits

        // Répartition des ventes par format (si nécessaire)
        $salesByFormat = ProductVariant::selectRaw('format, sum(price) as sales')
            ->groupBy('format')
            ->get();

        // Passer les données à la vue
        return view('admin.welcome', [
            'totalRevenue' => $totalRevenue,
            'ordersCount' => $ordersCount,
            'activeSessions' => $activeSessions,
            'totalSessions' => $totalSessions,
            'usersCount' => $usersCount,
            'salesByFormat' => $salesByFormat,
        ]);
    }
}

/*tVariant; // Importer le modèle ProductVariant
use App\Models\Order;
use App\Models\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        // On commence par la requête sur les variantes de produits
        $query = ProductVariant::query(); // Utiliser ProductVariant plutôt que Product

        // Si une catégorie est sélectionnée, on filtre les produits
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $productVariants = $query->paginate(20)->appends($request->query()); // On pagine les variantes de produits

        return view('admin.products.index', [
            'productVariants' => $productVariants,  // Renommer pour correspondre à la table des variantes
            'categories' => Category::all(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['available'] = isset($validated['available']);
        $validated['cover'] = "https://blog.tubikstudio.com/wp-content/uploads/2019/03/cover-1.png";

        // Création de la variante de produit
        ProductVariant::create($validated);  // Créer une variante de produit, pas un produit

        // Récupérer la liste mise à jour des variantes de produits
        $productVariants = ProductVariant::paginate(20);  // Utiliser ProductVariant

        return view('admin.products.index', [
            'productVariants' => $productVariants,  // Renommer pour correspondre à la table des variantes
            'categories' => Category::all(),
        ]);
    }

    public function dashboard()
    {
        // Récupérer les données nécessaires
        $totalRevenue = Order::sum('total_included_tax'); // Revenu total des commandes
        $ordersCount = Order::count(); // Nombre total de commandes
        $activeSessions = Session::where('last_activity', '>=', now()->subMinutes(30))->count(); // Sessions actives (dernières 30 minutes)
        $totalSessions = Session::count(); // Nombre total de sessions
        $usersCount = User::count(); // Nombre total d'utilisateurs inscrits

        // Répartition des ventes par format (si nécessaire)
        $salesByFormat = ProductVariant::selectRaw('format, sum(price) as sales')
            ->groupBy('format')
            ->get();

        // Passer les données à la vue
        return view('admin.welcome', [
            'totalRevenue' => $totalRevenue,
            'ordersCount' => $ordersCount,
            'activeSessions' => $activeSessions,
            'totalSessions' => $totalSessions,
            'usersCount' => $usersCount,
            'salesByFormat' => $salesByFormat,
        ]);
    }
}
