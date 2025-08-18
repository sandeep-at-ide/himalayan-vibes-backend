<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the column
            $table->unsignedBigInteger('role_id')->nullable()->after('id'); // or after another field

            // Add foreign key constraint
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['role_id']);

            // Then drop the column
            $table->dropColumn('role_id');
        });
    }
}
