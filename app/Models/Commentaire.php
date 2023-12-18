<?php

namespace App\Models;

use App\Models\User;
use App\Models\Recette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'recette_id',
        'note',
        'commentaire'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }
}
