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
    public function favoriteMeals() {
        return $this->belongsToMany('\App\Models\Meal', 'user_favorite_meals', 'user_id', 'meal_id');
    }

    public function calculateBMR($weight = null){
        if($weight == null) {
            $weight = $this->weight;
        }
        if($this->gender == 'M'){
            $bmrWeight = 13.7516 * ($weight)/2.20462262;
            $bmrHeight = 5.0033 * ($this->height_feet * 30.48) + ($this->height_inches * 2.54);
            $bmrAge = 6.755 * 25; //25=age
            $bmr = 66.473 + $bmrWeight + $bmrHeight - $bmrAge;

            if($bmr < 1200){
                $bmr = 1200;
            }
        }
        elseif ($this->gender == 'F'){
            $bmrWeight = 9.5634 * ($weight)/2.20462262;
            $bmrHeight = 1.8496 * ($this->height_feet * 30.48) + ($this->height_inches * 2.54);
            $bmrAge = 4.6765 * 25; //25=age
            $bmr = 665.0955 + $bmrWeight + $bmrHeight - $bmrAge;
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
