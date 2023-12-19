<?php

namespace App\Models;

use App\Models\Aliment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlimentType extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    /**
     * Relation avec la table 'aliments'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aliments()
    {
        return $this->hasMany(Aliment::class, 'aliment_type_id', 'id');
    }
}
