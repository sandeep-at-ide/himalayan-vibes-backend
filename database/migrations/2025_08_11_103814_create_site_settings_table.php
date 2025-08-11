<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name');
            $table->text('logo_url')->nullable();
            $table->string('contact_email');
            $table->string('phone_number');
            $table->text('address')->nullable();
            $table->json('social_links')->nullable();

            $table->foreignId('accessed_by')->nullable()->constrained('team_members')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
