<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll()
    {
        return response()->json([
            'data' => Product::with(['reviews:text,name,stars,product_id', 'category:id,name', 'tags'])->get(),
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        $success = $product->save();

        $product->tags()->attach($request->tag_ids);

        if ($success) {
            return response()->json([
                'data' => [
                    'id' => $product->id
                ],
                'message' => 'success'
            ]);
        }
    }
}
