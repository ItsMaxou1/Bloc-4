<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        // Récupérer toutes les catégories pour afficher les boutons
        $categories = Category::all();

        return response()->json(['categories' => $categories], 200);
    }

}
