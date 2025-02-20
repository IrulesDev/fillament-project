<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->name();
        $nameEmail = str_replace(' ', '', $name);

        return [
            'name' => $name,
            'gender'=> fake()->randomElement(['pria', 'wanita']),
            'date_of_birth' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'generation'=> fake()->numberBetween(1,10),
            'entry_date' => fake()->date(),
            'graduation_date' => fake()->date(),
            'status_graduate' => fake()->randomElement(['graduated', 'not_gratduated']),
            'role' => fake()->randomElement(['admin', 'teacher', 'student']),
            // 'kelas_id',
            // 'department_id',
            // 'education_id',
            'email' => $nameEmail . '@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
