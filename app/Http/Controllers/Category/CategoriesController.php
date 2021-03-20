<?php

namespace App\Http\Controllers\Category;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Categories\CategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    use GeneralTrait;
    private $CategoryService;
    private $response;

     /* ProductsController constructor.
     */
    public function __construct(CategoryService $CategoryService,Response  $response)
    {
        $this->CategoryService=$CategoryService;
        $this->response=$response;
    }
    public function get()
    {
     $response= $this->CategoryService->get();
     return $response;
    }
    public function getById($id )
    {
     $response= $this->CategoryService->getById($id);
     return $response;
    }
    public function getTrashed()
    {
     $response= $this->CategoryService->getTrashed();
     return response($response, 200)
                 ->header('Access-Control-Allow-Origin', '*')
                 ->header('Access-Control-Allow-Methods', '*');
    }
        public function create(CategoryRequest $request)
        {
            $response= $this->CategoryService->create($request);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function update(CategoryRequest $request)
        {
            $response= $this->CategoryService->update( $request);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function search($name)
        {
            $response= $this->CategoryService->search($name);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function trash($id)
        {
            $response= $this->CategoryService->trash($id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function restoreTrashed($id)
        {
            $response= $this->CategoryService->restoreTrashed($id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
        public function delete($id)
        {
            $response= $this->CategoryService->delete($id);
            return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }

}
