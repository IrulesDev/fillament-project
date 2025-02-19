<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RapotSantri>
 */
class RapotSantriFactory extends Factory
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
            'academy_year' => $this->faker->year(),
            'overall_score' => $this->faker->randomFloat(2, 0, 100),
            'strengths' => $this->faker->sentence(),
            'weaknesses' => $this->faker->sentence(),
        ];
    }
}
