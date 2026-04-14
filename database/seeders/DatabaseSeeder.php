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

        User::factory()->create([
            'name' => 'Test User',
            'no_hp' => '081234567890',
            'email' => 'test@example.com',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Admin',
            'no_hp' => '081234567891',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin12345'),
            'role' => 'admin',
        ]);
    }
}
