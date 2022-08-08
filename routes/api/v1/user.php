<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;


// Protected routes for only logged in users
Route::middleware('auth:user-api','scope:user')->get('/user', function (Request $request) {
    return $request->user();
});
// Login as user 
Route::post('/login', [LoginController::class, 'login']);
