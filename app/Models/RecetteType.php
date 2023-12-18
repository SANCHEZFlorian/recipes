<?php

namespace App\Models;

use App\Models\Recette;
use App\Models\RecetteCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'recette_categorie_id'
    ];

    public function RecetteCategorie()
    {
        return $this->belongsTo(RecetteCategorie::class, 'recette_categorie_id', 'id');
    }

    public function recettes()
    {
        return $this->hasMany(Recette::class, 'recette_type_id', 'id');
    }
}
