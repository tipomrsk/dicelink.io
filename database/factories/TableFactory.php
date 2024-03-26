<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'seats' => $this->faker->numberBetween(1, 10),
            'has_master' => $this->faker->boolean(),
            'start_date' => $this->faker->date(),
            'is_online' => $this->faker->boolean(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'obs' => $this->faker->text(),
        ];
    }
}
