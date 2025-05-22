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
        // Charge à la fois les variantes ET la catégorie
        $query = Product::with(['productVariants', 'category']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();

        return response()->json($products, 200);
    }


    public function show($id): JsonResponse
    {
        // Charge le produit + ses variantes
        $product = Product::with('variants')->findOrFail($id);

        return response()->json($product);
    }


}
