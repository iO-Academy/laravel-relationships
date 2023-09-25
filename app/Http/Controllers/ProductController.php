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
            // We can get specific fields from a relationship using a :
                // and then a list of the fields we want
            // Because the relationship with a review belongs to the reviews table, you need to make sure
                // you select the foreign key
            // Categories are controlled by product, so you there is no foreign key to ignore
            'data' => Product::with(['reviews:text,name,stars,product_id', 'category:id,name', 'orders'])->get(),
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
