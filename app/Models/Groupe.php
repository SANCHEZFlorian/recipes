<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'owner_users_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_users_id', 'id');
    }

    public function membres()
    {
        return $this->belongsToMany(User::class, 'user_groupe', 'groupe_id', 'users_id')->withTimestamps();
    }

    // Relation avec la table 'logs' à travers la table 'recette'
    public function logs()
    {
        return $this->hasManyThrough(Logs::class, Recette::class, 'groupe_id', 'recette_id');
    }

    // Recherche les recherches du groupe
    public function getRecettes()
    {
        return Recette::where('groupe_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    // Récupère les recettes d'un groupe
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'groupe_id', 'id')->orderBy('created_at', 'desc');
    }
}
