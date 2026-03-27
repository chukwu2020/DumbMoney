<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_copy_trading_fields_to_investments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            // Check if column doesn't exist before adding to avoid errors
            
            if (!Schema::hasColumn('investments', 'type')) {
                $table->string('type')->default('investment')->after('plan_id');
            }
            
            if (!Schema::hasColumn('investments', 'copy_admin_id')) {
                $table->unsignedBigInteger('copy_admin_id')->nullable()->after('type');
            }
            
            if (!Schema::hasColumn('investments', 'copy_admin_name')) {
                $table->string('copy_admin_name')->nullable()->after('copy_admin_id');
            }
            
            if (!Schema::hasColumn('investments', 'copy_server_name')) {
                $table->string('copy_server_name')->nullable()->after('copy_admin_name');
            }
            
            if (!Schema::hasColumn('investments', 'trading_style')) {
                $table->string('trading_style')->nullable()->after('copy_server_name');
            }
            
            if (!Schema::hasColumn('investments', 'risk_level')) {
                $table->string('risk_level')->nullable()->after('trading_style');
            }
            
            if (!Schema::hasColumn('investments', 'assets_traded')) {
                $table->json('assets_traded')->nullable()->after('risk_level');
            }
            
            if (!Schema::hasColumn('investments', 'current_value')) {
                $table->decimal('current_value', 15, 2)->default(0)->after('total_profit');
            }
            
            if (!Schema::hasColumn('investments', 'profit_loss')) {
                $table->decimal('profit_loss', 15, 2)->default(0)->after('current_value');
            }
            
            if (!Schema::hasColumn('investments', 'last_sync_at')) {
                $table->timestamp('last_sync_at')->nullable()->after('profit_loss');
            }
        });
    }

    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $columns = [
                'type', 'copy_admin_id', 'copy_admin_name', 'copy_server_name',
                'trading_style', 'risk_level', 'assets_traded', 'current_value',
                'profit_loss', 'last_sync_at'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('investments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};