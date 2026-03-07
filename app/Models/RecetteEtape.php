<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteEtape extends Model
{
    protected $table = 'recette_etape';
    use HasFactory;

    protected $fillable = [
        'recette_id',
        'type_cuisson_id',
        'numero',
        'description'
    ];

    public $timestamps = false;

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
     * Renvoie les ingrédients associés à cette étape (many-to-many via pivot).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany(RecetteIngredient::class, 'recette_etape_ingredient', 'recette_etape_id', 'recette_ingredient_id');
    }

    /**
     * Renvoie les ustensiles associés à cette étape (many-to-many via pivot).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ustensiles()
    {
        return $this->belongsToMany(Ustensile::class, 'recette_etape_ustensile', 'recette_etape_id', 'ustensile_id');
    }
}
