<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_type_to_investments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->string('type')->default('investment')->after('plan_id')->comment('investment, copy_trading');
        });
    }

    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};