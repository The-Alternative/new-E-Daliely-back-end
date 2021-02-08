<?php

namespace App\Http\Controllers\Product;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Products\ProductService;
// use App\brand;
// use App\category;
// use App\custom_field;
// use App\product_image;
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
         $response= $this->ProductService->get($id=null);
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


        public function update(Request $request)
        {
            $response= $this->ProductService->update($request);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }


        public function search(Request $request)
        {
            $response= $this->ProductService->search($request);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }

}