<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\SubsubcategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImagesController;


Route::get('/test', function(Request $request){
    return 'Authenticated';
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){

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
