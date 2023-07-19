<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $client = new Client();
        $apiKey ='f740af340d50a4013c1ceadd6dac2c7c';
        $response =$client->get("https://api.themoviedb.org/3/movie/api_key=f740af340d50a4013c1ceadd6dac2c7c&language=en-US");
        $data = json_decode($response->getBody(),true);

        return response()->json($data);
    }
}
