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

// Protected rooutes 'isAdmin' => App\Http\Middleware\isAdmin::class,

Route::group( ['middleware' => ['admin.config','scope:admin'] ],function(){
    config(['auth.providers.users.model' => 'App\Models\Admin']); // TODO: make this line middleware
    Route::apiResource('brands', BrandsController::class);
 });
 

// Login as admin
Route::middleware('admin.model')->post('admin/login', [LoginController::class, 'Login']);


// Protected routes for only logged in admins with scop admin
Route::middleware('auth:api','scope:admin')->prefix('admin')->group(function(){
    config(['auth.providers.users.model' => 'App\Models\Admin']); // TODO: make this line middleware
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('', function(Request $request){
        return $request->user();
    });
});

// Route::prefix('v1')->group(function(){

    // Admins endpoints
    Route::apiResource('admins', AdminsController::class);
    // Admin change Password
    Route::put('admins/change-password/{admin}', [AdminsController::class, 'changePassword']);

    //Brands endpoints
    // Route::apiResource('brands', BrandsController::class);

    //Categories endpoints
    Route::apiResource('categories', CategoriesController::class);
    
    //Subcategories endpoints
    Route::apiResource('subcategories', SubcategoriesController::class);
    
    //Subsubcategories endpoints
    Route::apiResource('subsubcategories', SubsubcategoriesController::class);
    
    //Products endpoints
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('products.images', ProductImagesController::class);

// });
