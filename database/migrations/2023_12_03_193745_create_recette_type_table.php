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
        Schema::create('recette_type', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nom')->unique();
            $table->unsignedBigInteger('recette_categorie_id');

            $table->foreign('recette_categorie_id')->references('id')->on('recette_categorie')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette_type');
    }
};
