<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Démarre la requête avec les relations
        $query = Product::with('productVariants');

        // 🔍 Filtrer par catégorie si elle est spécifiée
        if ($request->has('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        // 🔍 Filtrer par terme de recherche si spécifié
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Récupérer les produits filtrés
        $products = $query->get();

        // Retourner la réponse JSON
        return response()->json($products, 200);
    }



    // public function show(Product $product)
    // {

    //     return response()->json([
    //         'produit' => $product->load('category', 'product_variants'),
    //     ], 200);
    // }

}
