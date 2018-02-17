<?php

namespace App\Http\Controllers;

use App\Models\Condiment;
use App\Models\Meal;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;

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
        return view('welcome');
    }


}
