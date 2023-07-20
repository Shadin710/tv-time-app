<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        // $apiKey ='f740af340d50a4013c1ceadd6dac2c7c';

        return response()->json(['message'=>'success'],200);
    }
}
