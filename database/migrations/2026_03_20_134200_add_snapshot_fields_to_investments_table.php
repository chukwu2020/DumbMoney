<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            // Add snapshot columns after amount_invested (which exists in your table)
            if (!Schema::hasColumn('investments', 'snapshot_duration_unit')) {
                $table->string('snapshot_duration_unit')->nullable()->after('amount_invested');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_duration_value')) {
                $table->integer('snapshot_duration_value')->nullable()->after('snapshot_duration_unit');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_interest_rate')) {
                $table->decimal('snapshot_interest_rate', 10, 2)->nullable()->after('snapshot_duration_value');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_plan_name')) {
                $table->string('snapshot_plan_name')->nullable()->after('snapshot_interest_rate');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_min_amount')) {
                $table->decimal('snapshot_min_amount', 15, 2)->nullable()->after('snapshot_plan_name');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_max_amount')) {
                $table->decimal('snapshot_max_amount', 15, 2)->nullable()->after('snapshot_min_amount');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_features')) {
                $table->json('snapshot_features')->nullable()->after('snapshot_max_amount');
            }
            
            if (!Schema::hasColumn('investments', 'snapshot_assets_traded')) {
                $table->json('snapshot_assets_traded')->nullable()->after('snapshot_features');
            }
        });
    }

    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $columns = [
                'snapshot_duration_unit',
                'snapshot_duration_value',
                'snapshot_interest_rate',
                'snapshot_plan_name',
                'snapshot_min_amount',
                'snapshot_max_amount',
                'snapshot_features',
                'snapshot_assets_traded'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('investments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};