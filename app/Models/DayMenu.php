<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayMenu extends Model
{
    protected $fillable = [
        'day', 'week_plan_id', 'meal_id', 'time_of_day', 'meal_completed'
    ];
    public $timestamps = false;

    public function meal() {
        return $this->belongsTo('\App\Models\Meal');
    }
    public static function addNewMenuFromSession($dayMenu, $index, $weekPlanId)
    {
        foreach ($dayMenu as $timeOfDayType => $timeOfDay) {
            $timeOfDayName = Meal::$types[$timeOfDayType];
            foreach ($timeOfDay['meals'] as $meal) {
                $mealId = $meal['id'];
                $dayMenu = self::firstOrNew(array(
                    'day' => $index,
                    'week_plan_id' => $weekPlanId,
                    'meal_id' => $mealId,
                    'time_of_day' => $timeOfDayName
                ));
                $dayMenu->save();
            }
        }


    }

}
