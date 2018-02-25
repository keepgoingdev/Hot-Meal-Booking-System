<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'confirmed', 'gender', 'calorie_goal', 'weight', 'height_feet', 'height_inches'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Override the calory goal in the user table with the one from our latest weekly plan
    public function getCalorieGoalAttribute() {
        if($this->latestWeekPlan() != null)
            return $this->latestWeekPlan()->calory_goal;
        return 0;
    }

    public function latestWeekPlan(){
        $date = $startDate = date('Y-m-d', time());

        return $this->hasMany('App\Models\WeekPlan')
            ->where('end_date', '>=', $date)
            ->orderBy('end_date', 'desc')
            ->first();
    }

    public function currentWeekPlan() {
        $date = $startDate = date('Y-m-d', time());

        $d  = $this->hasMany('App\Models\WeekPlan')
                    ->where('end_date', '>', $date)
                    ->where('start_date', '<=', $date)
                    ->orderBy('end_date', 'desc')
                    ->first();
        if($d == null) {
            //first plan is yet to start
            return $this->hasMany('App\Models\WeekPlan')
                  ->where('end_date', '>=', $date)
                  ->orderBy('end_date', 'asc')
                  ->first();
        }
        return $d;
    }
    public function favoriteMeals() {
        return $this->belongsToMany('\App\Models\Meal', 'user_favorite_meals', 'user_id', 'meal_id');
    }

    public function calculateBMR($weight = null){
        if($weight == null) {
            $weight = $this->weight;
        }
        if($this->gender == 'M'){
            // 10 x weight (kg) + 6.25 x height (cm) – 5 x age (y) + 5
            $weightInKg = $weight * 0.45359237;
            $heightInCm = $this->height_feet * 30.48 + $this->height_inches * 2.54;
            $bmr = (10 * $weightInKg) + (6.25 * $heightInCm) - (5*25) + 5;
            $bmr = round($bmr) * 1.2; //1.2 is light activity.
            if($bmr < 1200){
                $bmr = 1200;
            }
        }
        elseif($this->gender == 'F'){
            $weightInKg = $weight * 0.45359237;
            $heightInCm = $this->height_feet * 30.48 + $this->height_inches * 2.54;
            $bmr = (10 * $weightInKg) + (6.25 * $heightInCm) - (5*25) - 161;
            $bmr = round($bmr) * 1.2; //1.2 is light activity.
            if($bmr < 1000){
                $bmr = 1000;
            }
        }
        else{
            # should not happen
            $bmr = 1500;
        }
        return $bmr;

    }

}
