<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aliment extends Model
{
    protected $table = 'aliment';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
        'is_certified',
        'aliment_type_id'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

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

    //*------------------------------------//
    //* Requête SQL diverses liés          //
    //*------------------------------------//

    /**
     * Renvoie les recettes qui contiennent cet aliment.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recettes()
    {
        return $this->hasManyThrough(RecetteIngredient::class, Recette::class, 'aliment_id', 'recette_id')->get();
    }
}
