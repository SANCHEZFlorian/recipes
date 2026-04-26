<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recette extends Model
{
    protected $table = 'recette';
    use HasFactory;

    protected $fillable = [
        'title',
        'portions',
        'is_visible',
        'is_supprimer',
        'users_id',
        'groupe_id',
        'recette_type_id',
        'prix_id',
        'type_cuisson_id',
        'difficulte_id'
    ];

    //*------------------------------------//
    //* Relations avec les autres tables   //
    //*------------------------------------//

    /**
     * Relation avec la table 'users'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    /**
     * Relation avec la table 'groupes'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id', 'id');
    }

    /**
     * Relation avec la table 'recette_types'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function RecetteType()
    {
        return $this->belongsTo(RecetteType::class, 'recette_type_id', 'id');
    }

    /**
     * Relation avec la table 'prix'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prix()
    {
        return $this->belongsTo(Prix::class, 'prix_id', 'id');
    }

    /**
     * Relation avec la table 'type_cuissons'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeCuisson()
    {
        return $this->belongsTo(TypeCuisson::class, 'type_cuisson_id', 'id');
    }

    /**
     * Renvoie la difficulté de la recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function difficulte()
    {
        return $this->belongsTo(Difficulte::class, 'difficulte_id', 'id');
    }

    /**
     * Renvoie les ingrédients nécessaires pour la recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteIngredients()
    {
        return $this->hasMany(RecetteIngredient::class, 'recette_id', 'id');
    }

    /**
     * Renvoie les ustensiles nécessaires pour la recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteUstensiles()
    {
        return $this->hasMany(RecetteUstensile::class, 'recette_id', 'id');
    }

    /**
     * Relation avec la table 'recette_photos'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recettePhotos()
    {
        return $this->hasMany(RecettePhoto::class, 'recette_id', 'id');
    }

    /**
     * Retrieve all steps of a recipe associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recetteEtapes()
    {
        return $this->hasMany(RecetteEtape::class, 'recette_id', 'id');
    }

    /**
     * Relation avec la table 'temps'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function temps()
    {
        return $this->hasOne(Temps::class, 'recette_id', 'id');
    }

    //*------------------------------------//
    //* Requête SQL diverses liés          //
    //*------------------------------------//

    /**
     * Renvoie les recettes qui contiennent l'aliment passé en paramètre.
     *
     * @param int $alimentId L'ID de l'aliment.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByAliment($alimentId)
    {
        return self::whereHas('recetteIngredients', function ($query) use ($alimentId) {
            $query->where('aliment_id', $alimentId);
        })->get();
    }

    /**
     * Tri les recettes par aliment.
     *
     * @param int $alimentId L'ID de l'aliment.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function sortByAliment($alimentId)
    {
        return self::whereHas('recetteIngredients', function ($query) use ($alimentId) {
            $query->where('aliment_id', $alimentId);
        })->orderBy('created_at', 'desc')->get();
    }

    /**
     * Renvoie les avis (notes + commentaires) de la recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis()
    {
        return $this->hasMany(Avis::class, 'recette_id', 'id')->orderBy('created_at', 'desc');
    }

    /**
     * Renvoie les entrées favoris liées à la recette.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoris()
    {
        return $this->hasMany(Favoris::class, 'recette_id', 'id');
    }
}
