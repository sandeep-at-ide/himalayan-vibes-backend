<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TeamMember;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Review;
use App\Models\ContactMessage;
use App\Models\CustomTripQuery;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Blog;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // TeamMember::factory(5)->create();
        // Destination::factory(8)->create();
        // Package::factory(12)->create();
        // Booking::factory(20)->create();
        // Payment::factory(15)->create();
        // Review::factory(30)->create();
        // ContactMessage::factory(10)->create();
        // CustomTripQuery::factory(5)->create();
        // Faq::factory(10)->create();
        // Page::factory(5)->create();
        // Blog::factory(5)->create();
        // SeoSetting::factory(5)->create();
        // SiteSetting::factory()->create();
        $this->call([
            RbacSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'editor user',
        //     'email' => 'editor@example.com',
        //     'password' => Hash::make('password'),
        //     'role_id' => 1
        // ]);
    //    $this->call(BlogSeeder::class);
    }
}
