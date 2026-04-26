<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Avis;
use App\Models\Favoris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RecetteInteractionController extends Controller
{
    /**
     * Basculer l'état "favori" pour l'utilisateur actuel.
     */
    public function toggleFavorite($id)
    {
        $userId = Auth::id();

        $existing = Favoris::where('users_id', $userId)->where('recette_id', $id)->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Recette retirée de vos favoris.');
        } else {
            Favoris::create([
                'users_id' => $userId,
                'recette_id' => $id
            ]);
            return back()->with('success', 'Recette ajoutée à vos favoris.');
        }
    }

    /**
     * Enregistrer un nouvel avis (note + commentaire).
     */
    public function storeAvis(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000'
        ]);

        // Vérifier si l'utilisateur n'a pas déjà laissé un avis
        $existing = Avis::where('users_id', Auth::id())->where('recette_id', $id)->first();
        if ($existing) {
            return back()->withErrors(['error' => 'Vous avez déjà laissé un avis pour cette recette.']);
        }

        Avis::create([
            'users_id' => Auth::id(),
            'recette_id' => $id,
            'note' => $request->note,
            'commentaire' => $request->commentaire
        ]);

        return back()->with('success', 'Votre avis a bien été publié.');
    }

    /**
     * Supprimer un avis existant.
     */
    public function destroyAvis($id)
    {
        $avis = Avis::findOrFail($id);
        
        if ($avis->users_id !== Auth::id() && !optional(Auth::user())->is_admin) {
            return back()->withErrors(['error' => 'Action non autorisée.']);
        }

        $avis->delete();

        return back()->with('success', 'L\'avis a été supprimé.');
    }

    /**
     * Afficher la page des recettes favorites de l'utilisateur.
     */
    public function userFavorites()
    {
        $userId = Auth::id();
        
        // Récupérer les ID des recettes favorites
        $favorisId = Favoris::where('users_id', $userId)->pluck('recette_id');
        
        $recettes = Recette::with(['user', 'RecetteType', 'prix', 'difficulte', 'recettePhotos.photo'])
            ->whereIn('id', $favorisId)
            ->where('is_supprimer', false)
            ->latest()
            ->paginate(12);

        return Inertia::render('Vitrine_my_favorites', [
            'recipes' => $recettes
        ]);
    }
}
