<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    // Defining the inverse of the relationship
    public function product(): BelongsTo
    {
        // Using belongsTo because a review has a product_id
        // The product belongs to the review
        return $this->belongsTo(Product::class);
    }
}
