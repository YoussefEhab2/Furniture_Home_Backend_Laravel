<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
       return Product::with('category')->get();
    }

   
    public function store(Request $request)
    {
        
        $validate=$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:category,id',
        ]);
        return Product::create($validate);
    }

  
    public function show($id)
    {
       return Product::with('category')->findOrFail($id);
    }

   
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:category,id',
        ]);
        $product->update($validate);
        return $product;
    }

   
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
