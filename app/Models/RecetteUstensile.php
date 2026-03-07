<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetteUstensile extends Model
{
    use HasFactory;

    protected $table = 'recette_ustensile';

    protected $fillable = [
        'recette_id',
        'ustensile_id'
    ];

    public $timestamps = false;

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Establishes a relationship with the 'recettes' table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id');
    }

    /**
     * Establishes a relationship with the 'ustensiles' table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ustensile()
    {
        return $this->belongsTo(Ustensile::class, 'ustensile_id');
    }
}
