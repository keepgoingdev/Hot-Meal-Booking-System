<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::sortable()->paginate(20);
        foreach($users->items() as $user) {
            $coupon = DiscountCode::where('activated_by', $user->id)
                        ->where('is_activated', 1)->first();
            $user->coupon_code = isset($coupon) ? $coupon->code : '';
            $user->subscription = isset($coupon) ? $coupon->name : '';
        }

        return view('users.index', compact('users'));
    }

    public function favoriteMeals(Request $request, $userId) {
        $user = User::find($userId);
        $favoriteMeals = \DB::table('user_favorite_meals')->where('user_id', $user->id)->select('meal_id')->get()->pluck('meal_id')->toArray();
        $favoriteMeals = \App\Models\Meal::whereIn('id', $favoriteMeals)->get();
        return view('users.fav_meals', compact('user', 'favoriteMeals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('message', 'Deleted!');
        return 'Success';
    }
}
