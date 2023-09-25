<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    // Adding a relationship method that links
    // products to reviews
    // The name of this method must match the table we're joining
    public function reviews(): HasMany
    {
        // Products have many reviews, so we use the hasMany
        // method
        return $this->hasMany(Review::class);
    }

    // BelongsTo because the product has a category_id
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // With many to many, we always use BelongsToMany on both sides of
    // the relationship
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
