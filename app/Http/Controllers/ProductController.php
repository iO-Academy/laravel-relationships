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
            // When we have multiple relationships, we pass with
            // an array instead of a string
            'data' => Product::with(['reviews', 'category'])->get(),
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category,id'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

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
