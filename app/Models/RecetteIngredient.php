<?php

namespace App\Models;

use App\Models\Unite;
use App\Models\Aliment;
use App\Models\Recette;
use App\Models\RecetteEtape;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'recette_id',
        'aliment_id',
        'unite_id',
        'etape_id'
    ];

    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }

    public function aliment()
    {
        return $this->belongsTo(Aliment::class, 'aliment_id', 'id');
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class, 'unite_id', 'id');
    }

    public function etape()
    {
        return $this->belongsTo(RecetteEtape::class, 'etape_id', 'id');
    }
}
