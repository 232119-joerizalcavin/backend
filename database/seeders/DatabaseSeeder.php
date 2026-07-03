<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin KeretaKargo',
            'email' => 'admin@keretakargo.com',
            'password' => bcrypt('password123'),
        ]);

        // Seed gerbongs and barang kargos
        $this->call([
            GerbongSeeder::class,
            BarangKargoSeeder::class,
        ]);
    }
}
