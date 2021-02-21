<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Product;




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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::GET('/products/getAllProducts','App\Http\Controllers\Product\ProductsController@getAllProducts');




///BrandController

Route::group(['prefix'=> 'brands'] ,function () {


    Route::get('/',  'Brand\BrandController@getAllBrands');

    Route::get('/{id}',  'Brand\BrandController@getBrandsById');

    Route::post('createNewBrand',  'Brand\BrandController@createNewBrands');

    Route::put('/updateBrand/{id}',  'Brand\BrandController@updateBrand');

    Route::put('/deleteBrand/{id}',  'Brand\BrandController@deleteBrand');


});





///LanguageController
//Route::group(['prefix'=> 'languages'] ,function () {
//
//    Route::get('/', 'Language\LanguageController@getAllLanguage');
//
//    Route::get('{id}', 'Language\LanguageController@getLanguageById');
//
//    Route::post('createNewLanguage', 'Language\LanguageController@createNewLanguage');
//
//    Route::put('updateLanguage/{id}', 'Language\LanguageController@updateLanguage');
//
//    Route::put('deleteLanguage/{id}', 'Language\LanguageController@deleteLanguage');
//});



//Route::get('/stores','Store\StoreController@getAllStore');

//// StoreController
//Route::group(['prefix'=>'stores'],function (){

//    Route::get('/stores','Store\StoreController@getAllStore');
//
//    Route::get('{id}','Store\StoreController@getStoreById');
//
//    Route::post('createNewStores', 'Store\StoreController@createNewStores');
//
//    Route::put('updateStore/{id}', 'Store\StoreController@updateStore');
//
//    Route::put('deleteStore/{id}', 'Store\StoreController@deleteStore');
//});
