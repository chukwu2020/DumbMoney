
<?php

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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('recipient_name')->nullable()->after('usdt_address');
            $table->string('bank_name')->nullable()->after('recipient_name');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('iban')->nullable()->after('account_number');
            $table->string('swift_bic')->nullable()->after('iban');
            $table->text('bank_address')->nullable()->after('swift_bic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'recipient_name',
                'bank_name',
                'account_number',
                'iban',
                'swift_bic',
                'bank_address'
            ]);
        });
    }
};



