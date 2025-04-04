<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // On commence par la requête sur les produits
        $query = Product::query(with(''));

        // Si une catégorie est sélectionnée, on filtre les produits
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(20); // On pagine les produits

        return response()->json([
            'produits' => $products,
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            'produit' => $product->load('category'),
        ], 200);
    }

}
