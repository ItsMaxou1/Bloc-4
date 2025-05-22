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

        // ✅ Vérification : seul un admin connecté peut accéder
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('admin.login')->withErrors(['email' => 'Accès interdit.']);
        }

        // Nombre total de produits
        $productsCount = Product::count();

        // Nombre total de commandes
        $ordersCount = Order::count();

        // Sessions actives et totales
        $activeSessions = DB::table('sessions')
            ->where('last_activity', '>=', now()->subMinutes(30))
            ->count();
        $totalSessions = DB::table('sessions')->count();

        // Nombre total d’utilisateurs
        $usersCount = User::count();

        // Revenu total calculé depuis order_items
        $totalRevenue = DB::table('order_items')
            ->selectRaw('SUM(order_items.price * order_items.quantity) as total')
            ->value('total');

        // Répartition des ventes par format
        $salesByFormat = ProductVariant::selectRaw(
            'product_variants.format, SUM(order_items.price * order_items.quantity) as sales'
        )
            ->join(
                'order_items',
                'product_variants.id',
                '=',
                'order_items.product_variant_id'
            )
            ->groupBy('product_variants.format')
            ->get();

        return view('admin.welcome', [
            'productsCount' => $productsCount,
            'ordersCount' => $ordersCount,
            'activeSessions' => $activeSessions,
            'totalSessions' => $totalSessions,
            'usersCount' => $usersCount,
            'totalRevenue' => $totalRevenue,
            'salesByFormat' => $salesByFormat,
        ]);
    }

    public function exportDatabase(): StreamedResponse
    {
        // 1) Récupérer le nom de la base
        $dbName = DB::getDatabaseName();

        // 2) Lister les tables via SHOW TABLES
        $key = 'Tables_in_' . $dbName;
        $result = DB::select('SHOW TABLES');
        $tables = array_map(fn($row) => $row->$key, $result);

        // 3) Construire le dump
        $dump = '';
        foreach ($tables as $table) {
            $dump .= "-- Table: {$table}\n";
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $data = (array) $row;
                $cols = array_keys($data);
                $vals = array_map(fn($v) => DB::getPdo()->quote($v), array_values($data));
                $dump .= "INSERT INTO `{$table}` (`"
                    . implode('`, `', $cols)
                    . "`) VALUES ("
                    . implode(', ', $vals)
                    . ");\n";
            }
            $dump .= "\n";
        }

        // 4) Retourner le fichier à télécharger
        return response()->streamDownload(
            fn() => print ($dump),
            'database_dump_' . date('Ymd_His') . '.sql',
            ['Content-Type' => 'application/sql']
        );
    }

    /**
     * Importe un fichier SQL uploadé.
     */
    public function importDatabase(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|file|mimes:sql,txt',
        ]);

        $path = $request->file('sql_file')->getRealPath();
        $sql = file_get_contents($path);

        // Désactive temporairement les checks FK
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Vide toutes les tables listées (à adapter si vous avez d’autres tables à conserver)
        $tables = ['brands', 'categories', 'products', 'product_variants', /* … */];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        // Réactive les checks FK
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Exécute le dump
        DB::unprepared($sql);

        return back()->with('success', 'Import terminé avec succès.');
    }

}
