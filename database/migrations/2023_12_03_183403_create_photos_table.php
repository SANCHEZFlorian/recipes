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
        Schema::create('photo', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->string('nom_fichier');
            $table->string('type');
            $table->integer('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
