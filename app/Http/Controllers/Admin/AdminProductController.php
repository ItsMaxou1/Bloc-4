<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\Request;

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

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['available'] = isset($validated['available']);
        $validated['cover'] = "https://blog.tubikstudio.com/wp-content/uploads/2019/03/cover-1.png";

        // Création du produit
        Product::create($validated);

        // Récupérer la liste mise à jour des produits
        $products = Product::paginate(20);

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

}
