<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoSetting>
 */
class SeoSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_title' => fake()->sentence(3),
            'meta_description' => fake()->paragraph(),
            'meta_keywords' => implode(', ', fake()->words(5)), // convert to comma-separated string
            'custom_fields' => json_encode([
                'og_image' => fake()->imageUrl(),
            ]),
        ];


    }
}
