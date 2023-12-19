<?php

namespace App\Models;

use App\Models\AlimentType;
use App\Models\RecetteIngredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aliment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'aliment_type_id'
    ];

    /**
     * Relation avec la table 'aliment_types'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alimentType()
    {
        return $this->belongsTo(AlimentType::class, 'aliment_type_id', 'id');
    }

    /**
     * Relation avec la table 'recette_ingredients'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteIngredients()
    {
        return $this->hasMany(RecetteIngredient::class, 'aliment_id', 'id');
    }

    // Récupère toutes les recettes associées à un aliment
    public function recettes()
    {
        return $this->hasManyThrough(RecetteIngredient::class, Recette::class, 'aliment_id', 'recette_id');
    }
}
