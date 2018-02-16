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
            $bmrWeight = 13.7516 * ($data['weight-pounds'])/2.20462262;
            $bmrHeight = 5.0033 * ($data['height-feet'] * 30.48) + ($data['height-inches'] * 2.54);
            $bmrAge = 6.755 * $data['age'];
            $bmr = 66.473 + $bmrWeight + $bmrHeight - $bmrAge;

            if($bmr < 1200){
                $bmr = 1200;
            }
        }
        elseif ($data['gender'] === 'F'){
            $bmrWeight = 9.5634 * ($data['weight-pounds'])/2.20462262;
            $bmrHeight = 1.8496 * ($data['height-feet'] * 30.48) + ($data['height-inches'] * 2.54);
            $bmrAge = 4.6765 * $data['age'];
            $bmr = 665.0955 + $bmrWeight + $bmrHeight - $bmrAge;
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
