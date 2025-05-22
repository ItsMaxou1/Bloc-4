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
        $totalRevenue = Order::sum('total_included_tax');
        $ordersCount = Order::count();
        $activeSessions = DB::table('sessions')
            ->where('last_activity', '>=', now()->subMinutes(30))
            ->count();
        $totalSessions = DB::table('sessions')->count();
        $usersCount = User::count();
        $salesByFormat = ProductVariant::selectRaw('format, sum(price) as sales')
            ->groupBy('format')
            ->get();

        return view('admin.welcome', compact(
            'totalRevenue',
            'ordersCount',
            'activeSessions',
            'totalSessions',
            'usersCount',
            'salesByFormat'
        ));
    }

    /**
     * Exporte toute la base de données au format SQL via SHOW TABLES.
     */
    public function exportDatabase(): StreamedResponse
    {
        $connection = config('database.default');
        $dbName = config("database.connections.{$connection}.database");

        // Récupère la liste des tables
        $rows = DB::select("SHOW TABLES");
        $key = "Tables_in_{$dbName}";
        $tables = array_map(fn($r) => $r->$key, $rows);

        return response()->streamDownload(
            function () use ($tables) {
                foreach ($tables as $table) {
                    echo "-- Table: {$table}\n";
                    $rows = DB::table($table)->get();
                    foreach ($rows as $row) {
                        $row = (array) $row;
                        $cols = array_map(fn($c) => "`{$c}`", array_keys($row));
                        $vals = array_map(fn($v) => DB::getPdo()->quote($v), array_values($row));
                        echo "INSERT INTO `{$table}` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");\n";
                    }
                    echo "\n";
                }
            },
            "dump_{$dbName}_" . date('Ymd_His') . ".sql",
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

        $sql = file_get_contents($request->file('sql_file')->getRealPath());
        DB::unprepared($sql);

        return back()->with('success', 'Import terminé.');
    }
}
