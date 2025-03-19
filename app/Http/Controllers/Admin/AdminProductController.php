<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

    }

    public function edit(Product $product)
    {

    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
    }

    public function destroy(Product $product)
    {

    }
}
