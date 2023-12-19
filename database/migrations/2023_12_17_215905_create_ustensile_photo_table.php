<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ustensile_photo', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('ustensile_id');

            $table->foreign('photo_id')->references('id')->on('photo')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('ustensile_id')->references('id')->on('ustensile')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ustensile_photo');
    }
};
