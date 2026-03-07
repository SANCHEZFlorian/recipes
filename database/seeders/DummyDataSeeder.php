<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Recette;
use App\Models\RecetteType;
use App\Models\RecetteCategorie;
use App\Models\Prix;
use App\Models\Difficulte;
use App\Models\Aliment;
use App\Models\AlimentType;
use App\Models\Unite;
use App\Models\RecetteIngredient;
use App\Models\RecetteEtape;
use App\Models\User;
use App\Models\Groupe;
use App\Models\Ustensile;
use App\Models\Temps;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('recette_etape')->truncate();
        DB::table('recette_ingredient')->truncate();
        DB::table('recette_photo')->truncate();
        DB::table('recette_ustensile')->truncate();
        DB::table('recette')->truncate();
        DB::table('recette_type')->truncate();
        DB::table('recette_categorie')->truncate();
        DB::table('aliment')->truncate();
        DB::table('aliment_type')->truncate();
        DB::table('unite')->truncate();
        DB::table('prix')->truncate();
        DB::table('difficulte')->truncate();
        DB::table('ustensile')->truncate();
        DB::table('user_groupe')->truncate();
        DB::table('groupe')->truncate();
        
        // Don't truncate users entirely to keep the admin created in DatabaseSeeder
        User::where('email', '!=', 'admin@argon.com')->delete();

        Schema::enableForeignKeyConstraints();

        // 1. Users
        $chef = User::create([
            'username' => 'ChefMarco',
            'firstname' => 'Marco',
            'lastname' => 'Rossi',
            'email' => 'marco@chef.it',
            'password' => Hash::make('secret'),
            'is_admin' => 0,
        ]);

        $student = User::create([
            'username' => 'JuLaDebrouille',
            'firstname' => 'Julie',
            'lastname' => 'Martin',
            'email' => 'julie@student.fr',
            'password' => Hash::make('secret'),
            'is_admin' => 0,
        ]);

        $healthy = User::create([
            'username' => 'GreenLife',
            'firstname' => 'Sarah',
            'lastname' => 'Vignon',
            'email' => 'sarah@health.com',
            'password' => Hash::make('secret'),
            'is_admin' => 0,
        ]);

        // 2. Groups
        $grpPasta = Groupe::create(['nom' => 'Les Passionnés de Pâtes', 'owner_users_id' => $chef->id]);
        $grpLowCost = Groupe::create(['nom' => 'Cuisine Étudiante & Pas Chère', 'owner_users_id' => $student->id]);
        $grpHealthy = Groupe::create(['nom' => 'Healthy & Vegan Squad', 'owner_users_id' => $healthy->id]);

        // Mock group memberships
        DB::table('user_groupe')->insert([
            ['users_id' => $student->id, 'groupe_id' => $grpPasta->id],
            ['users_id' => $healthy->id, 'groupe_id' => $grpHealthy->id],
            ['users_id' => $chef->id, 'groupe_id' => $grpHealthy->id],
        ]);

        // 3. Metadata
        $prixCheap = Prix::create(['nom' => 'Pas cher', 'icone' => '€']);
        $prixMid = Prix::create(['nom' => 'Moyen', 'icone' => '€€']);
        $prixExpensive = Prix::create(['nom' => 'Élevé', 'icone' => '€€€']);

        $diffEasy = Difficulte::create(['nom' => 'Facile', 'icone' => 'fi fi-rr-star']);
        $diffMed = Difficulte::create(['nom' => 'Moyen', 'icone' => 'fi fi-rr-star-half-stroke']);
        $diffHard = Difficulte::create(['nom' => 'Expérimenté', 'icone' => 'fi fi-rr-star']);

        // --- Catégories ---
        $catEntree = RecetteCategorie::create(['nom' => 'Entrée', 'icone' => 'fi fi-rr-leaf']);
        $catPlat = RecetteCategorie::create(['nom' => 'Plat', 'icone' => 'fi fi-rr-utensils']);
        $catDessert = RecetteCategorie::create(['nom' => 'Dessert', 'icone' => 'fi fi-rr-cupcake']);
        $catBoisson = RecetteCategorie::create(['nom' => 'Boisson', 'icone' => 'fi fi-rr-drink-alt']);
        $catHiver = RecetteCategorie::create(['nom' => 'Plat d\'hiver', 'icone' => 'fi fi-rr-snowflake']);
        $catEte = RecetteCategorie::create(['nom' => 'Plat d\'été', 'icone' => 'fi fi-rr-sun']);
        $catRegion = RecetteCategorie::create(['nom' => 'Régionale', 'icone' => 'fi fi-rr-map-marker']);

        // --- Types de Recettes ---
        // Sous Entrée
        $typeAperitif = RecetteType::create(['nom' => 'Apéritif', 'icone' => 'fi fi-rr-cocktail', 'recette_categorie_id' => $catEntree->id]);
        $typeEntree = RecetteType::create(['nom' => 'Entrée', 'icone' => 'fi fi-rr-salad', 'recette_categorie_id' => $catEntree->id]);
        $typeSalade = RecetteType::create(['nom' => 'Salade', 'icone' => 'fi fi-rr-salad', 'recette_categorie_id' => $catEntree->id]);
        $typeSoupe = RecetteType::create(['nom' => 'Soupe', 'icone' => 'fi fi-rr-bowl-hot', 'recette_categorie_id' => $catEntree->id]);
        
        // Sous Plat
        $typePlat = RecetteType::create(['nom' => 'Plat principal', 'icone' => 'fi fi-rr-restaurant', 'recette_categorie_id' => $catPlat->id]);
        $typeAccompagnement = RecetteType::create(['nom' => 'Accompagnement', 'icone' => 'fi fi-rr-french-fries', 'recette_categorie_id' => $catPlat->id]);
        $typeViande = RecetteType::create(['nom' => 'Viande', 'icone' => 'fi fi-rr-meat', 'recette_categorie_id' => $catPlat->id]);
        $typeGratin = RecetteType::create(['nom' => 'Gratin', 'icone' => 'fi fi-rr-pan', 'recette_categorie_id' => $catPlat->id]);
        $typeChaud = RecetteType::create(['nom' => 'Plat chaud', 'icone' => 'fi fi-rr-flame', 'recette_categorie_id' => $catPlat->id]);
        $typeFroid = RecetteType::create(['nom' => 'Plat froid', 'icone' => 'fi fi-rr-snowflake', 'recette_categorie_id' => $catPlat->id]);
        $typeSauce = RecetteType::create(['nom' => 'Sauce', 'icone' => 'fi fi-rr-sauce', 'recette_categorie_id' => $catPlat->id]);
        $typeDiner = RecetteType::create(['nom' => 'Dîner', 'icone' => 'fi fi-rr-moon-stars', 'recette_categorie_id' => $catPlat->id]);

        // Sous Dessert
        $typeDessert = RecetteType::create(['nom' => 'Dessert', 'icone' => 'fi fi-rr-ice-cream', 'recette_categorie_id' => $catDessert->id]);
        $typeGateau = RecetteType::create(['nom' => 'Gâteau', 'icone' => 'fi fi-rr-cake-birthday', 'recette_categorie_id' => $catDessert->id]);
        $typeGouter = RecetteType::create(['nom' => 'Goûter', 'icone' => 'fi fi-rr-cookie', 'recette_categorie_id' => $catDessert->id]);

        // Sous Boisson
        $typeBoissonChaude = RecetteType::create(['nom' => 'Boisson chaude', 'icone' => 'fi fi-rr-mug-hot', 'recette_categorie_id' => $catBoisson->id]);
        $typeBoissonFroide = RecetteType::create(['nom' => 'Boisson froide', 'icone' => 'fi fi-rr-glass', 'recette_categorie_id' => $catBoisson->id]);
        $typeAlcool = RecetteType::create(['nom' => 'Alcool', 'icone' => 'fi fi-rr-glass-cheers', 'recette_categorie_id' => $catBoisson->id]);
        
        // Autres
        $typeFacile = RecetteType::create(['nom' => 'Facile à faire', 'icone' => 'fi fi-rr-time-fast', 'recette_categorie_id' => $catPlat->id]);

        // --- Unités (Mesures Culinaires) ---
        $unitG = Unite::create(['nom' => 'Gramme', 'abreviation' => 'g', 'icone' => 'fi fi-rr-scale-balanced']);
        $unitKg = Unite::create(['nom' => 'Kilogramme', 'abreviation' => 'kg', 'icone' => 'fi fi-rr-weight']);
        $unitML = Unite::create(['nom' => 'Millilitre', 'abreviation' => 'ml', 'icone' => 'fi fi-rr-fill-drip']);
        $unitCL = Unite::create(['nom' => 'Centilitre', 'abreviation' => 'cl', 'icone' => 'fi fi-rr-glass-water']);
        $unitLitre = Unite::create(['nom' => 'Litre', 'abreviation' => 'L', 'icone' => 'fi fi-rr-jug']);
        $unitUnit = Unite::create(['nom' => 'Unité', 'abreviation' => 'u', 'icone' => 'fi fi-rr-box-open']);
        $unitCas = Unite::create(['nom' => 'Cuillère à soupe', 'abreviation' => 'CàS', 'icone' => 'fi fi-rr-utensil-spoon']);
        $unitCac = Unite::create(['nom' => 'Cuillère à café', 'abreviation' => 'CàC', 'icone' => 'fi fi-rr-spoon']);
        $unitPincee = Unite::create(['nom' => 'Pincée', 'abreviation' => 'pincée', 'icone' => 'fi fi-rr-hand-holding-seedling']);

        // --- Types d'Aliments ---
        $atFrais = AlimentType::create(['nom' => 'Produits Frais', 'icone' => 'fi fi-rr-cloud-sun']);
        $atEpicerie = AlimentType::create(['nom' => 'Épicerie', 'icone' => 'fi fi-rr-shop']);
        $atViande = AlimentType::create(['nom' => 'Viandes & Poissons', 'icone' => 'fi fi-rr-steak']);
        $atLegumes = AlimentType::create(['nom' => 'Fruits & Légumes', 'icone' => 'fi fi-rr-apple-whole']);
        $atLaitier = AlimentType::create(['nom' => 'Produits Laitiers', 'icone' => 'fi fi-rr-cheese']);
        $atCondiment = AlimentType::create(['nom' => 'Condiments & Épices', 'icone' => 'fi fi-rr-salt-pepper']);

        // --- Ustensiles ---
        $ustPoelle = Ustensile::create(['nom' => 'Poêle', 'icone' => 'fi fi-rr-pan-fry']);
        $ustCasserole = Ustensile::create(['nom' => 'Casserole', 'icone' => 'fi fi-rr-pot']);
        $ustSaladier = Ustensile::create(['nom' => 'Saladier', 'icone' => 'fi fi-rr-bowl-soft-serve']);

        // 4. Aliments
        $boeuf = Aliment::create(['nom' => 'Boeuf haché', 'icone' => 'fi fi-rr-meat', 'aliment_type_id' => $atViande->id, 'is_certified' => true]);
        $oignon = Aliment::create(['nom' => 'Oignon', 'icone' => 'fi fi-rr-carrot', 'aliment_type_id' => $atLegumes->id, 'is_certified' => true]);
        $riz = Aliment::create(['nom' => 'Riz Basmati', 'icone' => 'fi fi-rr-wheat', 'aliment_type_id' => $atEpicerie->id, 'is_certified' => true]);
        $chocolat = Aliment::create(['nom' => 'Chocolat Noir', 'icone' => 'fi fi-rr-cookie', 'aliment_type_id' => $atEpicerie->id, 'is_certified' => true]);
        $beurre = Aliment::create(['nom' => 'Beurre', 'icone' => 'fi fi-rr-cheese', 'aliment_type_id' => $atLaitier->id, 'is_certified' => true]);
        $saumon = Aliment::create(['nom' => 'Pavé de Saumon', 'icone' => 'fi fi-rr-fish', 'aliment_type_id' => $atViande->id, 'is_certified' => true]);
        $avocat = Aliment::create(['nom' => 'Avocat', 'icone' => 'fi fi-rr-leaf', 'aliment_type_id' => $atLegumes->id, 'is_certified' => true]);
        $rChili = Recette::create([
            'title' => 'Chili con Carne Express',
            'is_visible' => 1,
            'is_supprimer' => 0,
            'users_id' => $student->id,
            'recette_type_id' => $typePlat->id,
            'prix_id' => $prixCheap->id,
            'difficulte_id' => $diffEasy->id,
            'portions' => 4,
        ]);
        Temps::create(['recette_id' => $rChili->id, 'preparation' => 10, 'cuisson' => 20]);
        $ingChiliBoeuf = RecetteIngredient::create(['recette_id' => $rChili->id, 'aliment_id' => $boeuf->id, 'unite_id' => $unitG->id, 'quantite' => 500]);
        $ingChiliOignon = RecetteIngredient::create(['recette_id' => $rChili->id, 'aliment_id' => $oignon->id, 'unite_id' => $unitUnit->id, 'quantite' => 1]);
        
        $etapeChili1 = RecetteEtape::create(['recette_id' => $rChili->id, 'description' => 'Émincer l\'oignon et le faire revenir dans une poêle.', 'numero' => 1]);
        DB::table('recette_etape_ingredient')->insert(['recette_etape_id' => $etapeChili1->id, 'recette_ingredient_id' => $ingChiliOignon->id]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeChili1->id, 'ustensile_id' => $ustPoelle->id]);

        $etapeChili2 = RecetteEtape::create(['recette_id' => $rChili->id, 'description' => 'Ajouter la viande hachée et laisser dorer.', 'numero' => 2]);
        DB::table('recette_etape_ingredient')->insert(['recette_etape_id' => $etapeChili2->id, 'recette_ingredient_id' => $ingChiliBoeuf->id]);

        // --- RECETTE 2: Risotto aux Champignons (Chef Marco) ---
        $rRisotto = Recette::create([
            'title' => 'Risotto Crémeux aux Champignons',
            'is_visible' => 1,
            'is_supprimer' => 0,
            'users_id' => $chef->id,
            'recette_type_id' => $typePlat->id,
            'prix_id' => $prixMid->id,
            'difficulte_id' => $diffHard->id,
            'portions' => 2,
        ]);
        Temps::create(['recette_id' => $rRisotto->id, 'preparation' => 15, 'cuisson' => 25]);
        $ingRisottoRiz = RecetteIngredient::create(['recette_id' => $rRisotto->id, 'aliment_id' => $riz->id, 'unite_id' => $unitG->id, 'quantite' => 200]);
        $ingRisottoBeurre = RecetteIngredient::create(['recette_id' => $rRisotto->id, 'aliment_id' => $beurre->id, 'unite_id' => $unitG->id, 'quantite' => 30]);
        
        $etapeRisotto1 = RecetteEtape::create(['recette_id' => $rRisotto->id, 'description' => 'Nacrer le riz dans un peu de beurre.', 'numero' => 1]);
        DB::table('recette_etape_ingredient')->insert([
            ['recette_etape_id' => $etapeRisotto1->id, 'recette_ingredient_id' => $ingRisottoRiz->id],
            ['recette_etape_id' => $etapeRisotto1->id, 'recette_ingredient_id' => $ingRisottoBeurre->id],
        ]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeRisotto1->id, 'ustensile_id' => $ustCasserole->id]);

        $etapeRisotto2 = RecetteEtape::create(['recette_id' => $rRisotto->id, 'description' => 'Ajouter le bouillon louche après louche en remuant constamment.', 'numero' => 2]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeRisotto2->id, 'ustensile_id' => $ustCasserole->id]);

        // --- RECETTE 3: Poké Bowl Fraîcheur (Sarah GreenLife) ---
        $rPoke = Recette::create([
            'title' => 'Poké Bowl Saumon & Avocat',
            'is_visible' => 1,
            'is_supprimer' => 0,
            'users_id' => $healthy->id,
            'recette_type_id' => $typeSalade->id,
            'prix_id' => $prixExpensive->id,
            'difficulte_id' => $diffMed->id,
            'portions' => 1,
        ]);
        Temps::create(['recette_id' => $rPoke->id, 'preparation' => 20, 'cuisson' => 0]);
        $ingPokeSaumon = RecetteIngredient::create(['recette_id' => $rPoke->id, 'aliment_id' => $saumon->id, 'unite_id' => $unitG->id, 'quantite' => 120]);
        $ingPokeAvocat = RecetteIngredient::create(['recette_id' => $rPoke->id, 'aliment_id' => $avocat->id, 'unite_id' => $unitUnit->id, 'quantite' => 1]);
        
        $etapePoke1 = RecetteEtape::create(['recette_id' => $rPoke->id, 'description' => 'Couper le saumon en dés et l\'avocat en tranches.', 'numero' => 1]);
        DB::table('recette_etape_ingredient')->insert([
            ['recette_etape_id' => $etapePoke1->id, 'recette_ingredient_id' => $ingPokeSaumon->id],
            ['recette_etape_id' => $etapePoke1->id, 'recette_ingredient_id' => $ingPokeAvocat->id],
        ]);

        $etapePoke2 = RecetteEtape::create(['recette_id' => $rPoke->id, 'description' => 'Dresser joliment dans un saladier avec une base de riz froid.', 'numero' => 2]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapePoke2->id, 'ustensile_id' => $ustSaladier->id]);

        // --- RECETTE 4: Fondant au Chocolat ---
        $rFondant = Recette::create([
            'title' => 'Fondant au Chocolat Coeur Coulant',
            'is_visible' => 1,
            'is_supprimer' => 0,
            'users_id' => $chef->id,
            'recette_type_id' => $typeDessert->id,
            'prix_id' => $prixCheap->id,
            'difficulte_id' => $diffMed->id,
            'portions' => 6,
        ]);
        Temps::create(['recette_id' => $rFondant->id, 'preparation' => 15, 'cuisson' => 10]);
        $ingFondantChoco = RecetteIngredient::create(['recette_id' => $rFondant->id, 'aliment_id' => $chocolat->id, 'unite_id' => $unitG->id, 'quantite' => 200]);
        $ingFondantBeurre = RecetteIngredient::create(['recette_id' => $rFondant->id, 'aliment_id' => $beurre->id, 'unite_id' => $unitG->id, 'quantite' => 100]);
        
        $etapeFondant1 = RecetteEtape::create(['recette_id' => $rFondant->id, 'description' => 'Faire fondre le chocolat avec le beurre au bain-marie.', 'numero' => 1]);
        DB::table('recette_etape_ingredient')->insert([
            ['recette_etape_id' => $etapeFondant1->id, 'recette_ingredient_id' => $ingFondantChoco->id],
            ['recette_etape_id' => $etapeFondant1->id, 'recette_ingredient_id' => $ingFondantBeurre->id],
        ]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeFondant1->id, 'ustensile_id' => $ustCasserole->id]);

        $etapeFondant2 = RecetteEtape::create(['recette_id' => $rFondant->id, 'description' => 'Enfourner à 200°C pendant exactement 10 minutes.', 'numero' => 2]);

        // --- RECETTE 5: Ramen Tonkotsu Maison (Chef Marco) ---
        $rRamen = Recette::create([
            'title' => 'Ramen Tonkotsu Traditionnel',
            'is_visible' => 1,
            'is_supprimer' => 0,
            'users_id' => $chef->id,
            'recette_type_id' => $typePlat->id,
            'prix_id' => $prixMid->id,
            'difficulte_id' => $diffHard->id,
            'portions' => 2,
        ]);
        Temps::create(['recette_id' => $rRamen->id, 'preparation' => 45, 'cuisson' => 600, 'repos' => 60]);
        $ingRamenRiz = RecetteIngredient::create(['recette_id' => $rRamen->id, 'aliment_id' => $riz->id, 'unite_id' => $unitG->id, 'quantite' => 150]);
        
        $etapeRamen1 = RecetteEtape::create(['recette_id' => $rRamen->id, 'description' => 'Préparer le bouillon d\'os crémeux pendant 10 heures.', 'numero' => 1]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeRamen1->id, 'ustensile_id' => $ustCasserole->id]);

        $etapeRamen2 = RecetteEtape::create(['recette_id' => $rRamen->id, 'description' => 'Cuire les nouilles ramen al dente.', 'numero' => 2]);
        DB::table('recette_etape_ingredient')->insert(['recette_etape_id' => $etapeRamen2->id, 'recette_ingredient_id' => $ingRamenRiz->id]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeRamen2->id, 'ustensile_id' => $ustCasserole->id]);

        // --- RECETTE 6: Saumon Grillé aux Herbes (Sarah GreenLife) ---
        $rSaumon = Recette::create([
            'title' => 'Saumon Grillé & Légumes Vapeur',
            'is_visible' => 1,
            'is_supprimer' => 0,
            'users_id' => $healthy->id,
            'recette_type_id' => $typePlat->id,
            'prix_id' => $prixExpensive->id,
            'difficulte_id' => $diffEasy->id,
            'portions' => 2,
        ]);
        Temps::create(['recette_id' => $rSaumon->id, 'preparation' => 10, 'cuisson' => 15]);
        $ingSaumonFilet = RecetteIngredient::create(['recette_id' => $rSaumon->id, 'aliment_id' => $saumon->id, 'unite_id' => $unitUnit->id, 'quantite' => 2]);
        
        $etapeSaumon1 = RecetteEtape::create(['recette_id' => $rSaumon->id, 'description' => 'Assaisonner le saumon avec du citron et des herbes.', 'numero' => 1]);
        DB::table('recette_etape_ingredient')->insert(['recette_etape_id' => $etapeSaumon1->id, 'recette_ingredient_id' => $ingSaumonFilet->id]);

        $etapeSaumon2 = RecetteEtape::create(['recette_id' => $rSaumon->id, 'description' => 'Saisir à la poêle côté peau en premier.', 'numero' => 2]);
        DB::table('recette_etape_ustensile')->insert(['recette_etape_id' => $etapeSaumon2->id, 'ustensile_id' => $ustPoelle->id]);
    }
}
