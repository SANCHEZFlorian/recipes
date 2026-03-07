<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlimentType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AdminIngredientCategoryController extends Controller
{
    public function index()
    {
        $categories = AlimentType::withCount('aliments')->orderBy('nom')->get()->map(function ($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->nom,
                'slug' => Str::slug($cat->nom),
                'description' => 'Catégorie d\'ingrédients ' . strtolower($cat->nom),
                'image' => $cat->icone ?? '/storage/default_ingredient_category.jpg',
                'parentCategory' => null, // Mocked as we don't have hierarchy
                'ingredientCount' => $cat->aliments_count,
                'status' => 'Active', // Mocked
                'lastModified' => 'N/A'
            ];
        });

        return Inertia::render('Admin_ingredient_categorie', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:aliment_type,nom',
            'icone' => 'nullable|string'
        ]);

        AlimentType::create($validated);

        return back()->with('success', 'Catégorie d\'ingrédient créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:aliment_type,nom,' . $id,
            'icone' => 'nullable|string'
        ]);

        $category = AlimentType::findOrFail($id);
        $category->update($validated);

        return back()->with('success', 'Catégorie d\'ingrédient mise à jour.');
    }

    public function destroy($id)
    {
        $category = AlimentType::findOrFail($id);
        
        if ($category->aliments()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des ingrédients.');
        }

        $category->delete();

        return back()->with('success', 'Catégorie supprimée.');
    }

    public function toggleStatus($id)
    {
        return back()->with('success', 'Statut mis à jour (Simulé).');
    }
}
