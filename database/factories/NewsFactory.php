<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\news>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seed = fake()->unique()->uuid;
        
        $url = "https://picsum.photos/seed/$seed/200/300";

        return [
            // 'autor_id',
            'title' => fake()->text(20),
            'gambar' => $url,
            'content' => fake()->text()
        ];
    }
}
