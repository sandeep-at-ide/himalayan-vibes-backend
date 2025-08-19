<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
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
            'itineraries' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 100, 1000),
            'location' => \App\Models\Destination::factory(),
            'duration_days' => fake()->numberBetween(3, 14),
            'available_spots' => fake()->numberBetween(5, 30),
            'image_url' => fake()->imageUrl(),
            'created_by' => \App\Models\TeamMember::factory(),
            'seo_id' => \App\Models\SeoSetting::factory(),
        ];

    }
}
