<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prix extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
    ];

    /**
     * Relation with the 'recettes' table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'prix_id', 'id');
    }
}
