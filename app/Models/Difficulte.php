<?php

namespace App\Models;

use App\Models\Recette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Difficulte extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function recettes()
    {
        return $this->hasMany(Recette::class, 'difficulte_id', 'id');
    }
}
