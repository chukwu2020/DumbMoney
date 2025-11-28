<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Live Trading Sessions
        Schema::create('live_trading_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();
            $table->timestamp('last_activity')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->integer('watch_time_seconds')->default(0);
            $table->decimal('earnings', 10, 2)->default(0);
            $table->timestamps();
            
            $table->index(['user_id', 'is_active']);
        });

        // Live Trading Messages
        Schema::create('live_trading_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('message');
            $table->timestamps();
            
            $table->index('created_at');
        });

        // Membership Codes
        Schema::create('membership_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->boolean('is_used')->default(false);
            $table->foreignId('used_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
            
            $table->index(['code', 'is_used']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('membership_codes');
        Schema::dropIfExists('live_trading_messages');
        Schema::dropIfExists('live_trading_sessions');
    }
};