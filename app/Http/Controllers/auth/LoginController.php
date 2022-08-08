<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $request){ // this function NOT in use
       $login =  $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if(!Auth::attempt($login)){
            return response(['message'=> 'invalid login credantials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user'=>Auth::user(), 'access_token' => $accessToken]);
    }

    public function adminLogin(Request $request){ // this function NOT in use
       $login =  $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if(!Auth::guard('admins')->attempt($login)){
            return response(['message'=> 'invalid login credantials']);
        }

        $accessToken = Auth::guard('admins')->user()->createToken('authToken')->accessToken;
        return response(['user'=>Auth::guard('admins')->user(), 'access_token' => $accessToken]);
    }

    public function logout(Request $request)
    {
         $request->user()->token()->revoke();
         return response()->json([
           'message' => 'Successfully logged out']);
    }
    
    // TODO: USE THE BELOW FUNCTION TO RECREATE OAUTH TOKENS
    // THE ISSUE WITH THIS METHOD 👇 IS IT ONLY MAKE REQUEST ON USERS TABLE 
    // I WANT IT TO MAKE REQUEST ON BOTH USERS AND ADMINS TABLES

    // public function loginWithRefreshToken(Request $request){
    //     $response = Http::asForm()->post('http://127.0.0.1:8000/oauth/token', [
    //         'grant_type' => 'password',
    //         'client_id' => '2',
    //         'client_secret' => 'IoW7K5LXOfTkBdqhg2ouNY9Cdc0n3wE8T75MUZmP',
    //         'username' => $request->email,
    //         'password' => $request->password,
    //         'scope' => '',
    //     ]);

    //     return $response;
    // }
}
