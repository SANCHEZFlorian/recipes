<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recette;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminRecipeController extends Controller
{
    public function index()
    {
        $recipes = Recette::with(['user', 'categories'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Admin_recipes', [
            'recipes' => $recipes
        ]);
    }

    public function toggleVisibility($id)
    {
        $recipe = Recette::findOrFail($id);
        $recipe->is_visible = !$recipe->is_visible;
        $recipe->save();

        return redirect()->back()->with('success', 'Visibilité de la recette mise à jour.');
    }

    public function destroy($id)
    {
        $recipe = Recette::findOrFail($id);
        
        // Au lieu de supprimer physiquement, on peut utiliser is_supprimer
        $recipe->is_supprimer = true;
        $recipe->is_visible = false;
        $recipe->save();

        return redirect()->back()->with('success', 'La recette a été marquée comme supprimée.');
    }
}
