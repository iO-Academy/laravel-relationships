<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll()
    {
        return response()->json([
            // Using the with method to attach the reviews
            // relationship
            // When using with, we can't use all(), we must use
            // get() instead
            'data' => Product::with('reviews')->get(),
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($product->save()) {
            return response()->json([
                'data' => [
                    'id' => $product->id
                ],
                'message' => 'success'
            ]);
        }
    }
}
