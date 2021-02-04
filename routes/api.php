<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::group(['middleware' =>'api','prefix'=>'products','namespace'=>'Product'],function(){
        Route::GET('/get/{id?}','ProductsController@get');
        Route::POST('/create','ProductsController@create');
        Route::PUT('/update','ProductsController@update');
        Route::GET('/search/{name}','ProductsController@search');
        Route::DELETE('/delete/{id}','ProductsController@delete');

});


Route::group(['middleware' =>'api','prefix'=>'categories','namespace'=>'Category'],function(){
        Route::GET('/get/{id?}','CategoriesController@getCategories');
        Route::POST('/create','CategoriesController@createNewCategory');
        Route::PUT('/update','CategoriesController@update');
        Route::GET('/search/{name}','CategoriesController@search');
        Route::DELETE('/delete/{id}','CategoriesController@delete');

});




