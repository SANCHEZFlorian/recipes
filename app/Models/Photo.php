<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    protected $table = 'photo';
    use HasFactory;

    protected $fillable = [
        'nom_fichier',
        'type'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'users'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'photo_id', 'id');
    }

    /**
     * Relation avec la table 'user_photos'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userPhotos()
    {
        return $this->hasMany(UserPhoto::class, 'photo_id', 'id');
    }

    /**
     * Relation avec la table 'recette_photos'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recettePhotos()
    {
        return $this->hasMany(RecettePhoto::class, 'photo_id', 'id');
    }

    /**
     * Relation avec la table 'ustensile_photos'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photoUstensiles()
    {
        return $this->hasMany(UstensilePhoto::class, 'photo_id', 'id');
    }
}
