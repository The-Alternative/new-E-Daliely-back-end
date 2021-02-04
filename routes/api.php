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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::GET('/products/getAllProducts','App\Http\Controllers\Product\ProductsController@getAllProducts');




///BrandController
Route::get('/brands',  'Brand\BrandController@getAllBrands');

Route::get('/brand/{id}',  'Brand\BrandController@getBrandsById');

Route::post('/brand/createNewBrand',  'Brand\BrandController@createNewBrands');

Route::put('/brand/updateBrand/{id}',  'Brand\BrandController@updateBrand');

Route::put('/brand/deleteBrand/{id}',  'Brand\BrandController@deleteBrand');

///LanguageController
///
Route::get('/languages',  'Language\LanguageController@getAllLanguage');

Route::get('/language/{id}',  'Language\LanguageController@getLanguageById');

Route::post('/language/createNewLanguage',  'Language\LanguageController@createNewLanguage');

Route::put('/language/updateLanguage/{id}',  'Language\LanguageController@updateLanguage');

Route::put('/language/deleteLanguage/{id}',  'Language\LanguageController@deleteLanguage');
