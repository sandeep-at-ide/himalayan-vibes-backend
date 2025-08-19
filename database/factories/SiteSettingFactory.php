<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_name' => fake()->company(),
            'logo_url' => fake()->imageUrl(),
            'contact_email' => fake()->companyEmail(),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'social_links' => json_encode([
                'facebook' => fake()->url(),
                'instagram' => fake()->url(),
            ]),
            'accessed_by' => \App\Models\TeamMember::factory(),
        ];

    }
}
