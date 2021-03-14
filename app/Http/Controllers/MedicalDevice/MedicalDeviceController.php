<?php

namespace App\Http\Controllers\MedicalDevice;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalDevice\MedicalDeviceRequest;
use App\Service\MedicalDevice\MedicalDeviceService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MedicalDeviceController extends Controller
{

    use GeneralTrait;
    private $MedicalDeviceService;
    private $response;

    public function __construct(MedicalDeviceService $MedicalDeviceService,Response $response )
    {
        $this->MedicalDeviceService =$MedicalDeviceService;
        $this->response=$response;
    }
    public function get()
    {

        $response=$this->MedicalDeviceService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->MedicalDeviceService->getById($id);
        return $response;
    }

    public function getTrashed()
    {
        $response= $this->MedicalDeviceService->getTrashed();
        return $response;

    }

    public function create(MedicalDeviceRequest $request)
    {
        $response=$this->MedicalDeviceService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(MedicalDeviceRequest $request,$id)
    {
        $response=$this->MedicalDeviceService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->MedicalDeviceService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->MedicalDeviceService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->MedicalDeviceService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->MedicalDeviceService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
