<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class ProfileContoller extends Controller
{
    //

    public function index(Request $request)
    {
        $user= User::find(Auth::user()->id);
        if($user)
        {
            return response()->json($user,200);
        }
        return response()->json(['message'=>'Something Went Wrong'],500);
    }
    public function updateProfile(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password
        ];
        $user= User::where('id',Auth::user()->id)->update($data);

        return response()->json(['message'=>'Successfully Updated Your Profile'],200);
        
        
    }
    public function deleteAccount(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user)
        {
            $user->delete();
            return response()->json(['message'=>'Account has been deleted'],204);
        }
        return response()->json(['Somthing Went Wrong'],500);
    }
}
