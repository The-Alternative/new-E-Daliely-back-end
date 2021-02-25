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

///BrandController


Route::group(['prefix'=> 'brands'] ,function () {


    Route::get('/',  'Brand\BrandController@getAllBrands');

    Route::get('/{id}',  'Brand\BrandController@getBrandsById');

    Route::post('/createNewBrand',  'Brand\BrandController@createNewBrands');

    Route::put('/updateBrand/{id}',  'Brand\BrandController@updateBrand');

    Route::put('/deleteBrand/{id}',  'Brand\BrandController@deleteBrand');


});





//LanguageController
Route::group(['prefix'=> 'languages'] ,function () {

    Route::get('/', 'Language\LanguageController@getAllLanguage');

    Route::get('/{id}', 'Language\LanguageController@getLanguageById');

    Route::post('/createNewLanguage', 'Language\LanguageController@createNewLanguage');

    Route::put('/updateLanguage/{id}', 'Language\LanguageController@updateLanguage');

    Route::put('/deleteLanguage/{id}', 'Language\LanguageController@deleteLanguage');
});





// StoreController
Route::group(['prefix'=>'stores'],function (){

    Route::get('/stores','Store\StoreController@getAllStore');

    Route::get('/{id}','Store\StoreController@getStoreById');

    Route::post('/createNewStores', 'Store\StoreController@createNewStores');

    Route::put('/updateStore/{id}', 'Store\StoreController@updateStore');

    Route::put('/deleteStore/{id}', 'Store\StoreController@deleteStore');
});




