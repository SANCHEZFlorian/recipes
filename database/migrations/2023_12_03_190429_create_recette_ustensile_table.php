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
        Schema::create('recette_ustensile', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('ustensile_id')->references('id')->on('ustensile')->onDelete('restrict')->onUpdate('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ustensile_recettes');
    }
};
