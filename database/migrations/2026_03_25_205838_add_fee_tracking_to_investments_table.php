<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            if (!Schema::hasColumn('investments', 'profit_earned')) {
                $table->decimal('profit_earned', 15, 2)->default(0)->after('total_profit');
            }
            if (!Schema::hasColumn('investments', 'management_fee_deducted')) {
                $table->decimal('management_fee_deducted', 15, 2)->default(0)->after('profit_earned');
            }
            if (!Schema::hasColumn('investments', 'performance_fee_deducted')) {
                $table->decimal('performance_fee_deducted', 15, 2)->default(0)->after('management_fee_deducted');
            }
        });
    }

    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn(['profit_earned', 'management_fee_deducted', 'performance_fee_deducted']);
        });
    }
};