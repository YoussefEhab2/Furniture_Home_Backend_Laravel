<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cartitem;
use Illuminate\Http\Request;

class CartService
{
    public function getItems($cartId) {
        return Cartitem::where('cart_id', $cartId)->get();
    }

    public function getCart($cartId) {
        return Cart::whereId($cartId)->first();
    }

    public function clearCart($cartId) {
        Cartitem::where('cart_id', $cartId)->delete();
        Cart::whereId($cartId)->update(['total_price' => 0, 'total_no_of_items' => 0]);
    }
}
