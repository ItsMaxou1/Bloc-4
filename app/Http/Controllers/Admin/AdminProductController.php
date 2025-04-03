<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;

class AdminProductController extends Controller
{
    public function index()
    {
        // Récupérer toutes les catégories pour afficher les boutons
        $categories = Category::all();

        return response()->json(['categories' => $categories], 200);
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['available'] = isset($validated['available']);
        $validated['cover'] = "https://blog.tubikstudio.com/wp-content/uploads/2019/03/cover-1.png";
        $product = Product::create($validated);

        return response()->json($product, 201);
    }

}
