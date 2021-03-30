<?php

namespace App\Http\Controllers\Store;


use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Http\controllers\controller;
use App\Service\Stores\StoresProductsService;
use Illuminate\Http\Response;

class StoresProductsController extends Controller
{
    use GeneralTrait;
    private $response;
    private $StoresProductsService;
    public function __construct(StoresProductsService  $StoresProducts,Response  $response)
    {
        $this->StoresProductsService=$StoresProducts;
        $this->response=$response;
    }

    public function insertProductToStore(Request $request)
    {
        $response= $this->StoresProductsService->insertProductToStore($request);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function viewStoresHasProduct($id)
    {
        $response= $this->StoresProductsService->viewStoresHasProduct($id);
        return response($response,200)
            ->header('Access-Control-Allow-origin','*')
            ->header('Access-Control-Allow-method','*');
    }
}
