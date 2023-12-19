<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'photo_id',
        'date_inscription',
        'date_derniere_connexion'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function photo()
    {
        return $this->hasOne(Photo::class, 'id', 'photo_id');
    }

    public function userPhotos()
    {
        return $this->hasMany(UserPhoto::class, 'users_id', 'id');
    }

    public function recettes()
    {
        return $this->hasMany(Recette::class, 'users_id', 'id');
    }

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'user_groupe', 'users_id', 'groupe_id')->withTimestamps();
    }

    // Relation avec la table 'logs' à travers la table 'recette'
    public function logs()
    {
        return $this->hasManyThrough(Logs::class, Recette::class, 'users_id', 'recette_id');
    }

    // Retrouve les commentaires
    public function getCommentaires()
    {
        return Commentaire::where('users_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    // Retrouve les recettes commentées
    public function getRecettesCommentees()
    {
        return Recette::whereHas('commentaires', function ($query) {
            $query->where('users_id', $this->id);
        })->orderBy('created_at', 'desc')->get();
    }
}
