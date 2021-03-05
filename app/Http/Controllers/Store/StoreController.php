<?php

namespace App\Http\Controllers\Store;

use App\Traits\GeneralTrait;
use App\Http\controllers\controller;
use Illuminate\Http\Request;
use App\Service\Stores\StoreService;
use App\Models\Stores\Stores;

class StoreController extends Controller
{

   use GeneralTrait;

   //private $StoreService;

//    public function __construct(StoreService $StoreService)
//    {
//        $this-> StoreService=$StoreService;
//
//    }

    public function getAllStore()
    {
        return 'ok';


//        $response=$this->StoreService->getAllStore();
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
    }

//    public function getStoreById($id)
//    {
//        $response=$this->StoreService->getStoreById($id);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
//    }
//
//    public function createNewStores(Request $request)
//    {
//        $response=$this->StoreService->createNewStores($request);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
//    }
//    public function updateStore(Request $request,$id)
//    {
//        $response=$this->StoreService->updateStore($request, $id);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
//    }
//
//    public function deleteStore(Request $request ,$id)
//    {
//        $response=$this->StoreService->deleteStore($request, $id);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
//
//    }




}
