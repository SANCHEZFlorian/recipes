<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'recette_id',
        'note',
        'commentaire'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'recettes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }

    /**
     * Relation avec la table 'users'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    //*------------------------------------//
    //* Requête SQL diverses liés          //
    //*------------------------------------//
}
