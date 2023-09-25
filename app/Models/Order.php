<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    // The hidden property species fields to be hidden by default
    // when using the model
    // We put pivot in here when using many to many if we don't
    // need to see the pivot table in the results (hide the pivot
    // in both models)
    protected $hidden = ['pivot'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
