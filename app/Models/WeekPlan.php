<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class WeekPlan extends Model
{
    protected $fillable = [
        'start_date', 'end_date', 'user_id'
    ];
    public $timestamps = false;

    public function dayMenus(){
        return $this->hasMany('App\Models\DayMenu');
    }

    public function dayMenu($index){
        return $this->hasMany('App\Models\DayMenu')->where('day', $index)->get();
    }

    public static function storeSessionDataInTable($dayMenus, $startingDate, $userId)
    {
        $date = date($startingDate);
        $startDate = date('Y-m-d', strtotime($date. '+ 7 days'));
        $endDate = date('Y-m-d', strtotime($startDate. '+ 7 days'));
        $weekPlan = self::firstOrNew(array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'user_id' => $userId
        ));
        $weekPlan->save();
        foreach ($dayMenus as $index => $dayMenu){
            DayMenu::addNewMenuFromSession($dayMenu, $index, $weekPlan->id);
        }
    }

    public static function getCurrentWeekPlan($userId)
    {
        $currentDate = date('Y-m-d', strtotime(time()));

        return self::where('user_id', $userId)->where('start_date', '>=', $currentDate)->orderBy('start_date','desc')->first();
    }
}
