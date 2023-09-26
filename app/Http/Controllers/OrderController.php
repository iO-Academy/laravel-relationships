<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function getAll() 
    {
        $orders = Order::with(['products:id,name,price', 'customer'])->get()->makeHidden(['created_at', 'updated_at']);
        
        $total = $this->orderService->calculateValueOfOrders($orders);
        
        return response()->json([
            'data' => [
                'orders' => $orders,
                'total' => $total
            ],
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id', // product_ids.* is validating each item inside the array
            'customer_id' => 'required|exists:customers,id'
        ]);


        $order = new Order();
        $order->customer_id = $request->customer_id;

        $success = $order->save(); // We need to save the new
        // model first so it has an id

        // Then we use the attach method to update the link
        // table correctly for the given product id array
        // Attach either takes an array of ids, or a single id
        $order->products()->attach($request->product_ids);
        // We can remove a relationship using detach instead of attach
        // works exactly the same

        if ($success) {
            return response()->json([
                'data' => [
                    'id' => $order->id
                ],
                'message' => 'success'
            ]);
        }
    }
}
