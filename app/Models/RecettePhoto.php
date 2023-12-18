<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Recette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecettePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'photo_id',
        'recette_id'
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }
}
