<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ProductVariant; // Importer le modèle ProductVariant
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
        // Exemple : Répartition des ventes par format
        $salesByFormat = ProductVariant::selectRaw('format, sum(price) as sales')
            ->groupBy('format')
            ->get();

        return view('admin.welcome', [
            'totalRevenue' => ProductVariant::sum('price'),
            'ordersCount' => 1056,
            'activeSessions' => 56,
            'totalSessions' => 120,
            'salesByFormat' => $salesByFormat, // Passer les données des ventes par format
        ]);
    }


}

