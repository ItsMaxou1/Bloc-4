<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;

class ProductVariantController extends Controller
{
    public function show(ProductVariant $productVariant): JsonResponse
    {
        // Recharge la variante avec son produit parent
        $pv = ProductVariant::with('product')->findOrFail($productVariant->id);
        return response()->json($pv);
    }
}
