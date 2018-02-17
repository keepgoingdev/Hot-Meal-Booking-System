<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function confirmation()
    {
        return view('email.confirmation');
    }
}
