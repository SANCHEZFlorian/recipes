<?php

namespace App\Models;

use App\Models\Recette;
use App\Models\TypeCuisson;
use App\Models\RecetteIngredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteEtape extends Model
{
    use HasFactory;

    protected $fillable = [
        'recette_id',
        'type_cuisson_id',
        'recette_ingredient_id',
        'numero',
        'description'
    ];

    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }

    public function typeCuisson()
    {
        return $this->belongsTo(TypeCuisson::class, 'type_cuisson_id', 'id');
    }

    public function recetteIngredient()
    {
        return $this->belongsTo(RecetteIngredient::class, 'recette_ingredient_id', 'id');
    }
}
