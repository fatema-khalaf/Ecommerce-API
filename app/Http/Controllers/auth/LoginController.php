<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function Login(Request $request){
        try{
            $request->request->add([
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'IoW7K5LXOfTkBdqhg2ouNY9Cdc0n3wE8T75MUZmP',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => $request->scope_name ? $request->scope_name : 'user',
            ]);
    
            $tokenRequest = $request->create(
                'http://127.0.0.1:8000/oauth/token', //TODO: make this line dynamic
                'post'
            );
            
            $instance = \Route::dispatch($tokenRequest);
    
            return json_decode($instance->getContent());
        }
        catch(Exception $e){
           return response($e);
        }

    }

    public function logout(Request $request)
    {
         $request->user()->token()->revoke();
         return response()->json([
           'message' => 'Successfully logged out']);
    }

    // This function not in use 👇👇 This return personal access token without refresh token
    // public function adminLogin(Request $request){
    //    $login =  $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     if(!Auth::guard('admins')->attempt($login)){
    //         return response(['message'=> 'invalid login credantials']);
    //     }

    //     $accessToken = Auth::guard('admins')->user()->createToken('authToken',['admin'])->accessToken;
    //     return response(['user'=>Auth::guard('admins')->user(), 'access_token' => $accessToken]);
    // }
     
}
