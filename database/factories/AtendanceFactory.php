<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atendance>
 */
class AtendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'santri_id' => $this->faker->randomNumber(),
            // 'activity_id' => $this->faker->randomNumber(),
            'activity' => fake()->word(),
            'status' => fake()->randomElement(['present', 'absent']),
            'date' => fake()->date(),
        ];
    }
}
