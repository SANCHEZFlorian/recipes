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
        Schema::create('user_groupe', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('groupe_id');
            $table->unsignedBigInteger('users_id');

            $table->foreign('groupe_id')->references('id')->on('groupe')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_groupe');
    }
};
