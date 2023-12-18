<?php

namespace App\Models;

use App\Models\PhotoUstensile;
use App\Models\RecetteUstensile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ustensile extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function recetteUstensiles()
    {
        return $this->hasMany(RecetteUstensile::class, 'ustensile_id', 'id');
    }

    public function photoUstensiles()
    {
        return $this->hasMany(PhotoUstensile::class, 'ustensile_id', 'id');
    }
}
