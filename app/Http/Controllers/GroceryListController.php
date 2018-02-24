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

    public function getGroceryList(Request $request, $weekPlanId)
    {
        $user = $request->user();
        $weekPlan = WeekPlan::find($weekPlanId);
        if(\Auth::id() != $weekPlan->user_id) {
            return response()->json(array('message' => 'Error'),400);
        }
        if(is_null($weekPlan)){
            return response()->json(array('message' => 'You have not planned any meals for current week'));
        }
        $groceryList = GroceryList::getCurrentList($user->id, $weekPlan);
        return response()->json($groceryList);
    }
}
