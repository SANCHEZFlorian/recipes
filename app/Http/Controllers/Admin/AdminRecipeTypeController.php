<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecetteType;
use App\Models\RecetteCategorie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminRecipeTypeController extends Controller
{
    public function index()
    {
        $types = RecetteType::with('recetteCategorie')->get();
        // Fallback for categories naming relation mismatch if any
        foreach ($types as $type) {
            $type->categorie_nom = $type->recetteCategorie ? $type->recetteCategorie->nom : 'N/A';
        }
        
        $categories = RecetteCategorie::all();

        return Inertia::render('Admin_recipe_type', [
            'types' => $types,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string|max:255',
            'recette_categorie_id' => 'required|exists:recette_categories,id'
        ]);

        RecetteType::create($validated);

        return redirect()->back()->with('success', 'Type de recette créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string|max:255',
            'recette_categorie_id' => 'required|exists:recette_categories,id'
        ]);

        $type = RecetteType::findOrFail($id);
        $type->update($validated);

        return redirect()->back()->with('success', 'Type de recette mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $type = RecetteType::findOrFail($id);
        
        // Prevent deletion if used by recipes
        $recipeCount = \App\Models\Recette::where('recette_type_id', $id)->count();
        if ($recipeCount > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce type car il est utilisé par ' . $recipeCount . ' recette(s).');
        }

        $type->delete();

        return redirect()->back()->with('success', 'Type de recette supprimé avec succès.');
    }
}
