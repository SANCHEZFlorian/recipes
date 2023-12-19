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
            $table->integer('quantite');
            $table->unsignedBigInteger('recette_id');
            $table->unsignedBigInteger('aliment_id');
            $table->unsignedBigInteger('unite_id');
            $table->unsignedBigInteger('etape_id')->nullable();

            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('aliment_id')->references('id')->on('aliment')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('unite_id')->references('id')->on('unite')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('etape_id')->references('id')->on('etape')->onDelete('restrict')->onUpdate('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('recette_ingredient');
    }
};
