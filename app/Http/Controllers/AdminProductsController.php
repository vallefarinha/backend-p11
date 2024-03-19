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

    // public function productsByCategory($category_id)
    // {
    //     $products = Product::where('id_category', $id_category)->get();

    //     return response()->json($products);
    // }

    // public function showCategories()
    // {
    //     $categories = Category::all();
    //     return response()->json($categories);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'weight' => 'required|numeric',
            'price_product' => 'required|numeric',
            'discounted_price_product' => 'nullable|numeric',
            'status' => 'required|in:Active,Inactive',
            'category' => 'required|in:Colares,Brincos,Pulseiras,Anéis,Casa',
        ]);


        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'weight' => 'required|numeric',
            'price_product' => 'required|numeric',
            'discounted_price_product' => 'nullable|numeric',
            'status' => 'required|in:Active,Inactive',
            'category' => 'required|in:Colares,Brincos,Pulseiras,Anéis,Casa',
        ]);

        $product->update($request->all());

        return response()->json(['message' => 'Produto atualizado corretamente'], 200);
    }


    public function associateImages(Request $request, $product_id)
    {
        $request->validate([
            'image_ids' => 'required|array',
            'image_ids.*' => 'exists:product_images,id'
        ]);

        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->images()->sync($request->image_ids);

        return response()->json(['message' => 'Imagens associadas ao produto com sucesso'], 200);
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