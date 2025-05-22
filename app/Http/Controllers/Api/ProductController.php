<?php

// app/Http/Controllers/Api/ProductController.php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('productVariants');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();  // ← on récupère tout, pas de pagination ni de clé "produits"

        return response()->json($products, 200);
    }

    public function show($id)
    {
        $product = Product::with('productVariants')
            ->findOrFail($id);

        return response()->json($product, 200);
    }
}

