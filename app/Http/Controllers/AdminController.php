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
    public function addCategory(Request $request)
    {
        $categories =Category::create([
            'name'=>$request->name,
        ]);

        // add new categories so we need to clear the cache so that our website can show fresh data
        if(Cache::has('categories'))
        {
            Cache::forget('categories');
        }

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
    public function updateCategory(Request $request,$id)
    {
        $data=[
            'name'=>$request->name
        ];

        $categories = Category::where('id',$id)->update($data);
        return response()->json(['message'=>'Category has been updated Successfully']);
    }
    public function deleteCatgory(Request $request,$id)
    {
        $categories = Category::find($id);

        if($categories)
        {
            $categories->delete();
            return response()->json(['message'=>'Category Deleted Successfull with the movies that is associated wih it'],200);
        }
        else
        {
            return response()->json(['message'=>'Document not found'],404);
        }
    }
    public function getUsers(Request $request)
    {
        if(Cache::has('users'))
        {
            $users = Cache::get('users');
        }
        else
        {
            $users = User::all();
            Cache::put('users',$users);
        }
        return response()->json($users,200);

    }
    public function getShows(Request $request)
    {
        if(Cache::has('shows'))
        {
            $shows = Cache::get('shows');
        }
        else
        {
            $shows = Show::all();
            Cache::put('shows',$shows);
        }
        return response()->json($shows,200);
    }
    public function addShows(Request $request)
    {
        $shows =Show::create([
            'category_id'       =>  $request->category_id,
            'genre'             =>  $request->genre,
            'name'              =>  $request->name,
            'duration'          =>  $request->duration,
            'country'           =>  $request->country,
            'release_date'      =>  $request->release_date,
            'longText'          =>  $request->longText,
            'seasons'           =>  $request->seasons,
            'url'               =>  $request->url,
            'poster'            =>  $request->poster,
            'imdb_rating'       =>  $request->imdb_rating,
            'rotten_tomatoes'   =>  $request->rotten_tomatoes
        ]);

        return response()->json(['message'=>'Successfully Addded'],200);
    }

    public function updateShows(Request $request,$id)
    {
        $data = [
            'category_id'       =>  $request->category_id,
            'genre'             =>  $request->genre,
            'name'              =>  $request->name,
            'duration'          =>  $request->duration,
            'country'           =>  $request->country,
            'release_date'      =>  $request->release_date,
            'longText'          =>  $request->longText,
            'seasons'           =>  $request->seasons,
            'url'               =>  $request->url,
            'poster'            =>  $request->poster,
            'imdb_rating'       =>  $request->imdb_rating,
            'rotten_tomatoes'   =>  $request->rotten_tomatoes
        ];
        $shows =Show::where('id',$id)->update($data);

        return response()->json(['message'=>'Successfully Updated the show'],200);
    }
    public function deleteShows(Request $request,$id)
    {
        $shows =Show::find($id);

        if($shows)
        {
            $shows->delete();

            return response()->json(['message'=>'Show has been deleted successfully'],200);
        }
        else{
            return response()->json(['message'=>'Show not found'],404);
        }

    }




}
