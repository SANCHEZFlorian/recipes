<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Recette;
use App\Models\RecetteType;
use App\Models\RecetteCategorie;
use App\Models\Prix;
use App\Models\Difficulte;
use App\Models\Aliment;
use App\Models\Unite;
use App\Models\RecetteIngredient;
use App\Models\RecetteEtape;
use App\Models\User;
use App\Models\Ustensile;
use App\Models\Temps;

class BulkRecipeSeeder extends Seeder
{
    public function run()
    {
        $users = User::pluck('id')->toArray();
        $types = RecetteType::pluck('id')->toArray();
        $prices = Prix::pluck('id')->toArray();
        $difficulties = Difficulte::pluck('id')->toArray();
        $aliments = Aliment::pluck('id')->toArray();
        $units = Unite::pluck('id')->toArray();

        $adjectives = ['Gourmand', 'Express', 'Traditionnel', 'Maison', 'du Chef', 'Léger', 'Epicé', 'Savoureux', 'Croquant', 'Fondant'];
        $bases = ['Poulet', 'Pâtes', 'Riz', 'Poisson', 'Légumes', 'Boeuf', 'Tofu', 'Crevettes', 'Pommes de terre', 'Salade'];
        $styles = ['à la provençale', 'façon asiatique', 'au curry', 'au four', 'en sauce', 'grillé', 'mijoté', 'vapeur'];

        $utensils = Ustensile::pluck('id')->toArray();

        for ($i = 1; $i <= 55; $i++) {
            $title = $bases[array_rand($bases)] . ' ' . $adjectives[array_rand($adjectives)] . ' ' . $styles[array_rand($styles)];
            
            $recette = Recette::create([
                'title' => $title,
                'is_visible' => 1,
                'is_supprimer' => 0,
                'users_id' => $users[array_rand($users)],
                'recette_type_id' => $types[array_rand($types)],
                'prix_id' => $prices[array_rand($prices)],
                'difficulte_id' => $difficulties[array_rand($difficulties)],
                'portions' => rand(1, 6),
            ]);

            Temps::create([
                'recette_id' => $recette->id,
                'preparation' => rand(5, 60),
                'cuisson' => rand(0, 120),
                'repos' => rand(0, 60),
            ]);

            // Add 3 to 8 random ingredients (but not more than available aliments)
            $countAliments = count($aliments);
            $numIngredients = min(rand(3, 8), $countAliments);
            $selectedAliments = (array)array_rand(array_flip($aliments), $numIngredients);
            $recipeIngredientIds = [];
            foreach ($selectedAliments as $alimentId) {
                $ri = RecetteIngredient::create([
                    'recette_id' => $recette->id,
                    'aliment_id' => $alimentId,
                    'unite_id' => $units[array_rand($units)],
                    'quantite' => rand(1, 500),
                ]);
                $recipeIngredientIds[] = $ri->id;
            }

            // Pick 1-3 utensils for the recipe
            $recipeUtensilIds = (array)array_rand(array_flip($utensils), min(rand(1, 3), count($utensils)));

            // Add 3 to 12 steps
            $numSteps = rand(3, 12);
            for ($s = 1; $s <= $numSteps; $s++) {
                $descriptions = [
                    'Préparer les ingrédients et les laver soigneusement.',
                    'Faire chauffer le récipient à feu moyen.',
                    'Ajouter les éléments principaux et mélanger doucement.',
                    'Laisser cuire pendant quelques minutes en surveillant.',
                    'Assaisonner avec du sel, du poivre et des herbes.',
                    'Dresser l\'assiette avec soin pour le service.',
                    'Incorporer les épices pour plus de saveur.',
                    'Couper finement pour une meilleure texture.',
                    'Vérifier la cuisson à l\'aide d\'une pointe de couteau.',
                    'Servir chaud immédiatement avec un accompagnement.',
                    'Laisser reposer avant de déguster.',
                    'Mélanger énergiquement pour obtenir une sauce homogène.'
                ];
                $etape = RecetteEtape::create([
                    'recette_id' => $recette->id,
                    'description' => $descriptions[array_rand($descriptions)],
                    'numero' => $s,
                ]);

                // Link 1-2 random ingredients from the recipe to this step
                $stepIngs = (array)array_rand(array_flip($recipeIngredientIds), min(rand(1, 2), count($recipeIngredientIds)));
                foreach ($stepIngs as $riId) {
                    DB::table('recette_etape_ingredient')->insert([
                        'recette_etape_id' => $etape->id,
                        'recette_ingredient_id' => $riId
                    ]);
                }

                // Link 1 random utensil from the recipe to this step (50% chance)
                if (rand(0, 1) && !empty($recipeUtensilIds)) {
                    $uId = $recipeUtensilIds[array_rand($recipeUtensilIds)];
                    DB::table('recette_etape_ustensile')->insert([
                        'recette_etape_id' => $etape->id,
                        'ustensile_id' => $uId
                    ]);
                }
            }
        }
    }
}
