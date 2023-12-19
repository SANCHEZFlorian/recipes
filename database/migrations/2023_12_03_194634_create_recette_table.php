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
            $table->integer('is_visible');
            $table->integer('is_supprimer');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('groupe_id')->nullable();
            $table->unsignedBigInteger('recette_type_id');
            $table->unsignedBigInteger('prix_id')->nullable();
            $table->unsignedBigInteger('type_cuisson_id')->nullable();
            $table->unsignedBigInteger('difficulte_id')->nullable();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('groupe_id')->references('id')->on('groupe')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('recette_type_id')->references('id')->on('recette_type')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('prix_id')->references('id')->on('prix')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('type_cuisson_id')->references('id')->on('type_cuisson')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('difficulte_id')->references('id')->on('difficulte')->onDelete('restrict')->onUpdate('restrict')->nullable();

            $table->timestamps();
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
