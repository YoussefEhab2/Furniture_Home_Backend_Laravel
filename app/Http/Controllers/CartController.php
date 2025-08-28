<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_id)
    {

        if (!Product::find($product_id)) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $quantity = $request->quantity;

        $price = Product::find($product_id)->price;

        if (Cartitem::where('cart_id', $request->user()->cart_id)->where('product_id', $product_id)->exists()) {
            $cartItem = Cartitem::where('cart_id', $request->user()->cart_id)->where('product_id', $product_id);
            $cartItem->increment('quantity', $quantity);
            Cart::whereId($request->user()->cart_id)->increment('total_no_of_items', $quantity);
            Cart::whereId($request->user()->cart_id)->increment('total_price', $price * $quantity);
            return response()->json($cartItem->first());
        }

        $cartItem = Cartitem::create([
            'cart_id' => $request->user()->cart_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ]);

        Cart::whereId($request->user()->cart_id)->increment('total_no_of_items', $quantity);
        Cart::whereId($request->user()->cart_id)->increment('total_price', $price * $quantity);

        return response()->json($cartItem);
    }

    public function removeFromCart(Request $request, $product_id)
    {

        if (!Product::find($product_id)) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cartItem = Cartitem::where('cart_id', $request->user()->cart_id)->where('product_id', $product_id);

        if (!$cartItem->exists()) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $quantity = $cartItem->first()->quantity;
        $price = Product::find($product_id)->price;

        $cartItem->delete();
        Cart::whereId($request->user()->cart_id)->decrement('total_no_of_items', $quantity);
        Cart::whereId($request->user()->cart_id)->decrement('total_price', $price * $quantity);
        return response()->json(['message' => 'Cart item removed successfully']);
    }

    public function editItem(Request $request, $product_id)
    {

        if (!Product::find($product_id)) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cartItem = Cartitem::where('cart_id', $request->user()->cart_id)
            ->where('product_id', $product_id);

        if (!$cartItem->exists()) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $quantity = $cartItem->first()->quantity;
        $price = Product::find($product_id)->price;

        $cartItem->update(['quantity' => $request->quantity]);

        Cart::whereId($request->user()->cart_id)->increment('total_no_of_items', $request->quantity - $quantity);
        Cart::whereId($request->user()->cart_id)->increment('total_price', $price * ($request->quantity - $quantity));

        return response()->json($cartItem->first());
    }

    public function getCartItems(Request $request)
    {
        $cartItems = Cartitem::where('cart_id', $request->user()->cart_id)->get();

        $cart = Cart::whereId($request->user()->cart_id)->first();
        return response()->json(['cart' => $cart, 'items' => $cartItems]);
    }
}