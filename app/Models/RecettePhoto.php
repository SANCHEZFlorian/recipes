<?php

namespace App\Models;

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

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation with the 'photos' table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    /**
     * Relation with the 'recettes' table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }
}
