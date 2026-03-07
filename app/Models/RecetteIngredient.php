<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecetteIngredient extends Model
{
    protected $table = 'recette_ingredient';
    use HasFactory;

    protected $fillable = [
        'quantite',
        'recette_id',
        'aliment_id',
        'unite_id',
        'etape_id'
    ];

    public $timestamps = false;

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'recettes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id', 'id');
    }

    /**
     * Relation avec la table 'aliments'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aliment()
    {
        return $this->belongsTo(Aliment::class, 'aliment_id', 'id');
    }

    /**
     * Relation avec la table 'unites'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unite()
    {
        return $this->belongsTo(Unite::class, 'unite_id', 'id');
    }

    /**
     * Relation avec la table 'recette_etape'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etape()
    {
        return $this->belongsTo(RecetteEtape::class, 'etape_id', 'id');
    }
}
