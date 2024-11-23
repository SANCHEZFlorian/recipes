<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UstensilePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'ustensile_id'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Renvoie la photo associée  l'ustensile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    /**
     * Renvoie l'ustensile associé la photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ustensile()
    {
        return $this->belongsTo(Ustensile::class, 'ustensile_id', 'id');
    }
}
