<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('server_feeds', function (Blueprint $table) {
        $table->id();
        $table->string('server_name');
        $table->string('admin_name');
        $table->integer('active_members')->default(0);
        $table->integer('copying_trades')->default(0);
        $table->decimal('profit_margin', 8, 2)->default(0);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_feeds');
    }
};
