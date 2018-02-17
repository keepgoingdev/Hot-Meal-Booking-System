<?php

namespace App\Http\Controllers;

use App\Models\GroceryList;
use App\Models\WeekPlan;
use Illuminate\Http\Request;

class GroceryListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getGroceryList(Request $request)
    {
        $user = $request->user();
        $weekPlan = WeekPlan::getCurrentWeekPlan($user->id);
        if(is_null($weekPlan)){
            return response()->json(array('message' => 'You have not planned any meals for current week'));
        }
        $groceryList = GroceryList::getCurrentList($user->id, $weekPlan);
        return response()->json($groceryList);
    }
}
