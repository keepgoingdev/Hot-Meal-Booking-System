<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroceryList extends Model
{
    protected $fillable = [
        'user_id', 'week_plan_id', 'meal_id', 'quantity'
    ];
    protected $hidden = [
        'id', 'user_id', 'week_plan_id', 'meal_id'
    ];

    public function meal(){
        return $this->hasOne('App\Models\Meal', 'id', 'meal_id');
    }

    public static function getCurrentList($userId, $weekPlan)
    {
        $groceryList = self::where('user_id', $userId)
            ->where('week_plan_id', $weekPlan->id)
            ->with('meal')
            ->orderBy('quantity', 'desc')
            ->get();

        if (count($groceryList) < 1) {
            self::generateGroceryList($userId, $weekPlan);
        }

        return self::where('user_id', $userId)
            ->where('week_plan_id', $weekPlan->id)
            ->with('meal')
            ->orderBy('quantity', 'desc')
            ->get();

    }

    public static function generateGroceryList($userId, $weekPlan)
    {
        $dayMenus = $weekPlan->dayMenus()->get();
        foreach ($dayMenus as $dayMenu) {
            self::addMealToList($userId, $weekPlan->id, $dayMenu->meal_id);
        }
    }

    private static function addMealToList($userId, $weekPlanId, $mealId)
    {
        $listItem = self::firstOrNew(array(
            'user_id' => $userId,
            'week_plan_id' => $weekPlanId,
            'meal_id' => $mealId));

        $listItem->quantity = $listItem->quantity + 1;
        $listItem->save();
    }
}
