<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->date('pay_date');
            $table->string('fullname')->nullable();
            $table->string('amount'); // Stored as string with $ symbol
            $table->string('processing_time');
            $table->string('account_type');
            $table->string('location');
            $table->string('country')->nullable();
            $table->string('flag_code')->nullable();
            $table->text('chart_data')->nullable(); // For the chart display
            $table->string('encrypted_account')->nullable(); // The data-account attribute
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payouts');
    }
};