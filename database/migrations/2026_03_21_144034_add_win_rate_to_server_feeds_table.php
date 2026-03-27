<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('server_feeds', function (Blueprint $table) {
            // Modify profit_margin FIRST
            $table->decimal('profit_margin', 15, 2)->default(0)->change();
        });

        Schema::table('server_feeds', function (Blueprint $table) {
            // Then add new columns
            $table->decimal('win_rate', 5, 2)->default(0)->after('profit_margin');
            $table->boolean('copy_trading_enabled')->default(true)->after('win_rate');
        });
    }

    public function down()
    {
        Schema::table('server_feeds', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['win_rate', 'copy_trading_enabled']);
        });

        Schema::table('server_feeds', function (Blueprint $table) {
            // Revert profit_margin
            $table->decimal('profit_margin', 5, 2)->default(0)->change();
        });
    }
};