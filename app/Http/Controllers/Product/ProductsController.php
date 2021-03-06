<?php

namespace App\Http\Controllers\Product;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Products\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    use GeneralTrait;
    private $ProductService;
    private $response;

     /* ProductsController constructor.
     */
    public function __construct(ProductService $ProductService,Response  $response)
    {
        $this->ProductService=$ProductService;
        $this->response=$response;
    }
        public function get()
        {
         $response= $this->ProductService->get();
         return $response;
        }
        public function getById($id )
        {
         $response= $this->ProductService->getById($id);
         return $response;
        }
        public function getTrashed()
        {
         $response= $this->ProductService->getTrashed();
         return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function create(ProductRequest $request)
        {
            $response= $this->ProductService->create($request);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function update(ProductRequest $request,$pro_id)
        {
            $response= $this->ProductService->update($request,$pro_id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function search($title)
        {
            $response= $this->ProductService->search($title);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function trash($id)
        {
            $response= $this->ProductService->trash($id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function restoreTrashed($id)
        {
            $response= $this->ProductService->restoreTrashed($id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function delete($id)
        {
            $response= $this->ProductService->delete($id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }

}