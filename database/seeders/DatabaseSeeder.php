<?php

namespace Database\Seeders;

use App\Models\Campaing;
use App\Models\Player;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        for ($i = 0; $i < 10; $i++) {
            DB::table('player_campaings')->insert([
                'player_uuid' => Player::all()->random()->uuid,
                'campaing_uuid' => Campaing::all()->random()->uuid,
            ]);
        }

        User::factory()->create([
            'name' => 'user',
            'email' => 'mateus@teste.com',
        ]);
    }
}
