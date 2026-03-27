<?php
// database/migrations/xxxx_xx_xx_add_registration_status_to_users_table.php

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
            $table->string('account_status')->default('pending')->after('copy_server_name'); // pending, active, suspended
            $table->integer('registration_step')->default(0)->after('account_status'); // 0=not started, 1=basic done, 2=additional info done
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['account_status', 'registration_step']);
        });
    }
};