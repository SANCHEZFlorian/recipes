<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'icone'
    ];

    public $timestamps = false;

    /**
     * Retrieves the recipes associated with this period.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'periode_id', 'id');
    }
}
