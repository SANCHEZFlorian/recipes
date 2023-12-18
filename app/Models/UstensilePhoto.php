<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Ustensile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UstensilePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'ustensile_id'
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    public function ustensile()
    {
        return $this->belongsTo(Ustensile::class, 'ustensile_id', 'id');
    }
}
