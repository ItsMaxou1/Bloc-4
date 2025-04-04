<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    use HasFactory;

    // Définir la relation avec Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
