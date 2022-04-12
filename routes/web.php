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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('category')->group( function() {
    Route::match(['post','get'],'{id}','HomeController@showCategoryProducts');
});

Route::prefix('subcategory')->group( function() {
    Route::match(['post','get'],'{id}','HomeController@showSubCategoryProducts');
});

Route::prefix('product')->group( function() {
    Route::match(['post','get'],'{id}','HomeController@showProduct');
});

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::match(['post', 'get'], '/', 'AdminController@index');

    Route::prefix('user')->group( function(){
        Route::match(['post','get'],'/','UserController@index');
        Route::get('create','UserController@create');
        Route::get('create/{id}','UserController@create');
        Route::post('save','UserController@store');
        Route::post('save/{id}','UserController@update');
        Route::get('view/{id}','UserController@show');
        Route::delete('delete', 'UserController@destroy');
    });

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

    Route::prefix('product')->group( function(){
        Route::match(['post','get'],'/','ProductController@index');
        Route::get('create','ProductController@create');
        Route::get('create/{id}','ProductController@create');
        Route::post('save','ProductController@store');
        Route::post('save/{id}','ProductController@update');
        Route::get('view/{id}','ProductController@show');
        Route::delete('delete', 'ProductController@destroy');
    });
    
    Route::prefix('product-image')->group( function(){
        Route::match(['post','get'],'/','ProductImageController@index');
        Route::get('create','ProductImageController@create');
        Route::get('create/{id}','ProductImageController@create');
        Route::post('save/{id}','ProductImageController@store');
        Route::get('view/{id}','ProductImageController@show');
        Route::delete('delete', 'ProductImageController@destroy');
    });
});
