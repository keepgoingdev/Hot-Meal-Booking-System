<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function(){

});

Route::post('/calorie-goal', 'StepTwoController@storeCalorieGoal');
Route::get('meals', 'StepThreeController@getMeals');
Route::post('meal-completed/{mealId}/{weekPlanId}/{day}', 'ProfileController@mealCompleted');
Route::post('add-additional/{weekPlanId}/{day}', 'ProfileController@addAdditional');
Route::post('add-exercise/{weekPlanId}/{day}', 'ProfileController@addExercise');
Route::post('get-new-meals', 'ProfileController@getNewMeals');
Route::post('regenerate-meals', 'StepThreeController@regenerateMeals');
Route::post('starting-date', 'StepThreeController@saveStartingDate');
Route::get('validate-coupon', 'StepFiveController@ValidateCoupon');
Route::get('grocery-list', 'GroceryListController@getGroceryList');
Route::get('week-plans/{weekPlanId}', 'ProfileController@getMealsByDayIndex');
Route::post('mark-meal-as-favorite/{meal}', 'ProfileController@markMealAsFavorite');
Route::get('cancel-subscription', 'ProfileController@cancelSubscription');
Route::get('resume-subscription', 'ProfileController@resumeSubscription');

