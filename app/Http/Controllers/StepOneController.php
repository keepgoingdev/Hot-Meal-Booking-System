<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StepOneController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('steps.step1');
    }

    public function messages()
    {
        return [
            'weight-pounds.required' => 'Weight is required',
            'body.required'  => 'A message is required',
        ];
    }

    public function calculate(Request $request){
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

    protected static function calculateBMR($data){
        if($data['gender'] === 'M'){
            // 10 x weight (kg) + 6.25 x height (cm) – 5 x age (y) + 5
            $weightInKg = $data['weight-pounds'] * 0.45359237;
            $heightInCm = $data['height-feet'] * 30.48 + $data['height-inches'] * 2.54;
            $bmr = (10 * $weightInKg) + (6.25 * $heightInCm) - (5*$data['age']) + 5;
            $bmr = round($bmr) * 1.2; //1.2 is light activity.
            if($bmr < 1200){
                $bmr = 1200;
            }
        }
        elseif ($data['gender'] === 'F'){
            $weightInKg = $data['weight-pounds'] * 0.45359237;
            $heightInCm = $data['height-feet'] * 30.48 + $data['height-inches'] * 2.54;
            $bmr = (10 * $weightInKg) + (6.25 * $heightInCm) - (5*$data['age']) - 161;
            $bmr = round($bmr) * 1.2; //1.2 is light activity.
            if($bmr < 1000){
                $bmr = 1000;
            }
        }
        else{
            # should not happen
            $bmr = 1500;
        }
        return $bmr;
    }
}
