<?php

namespace Database\Factories;

use App\Models\Atendance;
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
            'status' => fake()->randomElement([true, false]),
            'keterangan' => function (array $attributes) {
                if (empty($attributes['status']) || $attributes['status'] === false) {
                    return '';
                }
                return fake()->randomElement(['sakit', 'alfa', 'izin']);
            },
            'date' => fake()->date(),
        ];
    }
}
