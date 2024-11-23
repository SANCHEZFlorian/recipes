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
        Schema::create('notification', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('recette_id');
            $table->unsignedBigInteger('commentaire_id');
            $table->unsignedBigInteger('avis_id');
            $table->integer('is_read');
            $table->string('type');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('recette_id')->references('id')->on('recette')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('commentaire_id')->references('id')->on('commentaire')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('avis_id')->references('id')->on('avis')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
