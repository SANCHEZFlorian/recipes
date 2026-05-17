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

        Schema::table('recette', function (Blueprint $table) {
            // Drop foreign key if it exists
            $table->dropForeign(['recette_type_id']);
            $table->dropColumn('recette_type_id');
        });

        Schema::create('recette_recette_categorie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recette_id');
            $table->unsignedBigInteger('recette_categorie_id');

            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('cascade');
            $table->foreign('recette_categorie_id')->references('id')->on('recette_categorie')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('recette_recette_categorie');

        Schema::table('recette', function (Blueprint $table) {
            $table->unsignedBigInteger('recette_type_id')->nullable();
            $table->foreign('recette_type_id')->references('id')->on('recette_type')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::enableForeignKeyConstraints();
    }
};
