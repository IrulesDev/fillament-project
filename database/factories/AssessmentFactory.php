<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => $this->faker->randomNumber(),
            // 'lesson_id' => $this->faker->randomNumber(),
            'score' => $this->faker->numberBetween(0, 100),
            'evaluation' => $this->faker->sentence(),
            'date' => $this->faker->date(),
        ];
    }
}
