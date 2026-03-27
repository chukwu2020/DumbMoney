<?php
// database/migrations/xxxx_xx_xx_create_user_trading_infos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_trading_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            
            // Trading experience (Page 2)
            $table->string('stock_experience'); // yes, no, novice
            $table->string('trading_frequency'); // 0-10, 11-40, 40+
            $table->string('transaction_volume'); // under_10k, 10k_50k, 50k_250k, over_250k
            
            // Investment goals (Page 3) - stored as JSON array
            $table->json('investment_goals'); // ['diversification', 'fixed_income', 'venture_capital', 'other']
            
            // Asset classes (Page 5) - stored as JSON array
            $table->json('asset_classes'); // ['stocks', 'crypto', 'venture', 'realestate']
            
            // Account type (Page 6)
            $table->string('account_type'); // personal, corporate
            
            // For corporate accounts (these can be null for personal accounts)
            $table->unsignedBigInteger('copy_admin_id')->nullable();
            $table->string('copy_admin_name')->nullable();
            $table->string('copy_server_name')->nullable();
            
            // Financial information (Page 7)
            $table->decimal('investment_amount', 15, 2)->default(0);
            $table->string('financial_alternative')->nullable(); // Pension, Savings, etc.
            $table->string('annual_income'); // $0-14,999, $15,000-49,999, etc.
            $table->string('deposit_source'); // source of initial deposit
            $table->string('ongoing_deposit_source'); // source of ongoing deposits
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('copy_admin_id')->references('id')->on('server_feeds')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_trading_infos');
    }
};