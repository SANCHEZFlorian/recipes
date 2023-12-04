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
        Schema::create('recette', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_recette_id')->references('id')->on('type_recette')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('categorie_recette_id')->references('id')->on('categorie_recette')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_cuisson_id')->references('id')->on('type_cuisson')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('prix_id')->references('id')->on('prix')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('difficulte_id')->references('id')->on('difficulte')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('groupe_id')->references('id')->on('groupe')->onDelete('restrict')->onUpdate('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette');
    }
};
