<?php

namespace App\Models;

use App\Models\Logs;
use App\Models\Prix;
use App\Models\User;
use App\Models\Groupe;
use App\Models\Difficulte;
use App\Models\RecetteType;
use App\Models\TypeCuisson;
use App\Models\RecetteEtape;
use App\Models\RecettePhoto;
use App\Models\RecetteUstensile;
use App\Models\RecetteIngredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'groupe_id',
        'recette_type_id',
        'prix_id',
        'type_cuisson_id',
        'difficulte_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id', 'id');
    }

    public function RecetteType()
    {
        return $this->belongsTo(RecetteType::class, 'recette_type_id', 'id');
    }

    public function prix()
    {
        return $this->belongsTo(Prix::class, 'prix_id', 'id');
    }

    public function typeCuisson()
    {
        return $this->belongsTo(TypeCuisson::class, 'type_cuisson_id', 'id');
    }

    public function difficulte()
    {
        return $this->belongsTo(Difficulte::class, 'difficulte_id', 'id');
    }

    public function recetteIngredients()
    {
        return $this->hasMany(RecetteIngredient::class, 'recette_id', 'id');
    }

    public function recetteUstensiles()
    {
        return $this->hasMany(RecetteUstensile::class, 'recette_id', 'id');
    }

    public function recettePhotos()
    {
        return $this->hasMany(RecettePhoto::class, 'recette_id', 'id');
    }

    public function recetteEtapes()
    {
        return $this->hasMany(RecetteEtape::class, 'recette_id', 'id');
    }

    // Relation avec la table 'logs'
    public function logs()
    {
        return $this->hasMany(Logs::class, 'recette_id');
    }

    // Recherche par aliment
    public static function searchByAliment($alimentId)
    {
        return self::whereHas('recetteIngredients', function ($query) use ($alimentId) {
            $query->where('aliment_id', $alimentId);
        })->get();
    }

    // Recherche par catégorie de recette
    public static function searchByCategorie($categorieId)
    {
        return self::where('categorie_recette_id', $categorieId)->get();
    }

    // Recherche par type de recette
    public static function searchByType($typeId)
    {
        return self::where('type_recette_id', $typeId)->get();
    }

    // Tri par aliment
    public static function sortByAliment($alimentId)
    {
        return self::whereHas('recetteIngredients', function ($query) use ($alimentId) {
            $query->where('aliment_id', $alimentId);
        })->orderBy('created_at', 'desc')->get();
    }

    // Tri par catégorie de recette
    public static function sortByCategorie($categorieId)
    {
        return self::where('categorie_recette_id', $categorieId)->orderBy('created_at', 'desc')->get();
    }

    // Tri par type de recette
    public static function sortByType($typeId)
    {
        return self::where('type_recette_id', $typeId)->orderBy('created_at', 'desc')->get();
    }

    // Récupère toutes les étapes d'une recette trier par numéro
    public function etapes()
    {
        return $this->hasMany(RecetteEtape::class, 'recette_id', 'id')->orderBy('numero');
    }

    // Récupère tous les ustensiles d'une recette
    public function ustensiles()
    {
        return $this->hasMany(RecetteUstensile::class, 'recette_id', 'id');
    }
}
