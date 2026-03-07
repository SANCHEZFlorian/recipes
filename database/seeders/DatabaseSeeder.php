<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate(); // Avoid deleting admin if it exists
        if (DB::table('users')->count() == 0) {
            DB::table('users')->insert([
                'username' => 'admin',
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@argon.com',
                'password' => bcrypt('secret')
            ]);
        }

        $this->call(DummyDataSeeder::class);
        $this->call(BulkRecipeSeeder::class);
    }
}
