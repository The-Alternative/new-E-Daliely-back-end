<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
// use LaravelLocalization;

Route::middleware('auth:api')->get('/user', function (Request $request)
    {
        return $request->user();
    });
Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['api','ChangeLanguage','localize','localizationRedirect','localeViewPath']
    ],
 function()
    {

        /*_____________ Product routes _____________*/
        Route::group(['prefix'=>'products','namespace'=>'Product'],function()
            {
                Route::POST('/getAll','ProductsController@get');
                Route::POST('/getById/{id}','ProductsController@getById');
                Route::POST('/create','ProductsController@create');
                Route::post('/update/{id}','ProductsController@update');
                Route::POST('/search/{title}','ProductsController@search');
                Route::PUT('/trash/{id}','ProductsController@trash');
                Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
                Route::POST('/getTrashed','ProductsController@getTrashed');
                Route::DELETE('/delete/{id}','ProductsController@delete');
            });
        });////////////////////end of localization//////////////////////

        /*_____________Category routes_____________*/
        Route::group(['prefix'=>'categories','namespace'=>'Category'],function()
            {
                Route::GET('/getAll','CategoriesController@get');
                Route::GET('/getById/{id}','CategoriesController@getById');
                Route::POST('/create','CategoriesController@create');
                Route::PUT('/update/{id}','CategoriesController@update');
                Route::PUT('/trash/{id}','CategoriesController@trash');
                Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
                Route::GET('/search/{name}','CategoriesController@search');
                Route::GET('/getTrashed','CategoriesController@getTrashed');
                Route::DELETE('/delete/{id}','CategoriesController@delete');
            });

        /*_____________ Brand routes_____________*/
        // Route::group(['prefix'=> 'brands'] ,function ()
        //     {
        //         Route::get('/',  'Brand\BrandController@getAllBrands');
        //         Route::get('/{id}',  'Brand\BrandController@getBrandsById');
        //         Route::post('createNewBrand',  'Brand\BrandController@createNewBrands');
        //         Route::put('/updateBrand/{id}',  'Brand\BrandController@updateBrand');
        //         Route::put('/deleteBrand/{id}',  'Brand\BrandController@deleteBrand');
        //     });

        /*_____________ Language routes_____________*/

        Route::group(['prefix'=>'languages','namespace'=>'Language'],function(){
            Route::POST('/getAll','LanguageController@get');
            Route::POST('/getById/{id}','LanguageController@getById');
            Route::POST('/create','LanguageController@create');
            Route::post('/update/{id}','LanguageController@update');
            Route::POST('/search/{title}','LanguageController@search');
            Route::PUT('/trash/{id}','LanguageController@trash');
            Route::PUT('/restoreTrashed/{id}','LanguageController@restoreTrashed');
            Route::POST('/getTrashed','LanguageController@getTrashed');
            Route::DELETE('/delete/{id}','LanguageController@delete');
        });


        /*_____________ Store routes_____________*/
        // Route::group(['prefix'=>'stores'],function ()
        //     {
        //         Route::get('/stores','Store\StoreController@getAllStore');
        //         Route::get('{id}','Store\StoreController@getStoreById');
        //         Route::post('createNewStores', 'Store\StoreController@createNewStores');
        //         Route::put('updateStore/{id}', 'Store\StoreController@updateStore');
        //         Route::put('deleteStore/{id}', 'Store\StoreController@deleteStore');
        //     });
=======



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

    Route::post('createNewBrand',  'Brand\BrandController@createNewBrands');

    Route::put('/updateBrand/{id}',  'Brand\BrandController@updateBrand');

    Route::put('/deleteBrand/{id}',  'Brand\BrandController@deleteBrand');


});





/////LanguageController
Route::group(['prefix'=> 'languages'] ,function () {

    Route::get('/', 'Language\LanguageController@getAllLanguage');

    Route::get('{id}', 'Language\LanguageController@getLanguageById');

    Route::post('createNewLanguage', 'Language\LanguageController@createNewLanguage');

    Route::put('updateLanguage/{id}', 'Language\LanguageController@updateLanguage');

    Route::put('deleteLanguage/{id}', 'Language\LanguageController@deleteLanguage');
});





// StoreController
Route::group(['prefix'=>'stores'],function (){

    Route::get('/stores','Store\StoreController@getAllStore');

    Route::get('{id}','Store\StoreController@getStoreById');

    Route::post('createNewStores', 'Store\StoreController@createNewStores');

    Route::put('updateStore/{id}', 'Store\StoreController@updateStore');

    Route::put('deleteStore/{id}', 'Store\StoreController@deleteStore');
});
=======



>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1
