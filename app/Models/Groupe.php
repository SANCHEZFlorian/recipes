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
}
