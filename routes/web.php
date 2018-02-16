<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Mail\AccountConfirmation;
use App\User;

Auth::routes();

// Upload
Route::get('/upload', 'HomeController@uploadView');

// Plans routes
Route::get('/plans', 'PlansController@index');
// Braintree
Route::get('/braintree/token', 'BraintreeTokenController@token');

Route::group(['middleware' => 'auth'], function () {
    Route::get('grocery-list', 'ProfileController@groceryList');
    Route::get('/plans/{plan}', 'PlansController@show');
});

Route::get('/', 'HomeController@index')->name('home');

 // Steps
Route::get('/step-one', 'StepOneController@index')->name('step-one');
Route::post('/calculate', 'StepOneController@calculate')->name('calculate');
Route::get('/step-two', 'StepTwoController@index')->name('step-two');
Route::post('/generate', 'StepTwoController@generate')->name('generate');
Route::get('/step-three', 'StepThreeController@index')->name('step-three');
Route::get('/step-four', 'GroceryListController@index')->name('step-four');

// User is authenticated and has a paid subscription
Route::group(['middleware' => ['auth', 'has-paid']], function () {
    // Profile
    Route::get('/home', 'ProfileController@myProfile')->name('my-profile');
    Route::get('/week-plans/{weekPlanId}/days/{index}', 'ProfileController@dayView')->name('day-view');
    // Account
    Route::get('/update-user-data', 'ProfileController@updateUserData')->name('update-user-data');
    Route::get('/account-settings', 'ProfileController@accountSettings')->name('account-settings');
    Route::get('/subscription-info', 'ProfileController@subscriptionInfo')->name('subscription-info');
});

// Register
Route::get('/register', 'StepFiveController@index')->name('register');

// Confirmation email
Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::get('/users/confirmation-error', 'Auth\RegisterController@confirmationError')->name('confirmation-error');
