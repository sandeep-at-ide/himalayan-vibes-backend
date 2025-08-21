<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $categoryId = Category::where('type', 'destination')->inRandomOrder()->value('id');

        return [
            'name' => fake()->city(),
            'slug' => fake()->unique()->slug(),
            'country' => fake()->country(),
            'description' => fake()->paragraph(),
            'category_id' => $categoryId,

        ];

    }
}
