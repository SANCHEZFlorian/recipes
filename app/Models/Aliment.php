<?php

namespace App\Models;

use App\Models\AlimentType;
use App\Models\RecetteIngredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aliment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'aliment_type_id'
    ];

    public function AlimentType()
    {
        return $this->belongsTo(AlimentType::class, 'aliment_type_id', 'id');
    }

    public function recetteIngredients()
    {
        return $this->hasMany(RecetteIngredient::class, 'aliment_id', 'id');
    }
}
