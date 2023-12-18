<?php

namespace App\Models;

use App\Models\RecetteEtape;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeCuisson extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function recetteEtapes()
    {
        return $this->hasMany(RecetteEtape::class, 'type_cuisson_id', 'id');
    }
}
