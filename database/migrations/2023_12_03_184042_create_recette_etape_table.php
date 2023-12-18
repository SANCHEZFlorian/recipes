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
        Schema::create('recette_etape', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('recette_id');
            $table->unsignedBigInteger('type_cuisson_id')->nullable();
            $table->unsignedBigInteger('recette_ingredient_id');
            $table->integer('numero');
            $table->text('description');
            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_cuisson_id')->references('id')->on('type_cuisson')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('recette_ingredient_id')->references('id')->on('recette_ingredient')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette_etape');
    }
};
