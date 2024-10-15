<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Request $request, Cart $cart = null)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        if ($product->stock < $quantity) {
            return response()->json(['error' => 'Not enough stock'], 400);
        }
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $request->user()->id, // Asumiendo que el carrito está asociado a un usuario
            ]);
        }
        $cartItem = $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $product->decrement('stock', $quantity);

        return response()->json($cartItem, 201);
    }

    public function calculateTotal(Cart $cart)
    {
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $tax = Tax::first();
        $totalWithTax = $total + ($total * $tax->percentage / 100);

        return response()->json(['total' => $total, 'total_with_tax' => $totalWithTax]);
    }

    public function show(Cart $cart)
    {
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $tax = Tax::first();
        $totalWithTax = $total + ($total * $tax->percentage / 100);

        return response()->json([
            'cart' => $cart,
            'total' => $total,
            'total_with_tax' => $totalWithTax,
            'tax' => $tax
        ]);
    }
}
