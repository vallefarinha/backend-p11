<?php
namespace App\Http\Controllers;

require_once base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserProductsController extends Controller
{
    public function addToCart(Request $request)
{
    $user = auth()->user();

    $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

    if (!$cart) {
        $cart = Cart::create([
            'user_id' => $user->id,
            'status' => 'Processing',
            'quantity' => 0,
            'subtotal_cart' => 0,
            'total_cart' => 0,
        ]);
    }

    $product = Product::find($request->input('product_id'));

    if (!$product) {
        return response()->json(['error' => 'Produto não encontrado'], 404);
    }

    $cartItem = OrderDetail::create([
        'cart_id' => $cart->id,
        'product_id' => $request->input('id_product'),
        'product_quantity' => $request->input('product_quantity'),
        'subtotal_order_detail' => $request->input('product_quantity') * $product->price,
        'total_order_detail' => $request->input('product_quantity') * $product->price,
    ]);

    $cart->update([
        'quantity' => $cart->quantity + 1,
        'total_cart' => $cart->total_cart + $cartItem->total_order_detail,
    ]);

    return response()->json(['message' => 'Produto adicionado satisfatoriamente']);
}


public function viewCart()
{
    $user = auth()->user();


    $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

    if ($cart) {
        $productNames = OrderDetail::where('cart_id', $cart->id)
            ->with(['product:id,name'])
            ->get(['product_id', 'product_quantity']);

        $productNames->transform(function ($item) {
            return [
                'product_id' => $item->product_id,
                'product_quantity' => $item->product_quantity,
                'product' => $item->product->name,
            ];
        });

        return response()->json(['cart' => $cart, 'productNames' => $productNames]);
    }

    return response()->json(['message' => 'Carrinho vazio']);
}


public function updateCart(Request $request)
{
    $user = auth()->user();

    $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();


    if (!$cart) {
        return response()->json(['message' => 'Carrinho não encontrado'], 404);
    }

    if ($request->has('product_id') && $request->has('product_quantity')) {
        $productPrice = Product::find($request->input('product_id'))->price_product;

        $cart->product_order()->where('product_id', $request->input('product_id'))->update([
            'product_quantity' => $request->input('product_quantity'),
            'total_cart' => $productPrice * $request->input('product_quantity'),
        ]);

        $cart->update([
            'total_cart' => $cart->order_detail()->sum('total_cart'),
        ]);

        return response()->json(['message' => 'Carrinho atualizado']);
    } else {
        return response()->json(['error' => 'Dados do carrinho não encontrado'], 400);
    }
}

public function clearCart()
{
    $user = auth()->user();

    $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

    if ($cart) {
        $cart->order_detail()->delete();

       $cart->update([
            'quantity' => 0,
            'total_cart' => 0,
        ]);

        return response()->json(['message' => 'Carrinho apagado satisfatoriamente']);
    }

    return response()->json(['message' => 'O carrinho está vazio']);
}

public function removeProductFromCart(Request $request)
{
    $user = auth()->user();

    $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

    if (!$cart) {
        return response()->json(['message' => 'Carrinho não encontrado'], 404);
    }

  $id_product = $request->input('product_id');

    $deleted = DB::table('order_details')
        ->where('cart_id', $cart->id)
        ->where('product_id', $id_product)
        ->delete();

    if ($deleted) {
        $cart->update([
            'quantity' => $cart->order_detail()->sum('product_quantity'),
            'total_cart' => $cart->order_detail()->sum('total_order_details'),
        ]);

        return response()->json(['message' => 'Produto eliminado com êxito']);
    } else {
        return response()->json(['error' => 'Produto não encontrado'], 404);
    }
}

public function purchase(){}
}
