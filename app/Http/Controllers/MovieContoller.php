<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TvTime;

class MovieContoller extends Controller
{
    //

    //index will get every movie that an user has watched or he/she is watching right now
    public function index(Request $request)
    {
    }

    //will get every popular movies based on user rating in the website
    public function popularShows(Request $request)
    {

    }

    //adds users liked movies
    public function addLikedShows(Request $request)
    {

    }
    //will store the liked movies in user profile and show it to the user
    public function userLikedShows(Request $request)
    {

    }
    public function dislikedShows(Request $request)
    {

    }


    //add watchlists for users
    public function addWatchlist(Request $request)
    {

    }
    //will get the watchlist of user
    public function watchList(Request $request)
    {

    }

    //deletes shows from watch lists
    public function deletedShowsWatchList(Request $request)
    {

    }


    //will store the on demand time of the user movies
    public function addTvTime(Request $request)
    {

    }

    //deletes movies from users already watched movies
    public function deletedShowsTvTime(Request $request)
    {

    }


}
