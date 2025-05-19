<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        // On commence par la requête sur les produits
        $query = Product::query();

        // Si une catégorie est sélectionnée, on filtre les produits
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(20)->appends($request->query()); // On pagine les produits

        // dd($products);

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['available'] = isset($validated['available']);
        $validated['cover'] = "https://blog.tubikstudio.com/wp-content/uploads/2019/03/cover-1.png";

        // Création du produit
        $product = Product::create($validated);

        // Sauvegarde des variants associés (s’ils existent dans la requête)
        if ($request->has('variants') && is_array($request->variants)) {
            foreach ($request->variants as $variantData) {
                // On vérifie que les champs essentiels sont là
                if (
                    isset($variantData['format']) &&
                    isset($variantData['price']) &&
                    isset($variantData['stock'])
                ) {
                    $product->variants()->create([
                        'format' => $variantData['format'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                    ]);
                }
            }
        }

        // Récupérer la liste mise à jour des produits
        $products = Product::paginate(20);

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => \App\Models\Category::all(),
            'brands' => \App\Models\Brand::all(), // si tu as une table Brand, sinon tu retires cette ligne
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => \App\Models\Brand::all(),
            'variants' => $product->variants, // on charge les variants associés
        ]);
    }

    public function update(ProductStoreRequest $request, $id)
    {
        // Récupérer le produit à mettre à jour
        $product = Product::findOrFail($id);

        // Valider les données du formulaire
        $validated = $request->validated();
        $validated['available'] = isset($validated['available']);

        // Si une nouvelle image est uploadée, on met à jour l'URL de l'image
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = asset('storage/' . $coverPath);
        }

        // Mettre à jour le produit
        $product->update($validated);

        // Mise à jour des variants
        if (isset($validated['variants'])) {
            foreach ($validated['variants'] as $index => $variantData) {
                // Si le produit a déjà un variant, on le met à jour
                if (isset($variantData['id'])) {
                    $variant = $product->productVariants()->find($variantData['id']);
                    if ($variant) {
                        $variant->update($variantData);
                    }
                } else {
                    // Sinon, on crée un nouveau variant
                    $product->productVariants()->create($variantData);
                }
            }
        }

        // Rediriger vers la page des produits avec un message de succès
        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }


    public function destroy(Product $product)
    {
        $product->delete(); // Supprime le produit

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

/*
<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ProductVariant; // Importer le modèle ProductVariant
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
*/