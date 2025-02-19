<?php

namespace Database\Factories;

use App\Models\attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttachmentSantri>
 */
class AttachmentSantriFactory extends Factory
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
            'attachment_id' => attachment::all()->random()->id,
        ];
    }
}
