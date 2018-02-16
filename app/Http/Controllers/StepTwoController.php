<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SessionService;

class StepTwoController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request)
    {
        $calorieGoal = ($request->cookie('bmr'));
        $formdata = unserialize($request->cookie('formdata'));
        $calorieGoal = intval($calorieGoal);

        return view('steps.step2', array(
                'calorieGoal' => $calorieGoal,
                'gender' => $formdata['gender']
            )
        );
    }

    public function storeCalorieGoal(Request $request){
        $calorieGoal = $request->input('goal');
        return response('OK')->cookie('goal' , $calorieGoal , 120);
    }

    public function generate(Request $request){
        $this->validate($request, [
            'gender' => 'required|not_in:0',
            'age' => 'required|numeric',
            'weight-pounds' => 'required|numeric',
            'height-feet' => 'required|numeric',
            'height-inches' => 'required|numeric',
        ]);
        $formdata = $request->all();
        $bmr = self::calculateBMR($formdata);
        return redirect('/step-two')->cookie('bmr', $bmr, 120)->cookie('formdata', serialize($formdata), 120);
    }
}
