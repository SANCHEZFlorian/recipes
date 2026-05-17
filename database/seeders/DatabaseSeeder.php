<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RecetteCategorie;
use App\Models\Prix;
use App\Models\Difficulte;
use App\Models\Unite;
use App\Models\Ustensile;
use App\Models\Aliment;
use App\Models\AlimentType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // Truncate all tables to perform a clean start
        DB::table('recette_etape_ingredient')->truncate();
        DB::table('recette_etape_ustensile')->truncate();
        DB::table('recette_etape')->truncate();
        DB::table('recette_ingredient')->truncate();
        DB::table('recette_photo')->truncate();
        DB::table('recette_ustensile')->truncate();
        DB::table('recette_recette_categorie')->truncate();
        DB::table('recette')->truncate();
        DB::table('recette_categorie')->truncate();
        DB::table('aliment')->truncate();
        DB::table('aliment_type')->truncate();
        DB::table('unite')->truncate();
        DB::table('prix')->truncate();
        DB::table('difficulte')->truncate();
        DB::table('ustensile')->truncate();
        DB::table('user_groupe')->truncate();
        DB::table('groupe')->truncate();
        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        // 1. Create the requested Admin User
        User::create([
            'username' => 'ridley17',
            'firstname' => 'Ridley',
            'lastname' => 'Admin',
            'email' => 'ridley17@hotmail.fr',
            'password' => Hash::make('admin'),
            'is_admin' => 1,
            'city' => 'Paris',
            'country' => 'France',
            'postal' => '75000',
            'about' => 'Administrateur de la plateforme de recettes.',
        ]);

        // 2. Default Categories
        $categories = [
            ['nom' => 'Entrée', 'icone' => 'fi fi-rr-leaf'],
            ['nom' => 'Plat', 'icone' => 'fi fi-rr-utensils'],
            ['nom' => 'Dessert', 'icone' => 'fi fi-rr-cupcake'],
            ['nom' => 'Boisson', 'icone' => 'fi fi-rr-drink-alt'],
            ['nom' => 'Plat d\'hiver', 'icone' => 'fi fi-rr-snowflake'],
            ['nom' => 'Plat d\'été', 'icone' => 'fi fi-rr-sun'],
            ['nom' => 'Régionale', 'icone' => 'fi fi-rr-map-marker'],
        ];
        foreach ($categories as $cat) {
            RecetteCategorie::create($cat);
        }

        // 3. Default Prices (Budgets)
        $prices = [
            ['nom' => 'Pas cher', 'icone' => '€'],
            ['nom' => 'Moyen', 'icone' => '€€'],
            ['nom' => 'Élevé', 'icone' => '€€€'],
        ];
        foreach ($prices as $p) {
            Prix::create($p);
        }

        // 4. Default Difficulties
        $difficulties = [
            ['nom' => 'Facile', 'icone' => 'fi fi-rr-star'],
            ['nom' => 'Moyen', 'icone' => 'fi fi-rr-star-half-stroke'],
            ['nom' => 'Expérimenté', 'icone' => 'fi fi-rr-star'],
        ];
        foreach ($difficulties as $d) {
            Difficulte::create($d);
        }

        // 5. Default Units (Mesures)
        $units = [
            ['nom' => 'Gramme', 'abreviation' => 'g', 'icone' => 'fi fi-rr-scale'],
            ['nom' => 'Kilogramme', 'abreviation' => 'kg', 'icone' => 'fi fi-rr-sack'],
            ['nom' => 'Millilitre', 'abreviation' => 'ml', 'icone' => 'fi fi-rr-bottle-droplet'],
            ['nom' => 'Centilitre', 'abreviation' => 'cl', 'icone' => 'fi fi-rr-glass'],
            ['nom' => 'Litre', 'abreviation' => 'L', 'icone' => 'fi fi-rr-jug'],
            ['nom' => 'Unité', 'abreviation' => 'u', 'icone' => 'fi fi-rr-box-open'],
            ['nom' => 'Cuillère à soupe', 'abreviation' => 'CàS', 'icone' => 'fi fi-rr-spoon'],
            ['nom' => 'Cuillère à café', 'abreviation' => 'CàC', 'icone' => 'fi fi-rr-bowl-spoon'],
            ['nom' => 'Pincée', 'abreviation' => 'pincée', 'icone' => 'fi fi-rr-leaf'],
        ];
        foreach ($units as $u) {
            Unite::create($u);
        }

        // 6. Default Utensils
        $utensils = [
            ['nom' => 'Poêle', 'icone' => 'fi fi-rr-pan-fry'],
            ['nom' => 'Casserole', 'icone' => 'fi fi-rr-pot'],
            ['nom' => 'Saladier', 'icone' => 'fi fi-rr-bowl-soft-serve'],
            ['nom' => 'Fouet', 'icone' => 'fi fi-rr-blender'],
            ['nom' => 'Four', 'icone' => 'fi fi-rr-oven'],
            ['nom' => 'Plat à four', 'icone' => 'fi fi-rr-pan'],
            ['nom' => 'Passoire', 'icone' => 'fi fi-rr-filter'],
            ['nom' => 'Mixeur', 'icone' => 'fi fi-rr-blender'],
            ['nom' => 'Couteau de chef', 'icone' => 'fi fi-rr-utensils'],
        ];
        foreach ($utensils as $ut) {
            Ustensile::create($ut);
        }

        // 7. Default Ingredient Types
        $atFrais = AlimentType::create(['nom' => 'Produits Frais', 'icone' => 'fi fi-rr-cloud-sun']);
        $atEpicerie = AlimentType::create(['nom' => 'Épicerie', 'icone' => 'fi fi-rr-shop']);
        $atViande = AlimentType::create(['nom' => 'Viandes & Poissons', 'icone' => 'fi fi-rr-steak']);
        $atLegumes = AlimentType::create(['nom' => 'Fruits & Légumes', 'icone' => 'fi fi-rr-apple-whole']);
        $atLaitier = AlimentType::create(['nom' => 'Produits Laitiers', 'icone' => 'fi fi-rr-cheese']);
        $atCondiment = AlimentType::create(['nom' => 'Condiments & Épices', 'icone' => 'fi fi-rr-salt-pepper']);

        // 8. Default Ingredients
        $ingredients = [
            ['nom' => 'Boeuf haché', 'icone' => 'fi fi-rr-meat', 'aliment_type_id' => $atViande->id],
            ['nom' => 'Blanc de poulet', 'icone' => 'fi fi-rr-meat', 'aliment_type_id' => $atViande->id],
            ['nom' => 'Pavé de saumon', 'icone' => 'fi fi-rr-fish', 'aliment_type_id' => $atViande->id],
            ['nom' => 'Oignon', 'icone' => 'fi fi-rr-carrot', 'aliment_type_id' => $atLegumes->id],
            ['nom' => 'Ail', 'icone' => 'fi fi-rr-carrot', 'aliment_type_id' => $atLegumes->id],
            ['nom' => 'Pomme de terre', 'icone' => 'fi fi-rr-carrot', 'aliment_type_id' => $atLegumes->id],
            ['nom' => 'Avocat', 'icone' => 'fi fi-rr-leaf', 'aliment_type_id' => $atLegumes->id],
            ['nom' => 'Tomate', 'icone' => 'fi fi-rr-apple-whole', 'aliment_type_id' => $atLegumes->id],
            ['nom' => 'Riz Basmati', 'icone' => 'fi fi-rr-wheat', 'aliment_type_id' => $atEpicerie->id],
            ['nom' => 'Pâtes', 'icone' => 'fi fi-rr-wheat', 'aliment_type_id' => $atEpicerie->id],
            ['nom' => 'Farine', 'icone' => 'fi fi-rr-wheat', 'aliment_type_id' => $atEpicerie->id],
            ['nom' => 'Sucre', 'icone' => 'fi fi-rr-cookie', 'aliment_type_id' => $atEpicerie->id],
            ['nom' => 'Chocolat Noir', 'icone' => 'fi fi-rr-cookie', 'aliment_type_id' => $atEpicerie->id],
            ['nom' => 'Beurre', 'icone' => 'fi fi-rr-cheese', 'aliment_type_id' => $atLaitier->id],
            ['nom' => 'Lait', 'icone' => 'fi fi-rr-cheese', 'aliment_type_id' => $atLaitier->id],
            ['nom' => 'Crème fraîche', 'icone' => 'fi fi-rr-cheese', 'aliment_type_id' => $atLaitier->id],
            ['nom' => 'Oeuf', 'icone' => 'fi fi-rr-cloud-sun', 'aliment_type_id' => $atFrais->id],
            ['nom' => 'Sel', 'icone' => 'fi fi-rr-salt-pepper', 'aliment_type_id' => $atCondiment->id],
            ['nom' => 'Poivre', 'icone' => 'fi fi-rr-salt-pepper', 'aliment_type_id' => $atCondiment->id],
            ['nom' => 'Huile d\'olive', 'icone' => 'fi fi-rr-sauce', 'aliment_type_id' => $atCondiment->id],
        ];
        foreach ($ingredients as $ing) {
            $ing['is_certified'] = true;
            Aliment::create($ing);
        }
    }
}
