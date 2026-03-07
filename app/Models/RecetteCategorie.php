<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteCategorie extends Model
{
    protected $table = 'recette_categorie';
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone'
    ];

    public $timestamps = false;

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'recette_types'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function RecetteTypes()
    {
        return $this->hasMany(RecetteType::class, 'recette_categorie_id', 'id');
    }

    /**
     * Renvoie toutes les recettes associées à cette catégorie via ses types.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function recettes()
    {
        return $this->hasManyThrough(Recette::class, RecetteType::class, 'recette_categorie_id', 'recette_type_id', 'id', 'id');
    }
}
