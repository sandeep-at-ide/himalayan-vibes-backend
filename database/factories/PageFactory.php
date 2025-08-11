<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'slug' => fake()->unique()->slug(),
            'title' => fake()->sentence(3),
            'content' => fake()->paragraph(5),
            'seo_id' => \App\Models\SeoSetting::factory(),
            'custom_fields' => json_encode([
                'extra_info' => fake()->sentence(),
            ]),
        ];

    }
}
