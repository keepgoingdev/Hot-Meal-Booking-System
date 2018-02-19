<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyAdditional extends Model
{
    protected $table = 'daily_additional';
    public $timestamps = false;
    protected $fillable = ['week_plan_id', 'day', 'additional', 'exercise', 'completed_sum'];

    public function getCalculatedCals() {
        return $this->completed_sum + $this->additional - $this->exercise;
    }
}
