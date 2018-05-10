<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'homepage_name',
        'slug',
        'braintree_plan',
        'cost',
        'description',
        'is_discount',
        'show_on_homepage',
        'month',
    ];

    protected $casts = [
        'show_on_homepage' => 'boolean',
        'month' => 'integer',
        'cost' => 'float',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getMonthlyCostAttribute()
    {
        if(!$this->cost || !$this->month){
            return 0;
        }
        return $this->cost / $this->month;
    }

    public function getSavingPercent($baseMonthlyPrice)
    {
        $actual = $this->month * $baseMonthlyPrice;
        $saving = $actual - $this->cost;

        $percent = 100 * $saving /  $actual;

        return $percent;
    }
}
