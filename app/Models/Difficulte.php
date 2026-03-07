<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Difficulte extends Model
{
    protected $table = 'difficulte';
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone'
    ];

    public $timestamps = false;

    //*------------------------------------//
    //* Requête SQL diverses liés          //
    //*------------------------------------//

    /**
     * Renvoie les recettes par difficulté.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecettes()
    {
        return Recette::where('difficulte_id', $this->id)->orderBy('created_at', 'desc')->get();
    }
}
