<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliment;
use App\Models\AlimentType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminIngredientController extends Controller
{
    public function index()
    {
        $ingredients = Aliment::with('alimentType')->orderByDesc('is_certified')->orderBy('nom')->get()->map(function ($ing) {
            return [
                'id' => $ing->id,
                'name' => $ing->nom,
                'category' => $ing->alimentType ? $ing->alimentType->nom : 'N/A',
                'aliment_type_id' => $ing->aliment_type_id,
                'status' => $ing->is_certified ? 'Certifié' : 'Non Certifié',
                'nutritionScore' => 'A', // Dummy
                'lastModified' => 'N/A'
            ];
        });

        $types = AlimentType::orderBy('nom')->get()->map(function ($type) {
            return [
                'id' => $type->id,
                'name' => $type->nom
            ];
        });

        return Inertia::render('Admin_ingredient', [
            'ingredients' => $ingredients,
            'types' => $types
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'aliment_type_id' => 'required|exists:aliment_type,id',
            'is_certified' => 'boolean'
        ]);

        Aliment::create([
            ...$validated,
            'user_id' => \Illuminate\Support\Facades\Auth::id() ?? 1 // Fallback just in case
        ]);

        return back()->with('success', 'Ingrédient créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'aliment_type_id' => 'required|exists:aliment_type,id',
            'is_certified' => 'boolean' // We send boolean from form
        ]);

        $ingredient = Aliment::findOrFail($id);
        $ingredient->update($validated);

        return back()->with('success', 'Ingrédient mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $ingredient = Aliment::findOrFail($id);
        
        // Check if it's used in recipes
        if ($ingredient->recetteIngredients()->count() > 0) {
            return back()->with('error', 'Cet ingrédient est utilisé dans des recettes et ne peut pas être supprimé.');
        }

        $ingredient->delete();

        return back()->with('success', 'Ingrédient supprimé.');
    }

    public function certify($id)
    {
        $ingredient = Aliment::findOrFail($id);
        $ingredient->update(['is_certified' => !$ingredient->is_certified]);

        return back()->with('success', 'Statut de certification mis à jour !');
    }
}
