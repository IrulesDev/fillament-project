<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SantriFamily>
 */
class SantriFamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'santri_id',
            'no_kk' => $this->faker->numerify('################'),
            'father_name' => $this->faker->name('male'),
            'father_job' => $this->faker->jobTitle(),
            'father_birth' => $this->faker->date(),
            'father_phone' => $this->faker->phoneNumber(),
            'mother_name' => $this->faker->name('female'),
            'mother_job' => $this->faker->jobTitle(),
            'mother_birth' => $this->faker->date(),
            'mother_phone' => $this->faker->phoneNumber(),
        ];
    }
}
