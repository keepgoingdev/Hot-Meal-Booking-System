<?php

namespace App\Http\Controllers\Auth;

use App\Mail\AccountConfirmation;
use App\Models\DayMenu;
use App\Models\DiscountCode;
use App\Models\WeekPlan;
use App\Plan;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first-name' => 'required|string|max:50',
            'last-name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, $formData, $goal)
    {
        return User::create([
            'first_name' => $data['first-name'],
            'last_name' => $data['last-name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender' => $formData['gender'],
            'calorie_goal' => $goal,
            'weight' => $formData['weight-pounds'],
            'height_feet' => $formData['height-feet'],
            'height_inches' => $formData['height-inches']
        ]);
    }

    protected function register(Request $request)
    {
        $dayMenus = session('dayMenus');
       // $startingDate = session('starting-date');
        $startingDate = date('Y-m-d');
        $discountCode = false;
        $input = $request->all();
        $validator = $this->validator($input);
        $plan = Plan::findOrFail($input['plan']);

        if($plan->is_discount){
            $couponCode = $input['coupon'];
            $discountCode = DiscountCode::validateCode($couponCode);
            if($discountCode->is_activated || $discountCode->plan_id != $plan->id) {

                return redirect(route('register'))->with('status', $validator->errors())->withInput();
            }
        }

        if($validator->passes()) {
            \Log::debug($request->all());
            $formData = unserialize($request->cookie('formdata'));
            \Log::debug($formData);
            $goal = $request->cookie('goal');
            $data = $this->create($input, $formData, $goal);
            $data = $data->toArray();
            $data['token'] = str_random(50);

            $user = User::find($data['id']);
            $user->confirmation_token = $data['token'];
            $user->save();

            $s = WeekPlan::storeSessionDataInTable($dayMenus, $startingDate, $goal, $formData['weight-pounds'], $user->id);
            if($discountCode){
                $discountCode->activate($user->id);
            }
            \Log::debug($plan);
            $subscription = $user->newSubscription('main', $plan->stripe_plan);
            if(!$plan->is_discount) {
             //   $subscription = $subscription->trialDays(14);
            }
            $subscription->create($request->stripeToken);

            Mail::to($data['email'])->send(new AccountConfirmation($data));

            return redirect(route('login'))->with('status', 'Confirmation email has been sent. Please check your email.');
        }
        return redirect(route('register'))->with('status', $validator->errors())->withInput();
    }

    public function confirmation($token){
        $user = User::where('confirmation_token', $token)->first();

        if(!is_null($user)){
            $user->confirmed = true;
            $user->confirmation_token = '';
            $user->save();
            return redirect(route('login'))->with('status', 'Your activation is completed');
        }
        return redirect(route('login'))->with('status', 'Token not found.');
    }

}
