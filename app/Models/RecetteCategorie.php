<?php

namespace App\Models;

use App\Models\RecetteType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteCategorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function RecetteTypes()
    {
        return $this->hasMany(RecetteType::class, 'recette_categorie_id', 'id');
    }
}
