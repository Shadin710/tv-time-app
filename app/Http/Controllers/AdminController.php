<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Popularity;
use App\Models\Genre;
use App\Models\WatchList;
use App\Models\UserType;
use App\Models\TvTime;
use App\Models\Show;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {

        $users = Cache::remember('users',now()->addMinutes(10),function(){
            return User::all();
        });

        $categories = Cache::remember('categories',now()->addMinutes(10),function(){
            return Category::all();
        });

        $propularities = Cache::remember('propularities',now()->addMinutes(10),function(){
                return Popularity::orderBy('viewers_count','asc')->get();
        });
        $shows = Cache::remember('propularities',now()->addMinutes(10),function(){
                return Show::all();
        });

        $data = [
            'users' => $users,
            'categories' =>$categories,
            'popularities'=>$propularities,
            'shows' => $shows
        ];

        return response()->json($data,200);
    }
    public function createCategory(Request $request)
    {
        $categories =Category::create([
            'name'=>$request->name,
        ]);
        return response()->json(["message"=>'Category Created Successfully'],200);
    }
    
    public function getCategory(Request $request)
    {
        if(Cache::has('categories'))
        {
            $categories = Cache::get('categories');
        }
        else{
            $categories = Category::all();
            Cache::put('categories',$categories);
        }

        return response()->json($categories,200);
    }


}
