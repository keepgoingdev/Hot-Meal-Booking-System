<?php

namespace App\Http\Controllers;

use App\DailyAdditional;
use App\Models\DayMenu;
use App\Models\Meal;
use App\Models\WeekPlan;
use Faker\Provider\cs_CZ\DateTime;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myProfile($weekId = null)
    {
        $user = Auth::user();
        $format = 'd F Y';
        $date = date($format, time());
        if ($weekId == null) {
            $weekPlan = $user->currentWeekPlan();
        } else {
            $weekPlan = WeekPlan::find($weekId);
            if ($weekPlan->user_id != Auth::id()) {
                return back();
            }
        }

        if (isset($weekPlan)) {
            return view('profile.my_profile', array(
                'user' => $user,
                'date' => $date,
                'weekPlan' => $weekPlan,
                'startDate' => $weekPlan->start_date,
                'weekPlanId' => $weekPlan->id));
        } else {
            return view('profile.add_new_week');
        }
    }

    public function dayView($weekPlanId, $dayIndex)
    {
        $user = Auth::user();
        $format = 'd F Y';
        $date = date($format, time());
        $weekPlan = WeekPlan::find($weekPlanId);

        if (is_null($weekPlan) || $dayIndex > 7) {
            return response('Bad request', 400);
        }
        if ($weekPlan->user_id !== $user->id) {
            return response('Unauthorized', 401);
        }
        return view('profile.day_view', array(
            'user' => $user,
            'date' => $date));
    }

    public function addNewWeek()
    {
        return view('profile.add_new_week');
    }

    public function freshPicks()
    {
        return view('profile.fresh_picks');
    }

    public function favoriteMeals()
    {
        $user = Auth::user();
        $favoriteMeals = \DB::table('user_favorite_meals')->where('user_id', $user->id)->select('meal_id')->get()->pluck('meal_id')->toArray();
        $favoriteMeals = \App\Models\Meal::whereIn('id', $favoriteMeals)->get();
        return view('profile.fav_meals', compact('user', 'favoriteMeals'));
    }

    public function bannedMeals()
    {
        $user = Auth::user();
        $bannedMeals = $user->bannedMeals()->get();
        return view('profile.banned_meals', compact('user', 'bannedMeals'));
    }

    public function allWeeks()
    {
        $allweeks = WeekPlan::where('user_id', Auth::id())->orderBy('end_date', 'desc')->get();
        return view('profile.all_weeks', compact('allweeks'));
    }


    public function getMealsForNewWeek(Request $request)
    {
        $latestWeek = Auth::user()->latestWeekPlan();
        $validator = \Validator::make($request->all(), [
            'weight' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return back();
        }
        $user = Auth::user();
        $user->weight = $request->weight;
        $user->save();
        if (isset($latestWeek)) {
            $date = new \DateTime($latestWeek->end_date);
            $date2 = new \DateTime($latestWeek->end_date);
            $startOfNewWeek = $date->modify('+1 day');
            $endOfNewWeek = $date2->modify('+7 days');
        } else {
            $date = new \DateTime();
            $date2 = new \DateTime();
            $startOfNewWeek = $date;
            $endOfNewWeek = $date2->modify('+6 days');
        }


        $goal = $user->fresh()->calculateBMR() + (int)$request->lose;
        if ($goal < 1000 && $user->gender == 'F') {
            $goal = 1000;
        }
        if ($goal < 1200 && $user->gender == 'M') {
            $goal = 1200;
        }
        $newWeek = WeekPlan::create([
            'user_id' => Auth::id(),
            'start_date' => $startOfNewWeek,
            'end_date' => $endOfNewWeek,
            'calory_goal' => $goal,
            'weight' => $request->weight
        ]);

        $calorieGoal = $newWeek->calory_goal;

        $dayMenus = [];
        $ignoredMealIds = [];
        for ($index = 0; $index < 7; $index++) {
            list($dayMenu, $ignoredMealIds) = Meal::generateMealsForOneDay($goal, $ignoredMealIds);
            $dayMenus[$index] = $dayMenu;
            if ($index % 2 === 0) {
                $ignoredMealIds = [];
            }
        }

        foreach ($dayMenus as $index => $dayMenu) {
            DailyAdditional::create([
                'week_plan_id' => $newWeek->id,
                'day' => $index
            ]);
            DayMenu::addNewMenuFromSession($dayMenu, $index, $newWeek->id);
        }
        return redirect('/home/' . $newWeek->id);


    }

    //regenerate meals for logged in users
    public function getNewMeals(Request $request)
    {
        $dayOfWeek = $request->input('day');
        $dayMenuName = $request->input('mealType');
        $weekPlanId = $request->input('weekPlanId');
        $weekPlan = WeekPlan::find($weekPlanId);
        if (!in_array($dayMenuName, Meal::$types)) {
            return response('Bad request', 400);
        }
        #$alreadyAte = DailyAdditional::where('week_plan_id', $weekPlanId)->where('day', $dayOfWeek)->first();
        $bannedMealIds = \Auth::user()->bannedMeals->pluck('id')->toArray();
        $otherMeals = DayMenu::where('week_plan_id', $weekPlanId)
            ->where('day', $dayOfWeek)
            ->where('time_of_day', '=', $dayMenuName)
            ->whereNotIn('meal_id', $bannedMealIds)
            ->select('meal_id')->get()->pluck('meal_id')->toArray();

        $maxCalories = Meal::whereIn('id', $otherMeals)->sum('calories');

        list($meals, $mealCalories, $ignoredMealIds) = Meal::getMealsForTimeOfDay($maxCalories + 5, $otherMeals, Meal::$indexes[$dayMenuName]);
        \Log::info('regen - current cal is ' . $mealCalories . ' - min is - ' . $maxCalories);

        $triedTimes = 0;
        while ($mealCalories < $maxCalories && $triedTimes <= 10) {
            list($meals, $mealCalories, $ignoredMealIds) = Meal::getMealsForTimeOfDay($maxCalories + 5, $otherMeals, Meal::$indexes[$dayMenuName]);
            $triedTimes++;
            \Log::info($triedTimes . ' attempt - regen current cal is ' . $mealCalories . ' - min is - ' . $maxCalories);
        }
        $dayMenus = DayMenu::where('day', $dayOfWeek)->where('time_of_day', $dayMenuName)->where('week_plan_id', $weekPlanId)->delete();
        foreach ($meals as $meal) {
            DayMenu::create([
                'week_plan_id' => $weekPlanId,
                'meal_id' => $meal['id'],
                'day' => $dayOfWeek,
                'time_of_day' => $dayMenuName
            ]);
        }

        return response()->json(array('meals' => $meals, 'calories' => $mealCalories));
    }

    public function mealCompleted($mealId, $weekPlanId, $day)
    {
        $meal = DayMenu::with('meal')->where('meal_id', $mealId)->where('week_plan_id', $weekPlanId)->where('day', $day)->first();
        $completed = !$meal->meal_completed;
        $meal->update(['meal_completed' => $completed]);
        $f = DailyAdditional::where('week_plan_id', $weekPlanId)->where('day', $day)->first();
        //dd($f);
        if ($completed) {
            $f->completed_sum += $meal->meal->calories;
            $f->save();
        } else {
            $f->completed_sum -= $meal->meal->calories;
            $f->save();
        }

        return response($meal);
    }

    public function addAdditional(Request $request, $weekPlanId, $day)
    {
        $f = DailyAdditional::where('week_plan_id', $weekPlanId)->where('day', $day)->first();
        if ($f) {
            $f->additional = $request->additional;
            $f->save();
            return response(200);
        }
    }

    public function addExercise(Request $request, $weekPlanId, $day)
    {
        $f = DailyAdditional::where('week_plan_id', $weekPlanId)->where('day', $day)->first();
        if ($f) {
            $f->exercise = $request->exercise;
            $f->save();
            return response(200);
        }
    }

    public function getMealsByDayIndex($weekPlanId)
    {
        $user = Auth::user();
        $weekPlan = WeekPlan::find($weekPlanId);

        if (is_null($weekPlan)) {
            return response('Bad request', 400);
        }
        if ($weekPlan->user_id != $user->id) {
            return response('Unauthorized', 401);
        }
        foreach ($weekPlan->dayMenus->groupBy('day') as $dayMenu) {
            $day = $dayMenu[0]['day'];
            $responseMenu[$day][Meal::BREAKFAST]['name'] = 'Breakfast';
            $responseMenu[$day][Meal::BREAKFAST]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Breakfast')->pluck('meal_id'), $weekPlan->id, $day);
            $responseMenu[$day][Meal::BREAKFAST]['calories'] = $responseMenu[$day][Meal::BREAKFAST]['meals']->sum('calories');
            $responseMenu[$day][Meal::LUNCH]['name'] = 'Lunch';
            $responseMenu[$day][Meal::LUNCH]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Lunch')->pluck('meal_id'), $weekPlan->id, $day);
            $responseMenu[$day][Meal::LUNCH]['calories'] = $responseMenu[$day][Meal::LUNCH]['meals']->sum('calories');
            $responseMenu[$day][Meal::DINNER]['name'] = 'Dinner';
            $responseMenu[$day][Meal::DINNER]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Dinner')->pluck('meal_id'), $weekPlan->id, $day);
            $responseMenu[$day][Meal::DINNER]['calories'] = $responseMenu[$day][Meal::DINNER]['meals']->sum('calories');
            $responseMenu[$day][Meal::SNACKS]['name'] = 'Snacks';
            $responseMenu[$day][Meal::SNACKS]['meals'] = Meal::getMealByIds($dayMenu->where('time_of_day', 'Snacks')->pluck('meal_id'), $weekPlan->id, $day);
            $responseMenu[$day][Meal::SNACKS]['calories'] = $responseMenu[$day][Meal::SNACKS]['meals']->sum('calories');
            // $allMealsForDay = DayMenu::where('week_plan_id', $weekPlan->id)->where('day', $day)->where('meal_completed', true)->select('meal_id')->pluck('meal_id')->toArray();
            $additional = DailyAdditional::where('week_plan_id', $weekPlan->id)->where('day', $day)->first();
            $responseMenu[$day]['totalcalories'] = $additional->completed_sum;
            $responseMenu[$day]['exercise'] = $additional->exercise;
            $responseMenu[$day]['additional'] = $additional->additional;
        }
        return response()->json($responseMenu);
    }

    public function accountSettings()
    {
        $user = Auth::user();
        $isGrace = false;
        if ($user->subscription('main') && $user->subscription('main')->onGracePeriod()) {
            $isGrace = true;
        }

        $subscription = null;
        try {
            $subscription = $user->subscription('main') ? $user->subscription('main')->asStripeSubscription() : null;
        } catch (\Exception $exception) {
            \Log::error($exception);
        }


        return view('profile.account_settings', array(
            'subscription' => $subscription,
            'user' => $user,
            'isGrace' => $isGrace));
    }

    public function updateUserData()
    {
        $request = request();
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'old_password' => 'nullable|string|min:5',
            'password' => 'nullable|required_with:old_password|string|min:5',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        if ($request->has('old_password')) {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                $validator->errors()->add('old_password', 'You did not type in the correct old password');
                return redirect()->back();

            }
            $user->password = \Hash::make($request->password);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        session()->flash('message', 'You have updated your details.');
        return redirect()->back();
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
        return view('profile.subscription_info', array(
            'subscription' => $subscription,
            'user' => $user,
            'isGrace' => $isGrace));
    }


    public function markMealAsFavorite($id)
    {
        Auth::user()->favoriteMeals()->toggle($id);
        return response()->json(['message' => 'OK!'], 200);
    }

    public function banMeal($id)
    {
        Auth::user()->bannedMeals()->toggle($id);
        return response()->json(['message' => 'OK!'], 200);
    }

    public function cancelSubscription()
    {
        $user = Auth::user();
        if (!$user->subscription('main')->onGracePeriod()) {
            $user->subscription('main')->cancel();
        }
        return redirect()->back();
    }

    public function resumeSubscription()
    {
        $user = Auth::user();

        try {
            if ($user->subscription('main')->onGracePeriod()) {
                $user->subscription('main')->resume();
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $this->setFlashMessage('danger', 'There was en error while processing. TheHotMeal team has been notified.');
        }

        return redirect()->back();
    }

    public function groceryList($weekPlanId)
    {

        $weekPlan = WeekPlan::find($weekPlanId);
        if (\Auth::id() != $weekPlan->user_id) {
            return response()->json(array('message' => 'Error'), 400);
        }
        if (is_null($weekPlan)) {
            return response()->json(array('message' => 'You have not planned any meals for current week'));
        }

        $mealIds = [];
        $count = [];
        $banned = [];
        $banned = \Auth::user()->bannedMeals->pluck('id')->toArray();
        $meals = \App\Models\DayMenu::where('week_plan_id', $weekPlanId)->whereNotIn('meal_id', $banned)->select(\DB::raw('meal_id, COUNT(meal_id) as mc'))->groupBy('meal_id')->orderBy('mc', 'DESC')->get();
        //dd($meals);
        foreach ($meals as $m) {
            $mealIds[] = $m->meal_id;
            $count[$m->meal_id] = $m->mc;
        }
        $groceryList = \App\Models\Meal::whereIn('id', $mealIds)->get();
        foreach ($groceryList as &$g) {
            $g->quantity = $count[$g->id];
        }
        $groceryList = $groceryList->sortByDesc('quantity');
        return view('profile.grocery_list', compact('groceryList', 'count'));
    }
}
