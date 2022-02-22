<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::prefix('category')->group( function(){
        Route::match(['post','get'],'/','CategoryController@index');
        Route::get('create','CategoryController@create');
        Route::get('create/{id}','CategoryController@create');
        Route::post('save','CategoryController@store');
        Route::post('save/{id}','CategoryController@update');
        Route::get('view/{id}','CategoryController@show');
        Route::delete('delete', 'CategoryController@destroy');
    });

    Route::prefix('subcategory')->group( function(){
        Route::match(['post','get'],'/','SubCategoryController@index');
        Route::get('create','SubCategoryController@create');
        Route::get('create/{id}','SubCategoryController@create');
        Route::post('save','SubCategoryController@store');
        Route::post('save/{id}','SubCategoryController@update');
        Route::get('view/{id}','SubCategoryController@show');
        Route::delete('delete', 'SubCategoryController@destroy');
    });
});
