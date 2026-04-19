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

        

        User::create([
            'name' => 'Admin',
            'no_hp' => '081234567891',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin12345'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas',
            'no_hp' => '081987654321',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('petugas12345'),
            'role' => 'petugas',
        ]);
    }
}
