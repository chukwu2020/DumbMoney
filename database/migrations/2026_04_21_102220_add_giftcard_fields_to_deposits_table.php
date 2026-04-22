<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * HOW TO USE THIS:
 * 1. php artisan make:migration add_giftcard_fields_to_deposits_table
 * 2. Paste this entire file content into the generated migration
 * 3. php artisan migrate
 *
 * If you get "Unknown column type" or "Cannot change column" errors, run:
 *    composer require doctrine/dbal
 * Then try again.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposits', function (Blueprint $table) {

            /*
             * WHY wallet_id IS NOW NULLABLE
             * ──────────────────────────────────────────────────────────────
             * Before: only crypto deposits existed → wallet_id was always set.
             * Now:    gift card deposits have NO blockchain wallet at all.
             *
             * If wallet_id stays NOT NULL, inserting a gift-card deposit will
             * throw a database integrity error because there is no wallet to
             * reference. Making it nullable means:
             *
             *   Crypto deposit    → wallet_id = <wallet id>
             *   Gift card deposit → wallet_id = NULL   (no wallet involved)
             *
             * Everything else (balance credit, history, admin panels) still
             * works identically — you just check payment_method to know which
             * type you're dealing with.
             * ──────────────────────────────────────────────────────────────
             */
            $table->foreignId('wallet_id')->nullable()->change();

            /*
             * payment_method
             * Identifies the deposit type so the UI and admin can render
             * the right details (wallet address vs gift card code).
             * Values: 'crypto' | 'giftcard'
             * Defaults to 'crypto' → all existing rows stay valid automatically.
             */
            $table->string('payment_method')->default('crypto')->after('status');

            /*
             * card_type
             * The gift card brand slug chosen from the selector.
             * Values: 'amazon' | 'itunes' | 'google' | 'steam' | 'walmart' | 'other'
             * NULL for crypto deposits.
             */
            $table->string('card_type')->nullable()->after('payment_method');

            /*
             * card_type_label
             * Human-readable label sent from the hidden field.
             * For standard brands this mirrors card_type (e.g. 'Amazon').
             * For 'other' it carries the full text the user typed in
             * (e.g. 'Razer Gold', 'PSN Card') — this is what admins see.
             */
            $table->string('card_type_label')->nullable()->after('card_type');

            /*
             * other_card_name
             * When the user picks "Other" and types a custom card name,
             * this field stores that exact value for the admin panel.
             * NULL for all preset brands and all crypto deposits.
             */
            $table->string('other_card_name')->nullable()->after('card_type_label');

            /*
             * card_code
             * The redemption / serial number the user entered.
             * NULL for crypto deposits.
             */
            $table->string('card_code')->nullable()->after('other_card_name');

            /*
             * notes
             * Optional extra information provided by the user.
             */
            $table->text('notes')->nullable()->after('card_code');
        });
    }

    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'card_type',
                'card_type_label',
                'other_card_name',
                'card_code',
                'notes',
            ]);
            // Only uncomment this if you need a clean rollback AND you are
            // sure no NULL wallet_id rows exist yet:
            // $table->foreignId('wallet_id')->nullable(false)->change();
        });
    }
};