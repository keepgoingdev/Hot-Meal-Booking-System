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
        return $this->latestWeekPlan()->calory_goal;
    }

    public function latestWeekPlan(){
        $date = $startDate = date('Y-m-d', time());

        return $this->hasMany('App\Models\WeekPlan')
            ->where('end_date', '>=', $date)
            ->orderBy('end_date', 'asc')
            ->first();
    }
    public function favoriteMeals() {
        return $this->belongsToMany('\App\Models\Meal', 'user_favorite_meals', 'user_id', 'meal_id');
    }

}
