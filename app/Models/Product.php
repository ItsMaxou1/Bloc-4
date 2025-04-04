<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Définir la relation avec Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Définir la relation avec Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Définir la relation avec ProductVariants
    public function productVariants()
    {
        return $this->hasMany(ProductVariants::class);
    }
}
