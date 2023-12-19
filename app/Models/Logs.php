<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'recette_id',
        'modification',
    ];

    // Relation avec la table 'recette'
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id');
    }
}
