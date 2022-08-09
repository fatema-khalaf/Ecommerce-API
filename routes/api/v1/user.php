<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;


// Protected routes for only logged in users
Route::middleware('auth:api','scope:user')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api','scope:user')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);    
});
// Login as user 
Route::post('/login', [LoginController::class, 'userLogin']);
