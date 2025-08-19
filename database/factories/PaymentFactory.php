<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => \App\Models\Booking::factory(),
            'payment_method' => fake()->randomElement(['card', 'paypal', 'bank']),
            'amount' => fake()->randomFloat(2, 200, 3000),
            'payment_date' => fake()->dateTime(),
            'status' => 'completed',
        ];

    }
}
