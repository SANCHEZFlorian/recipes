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
            ->where('is_supprimer', false)
            ->whereNull('groupe_id') // Exclure les recettes privées de groupe
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
            'temps',
            'avis.user'
        ])->where('is_supprimer', false)->findOrFail($id);

        // --- Privacy check for group recipes ---
        if ($recette->groupe_id) {
            $user = \Illuminate\Support\Facades\Auth::user();
            if (!$user) {
                abort(403, 'Cette recette est réservée aux membres du groupe.');
            }
            $groupe = \App\Models\Groupe::with('membres')->find($recette->groupe_id);
            $isOwner = $groupe && $groupe->owner_users_id === $user->id;
            $isMember = $groupe && $groupe->membres->contains($user->id);

            if (!$isOwner && !$isMember && !$user->is_admin) {
                abort(403, 'Cette recette est réservée aux membres du groupe.');
            }
        }

        $isFavorited = \Illuminate\Support\Facades\Auth::check() 
            ? \App\Models\Favoris::where('users_id', \Illuminate\Support\Facades\Auth::id())->where('recette_id', $id)->exists() 
            : false;

        return Inertia::render('Vitrine_recipe', [
            'recipe' => $recette,
            'isFavorited' => $isFavorited
        ]);
    }
    /**
     * Redirect to a random recipe.
     */
    public function random()
    {
        $id = Recette::where('is_supprimer', false)
            ->whereNull('groupe_id') // Exclure les recettes privées de groupe
            ->inRandomOrder()
            ->value('id');

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
        $userId = \Illuminate\Support\Facades\Auth::id();
        
        // Obtenir les groupes gérés par l'utilisateur et ceux rejoints
        $ownedGroups = \App\Models\Groupe::where('owner_users_id', $userId)->get();
        $joinedGroupsId = \App\Models\UserGroupe::where('users_id', $userId)->pluck('groupe_id');
        $joinedGroups = \App\Models\Groupe::whereIn('id', $joinedGroupsId)->get();
        
        $userGroups = $ownedGroups->concat($joinedGroups)->unique('id');

        return Inertia::render('Vitrine_recipe_create', [
            'difficultes' => \App\Models\Difficulte::all(),
            'prix' => \App\Models\Prix::all(),
            'types' => \App\Models\RecetteType::all(),
            'aliments' => \App\Models\Aliment::orderBy('nom')->get(),
            'unites' => \App\Models\Unite::all(),
            'ustensiles' => \App\Models\Ustensile::orderBy('nom')->get(),
            'userGroups' => $userGroups,
            'defaultGroupId' => request()->query('groupe_id') ? (int) request()->query('groupe_id') : null,
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
            'groupe_id' => 'nullable|exists:groupe,id',
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
                'groupe_id' => $request->groupe_id ?? null,
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

    public function edit($id)
    {
        $recette = Recette::with([
            'temps',
            'recetteIngredients.aliment',
            'recetteIngredients.unite',
            'recetteEtapes.ingredients',
            'recetteEtapes.ustensiles',
            'recetteUstensiles',
            'recettePhotos.photo'
        ])->where('is_supprimer', false)->findOrFail($id);

        if ($recette->users_id !== \Illuminate\Support\Facades\Auth::id() && !(optional(\Illuminate\Support\Facades\Auth::user())->is_admin)) {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à modifier cette recette.');
        }

        $userId = \Illuminate\Support\Facades\Auth::id();
        
        $ownedGroups = \App\Models\Groupe::where('owner_users_id', $userId)->get();
        $joinedGroupsId = \App\Models\UserGroupe::where('users_id', $userId)->pluck('groupe_id');
        $joinedGroups = \App\Models\Groupe::whereIn('id', $joinedGroupsId)->get();
        $userGroups = $ownedGroups->concat($joinedGroups)->unique('id');

        return Inertia::render('Vitrine_recipe_edit', [
            'recipe' => $recette,
            'difficultes' => \App\Models\Difficulte::all(),
            'prix' => \App\Models\Prix::all(),
            'types' => \App\Models\RecetteType::all(),
            'aliments' => \App\Models\Aliment::orderBy('nom')->get(),
            'unites' => \App\Models\Unite::all(),
            'ustensiles' => \App\Models\Ustensile::orderBy('nom')->get(),
            'userGroups' => $userGroups,
        ]);
    }

    public function update(Request $request, $id)
    {
        $recette = Recette::findOrFail($id);
        
        if ($recette->users_id !== \Illuminate\Support\Facades\Auth::id() && !(optional(\Illuminate\Support\Facades\Auth::user())->is_admin)) {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à modifier cette recette.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'recette_type_id' => 'required|exists:recette_type,id',
            'portions' => 'required|integer|min:1',
            'difficulte_id' => 'required|exists:difficulte,id',
            'prix_id' => 'required|exists:prix,id',
            'temps_preparation' => 'required|integer|min:0',
            'temps_cuisson' => 'required|integer|min:0',
            'temps_repos' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:5120',
            'groupe_id' => 'nullable|exists:groupe,id',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.aliment_id' => 'nullable',
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
            // 1. Update Recipe
            $recette->update([
                'title' => $validated['title'],
                'portions' => $validated['portions'],
                'groupe_id' => $validated['groupe_id'] ?? null,
                'recette_type_id' => $validated['recette_type_id'],
                'difficulte_id' => $validated['difficulte_id'],
                'prix_id' => $validated['prix_id'],
            ]);

            // 2. Handle Photo Upload
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $targetPath = public_path('storage/recipes');
                
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }

                $file->move($targetPath, $filename);

                $photo = \App\Models\Photo::create([
                    'nom_fichier' => $filename,
                    'type' => 'recipe'
                ]);

                \App\Models\RecettePhoto::where('recette_id', $recette->id)->delete();
                \App\Models\RecettePhoto::create([
                    'photo_id' => $photo->id,
                    'recette_id' => $recette->id,
                    'position' => 0
                ]);
            }

            // 3. Update Times
            if ($recette->temps) {
                $recette->temps->update([
                    'preparation' => $validated['temps_preparation'],
                    'cuisson' => $validated['temps_cuisson'],
                    'repos' => $validated['temps_repos']
                ]);
            } else {
                \App\Models\Temps::create([
                    'recette_id' => $recette->id,
                    'preparation' => $validated['temps_preparation'],
                    'cuisson' => $validated['temps_cuisson'],
                    'repos' => $validated['temps_repos']
                ]);
            }

            // 4. Attach Ingredients
            // Delete old relationships
            \App\Models\RecetteIngredient::where('recette_id', $recette->id)->delete();
            
            $ingredientMap = [];
            foreach ($validated['ingredients'] as $index => $ing) {
                $alimentId = $ing['aliment_id'];
                
                if (!is_numeric($alimentId) && !empty($ing['aliment_name'])) {
                    $newAliment = \App\Models\Aliment::create([
                        'nom' => $ing['aliment_name'],
                        'is_certified' => false,
                        'icone' => 'fas fa-question-circle',
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

            // 5. Attach Steps
            $oldEtapes = \App\Models\RecetteEtape::where('recette_id', $recette->id)->get();
            foreach ($oldEtapes as $old) {
                $old->ingredients()->detach();
                $old->ustensiles()->detach();
                $old->delete();
            }
            \App\Models\RecetteUstensile::where('recette_id', $recette->id)->delete();

            foreach ($validated['etapes'] as $etape) {
                $etapeModel = \App\Models\RecetteEtape::create([
                    'recette_id' => $recette->id,
                    'numero' => $etape['numero'],
                    'description' => $etape['description']
                ]);

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

                if (isset($etape['ustensile_ids']) && is_array($etape['ustensile_ids'])) {
                    foreach ($etape['ustensile_ids'] as $ustensileId) {
                        \App\Models\RecetteUstensile::firstOrCreate([
                            'recette_id' => $recette->id,
                            'ustensile_id' => $ustensileId
                        ]);
                    }
                    $etapeModel->ustensiles()->sync($etape['ustensile_ids']);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('recipe', ['id' => $recette->id])->with('success', 'Votre recette a été modifiée avec succès !');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error("Error updating recipe: " . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la modification de la recette. ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $recette = Recette::findOrFail($id);
        
        if ($recette->users_id !== \Illuminate\Support\Facades\Auth::id() && !(optional(\Illuminate\Support\Facades\Auth::user())->is_admin)) {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette recette.');
        }

        $recette->update(['is_supprimer' => true]);

        return redirect()->route('home')->with('success', 'La recette a été supprimée.');
    }
}
