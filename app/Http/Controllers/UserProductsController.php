<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
use Illuminate\Support\Facades\Http;
=======
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5

class UserProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function addToCart(Request $request)
    {
        $user = auth()->user();

<<<<<<< HEAD
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
=======
        // Buscar um carrinho ativo para o usuário
        $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

        // Se não houver um carrinho ativo, cria um novo
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 'Processing',
                'quantity' => 0,
                'subtotal_cart' => 0,
                'total_cart' => 0,
            ]);
        }

        // Obtém informações do produto
        $product = Product::find($request->input('product_id'));

        // Verifica se o produto existe
        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        // Adiciona o produto ao carrinho
        $cartItem = OrderDetail::create([
            'cart_id' => $cart->id,
            'product_id' => $request->input('product_id'),
            'product_quantity' => $request->input('quantity'),
            'subtotal_order_details' => $request->input('quantity') * $product->price_product,
            'total_order_details' => $request->input('quantity') * $product->price_product,
        ]);

        // Atualiza a quantidade e o preço total do carrinho
        $cart->update([
            'quantity' => $cart->quantity + 1,
            'total_cart' => $cart->total_cart + $cartItem->total_order_details,
        ]);

        return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso']);
    }

    public function updateCart(Request $request)
    {
        $user = auth()->user();

        // Buscar um carrinho ativo para o usuário
        $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

        // Se não houver um carrinho ativo, você pode lidar com isso conforme seus requisitos (criar um novo ou retornar uma mensagem)
        if (!$cart) {
            return response()->json(['message' => 'Carrinho não encontrado'], 404);
        }

        // Verificar se os dados necessários estão presentes na solicitação
        if ($request->has('product_id') && $request->has('product_quantity')) {
            // Obter o preço do produto
            $productPrice = Product::find($request->input('product_id'))->price_product;

            // Atualizar o carrinho usando a relação product_order
            $cart->product_order()->where('product_id', $request->input('product_id'))->update([
                'product_quantity' => $request->input('product_quantity'),
                'total_order_details' => $productPrice * $request->input('product_quantity'),
            ]);

            // Recalcula o total_price com base na nova product_quantity
            $cart->update([
                'total_cart' => $cart->product_order()->sum('total_order_details'),
            ]);

            return response()->json(['message' => 'O carrinho foi atualizado com sucesso']);
        } else {
            return response()->json(['error' => 'Não há dados no carrinho'], 400);
        }
    }

    public function removeProductFromCart(Request $request)
    {
        $user = auth()->user();

        // Buscar um carrinho ativo para o usuário
        $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

        // Se não houver um carrinho ativo, você pode lidar com isso conforme seus requisitos (criar um novo ou retornar uma mensagem)
        if (!$cart) {
            return response()->json(['message' => 'Carrinho não encontrado'], 404);
        }

        // Obter o ID do produto do corpo da solicitação
        $productId = $request->input('product_id');

        // Use uma consulta SQL direta para excluir o produto do carrinho
        $deleted = DB::table('order_details')
            ->where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->delete();

        if ($deleted) {
            // Atualizar a quantidade total e o preço total do carrinho
            $cart->update([
                'quantity' => $cart->product_order()->sum('product_quantity'),
                'total_cart' => $cart->product_order()->sum('total_order_details'),
            ]);

            return response()->json(['message' => 'O produto foi removido do carrinho com sucesso']);
        } else {
            return response()->json(['error' => 'Produto não encontrado no carrinho'], 404);
        }
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
    }

<<<<<<< HEAD
public function purchase(){}
}
=======
    public function viewCart()
    {
        // Obtén o usuário autenticado
        $user = auth()->user();

        // Buscar um carrinho ativo para o usuário
        $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

        if ($cart) {
            // Recupera os produtos no carrinho com seus nomes
            $productNames = OrderDetail::where('cart_id', $cart->id)
                ->with(['product:id,name'])
                ->get(['product_id', 'product_quantity']);

            // Transforma a coleção para mostrar apenas o campo "name"
            $productNames->transform(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'product_quantity' => $item->product_quantity,
                    'product' => Product::find($item->product_id)->name,
                ];
            });

            return response()->json(['order' => $cart, 'productNames' => $productNames]);
        }

        return response()->json(['message' => 'Carrinho está vazio']);
    }

    public function clearCart()
    {
        $user = auth()->user();

        // Buscar um carrinho ativo para o usuário
        $cart = Cart::where('user_id', $user->id)->where('status', 'Processing')->first();

        if ($cart) {
            // Excluir todos os produtos associados ao carrinho
            $cart->product_order()->delete();

            // Atualizar as informações do carrinho
            $cart->update([
                'quantity' => 0,
                'total_cart' => 0,
            ]);

            return response()->json(['message' => 'O carrinho foi limpo com sucesso']);
        }

        return response()->json(['message' => 'O carrinho está vazio']);
    }
}
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
