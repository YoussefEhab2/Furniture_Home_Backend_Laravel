<?php

namespace App\Http\Controllers;

use App\Models\Cartitem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStateChange;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function checkout(Request $request) {

        $cartService = new CartService();

        if ($cartService->getCart($request->user()->cart_id)->total_no_of_items == 0) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $orderService = new OrderService();
        $order = $orderService->createOrder($request->user());
        $items = $cartService->getItems(cartId: $request->user()->cart_id);
        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ]);
        }

        $items = OrderItem::where('order_id', $order->id)->get();
        $cartService->clearCart($request->user()->cart_id);
        return response()->json(['order' => $order, 'items' => $items]);
    }

    public function deleteOrder($orderId) {
        
        if (!Order::whereId($orderId)->exists()) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $orderService = new OrderService();
        $orderService->deleteOrder($orderId);
        return response()->json(['message' => 'Order deleted successfully']);
    }


    public function getOrder(Request $request, $orderId) {

        $order = Order::whereId($orderId);

        if (!$order->exists()) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order = $order->first();

        if ($order->customer_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $orderService = new OrderService();
        return Response()->json($orderService->getOrder($order));
    }

    public function getOrders(Request $request) {
        $orderService = new OrderService();
        $orders = Order::where('customer_id', $request->user()->id)->get();
        $res = [];
        foreach ($orders as $order) {
            $res[] = $orderService->getOrder($order);
        }
        return response()->json(['orders' => $res]);
    }

    public function changeOrderState(Request $request, $orderId) {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $newState = $request->state;

        $validStates = ['Ordered', 'Shipped', 'Delivered', 'Cancelled'];

        if (!in_array($newState, $validStates)) {
            return response()->json(['error' => 'Invalid order status'], 400);
        }

        Order::whereId($orderId)->update(['state' => $newState]);

        $orderService = new OrderService();
        $orderService->createOrderStateChange($orderId, $newState);

        return response()->json(['message' => 'Order status updated successfully']);
    }

    public function getOrderHistory(Request $request, $orderId) {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($order->customer_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $orderHistory = OrderStateChange::where('order_id', $orderId)->get();
        $res = [];
        foreach ($orderHistory as $change) {
            $res[] = [
                'state' => $change->state,
                'changed_at' => $change->timestamp
            ];
        }
        return response()->json(['order_history' => $res]);
    }
}
