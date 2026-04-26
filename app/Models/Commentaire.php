<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    protected $table = 'commentaire';
    use HasFactory;

    protected $fillable = [
        'users_id',
        'recette_id',
        'commentaire'
    ];

    /**
     * Relation avec la table 'users'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    /**
     * Relation avec la table 'recettes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }
}
