<?php

namespace App\Http\Controllers\Store;

use App\Traits\GeneralTrait;
use App\Http\controllers\controller;
use Illuminate\Http\Request;
use App\Service\Stores\StoreService;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    use GeneralTrait;
    private $StoreService;
    private $response;

    /* ProductsController constructor.
    */
    public function __construct(StoreService $StoreService,Response  $response)
    {
        $this->StoreService=$StoreService;
        $this->response=$response;
    }
    public function get()
    {
        $response= $this->StoreService->get();
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function getById($id)
    {
        $response= $this->StoreService->getById($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
//     dd( $response);
    }
    public function getTrashed()
    {
        $response= $this->StoreService->getTrashed();
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function create(Request $request)
    {
        $response= $this->StoreService->create($request);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function update(Request $request,$id)
    {
        $response= $this->StoreService->update( $request,$id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function search($name)
    {
        $response= $this->StoreService->search($name);
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
    public function restoreTrashed($id)
    {
        $response= $this->StoreService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function delete($id)
    {
        $response= $this->StoreService->delete($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

}
