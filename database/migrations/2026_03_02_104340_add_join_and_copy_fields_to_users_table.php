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
    Schema::table('users', function (Blueprint $table) {

        // Joining Source
        $table->string('join_source')->nullable();
        $table->string('join_source_other')->nullable();

        // Copy Preference
        $table->string('copy_preference')->nullable();
        $table->unsignedBigInteger('copy_admin_id')->nullable();
        $table->string('copy_admin_name')->nullable();
        $table->string('copy_server_name')->nullable();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'join_source',
                'join_source_other',
                'copy_preference',
                'copy_admin_id',
                'copy_admin_name',
                'copy_server_name'
            ]);
        });
    }
};