<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class unite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
        'abreviation'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Renvoie les ingrédients qui ont cette unit .
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteIngredients()
    {
        return $this->hasMany(RecetteIngredient::class, 'unite_id', 'id');
    }
}
