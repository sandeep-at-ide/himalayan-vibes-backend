<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomTripQuery>
 */
class CustomTripQueryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'preferred_location' => fake()->city(),
            'travel_dates' => fake()->date() . ' to ' . fake()->date(),
            'number_of_people' => fake()->numberBetween(1, 10),
            'budget' => fake()->randomFloat(2, 500, 5000),
            'message' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'reviewed', 'replied']),
        ];

    }
}
