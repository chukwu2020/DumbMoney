<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('server_feeds', function (Blueprint $table) {

        // Server profile
        $table->string('server_profile_image')->nullable();
        $table->text('server_description')->nullable();

        // Admin profile
        $table->string('admin_profile_image')->nullable();
        $table->text('admin_bio')->nullable();
    });
}

public function down()
{
    Schema::table('server_feeds', function (Blueprint $table) {
        $table->dropColumn([
            'server_profile_image',
            'server_description',
            'admin_profile_image',
            'admin_bio'
        ]);
    });
}
};
