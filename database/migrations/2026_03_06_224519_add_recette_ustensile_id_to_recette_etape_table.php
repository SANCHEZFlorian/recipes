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
        Schema::table('recette_etape', function (Blueprint $table) {
            $table->unsignedBigInteger('recette_ustensile_id')->nullable()->after('type_cuisson_id');
            $table->foreign('recette_ustensile_id')->references('id')->on('recette_ustensile')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recette_etape', function (Blueprint $table) {
            $table->dropForeign(['recette_ustensile_id']);
            $table->dropColumn('recette_ustensile_id');
        });
    }
};
