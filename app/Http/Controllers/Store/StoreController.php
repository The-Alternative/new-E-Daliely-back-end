<?php

namespace App\Http\Controllers\Store;

use App\Traits\GeneralTrait;
use App\Http\controllers\controller;
use Illuminate\Http\Request;
use App\Http\Requests\Store\StoreRequest;
use Illuminate\Http\Response;
use App\Service\Stores\StoreService;
use App\Models\Stores\Store;

class StoreController extends Controller
{
   use GeneralTrait;
//    use Validator;
   private $StoreService;
   private $response;

    public function __construct(StoreService $StoreService,Response $response)
    {
        $this-> StoreService=$StoreService;
        $this->response=$response;
    }

    public function get()
    {
        $response=$this->StoreService->get();
        return  $response;
    }

    public function getById($id)
    {
        $response=$this->StoreService->getById($id);
        return  $response;
    }
//
    public function create(StoreRequest $request)
    {
        $response=$this->StoreService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
    public function update(StoreRequest $request,$id)
    {
        $response=$this->StoreService->update($request, $id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
//
    public function delete(StoreRequest $request ,$id)
    {
        $response=$this->StoreService->delete($request, $id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function getTrashed()
    {
        $response= $this->StoreService->getTrashed();
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->StoreService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function trash($id)
    {
        $response= $this->StoreService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function search($title)
    {
        $response= $this->StoreService->search($title);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }


}
