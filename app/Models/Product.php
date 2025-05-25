<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    // App\Models\Product.php

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

}
