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
        Schema::create('temps', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('recette_id');
            $table->integer('temps');
            $table->string('type');

            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('temps');
    }
};
