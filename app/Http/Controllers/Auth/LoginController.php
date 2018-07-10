<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //override
    protected function authenticated($request, $user)
    {
        if($user->confirmed == false) {
            \Auth::logout();
            session()->flash('message', 'Please confirm your email first, before signing in.');
            return redirect()->back();
        }

        if($user->subscription('main')->ends_at && $user->subscription('main')->ends_at < Carbon::now()){
            \Auth::logout();
            session()->flash('message', 'Your subscription ended.');
            return redirect()->back();
        }
        
    }
}
