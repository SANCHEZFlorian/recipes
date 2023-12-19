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
        Schema::create('aliment', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nom')->unique();
            $table->unsignedBigInteger('aliment_type_id');

            $table->foreign('aliment_type_id')->references('id')->on('aliment_type')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('aliment');
    }
};
