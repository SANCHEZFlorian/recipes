<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlimentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'aliments'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aliments()
    {
        return $this->hasMany(Aliment::class, 'aliment_type_id', 'id');
    }

    //*------------------------------------//
    //* Requête SQL diverses liés          //
    //*------------------------------------//

    /**
     * Renvoie la liste des types d'aliments.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAlimentTypes()
    {
        return AlimentType::all();
    }

    /**
     * Renvoie la liste des recettes par type d'aliment.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecettesParType()
    {
        return Recette::all();
    }
}
