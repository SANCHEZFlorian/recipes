<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Pivot table for Step -> Ingredients
        Schema::create('recette_etape_ingredient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recette_etape_id');
            $table->unsignedBigInteger('recette_ingredient_id');
            
            $table->foreign('recette_etape_id')->references('id')->on('recette_etape')->onDelete('cascade');
            $table->foreign('recette_ingredient_id')->references('id')->on('recette_ingredient')->onDelete('cascade');
        });

        // 2. Pivot table for Step -> Utensils
        Schema::create('recette_etape_ustensile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recette_etape_id');
            $table->unsignedBigInteger('ustensile_id');
            
            $table->foreign('recette_etape_id')->references('id')->on('recette_etape')->onDelete('cascade');
            $table->foreign('ustensile_id')->references('id')->on('ustensile')->onDelete('cascade');
        });

        // 3. Drop old columns from recette_etape
        Schema::table('recette_etape', function (Blueprint $table) {
            // Drop foreign keys first
            if (Schema::hasColumn('recette_etape', 'recette_ingredient_id')) {
                $table->dropForeign(['recette_ingredient_id']);
                $table->dropColumn('recette_ingredient_id');
            }
            if (Schema::hasColumn('recette_etape', 'recette_ustensile_id')) {
                $table->dropForeign(['recette_ustensile_id']);
                $table->dropColumn('recette_ustensile_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recette_etape', function (Blueprint $table) {
            $table->unsignedBigInteger('recette_ingredient_id')->nullable();
            $table->unsignedBigInteger('recette_ustensile_id')->nullable();
            // Re-adding foreign keys would go here but usually down migrations are not always perfect on complex structures
            $table->foreign('recette_ingredient_id')->references('id')->on('recette_ingredient')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('recette_ustensile_id')->references('id')->on('recette_ustensile')->onDelete('cascade');
        });

        Schema::dropIfExists('recette_etape_ustensile');
        Schema::dropIfExists('recette_etape_ingredient');
    }
};
