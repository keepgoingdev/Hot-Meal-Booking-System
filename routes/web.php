<?php

Auth::routes();

// Upload
Route::get('/upload', 'HomeController@uploadView');
Route::get('/braintree/token', 'BraintreeTokenController@token');
// Register
Route::get('/register', 'StepFiveController@index')->name('register');


Route::get('/', 'HomeController@index')->name('home');

 // Steps
Route::get('/step-one', 'StepOneController@index')->name('step-one');
Route::post('/calculate', 'StepOneController@calculate')->name('calculate');
Route::get('/step-two', 'StepTwoController@index')->name('step-two');
Route::post('/generate', 'StepTwoController@generate')->name('generate');
Route::get('/step-three', 'StepThreeController@index')->name('step-three');
Route::get('/step-four', 'GroceryListController@index')->name('step-four');

// Account
Route::group(['middleware' => 'auth'], function () {
    Route::post('/update-user-data', 'ProfileController@updateUserData')->name('update-user-data');
    Route::get('/account-settings', 'ProfileController@accountSettings')->name('account-settings');
});

// User is authenticated and has a paid subscription
Route::group(['middleware' => ['auth', 'has-paid']], function () {
    Route::get('/home/all-weeks', 'ProfileController@allWeeks')->name('my-profile');
    Route::get('/home/{weekId?}', 'ProfileController@myProfile')->name('my-profile');
    Route::get('/week-plans/{weekPlanId}/days/{index}', 'ProfileController@dayView')->name('day-view');
    Route::get('grocery-list', 'ProfileController@groceryList');
    Route::get('add-new-week', 'ProfileController@addNewWeek');
    Route::post('add-new-week', 'ProfileController@getMealsForNewWeek');
});


//Admin stuff
Route::group(['middleware' => ['auth', 'is-admin']], function () {
    Route::resource('admin/meals', 'MealController');
});

Route::group(['prefix' => 'api'], function() {
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
});






// Confirmation email
Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::get('/users/confirmation-error', 'Auth\RegisterController@confirmationError')->name('confirmation-error');
