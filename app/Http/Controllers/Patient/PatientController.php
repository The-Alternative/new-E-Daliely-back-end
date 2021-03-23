<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\PatientRequest;
use App\Service\Patient\PatientService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    use GeneralTrait;
    private $PatientService;
    private $response;

    public function __construct(PatientService $PatientService,Response $response )
    {
        $this->PatientService=$PatientService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->PatientService->get();
    }

    public function  getById($id)
    {
        return $this->PatientService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->PatientService->getTrashed();
    }

    public function create(PatientRequest $request)
    {
        $response=$this->PatientService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(PatientRequest $request,$id)
    {
        $response=$this->PatientService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->PatientService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->PatientService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->PatientService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response=$this->PatientService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }


}
