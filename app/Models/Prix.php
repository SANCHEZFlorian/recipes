<?php

namespace App\Models;

use App\Models\Recette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prix extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function recettes()
    {
        return $this->hasMany(Recette::class, 'prix_id', 'id');
    }
}
