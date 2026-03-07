<?php

namespace App\Http\Controllers;

use App\Models\RecetteCategorie;
use Inertia\Inertia;
use Illuminate\Http\Request;

class RecetteCategorieController extends Controller
{
    /**
     * Display the category list page.
     */
    public function index()
    {
        $categories = RecetteCategorie::withCount('RecetteTypes')
            ->get();

        return Inertia::render('Vitrine_category_list', [
            'categories' => $categories
        ]);
    }

    /**
     * Display the recipes for a specific category.
     */
    public function show($id)
    {
        $category = RecetteCategorie::findOrFail($id);

        // Fetch recipes through the hasManyThrough relationship
        $recipes = $category->recettes()
            ->with(['RecetteType', 'prix', 'difficulte', 'recettePhotos.photo'])
            ->latest()
            ->get();

        return Inertia::render('Vitrine_category_list_recipe', [
            'category' => $category,
            'recipes' => $recipes
        ]);
    }
}
