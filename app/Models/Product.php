<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'alcool_volume',
        'category_id',
        'brand_id',
        'image_url',
    ];

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
        return $this->hasMany(ProductVariant::class);
    }

    public function variants()
    {
        return $this->productVariants();
    }
}
