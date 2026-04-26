<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroupe extends Model
{
    protected $table = 'user_groupe';
    use HasFactory;

    protected $fillable = [
        'groupe_id',
        'users_id'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'groupes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id', 'id');
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
}
