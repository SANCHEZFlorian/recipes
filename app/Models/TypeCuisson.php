<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeCuisson extends Model
{
    protected $table = 'type_cuisson';
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
     * Get the cooking steps associated with this cooking type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteEtapes()
    {
        return $this->hasMany(RecetteEtape::class, 'type_cuisson_id', 'id');
    }
}
