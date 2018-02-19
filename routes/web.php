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

// Confirmation email
Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::get('/users/confirmation-error', 'Auth\RegisterController@confirmationError')->name('confirmation-error');
