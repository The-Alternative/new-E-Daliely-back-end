<?php

namespace App\Http\Controllers\Store;

use App\Traits\GeneralTrait;
use App\Http\controllers\controller;
use Illuminate\Http\Request;
use App\Http\Requests\Store\StoreRequest;
use Illuminate\Http\Response;
use App\Service\Stores\StoreService;
<<<<<<< HEAD
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
=======
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
>>>>>>> 11ea1d59df9dda1b901b99c8a10d0b1f7196163d
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
<<<<<<< HEAD

    public function restoreTrashed($id)
    {
        $response= $this->StoreService->restoreTrashed($id);
=======
    public function search($name)
    {
        $response= $this->StoreService->search($name);
>>>>>>> 11ea1d59df9dda1b901b99c8a10d0b1f7196163d
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
<<<<<<< HEAD

    public function search($title)
    {
        $response= $this->StoreService->search($title);
=======
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
>>>>>>> 11ea1d59df9dda1b901b99c8a10d0b1f7196163d
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
<<<<<<< HEAD

=======
>>>>>>> 11ea1d59df9dda1b901b99c8a10d0b1f7196163d

}
