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
     * Renvoie toutes les recettes associées à cette catégorie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recettes()
    {
        return $this->belongsToMany(Recette::class, 'recette_recette_categorie', 'recette_categorie_id', 'recette_id');
    }
}
