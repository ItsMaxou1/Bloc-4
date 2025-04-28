<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Indiquer le nom de la table si nécessaire (si elle n'est pas au pluriel par exemple)
    protected $table = 'orders';

    // Définir les champs qui peuvent être remplis massivement
    protected $fillable = [
        'user_id',
        'total_without_tax',
        'tax_amount',
        'total_included_tax',
        'status'
    ];

    // Définir les relations, ici un ordre appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
