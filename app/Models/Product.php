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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function multi_image()
    {
        return $this->hasMany(ProductImage::class);
    }

}
