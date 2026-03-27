<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_duration_unit_to_plans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->enum('duration_unit', ['minutes', 'hours', 'days'])->default('days')->after('duration');
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('duration_unit');
        });
    }
};