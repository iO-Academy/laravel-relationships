<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getAll() 
    {
        return response()->json([
            'data' => Review::all(),
            'message' => 'success'
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'stars' => 'required|numeric|min:0|max:5'
        ]);

        $review = new Review();
        $review->text = $request->text;
        $review->name = $request->name;
        $review->stars = $request->stars;

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
