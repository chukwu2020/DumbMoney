<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $table = 'payouts';

    protected $guarded = [];

    protected $casts = [
        'pay_date' => 'date',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Mask name like: J******
    public function getFormattedNameAttribute()
    {
        if (!$this->fullname) {
            return '';
        }

        $first = substr($this->fullname, 0, 1);

        return strtoupper($first) . str_repeat('*', 6);
    }

    // Format payout date nicely
    public function getFormattedDateAttribute()
    {
        return $this->pay_date
            ? $this->pay_date->format('M d, Y')
            : '';
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    // Generate encrypted trader account ID
    public function generateEncryptedAccount()
    {
        $data = implode('|', [
            $this->id,
            optional($this->pay_date)->format('Ymd'),
            $this->fullname
        ]);

        return 'ATOM' . base64_encode($data);
    }

    /*
    |--------------------------------------------------------------------------
    | Trading Chart Generator (for popup charts)
    |--------------------------------------------------------------------------
    */

    public function generateTradingHistory($points = 30)
    {
        $balance = rand(8000, 15000);

        $history = [];

        for ($i = 0; $i < $points; $i++) {

            // simulate realistic trading movement
            $change = rand(-150, 350);

            $balance += $change;

            if ($balance < 0) {
                $balance = rand(5000, 9000);
            }

            $history[] = [
                'day' => $i + 1,
                'balance' => $balance
            ];
        }

        return $history;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Only active payouts
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Latest payouts
    public function scopeLatestPayouts($query)
    {
        return $query->orderBy('pay_date', 'desc')
                     ->orderBy('id', 'desc');
    }
public function plan()
{
    return $this->belongsTo(Plan::class);
}
}