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
        Schema::create('recette_photo', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('position');
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('recette_id');

            $table->foreign('photo_id')->references('id')->on('photo')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('recette_photo');
    }
};
