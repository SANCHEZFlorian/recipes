<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'recette_id',
        'commentaire_id',
        'avis_id',
        'is_read',
        'type'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation with the 'users' table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la table 'commentaires'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentaire()
    {
        return $this->belongsTo(Commentaire::class, 'commentaire_id');
    }

    /**
     * Relation avec la table 'recettes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id');
    }

    /**
     * Relation avec la table 'avis'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function avis()
    {
        return $this->belongsTo(Avis::class, 'avis_id');
    }
}
