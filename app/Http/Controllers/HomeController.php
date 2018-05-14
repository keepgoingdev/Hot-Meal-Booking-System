<?php

namespace App\Http\Controllers;

use App\Models\Condiment;
use App\Models\Meal;
use App\Plan;
use Illuminate\Http\Request;

use Mail;
use App\Mail\ContactMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('is_discount', false)
            ->where('show_on_homepage', true)
            ->orderBy('month')
            ->get();

        return view('welcome', [
            'plans' => $plans
        ]);
    }
    
    public function contact(Request $request) {
        $validator = \Validator::make($request->all(), [
        	'firstname' => 'required',
        	'lastname' => 'required',
        	'email' => 'required',
        	'phone' => 'required',
        	'issue' => 'required',
        	'message' => 'required',
        ]);
        if($validator->fails()) {
          return redirect()->back();
        }
        Mail::to('hello@thehotmeal.com')->send(new ContactMail($request->all()));
        session()->flash('message', 'Sent!');
	return redirect()->back();
    }


}
