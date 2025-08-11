<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->text('itineraries')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('location')->nullable()->constrained('destinations')->onDelete('set null');
            $table->integer('duration_days')->nullable();
            $table->integer('available_spots')->nullable();
            $table->text('image_url')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('team_members')->onDelete('set null');
            $table->foreignId('seo_id')->nullable()->constrained('seo_settings')->onDelete('set null');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
