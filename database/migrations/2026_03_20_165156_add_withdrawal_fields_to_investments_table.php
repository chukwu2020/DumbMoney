<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->timestamp('withdrawn_at')->nullable()->after('status');
            $table->decimal('final_profit_withdrawn', 15, 2)->nullable()->after('withdrawn_at');
        });
    }

    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn(['withdrawn_at', 'final_profit_withdrawn']);
        });
    }
};