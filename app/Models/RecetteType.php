<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteType extends Model
{
    protected $table = 'recette_type';
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
        'recette_categorie_id'
    ];

    public $timestamps = false;

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'recette_categories'.
     *
     * Renvoie la catégorie de recette associée ce type de recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function RecetteCategorie()
    {
        return $this->belongsTo(RecetteCategorie::class, 'recette_categorie_id', 'id');
    }

    /**
     * Renvoie les recettes qui ont ce type de recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'recette_type_id', 'id');
    }
}
