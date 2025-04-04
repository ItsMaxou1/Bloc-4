<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class productVariants extends Model
{
    use HasFactory;

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
