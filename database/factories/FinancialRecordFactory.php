<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialRecord>
 */
class FinancialRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'accounting_id' => $this->faker->randomNumber(),
            'category' => fake()->randomElement(['pemasukan', 'pengeluaran']),
            'description' => fake()->sentence(),
            'transaction_type' => fake()->randomElement(['credit', 'debit']),
            'amount' => fake()->randomFloat(2, 1000, 100000),
            'transaction_date' => fake()->date()
        ];
    }
}
