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

        // Drop from recette table
        if (Schema::hasColumn('recette', 'type_cuisson_id')) {
            Schema::table('recette', function (Blueprint $table) {
                $table->dropForeign(['type_cuisson_id']);
                $table->dropColumn('type_cuisson_id');
            });
        }

        // Drop from recette_etape table
        if (Schema::hasColumn('recette_etape', 'type_cuisson_id')) {
            Schema::table('recette_etape', function (Blueprint $table) {
                $table->dropForeign(['type_cuisson_id']);
                $table->dropColumn('type_cuisson_id');
            });
        }

        // Drop type_cuisson table
        Schema::dropIfExists('type_cuisson');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('type_cuisson', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('icone')->nullable();
        });

        Schema::table('recette', function (Blueprint $table) {
            $table->unsignedBigInteger('type_cuisson_id')->nullable();
            $table->foreign('type_cuisson_id')->references('id')->on('type_cuisson')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('recette_etape', function (Blueprint $table) {
            $table->unsignedBigInteger('type_cuisson_id')->nullable();
            $table->foreign('type_cuisson_id')->references('id')->on('type_cuisson')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::enableForeignKeyConstraints();
    }
};
