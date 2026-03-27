<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_max_participations_to_plans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('max_participations')->default(3)->after('min_traders')->comment('Maximum times a user can participate in this plan');
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('max_participations');
        });
    }
};