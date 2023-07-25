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
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $shows = Cache::remember('shows', now()->addMinutes(30),function(){
            return Show::all();
        });
        $latest_shows = Cache::remember('latest_shows',now()->addMinutes(30),function(){
            return Show::orderBy('updated_at','desc')->take(10)->get();
        });
        $categories = Cache::remember('categories',now()->addMinutes(300),function(){
            return Category::all();
        });
        $genre = Cache::remember('genre',now()->addMinutes(300),function(){
            return Genre::all();
        });
        
        $data =[
            'shows'         =>  $shows,
            'latest_shows'  =>  $latest_shows,
            'categories'    =>  $categories,
            'genre'         =>  $genre,
        ];
        return response()->json($data,200);
    }

    public function search(Request $request)
    {
        $search_keyword = $request->search_keyword;

        $result = Show::where('name','like','%',$search_keyword,'%')
                    ->orWhere('genre','like','%',$search_keyword,'%')->get();

        if($result)
        {
            return response()->json($result,200);
        }
        return response()->json(['message'=>'Not Found'],404);
    }

    // needs to be fixed
    public function filter(Request $request)
    {
        
        if(Cache::has('categories'))
        {
            $categories = Cache::get('categories');
            $shows = $categories->where('id',$request->id)->shows->get();
        }
        else
        {
            // needs to be modified for filtered search
            $shows = Category::with('shows')->get();
        }
        return response()->json($shows,200);
    }

    public function showsDetailts(Request $request,$id)
    {
        $shows = Show::find($id);

        if($shows)
        {
            return response()->json($shows,200);
        }
        return response()->json(['message'=>'Not Found'],404);
    }

}
