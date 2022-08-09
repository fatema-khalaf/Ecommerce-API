<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AuthController extends Controller
{
    // This function 👇👇 returns personal access token without refresh token
    // Login Admin
    public function adminLogin(Request $request){
       $login =  $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if(!Auth::guard('admins')->attempt($login)){
            return response(['message'=> 'Invalid Email or Password'], 422);
        }

        $Token = Auth::guard('admins')->user()->createToken('authToken',['admin']);
        
        // if ($request->remember_me){
        //     $Token->expires_at = Carbon::now()->addWeeks(1);
        // }
        
        $accessToken = $Token->accessToken;

        return response(['user'=>Auth::guard('admins')->user(), 'access_token' => $accessToken]);
    }

    // Login user
    public function userLogin(Request $request){
        $login =  $request->validate([
             'email' => 'required',
             'password' => 'required'
         ]);
         if(!Auth::attempt($login)){
             return response(['message'=> 'Invalid Email or Password']);
         }
 
         $accessToken = Auth::user()->createToken('authToken',['user'])->accessToken;
         return response(['user'=>Auth::user(), 'access_token' => $accessToken]);
    }

    // Logout user and admins
    public function logout(Request $request)
    {
        //  $request->user()->token()->revoke();
         $request->user()->token()->delete();
         return response()->json([
           'message' => 'Successfully logged out']);
    }


    
    // This function not in use 👇👇 This return  access token with refresh token
    // The problem with this function is I need to change config users model from App/Models/User to App/Models/Admin each time
    // public function Login(Request $request){
    //     try{
    //         $request->request->add([
    //             'grant_type' => 'password',
    //             'client_id' => '2',
    //             'client_secret' => 'IoW7K5LXOfTkBdqhg2ouNY9Cdc0n3wE8T75MUZmP',
    //             'username' => $request->email,
    //             'password' => $request->password,
    //             'scope' => $request->scope_name ? $request->scope_name : 'user',
    //         ]);
    
    //         $tokenRequest = $request->create(
    //             'http://127.0.0.1:8000/oauth/token', //TODO: make this line dynamic
    //             'post'
    //         );
            
    //         $instance = \Route::dispatch($tokenRequest);
    
    //         return json_decode($instance->getContent());
    //     }
    //     catch(Exception $e){
    //        return response($e);
    //     }

    // }
     
}
