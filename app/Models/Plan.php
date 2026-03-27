<?php
// app/Models/Plan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

   
    
    // Get formatted duration string
    public function getFormattedDurationAttribute()
    {
        $unit = $this->duration_unit ?? 'days';
        $value = $this->duration;
        $unitLabel = $unit;
        
        if ($value > 1) {
            $unitLabel = rtrim($unit, 's') . 's';
        }
        
        return $value . ' ' . $unitLabel;
    }

    // Get end date based on start date and duration
    public function getEndDate($startDate)
    {
        $unit = $this->duration_unit ?? 'days';
        $value = $this->duration;
        
        return match($unit) {
            'minutes' => $startDate->copy()->addMinutes($value),
            'hours' => $startDate->copy()->addHours($value),
            default => $startDate->copy()->addDays($value),
        };
    }

    // Get features list
    public function getFeaturesListAttribute()
    {
        $features = $this->features;
        
        if (is_null($features)) return [];
        if (is_string($features)) {
            $decoded = json_decode($features, true);
            return is_array($decoded) ? $decoded : [];
        }
        return is_array($features) ? $features : [];
    }

    // Get assets list
    public function getAssetsListAttribute()
    {
        $assets = $this->assets_traded;
        
        if (is_null($assets)) return [];
        if (is_string($assets)) {
            $decoded = json_decode($assets, true);
            return is_array($decoded) ? $decoded : [];
        }
        return is_array($assets) ? $assets : [];
    }

    // Get trading style badge color
    public function getTradingStyleColorAttribute()
    {
        return match($this->trading_style) {
            'Scalping' => 'bg-purple-100 text-purple-800',
            'Day Trading' => 'bg-blue-100 text-blue-800',
            'Swing Trading' => 'bg-green-100 text-green-800',
            'Position Trading' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    // Get risk level color
    public function getRiskLevelColorAttribute()
    {
        return match($this->risk_level) {
            'Low' => 'bg-green-100 text-green-800',
            'Medium' => 'bg-yellow-100 text-yellow-800',
            'High' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }



    protected $casts = [
        'minimum_amount' => 'decimal:2',
        'maximum_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'management_fee' => 'decimal:2',
        'performance_fee' => 'decimal:2',
        'features' => 'array', // Add this line to cast features as array
        'assets_traded' => 'array', // Also cast assets_traded as array
        'popular_badge' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'duration',
        'duration_unit',
        'min_duration',
        'minimum_amount',
        'maximum_amount',
        'interest_rate',
        'expected_roi_range',
        'profit_frequency',
        'trading_style',
        'risk_level',
        'recommended_for',
        'strategy',
        'assets_traded',
        'management_fee',
        'performance_fee',
        'min_traders',
        'max_participations',
        'features',
        'status',
        'popular_badge',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
