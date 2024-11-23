<?php

namespace App\Models;

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

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Renvoie la recette associée cette étape.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }

    /**
     * Renvoie le type de cuisson associé cette étape.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeCuisson()
    {
        return $this->belongsTo(TypeCuisson::class, 'type_cuisson_id', 'id');
    }

    /**
     * Renvoie l'ingrédient associé cette étape.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recetteIngredient()
    {
        return $this->belongsTo(RecetteIngredient::class, 'recette_ingredient_id', 'id');
    }
}
