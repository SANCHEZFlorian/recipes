<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetteUstensile extends Model
{
    use HasFactory;

    protected $table = 'recette_ustensile';

    protected $fillable = [
        'recette_id',
        'ustensile_id',
    ];

    // Relation avec la table 'recette'
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id');
    }

    // Relation avec la table 'ustensile'
    public function ustensile()
    {
        return $this->belongsTo(Ustensile::class, 'ustensile_id');
    }
}
