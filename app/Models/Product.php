<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    // Adding a relationship method that links
    // products to reviews
    // The name of this method must match the table we're joining
    public function reviews(): HasMany
    {
        // Products have many reviews, so we use the hasMany
        // method
        return $this->hasMany(Review::class);
    }
}
