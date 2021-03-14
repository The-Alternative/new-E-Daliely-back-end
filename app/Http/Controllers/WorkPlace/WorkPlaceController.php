<?php

namespace App\Http\Controllers\WorkPlace;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkPlace\WorkPlaceRequest;
use App\Service\WorkPlace\WorkPlaceService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkPlaceController extends Controller
{

    use GeneralTrait;
    private $WorkPlaceService;
    private $response;

    public function __construct(WorkPlaceService $WorkPlaceService,Response $response )
    {
        $this->WorkPlaceService =$WorkPlaceService;
        $this->response=$response;
    }
    public function get()
    {

        $response=$this->WorkPlaceService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->WorkPlaceService->getById($id);
        return $response;
    }

    public function getTrashed()
    {
        $response= $this->WorkPlaceService->getTrashed();
        return $response;

    }

    public function create(WorkPlaceRequest $request)
    {
        $response=$this->WorkPlaceService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(WorkPlaceRequest $request,$id)
    {
        $response=$this->WorkPlaceService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
//    public function search($name)
//    {
//        $response= $this->WorkPlaceService->search($name);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }

    public function trash($id)
    {
        $response= $this->WorkPlaceService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->WorkPlaceService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->WorkPlaceService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
