<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ustensile extends Model
{
    protected $table = 'ustensile';
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
        'photo_id'
    ];

    public $timestamps = false;

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Renvoie les ustensiles qui sont utilis s dans les recettes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteUstensiles()
    {
        return $this->hasMany(RecetteUstensile::class, 'ustensile_id', 'id');
    }

    /**
     * Renvoie les photos associées à l'ustensile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ustensilePhoto()
    {
        return $this->hasMany(UstensilePhoto::class, 'ustensile_id', 'id');
    }
}
