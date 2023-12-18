<?php

namespace App\Models;

use App\Models\User;
use App\Models\Groupe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupe_id',
        'users_id'
    ];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
