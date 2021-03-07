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
/*_____________ Product routes _____________*/
Route::group(['middleware' =>'api','prefix'=>'products','namespace'=>'Product'],function(){
        Route::GET('/get','ProductsController@get');
        Route::GET('/getById/{id}','ProductsController@getById');
        Route::POST('/create','ProductsController@create');
        Route::PUT('/update/{id}','ProductsController@update');
        Route::GET('/search/{title}','ProductsController@search');
        Route::PUT('/trash/{id}','ProductsController@trash');
        Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
        Route::GET('/getTrashed','ProductsController@getTrashed');
        Route::DELETE('/delete/{id}','ProductsController@delete');
});

/*_____________Category routes_____________*/
Route::group(['middleware' =>'api','prefix'=>'categories','namespace'=>'Category'],function(){
        Route::GET('/get','CategoriesController@get');
        Route::GET('/getById/{id}','CategoriesController@getById');
        Route::POST('/create','CategoriesController@create');
        Route::PUT('/update','CategoriesController@update');
        Route::PUT('/trash/{id}','CategoriesController@trash');
        Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
        Route::GET('/search/{name}','CategoriesController@search');
        Route::GET('/getTrashed','CategoriesController@getTrashed');
        Route::DELETE('/delete/{id}','CategoriesController@delete');
});

/*------------------Brand Routes-------------------*/
Route::group(['middleware' =>'api','prefix'=> 'brands','namespace'=>'Brand'] ,function () {
    Route::get('/get',  'BrandController@get');
    Route::get('/getById/{id}',  'BrandController@getById');
    Route::get('/getTrashed','BrandController@getTrashed');
    Route::post('/create',  'BrandController@create');
    Route::put('/update/{id}',  'BrandController@update');
    Route::GET('/search/{name}','BrandController@search');
    Route::PUT('/trash/{id}','BrandController@trash');
    Route::PUT('/restoreTrashed/{id}','BrandController@restoreTrashed');
    Route::delete('/delete{id}',  'BrandController@delete');
});

/*--------------------Language Routes----------------*/
Route::group(['middleware'=>'api','prefix'=> 'languages','namespace'=>'Language'] ,function () {
    Route::get('/get', 'LanguageController@get');
    Route::get('getById/{id}', 'LanguageController@getById');
    Route::post('/create', 'LanguageController@create');
    Route::put('/update/{id}', 'LanguageController@update');
    Route::delete('/delete/{id}', 'LanguageController@delete');
    Route::get('/getTrashed', 'LanguageController@getTrashed');
    Route::PUT('/restoreTrashed/{id}', 'LanguageController@restoreTrashed');
    Route::PUT('/trash/{id}', 'LanguageController@trash');
    Route::GET('/search/{name}', 'LanguageController@search');

});

/*----------------Store Routes---------------*/
Route::group(['middleware'=>'api','prefix'=>'stores','namespace'=>'Store'],function (){
    Route::get('/get','StoreController@get');
    Route::get('/getById/{id}','StoreController@getById');
    Route::post('/create', 'StoreController@create');
    Route::put('/update/{id}', 'StoreController@update');
    Route::delete('/delete/{id}', 'StoreController@delete');
    Route::get('/getTrashed','StoreController@getTrashed');
    Route::PUT('/restoreTrashed/{id}','StoreController@restoreTrashed');
    Route::PUT('/trash/{id}','StoreController@trash');
    Route::GET('/search/{name}','StoreController@search');
});




