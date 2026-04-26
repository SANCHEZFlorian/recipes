<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupInvitation extends Model
{
    use HasFactory;

    protected $table = 'group_invitations';

    protected $fillable = [
        'email',
        'groupe_id',
    ];

    /**
     * Relation avec la table 'groupe'.
     */
    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id', 'id');
    }
}
