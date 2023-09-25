<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getAll() 
    {
        return response()->json([
            'data' => Order::all(),
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'customer' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $order = new Order();
        $order->customer = $request->customer;
        $order->address = $request->address;

        if ($order->save()) {
            return response()->json([
                'data' => [
                    'id' => $order->id
                ],
                'message' => 'success'
            ]);
        }
    }
}
