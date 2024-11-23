<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'owner_user_id'
    ];

    /**
     * Relation with the 'users' table for the owner of the group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    /**
     * Relation avec la table 'users' via la table pivot 'user_groupe'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function membres()
    {
        return $this->belongsToMany(User::class, 'user_groupe', 'groupe_id', 'user_id')->withTimestamps();
    }

    /**
     * Retrieves the recipes associated with this group.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'groupe_id', 'id')->orderBy('created_at', 'desc');
    }
}
