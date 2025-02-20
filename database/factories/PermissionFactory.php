<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reason' => fake()->text(),
            // 'user_id',
            'status' => fake()->randomElement(['sudah kembali', 'belum kembali']),
            'start_date'=>fake()->date(),
            'end_date' =>fake()->date()
        ];
    }
}
