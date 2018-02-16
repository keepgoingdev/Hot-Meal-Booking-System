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

    public function uploadView()
    {
        return view('upload');
    }

    public function uploadCsv(Request $request)
    {
        $request->user();
        $file = $request->file();
        $path = ($file['file']->path());
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $stmt = (new Statement())
            ->offset(1);

        $records = $stmt->process($csv);
        $latestMeal = null;
        foreach ($records as $record) {
            if(is_numeric($record[''])) {
                $latestMeal = Meal::createMeal($record);
            }
            else{
                var_dump($latestMeal->id);
                if(!is_null($latestMeal)){
                    Condiment::createCondiment($record, $latestMeal->id);
                }
            }
        }
    }

}
