<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
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
            'package_id' => \App\Models\Package::factory(),
            'booking_date' => fake()->date(),
            'number_of_people' => fake()->numberBetween(1, 6),
            'package_price' => fake()->randomFloat(2, 100, 1000), // Assuming package price is a float
            'total_price' => fake()->randomFloat(2, 300, 3000),
            'vat_amount' => fake()->randomFloat(2, 20, 200),
            'discount' => fake()->randomFloat(2, 0, 100),
            'status' => fake()->randomElement(['pending', 'reviewed', 'approved', 'rejected', 'replied']),
        ];

    }
}
