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
        Schema::create('liste_ingredient', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nom');
            $table->foreign('type_ingredient_id')->references('id')->on('type_ingredient')->onDelete('restrict')->onUpdate('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liste_ingredients');
    }
};
