<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Plan;
use Braintree_ClientToken;
class StepThreeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request)
    {
        $calorieGoal = ($request->cookie('goal'));
        $calorieGoal = intval($calorieGoal);
        $discount = false;
        $plans = Plan::orderBy('cost')->get();
        $braintreeToken = Braintree_ClientToken::generate();
        return view('steps.step3', array(
                'calorieGoal' => $calorieGoal,
                'plans' => $plans,
                'discount' => $discount,
                'braintreeToken' => $braintreeToken
            )
        );
    }

    public function getMeals(Request $request){
        $calorieGoal = $request->cookie('goal');
        $dayMenus = session('dayMenus');
        if(!is_array($dayMenus)) {
            $dayMenus = [];
            $ignoredMealIds = [];
            for ($index = 0; $index < 7; $index++) {
                list($dayMenu, $ignoredMealIds) = Meal::generateMealsForOneDay($calorieGoal, $ignoredMealIds);
                $dayMenus[$index] = $dayMenu;
                if ($index % 2 === 0) {
                    $ignoredMealIds = [];
                }
            }
        }

        if(is_array($dayMenus)) {
            $request->session()->put('dayMenus', ($dayMenus));
        }
        return response()->json($dayMenus);
    }

    public function regenerateMeals(Request $request){
        $dayOfWeek = $request->input('day-of-week');
        $dayMenuName = $request->input('day-menu-name');
        $maxCalories = $request->input('max-calories');
        if(!in_array($dayMenuName, Meal::$types)){
            return response('Bad request', 400);
        }
        $isSnack = false;
        if($dayMenuName == Meal::$types[Meal::SNACKS]){
            $isSnack = true;
        }
        list($meals, $mealCalories, $ignoredMealIds) = Meal::getMealsForTimeOfDay($maxCalories, [], $isSnack);
        $dayMenus = session('dayMenus');
        if(is_array($dayMenus)) {
            $index = Meal::$indexes[$dayMenuName];

            $dayMenus[$dayOfWeek][$index]['name'] = $dayMenuName;
            $dayMenus[$dayOfWeek][$index]['calories'] = $mealCalories;
            $dayMenus[$dayOfWeek][$index]['meals'] = $meals;
            $request->session()->put('dayMenus', ($dayMenus));

        }
        return response()->json(array('meals' => $meals, 'calories' => $mealCalories));
    }

    public function saveStartingDate(Request $request){
        $startingDate = $request->input('starting-date');
        $request->session()->put('starting-date', ($startingDate));

        return response(200);
    }
}
