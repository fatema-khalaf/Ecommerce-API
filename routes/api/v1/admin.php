<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\SubsubcategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\AdminsController;

// Login as admin
// Access and refresh tokens
// Route::middleware('admin.model')->post('admin/login', [AuthController::class, 'Login']);

// Personal access token
Route::post('admin/login', [AuthController::class, 'adminLogin']);


// Protected routes for only logged in admins with scop admin
Route::middleware('auth:api-admins','scope:admin')->group(function(){
    Route::get('admin',function (Request $request) {
        return $request->user();
    });
    // Admins endpoints
    Route::apiResource('admins', AdminsController::class);
    // Admin change Password
    Route::put('admins/change-password/{admin}', [AdminsController::class, 'changePassword']);
    // Admin logout
    Route::post('admin/logout', [AuthController::class, 'logout']);    
    
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
    
    