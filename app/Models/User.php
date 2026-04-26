<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'city',
        'country',
        'postal',
        'about',
        'date_derniere_connexion',
        'is_admin',
        'photo_id'
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

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'photo' (avatar de l'utilisateur).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    /**
     * Relation avec la table 'recettes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'users_id', 'id');
    }

    /**
     * Relation avec la table 'groupes' via la table pivot 'user_groupe'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'user_groupe', 'users_id', 'groupe_id');
    }

    /**
     * Relation avec la table 'avis'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis()
    {
        return $this->hasMany(Avis::class, 'users_id', 'id');
    }

    /**
     * Relation avec la table 'commentaires'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'users_id', 'id');
    }

    /**
     * Retourne les recettes que l'utilisateur a mis en favoris.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoris()
    {
        return $this->belongsToMany(Recette::class, 'favoris', 'users_id', 'recette_id');
    }

    /**
     * Relation avec la table 'notifications'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'users_id', 'id');
    }

    //*------------------------------------//
    //* Requête SQL diverses liés          //
    //*------------------------------------//

    /**
     * Retrieves comments associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCommentaires()
    {
        return Commentaire::where('user_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Renvoie les recettes crées par l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecettes()
    {
        return Recette::where('users_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Renvoie le nombre de recettes crées par l'utilisateur.
     *
     * @return int
     */
    public function getNbRecettes()
    {
        return Recette::where('users_id', $this->id)->count();
    }

    /**
     * Renvoie les recettes sur lesquelles l'utilisateur a posté au moins un commentaire.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecettesCommentees()
    {
        return Recette::whereHas('commentaires', function ($query) {
            $query->where('users_id', $this->id);
        })->orderBy('created_at', 'desc')->get();
    }

    /**
     * Le mot de passe est haché automatiquement via le cast 'hashed' défini dans $casts.
     * Ne pas redéfinir setPasswordAttribute pour éviter le double-haçhage.
     */

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
