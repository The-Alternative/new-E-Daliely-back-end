<?php

namespace App\Http\Controllers\Brand;

use App\Models\Brands\brands;
use App\Http\controllers\controller;
use App\Service\Brands\BrandsService;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Http\Requests\Brands\BrandRequest;
use Illuminate\Http\response;


class BrandController extends Controller
{
    use GeneralTrait;
    private $BrandsService;
    private $response;

    public function __construct(BrandsService $BrandsService,Response $response )
    {
        $this->BrandsService=$BrandsService;
        $this->response=$response;
    }

    public function get()
    {

        $response=$this->BrandsService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->BrandsService->getById($id);
       return $response;
    }

    public function getTrashed()
    {
        $response= $this->BrandsService->getTrashed();
        return $response;

    }
////
    public function create(BrandRequest $request)
    {
        $response=$this->BrandsService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
////
    public function update(BrandRequest $request,$id)
    {
        $response=$this->BrandsService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->BrandsService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->BrandsService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->BrandsService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->BrandsService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
