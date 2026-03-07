<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecetteCategorie;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = RecetteCategorie::withCount('recettes')->orderBy('nom')->get()->map(function ($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->nom,
                'slug' => Str::slug($cat->nom),
                'description' => 'Gérez les recettes de type ' . strtolower($cat->nom), // Dummy description as DB doesn't have it
                'image' => $cat->photo, // Might be null
                'icon' => $cat->icone ?? 'fas fa-tags',
                'recipe_count' => $cat->recettes_count,
                'status' => 'Active', // Mocked as we don't have this column yet
                'lastModified' => 'N/A'
            ];
        });

        return Inertia::render('Admin_category', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:recette_categorie,nom',
        ]);

        RecetteCategorie::create($validated);

        return back()->with('success', 'Catégorie créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:recette_categorie,nom,' . $id,
        ]);

        $category = RecetteCategorie::findOrFail($id);
        $category->update($validated);

        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function destroy($id)
    {
        $category = RecetteCategorie::findOrFail($id);
        
        if ($category->recettes()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des recettes.');
        }

        $category->delete();

        return back()->with('success', 'Catégorie supprimée.');
    }

    public function toggleStatus($id)
    {
        // Mocked as DB doesn't have a status column for categories yet
        return back()->with('success', 'Statut mis à jour (Simulé).');
    }
}
