<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    use HasFactory;
    protected $appends = ['full_logo_url'];

    // Définir la relation avec Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getFullLogoUrlAttribute(): string
    {
        // Si aucun logo n'est défini en base, on renvoie un placeholder
        if (!$this->logo_url) {
            return asset('assets/images/logo/maintenancelogo.png');
        }

        // Sinon, on concatène le dossier public et le nom de fichier
        return asset('assets/images/logo/' . $this->logo_url); //c'est la valeur qu'il y a de stocker en BD
    }
}
