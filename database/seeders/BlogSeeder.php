<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Blog::create([
        'slug' => 'first-blog-post',
        'title' => 'First Blog Post',
        'content' => 'This is the content of the first blog post.',
        'author_id' => 1, // Assuming the user with ID 1 exists
        // 'seo_id' => 1, // Assuming the SEO setting with ID 1 exists
        'published_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    Blog::create([
        'slug' => 'second-blog-post',
        'title' => 'Second Blog Post',
        'content' => 'This is the content of the second blog post.',
        'author_id' => 1,
        // 'seo_id' => 1,
        'published_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

}
