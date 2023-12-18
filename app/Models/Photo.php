<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserPhoto;
use App\Models\RecettePhoto;
use App\Models\PhotoUstensile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_fichier',
        'type'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'photo_id', 'id');
    }

    public function userPhotos()
    {
        return $this->hasMany(UserPhoto::class, 'photo_id', 'id');
    }

    public function recettePhotos()
    {
        return $this->hasMany(RecettePhoto::class, 'photo_id', 'id');
    }

    public function photoUstensiles()
    {
        return $this->hasMany(UstensilePhoto::class, 'photo_id', 'id');
    }
}
