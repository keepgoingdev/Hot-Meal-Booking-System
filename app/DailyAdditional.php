<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyAdditional extends Model
{
    protected $table = 'daily_additional';
    public $timestamps = false;
    protected $fillable = ['week_plan_id', 'day', 'additional', 'exercise', 'completed_sum'];
    protected $casts = [
        'week_plan_id' => 'integer',
        'day' => 'integer',
        'additional' => 'integer',
        'exercise' => 'integer',
        'completed_sum' => 'integer'
    ];
    public function getCalculatedCals() {
        return $this->completed_sum + $this->additional - $this->exercise;
    }
}
