<?php
// database/migrations/2024_03_25_000001_add_fee_columns_to_withdrawals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            // Add fee columns if they don't exist
            if (!Schema::hasColumn('withdrawals', 'net_amount')) {
                $table->decimal('net_amount', 15, 2)->nullable()->after('amount');
            }
            
            if (!Schema::hasColumn('withdrawals', 'management_fee')) {
                $table->decimal('management_fee', 15, 2)->default(0)->after('net_amount');
            }
            
            if (!Schema::hasColumn('withdrawals', 'performance_fee')) {
                $table->decimal('performance_fee', 15, 2)->default(0)->after('management_fee');
            }
            
            if (!Schema::hasColumn('withdrawals', 'fee_breakdown')) {
                $table->json('fee_breakdown')->nullable()->after('performance_fee');
            }

             if (!Schema::hasColumn('withdrawals', 'bank_fee')) {
                $table->decimal('bank_fee', 15, 2)->default(0)->after('performance_fee');
            }
        });
    }

    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn(['net_amount', 'management_fee', 'performance_fee', 'fee_breakdown','bank_fee']);
        });
    }
};