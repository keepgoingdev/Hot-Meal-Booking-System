<?php

namespace App\Models;

use App\DailyAdditional;
use Illuminate\Database\Eloquent\Model;
class WeekPlan extends Model
{
    protected $fillable = [
        'start_date', 'end_date', 'user_id', 'calory_goal', 'weight'
    ];
    public $timestamps = false;

    public function dayMenus(){
        return $this->hasMany('App\Models\DayMenu');
    }

    public function dayMenu($index){
        return $this->hasMany('App\Models\DayMenu')->where('day', $index)->get();
    }

    public static function storeSessionDataInTable($dayMenus, $startingDate, $goal, $weight, $userId)
    {
        $date = date($startingDate);
        $startDate = date('Y-m-d', strtotime($date));
        $endDate = date('Y-m-d', strtotime($startDate. '+ 7 days'));
        $weekPlan = self::firstOrNew(array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'user_id' => $userId,
            'calory_goal' => $goal,
            'weight' => $weight
        ));
        $weekPlan->save();
        foreach ($dayMenus as $index => $dayMenu){
            DailyAdditional::create([
                'week_plan_id' => $weekPlan->id,
                'day' => $index
            ]);
            DayMenu::addNewMenuFromSession($dayMenu, $index, $weekPlan->id);
        }
    }

    public static function getCurrentWeekPlan($userId)
    {
        $currentDate = date('Y-m-d', strtotime(time()));

        return self::where('user_id', $userId)->where('start_date', '>=', $currentDate)->orderBy('start_date','desc')->first();
    }
}
