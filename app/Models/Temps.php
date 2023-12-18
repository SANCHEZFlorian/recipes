<?php

namespace App\Models;

use App\Models\Recette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Temps extends Model
{
    use HasFactory;

    protected $fillable = [
        'recette_id',
        'temps',
        'type'
    ];

    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }
}
