<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'weight' => 'required|numeric',
            'price_product' => 'required|numeric',
            'discounted_price_product' => 'required|numeric',
            'category' => 'required|in:Brincos,Colares,Pulseiras,Anéis,Casa',
            'status' => 'required|in:Active,Inactive',
        ]);


        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'weight' => 'required|numeric',
            'price_product' => 'required|numeric',
            'discounted_price_product' => 'required|numeric',
            'category' => 'required|in:Brincos,Colares,Pulseiras,Anéis,Casa',
            'status' => 'required|in:Active,Inactive',
        ]);

        $product->update($request->all());

        return response()->json(['message' => 'Produto atualizado corretamente'], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produto eliminado corretamente'], 200);
    }
}
