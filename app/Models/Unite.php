<?php

namespace App\Models;

use App\Models\RecetteIngredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class unite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'abreviation'
    ];

    public function recetteIngredients()
    {
        return $this->hasMany(RecetteIngredient::class, 'unite_id', 'id');
    }
}
