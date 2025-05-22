<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Construire la requête avec la relation des variants
        $query = Product::with('productVariants');

        // Appliquer le filtre par catégorie si présent
        if ($request->has('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        // Récupérer tous les produits filtrés
        $products = $query->get();

        // Retourner directement le tableau JSON de produits
        return response()->json($products, 200);
    }


    public function show($id): JsonResponse
    {
        // Charge le produit + ses variantes
        $product = Product::with('variants')->findOrFail($id);

        return response()->json($product);
    }

    //     return response()->json([
    //         'produit' => $product->load('category', 'product_variants'),
    //     ], 200);
    // }

}
