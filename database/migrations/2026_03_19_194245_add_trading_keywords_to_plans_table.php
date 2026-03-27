<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_trading_keywords_to_plans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->string('trading_style')->nullable()->after('interest_rate')->comment('Scalping, Day Trading, Swing Trading, Position Trading');
            $table->string('risk_level')->nullable()->after('trading_style')->comment('Low, Medium, High');
            $table->text('strategy')->nullable()->after('risk_level')->comment('Technical Analysis, Fundamental Analysis, Algorithmic, etc.');
            $table->json('assets_traded')->nullable()->after('strategy')->comment('Forex, Crypto, Stocks, Commodities');
            $table->string('min_duration')->nullable()->after('duration')->comment('Minimum duration if flexible');
            $table->string('expected_roi_range')->nullable()->after('interest_rate')->comment('e.g., "15-25%"');
            $table->json('features')->nullable()->after('expected_roi_range')->comment('Custom features added by admin');
            $table->boolean('popular_badge')->default(false)->after('features');
            $table->string('recommended_for')->nullable()->after('popular_badge')->comment('Beginners, Intermediate, Expert');
            $table->string('profit_frequency')->default('daily')->after('recommended_for')->comment('daily, weekly, monthly');
            $table->decimal('management_fee', 5, 2)->default(0)->after('profit_frequency')->comment('Management fee percentage');
            $table->decimal('performance_fee', 5, 2)->default(0)->after('management_fee')->comment('Performance fee percentage');
            $table->integer('min_traders')->default(1)->after('performance_fee')->comment('Minimum traders copying');
            $table->string('experience_required')->nullable()->after('min_traders')->comment('Experience level needed');
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn([
                'trading_style',
                'risk_level',
                'strategy',
                'assets_traded',
                'min_duration',
                'expected_roi_range',
                'features',
                'popular_badge',
                'recommended_for',
                'profit_frequency',
                'management_fee',
                'performance_fee',
                'min_traders',
                'experience_required'
            ]);
        });
    }
};