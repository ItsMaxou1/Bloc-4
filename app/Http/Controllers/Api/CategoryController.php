<?php
namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        // Récupérer toutes les catégories
        $categories = Category::all();

        // Retourner directement le tableau JSON, sans wrapper ["categories" => ...]
        return response()->json($categories, 200);
    }
}
