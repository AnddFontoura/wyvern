<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')->group( function(){
    Route::get('count','Api\CategoryApiController@countCategories');
});

Route::prefix('subcategories')->group( function(){
    Route::get('count','Api\SubCategoryApiController@countSubCategories');
});

Route::prefix('products')->group( function(){
    Route::get('count','Api\ProductApiController@countProducts');
    Route::get('get-by-multiple-id', 'Api\ProducApiController@getProducts');
});
