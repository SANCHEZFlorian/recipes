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
        // 1. Add 'portions' to 'recette'
        Schema::table('recette', function (Blueprint $table) {
            $table->integer('portions')->default(1)->after('title');
            $table->integer('is_visible')->default(1)->change();
            $table->integer('is_supprimer')->default(0)->change();
        });

        // 2. Make 'recette_ingredient_id' nullable in 'recette_etape'
        Schema::table('recette_etape', function (Blueprint $table) {
            $table->unsignedBigInteger('recette_ingredient_id')->nullable()->change();
        });

        // 3. Modernize 'temps' table
        Schema::table('temps', function (Blueprint $table) {
            $table->dropColumn(['temps', 'type']);
            $table->integer('preparation')->default(0);
            $table->integer('cuisson')->default(0);
            $table->integer('repos')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temps', function (Blueprint $table) {
            $table->integer('temps')->default(0);
            $table->string('type')->default('preparation');
            $table->dropColumn(['preparation', 'cuisson', 'repos']);
        });

        Schema::table('recette_etape', function (Blueprint $table) {
            $table->unsignedBigInteger('recette_ingredient_id')->nullable(false)->change();
        });

        Schema::table('recette', function (Blueprint $table) {
            $table->dropColumn('portions');
        });
    }
};
