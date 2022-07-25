<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function(){

    //Brands endpoints
    Route::apiResource('brands', BrandsController::class);

    //Categories endpoints
    //get categories with subcategories
    // TODO: create nested routes instead of this 👇 route ex: Route::resource('category.subs', CategoriesSubsController::class);
    Route::get('categories/{subcategories?}', [CategoriesController::class, 'index']);
    Route::apiResource('categories', CategoriesController::class);
    
    //Subcategories endpoints
    Route::apiResource('subcategories', SubcategoriesController::class);
});
