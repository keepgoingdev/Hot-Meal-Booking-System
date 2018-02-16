<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\WeekPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myProfile()
    {
        $user = Auth::user();
        $format = 'd F Y';
        $date = date($format, time());
        $weekPlan = $user->latestWeekPlan();

        return view('profile.my_profile', array(
            'user' => $user,
            'date' => $date,
            'startDate' => $weekPlan->start_date,
            'weekPlanId' => $weekPlan->id));
    }

    public function dayView($weekPlanId, $dayIndex)
    {
        $user = Auth::user();
        $format = 'd F Y';
        $date = date($format, time());
        $weekPlan = WeekPlan::find($weekPlanId);

        if(is_null($weekPlan) || $dayIndex > 7){
            return response('Bad request', 400);
        }
        if($weekPlan->user_id !== $user->id){
            return response('Unauthorized', 401);
        }
        return view('profile.day_view', array(
            'user' => $user,
            'date' => $date));
    }

    public function getMealsByDayIndex($weekPlanId, $dayIndex){
        $user = Auth::user();
        $weekPlan = WeekPlan::find($weekPlanId);

        if(is_null($weekPlan) || $dayIndex > 7){
            return response('Bad request', 400);
        }
        if($weekPlan->user_id !== $user->id){
            return response('Unauthorized', 401);
        }
        $dayMenu = $weekPlan->dayMenu($dayIndex);
        $responseMenu[Meal::BREAKFAST]['name'] = 'Breakfast';
        $responseMenu[Meal::BREAKFAST]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Breakfast')->pluck('meal_id'));
        $responseMenu[Meal::BREAKFAST]['calories'] = $responseMenu[Meal::BREAKFAST]['meals']->sum('calories');

        $responseMenu[Meal::LUNCH]['name'] = 'Lunch';
        $responseMenu[Meal::LUNCH]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Lunch')->pluck('meal_id'));
        $responseMenu[Meal::LUNCH]['calories'] = $responseMenu[Meal::LUNCH]['meals']->sum('calories');

        $responseMenu[Meal::DINNER]['name'] = 'Dinner';
        $responseMenu[Meal::DINNER]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Dinner')->pluck('meal_id'));
        $responseMenu[Meal::DINNER]['calories'] = $responseMenu[Meal::DINNER]['meals']->sum('calories');

        return response()->json($responseMenu);
    }

    public function accountSettings()
    {
        $user = Auth::user();
        return view('profile.account_settings',array(
            'user' => $user));
    }

    public function subscriptionInfo()
    {
        $user = Auth::user();
        $isGrace = false;
        if ($user->subscription('main')->onGracePeriod()) {
            $isGrace = true;
        }
            $subscription = $user->subscription('main')->asBraintreeSubscription();
//         = ($subscription->nextBillingDate->format('d F Y'));
        return view('profile.subscription_info',array(
            'subscription' => $subscription,
            'user' => $user,
            'isGrace' => $isGrace));
    }

    public function cancelSubscription(){
        $user = Auth::user();
        if (!$user->subscription('main')->onGracePeriod()) {
            $user->subscription('main')->cancel();
        }
        return Redirect('subscription-info');
    }

    public function groceryList()
    {
        return view('profile.grocery_list');
    }
}
