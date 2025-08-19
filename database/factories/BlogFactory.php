<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(10),
            'author_id' => \App\Models\TeamMember::factory(),
            'seo_id' => \App\Models\SeoSetting::factory(),
            'published_at' => now(),
        ];

    }
}
