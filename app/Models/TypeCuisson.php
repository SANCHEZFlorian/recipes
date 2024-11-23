<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeCuisson extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Get the cooking steps associated with this cooking type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteEtapes()
    {
        return $this->hasMany(RecetteEtape::class, 'type_cuisson_id', 'id');
    }
}
