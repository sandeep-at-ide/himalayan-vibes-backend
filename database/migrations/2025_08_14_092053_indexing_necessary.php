<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('phone');
            $table->index('created_at');
        });

        Schema::table('destinations', function (Blueprint $table) {
            $table->index('country');
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->index('location');
            $table->index('created_by');
            $table->index('seo_id');
            $table->index('price');
            $table->index('duration_days');
            $table->index('created_at');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('package_id');
            $table->index('booking_date');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        // Optional: Add logic to drop these indexes if needed
    }
};

