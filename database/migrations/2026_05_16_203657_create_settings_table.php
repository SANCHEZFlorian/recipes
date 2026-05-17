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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed initial settings
        \DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'Family Recipe'],
            ['key' => 'contact_email', 'value' => 'contact@family-recipe.com'],
            ['key' => 'site_description', 'value' => 'Partagez vos meilleures recettes de famille en toute simplicité.'],
            ['key' => 'maintenance_mode', 'value' => '0'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
