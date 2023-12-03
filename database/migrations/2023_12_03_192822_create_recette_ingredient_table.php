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
        Schema::disableForeignKeyConstraints();
        Schema::create('recette_ingredient', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('quantite');
            $table->foreign('liste_ingredient_id')->references('id')->on('liste_ingredient')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('dosage_id')->references('id')->on('dosage')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('etape_id')->references('id')->on('etape')->onDelete('restrict')->onUpdate('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette_ingredients');
    }
};
