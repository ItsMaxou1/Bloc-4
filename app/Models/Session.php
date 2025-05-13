<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    // Indiquer le nom de la table si nécessaire (si elle n'est pas au pluriel par exemple)
    protected $table = 'sessions';

    // Si tu veux éviter que Laravel ne gère automatiquement les timestamps
    public $timestamps = false;

    // Définir les relations si nécessaire
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
