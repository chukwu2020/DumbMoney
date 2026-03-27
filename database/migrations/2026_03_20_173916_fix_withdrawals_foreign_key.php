<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropForeign(['investment_id']);

            $table->foreign('investment_id')
                ->references('id')
                ->on('investments')
                ->nullOnDelete(); // ✅ FIXED
        });
    }

    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropForeign(['investment_id']);

            $table->foreign('investment_id')
                ->references('id')
                ->on('investments')
                ->cascadeOnDelete();
        });
    }
};