<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctors\DoctorRequest;
use App\Service\Doctors\DoctorService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    use GeneralTrait;
    private $DoctorService;
    private $response;

    public function __construct(DoctorService $DoctorService,Response $response )
    {
        $this->DoctorService=$DoctorService;
        $this->response=$response;
    }

    public function get()
    {

        $response=$this->DoctorService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->DoctorService->getById($id);
        return $response;
    }

    public function getTrashed()
    {
        $response= $this->DoctorService->getTrashed();
        return $response;

    }

    public function create(DoctorRequest $request)
    {
        $response=$this->DoctorService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(DoctorRequest $request,$id)
    {
        $response=$this->DoctorService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->DoctorService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->DoctorService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->DoctorService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->DoctorService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

}
