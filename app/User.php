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

    public function latestWeekPlan(){
        $date = $startDate = date('Y-m-d', time());

        return $this->hasMany('App\Models\WeekPlan')
            ->where('end_date', '>=', $date)
            ->orderBy('end_date', 'asc')
            ->first();
    }
}
