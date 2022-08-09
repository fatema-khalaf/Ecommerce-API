<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;


// Protected routes for only logged in users
Route::middleware('auth:api','scope:user')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api','scope:user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);    
});
// Login as user 
Route::post('/login', [AuthController::class, 'userLogin']);
