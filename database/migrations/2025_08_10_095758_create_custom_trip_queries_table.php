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
        Schema::create('custom_trip_queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('travel_dates')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'approved', 'rejected', 'replied'])->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_trip_queries');
    }
};
