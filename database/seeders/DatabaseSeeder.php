<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Campaing;
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

        Campaing::factory(10)->create();
        Player::factory(10)->create();

        User::factory()->create([
            'name' => 'user',
            'email' => 'mateus@teste.com',
        ]);
    }
}
