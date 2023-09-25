<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getAll() 
    {
        return response()->json([
            'data' => Review::with('product')->get(),
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'stars' => 'required|numeric|min:0|max:5',
            'product_id' => 'required|exists:products,id' // Using the validator to make sure the id exists in products table
        ]);

        $review = new Review();
        $review->text = $request->text;
        $review->name = $request->name;
        $review->stars = $request->stars;
        // Adding the product_id from the POST data into the product_id field in the review table
        $review->product_id = $request->product_id;

        if ($review->save()) {
            return response()->json([
                'data' => [
                    'id' => $review->id
                ],
                'message' => 'success'
            ]);
        }
    }
}
