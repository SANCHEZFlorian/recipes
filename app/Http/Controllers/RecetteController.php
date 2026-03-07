<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Inertia\Inertia;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display the recipe discovery page.
     */
    public function index()
    {
        $recettes = Recette::with(['user', 'RecetteType', 'prix', 'difficulte', 'recettePhotos.photo'])
            // ->where('is_visible', true)
            // ->where('is_supprimer', false)
            ->latest()
            ->paginate(12);

        return Inertia::render('Vitrine_recipe_discovery', [
            'recipes' => $recettes
        ]);
    }

    /**
     * Display a specific recipe.
     */
    public function show($id)
    {
        $recette = Recette::with([
            'user',
            'RecetteType',
            'prix',
            'difficulte',
            'recetteIngredients.aliment',
            'recetteIngredients.unite',
            'recettePhotos.photo',
            'recetteEtapes.ingredients.aliment',
            'recetteEtapes.ustensiles',
            'recetteUstensiles.ustensile',
            'temps'
        ])->findOrFail($id);

        return Inertia::render('Vitrine_recipe', [
            'recipe' => $recette
        ]);
    }
    /**
     * Redirect to a random recipe.
     */
    public function random()
    {
        $id = Recette::inRandomOrder()->value('id');

        if (!$id) {
            return redirect()->route('home')->with('error', 'Aucune recette disponible.');
        }

        return redirect()->route('recipe', ['id' => $id]);
    }
    /**
     * Show the form for creating a new recipe.
     */
    public function create()
    {
        return Inertia::render('Vitrine_recipe_create', [
            'difficultes' => \App\Models\Difficulte::all(),
            'prix' => \App\Models\Prix::all(),
            'types' => \App\Models\RecetteType::all(),
            'aliments' => \App\Models\Aliment::orderBy('nom')->get(),
            'unites' => \App\Models\Unite::all(),
            'ustensiles' => \App\Models\Ustensile::orderBy('nom')->get(),
        ]);
    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'recette_type_id' => 'required|exists:recette_type,id',
            'portions' => 'required|integer|min:1',
            'difficulte_id' => 'required|exists:difficulte,id',
            'prix_id' => 'required|exists:prix,id',
            'temps_preparation' => 'required|integer|min:0',
            'temps_cuisson' => 'required|integer|min:0',
            'temps_repos' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:5120', // Max 5MB
            'ingredients' => 'required|array|min:1',
            'ingredients.*.aliment_id' => 'nullable', // Can be numeric ID or string for new ones
            'ingredients.*.aliment_name' => 'nullable|string|max:255',
            'ingredients.*.quantite' => 'required|numeric|min:0',
            'ingredients.*.unite_id' => 'required|exists:unite,id',
            'etapes' => 'required|array|min:1',
            'etapes.*.description' => 'required|string',
            'etapes.*.numero' => 'required|integer',
            'etapes.*.ingredient_indexes' => 'nullable|array',
            'etapes.*.ustensile_ids' => 'nullable|array'
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            // 1. Create Recipe
            $recette = Recette::create([
                'title' => $validated['title'],
                'portions' => $validated['portions'],
                'is_visible' => true,
                'is_supprimer' => false,
                'users_id' => \Illuminate\Support\Facades\Auth::id(),
                'recette_type_id' => $validated['recette_type_id'],
                'difficulte_id' => $validated['difficulte_id'],
                'prix_id' => $validated['prix_id'],
            ]);

            // 2. Handle Photo Upload if exists
            if ($request->hasFile('photo')) {
                \Illuminate\Support\Facades\Log::info("Photo upload detected: " . $request->file('photo')->getClientOriginalName());
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $targetPath = public_path('storage/recipes');
                
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }

                $file->move($targetPath, $filename);
                \Illuminate\Support\Facades\Log::info("Photo moved to: " . $targetPath . DIRECTORY_SEPARATOR . $filename);

                $photo = \App\Models\Photo::create([
                    'nom_fichier' => $filename,
                    'type' => 'recipe'
                ]);
                \Illuminate\Support\Facades\Log::info("Photo record created with ID: " . $photo->id);

                \App\Models\RecettePhoto::create([
                    'photo_id' => $photo->id,
                    'recette_id' => $recette->id,
                    'position' => 0
                ]);
            } else if ($request->photo) {
                \Illuminate\Support\Facades\Log::warning("Photo present in request but hasFile('photo') is false. Type: " . gettype($request->photo));
            }

            // 3. Create Times
            \App\Models\Temps::create([
                'recette_id' => $recette->id,
                'preparation' => $validated['temps_preparation'],
                'cuisson' => $validated['temps_cuisson'],
                'repos' => $validated['temps_repos']
            ]);

            // 4. Attach Ingredients (store map for step linkages)
            $ingredientMap = []; // Maps form index to DB ID
            foreach ($validated['ingredients'] as $index => $ing) {
                
                $alimentId = $ing['aliment_id'];
                
                // If aliment_id is not numeric, it's a new ingredient name
                if (!is_numeric($alimentId) && !empty($ing['aliment_name'])) {
                    $newAliment = \App\Models\Aliment::create([
                        'nom' => $ing['aliment_name'],
                        'is_certified' => false,
                        'icone' => 'fas fa-question-circle', // Default placeholder
                        'aliment_type_id' => null
                    ]);
                    $alimentId = $newAliment->id;
                }

                $pivot = \App\Models\RecetteIngredient::create([
                    'recette_id' => $recette->id,
                    'aliment_id' => $alimentId,
                    'unite_id' => $ing['unite_id'],
                    'quantite' => $ing['quantite'],
                ]);
                $ingredientMap[$index] = $pivot->id;
            }

            // 5. Attach Steps and linking them to specific utensils/ingredients if provided
            foreach ($validated['etapes'] as $etape) {
                
                $etapeModel = \App\Models\RecetteEtape::create([
                    'recette_id' => $recette->id,
                    'numero' => $etape['numero'],
                    'description' => $etape['description']
                ]);

                // Attach ingredients to step if provided (array of indexes)
                if (isset($etape['ingredient_indexes']) && is_array($etape['ingredient_indexes'])) {
                    $ingredientIdsToAttach = [];
                    foreach ($etape['ingredient_indexes'] as $index) {
                        if (isset($ingredientMap[$index])) {
                            $ingredientIdsToAttach[] = $ingredientMap[$index];
                        }
                    }
                    if (!empty($ingredientIdsToAttach)) {
                        $etapeModel->ingredients()->sync($ingredientIdsToAttach);
                    }
                }

                // Attach utensils to step if provided (array of IDs)
                if (isset($etape['ustensile_ids']) && is_array($etape['ustensile_ids'])) {
                    foreach ($etape['ustensile_ids'] as $ustensileId) {
                        // Ensure utensil is associated with the recipe first
                        \App\Models\RecetteUstensile::firstOrCreate([
                            'recette_id' => $recette->id,
                            'ustensile_id' => $ustensileId
                        ]);
                    }
                    $etapeModel->ustensiles()->sync($etape['ustensile_ids']);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('recipe', ['id' => $recette->id])->with('success', 'Votre recette a été publiée avec succès !');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error("Error saving recipe: " . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement de la recette. ' . $e->getMessage()]);
        }
    }
}
