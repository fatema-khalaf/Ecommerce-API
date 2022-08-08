<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\SubsubcategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AdminsController;


// Protected routes for only logged in users
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Login as user 
Route::post('/login', [LoginController::class, 'login']);

// Login as admin
Route::post('admin/login', [LoginController::class, 'adminLogin']);

// Protected routes for only logged in admins
Route::middleware('auth:api-admins')->prefix('admin')->group(function(){
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('', function(Request $request){
        return $request->user();
    });
});




Route::prefix('v1')->group(function(){

    // Admins endpoints
    Route::apiResource('admins', AdminsController::class);
    // Admin change Password
    Route::put('admins/change-password/{admin}', [AdminsController::class, 'changePassword']);

    //Brands endpoints
    Route::apiResource('brands', BrandsController::class);

    //Categories endpoints
    Route::apiResource('categories', CategoriesController::class);
    
    //Subcategories endpoints
    Route::apiResource('subcategories', SubcategoriesController::class);
    
    //Subsubcategories endpoints
    Route::apiResource('subsubcategories', SubsubcategoriesController::class);
    
    //Products endpoints
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('products.images', ProductImagesController::class);

});
