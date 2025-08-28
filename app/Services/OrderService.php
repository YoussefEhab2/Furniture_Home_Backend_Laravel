<?php

namespace App\Services;

use App\Models\Cartitem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStateChange;
use Illuminate\Http\Request;

class OrderService
{
    public function createOrder($user) {
        $cartService = new CartService();
        return Order::create([
            'customer_id' => $user->id,
            'total_price' => $cartService->getCart($user->cart_id)->total_price,
            'status' => 'Ordered'
        ]);
    }

    public function deleteOrder($orderId) {
        OrderItem::where('order_id', $orderId)->delete();
        Order::find($orderId)->delete();
    }

    public function getOrder($order) {
        $items = OrderItem::where('order_id', $order->id)->get();

        return ['order' => $order, 'items' => $items];
    }

    public function createOrderStateChange($orderId, $newState) {
        OrderStateChange::create([
            'order_id' => $orderId,
            'state' => $newState
        ]);
    }
}