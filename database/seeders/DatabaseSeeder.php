<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
        ['email' => 'coba@example.com'], // kondisi pencarian
        [
            'name' => 'coba',
            'password' => bcrypt('password'), // default password
        ]);

        $this->call(SiswaSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(IndustriSeeder::class);
        $this->call(PklSeeder::class);
    }
}
