<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteCategorie extends Model
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
     * Relation avec la table 'recette_types'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function RecetteTypes()
    {
        return $this->hasMany(RecetteType::class, 'recette_categorie_id', 'id');
    }
}
