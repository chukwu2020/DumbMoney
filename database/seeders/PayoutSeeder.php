<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payout;
use Carbon\Carbon;

class PayoutSeeder extends Seeder
{
    public function run()
    {
        // Import your existing HTML data here
        // This is a sample of how to add the first few rows
        $payouts = [
            [
                'pay_date' => 'Mar 13, 2026',
                'fullname' => 'E******',
                'amount' => '$2,000',
                'processing_time' => '7 Mins',
                'account_type' => '50k Trail Rithmic',
                'location' => 'Houston, USA',
            ],
            [
                'pay_date' => 'Mar 13, 2026',
                'fullname' => 'E******',
                'amount' => '$2,000',
                'processing_time' => '8 Mins',
                'account_type' => '50k Trail Rithmic',
                'location' => 'Houston, USA',
            ],
            // Add all your existing data here...
        ];

        foreach ($payouts as $payoutData) {
            $payout = new Payout($payoutData);
            $payout->pay_date = Carbon::parse($payoutData['pay_date']);
            $payout->is_active = true;
            $payout->encrypted_account = $payout->generateEncryptedAccount();
            $payout->save();
        }
    }
}