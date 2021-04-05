<?php

namespace App\Http\Controllers\Store;

<<<<<<< HEAD

=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
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
<<<<<<< HEAD

    public function insertProductToStore(Request $request)
    {
        $response= $this->StoresProductsService->insertProductToStore($request);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
=======
    public function insertProductToStore(Request $request)
    {
        $response= $this->StoresProductsService->insertProductToStore($request);
        return response($response, 200);
    }
    public function updateProductInStore(Request $request,$id)
    {
        $response= $this->StoresProductsService->updateProductInStore($request,$id);
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
    public function viewStoresHasProduct($id)
    {
        $response= $this->StoresProductsService->viewStoresHasProduct($id);
<<<<<<< HEAD
        return response($response,200)
            ->header('Access-Control-Allow-origin','*')
            ->header('Access-Control-Allow-method','*');
=======
        return response($response,200);
    }
    public function viewProductsInStore($id)
    {
        $response= $this->StoresProductsService->viewProductsInStore($id);
        return response($response,200);
    }
    public function hiddenProductByQuantity($id)
    {
        $response= $this->StoresProductsService->hiddenProductByQuantity($id);
        return response($response,200);
    }
    public function rangeOfPrice($id)
    {
        $response= $this->StoresProductsService->rangeOfPrice($id);
        return response($response,200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
}
